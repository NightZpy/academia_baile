<?php
namespace App\DataTables;

class CompetitionTypeDataTable extends BaseDataTable
{
	function __construct() {
		$this->columns = [
			'Nombre',
			'Acciones'
		];
		$this->defaultConfig();
		$this->setRoute('competition-types.api.list');
		$actionRoutes = [
			'show'      => 'competition-types.show',
			'edit'      => 'competition-types.edit',
			'delete'    => 'competition-types.delete'
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