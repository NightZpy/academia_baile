<?php
namespace App\DataTables\Pluranza;

use App\DataTables\BaseDataTable;
use Entrust;

class PaymentDataTable extends BaseDataTable
{
	function __construct() {
		$this->columns = [
			'Agregada',
			'Voucher',
			'Monto',
			'Fecha',
			'Código de referencia',
			'Estatús',
			'Competidor',
			'Academia',
			'Acciones'
		];
		$this->defaultConfig();
		$this->setRoute('pluranza.payments.api.list');
		$this->setOrderColumn(0);
		$this->setOrderType('desc');
		$this->setHideColumns([0]);

		$actionRoutes = [
			'edit'      => 'pluranza.payments.edit',
			'delete'    => 'pluranza.payments.delete',
		];
		$actions = ['edit', 'delete'];

		if (Entrust::hasRole('admin')) {
			$actionRoutes['confirm']    = 'pluranza.payments.confirm';
			$actionRoutes['refuse']     = 'pluranza.payments.refuse';
			$actions = array_merge($actions, ['confirm', 'refuse']);
		}

		$this->setDefaultActions($actions);
		$this->setDefaultActionRoutes($actionRoutes);
	}

	public function setBodyTableSettings()
	{
		$this->collection->searchColumns('Monto', 'Fecha', 'Código de referencia', 'Estatús', 'Competidor', 'Academia');
		$this->collection->orderColumns('Monto', 'Fecha', 'Estatús', 'Competidor', 'Academia');

		$this->collection->addColumn('Agregada', function($model)
		{		
			return $model->created_at->timestamp;
		});

		$this->collection->addColumn('Voucher', function($model)
		{
			return '<a target="_blank" href="' . $model->voucher->url() . '"><img src="' . $model->voucher->url('thumb') . '" alt="' . ($model->competitor ? $model->competitor->name : $model->academy->name) . '"></a>';
		});

		$this->collection->addColumn('Monto', function($model)
		{
			return $model->amountBs;
		});

		$this->collection->addColumn('Fecha', function($model)
		{
			return $model->pay_date_es;
		});

		$this->collection->addColumn('Código de referencia', function($model)
		{
			return $model->reference_code;
		});

		$this->collection->addColumn('Estatús', function($model)
		{
			if($model->status == 'accept')
				return "<p style='color: green; font-weight: bold;'>" . $model->statusEsp . "</p>";
			if($model->status == 'refuse')
				return "<p style='color: red; font-weight: bold;'>" . $model->statusEsp . "</p>";
			if($model->status == 'pending')
				return "<p style='color: blue; font-weight: bold;'>" . $model->statusEsp . "</p>";
		});

		$this->collection->addColumn('Competidor', function($model)
		{
			if ($model->competitor)
				return $model->competitor->name;
			return $model->academy->name;
		});

		$this->collection->addColumn('Academia', function($model)
		{
			return '<a target="_blank" href="' . route('pluranza.academies.show', $model->academy->id) . '">' . $model->academy->name . '</a>';
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

					$this->addActionColumn("<a  class='confirm btn btn-xs btn-darkGray btn-circle' href='" . route($routes['confirm'], $model->id) . "' id='confirm_" . $model->id . "'><i class='fa fa-check'></i> Confirmar</a>");
					$this->addActionColumn("<a  class='confirm btn btn-xs btn-darkGray btn-circle' href='" . route($routes['refuse'], $model->id) . "' id='refuse_" . $model->id . "'><i class='fa fa-ban'></i> Rechazar</a>");
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

					if (in_array('confirm', $actions)) $this->addActionColumn("<a  class='confirm btn btn-xs btn-darkGray btn-circle' href='" . route($routes['confirm'], $model->id) . "' id='confirm_" . $model->id . "'><i class='fa fa-check'></i> Confirmar</a>");

					if (in_array('refuse', $actions))  $this->addActionColumn("<a  class='confirm btn btn-xs btn-darkGray btn-circle' href='" . route($routes['refuse'], $model->id) . "' id='refuse_" . $model->id . "'><i class='fa fa-ban'></i> Rechazar</a>");
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