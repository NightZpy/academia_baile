<?php
namespace App\DataTables\Pluranza;

use App\DataTables\BaseDataTable;
use Entrust;

class CompetitorDataTable extends BaseDataTable
{
	function __construct() {
		$columns = [
			'Nombre',
			'Género',
			'Nivel',
			'Categoría',
			'Canción',
			'Acciones'
		];

		if (!Entrust::hasRole('director'))
			$this->columns = ['Academia'];

		if (!Entrust::hasRole('director'))
			$this->columns = array_merge(['Academia'], $columns);
		else
			$this->columns = $columns;

		if (Entrust::hasRole('director') &&
			(
				request()->route()->getName() == 'pluranza.competitors.by-academy' ||
				request()->route()->getName() == 'pluranza.competitors.api.by-academy')
			) {
			$array = array_slice($this->columns, 0, count($this->columns) - 1, true);
			array_push($array, 'Precio');
			array_push($array, 'Acciones');
			$this->columns = $array;
		}

		$this->defaultConfig();
		$this->setRoute('pluranza.competitors.api.list');
		$actionRoutes = ['show' => 'pluranza.competitors.show'];
		$actions = ['show'];

		if (Entrust::hasRole(['admin', 'director'])) {
			if (Entrust::hasRole('admin') ||
				request()->route()->getName() == 'pluranza.competitors.by-academy' ||
				request()->route()->getName() == 'pluranza.competitors.api.by-academy') {
				$actions = array_merge($actions, ['edit', 'delete']);
				$actionRoutes['edit'] = 'pluranza.competitors.edit';
				$actionRoutes['delete'] = 'pluranza.competitors.delete';
			}
		}
		$this->setDefaultActions($actions);
		$this->setDefaultActionRoutes($actionRoutes);
	}

	public function setBodyTableSettings()
	{
		$filters = $this->columns;
		unset($filters[count($filters) - 1]);
		if (!Entrust::hasRole('director'))
			$filters = array_merge(['Academia'], $filters);

		$this->collection->searchColumns($filters);
		$this->collection->orderColumns($filters);

		if (!Entrust::hasRole('director')) {
			$this->collection->addColumn('Academia', function($model)
			{
				return $model->academy->name;
			});
		}

		$this->collection->addColumn('Nombre', function($model)
		{
			return $model->name;
		});

		$this->collection->addColumn('Género', function($model)
		{
			return $model->category->name;
		});

		$this->collection->addColumn('Nivel', function($model)
		{
			return ucfirst($model->level->name);
		});

		$this->collection->addColumn('Categoría', function($model)
		{
			return $model->competitionType->name;
		});

		$this->collection->addColumn('Canción', function($model)
		{
			return '<a target="_blank" href="' . $model->song->url() . '">' . $model->song_name . '</a>';
		});


		if (Entrust::hasRole('director') && request()->route()->getName() == 'pluranza.competitors.api.by-academy') {
			$this->collection->addColumn('Precio', function ($model) {
				return $model->competitionCategory->priceBs;
			});
		}
	}

	public function getByAcademyTable($params = [])
	{
		return $this->getAllTable('pluranza.competitors.api.by-academy', $params);
	}
}