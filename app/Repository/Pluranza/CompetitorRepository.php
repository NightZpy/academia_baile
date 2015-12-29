<?php
namespace App\Repository\Pluranza;

use App\DataTables\Pluranza\AcademyDataTable;
use App\Pluranza\CompetitionCategory;
use App\Pluranza\CompetitionType;
use App\Pluranza\Competitor;
use App\DataTables\Pluranza\CompetitorDataTable;
use App\Repository\BaseRepository;
use Psy\Exception\ErrorException;

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
									->where('competitors.academy_id', '<>', $data['academy_id'])
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
		$competitors = $this->getByACademy($id);
		$this->dataTable->setDatatableCollection($competitors);
		return $this->dataTable->getDefaultTable($competitors);
	}

	public function getAutomaticName(CompetitionType $competitionType)
	{
		$quantity = $this->model
			 ->join('competition_categories', 'competitors.competition_category_id', '=', 'competition_categories.id')
			 ->where('competition_categories.competition_type_id', '=', $competitionType->id)
			 ->count();
		return ucfirst($competitionType->name . ' ' . ($quantity + 1));
	}
}

