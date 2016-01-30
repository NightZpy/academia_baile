<?php
namespace App\DataTables\Pluranza;

use App\DataTables\BaseDataTable;
use App\Repository\Pluranza\CompetitorRepository;
use App\DataTables\Pluranza\CompetitorDatatable;

class CompetitionCategoryDataTable extends BaseDataTable
{
	function __construct() {
		$this->columns = [
			'Categoría',
			'Nivel',
			'Género',
			'Precio',			
		];

		if (\Entrust::hasRole('admin')) 
			$this->columns = array_merge($this->columns, ['Inscritos', 'Acciones']);

		$this->defaultConfig();
		$this->setRoute('pluranza.competition-categories.api.list');
		$this->setOrderColumn(0);
		$this->setOrderType('desc');
		$actionRoutes = [
			'show'      => 'pluranza.competition-categories.show',
			'edit'      => 'pluranza.competition-categories.edit',
			'delete'    => 'pluranza.competition-categories.delete'
		];		

		if (!\Entrust::hasRole('admin'))
			$this->setDefaultActions([]);
		
		$this->setDefaultActionRoutes($actionRoutes);
	}

	public function setBodyTableSettings()
	{
		$competitorRepository = new CompetitorRepository(new CompetitorDatatable)

		$this->collection->searchColumns('Categoría', 'Nivel', 'Género', 'Precio');
		$this->collection->orderColumns('Categoría', 'Nivel', 'Género', 'Precio');

		$this->collection->addColumn('Categoría', function($model)
		{
			return $model->competitionType->name;
		});

		$this->collection->addColumn('Nivel', function($model)
		{
			return $model->level->name;
		});

		$this->collection->addColumn('Género', function($model)
		{
			return $model->category->name;
		});


		$this->collection->addColumn('Precio', function($model)
		{
			return $model->priceBs;
		});

		$this->collection->addColumn('Inscritos', function($model) use ($competitorRepository)
		{
			return $competitorRepository->countByCompetitionCategory($model->id);
		});
	}
}