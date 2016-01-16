<?php
namespace App\DataTables\Pluranza;

use App\DataTables\BaseDataTable;
use Entrust;

class ExhibitionDataTable extends BaseDataTable
{
	function __construct() {
		$columns = [
			'Nombre',
			'Generos',
			'Canción'
		];

		\Debugbar::info('Route Name: ' . request()->route()->getName());
		if (request()->route()->getName() == 'pluranza.exhibitions.home' || 
			request()->route()->getName() == 'pluranza.exhibitions.api.list') {
			\Debugbar::info('2.-Route Name: ' . request()->route()->getName());
			$columns = array_merge(['Academia'], $columns);
		}
		\Debugbar::info($this->columns);

		$this->defaultConfig();
		$this->setRoute('pluranza.exhibitions.api.list');
		$actionRoutes = ['show' => 'pluranza.exhibitions.show'];
		$actions = [];//['show'];

		if (Entrust::hasRole(['admin', 'director'])) {
			if (Entrust::hasRole('admin') ||
				request()->route()->getName() == 'pluranza.exhibitions.by-academy' ||
				request()->route()->getName() == 'pluranza.exhibitions.api.by-academy') {
				$actions = array_merge($actions, ['edit', 'delete']);
				$actionRoutes['edit'] = 'pluranza.exhibitions.edit';
				$actionRoutes['delete'] = 'pluranza.exhibitions.delete';
			}
		}

		if (count($actions) > 0)
		{
			array_push($columns, 'Acciones');
		} 
		$this->columns = $columns;
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

		$this->collection->addColumn('Generos', function($model)
		{
			return join(', ', $model->genres->lists('name')->toArray());
		});

		$this->collection->addColumn('Canción', function($model)
		{
			return '<a target="_blank" href="' . $model->song->url() . '">' . $model->song_name . '</a>';
		});
	}

	public function getByAcademyTable($params = [])
	{
		return $this->getAllTable('pluranza.exhibitions.api.by-academy', $params);
	}
}