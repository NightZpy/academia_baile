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
			return $model->statusEsp;
		});

		$this->collection->addColumn('Competidor', function($model)
		{
			return $model->competitor->name;
		});
	}

	public function setDefaultActionColumn() {
		$routes = $this->actionRoutes;
		$actions = $this->actionColums;

		$this->addColumnToCollection('Acciones', function($model) use ($routes, $actions)
		{
			$this->cleanActionColumn();
			if ($model->status == 'accept') {
				$this->addActionColumn('<strong>Listo</strong>');
			} else {
				$this->addActionColumn("<div class='btn-group btn-group-sm' role='group'>");
				if (in_array('all', $actions)) {
					$this->addActionColumn("<a class='show btn btn-xs btn-warning btn-circle' href='" . route($routes['show'], $model->id) . "' id='show_" . $model->id . "'><i class='fa fa-user'></i> Ver</a>");
					$this->addActionColumn("<a  class='edit btn btn-xs btn-darkGray btn-circle' href='" . route($routes['edit'], $model->id) . "' id='edit_" . $model->id . "'><i class='fa fa-pencil'></i> Editar</a>");

					$deleteForm = '<form method="POST" action="' . route($routes['delete'], $model->id) . '" accept-charset="UTF-8" style="display: inline;">';
					$deleteForm .= '<input name="_method" type="hidden" value="DELETE">';
					$deleteForm .= '<input name="_token" type="hidden" value="' . csrf_token() . '">';
					$deleteForm .= '<button type="submit" class="delete btn btn-xs btn-primary"><i class="fa fa-trash"></i> Eliminar</button>';
					$deleteForm .= '</form>';
					$this->addActionColumn($deleteForm);
				} else {
					if (in_array('show', $actions)) $this->addActionColumn("<a class='show btn btn-xs btn-warning btn-circle' href='" . route($routes['show'], $model->id) . "' id='show_" . $model->id . "'><i class='fa fa-user'></i> Ver</a>");

					if (in_array('edit', $actions)) $this->addActionColumn("<a  class='edit btn btn-xs btn-darkGray btn-circle' href='" . route($routes['edit'], $model->id) . "' id='edit_" . $model->id . "'><i class='fa fa-pencil'></i> Editar</a>");

					if (in_array('delete', $actions)) {
						$deleteForm = '<form method="POST" action="' . route($routes['delete'], $model->id) . '" accept-charset="UTF-8"  style="display: inline;">';
						$deleteForm .= '<input name="_method" type="hidden" value="DELETE">';
						$deleteForm .= '<input name="_token" type="hidden" value="' . csrf_token() . '">';
						$deleteForm .= '<button type="submit" class="delete btn btn-xs btn-primary"><i class="fa fa-trash"></i> Eliminar</button>';
						$deleteForm .= '</form>';
						$this->addActionColumn($deleteForm);
					}
				}
				$this->addActionColumn('</div>');
			}
			return implode(" ", $this->getActionColumn());
		});
	}

	public function getByAcademyTable($params = [])
	{
		return $this->getAllTable('pluranza.payments.api.by-academy', $params);
	}
}