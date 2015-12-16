<?php
namespace App\DataTables;
use App\Pluranza;
use yajra\Datatables\Datatables;
use yajra\Datatables\

class DancerDataTable extends DataTables
{
	protected $queryDef;

	public function setQuery($query)
	{
		$this->queryDef = $query;
	}

	// protected $printPreview = 'path-to-print-preview-view';
	// protected $exportColumns = ['id', 'name'];
	/**
	 * Display ajax response.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function ajax()
	{
		return $this->datatables
			->eloquent($this->query())
			->make(true);
	}
	/**
	 * Get the query object to be processed by datatables.
	 *
	 * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
	 */
	public function query()
	{
		return $this->queryDef;
	}
	/**
	 * Optional method if you want to use html builder.
	 *
	 * @return \Yajra\Datatables\Html\Builder
	 */
	public function html()
	{
		return $this->builder()
			->columns([
				'id',
				'name',
				'email',
				'bird_date',
				'created_at',
				'updated_at',
			])
			->parameters([
				'dom' => 'Bfrtip',
				'buttons' => ['csv', 'excel', 'pdf', 'print', 'reset', 'reload'],
			]);
	}
}