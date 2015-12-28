<?php
namespace App\DataTables\Pluranza;
use App\DataTables\BaseDataTable;

class DancerDataTable extends BaseDataTable
{
	function __construct() {
		$this->columns = [
			'Foto',
			'Nombre',
			'Edad',
			'Email',
			/*'Categoría',
			'Nivel',*/
			'Acciones'
		];
		$this->defaultConfig();
		$this->setRoute('pluranza.dancers.api.list');
		$actionRoutes = [
			'show'      => 'pluranza.dancers.show',
			'edit'      => 'pluranza.dancers.edit',
			'delete'    => 'pluranza.dancers.delete'
		];
		$this->setDefaultActionRoutes($actionRoutes);
	}

	public function setBodyTableSettings()
	{
		$this->collection->searchColumns('Nombre', 'Edad', 'Email'/*, 'Categoría', 'Nivel'*/);
		$this->collection->orderColumns('Nombre', 'Edad', 'Email'/*, 'Categoría', 'Nivel'*/);

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

		$this->collection->addColumn('Email', function($model)
		{
			return $model->email;
		});

		/*$this->collection->addColumn('Categoría', function($model)
		{
			return 'categoría';
		});

		$this->collection->addColumn('Nivel', function($model)
		{
			return 'nivel';
		});*/
	}

	public function getByAcademyTable($params = [])
	{
		return $this->getAllTable('pluranza.dancers.api.by-academy', $params);
	}
}