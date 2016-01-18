<?php
namespace App\DataTables\Pluranza;

use App\DataTables\BaseDataTable;

class LodgingDataTable extends BaseDataTable
{
	function __construct() {
		$this->columns = [
			'Nombre',
			'Teléfonos',
			'Dirección',
			'Acciones'
		];
		$this->defaultConfig();
		$this->setRoute('pluranza.lodgings.api.list');
		$actionRoutes = [
			'show'      => 'pluranza.lodgings.show',
			'edit'      => 'pluranza.lodgings.edit',
			'delete'    => 'pluranza.lodgings.delete'
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

		$this->collection->addColumn('Teléfonos', function($model)
		{
			return $model->address;
		});

		$this->collection->addColumn('Dirección', function($model)
		{
			return $model->address;
		});
	}
}