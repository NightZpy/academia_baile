<?php
namespace App\Repository\Pluranza;

use App\DataTables\Pluranza\AcademyDataTable;
use App\Pluranza\Payment;
use App\DataTables\Pluranza\PaymentDataTable;
use App\Repository\BaseRepository;

class PaymentRepository extends BaseRepository {

	public $dataTable;

	/**
	 * DancerRepository constructor.
	 */
	public function __construct(PaymentDataTable $dataTable) {
		$this->setModel(new Payment);
		$this->dataTable = $dataTable;
	}

	public function getAllDataTable()
	{
		return $this->dataTable->getDefaultTable($this->getAll());
	}

	public function getByAcademy($id)
	{
		$academy = new AcademyRepository(new AcademyDataTable);
		return $academy->get($id)->payments;
	}

	public function getByAcademyDataTable($id)
	{
		$payments = $this->getByACademy($id);
		$this->dataTable->setDatatableCollection($payments);
		return $this->dataTable->getDefaultTable($payments);
	}
}

