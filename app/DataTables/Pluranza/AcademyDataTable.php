<?php
namespace App\DataTables\Pluranza;
use App\DataTables\BaseDataTable;

class AcademyDataTable extends BaseDataTable
{
	function __construct() {
		$this->columns = [
			'Foto',
			'Nombre',
			'Edad',
			'Email',
			'Categoría',
			'Nivel',
			'Acciones'
		];
		$this->setListAllRoute('pluranza.academies.api.list');
	}

	public function setBodyTableSettings()
	{
		$this->collection->searchColumns('Nombre', 'Edad', 'Email', 'Categoría', 'Nivel');
		$this->collection->orderColumns('Nombre', 'Edad', 'Email', 'Categoría', 'Nivel');

		$this->collection->addColumn('Foto', function($model)
		{
			return '<img src="' . $model->photo->url('thumb') . '" alt="' . $model->fullName . '">';
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

		$this->collection->addColumn('Categoría', function($model)
		{
			return 'categoría';
		});

		$this->collection->addColumn('Nivel', function($model)
		{
			return 'nivel';
		});
	}
}