<?php

namespace App\Http\Controllers;

use App\Mailers\AppMailer;
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
        $academieParticipant = AcademieParticipant::find($id);
        return view('pluranza.academies-participants.edit')->with(compact('academieParticipant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RegisterAcademieParticipantRequest $request, $id)
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
