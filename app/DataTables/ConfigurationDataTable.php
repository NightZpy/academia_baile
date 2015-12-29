<?php
namespace App\DataTables;

class ConfigurationDataTable extends BaseDataTable
{
	function __construct() {
		$this->columns = [
			'Reglas',
			'Max. número de competidores',
			'Acciones'
		];
		$this->defaultConfig();
		$this->setRoute('configurations.api.list');
		$actionRoutes = [
			'show'      => 'configurations.show',
			'edit'      => 'configurations.edit',
			'delete'    => 'configurations.delete'
		];
		$this->setDefaultActionRoutes($actionRoutes);
	}

	public function setBodyTableSettings()
	{
		$this->collection->searchColumns('Max. número de competidores');
		$this->collection->orderColumns('Max. número de competidores');

		$this->collection->addColumn('Reglas', function($model)
		{
			return '<a target="_blank" href="' . $model->rules->url() . '"></a>';
		});

		$this->collection->addColumn('Max. número de competidores', function($model)
		{
			return $model->max_competitors;
		});
	}
}