<?php

namespace App\Http\Controllers\Pluranza;

use App\Http\Requests\Pluranza\RegisterLodgingFormRequest;
use App\Http\Requests\Pluranza\UpdateLodgingFormRequest;
use App\Repository\Pluranza\LodgingRepository;

use App\Http\Requests;

class LodgingController extends Controller
{
    protected $repository;

    /**
     * LodgingController constructor.
     * @param $repository
     */
    public function __construct(LodgingRepository $repository) {
        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = $this->repository->dataTable->getAllTable();
        return view('pluranza.lodgings.index')->with(compact('table'));
    }

    public function public()
    {
        $lodgings = $this->repository->getAll();
        return view('pluranza.lodgings.index')->with(compact('lodgings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pluranza.lodgings.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterLodgingFormRequest $request)
    {
        $this->repository->create($request->all());
        flash()->success('Datos guardados exitosamente!');
        return redirect()->route('pluranza.lodgings.home');
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
        $lodging = $this->repository->get($id);
        return view('pluranza.lodgings.edit')->with(compact('lodging'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLodgingFormRequest $request, $id)
    {
        $lodging = $this->repository->get($id);
        $lodging->update($request->all());
        flash()->success('Datos actualizados exitosamente!');
        return redirect()->route('pluranza.lodgings.home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lodging = $this->repository->get($id);
        $lodgingName = $lodging->name;
        $lodging->delete();
        flash()->success( $lodgingName . ', ha sido eliminada correctamente!');
        return redirect()->back();
    }

	/*
	 * ---------------------- APIs ---------------------
*/
	public function apiList()
	{
		if(request()->ajax())
			return $this->repository->getAllDataTable();
	}

}
