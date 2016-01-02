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

	public function updateCustom($data = array(), $id)
	{
		$payment = $this->get($id);
		$data['status'] = 'pending';
		$payment->update($data);
		return $payment;
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
		$payments = $this->getByACademy($id)->sortByDesc('created_at');
		$this->dataTable->setDatatableCollection($payments);
		return $this->dataTable->getDefaultTable($payments);
	}

	public function countAccept() {
		return $this->model->whereStatus('accept')->count();
	}

	public function credit() {
		return $this->model->sum('amount');
	}

	public function creditBs() {
		return number_format($this->credit(), '2', ',', '.') . ' Bs';
	}
}

