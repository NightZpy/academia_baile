<?php
namespace App\Repository\Pluranza;

use App\Lodging;
use App\DataTables\Pluranza\LodgingDataTable;

class LodgingRepository extends BaseRepository {

	public $dataTable;

	/**
	 * DancerRepository constructor.
	 */
	public function __construct(LodgingDataTable $dataTable) {
		$this->setModel(new Lodging);
		$this->dataTable = $dataTable;
	}

	public function getAllDataTable()
	{
		return $this->dataTable->getDefaultTable($this->getAll());
	}
}

