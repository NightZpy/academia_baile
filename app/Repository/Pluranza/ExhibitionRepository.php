<?php
namespace App\Repository\Pluranza;

use App\DataTables\Pluranza\AcademyDataTable;
use App\Pluranza\CompetitionType;
use App\Pluranza\Exhibition;
use App\Configuration;
use App\DataTables\Pluranza\ExhibitionDataTable;
use App\Repository\BaseRepository;
use Auth;
use Entrust;

class ExhibitionRepository extends BaseRepository {

	protected $competitionCategoryRepository;

	/**
	 * DancerRepository constructor.
	 */
	public function __construct(ExhibitionDataTable $dataTable, CompetitionCategoryRepository $competitionCategoryRepository) {
		$this->setModel(new Exhibition);
		$this->dataTable = $dataTable;
		$this->competitionCategoryRepository = $competitionCategoryRepository;
	}

	public function create($data = array())
	{
		$exhibition = parent::create($data);		
		$exhibition->dancers()->attach($data['dancer_id']);
		$exhibition->genres()->attach($data['gender_id']);
		return $exhibition;
	}

	public function updateCustom($data = array(), $id)
	{
		$exhibition = $this->get($id);
		$exhibition->update($data);
		$exhibition->dancers()->sync($data['dancer_id']);
		$exhibition->genres()->sync($data['gender_id']);
		return $exhibition;
	}

	public function getByAcademy($id)
	{
		$academy = new AcademyRepository(new AcademyDataTable);
		return $academy->get($id)->exhibitions;
	}

	public function getByAcademyDataTable($id)
	{
		if (Entrust::hasRole(['director']) && !Auth::user()->ownerOfAcademy($id)) {
			$actions = []; //['show'];
			$this->dataTable->setDefaultActions($actions);
		}
		$exhibitions = $this->getByACademy($id);
		$this->dataTable->setDatatableCollection($exhibitions);
		return $this->dataTable->getDefaultTable($exhibitions);
	}

	public function getAutomaticName($academyId = null)
	{
		if ($academyId > 0) {
			\Debugbar::info('AcademyId > 0');
			$academyRepository = new AcademyRepository( new AcademyDataTable);
			$academy = $academyRepository->get($academyId);
			$quantity = $academy->exhibitions->count();			
			if ( $quantity ) {
				$lastName = $academy->exhibitions
									->orderBy('exhibitions.created_at', 'desc')
								    ->first()
								    ->name;
				$name = 'Exhibición - ' . $academy->name . ' - ' . (filter_var($lastName, FILTER_SANITIZE_NUMBER_INT) + 1);		
			} else {
				$name = 'Exhibición - ' . $academy->name . ' - 1';
			}
			return $name;			
		}
		return 'Exhibición';
	}

	public function getGenres($id)
	{
		return $this->get($id)->genres;
	}

	public function getSelectedGenres($id)
	{
		return $this->getGenres($id)->lists('id')->toArray();
	}

	public function getDancers($id)
	{
		return $this->get($id)->dancers;
	}

	public function getSelectedDancers($id)
	{
		return $this->getDancers($id)->lists('id')->toArray();
	}

}

