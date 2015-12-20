<?php

namespace App\Http\Controllers\Pluranza;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pluranza\RegisterCompetitionTypeFormRequest;
use App\Http\Requests\Pluranza\UpdateCompetitionTypeFormRequest;
use App\Repository\Pluranza\CompetitionTypeRepository;

use App\Http\Requests;

class CompetitionTypeController extends Controller
{
    protected $competitionTypeRepository;

    /**
     * CompetitionTypeController constructor.
     * @param $competitionTypeRepository
     */
    public function __construct(CompetitionTypeRepository $competitionTypeRepository) {
        $this->competitionTypeRepository = $competitionTypeRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = $this->competitionTypeRepository->dataTable->getAllTable();
        return view('pluranza.competition-types.index')->with(compact('table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pluranza.competition-types.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterCompetitionTypeFormRequest $request)
    {
        $this->competitionTypeRepository->create($request->all());
        flash()->success('Datos guardados exitosamente!');
        return redirect()->route('pluranza.competition-types.home');
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
        $competitionType = $this->competitionTypeRepository->get($id);
        return view('pluranza.competition-types.edit')->with(compact('competitionType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompetitionTypeFormRequest $request, $id)
    {
        $dancer = $this->competitionTypeRepository->get($id);
        $dancer->update($request->all());
        flash()->success('Datos actualizados exitosamente!');
        return redirect()->route('pluranza.competition-types.home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $competitionType = $this->competitionTypeRepository->get($id);
        $competitionTypeName = $competitionType->name;
        $competitionType->delete();
        flash()->success( $competitionTypeName . ', ha sido eliminada correctamente!');
        return redirect()->back();
    }

	/*
	 * ---------------------- APIs ---------------------
*/
	public function apiList()
	{
		if(request()->ajax())
			return $this->competitionTypeRepository->getAllDataTable();
	}

}
