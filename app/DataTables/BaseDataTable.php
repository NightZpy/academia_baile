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
					'url' => 'https://cdn.datatables.net/plug-ins/1.10.10/i18n/Spanish.json'
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
				$this->addActionColumn("<a class='show btn btn-xs btn-info btn-circle' href='" . route($routes['show'], $model->id) . "' id='show_".$model->id."'><i class='fa fa-trash'></i> Ver</a>");
				$this->addActionColumn("<a  class='edit btn btn-xs btn-success btn-circle' href='" . route($routes['edit'], $model->id) . "' id='edit_" . $model->id . "'><i class='fa fa-pencil'></i> Editar</a>");
				$this->addActionColumn("<a class='delete btn btn-xs btn-primary btn-circle' href='#' id='delete_".$model->id."'><i class='fa fa-trash'></i> Eliminar</a>");
			} else {
				if (in_array('show', $actions))
					$this->addActionColumn("<a class='show btn btn-xs btn-info btn-circle' href='" . route($routes['show'], $model->id) . "' id='show_".$model->id."'><i class='fa fa-user'></i> Ver</a>");

				if (in_array('edit', $actions))
					$this->addActionColumn("<a  class='edit btn btn-xs btn-success btn-circle' href='" . route($routes['edit'], $model->id) . "' id='edit_".$model->id."'><i class='fa fa-pencil'></i> Editar</a>");

				if (in_array('delete', $actions)) {
					$this->addActionColumn("<a class='delete btn btn-xs btn-primary btn-circle' href='#' id='delete_".$model->id."'><i class='fa fa-trash'></i> Eliminar</a>");
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

	public function getDefaultTableForAll()
	{
		$collection = $this->getAll();
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

