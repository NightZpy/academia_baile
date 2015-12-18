<?php
namespace App\Repository;

use App\Category;
use App\DataTables\CategoryDataTable;

class CategoryRepository extends BaseRepository {

	public $dataTable;

	/**
	 * DancerRepository constructor.
	 */
	public function __construct(CategoryDataTable $dataTable) {
		$this->setModel(new Category);
		$this->dataTable = $dataTable;
	}

	public function getByAcademyTable($id)
	{
		$academy = new AcademyRepository(new AcademyDataTable);
		$dancers = $academy->get($id)->dancers;
		$this->dataTable->setDatatableCollection($dancers);
		$this->dataTable->setBodyTableSettings();

		$actionRoutes = [
			'show'      => 'pluranza.dancers.show',
			'edit'      => 'pluranza.dancers.edit',
			'delete'    => 'pluranza.dancers.delete'
		];

		$this->dataTable->setDefaultActionColumn($actionRoutes);
		return $this->dataTable->getTableCollectionForRender();

	}
}

