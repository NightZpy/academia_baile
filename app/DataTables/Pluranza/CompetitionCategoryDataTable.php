<?php
namespace App\DataTables\Pluranza;

use App\DataTables\BaseDataTable;

class CompetitionCategoryDataTable extends BaseDataTable
{
	function __construct() {
		$this->columns = [
			'Categoría',
			'Nivel',
			'Tipo',
			'Precio',
			'Acciones'
		];
		$this->defaultConfig();
		$this->setRoute('pluranza.competition-categories.api.list');
		$actionRoutes = [
			'show'      => 'pluranza.competition-categories.show',
			'edit'      => 'pluranza.competition-categories.edit',
			'delete'    => 'pluranza.competition-categories.delete'
		];
		$this->setDefaultActionRoutes($actionRoutes);
	}

	public function setBodyTableSettings()
	{
		$this->collection->searchColumns('Categoría', 'Nivel', 'Tipo', 'Precio');
		$this->collection->orderColumns('Categoría', 'Nivel', 'Tipo', 'Precio');

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

		$this->collection->addColumn('Precio', function($model)
		{
			return $model->priceBs;
		});
	}
}