<?php

namespace App\Http\Controllers\Pluranza;

use App\Http\Requests\Pluranza\CreateExhibitionFormRequest;
use App\Http\Requests\Pluranza\RegisterExhibitionFormRequest;
use App\Http\Requests\Pluranza\UpdateExhibitionFormRequest;
use App\Mailers\AppMailer;
use App\Repository\Pluranza\AcademyRepository;
use App\Repository\Pluranza\CompetitionCategoryRepository;
use App\Repository\Pluranza\CompetitionTypeRepository;
use App\Repository\Pluranza\ExhibitionRepository;
use App\Repository\CategoryRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ExhibitionController extends Controller
{
    protected $repository;
    protected $academyRepository;
    protected $competitionCategoryRepository;
    protected $competitionTypeRepository;

    /**
     * ExhibitionController constructor.
     */
    public function __construct(
                                ExhibitionRepository $repository,
                                AcademyRepository $academyRepository,
                                CategoryRepository $categoryRepository) 
    {
        $this->repository = $repository;
        $this->academyRepository = $academyRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = $this->repository->dataTable->getAllTable();
        return  view('pluranza.exhibitions.index')->with(compact('table'));
    }

    public function byAcademy($id)
    {        
        $academY = $this->academyRepository->get($id);
        $table = $this->repository->dataTable->getByAcademyTable([$id]);
        return  view('pluranza.exhibitions.index')->with(compact('table', 'academY'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateExhibitionFormRequest $request)
    {
        $competitionType = $this->competitionTypeRepository->get($request->get('competition_type_id'));
        $name = $this->repository->getAutomaticName($competitionType);
        $categories = $this->competitionCategoryRepository->getCategoriesByCompetitionTypeForSelect($competitionType->id);
        return view('pluranza.competitors.new')->with(compact('categories', 'name'));
    }

    public function createByAcademy($id)
    {
        $academY = $this->academyRepository->get($id);
        $name = $this->repository->getAutomaticName($id);
        $genres = array();
        if ($this->categoryRepository->count())
            $genres = $this->categoryRepository->getAllForSelect();
        $selectedGenres = null;
        if (old('gender_id[]'))
            $selectedGenres = old('gender_id[]');
        $dancers = array();
        if ($this->academyRepository->count())
            $dancers = $this->academyRepository->getDancersForSelect($id);       
        $selectedDancers = null;     
        if (old('dancer_id[]'))   
            $selectedDancers = old('dancer_id[]');
        return view('pluranza.exhibitions.new')->with(compact('dancers', 'selectedDancers', 'genres', 'selectedGenres', 'academY', 'name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterExhibitionFormRequest $request, AppMailer $mailer)
    {
        $input = $request->all();
        if (empty($input['dancer_id'][0])) {
            flash()->error('Debe seleccionar al menos un bailarín.');
            return redirect()->back()->withInput($input);
        }
        if (empty($input['gender_id'][0])) {
            flash()->error('Debe seleccionar al menos un género.');
            return redirect()->back()->withInput($input);
        }
        $academy = $this->academyRepository->get($request->get('academy_id'));
        $exhibition = $this->repository->create($input);
        //$mailer->sendEmailToExhibition($competitor, 'pluranza.emails.dancer-invitation');
        flash()->success('Exhibición guardada exitosamente.');
        return redirect()->route('pluranza.exhibitions.by-academy', $academy->id);
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
	public function update($id, UpdateExhibitionFormRequest $request)
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
