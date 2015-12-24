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
		$this->setDefaultActions(['edit', 'delete']);
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
		$this->collection->searchColumns('Monto', 'Fecha', 'Código de referencia', 'Estatús', 'Competidor');
		$this->collection->orderColumns('Monto', 'Fecha', 'Estatús', 'Competidor');

		$this->collection->addColumn('Voucher', function($model)
		{
			return '<img src="' . $model->voucher->url('thumb') . '" alt="' . ($model->competitor ? $model->competitor->name : $model->academy->name) . '">';
		});

		$this->collection->addColumn('Monto', function($model)
		{
			return $model->amountBs;
		});

		$this->collection->addColumn('Fecha', function($model)
		{
			return $model->date;
		});

		$this->collection->addColumn('Código de referencia', function($model)
		{
			return $model->reference_code;
		});

		$this->collection->addColumn('Estatús', function($model)
		{
			return $model->status;
		});

		$this->collection->addColumn('Competidor', function($model)
		{
			return $model->competitor->name;
		});
	}

	public function getByAcademyTable($params = [])
	{
		return $this->getAllTable('pluranza.payments.api.by-academy', $params);
	}
}