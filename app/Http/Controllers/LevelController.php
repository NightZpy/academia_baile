<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterLevelFormRequest;
use App\Http\Requests\UpdateLevelFormRequest;
use App\Repository\LevelRepository;

use App\Http\Requests;

class LevelController extends Controller
{
    protected $levelRepository;

    /**
     * LevelController constructor.
     * @param $levelRepository
     */
    public function __construct(LevelRepository $levelRepository) {
        $this->levelRepository = $levelRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = $this->levelRepository->dataTable->getAllTable();
        return view('levels.index')->with(compact('table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('levels.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterLevelFormRequest $request)
    {
        $this->levelRepository->create($request->all());
        flash()->success('Datos guardados exitosamente!');
        return redirect()->route('levels.home');
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
        $category = $this->levelRepository->get($id);
        return view('levels.edit')->with(compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLevelFormRequest $request, $id)
    {
        $dancer = $this->levelRepository->get($id);
        $dancer->update($request->all());
        flash()->success('Datos actualizados exitosamente!');
        return redirect()->route('levels.home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->levelRepository->get($id);
        $categoryName = $category->name;
        $category->delete();
        flash()->success( $categoryName . ', ha sido eliminada correctamente!');
        return redirect()->back();
    }

	/*
	 * ---------------------- APIs ---------------------
*/
	public function apiList()
	{
		if(request()->ajax())
			return $this->levelRepository->getAllDataTable();
	}

}
