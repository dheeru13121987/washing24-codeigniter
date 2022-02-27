<?php namespace App\Models;
use CodeIgniter\Model;

class CustomerModel extends Model
{
    public function __construct(){
        parent::__construct();
    }

    public function getAllFilterByValue($str){
        $table = 'customer';
        $primaryKey = 'customer_id';
        $select = 'customer_fname, customer_lname, customer_unique_id, customer_mobile';
        $where = '(`customer_fname`  LIKE \'%' . $str . '%\' OR `customer_lname`  LIKE \'%' . $str . '%\' OR `customer_mobile`  LIKE \'%' . $str . '%\')';
        $length = 10;
        $start = 0;

        $builder = $this->db->table($table);
        $builder->select($select, FALSE);
        $builder->where($where, NULL, FALSE);

        $result = $builder->get()->getResultArray();
        // echo "<pre>";print_r($this->db->getLastQuery());die;
        return (count($result) > 0) ? $result : false;
    }
}