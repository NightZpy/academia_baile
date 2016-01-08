<?php

namespace App\Http\Controllers\Pluranza;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pluranza\RegisterJuryFormRequest;
use App\Http\Requests\Pluranza\UpdateJuryFormRequest;
use App\Repository\CategoryRepository;
use App\Repository\Pluranza\JuryRepository;

use App\Http\Requests;

class JuryController extends Controller
{
    protected $repository;
    protected $categoryRepository;

    /**
     * JuryController constructor.
     * @param JuryRepository $repository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(JuryRepository $repository, CategoryRepository $categoryRepository) {
        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = $this->repository->dataTable->getAllTable();
        return view('pluranza.jurors.index')->with(compact('table'));
    }

    public function publicIndex()
    {
        $categories = $this->categoryRepository->getAll('name', 'asc');
        return view('pluranza.jurors.public')->with(compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->getAllForSelect();
        return view('pluranza.jurors.new')->with(compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterJuryFormRequest $request)
    {
        $input = $request->all();
        $categories = $input['category_id'];
        $jury = $this->repository->create($input);
        $jury->categories()->attach($categories);
        flash()->success('¡El jurado ha sido guardado con éxito!');
        return redirect()->route('pluranza.jurors.home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jury = $this->repository->get($id);
        return view('pluranza.jurors.show')->with(compact('jury'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jury = $this->repository->get($id);
        $categories = $this->categoryRepository->getAllForSelect();
        $selectedCategories = $jury->categories->lists('id')->toArray();
        \Debugbar::info(['Selected categories' => $selectedCategories]);
        return view('pluranza.jurors.edit')->with(compact('jury', 'categories', 'selectedCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJuryFormRequest $request, $id)
    {
        $jury = $this->repository->get($id);
        $jury->update($request->all());
        $categories = $request->get('category_id');
        if (count($categories))
            $jury->categories()->sync($categories);
        flash()->success('¡Datos actualizados exitosamente!');
        return redirect()->route('pluranza.jurors.home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jury = $this->repository->get($id);
        $juryName = $jury->name;
        $jury->delete();
        flash()->success( $juryName . ', ha sido eliminada correctamente!');
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
