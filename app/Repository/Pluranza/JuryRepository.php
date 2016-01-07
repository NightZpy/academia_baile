<?php
namespace App\Repository\Pluranza;

use App\DataTables\Pluranza\AcademyDataTable;
use App\DataTables\Pluranza\JuryDataTable;
use App\Pluranza\Jury;
use App\Repository\BaseRepository;

class JuryRepository extends BaseRepository {

	/**
	 * JuryRepository constructor.
	 */
	public function __construct(JuryDataTable $dataTable) {
		$this->setModel(new Jury);
		$this->dataTable = $dataTable;
	}

	public function getByAcademy($id)
	{
		$academy = new AcademyRepository(new AcademyDataTable);
		return $academy->get($id)->dancers;
	}

	public function getByAcademyDataTable($id)
	{
		$academy = new AcademyRepository(new AcademyDataTable);
		$dancers = $academy->get($id)->dancers;
		$this->dataTable->setDatatableCollection($dancers);
		return $this->dataTable->getDefaultTable($dancers);
	}

	public function create($data = array())
	{
		$jury = parent::create($data);
		/*if ($jury) {
			Role::whereName('admin')->first()
		}*/
		return $jury;
	}
}

