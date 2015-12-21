<?php
namespace App\DataTables\Pluranza;

use App\DataTables\BaseDataTable;

class CompetitionGroupDataTable extends BaseDataTable
{
	function __construct() {
		$this->columns = [
			'Foto',
			'Bailarin',
			'Categoría',
			'Nivel',
			'Tipo',
			'Acciones'
		];
		$this->defaultConfig();
		$this->setRoute('pluranza.competition-groups.api.list');
		$actionRoutes = [
			'show'      => 'pluranza.competition-groups.show',
			'edit'      => 'pluranza.competition-groups.edit',
			'delete'    => 'pluranza.competition-groups.delete'
		];
		$this->setDefaultActionRoutes($actionRoutes);
	}

	public function setBodyTableSettings()
	{
		$this->collection->searchColumns('Bailarín', 'Categoría', 'Nivel', 'Tipo');
		$this->collection->orderColumns('Bailarín', 'Categoría', 'Nivel', 'Tipo');

		$this->collection->addColumn('Foto', function($model)
		{
			return '<img src="' . $model->dancer->photo->url('thumb') . '" alt="' . $model->fullName . '">';
		});

		$this->collection->addColumn('Bailarín', function($model)
		{
			return $model->dancer->fullName;
		});

		$this->collection->addColumn('Categoría', function($model)
		{
			return $model->category->name;
		});

		$this->collection->addColumn('Nivel', function($model)
		{
			return $model->level->name;
		});

		$this->collection->addColumn('Tipo', function($model)
		{
			return $model->competitionType->name;
		});
	}
}