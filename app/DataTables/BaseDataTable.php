<?php
namespace App\DataTables;

use Datatable;
use Illuminate\Database\Eloquent\Collection;

class BaseDataTable {
	protected $columns;
	protected $actionColums = array();
	protected $collection;
	protected $listAllRoute;

	public function getColumnCount()
	{
		return count($this->columns);
	}

	public function setListAllRoute($listAllRoute)
	{
		$this->listAllRoute = $listAllRoute;
	}

	/*
	************************** DATATABLE COLLECTION METHODS *********************************
	*/
	public function setDefaultActionColumn($routes, $actions = array('all')) {

		$this->addColumnToCollection('Acciones', function($model) use ($routes, $actions)
		{
			$this->cleanActionColumn();

			if (in_array('all', $actions)) {
				$this->addActionColumn("<a  class='edit btn btn-xs btn-success btn-circle' href='" . route($routes('edit'), $model->id) . "' id='edit_".$model->id."'><i class='fa fa-pencil-circle'></i></a><br />");
				$this->addActionColumn("<a class='delete btn btn-xs btn-warning btn-circle' href='#' id='delete_".$model->id."'><i class='fa fa-minus-circle'></i></a>");
				$this->addActionColumn("<a class='show btn btn-xs btn-primary btn-circle' href='" . route($routes('show'), $model->id) . "' id='show_".$model->id."'><i class='fa fa-eye'></i></a><br />");
			} else {
				if (in_array('edit', $actions))
					$this->addActionColumn("<a  class='edit btn btn-xs btn-success btn-circle' href='" . route($routes('edit'), $model->id) . "' id='edit_".$model->id."'><i class='fa fa-pencil-circle'></i></a><br />");

				if (in_array('delete', $actions)) {
					$this->addActionColumn("<a class='delete btn btn-xs btn-warning btn-circle' href='#' id='delete_".$model->id."'><i class='fa fa-minus-circle'></i></a>");
				}

				if (in_array('show', $actions))
					$this->addActionColumn("<a class='show btn btn-xs btn-primary btn-circle' href='" . route($routes('show'), $model->id) . "' id='show_".$model->id."'><i class='fa fa-eye'></i></a><br />");
			}
			return implode(" ", $this->getActionColumn());
		});
	}

	public function getAllTable($route = null, $params = array(), $orderColumn = 1, $type = 'asc', $tableId = 'datatable')
	{
		if(!$route)
			$route = $this->listAllRoute;

		$datatable = Datatable::table();
		$datatable->addColumn($this->columns);
		$datatable->setOptions('order', [[$orderColumn , $type]]);
		//$datatable->setCustomValues('table-id', 'datatable-' . $tableId);
		if($tableId != 'datatable')
			$datatable->setId('datatable-' . $tableId);
		$datatable->setUrl(route($route, $params));
		$datatable->noScript();
		return $datatable;
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

