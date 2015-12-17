<?php
namespace App\Repository;

use App\Pluranza\Dancer;

class DancerRepository extends BaseRepository {
	/**
	 * DancerRepository constructor.
	 */
	public function __construct() {
		$this->setModel(new Dancer);
	}


}

