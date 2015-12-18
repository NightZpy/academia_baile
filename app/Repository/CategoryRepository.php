<?php
namespace App\Repository;

use App\Category;
use App\DataTables\CategoryDataTable;

class CategoryRepository extends BaseRepository {

	public $dataTable;

	/**
	 * DancerRepository constructor.
	 */
	public function __construct(CategoryDataTable $dataTable) {
		$this->setModel(new Category);
		$this->dataTable = $dataTable;
	}

	public function getAllDataTable()
	{
		return $this->dataTable->getDefaultTable($this->getAll());
	}
}

