<?php
namespace App\Repository\Pluranza;

use App\DataTables\Pluranza\AcademyDataTable;
use App\Pluranza\Academy;
use App\Repository\BaseRepository;

class AcademyRepository extends BaseRepository {

	public $dataTable;

	/**
	 * DancerRepository constructor.
	 */
	public function __construct(AcademyDataTable $academyDataTable) {
		$this->setModel(new Academy);
		$this->dataTable = $academyDataTable;
	}

	public function getAllDataTable()
	{
		return $this->dataTable->getDefaultTable($this->model->orderBy('created_at', 'DESC')->get());
	}

	public function countVerified() {
		return $this->model->join('users', function($join) {
			$join->on('academies.user_id', '=', 'users.id')
				 ->where('users.verified', '=', 1);
		})->count();
	}

	public function delete($id)
	{
		$academy = $this->get($id);
		$user = $academy->user();
		return $academy->delete() && $user->delete();

	}

	public function confirm($id) {
		$this->get($id)->user->confirmEmail();
	}
}

