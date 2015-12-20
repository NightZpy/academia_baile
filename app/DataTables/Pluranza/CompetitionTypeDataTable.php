<?php
namespace App\DataTables\Pluranza;

use App\DataTables\BaseDataTable;

class CompetitionTypeDataTable extends BaseDataTable
{
	function __construct() {
		$this->columns = [
			'Nombre',
			'Acciones'
		];
		$this->defaultConfig();
		$this->setRoute('pluranza.competition-types.api.list');
		$actionRoutes = [
			'show'      => 'pluranza.competition-types.show',
			'edit'      => 'pluranza.competition-types.edit',
			'delete'    => 'pluranza.competition-types.delete'
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