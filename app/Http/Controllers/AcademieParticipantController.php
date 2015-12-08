<?php

namespace App\Http\Controllers;

use App\Estate;
use App\Http\Requests\UpdateAcademieParticipantRequest;
use App\Mailers\AppMailer;
use App\Municipality;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterAcademieParticipantRequest;
use App\AcademieParticipant;

class AcademieParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(RegisterAcademieParticipantRequest $request, AppMailer $mailer)
    {
        $aP = AcademieParticipant::create($request->all());
        $mailer->sendEmailBase($aP);
        flash()->success('Datos guardados exitosamente, le será enviado un correo con información detallada.');
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
        $cities = array();
        $parishes = array();
        $municipalities = array();
        $estates = array();

        $academieParticipant = AcademieParticipant::find($id);
        $cityId = $academieParticipant->city_id;
        if($cityId > 0) {
            $cities = City::all()->lists('ciudad', 'id_ciudad');
        }

        $parishId = $academieParticipant->parish_id;
        if($parishId > 0) {
            $parishes = Parish::all()->lists('parroquia', 'id_parroquia');
        }

        $municipalityId = $academieParticipant->municipality_id;
        if($municipalityId > 0) {
            $municipalities = Municipality::all()->lists('municipio', 'id_municipio');
        }

        $estateId = $academieParticipant->estate_id;
	    $estates = Estate::all()->lists('estado', 'id_estado');
	    return view('pluranza.academies-participants.edit')->with(compact('academieParticipant', 'estates', 'estateId', 'municipalities', 'municipalityId', 'parishes', 'parishId', 'cities', 'cityId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAcademieParticipantRequest $request, $id)
    {
        $academieParticipant = AcademieParticipant::find($id);
        $academieParticipant->update($request->all());
        return redirect()->back()->with(compact('academieParticipant'));
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
}
