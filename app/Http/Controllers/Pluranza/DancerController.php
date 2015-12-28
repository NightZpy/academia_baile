<?php

namespace App\Http\Controllers\Pluranza;

use App\Http\Requests\Pluranza\RegisterDancerFormRequest;
use App\Http\Requests\Pluranza\UpdateDancerFormRequest;
use App\Mailers\AppMailer;
use App\Repository\Pluranza\AcademyRepository;
use App\Repository\Pluranza\DancerRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DancerController extends Controller
{
    protected $dancerRepository;
    protected $academyRepository;
    /**
     * DancerController constructor.
     */
    public function __construct(DancerRepository $dancerRepository, AcademyRepository $academyRepository) {
        $this->dancerRepository = $dancerRepository;
        $this->academyRepository = $academyRepository;
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
        $table = $this->dancerRepository->dataTable->getByAcademyTable([$id]);
        $academy = $this->academyRepository->get($id);
        return  view('pluranza.dancers.index')->with(compact('table', 'academy'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

    }

    public function createByAcademy($id)
    {
        $academy = $this->academyRepository->get($id);
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
        $input = $request->all();
        $input['independent'] = ($request->has('independent') ? true : false);
        $input['director'] = ($request->has('director') ? true : false);

        $dancer = $this->dancerRepository->create($input);
        $academy = $this->academyRepository->get($request->get('academy_id'));
        $academy->dancers()->save($dancer);
        if ($dancer->email) {
            $mailer->sendEmailToDancer($dancer, 'pluranza.emails.dancer-invitation');
            flash()->success('Datos guardados exitosamente, correo de invitación enviado al bailarín!');
        } else {
            flash()->success('Datos guardados exitosamente!');
        }
        return redirect()->route('pluranza.dancers.by-academy', $academy->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
	    $dancer = $this->dancerRepository->get($id);
	    $academy = $dancer->academy;
	    return view('pluranza.dancers.show')->with(compact('dancer', 'academy'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dancer = $this->dancerRepository->get($id);
        $academy = $dancer->academy;
        return view('pluranza.dancers.edit')->with(compact('dancer', 'academy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function update($id, UpdateDancerFormRequest $request)
	{
		$dancer = $this->dancerRepository->get($id);
        $input = $request->all();
        $input['independent'] = ($request->has('independent') ? true : false);
        $input['director'] = ($request->has('director') ? true : false);
		$dancer->update($input);
		$academy = $dancer->academy;
		flash()->success('Datos actualizados exitosamente!');
		return redirect()->back()->with(compact('dancer', 'academy'));
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dancer = $this->dancerRepository->get($id);
        $dancerName = $dancer->name;
	    flash()->success($dancerName . ', ha sido eliminado correctamente!');
	    $dancer->delete();
	    return redirect()->back();
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
            return $this->dancerRepository->getByAcademyDataTable($id);
    }
}
