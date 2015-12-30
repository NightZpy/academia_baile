<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterConfigurationFormRequest;
use App\Http\Requests\UpdateConfigurationFormRequest;
use App\Repository\ConfigurationRepository;
use App\Http\Requests;

class ConfigurationController extends Controller
{
    protected $configurationRepository;

    /**
     * ConfigController constructor.
     * @param $configurationRepository
     */
    public function __construct(ConfigurationRepository $configurationRepository) {
        $this->configurationRepository = $configurationRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = $this->configurationRepository->dataTable->getAllTable();
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
    public function store(RegisterConfigurationFormRequest $request)
    {
        $this->configurationRepository->create($request->all());
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
        $configuration = $this->configurationRepository->get($id);
        return view('configurations.edit')->with(compact('configuration'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateConfigurationFormRequest $request, $id)
    {
        $configuration = $this->configurationRepository->get($id);
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
        $configuration = $this->configurationRepository->get($id);
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
			return $this->configurationRepository->getAllDataTable();
	}
}
