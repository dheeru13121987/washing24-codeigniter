<?php namespace App\Controllers;
use CodeIgniter\Controller;

class Dashboard extends BaseController
{
	public function __construct() {	
                parent::__construct();
        }

	public function index()
	{
                $session = \Config\Services::session();
                $dyomodels = model('App\Models\DyoModels');
                $data = $session->get();
                $data['page_title'] = "Dashboard Page";
                $data['active_class'] = "dashboard";
                echo view('dashboard/dashboard_page',$data);
	}
}
