<?php
namespace App\Repository\Pluranza;

use App\DataTables\Pluranza\AcademyDataTable;
use App\DataTables\Pluranza\DancerDataTable;
use App\Pluranza\Dancer;
use App\Repository\BaseRepository;
use Auth;
use Entrust;

class DancerRepository extends BaseRepository {

	/**
	 * DancerRepository constructor.
	 */
	public function __construct(DancerDataTable $dataTable) {
		$this->setModel(new Dancer);
		$this->dataTable = $dataTable;
	}

	public function getByAcademyDataTable($id)
	{
		$academy = new AcademyRepository(new AcademyDataTable);
		if (Entrust::hasRole(['director']) && !Auth::user()->ownerOfAcademy($id)) {
			$actions = ['show'];
			$this->dataTable->setDefaultActions($actions);
		}
		$dancers = $academy->get($id)->dancers;
		$this->dataTable->setDatatableCollection($dancers);
		return $this->dataTable->getDefaultTable($dancers);
	}

	/*
	* -------------------- Get General Dancers -------------------
	*/
	public function getAllDataTable()
	{
		return $this->dataTable->getDefaultTable($this->model->has('academies')->get());
	}

	public function getByAcademy($id)
	{
		$academyRepository = new AcademyRepository(new AcademyDataTable);
		return $academyRepository->get($id)->dancers;
	}

	public function getByAcademyForSelect($id)
	{
		return $this->getByAcademy($id)->pluck('name', 'id');
	}

	public function getByAcademyCount($id)
	{
		return $this->getByAcademy($id)->count();
	}

	/*
	* -------------------- Get Masculine -------------------
	*/
	public function getMasculineByAcademy($id)
	{
		$academyRepository = new AcademyRepository(new AcademyDataTable);
		return $academyRepository->get($id)->dancers()->masculine()->get();
	}

	public function getMasculineByAcademyForSelect($id)
	{
		return $this->getMasculineByAcademy($id)->pluck('name', 'id');
	}

	public function getMasculineByAcademyCount($id)
	{
		return $this->getMasculineByAcademy($id)->count();
	}

	/*
	* -------------------- Get Female -------------------
	*/
	public function getFemaleByAcademy($id)
	{
		$academyRepository = new AcademyRepository(new AcademyDataTable);
		return $academyRepository->get($id)->dancers()->female()->get();
	}

	public function getFemaleByAcademyForSelect($id)
	{
		return $this->getFemaleByAcademy($id)->pluck('name', 'id');
	}

	public function getFemaleByAcademyCount($id)
	{
		return $this->getFemaleByAcademy($id)->count();
	}
}

