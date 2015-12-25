<?php

namespace App\Http\Controllers\Pluranza;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pluranza\RegisterPaymentFormRequest;
use App\Repository\Pluranza\AcademyRepository;
use App\Repository\Pluranza\PaymentRepository;

use App\Http\Requests;
use Auth;

class PaymentController extends Controller
{
    protected $paymentRepository;
    protected $academyRepository;

    /**
     * PaymentController constructor.
     * @param $paymentRepository
     */
    public function __construct(PaymentRepository $paymentRepository, AcademyRepository $academyRepository) {
        $this->paymentRepository = $paymentRepository;
        $this->academyRepository = $academyRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = $this->paymentRepository->dataTable->getAllTable();
        return view('pluranza.payments.index')->with(compact('table'));
    }

    public function byAcademy($id)
    {
        $table = $this->paymentRepository->dataTable->getByAcademyTable([$id]);
        $academy = $this->academyRepository->get($id);
        return  view('pluranza.payments.by-academy')->with(compact('table', 'academy'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $academy = $this->academyRepository->get($id);
        $competitors = $academy->competitors->pluck('name', 'id');
        // $status = ['accept' => 'Aceptado', 'refuse' => 'Rechazado', 'pending' => 'Pendiente'];
        return view('pluranza.payments.new')->with(compact('academy', 'competitors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterPaymentFormRequest $request)
    {
        $input = $request->all();
        $input['academy_id'] = Auth::user()->academy->id;
        $this->paymentRepository->create($input);
        flash()->success('Datos guardados exitosamente!');
        return redirect()->route('pluranza.payments.home');
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
        $payment = $this->paymentRepository->get($id);
        return view('pluranza.payments.edit')->with(compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RegisterPaymentFormRequest $request, $id)
    {
        $this->paymentRepository->update($request->all(), $id);
        flash()->success('Datos actualizados exitosamente!');
        return redirect()->route('pluranza.payments.home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment = $this->paymentRepository->get($id);
        $paymentName = $payment->name;
        $payment->delete();
        flash()->success( $paymentName . ', ha sido eliminada correctamente!');
        return redirect()->back();
    }

    public function confirm($id)
    {
        $payment = $this->paymentRepository->get($id);
        $payment->status = 'accept';
        $payment->save();
        flash()->success( 'El pago de ' . $payment->academy->name . ', ha sido aceptado!');
        return redirect()->back();
    }

    public function refuse($id)
    {
        $payment = $this->paymentRepository->get($id);
        $payment->status = 'refuse';
        $payment->save();
        flash()->success( 'El pago de ' . $payment->academy->name . ', ha sido rechazado!');
        return redirect()->back();
    }

	/*
	 * ---------------------- APIs ---------------------
*/
	public function apiList()
	{
		if(request()->ajax())
			return $this->paymentRepository->getAllDataTable();
	}

    public function apiByAcademyList($id)
    {
        if(request()->ajax())
            return $this->paymentRepository->getByAcademyDataTable($id);
    }

}
