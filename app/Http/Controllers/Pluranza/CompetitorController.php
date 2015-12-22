<?php

namespace App\Http\Controllers\Pluranza;

use App\Http\Requests\Pluranza\CreateCompetitorFormRequest;
use App\Http\Requests\Pluranza\RegisterCompetitorFormRequest;
use App\Http\Requests\Pluranza\UpdateCompetitorFormRequest;
use App\Repository\Pluranza\AcademyRepository;
use App\Repository\Pluranza\CompetitionCategoryRepository;
use App\Repository\Pluranza\CompetitionTypeRepository;
use App\Repository\Pluranza\CompetitorRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CompetitorController extends Controller
{
    protected $competitorRepository;
    protected $academyRepository;
    protected $competitionCategoryRepository;
    protected $competitionTypeRepository;

    /**
     * CompetitorController constructor.
     */
    public function __construct(
                                CompetitorRepository $competitorRepository,
                                AcademyRepository $academyRepository,
                                CompetitionCategoryRepository $competitionCategoryRepository,
                                CompetitionTypeRepository $competitionTypeRepository) {
        $this->competitorRepository = $competitorRepository;
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
        $table = $this->competitorRepository->dataTable->getAllTable();
        return  view('pluranza.competitors.index')->with(compact('table'));
    }

    public function byAcademy($id)
    {
        $competitionTypes = $this->competitionCategoryRepository->getCompetitionTypes();
        $table = $this->competitorRepository->dataTable->getByAcademyTable([$id]);
        $academy = $this->academyRepository->get($id);
        return  view('pluranza.competitors.by-academy')->with(compact('table', 'academy', 'competitionTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateCompetitorFormRequest $request, $id)
    {
        $academy = $this->academyRepository->get($id);
        $competitionType = $this->competitionTypeRepository->get($request->get('competition_type_id'));
        $name = $this->competitorRepository->getAutomaticName($competitionType);
        if (strtolower($competitionType->name) == 'pareja') {
            $masculineDancers = $academy->dancers()->masculine()->lists('name', 'id');
            $femaleDancers = $academy->dancers()
                                     ->female()
                                     //->select('dancers.id AS id', DB::raw('CONCAT(dancers.name, " ", dancers.last_name) AS full_name'))
                                     ->lists('name', 'id');
            $dancers = ['masculine' => $masculineDancers, 'female' => $femaleDancers];
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
    public function store(RegisterCompetitorFormRequest $request)
    {
        $input = $request->all();
        $academy = $this->academyRepository->get($request->get('academy_id'));

        flash()->success('Datos guardados exitosamente!');
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
	    $competitor = $this->competitorRepository->get($id);
	    $academy = $competitor->academy;
	    return view('pluranza.competitors.show')->with(compact('competitor', 'academy'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $competitor = $this->competitorRepository->get($id);
        $academy = $competitor->academy;
        return view('pluranza.competitors.edit')->with(compact('competitor', 'academy'));
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
		$competitor = $this->competitorRepository->get($id);
        $input = $request->all();
        $input['independent'] = ($request->has('independent') ? true : false);
        $input['director'] = ($request->has('director') ? true : false);
		$competitor->update($input);
		$academy = $competitor->academy;
		flash()->success('Datos actualizados exitosamente!');
		return redirect()->back()->with(compact('competitor', 'academy'));
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $competitor = $this->competitorRepository->get($id);
        $competitorName = $competitor->name;
	    flash()->success($competitorName . ', ha sido eliminado correctamente!');
	    $competitor->delete();
	    return redirect()->back();
    }
    
    /*
     * ---------------------- APIs ---------------------
     */
    public function apiList($id)
    {
        if(request()->ajax())
            return $this->competitorRepository->dataTable->getDefaultTableForAll();
    }

    public function apiByAcademyList($id)
    {
        if(request()->ajax())
            return $this->competitorRepository->getByAcademyDataTable($id);
    }
}
