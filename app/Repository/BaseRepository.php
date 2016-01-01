<?php
namespace App\Repository;

class BaseRepository {
	protected $model;
	public $dataTable;

	public function setModel($model)
	{
		$this->model = $model;
	}

	public function getModel()
	{
		return $this->model;
	}

	public function create($data = array())
	{
		$model = $this->model->create($data);
		return $model;
	}

	public function  getAll($exclude = null)
	{
		if($exclude)
			return $this->getModel()->whereNotIn('id', $exclude)->get();
		return $this->getModel()->all();
	}

	public function getAllForSelect()
	{
		if (!empty($this->model)) {
			if($this->getModel()->first()->nombre)
				return $this->getAll()->lists('nombre', 'id');
			return $this->getAll()->lists('name', 'id');
		}
	}

	public function getAllDataTable()
	{
		return $this->dataTable->getDefaultTable($this->getAll());
	}

	public function delete($id)
	{
		$model = $this->get($id);
		return $model->delete();
	}

	public function get($id)
	{
		return $this->model->findOrFail($id);
	}

	public function update($data = array()){}
	public function deleteImageDirectory($id){}
}

