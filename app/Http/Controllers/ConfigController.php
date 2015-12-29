<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterConfigFormRequest;
use App\Http\Requests\UpdateConfigFormRequest;
use App\Repository\ConfigRepository;
use App\Http\Requests;

class ConfigController extends Controller
{
    protected $configRepository;

    /**
     * ConfigController constructor.
     * @param $configRepository
     */
    public function __construct(ConfigRepository $configRepository) {
        $this->configRepository = $configRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = $this->configRepository->dataTable->getAllTable();
        return view('configurations.index')->with(compact('table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('configurations.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterConfigFormRequest $request)
    {
        $this->configRepository->create($request->all());
        flash()->success('Datos guardados exitosamente!');
        return redirect()->route('pluranza.home');
        //return redirect()->route('configurations.home');
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
        $configuration = $this->configRepository->get($id);
        return view('configurations.edit')->with(compact('configuration'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateConfigFormRequest $request, $id)
    {
        $configuration = $this->configRepository->get($id);
        $configuration->update($request->all());
        flash()->success('Datos actualizados exitosamente!');
        return redirect()->route('pluranza.home');
        //return redirect()->route('configurations.home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $configuration = $this->configRepository->get($id);
        $configuration->delete();
        flash()->success( 'Configuración eliminada correctamente!');
        return redirect()->back();
    }

	/*
	 * ---------------------- APIs ---------------------
    */
	public function apiList()
	{
		if(request()->ajax())
			return $this->configRepository->getAllDataTable();
	}
}
