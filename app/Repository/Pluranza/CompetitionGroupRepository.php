<?php
namespace App\Repository\Pluranza;

use App\Pluranza\CompetitionGroup;
use App\DataTables\Pluranza\CompetitionGroupDataTable;
use App\Repository\BaseRepository;

class CompetitionGroupRepository extends BaseRepository {

	public $dataTable;

	/**
	 * DancerRepository constructor.
	 */
	public function __construct(CompetitionGroupDataTable $dataTable) {
		$this->setModel(new CompetitionGroup);
		$this->dataTable = $dataTable;
	}

	public function getAllDataTable()
	{
		return $this->dataTable->getDefaultTable($this->getAll());
	}
}

