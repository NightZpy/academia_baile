<?php
namespace App\Repository\Pluranza;

use App\DataTables\Pluranza\AcademyDataTable;
use App\Pluranza\Academy;
use App\Repository\BaseRepository;

class AcademyRepository extends BaseRepository {

	public $dataTable;

	/**
	 * DancerRepository constructor.
	 */
	public function __construct(AcademyDataTable $academyDataTable) {
		$this->setModel(new Academy);
		$this->dataTable = $academyDataTable;
	}

	public function getAllDataTable()
	{
		return $this->dataTable->getDefaultTable($this->getAll());
	}
}

