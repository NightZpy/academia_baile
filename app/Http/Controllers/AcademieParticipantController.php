<?php

namespace App\Http\Controllers;

use App\City;
use App\Estate;
use App\Http\Requests\UpdateAcademieParticipantRequest;
use App\Mailers\AppMailer;
use App\Municipality;
use App\Parish;
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
        $academieParticipant = AcademieParticipant::find($id);
        $foundation = $academieParticipant->foundation;

        $estates = Estate::all()->lists('name', 'id');
        $estateId = $academieParticipant->estate_id;
        $estate = Estate::findOrFail($estateId);

        $cityId = $academieParticipant->city_id;
        if($cityId > 0) {
            $cities = $estate->cities->lists('name', 'id');
        }

        $municipalityId = $academieParticipant->municipality_id;
        if($municipalityId > 0) {
            $municipalities = $estate->municipalities->lists('name', 'id');

            $parishId = $academieParticipant->parish_id;
            if($parishId > 0) {
                $parishes = Municipality::findOrFail($municipalityId)->parishes->lists('name', 'id');
            }
        }


        return view('pluranza.academies-participants.edit')->with(compact('academieParticipant', 'estates', 'estateId', 'municipalities', 'municipalityId', 'parishes', 'parishId', 'cities', 'cityId', 'foundation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateAcademieParticipantRequest $request)
    {
        $academieParticipant = AcademieParticipant::findOrFail($id);
        // $academieParticipant->fill($request->all())->save();
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
