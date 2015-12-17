<?php
namespace App\Repository\Pluranza;

use App\DataTables\Pluranza\AcademyDataTable;
use App\Pluranza\Academy;
use App\Repository\BaseRepository;

class AcademyRepository extends BaseRepository {

	protected $academyDataTable;

	/**
	 * DancerRepository constructor.
	 */
	public function __construct(AcademyDataTable $academyDataTable) {
		$this->setModel(new Academy);
		$this->academyDataTable = $academyDataTable;
	}
}

