<?php
namespace App\Repository\Pluranza;

use App\DataTables\Pluranza\AcademyDataTable;
use App\Pluranza\CompetitionCategory;
use App\Pluranza\CompetitionType;
use App\Pluranza\Competitor;
use App\DataTables\Pluranza\CompetitorDataTable;
use App\Repository\BaseRepository;

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

