<?php
namespace App\DataTables;

use Datatable;
use Illuminate\Database\Eloquent\Collection;

class BaseDataTable {
	protected $columns;
	protected $actionColums = array();
	protected $collection;
	protected $route;
	protected $dataTable;

	/**
	 * BaseDataTable constructor.
	 * @param $columns
	 */
	public function defaultConfig() {
		$this->dataTable = Datatable::table()
			->setOptions(array(
				'dom' =>"T<'clear'>lfrtip",
				'tabletools' => array(
					"aButtons" => array("print", "pdf", "xls"),
					"buttons" => [ "copy", "csv", "xls", "pdf", ["type"=> "print", "buttonText" => "Print me!" ]]
				),
				'language' => array(
					'url' => '/assets/plugins/datatables/lang/Spanish.json'
				)
			));
	}

	public function getColumnCount()
	{
		return count($this->columns);
	}

	public function setRoute($route)
	{
		$this->route = $route;
	}

	/*
	************************** DATATABLE COLLECTION METHODS *********************************
	*/
	public function setDefaultActionColumn($routes, $actions = array('all')) {

		$this->addColumnToCollection('Acciones', function($model) use ($routes, $actions)
		{
			$this->cleanActionColumn();

			if (in_array('all', $actions)) {
				$this->addActionColumn("<a class='show btn btn-xs btn-info btn-circle' href='" . route($routes['show'], $model->id) . "' id='show_".$model->id."'><i class='fa fa-user'></i> Ver</a>");
				$this->addActionColumn("<a  class='edit btn btn-xs btn-success btn-circle' href='" . route($routes['edit'], $model->id) . "' id='edit_" . $model->id . "'><i class='fa fa-pencil'></i> Editar</a>");

				$deleteForm = '<form method="POST" action="' . route($routes['delete'], $model->id) . '" accept-charset="UTF-8">';
				$deleteForm .= '<input name="_method" type="hidden" value="DELETE">';
				$deleteForm .= '<input name="_token" type="hidden" value="' . csrf_token() . '">';
				$deleteForm .= '<button type="submit" class="delete btn btn-xs btn-primary btn-circle"><i class="fa fa-trash"></i> Eliminar</button>';
				$deleteForm .= '</form>';
				$this->addActionColumn($deleteForm);
			} else {
				if (in_array('show', $actions))
					$this->addActionColumn("<a class='show btn btn-xs btn-info btn-circle' href='" . route($routes['show'], $model->id) . "' id='show_".$model->id."'><i class='fa fa-user'></i> Ver</a>");

				if (in_array('edit', $actions))
					$this->addActionColumn("<a  class='edit btn btn-xs btn-success btn-circle' href='" . route($routes['edit'], $model->id) . "' id='edit_".$model->id."'><i class='fa fa-pencil'></i> Editar</a>");

				if (in_array('delete', $actions)) {
					$deleteForm = '<form method="POST" action="' . route($routes['delete'], $model->id) . '" accept-charset="UTF-8">';
					$deleteForm .= '<input name="_method" type="hidden" value="DELETE">';
					$deleteForm .= '<input name="_token" type="hidden" value="' . csrf_token() . '">';
					$deleteForm .= '<button type="submit" class="delete btn btn-xs btn-primary btn-circle"><i class="fa fa-trash"></i> Eliminar</button>';
					$deleteForm .= '</form>';
					$this->addActionColumn($deleteForm);
				}
			}
			return implode(" ", $this->getActionColumn());
		});
	}

	public function getAllTable($route = null, $params = array(), $orderColumn = 1, $type = 'asc', $tableId = 'datatable')
	{
		if(!$route)
			$route = $this->route;

		$this->dataTable->addColumn($this->columns);
		$this->dataTable->setOptions('order', [[$orderColumn , $type]]);
		//$this->dataTable->setCustomValues('table-id', 'datatable-' . $tableId);
		if($tableId != 'datatable')
			$this->dataTable->setId('datatable-' . $tableId);
		$this->dataTable->setUrl(route($route, $params));
		$this->dataTable->noScript();
		return $this->dataTable;
	}

	public function setCollection($collection)
	{
		$this->collection = Datatable::collection($collection);
	}

	public function setDatatableCollection(Collection $collection)
	{
		$this->collection = Datatable::collection($collection);
	}

	public function addColumnToCollection($name, $content)
	{
		$this->collection->addColumn($name, $content);
	}

	public function addActionColumn($column)
	{
		$this->actionColums[] = $column;
	}

	public function getActionColumn()
	{
		return $this->actionColums;
	}

	public function cleanActionColumn()
	{
		unset($this->actionColums);
		$this->actionColums = array();
	}

	public function getTableCollectionForRender() {
		return $this->collection->make();
	}

	public function getDefaultTable(Collection $collection)
	{
		$this->setDatatableCollection($collection);
		$this->setDefaultTableSettings();
		return $this->getTableCollectionForRender();
	}

	public function setDefaultTableSettings()
	{
		$this->setBodyTableSettings();
		$this->setDefaultActionColumn();
	}

	public function setBodyTableSettings(){}
}

