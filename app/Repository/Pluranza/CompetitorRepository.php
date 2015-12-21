<?php
namespace App\Repository\Pluranza;

use App\Pluranza\Competitor;
use App\DataTables\Pluranza\CompetitorDataTable;
use App\Repository\BaseRepository;

class CompetitorRepository extends BaseRepository {

	public $dataTable;

	/**
	 * DancerRepository constructor.
	 */
	public function __construct(CompetitorDataTable $dataTable) {
		$this->setModel(new Competitor);
		$this->dataTable = $dataTable;
	}

	public function getAllDataTable()
	{
		return $this->dataTable->getDefaultTable($this->getAll());
	}

	public function getByAcademy($id)
	{
		$academy = new AcademyRepository(new AcademyDataTable);
		return $academy->get($id)->competitors;
	}

	public function getByAcademyDataTable($id)
	{
		$competitors = $this->getByACademy($id);
		$this->dataTable->setDatatableCollection($competitors);
		return $this->dataTable->getDefaultTable($competitors);
	}
}

