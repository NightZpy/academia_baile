<?php
namespace App\Repository\Pluranza;

use App\Pluranza\CompetitionCategory;
use App\DataTables\Pluranza\CompetitionCategoryDataTable;
use App\Repository\BaseRepository;

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
}

