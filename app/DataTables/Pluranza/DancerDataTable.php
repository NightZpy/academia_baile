<?php
namespace App\DataTables\Pluranza;
use App\DataTables\BaseDataTable;
use Entrust;
use Auth;

class DancerDataTable extends BaseDataTable
{
	function __construct() {
		$columns = [
			'Foto',
			'Nombre',
			'Edad',
			//'Email',
			'Acciones'
		];

		if (!Entrust::hasRole('director'))
			$this->columns = array_merge(['Academia'], $columns);
		else
			$this->columns = $columns;

		$this->defaultConfig();
		$this->setRoute('pluranza.dancers.api.list');
		$actionRoutes = ['show' => 'pluranza.dancers.show'];
		$actions = ['show'];

		if (Entrust::hasRole(['admin', 'director'])) {
			if (Entrust::hasRole('admin') ||
				(request()->route()->getName() == 'pluranza.dancers.by-academy' ||
				request()->route()->getName() == 'pluranza.dancers.api.by-academy'))
			{
				$actions = array_merge($actions, ['edit', 'delete']);
				$actionRoutes['edit'] = 'pluranza.dancers.edit';
				$actionRoutes['delete'] = 'pluranza.dancers.delete';
			}
		}
		$this->setDefaultActions($actions);
		$this->setDefaultActionRoutes($actionRoutes);
	}

	public function setBodyTableSettings()
	{
		$columns = ['Nombre', 'Edad'/*, 'Email'*/];
		if (!Entrust::hasRole('director'))
			$columns = array_merge(['Academia'], $columns);

		$this->collection->searchColumns($columns);
		$this->collection->orderColumns($columns);

		if (!Entrust::hasRole('director')) {
			$this->collection->addColumn('Academia', function($model)
			{
				return $model->academy->name;
			});
		}

		$this->collection->addColumn('Foto', function($model)
		{
			return '<a target="_blank" href="' . $model->photo->url() . '"><img src="' . $model->photo->url('thumb') . '" alt="' . $model->fullName . '"></a>';
		});

		$this->collection->addColumn('Nombre', function($model)
		{
			return $model->fullName;
		});

		$this->collection->addColumn('Edad', function($model)
		{
			return $model->age;
		});

		/*$this->collection->addColumn('Email', function($model)
		{
			return $model->email;
		});*/
	}

	public function getByAcademyTable($params = [])
	{
		return $this->getAllTable('pluranza.dancers.api.by-academy', $params);
	}
}