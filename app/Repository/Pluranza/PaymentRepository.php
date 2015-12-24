<?php
namespace App\Repository\Pluranza;

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
}

