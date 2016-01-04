<?php

namespace App\Http\Controllers\Pluranza;

use App\Http\Requests\Pluranza\CreateCompetitorFormRequest;
use App\Http\Requests\Pluranza\RegisterCompetitorFormRequest;
use App\Http\Requests\Pluranza\UpdateCompetitorFormRequest;
use App\Mailers\AppMailer;
use App\Repository\Pluranza\AcademyRepository;
use App\Repository\Pluranza\CompetitionCategoryRepository;
use App\Repository\Pluranza\CompetitionTypeRepository;
use App\Repository\Pluranza\CompetitorRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CompetitorController extends Controller
{
    protected $repository;
    protected $academyRepository;
    protected $competitionCategoryRepository;
    protected $competitionTypeRepository;

    /**
     * CompetitorController constructor.
     */
    public function __construct(
                                CompetitorRepository $repository,
                                AcademyRepository $academyRepository,
                                CompetitionCategoryRepository $competitionCategoryRepository,
                                CompetitionTypeRepository $competitionTypeRepository) {
        $this->repository = $repository;
        $this->academyRepository = $academyRepository;
        $this->competitionCategoryRepository = $competitionCategoryRepository;
        $this->competitionTypeRepository = $competitionTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $competitionTypes = $this->competitionCategoryRepository->getCompetitionTypes();
        $table = $this->repository->dataTable->getAllTable();
        return  view('pluranza.competitors.index')->with(compact('table', 'competitionTypes'));
    }

    public function byAcademy($id)
    {
        $academy = $this->academyRepository->get($id);
        $competitionTypes = $this->competitionCategoryRepository->getCompetitionTypes();
        if(!$academy->availableCouples) {
            $key = $competitionTypes->search(function($competitionType, $key){
                return strtolower($competitionType->name) == 'pareja';
            });
            unset($competitionTypes[$key]);
        }

        $table = $this->repository->dataTable->getByAcademyTable([$id]);
        return  view('pluranza.competitors.index')->with(compact('table', 'academy', 'competitionTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateCompetitorFormRequest $request)
    {
        $competitionType = $this->competitionTypeRepository->get($request->get('competition_type_id'));
        $name = $this->repository->getAutomaticName($competitionType);
        $categories = $this->competitionCategoryRepository->getCategoriesByCompetitionTypeForSelect($competitionType->id);
        return view('pluranza.competitors.new')->with(compact('categories', 'competitionType', 'name'));
    }

    public function createByAcademy(CreateCompetitorFormRequest $request, $id)
    {
        $academy = $this->academyRepository->get($id);
        $competitionType = $this->competitionTypeRepository->get($request->get('competition_type_id'));
        $name = $this->repository->getAutomaticName($competitionType);
        if (strtolower($competitionType->name) == 'pareja') {
            $masculineDancers = $academy->dancers()->masculine()->lists('name', 'id');
            $femaleDancers = $academy->dancers()
                ->female()
                //->select('dancers.id AS id', DB::raw('CONCAT(dancers.name, " ", dancers.last_name) AS full_name'))
                ->lists('name', 'id');
            $dancers = ['masculine' => $masculineDancers, 'female' => $femaleDancers];
            \Debugbar::info($dancers);
        } else {
            $dancers = $academy->dancers->lists('fullName', 'id');
        }
        $categories = $this->competitionCategoryRepository->getCategoriesByCompetitionTypeForSelect($competitionType->id);
        return view('pluranza.competitors.new')->with(compact('dancers', 'categories', 'academy', 'competitionType', 'name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterCompetitorFormRequest $request, AppMailer $mailer)
    {
        $input = $request->all();
        $academy = $this->academyRepository->get($request->get('academy_id'));

        if ($this->repository->exists($input, $input['dancer_id'])) {
            flash()->error('¡No puedes registrar un nuevo competidor con un nombre de otro, el mismo tipo de cempetidor o los bailarines ya estan siendo ocupados!');
            return redirect()->back()->withInput($input);
        }
        $competitor = $this->repository->create($input);
        $mailer->sendEmailToCompetitor($competitor, 'pluranza.emails.dancer-invitation');
        flash()->success('Datos guardados exitosamente, correo de invitación enviado a los competidores.');
        return redirect()->route('pluranza.competitors.by-academy', $academy->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $competitor = $this->repository->get($id);
        $academy = $competitor->academy;
        $table = $this->repository->dataTable->getByAcademyTable([$id]);
        return  view('pluranza.competitors.by-academy')->with(compact('table', 'academy', 'competitionTypes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $competitor = $this->repository->get($id);
        $academy = $competitor->academy;
        $categories = $this->competitionCategoryRepository->getCategoriesByCompetitionTypeForSelect($competitor->competitionType->id);
        $levels = $this->competitionCategoryRepository->getLevelByCategoryAndCompetitionTypeForSelect($competitor->category->id, $competitor->competitionType->id);
        $competitionType = $competitor->competitionType;
        if (strtolower($competitor->competitionType->name) == 'pareja') {
            $masculineDancers = $academy->dancers()->masculine()->lists('name', 'id');
            $femaleDancers = $academy->dancers()
                ->female()
                //->select('dancers.id AS id', DB::raw('CONCAT(dancers.name, " ", dancers.last_name) AS full_name'))
                ->lists('name', 'id');
            $dancers = ['masculine' => $masculineDancers, 'female' => $femaleDancers];
        } else {
            $dancers = $academy->dancers->lists('fullName', 'id');
        }

        return view('pluranza.competitors.edit')->with(compact('competitor', 'academy', 'levels', 'categories', 'dancers', 'competitionType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function update($id, UpdateCompetitorFormRequest $request)
	{
        $input = $request->all();;
        $academy = $this->academyRepository->get($request->get('academy_id'));
        if ($request->has('song'))
            $this->repository->get($id)->song->destroy();
        $competitor = $this->repository->updateCustom($input, $id);
        flash()->success('Datos actualizados exitosamente!');
        return redirect()->route('pluranza.competitors.by-academy', $academy->id);
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $competitor = $this->repository->get($id);
        $competitorName = $competitor->name;
	    flash()->success($competitorName . ', ha sido eliminado correctamente!');
	    $competitor->delete();
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

    public function apiByAcademyList($id)
    {
        if(request()->ajax())
            return $this->repository->getByAcademyDataTable($id);
    }
}
