<?php namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\CustomerModel;

class Customer extends BaseController
{
	private $customermodel;

    public function __construct() {	
        parent::__construct();
        $this->customermodel = new CustomerModel();
    }

	// public function index()
	// {
 //        $data = session()->get();
 //        $data['page_title'] = "Order Page";
 //        $data['page_header'] = "Order List";
 //        $data['active_class'] = "orders";
 //        $data['listing_function'] = "order-list";
 //        $data['new_frm_function'] = "order-new";
 //        $data['breadcrumbs'] = ["Order"=>"order"];
 //        echo view('orders/order_list', $data);
	// }

 //    public function newForm(){ 
 //        $data = session()->get();
 //        $data['page_title'] = "New Order Page";
 //        $data['page_header'] = "New Order";
 //        $data['active_class'] = "orders";
 //        $data['listing_function'] = "order-list";
 //        $data['new_frm_function'] = "customer-new";
 //        $data['breadcrumbs'] = ["Order"=>"order","New"=>"order-new"];
 //        echo view('orders/order_new', $data);
 //    }

    public function getAllDropduwnList()
    {
        if ($this->request->isAJAX()) {
            $str = $this->request->getGet('str');
            $output = array();
            $result = $this->customermodel->getAllFilterByValue($str);
            if($result==false){
                $output[] = "Customer Not Found. Please Register First!";
            }else{
                foreach($result as $rec){
                  $output[] = $rec['customer_fname']." ".$rec['customer_lname']." (".$rec['customer_mobile'].") #".$rec['customer_unique_id'];
                }
            }
            echo json_encode($output);
        }else{
            show_error("No direct access allowed");
        }
    }

  //   public function getAllList()
  //   {
		// if ($this->request->isAJAX()) {
		// 	$data = $this->request->getGet();
		// 	$result = $this->fetch_list_lib($data);
		// 	if ($result['check_data']) {
		// 		$report = array("draw" => $data['draw'], "recordsTotal" => $result['count'], "recordsFiltered" => $result['tot_filter'], "data" => $result['list']);
		// 		echo json_encode($report);
		// 		exit;
		// 	} else {
		// 		$report = array("draw" => $data['draw'], "recordsTotal" => $result['count'], "recordsFiltered" => $result['tot_filter'], "data" => array());

		// 		echo json_encode($report);
		// 		exit;
		// 	}
		// }else{
		// 	show_error("No direct access allowed");
		// }
  //   }    

  //   private function fetch_list_lib($data)
  //   {
  //       $draw = $data['draw'];
  //       $result = $this->ordermodel->fetch_all_list($data);
  //       $count = $this->ordermodel->count_all_list($data);
  //       $check_data = false;
  //       $tot_filter = 0;
  //       if ($result !== false) {
  //           $check_data = 1;
  //           $tot_filter = count($result);
  //       }
  //       return array('count' => $count[0]['tot'], 'tot_filter' => $count[0]['tot'], 'check_data' => $check_data, 'list' => $result);
  //   }
}
