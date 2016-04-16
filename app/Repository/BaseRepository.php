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

	public function  getAll($exclude = null, $fields = null)
	{
		$query = $this->getModel();
		if (count($fields)) 
			foreach ($fields as $order => $field)
				$query->orderBy($field, $order);
		
		if($exclude)
			$query->whereNotIn('id', $exclude);
		return $query->get();
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

	public function count()
	{
		return $this->model->count();
	}

	public function update($data = array()){}
	public function deleteImageDirectory($id){}
}

