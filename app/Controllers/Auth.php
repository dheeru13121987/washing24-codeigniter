<?php namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\AuthenticationModel;

class Auth extends BaseController
{
	protected $responce = array();
	private $authenticationModel;

	public function __construct() {	
		parent::__construct();
		$this->authenticationModel = new AuthenticationModel();
    }

	public function index()
	{
		return view('auth/login_page');
	}

	public function getCheck()
	{
		$validation =  \Config\Services::validation();
		$rules = [
      'mobile' => [
				'label' => 'Mobile', 
				'rules' => 'required|numeric|min_length[10]|max_length[10]|is_not_unique[employee.employee_mobile]',
				'rules' => 'required|numeric|min_length[10]|max_length[10]',
					'errors' => [
					'required' => 'Please provide mobile number!',
					'numeric' => 'Please provide valid mobile number!',
					'min_length' => 'Please provide valid mobile number!',
					'max_length' => 'Please provide valid mobile number!',
					'is_not_unique' => 'User not exists!',
					]
			],
			'password' => [
				'label' => 'Password', 
				'rules' => 'required'
			],
    ];
		if($this->validate($rules)) {
			if ($this->request->getMethod()=='post'){
				$post = $this->request->getPost();
				$result = $this->authenticationModel->getAdminLogin($post);
				if($result['session_status']){
					$session->set($result);
					return redirect()->to(URL."/dashboard"); 
				}else{
					return redirect()->back()->with('login_error_msg', 'Wrong Mobile Number or Password Given!');
				}
			}
			else{
				return redirect()->back()->with('login_error_msg', 'Wrong Request Type!');
			}
    } else {
			return view('auth/login_page', ["validation"=>$this->validator]);
    }
	}
}
