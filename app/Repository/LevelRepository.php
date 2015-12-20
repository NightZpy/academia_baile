<?php
namespace App\Repository;

use App\Level;
use App\DataTables\LevelDataTable;

class LevelRepository extends BaseRepository {

	public $dataTable;

	/**
	 * DancerRepository constructor.
	 */
	public function __construct(LevelDataTable $dataTable) {
		$this->setModel(new Level);
		$this->dataTable = $dataTable;
	}

	public function getAllDataTable()
	{
		return $this->dataTable->getDefaultTable($this->getAll());
	}
}

