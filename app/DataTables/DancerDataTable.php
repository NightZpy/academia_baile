<?php
namespace App\DataTables;
use App\Pluranza;
use Yajra\Datatables\Services\DataTable;

class DancerDataTable extends DataTable
{
	protected $queryDef;
	protected $academyFilterId;

	public function setQuery($query)
	{
		$this->queryDef = $query;
	}

	public function setAcademyFilterId($id)
	{
		$this->academyFilterId = $id;
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
		$colums = [
					'id'            =>      ['data' => 'id', 'name' => 'id', 'title' => '#'],
					'name'          =>      ['data' => 'name', 'name' => 'name', 'title' => 'Nombre'],
					'email'         =>      ['data' => 'email', 'name' => 'email', 'title' => utf8_encode ('Correo electrónico')],
					'bird_date'     =>      ['data' => 'bird_date', 'name' => 'bird_date', 'title' => 'Fecha de nacimiento'],
					'created_at'    =>      ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Agregado'],
					'updated_at'    =>      ['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Actualizado']
		];
		return $this->builder()
			->columns($colums)
			->ajax(route('pluranza.dancers.api.list', $this->academyFilterId))
			->parameters([
				'language' => [
					'url' => 'https://cdn.datatables.net/plug-ins/1.10.10/i18n/Spanish.json',
				],
				'dom' => 'Bfrtip',
				'buttons' => ['csv', 'excel', 'pdf', 'print'],
			]);
	}
}