<?php

namespace App\Http\Controllers\Pluranza;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pluranza\RegisterCompetitionCategoryFormRequest;
use App\Http\Requests\Pluranza\UpdateCompetitionCategoryFormRequest;
use App\Repository\CategoryRepository;
use App\Repository\LevelRepository;
use App\Repository\Pluranza\CompetitionCategoryRepository;

use App\Http\Requests;
use App\Repository\Pluranza\CompetitionTypeRepository;

use Auth;

class CompetitionCategoryController extends Controller
{
    protected $competitionCategoryRepository;
    protected $categoryRepository;
    protected $levelRepository;
    protected $competitionTypeRepository;

    /**
     * CompetitionCategoryController constructor.
     * @param $competitionCategoryRepository
     * @param $categoryRepository
     * @param $levelRepository
     * @param $competitionTypeRepository
     */
    public function __construct(
                                CompetitionCategoryRepository$competitionCategoryRepository,
                                CategoryRepository $categoryRepository,
                                LevelRepository $levelRepository,
                                CompetitionTypeRepository $competitionTypeRepository)
    {
        $this->competitionCategoryRepository = $competitionCategoryRepository;
        $this->categoryRepository = $categoryRepository;
        $this->levelRepository = $levelRepository;
        $this->competitionTypeRepository = $competitionTypeRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = $this->competitionCategoryRepository->dataTable->getAllTable();
        return view('pluranza.competition-categories.index')->with(compact('table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->getAllForSelect();
        $levels = $this->levelRepository->getAllForSelect();
        $competitionTypes = $this->competitionTypeRepository->getAllForSelect();
        return view('pluranza.competition-categories.new')->with(compact('categories', 'levels', 'competitionTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterCompetitionCategoryFormRequest $request)
    {
        $this->competitionCategoryRepository->create($request->all());
        flash()->success('Datos guardados exitosamente!');
        return redirect()->route('pluranza.competition-categories.home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $competitionCategory = $this->competitionCategoryRepository->get($id);
        $categories = $this->categoryRepository->getAllForSelect();
        $levels = $this->levelRepository->getAllForSelect();
        $competitionTypes = $this->competitionTypeRepository->getAllForSelect();
        return view('pluranza.competition-categories.edit')->with(compact('competitionCategory', 'categories', 'levels', 'competitionTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompetitionCategoryFormRequest $request, $id)
    {
        $dancer = $this->competitionCategoryRepository->get($id);
        $dancer->update($request->all());
        flash()->success('Datos actualizados exitosamente!');
        return redirect()->route('pluranza.competition-categories.home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $competitionCategory = $this->competitionCategoryRepository->get($id);
        $competitionCategory->delete();
        flash()->success( 'Categoría de competición eliminada correctamente!');
        return redirect()->back();
    }

	/*
	 * ---------------------- APIs ---------------------
    */
	public function apiList()
	{
		if(request()->ajax())
			return $this->competitionCategoryRepository->getAllDataTable();
	}

    public function apiByCategoryList($id)
    {
        if(request()->ajax())
            return $this->competitionCategoryRepository->getLevelByCategoryForSelect($id);
    }

    public function apiByLevelList($id)
    {
        if(request()->ajax())
            return $this->competitionCategoryRepository->getCompetitionTypeByLevelForSelect($id);
    }

}
