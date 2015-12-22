<?php
namespace App\DataTables\Pluranza;

use App\DataTables\BaseDataTable;

class CompetitorDataTable extends BaseDataTable
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
		$this->setRoute('pluranza.competitors.api.list');
		$actionRoutes = [
			'show'      => 'pluranza.competitors.show',
			'edit'      => 'pluranza.competitors.edit',
			'delete'    => 'pluranza.competitors.delete'
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

	public function getByAcademyTable($params = [])
	{
		return $this->getAllTable('pluranza.competitors.api.by-academy', $params);
	}
}