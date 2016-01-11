<?php
namespace App\Repository\Pluranza;

use App\DataTables\Pluranza\AcademyDataTable;
use App\Pluranza\Academy;
use App\Repository\BaseRepository;
use App\User;

class AcademyRepository extends BaseRepository {

	public $dataTable;

	/**
	 * DancerRepository constructor.
	 */
	public function __construct(AcademyDataTable $academyDataTable) {
		$this->setModel(new Academy);
		$this->dataTable = $academyDataTable;
	}

	public function getAllDataTable()
	{
		return $this->dataTable->getDefaultTable($this->model->orderBy('created_at', 'DESC')->get());
	}

	public function countVerified() {
		return $this->model->join('users', function($join) {
			$join->on('academies.user_id', '=', 'users.id')
				 ->where('users.verified', '=', 1);
		})->count();
	}

	public function delete($id)
	{
		$academy = $this->get($id);
		$user = $academy->user();
		return $academy->delete() && $user->delete();

	}

	public function confirm($id) {
		$this->get($id)->user->confirmEmail();
	}

	public function sendSMS($message, $type = 'all', $academies = null)
	{
		if ($type == 'custom' && count($academies) > 0) {
			\Debugbar::info(['Enviando custom a: ' => $academies]);
			foreach ($academies as $id) {
				$academy = $this->get($id);
				if (count($academy->phone) == 11) {
					$this->sms($message, $academy->phone);
				}				
			}
		} 

		if ($type == 'all') {
			\Debugbar::info(['Enviando a: ' => 'todos']);
			$academies = $this->getAll();
			foreach ($academies as $academy) {
				if (count($academy->phone) == 11) {
					$this->sms($message, $academy->phone);
				}				
			}
		}

		if ($type == 'unverified') {
			$users = User::whereVerified(0)->get();
			\Debugbar::info(['Enviando sin verificar a: ' => $users->lists('name')]);
        	if ($users->count()) {
        		foreach ($users as $user) {
					$this->sms($message, $user->academy->phone);
        		}
        	}
		}
	}

	public function sms($message, $number)
	{
		$data = array(
		 	'cuenta_token' => '1324b879d43aff522b0aeddf803bbcba',
			'subcuenta_token' => 'cb275c7f96beb572e4787a7424405b60',
			'telefono' => $number,
			'mensaje' => $message
		);
		$result = \Curl::to('http://www.foo.com/bar')
        ->withData($data)
        ->post();
		\Debugbar::info(['Result SMS: ' => $result]);

        /*if(data.transaccion == 'exitosa'){

        	alert(data.mensaje_transaccion); 

          
        }

        if(data.transaction == 'error')
        { 
        	alert(data.mensaje_transaccion); 
           
        }*/
	}
}

