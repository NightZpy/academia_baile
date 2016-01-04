<?php

namespace App\Http\Controllers\Pluranza;
use App\Repository\Pluranza\AcademyRepository;
use App\Role;
use App\User;
use App\Estate;
use App\Municipality;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Pluranza\UpdateAcademyRequest;
use App\Http\Requests\Pluranza\RegisterAcademyRequest;
use App\Pluranza\Academy;
use App\Mailers\AppMailer;

class AcademyController extends Controller
{
    protected $repository;

    /**
     * AcademyController constructor.
     * @param $repository
     */
    public function __construct(AcademyRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = $this->repository->dataTable->getAllTable();
        return view('pluranza.academies.index')->with(compact('table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pluranza.academies.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterAcademyRequest $request, AppMailer $mailer)
    {
        $user = User::create($request->all());
        \Debugbar::info(['User' => $user]);
        $academyInput = $request->all();
        $academyInput['user_id'] = $user->id;
        $academy = $this->repository->create($academyInput);
        \Debugbar::info(['Academy' => $academy]);
        if(User::count() == 1) $user->attachRole(Role::whereName('admin')->first());
        if(User::count() > 1) $user->attachRole(Role::whereName('director')->first());
        $mailer->sendEmailConfirmationTo($user, 'pluranza.emails.confirm');
        flash()->success('Datos guardados exitosamente, debe activar la cuenta, revise su cuenta de correo. Tenga en cuenta que las cuentas Outlook o hotamail pueden enviar a Spam/Correo no deseado nuestro correo.');
        return redirect()->route('users.login');
    }

    public function resendToNoVerifiedAccounts(AppMailer $mailer) {
        $users = User::whereVerified(0)->get();
        foreach($users as $user)
            $mailer->sendEmailConfirmationTo($user, 'pluranza.emails.confirm');
        dd($users->toArray());
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
        $academy = Academy::find($id);
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
        $academY = $academy;
        return view('pluranza.academies.edit')->with(compact('academY', 'estates', 'estateId', 'municipalities', 'municipalityId', 'parishes', 'parishId', 'cities', 'cityId', 'foundation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateAcademyRequest $request)
    {
        $academy = Academy::findOrFail($id);
        $updateAt = $academy->updated_at;
        $academy->fill($request->all())->save();
        if ($updateAt != $academy->updated_at)
            flash()->success('Sus datos han sido actualizados correctamente.');
        else
            flash()->success('Sus datos no pudieron ser actualizados.');

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
        $academy = $this->repository->get($id);
        flash()->success('Academia ' . $academy->name . ' eliminada correctamente.');
        $this->repository->delete($id);
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
