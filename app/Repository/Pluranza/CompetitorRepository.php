<?php
namespace App\Repository\Pluranza;

use App\DataTables\Pluranza\AcademyDataTable;
use App\Pluranza\CompetitionType;
use App\Pluranza\Competitor;
use App\Configuration;
use App\DataTables\Pluranza\CompetitorDataTable;
use App\Repository\BaseRepository;
use Auth;
use Entrust;

class CompetitorRepository extends BaseRepository {

	protected $competitionCategoryRepository;

	/**
	 * DancerRepository constructor.
	 */
	public function __construct(CompetitorDataTable $dataTable, CompetitionCategoryRepository $competitionCategoryRepository) {
		$this->setModel(new Competitor);
		$this->dataTable = $dataTable;
		$this->competitionCategoryRepository = $competitionCategoryRepository;
	}

	public function exists($data = array(), $dancers = array())
	{
		// Check if selected categories already in the database, i.e., check if the same competitor was create before
		$competitionCategory = $this->competitionCategoryRepository->getByAll($data['category_id'], $data['level_id'], $data['competition_type_id']);
		$exists = $this->model->where('competition_category_id', '=', $competitionCategory->id)
			                  ->where('academy_id', '=', $data['academy_id'])
			                  ->where('name', '=', $data['name'])
							  ->count();

		// Check if selected dancers are in another academy competition for same event
		$dancerExists = $this->model->join('competitor_dancer', 'competitors.id', '=', 'competitor_dancer.competitor_id')
									->join('dancers', function($join) use ($dancers) {
										$join->on('competitor_dancer.dancer_id', '=', 'dancers.id')
											 ->whereIn('dancers.id', $dancers);
									})
									->where('competitors.competition_category_id', '=', $competitionCategory->id)
									->orWhere('competitors.academy_id', '<>', $data['academy_id'])
									->count();
		return $exists || $dancerExists;
	}

	public function create($data = array())
	{
		$competitionCategory = $this->competitionCategoryRepository->getByAll($data['category_id'], $data['level_id'], $data['competition_type_id']);
		$competitor = parent::create($data);
		$competitionCategory->competitors()->save($competitor);
		$competitor->dancers()->attach($data['dancer_id']);
		return $competitor;
	}

	public function updateCustom($data = array(), $id)
	{
		$competitionCategory = $this->competitionCategoryRepository->getByAll($data['category_id'], $data['level_id'], $data['competition_type_id']);
		$competitor = $this->get($id);
		$competitor->update($data);
		$competitor->competition_category_id = $competitionCategory->id;
		$competitor->save();
		$competitor->dancers()->sync($data['dancer_id']);
		return $competitor;
	}

	public function getByAcademy($id)
	{
		$academy = new AcademyRepository(new AcademyDataTable);
		return $academy->get($id)->competitors;
	}

	public function getByAcademyDataTable($id)
	{
		if (Entrust::hasRole(['director']) && !Auth::user()->ownerOfAcademy($id)) {
			$actions = ['show'];
			$this->dataTable->setDefaultActions($actions);
		}
		$competitors = $this->getByACademy($id);
		$this->dataTable->setDatatableCollection($competitors);
		return $this->dataTable->getDefaultTable($competitors);
	}

	public function getAllDataTable()
	{
		$this->dataTable->getDefaultTable($this->getAll(null, ['desc' => 'created_at']));
		\DB::enableQueryLog();
		return \DB::getQueryLog();
	}

	public function getAutomaticName(CompetitionType $competitionType)
	{
		$quantity = $this->model
			 ->join('competition_categories', 'competitors.competition_category_id', '=', 'competition_categories.id')
			 ->where('competition_categories.competition_type_id', '=', $competitionType->id)
			 ->count();
		if ($quantity > 0) {
			$lastName = $this->model
				->join('competition_categories', 'competitors.competition_category_id', '=', 'competition_categories.id')
				->where('competition_categories.competition_type_id', '=', $competitionType->id)
				->orderBy('competitors.created_at', 'desc')
				->first()->name;
			$name = $competitionType->name . ' ' . (filter_var($lastName, FILTER_SANITIZE_NUMBER_INT) + 1);
		} else {
			$name = $competitionType->name . ' ' . ($quantity + 1);
		}
		return ucfirst($name);
	}

	public function availableCompetitionQuotas() {
		$maxCompetitors = Configuration::first()->max_competitors;
		$available = $maxCompetitors - $this->count();
		return ($available > 0 ? $available : 0);
	}

	public function exceededQuotas() {
		$maxCompetitors = Configuration::first()->max_competitors;
		$available = $maxCompetitors - $this->count();
		return ($available < 0 ? $available * -1 : 0);
	}

	public function countUsedQuotas() {
		$count = array();
		$competitionCategories = $this->competitionCategoryRepository->allOrderBy();
		foreach ($competitionCategories as $competitionCategory) {
			$category = $competitionCategory->competitionType->name;
			$level = $competitionCategory->level->name;
			$gender = $competitionCategory->category->name;
			// cuenta siempre uno porque siempre carga el mismo category y las claves se cargan a pesar de no tener competidores, por ser la misma
			$total = $this->model
						  ->whereCompetitionCategoryId($competitionCategory->id)
						  ->count();
			$count[$category][$level][$gender] = $total;
		}
		\Debugbar::info(['Lista' => $count]);
		return $count;
	}

	public function countByCompetitionCategory($id)
	{
		return $this->model
						  ->whereCompetitionCategoryId($id)
						  ->count();	
	}

	public function debt()
	{
		$total = 0;
		$competitors = $this->getAll();
		foreach ($competitors as $competitor) 
			$total += $competitor->price;
		return $total;
	}

	public function debtBs()
	{
		return number_format($this->debt(), '2', ',', '.') . ' Bs';
	}

	/*
	* -------------------- Get General Dancers -------------------
	*/
	public function getDancers($id)
	{
		$competitor = $this->get($id);
		return $competitor->dancers;
	}

	public function getDancersForSelect($id)
	{
		return $this->getDancers($id)->pluck('name', 'id')->toArray();
	}

	public function getDancersForSelected($id)
	{
		return $this->getDancers($id)->pluck('id')->toArray();
	}

	public function getDancersCount($id)
	{
		return $this->getDancers($id)->count();
	}

	/*
	* -------------------- Get Masculine -------------------
	*/
	public function getDancersMasculine($id)
	{
		$competitor = $this->get($id);
		return $competitor->dancers()->masculine()->get();
	}

	public function getDancersMasculineForSelect($id)
	{
		return $this->getDancersMasculine($id)->pluck('name', 'id')->toArray();
	}

	public function getDancersMasculineForSelected($id)
	{
		return $this->getDancersMasculine($id)->pluck('id')->toArray();
	}

	public function getDancersMasculineCount($id)
	{
		return $this->getDancersMasculine($id)->count();
	}

	/*
	* -------------------- Get Female -------------------
	*/
	public function getDancersFemale($id)
	{
		$competitor = $this->get($id);
		return $competitor->dancers()->female()->get();
	}

	public function getDancersFemaleForSelect($id)
	{
		return $this->getDancersFemale($id)->pluck('name', 'id');
	}

	public function getDancersFemaleForSelected($id)
	{
		return $this->getDancersFemale($id)->pluck('id')->toArray();
	}

	public function getDancersFemaleCount($id)
	{
		return $this->getDancersFemale($id)->count();
	}

	/*
	* -------------------- Get Category -------------------
	*/
	public function getCategory($id)
	{
		$competitor = $this->get($id);
		return $competitor->category;
	}


	public function getCategoryCount($id)
	{
		return null !== $this->getCategory($id);
	}

	public function getCategoryForSelected($id)
	{
		return $this->getCategory($id)->id;
	}

	/*
	* -------------------- Get Level -------------------
	*/
	public function getLevel($id)
	{
		$competitor = $this->get($id);
		return $competitor->level;
	}

	public function getLevelCount($id)
	{
		return null !== $this->getLevel($id);
	}

	public function getLevelForSelected($id)
	{
		return $this->getLevel($id)->id;
	}	
}

