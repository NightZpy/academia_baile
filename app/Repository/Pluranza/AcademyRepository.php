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
		\Debugbar::info(['type' => $type, 'message' => $message, 'academies' => $academies]);
		if ($type == 'custom' && count($academies) > 0) {
			\Debugbar::info(['Enviando custom a: ' => $academies]);
			foreach ($academies as $id) {
				$academy = $this->get($id);
				$phone = $academy->phone;
				$prefix = intval(substr($phone, 0, 4));
				if ( ($prefix != 276) && strlen($phone) == 11) {
					\Debugbar::info(['Phone: ' => $phone]);
					\Debugbar::info(['prefix: ' => $prefix]);
					$this->sms($message, $phone);
				}				
			}
		} 

		if ($type == 'all') {
			\Debugbar::info(['Enviando a: ' => 'todos']);
			$academies = $this->getAll();
			foreach ($academies as $academy) {
				$phone = $academy->phone;
				$prefix = intval(substr($phone, 0, 4));				
				if ( ($prefix != 276) && strlen($phone) == 11) {
					$this->sms($message, $phone);
				}				
			}
		}

		if ($type == 'unverified') {
			$users = User::whereVerified(0)->get();
			\Debugbar::info(['Enviando sin verificar a: ' => $users->lists('name')]);
        	if ($users->count()) {
        		foreach ($users as $user) {
        			$phone = $user->academy->phone;
        			$prefix = intval(substr($phone, 0, 4));
        			if ( ($prefix != 276) && strlen($phone) == 11) { 
						$this->sms($message, $phone);
        		}
        	}
		}
	}

	public function sms($message, $number)
	{
		$step = 145;
		if(strlen($message) > 145) {
			$step = 139;		

			$messages = str_split($message, $step);
			$smsNum = 1;

			foreach ($messages as $sms) {			
				$sms = '(' . $smsNum . '/' . count($messages) . ')' . $sms;
				$data = array(
				 	'cuenta_token' => '1324b879d43aff522b0aeddf803bbcba',
					'subcuenta_token' => 'cb275c7f96beb572e4787a7424405b60',
					'telefono' => $number,
					'mensaje' => $sms
				);
				$result = \Curl::to('http://api.textveloper.com/enviar/')
		        ->withData($data)
		        ->post();
				\Debugbar::info(['Result SMS: ' . '(' . $smsNum . '/' . count($messages) . ')' => $result]);			
				$smsNum ++;
			}
		} else {
			$data = array(
				 	'cuenta_token' => '1324b879d43aff522b0aeddf803bbcba',
					'subcuenta_token' => 'cb275c7f96beb572e4787a7424405b60',
					'telefono' => $number,
					'mensaje' => $message
				);
				$result = \Curl::to('http://api.textveloper.com/enviar/')
		        ->withData($data)
		        ->post();
				\Debugbar::info(['Result SMS: ' => $result]);			
		}		

        /*if(data.transaccion == 'exitosa'){

        	alert(data.mensaje_transaccion); 

          
        }

        if(data.transaction == 'error')
        { 
        	alert(data.mensaje_transaccion); 
           
        }*/
	}

	public function getDancers($id)
	{
		return $this->get($id)->dancers;
	}

	public function getDancersForSelect($id)
	{
		return $this->getDancers($id)->lists('fullName', 'id'); 
	}
}

