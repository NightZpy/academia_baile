<?php

namespace App\Http\Controllers\Pluranza;
use App\User;
use App\Estate;
use App\Municipality;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Pluranza\UpdateAcademyParticipantRequest;
use App\Http\Requests\Pluranza\RegisterAcademyParticipantRequest;
use App\Pluranza\AcademyParticipant;
use App\Mailers\AppMailer;

class AcademyParticipantController extends Controller
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
    public function store(RegisterAcademyParticipantRequest $request, AppMailer $mailer)
    {
        $user = User::create($request->all());
        $aP = AcademyParticipant::create($request->all());
        $user->academyParticipant()->save($aP);
        $mailer->sendEmailConfirmationTo($user, 'pluranza.emails.confirm');
        flash()->success('Datos guardados exitosamente, debe activar la cuenta, un correo llegará a su buzón en unos minutos.');
        return redirect()->route('users.login');
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
        $cityId = 0;
        $parishes = array();
        $parishId = 0;
        $municipalities = array();
        $municipalityId = 0;
        $academy = AcademyParticipant::find($id);
        $foundation = $academy->foundation;

        $estates = Estate::all()->lists('name', 'id');
        $estateId = $academy->estate_id;
        if($estateId > 0) {
            $estate = Estate::findOrFail($estateId);
            $cityId = $academy->city_id;
            if($cityId > 0) {
                $cities = $estate->cities->lists('name', 'id');
            }

            $municipalityId = $academy->municipality_id;
            if($municipalityId > 0) {
                $municipalities = $estate->municipalities->lists('name', 'id');

                $parishId = $academy->parish_id;
                if($parishId > 0) {
                    $parishes = Municipality::findOrFail($municipalityId)->parishes->lists('name', 'id');
                }
            }
        }
        return view('pluranza.academies-participants.edit')->with(compact('academy', 'estates', 'estateId', 'municipalities', 'municipalityId', 'parishes', 'parishId', 'cities', 'cityId', 'foundation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateAcademyParticipantRequest $request)
    {
        $academyParticipant = AcademyParticipant::findOrFail($id);
        // $academy->fill($request->all())->save();
        $academyParticipant->update($request->all());
        return redirect()->back()->with(compact('academy'));
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
