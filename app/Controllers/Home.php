<?php 

namespace App\Controllers;
use App\Models\StudentModel;

class Home extends BaseController
{

	public function __construct() {
		helper(['form', 'url']);
		$this->studentModel = new StudentModel();
		$this->m_validation =  \Config\Services::validation();
	}

	public function index()
	{
		$arrmixUserData = $this->studentModel->fetchStudents();

		foreach( $arrmixUserData as $index=>$row ) {
			
			if( !$this->primeCheck( $row->id ) ) {
				unset($arrmixUserData[$index]);
			}
		}

		$arrmixPocketMoney = $this->studentModel->fetchSecondHighestPocketMoney();
		echo view('instructions');
		echo view('welcome_message');
		echo view('pocket_money', ['arrmixPocketMoney' => $arrmixPocketMoney]);
		echo view('students_list',['arrmixUserData' => $arrmixUserData]);
	}

	//--------------------------------------------------------------------

	// To Validate Student Form Data
	public function validateUserData( $arrstrValidateUserData )
    {
        $this->m_validation->reset();
        $this->m_validation->setRules( $arrstrValidateUserData );

        $boolIsValidInput = $this->m_validation->withRequest($this->request)->run();

        if( !$boolIsValidInput )
        {
            return false;
        } else {
            return true;
        }
    }

	public function addStudent()
	{
		$arrstrValidateUserData = [
			'first_name' 	=> ['label' => 'First Name', 'rules' => 'required'],
			'last_name' 	=> ['label' => 'Last Name', 'rules' => 'required'],
		];

		if( $this->validateUserData( $arrstrValidateUserData ) )
		{
			
			$data = [
				'first_name' 	=> $this->request->getVar('first_name'),
				'last_name' 	=> $this->request->getVar('last_name'),
				'email' 		=> $this->request->getVar('email'),
				'pocket_money' 	=> $this->request->getVar('pocket_money'),
				'password' 		=> md5( $this->request->getVar('password') ),
				'age' 			=> $this->request->getVar('age'),
				'state' 		=> $this->request->getVar('state'),
				'zip' 			=> $this->request->getVar('zip'),
				'country' 		=> $this->request->getVar('country'),

			];
				
			$save = $this->studentModel->insert($data);

			if( $save ) {

				header('Content-Type: application/json');
				echo json_encode( array( 'type' => 'success', 'message' => 'Registered Successfully.' ) );
		 	} else {
				header('Content-Type: application/json');
				echo json_encode( array( 'type' => 'error', 'message' => 'Something Went Wrong' ));
			 }
		} else {

			$errorMessage = array_values( $this->m_validation->getErrors() );
			header('Content-Type: application/json');
			echo json_encode( array( 'type' => 'error', 'message' => $errorMessage[0] ) );
		}
	}

	private function primeCheck( $number )
	{ 
	    if ($number == 1) 
	    return false; 
	    for ($i = 2; $i <= $number/2; $i++){ 
	        if ($number % $i == 0) 
	            return false; 
	    } 
	    return true; 
	} 

}
