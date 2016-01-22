<?php
namespace App\DataTables;

use Datatable;
use Illuminate\Database\Eloquent\Collection;

class BaseDataTable {

	protected $columns;
	protected $actionColums = array('all');
	protected $collection;
	protected $route;
	protected $actionRoutes;
	protected $dataTable;
	protected $orderColumn;
	protected $orderType;
	protected $hideColumns;

	/**
	 * BaseDataTable constructor.
	 * @param $columns
	 */
	public function defaultConfig() {
		$this->dataTable = Datatable::cTable()
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
		$this->orderColumn = 1;
		$this->orderType = 'asc';
	}

	public function getColumnCount()
	{
		return count($this->columns);
	}

	/**
	 * @return array
	 */
	public function getActionColums()
	{
		return $this->actionColums;
	}

	public function setRoute($route)
	{
		$this->route = $route;
	}

	public function setDefaultActionRoutes($actionRoutes)
	{
		$this->actionRoutes = $actionRoutes;
	}

	public function setDefaultActions($actions = array('all'))
	{
		$this->actionColums = $actions;
	}

	public function setHideColumns($hideColumns) {
		$this->hideColumns = $hideColumns;
	}

	/*
	************************** DATATABLE COLLECTION METHODS *********************************
	*/
	public function setDefaultActionColumn() {
		$routes = $this->actionRoutes;
		$actions = $this->actionColums;
		$this->addColumnToCollection('Acciones', function($model) use ($routes, $actions)
		{
			$this->cleanActionColumn();
			$this->addActionColumn("<div class='btn-group btn-group-sm' role='group'>");
			if (in_array('all', $actions)) {
				$this->addActionColumn("<a class='show btn btn-xs btn-warning btn-circle' href='" . route($routes['show'], $model->id) . "' id='show_".$model->id."'><i class='fa fa-user'></i> Ver</a>");
				$this->addActionColumn("<a  class='edit btn btn-xs btn-darkGray btn-circle' href='" . route($routes['edit'], $model->id) . "' id='edit_" . $model->id . "'><i class='fa fa-pencil'></i> Editar</a>");

				$deleteForm = '<form method="POST" action="' . route($routes['delete'], $model->id) . '" accept-charset="UTF-8" style="display: inline;">';
				$deleteForm .= '<input name="_method" type="hidden" value="DELETE">';
				$deleteForm .= '<input name="_token" type="hidden" value="' . csrf_token() . '">';
				$deleteForm .= '<button type="submit" class="delete btn btn-xs btn-primary"><i class="fa fa-trash"></i> Eliminar</button>';
				$deleteForm .= '</form>';
				$this->addActionColumn($deleteForm);
			} else {
				if (in_array('show', $actions))
					$this->addActionColumn("<a class='show btn btn-xs btn-warning btn-circle' href='" . route($routes['show'], $model->id) . "' id='show_".$model->id."'><i class='fa fa-user'></i> Ver</a>");

				if (in_array('edit', $actions))
					$this->addActionColumn("<a  class='edit btn btn-xs btn-darkGray btn-circle' href='" . route($routes['edit'], $model->id) . "' id='edit_".$model->id."'><i class='fa fa-pencil'></i> Editar</a>");

				if (in_array('delete', $actions)) {
					$deleteForm = '<form method="POST" action="' . route($routes['delete'], $model->id) . '" accept-charset="UTF-8"  style="display: inline;">';
					$deleteForm .= '<input name="_method" type="hidden" value="DELETE">';
					$deleteForm .= '<input name="_token" type="hidden" value="' . csrf_token() . '">';
					$deleteForm .= '<button type="submit" class="delete btn btn-xs btn-primary"><i class="fa fa-trash"></i> Eliminar</button>';
					$deleteForm .= '</form>';
					$this->addActionColumn($deleteForm);
				}
			}
			$this->addActionColumn('</div>');
			return implode(" ", $this->getActionColumn());
		});
	}

	public function getAllTable($route = null, $params = array(), $tableId = 'datatable')
	{
		if(!$route)
			$route = $this->route;

		$this->dataTable->addColumn($this->columns);
		if ($this->orderColumn >= 0)
			$this->dataTable->setOptions('order', [[$this->orderColumn , $this->orderType]]);
		if ($this->hideColumns)
			$this->dataTable->setOptions('columnDefs', [['targets' => $this->hideColumns, 'visible' => false]]);
		//$this->dataTable->setCustomValues('table-id', 'datatable-' . $tableId);
		if($tableId != 'datatable')
			$this->dataTable->setId('datatable-' . $tableId);
		$this->dataTable->setUrl(route($route, $params));
		$this->dataTable->noScript();
		return $this->dataTable;
	}

	/**
	 * @param mixed $orderType
	 * @return BaseDataTable
	 */
	public function setOrderType($orderType)
	{
		$this->orderType = $orderType;
	}

	/**
	 * @param mixed $orderColumn
	 */
	public function setOrderColumn($orderColumn)
	{
		$this->orderColumn = $orderColumn;
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
		$this->setDefaultTableColumns();
		return $this->getTableCollectionForRender();
	}

	public function setDefaultTableColumns()
	{
		$this->setBodyTableSettings();
		$this->setDefaultActionColumn();
	}

	public function setBodyTableSettings(){}
}

