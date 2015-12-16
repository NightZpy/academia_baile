<?php

namespace App\Http\Controllers\Pluranza;

use App\DataTables\DancerDataTable;
use App\Pluranza\AcademyParticipant;
use App\Pluranza\Dancer;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use yajra\Datatables\Datatables;

class DancerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, DancerDataTable $dancerDataTable)
    {
        $academyParticipant = AcademyParticipant::findOrFail($id);
        $dancerDataTable->setQuery($academyParticipant->dancers);
        return view('pluranza.dancers.index')->with(compact('academyParticipant', 'dancerDataTable'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    /*
     * ---------------------- APIs ---------------------
     */
    public function apiList($id)
    {
        if(request()->ajax())
            return Datatables::of(AcademyParticipant::findOrFail($id)->dancers()->select('*'))->make(true);
    }
}
