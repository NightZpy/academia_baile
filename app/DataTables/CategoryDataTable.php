<?php
namespace App\DataTables;

class CategoryDataTable extends BaseDataTable
{
	function __construct() {
		$this->columns = [
			'Foto',
			'Nombre',
			'Acciones'
		];
		$this->defaultConfig();
		$this->setRoute('categories.api.list');
		$actionRoutes = [
			'show'      => 'categories.show',
			'edit'      => 'categories.edit',
			'delete'    => 'categories.delete'
		];
		$this->setDefaultActionRoutes($actionRoutes);
	}

	public function setBodyTableSettings()
	{
		$this->collection->searchColumns('Nombre');
		$this->collection->orderColumns('Nombre');

		$this->collection->addColumn('Foto', function($model)
		{
			return '<img src="' . $model->photo->url('thumb') . '" alt="' . $model->name . '">';
		});

		$this->collection->addColumn('Nombre', function($model)
		{
			return $model->name;
		});
	}
}