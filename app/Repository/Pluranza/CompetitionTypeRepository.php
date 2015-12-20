<?php
namespace App\Repository\Pluranza;

use App\Pluranza\CompetitionType;
use App\DataTables\Pluranza\CompetitionTypeDataTable;
use App\Repository\BaseRepository;

class CompetitionTypeRepository extends BaseRepository {

	public $dataTable;

	/**
	 * DancerRepository constructor.
	 */
	public function __construct(CompetitionTypeDataTable $dataTable) {
		$this->setModel(new CompetitionType);
		$this->dataTable = $dataTable;
	}

	public function getAllDataTable()
	{
		return $this->dataTable->getDefaultTable($this->getAll());
	}
}

