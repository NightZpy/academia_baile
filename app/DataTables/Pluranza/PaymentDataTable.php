<?php
namespace App\DataTables\Pluranza;

use App\DataTables\BaseDataTable;

class PaymentDataTable extends BaseDataTable
{
	function __construct() {
		$this->columns = [
			'Voucher',
			'Monto',
			'Fecha',
			'Código de referencia',
			'Estatús',
			'Competidor',
			'Acciones'
		];
		$this->defaultConfig();
		$this->setRoute('pluranza.payments.api.list');
		$actionRoutes = [
			'show'      => 'pluranza.payments.show',
			'edit'      => 'pluranza.payments.edit',
			'delete'    => 'pluranza.payments.delete'
		];
		$this->setDefaultActionRoutes($actionRoutes);
	}

	public function setBodyTableSettings()
	{
		$this->collection->searchColumns('Nombre');
		$this->collection->orderColumns('Nombre');

		$this->collection->addColumn('Nombre', function($model)
		{
			return $model->name;
		});
	}
}