<?php

namespace App\Http\Controllers\Pluranza;

use App\Http\Requests\Pluranza\RegisterDancerFormRequest;
use App\Mailers\AppMailer;
use App\Pluranza\Academy;
use App\Pluranza\Dancer;
use App\Repository\Pluranza\DancerRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DancerController extends Controller
{
    protected $dancerRepository;

    /**
     * DancerController constructor.
     */
    public function __construct(DancerRepository $dancerRepository) {
        $this->dancerRepository = $dancerRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = $this->dancerRepository->dataTable->getAllTable();
        return  view('pluranza.dancers.index')->with(compact('table'));
    }

    public function byAcademy($id)
    {
        $table = $this->dancerRepository->getByAcademyTable($id);
        return  view('pluranza.dancers.by-academy')->with(compact('table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $academy = Academy::findOrFail($id);
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
            return $this->dancerRepository->dataTable->getDefaultTableForAll();
    }

    public function apiByAcademyList($id)
    {
        if(request()->ajax())
            return $this->dancerRepository->dataTable->getDefaultTableForAll();
    }
}
