<?php
namespace App\DataTables\Pluranza;

use App\DataTables\BaseDataTable;
use Entrust;

class ExhibitionDataTable extends BaseDataTable
{
	function __construct() {
		$columns = [
			'Academia',
			'Nombre',
			'Generos',
			'Canción',
			'Acciones'
		];

		if (!Entrust::hasRole('director'))
			$this->columns = ['Academia'];

		if (!Entrust::hasRole('director'))
			$this->columns = array_merge(['Academia'], $columns);
		else
			$this->columns = $columns;

		if ((Entrust::hasRole('director') || Entrust::hasRole('admin')) &&
			(
				request()->route()->getName() == 'pluranza.exhibitions.by-academy' ||
				request()->route()->getName() == 'pluranza.exhibitions.api.by-academy')
			) {
			$array = array_slice($this->columns, 0, count($this->columns) - 1, true);
			array_push($array, 'Costo');
			array_push($array, 'Acciones');
			$this->columns = $array;
		}

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