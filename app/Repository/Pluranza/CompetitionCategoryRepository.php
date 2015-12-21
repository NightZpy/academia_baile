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
}

