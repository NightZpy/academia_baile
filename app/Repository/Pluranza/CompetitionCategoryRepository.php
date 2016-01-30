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
		return $this->getCategories()->pluck('name', 'id');
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
		return $this->getCategoriesByCompetitionType($id)->pluck('name', 'id')->toArray();
	}

	public function getCategoriesByCompetitionTypeCount($id)
	{
		return $this->getCategoriesByCompetitionType($id)->count();
	}

	public function getLevelByCategoryAndCompetitionTypeForSelect($categoryId, $competitionCategoryId)
	{
		$competitionCategories =  $this->model->whereCategoryId($categoryId)
											  ->whereCompetitionTypeId($competitionCategoryId)
											  ->groupBy('level_id')->get();
		$levels = new Collection();
		foreach ($competitionCategories as $competitionCategory)
			$levels->add($competitionCategory->level);
		return $levels->pluck('name', 'id')->toArray();
	}

	public function getLevelByCategoryAndCompetitionTypeCount($categoryId, $competitionCategoryId)
	{
		$competitionCategories =  $this->model->whereCategoryId($categoryId)
											  ->whereCompetitionTypeId($competitionCategoryId)
											  ->groupBy('level_id')->get();
		$levels = new Collection();
		foreach ($competitionCategories as $competitionCategory)
			$levels->add($competitionCategory->level);
		return $levels->count();
	}

	public function getLevelByCategoryForSelect($id)
	{
		return $this->getLevelByCategory($id)->pluck('name', 'id');
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
		return $this->getCompetitionTypes()->pluck('name', 'id');
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
		return $this->getCompetitionTypeByLevel($id)->pluck('name', 'id');
	}

	public function allOrderBy($by = ['competition_type', 'category', 'level'], $type = 'asc') {
		$model = $this->model;
		if (in_array('competition_type', $by)) {
			$model = $model->join('competition_types', 'competition_categories.' . 'competition_type_id', '=', 'competition_types.id');
			$model = $model->orderBy('competition_types.name', $type);
		}
		if (in_array('category', $by)) {
			$model = $model->join('categories', 'competition_categories.' . 'category_id', '=', 'categories.id');
			$model = $model->orderBy('categories.name', $type);
		}
		if (in_array('level', $by)) {
			$model = $model->join('levels', 'competition_categories.' . 'level_id', '=', 'levels.id');
			$model = $model->orderBy('levels.name', $type);
		}
		$model = $model->select('competition_categories.*');
		return $model->get();
	}
}

