<?php
namespace App\DataTables\Pluranza;

use App\DataTables\BaseDataTable;
use Entrust;

class CompetitorDataTable extends BaseDataTable
{
	function __construct() {
		$this->columns = [
			'Nombre',
			'Categoría',
			'Nivel',
			'Tipo',
			'Acciones'
		];
		$this->defaultConfig();
		$this->setRoute('pluranza.competitors.api.list');
		$actionRoutes = ['show' => 'pluranza.competitors.show'];
		$actions = ['show'];

		if (Entrust::hasRole(['admin', 'director'])) {
			$actionRoutes['edit']     = 'pluranza.competitors.edit';
			$actionRoutes['delete']    = 'pluranza.competitors.delete';
			$actions = array_merge($actions, ['edit', 'delete']);
		}
		$this->setDefaultActions($actions);
		$this->setDefaultActionRoutes($actionRoutes);
	}

	public function setBodyTableSettings()
	{
		$this->collection->searchColumns('Nombre', 'Categoría', 'Nivel', 'Tipo', 'Precio');
		$this->collection->orderColumns('Nombre', 'Categoría', 'Nivel', 'Tipo', 'Precio');

		$this->collection->addColumn('Nombre', function($model)
		{
			return $model->name;
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

		$this->collection->addColumn('Precio', function($model)
		{
			return $model->competitionCategory->priceBs;
		});
	}

	public function getByAcademyTable($params = [])
	{
		return $this->getAllTable('pluranza.competitors.api.by-academy', $params);
	}
}