<?php namespace App\Models;
use CodeIgniter\Model;

class OrderModel extends Model
{
    public function __construct(){
        parent::__construct();
    }
    
	public function fetch_all_list($data)
	{
		$start_row = 0;
		if (isset($data['offset'])) {
			$start_row = $data['offset'];
		}
		$builder = $this->db->table('orders');
		//$builder->join("countries A", "A.id = user.country_id", "left");
		$builder->select('*', FALSE);

		if (!empty($data['search']['value'])) {
			$builder->where('(`order_name`  LIKE \'%' . $data['search']['value'] . '%\' OR
			`order_address`  LIKE \'%' . $data['search']['value'] . '%\' OR
			`order_area`  LIKE \'%' . $data['search']['value'] . '%\' OR 
			`order_landmark`  LIKE \'%' . $data['search']['value'] . '%\' OR
			`order_pincode`  LIKE \'%' . $data['search']['value'] . '%\')', NULL, FALSE);
		}
		
		// if (isset($data['order'])) {
		// 	$builder->orderBy($order_by);
		// }

		if (isset($data['order'])) {
			$builder->orderBy($data['order'][0]['column'], $data['order']['0']['dir']);
		} else {
			$builder->orderBy('order_id', 'asc');
		}

		if (!empty($data['length'])) {
			$builder->limit($data['length']);
		}
		if (!empty($data['start'])) {
			$builder->offset($data['start']);
		}

		// if ($data['admin_only'] == 1) {
		// 	$builder->where('user_parent_id is null', null, false);
		// }


		$builder->where('status_id !=', 0);

		$result = $builder->get()->getResultArray();
		// echo "<pre>";print_r($this->db->getLastQuery());die;
		return (count($result) > 0) ? $result : false;
	}
    
	public function count_all_list($data)
	{
		$builder = $this->db->table('orders');
		$builder->select('count(order_id)as tot');

		if (!empty($data['search']['value'])) {
			$builder->where('(`order_name`  LIKE \'%' . $data['search']['value'] . '%\' OR
			`order_address`  LIKE \'%' . $data['search']['value'] . '%\' OR
			`order_area`  LIKE \'%' . $data['search']['value'] . '%\' OR 
			`order_landmark`  LIKE \'%' . $data['search']['value'] . '%\' OR
			`order_pincode`  LIKE \'%' . $data['search']['value'] . '%\')', NULL, FALSE);
		}

		$builder->where('status_id !=', 0);

		// if ($data['admin_only'] == 1) {
		// 	$builder->where('user_parent_id is null', null, false);
		// }

		$result = $builder->get()->getResultArray();
		// echo "<pre>";print_r($this->db->getLastQuery());die;
		return (count($result) > 0) ? $result : false;
	}
}