<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterCategoryFormRequest;
use App\Http\Requests\UpdateCategoryFormRequest;
use App\Repository\CategoryRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    protected $categoryRepository;

    /**
     * CategoryController constructor.
     * @param $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = $this->categoryRepository->dataTable->getAllTable();
        return view('categories.index')->with(compact('table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterCategoryFormRequest $request)
    {
        $this->categoryRepository->create($request->all());
        flash()->success('Datos guardados exitosamente!');
        return redirect()->route('categories.home');
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
        $category = $this->categoryRepository->get($id);
        return view('categories.edit')->with(compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryFormRequest $request, $id)
    {
        $dancer = $this->categoryRepository->get($id);
        $dancer->update($request->all());
        flash()->success('Datos actualizados exitosamente!');
        return redirect()->route('categories.home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->categoryRepository->get($id);
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
			return $this->categoryRepository->getAllDataTable();
	}

}
