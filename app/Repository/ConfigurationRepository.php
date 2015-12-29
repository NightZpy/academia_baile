<?php
namespace App\Repository;

use App\Configuration;
use App\DataTables\ConfigurationDataTable;

class ConfigurationRepository extends BaseRepository {

	public $dataTable;

	/**
	 * DancerRepository constructor.
	 */
	public function __construct(ConfigurationDataTable $dataTable) {
		$this->setModel(new Configuration);
		$this->dataTable = $dataTable;
	}
}

