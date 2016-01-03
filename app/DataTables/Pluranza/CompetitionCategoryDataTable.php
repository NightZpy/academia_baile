<?php
namespace App\DataTables\Pluranza;

use App\DataTables\BaseDataTable;

class CompetitionCategoryDataTable extends BaseDataTable
{
	function __construct() {
		$this->columns = [
			'Categoría',
			'Nivel',
			'Género',
			'Precio',
			'Acciones'
		];
		$this->defaultConfig();
		$this->setRoute('pluranza.competition-categories.api.list');
		$this->setOrderColumn(0);
		$this->setOrderType('asc');
		$actionRoutes = [
			'show'      => 'pluranza.competition-categories.show',
			'edit'      => 'pluranza.competition-categories.edit',
			'delete'    => 'pluranza.competition-categories.delete'
		];
		$this->setDefaultActionRoutes($actionRoutes);
	}

	public function setBodyTableSettings()
	{
		$this->collection->searchColumns('Categoría', 'Nivel', 'Género', 'Precio');
		$this->collection->orderColumns('Categoría', 'Nivel', 'Género', 'Precio');

		$this->collection->addColumn('Categoría', function($model)
		{
			return $model->competitionType->name;
		});

		$this->collection->addColumn('Nivel', function($model)
		{
			return $model->level->name;
		});

		$this->collection->addColumn('Género', function($model)
		{
			return $model->category->name;
		});


		$this->collection->addColumn('Precio', function($model)
		{
			return $model->priceBs;
		});
	}
}