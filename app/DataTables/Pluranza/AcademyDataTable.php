<?php
namespace App\DataTables\Pluranza;
use App\DataTables\BaseDataTable;
use Entrust;

class AcademyDataTable extends BaseDataTable
{
	function __construct() {
		$this->columns = [
			'Logo',
			'Nombre',
			'Fundación',
			'Director',
			'Facebook',
			'Estado',
			'Acciones'
		];
		$this->defaultConfig();
		$this->setRoute('pluranza.academies.api.list');
		$this->setOrderColumn(5);
		$this->setOrderType('desc');
		$actionRoutes = [
			'show'      => 'pluranza.academies.show',
		];
		$actions = ['show'];

		if (Entrust::hasRole('admin')) {
			$actionRoutes['edit']       = 'pluranza.academies.edit';
			$actionRoutes['delete']     = 'pluranza.academies.delete';
			$actions = array_merge($actions, ['edit', 'delete']);
		}
		$this->setDefaultActions($actions);
		$this->setDefaultActionRoutes($actionRoutes);
	}

	public function setBodyTableSettings()
	{
		$this->collection->searchColumns('Nombre', 'Fundación', 'Director', 'Facebook', 'Estado');
		$this->collection->orderColumns('Nombre', 'Fundación', 'Director', 'Facebook', 'Estado');

		$this->collection->addColumn('Logo', function($model)
		{
			return '<img src="' . $model->logo->url('thumb') . '" alt="' . $model->name . '">';
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
			return ($model->director ? $model->director->fullName : 'Sin asignar');
		});

		$this->collection->addColumn('Facebook', function($model)
		{
			return ($model->facebook ? '<a href="' . $model->facebook . '">Ir</a>' : 'Sin asignar');
		});

		$this->collection->addColumn('Estado', function($model)
		{
			return ($model->estate ? $model->estate->name : 'Sin asignar');
		});
	}
}