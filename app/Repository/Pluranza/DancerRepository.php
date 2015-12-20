<?php
namespace App\Repository\Pluranza;

use App\DataTables\Pluranza\AcademyDataTable;
use App\DataTables\Pluranza\DancerDataTable;
use App\Pluranza\Dancer;
use App\Repository\BaseRepository;

class DancerRepository extends BaseRepository {

	public $dataTable;

	/**
	 * DancerRepository constructor.
	 */
	public function __construct(DancerDataTable $dataTable) {
		$this->setModel(new Dancer);
		$this->dataTable = $dataTable;
	}

	public function getByAcademy($id)
	{
		$academy = new AcademyRepository(new AcademyDataTable);
		return $academy->get($id)->dancers;
	}

	public function getByAcademyDataTable($id)
	{
		$academy = new AcademyRepository(new AcademyDataTable);
		$dancers = $academy->get($id)->dancers;
		$this->dataTable->setDatatableCollection($dancers);
		return $this->dataTable->getDefaultTable($dancers);
	}
}

