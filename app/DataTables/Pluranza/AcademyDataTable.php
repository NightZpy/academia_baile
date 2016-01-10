<?php
namespace App\DataTables\Pluranza;
use App\DataTables\BaseDataTable;
use Entrust;

class AcademyDataTable extends BaseDataTable
{
	function __construct() {
		$this->columns = [
			'Agregada',
			'Logo',
			'Nombre',
			'Fundación',
			'Director',
			'Facebook',
			'Estado'			
		];

		if (\Auth::check())
			array_push($this->columns, 'Acciones');

		$this->defaultConfig();
		$this->setRoute('pluranza.academies.api.list');
		$this->setOrderColumn(0);
		$this->setOrderType('desc');
		$this->setHideColumns([0]);
		$actionRoutes = [
			'show'      => 'pluranza.academies.show',
		];
		$actions = [];//['show'];

		if (Entrust::hasRole('admin')) {
			$actionRoutes['edit']       = 'pluranza.academies.edit';
			$actionRoutes['delete']     = 'pluranza.academies.delete';
			$actionRoutes['confirm']     = 'pluranza.academies.confirm';
			$actionRoutes['send-confirm']     = 'pluranza.academies.resend-confirm-academy';
			$actions = array_merge($actions, ['edit', 'delete', 'confirm', 'send-confirm']);
		}
		$this->setDefaultActions($actions);
		$this->setDefaultActionRoutes($actionRoutes);
	}

	public function setBodyTableSettings()
	{
		$this->collection->searchColumns('Nombre', 'Fundación', 'Director', 'Facebook', 'Estado');
		$this->collection->orderColumns('Nombre', 'Fundación', 'Director', 'Facebook', 'Estado');

		$this->collection->addColumn('Agregada', function($model)
		{
			return $model->created_at->format('d-m-Y H:m:s');
		});

		$this->collection->addColumn('Logo', function($model)
		{
			return '<a target="_blank" href="' . $model->logo->url() . '"><img src="' . $model->logo->url('thumb') . '" alt="' . $model->name . '"></a>';
		});

		$this->collection->addColumn('Nombre', function($model)
		{
			return $model->name;
		});

		$this->collection->addColumn('Fundación', function($model)
		{
			return $model->foundationFormated;
		});

		$this->collection->addColumn('Director', function($model)
		{
			return ($model->firstDirector ? '<a target="_blank" href="' . route('pluranza.dancers.show', $model->firstDirector->id) . '">' . $model->firstDirector->fullName . '</a>' : 'Sin asignar');
		});

		$this->collection->addColumn('Facebook', function($model)
		{
			return ($model->facebook ? '<a target="_blank" href="' . $model->facebook . '">Ver</a>' : 'Sin asignar');
		});

		$this->collection->addColumn('Estado', function($model)
		{
			return ($model->estate ? $model->estate->name : 'Sin asignar');
		});
	}

	/*
	************************** DATATABLE COLLECTION METHODS *********************************
	*/
	public function setDefaultActionColumn() {
		$routes = $this->actionRoutes;
		$actions = $this->actionColums;
		$this->addColumnToCollection('Acciones', function($model) use ($routes, $actions)
		{
			$this->cleanActionColumn();
			$this->addActionColumn("<div class='btn-group btn-group-sm' role='group'>");
			if (in_array('all', $actions)) {
				$this->addActionColumn("<a class='show btn btn-xs btn-warning btn-circle' href='" . route($routes['show'], $model->id) . "' id='show_".$model->id."'><i class='fa fa-user'></i> Ver</a>");
				$this->addActionColumn("<a  class='edit btn btn-xs btn-darkGray btn-circle' href='" . route($routes['edit'], $model->id) . "' id='edit_" . $model->id . "'><i class='fa fa-pencil'></i> Editar</a>");
				$this->addActionColumn("<a  class='edit btn btn-xs btn-darkGray btn-circle' href='" . route($routes['send-confirm'], $model->id) . "' id='send-confirm_" . $model->id . "'><i class='fa fa-pencil'></i> Enviar confirmación</a>");

				$deleteForm = '<form method="POST" action="' . route($routes['delete'], $model->id) . '" accept-charset="UTF-8" style="display: inline;">';
				$deleteForm .= '<input name="_method" type="hidden" value="DELETE">';
				$deleteForm .= '<input name="_token" type="hidden" value="' . csrf_token() . '">';
				$deleteForm .= '<button type="submit" class="delete btn btn-xs btn-primary"><i class="fa fa-trash"></i> Eliminar</button>';
				$deleteForm .= '</form>';
				$this->addActionColumn($deleteForm);
			} else {
				if (in_array('show', $actions))
					$this->addActionColumn("<a class='show btn btn-xs btn-warning btn-circle' href='" . route($routes['show'], $model->id) . "' id='show_".$model->id."'><i class='fa fa-user'></i> Ver</a>");

				if (in_array('edit', $actions))
					$this->addActionColumn("<a  class='edit btn btn-xs btn-darkGray btn-circle' href='" . route($routes['edit'], $model->id) . "' id='edit_".$model->id."'><i class='fa fa-pencil'></i> Editar</a>");

				if (in_array('delete', $actions)) {
					$deleteForm = '<form method="POST" action="' . route($routes['delete'], $model->id) . '" accept-charset="UTF-8"  style="display: inline;">';
					$deleteForm .= '<input name="_method" type="hidden" value="DELETE">';
					$deleteForm .= '<input name="_token" type="hidden" value="' . csrf_token() . '">';
					$deleteForm .= '<button type="submit" class="delete btn btn-xs btn-primary"><i class="fa fa-trash"></i> Eliminar</button>';
					$deleteForm .= '</form>';
					$this->addActionColumn($deleteForm);
				}
				
				if (in_array('confirm', $actions) && !$model->user->isConfirm ) 
					$this->addActionColumn("<a  class='confirm btn btn-xs btn-darkGray btn-circle' href='" . route($routes['confirm'], $model->id) . "' id='confirm_".$model->id."'><i class='fa fa-pencil'></i> Confirmar</a>");

				if (in_array('send-confirm', $actions) && !$model->user->isConfirm ) 
					$this->addActionColumn("<a  class='send-confirm btn btn-xs btn-darkGray btn-circle' href='" . route($routes['send-confirm'], $model->id) . "' id='send-confirm_" . $model->id . "'><i class='fa fa-pencil'></i> Enviar confirmación</a>");
			}
			$this->addActionColumn('</div>');
			return implode(" ", $this->getActionColumn());
		});
	}
}