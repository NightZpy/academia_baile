<?php

namespace App\Http\Controllers\Pluranza;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pluranza\RegisterPaymentFormRequest;
use App\Http\Requests\Pluranza\UpdatePaymentFormRequest;
use App\Mailers\AppMailer;
use App\Repository\Pluranza\AcademyRepository;
use App\Repository\Pluranza\PaymentRepository;
use App\Role;
use App\User;
use App\Http\Requests;
use Auth;

class PaymentController extends Controller
{
    protected $repository;
    protected $academyRepository;
    protected $appMailer;

    /**
     * PaymentController constructor.
     * @param $repository
     */
    public function __construct(PaymentRepository $repository, AcademyRepository $academyRepository, AppMailer $appMailer) {
        $this->repository = $repository;
        $this->academyRepository = $academyRepository;
        $this->appMailer         = $appMailer;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = $this->repository->dataTable->getAllTable();
        return view('pluranza.payments.index')->with(compact('table'));
    }

    public function byAcademy($id)
    {
        $table = $this->repository->dataTable->getByAcademyTable([$id]);
        $academy = $this->academyRepository->get($id);
        return  view('pluranza.payments.index')->with(compact('table', 'academy'));
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
    public function store(RegisterPaymentFormRequest $request, AppMailer $mailer)
    {
        $input = $request->all();
        $input['academy_id'] = Auth::user()->academy->id;
        $payment = $this->repository->create($input);
        $admin = Role::whereName('admin')->first()->users->first();
        $mailer->sendEmailNewPaymentToAdmin($payment, $admin, 'pluranza.payments.emails.payment');
        flash()->success('Datos guardados exitosamente!');
        return redirect()->route('pluranza.payments.by-academy', $input['academy_id']);
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
        $payment = $this->repository->get($id);
        return view('pluranza.payments.edit')->with(compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentFormRequest $request, AppMailer $mailer, $id)
    {
        $input = $request->all();
        $input['academy_id'] = Auth::user()->academy->id;
        $status = $this->repository->get($id)->status;
        $payment = $this->repository->updateCustom($input, $id);
        $admin = Role::whereName('admin')->first()->users->first();
        if($status == 'refuse')
            $mailer->sendEmailUpdatePaymentToAdmin($payment, $admin, 'pluranza.payments.emails.payment');
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
        $payment = $this->repository->get($id);
        $paymentName = $payment->name;
        $payment->delete();
        flash()->success( $paymentName . ', ha sido eliminada correctamente!');
        return redirect()->back();
    }

    public function confirm($id)
    {
        $payment = $this->repository->get($id);
        $payment->status = 'accept';
        $payment->save();
        $this->appMailer->sendPaymentUpdateStatus($payment, 'pluranza.payments.emails.confirm-payment', 'Pluranza 2016: Pago confirmado!');
        flash()->success( 'El pago de ' . $payment->academy->name . ', ha sido aceptado!');
        return redirect()->back();
    }

    public function refuse($id)
    {
        $payment = $this->repository->get($id);
        $payment->status = 'refuse';
        $payment->save();
        $this->appMailer->sendPaymentUpdateStatus($payment, 'pluranza.payments.emails.refuse-payment', 'Pluranza 2016: Pago rechazado!');
        flash()->success( 'El pago de ' . $payment->academy->name . ', ha sido rechazado!');
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
