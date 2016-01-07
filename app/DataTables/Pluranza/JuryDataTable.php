<?php
namespace App\DataTables\Pluranza;
use App\DataTables\BaseDataTable;


class JuryDataTable extends BaseDataTable
{
	function __construct() {
		$this->columns = [
			'Foto',
			'Nombre',
			'Edad',
			'Email',
			'Género',
			'Géneros de baile',
			'Acciones'
		];

		$this->defaultConfig();
		$this->setRoute('pluranza.jurors.api.list');
		$actionRoutes = ['show' => 'pluranza.jurors.show'];
		$actionRoutes['edit'] = 'pluranza.jurors.edit';
		$actionRoutes['delete'] = 'pluranza.jurors.delete';
		$actions = ['show', 'edit', 'delete'];
		$this->setDefaultActions($actions);
		$this->setDefaultActionRoutes($actionRoutes);
	}

	public function setBodyTableSettings()
	{
		$columns = ['Nombre', 'Edad', 'Edad', 'Email', 'Género', 'Géneros de baile'];

		$this->collection->searchColumns($columns);
		$this->collection->orderColumns($columns);


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

		$this->collection->addColumn('Género', function($model)
		{
			return $model->gender;
		});

		$this->collection->addColumn('Géneros de baile', function($model)
		{
			return $model->categoriesList;
		});
	}
}