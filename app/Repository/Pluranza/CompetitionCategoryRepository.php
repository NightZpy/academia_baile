<?php
namespace App\Repository\Pluranza;

use App\Pluranza\CompetitionCategory;
use App\DataTables\Pluranza\CompetitionCategoryDataTable;
use App\Repository\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

class CompetitionCategoryRepository extends BaseRepository {

	public $dataTable;

	/**
	 * DancerRepository constructor.
	 */
	public function __construct(CompetitionCategoryDataTable $dataTable) {
		$this->setModel(new CompetitionCategory);
		$this->dataTable = $dataTable;
	}

	public function getByAll($categoryId, $levelId, $competitionTypeId)
	{
		return $this->model
					->whereCategoryId($categoryId)
					->whereLevelId($levelId)
					->whereCompetitionTypeId($competitionTypeId)
					->first();
	}

	public function getAllDataTable()
	{
		return $this->dataTable->getDefaultTable($this->getAll());
	}

	public function getCategories()
	{
		$competitionCategories = $this->getAll();
		$categories = new Collection();
		foreach ($competitionCategories as $competitionCategory)
			$categories->add($competitionCategory->category);
		return $categories;
	}

	public function getCategoriesForSelect()
	{
		return $this->getCategories()->lists('name', 'id');
	}

	public function getCategoriesByCompetitionType($id)
	{
		$competitionCategories =  $this->model->whereCompetitionTypeId($id)->groupBy('category_id')->get();
		$categories = new Collection();
		foreach ($competitionCategories as $competitionCategory)
			$categories->add($competitionCategory->category);
		return $categories;
	}

	public function getCategoriesByCompetitionTypeForSelect($id)
	{
		return $this->getCategoriesByCompetitionType($id)->lists('name', 'id');
	}

	public function getLevelByCategory($id)
	{
		$competitionCategories =  $this->model->whereCategoryId($id)->groupBy('level_id')->get();
		$levels = new Collection();
		foreach ($competitionCategories as $competitionCategory)
			$levels->add($competitionCategory->level);
		return $levels;
	}

	public function getLevelByCategoryForSelect($id)
	{
		return $this->getLevelByCategory($id)->lists('name', 'id');
	}

	public function getCompetitionTypes()
	{
		//$competitionCategories = $this->getAll()->groupBy('competition_type_id')->get();
		$competitionCategories = CompetitionCategory::groupBy('competition_type_id')->get();
		$competitionTypes = new Collection();
		foreach ($competitionCategories as $competitionCategory)
			$competitionTypes->add($competitionCategory->competitionType);
		return $competitionTypes;
	}

	public function getCompetitionTypesForSelect()
	{
		return $this->getCompetitionTypes()->lists('name', 'id');
	}


	public function getCompetitionTypeByLevel($id)
	{
		$competitionCategories =  $this->model->whereLevelId($id)->groupBy('competition_type_id')->get();
		$competitionTypes = new Collection();
		foreach ($competitionCategories as $competitionCategory)
			$competitionTypes->add($competitionCategory->competitionType);
		return $competitionTypes;
	}

	public function getCompetitionTypeByLevelForSelect($id)
	{
		return $this->getCompetitionTypeByLevel($id)->lists('name', 'id');
	}
}

