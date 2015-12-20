<?php

namespace App\Http\Controllers\Pluranza;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pluranza\RegisterCompetitionCategoryFormRequest;
use App\Http\Requests\Pluranza\UpdateCompetitionCategoryFormRequest;
use App\Repository\Pluranza\CompetitionCategoryRepository;

use App\Http\Requests;

class CompetitionCategoryController extends Controller
{
    protected $competitionCategoryRepository;

    /**
     * CompetitionCategoryController constructor.
     * @param $competitionCategoryRepository
     */
    public function __construct(CompetitionCategoryRepository $competitionCategoryRepository) {
        $this->competitionCategoryRepository = $competitionCategoryRepository;
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
        return view('pluranza.competition-categories.new');
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
        return view('pluranza.competition-categories.edit')->with(compact('competitionCategory'));
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

}
