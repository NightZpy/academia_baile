<?php

namespace App\Http\Controllers\Pluranza;

use App\Pluranza\Academy;
use App\Repository\Pluranza\AcademyRepository;
use App\Repository\Pluranza\CompetitorRepository;
use App\Repository\Pluranza\DancerRepository;
use App\Repository\Pluranza\PaymentRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class PagesController extends Controller
{
	protected $academyRepository;
	protected $dancerRepository;
	protected $competitorRepository;
	protected $paymentRepository;

	/**
	 * PagesController constructor.
	 * @param $academyRepository
	 */
	public function __construct(AcademyRepository $academyRepository,
	                            DancerRepository $dancerRepository,
	                            CompetitorRepository $competitorRepository,
	                            PaymentRepository $paymentRepository) {
		$this->academyRepository = $academyRepository;
		$this->dancerRepository = $dancerRepository;
		$this->competitorRepository = $competitorRepository;
		$this->paymentRepository = $paymentRepository;
	}


	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countAcademies = $this->academyRepository->countVerified();
	    $totalDancers = $this->dancerRepository->count();
	    $totalCompetitors = $this->competitorRepository->count();
	    $totalPayments = $this->paymentRepository->count();
	    $acceptPayments = $this->paymentRepository->countAccept();
	    $credit = $this->paymentRepository->creditBs();
	    $availableCompetitionQuotas = $this->competitorRepository->availableCompetitionQuotas();

        if (Auth::user()) {
            $academy = Academy::find(Auth::user()->academy->id);
        }
        return view ('pluranza.pages.index')->with(compact('academy', 'countAcademies', 'totalDancers', 'totalCompetitors', 'totalPayments', 'availableCompetitionQuotas', 'acceptPayments', 'credit'));
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
    public function store(Request $request)
    {
        //
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
}
