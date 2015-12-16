<?php

namespace App\Http\Controllers\Pluranza;

use App\DataTables\DancerDataTable;
use App\Http\Requests\Pluranza\RegisterDancerFormRequest;
use App\Mailers\AppMailer;
use App\Pluranza\AcademyParticipant;
use App\Pluranza\Dancer;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class DancerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, DancerDataTable $dancerDataTable)
    {
        $academy = AcademyParticipant::findOrFail($id);
        $dancerDataTable->setQuery($academy->dancers);
        $dancerDataTable->setAcademyFilterId($academy->id);
        return $dancerDataTable->render('pluranza.dancers.index', compact('academy'));
        //return view('pluranza.dancers.index')->with(compact('academy', 'dancerDataTable'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $academy = AcademyParticipant::findOrFail($id);
        return view('pluranza.dancers.new')->with(compact('academy'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterDancerFormRequest $request, AppMailer $mailer)
    {
        $dancer = Dancer::create($request->all());
        if ($dancer->email) {
            $mailer->sendEmailToDancer($dancer, 'pluranza.emails.dancer-invitation');
            flash()->success('Datos guardados exitosamente, correo de invitación enviado al bailarín!');
        } else {
            flash()->success('Datos guardados exitosamente!');
        }
        return redirect()->back()->withInput();
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
