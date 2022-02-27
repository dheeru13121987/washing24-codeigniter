<?php namespace App\Models;
use CodeIgniter\Model;

class DyoModels extends Model
{ 
    protected $db;
    protected $responce;

    public function __construct(){
        parent::__construct();
        $this->responce = array();
        $this->db = \Config\Database::connect();
    }

    public function checkRolePermission($role_id,$access_type_id, $permission){
        $sql = "SELECT $permission FROM role_access_type_permission WHERE role_id = $role_id AND access_type_id = $access_type_id";
        $query = $this->db->query($sql);
        $results = $query->getRowArray();
        if($results[$permission]==1){
            return true;
        }else{
            return false;
        }
    }

    protected function getEmployeeLogin($mobile,$password){
        //$sql = "SELECT employee_id, employee_unique_id, employee_code, employee_fname, employee_lname, employee.role_id, employee_password_salt, employee_encrypted_password, department_name, role_name FROM role, department, employee WHERE employee.department_id = department.department_id AND employee.role_id = role.role_id AND employee_status = ? AND (employee_mobile = ? OR employee_email = ?)";
        $sql = "SELECT employee_id, employee_unique_id, employee_code, employee_fname, employee_lname, employee.role_id, employee_password_salt, employee_encrypted_password, department_name, role_name FROM role, department, employee WHERE employee.department_id = department.department_id AND employee.role_id = role.role_id AND employee_mobile = ? AND employee_status = ?";
        $query = $this->db->query($sql, [$mobile, STATUS_ACTIVE]);
        $result = $query->getResultArray();
        if(sizeof($result)>0)
        {
            $results = $query->getRowArray();
            $salt = $results['employee_password_salt'];
            $encrypted_password = $results['employee_encrypted_password'];
            $hash = $this->checkhashSSHA($salt, $password);
            if ($encrypted_password == $hash) {
                $this->responce = $results;
                $this->responce['status']=TRUE;
            }
        }else{
            $this->responce['status']=FALSE;
        }
        return $this->responce;
    }

    public function checkhashSSHA($salt, $password) { 
        $hash = base64_encode(sha1($password . $salt, true) . $salt); 
        return $hash;
    }

    public function getRegiter($table,$data){
        $uuid = uniqid('', true);
        $hash = $this->hashSSHA($data['password']);
        $encrypted_password = $hash["encrypted"];
        $salt = $hash["salt"]; // salt
        $data=array_merge($data, array("unique_id"=>$uuid,"encrypted_password"=>$encrypted_password,"salt"=>$salt));
        unset($data['password']);
        return $this->saveData($table,$data);
    }

    public function hashSSHA($password) { 
        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }

    public function isUserExisted($mobile, $table){
        $sql = "SELECT * FROM $table WHERE mobile = ?";
        $query = $this->db->query($sql, [$mobile]);
        $results = $query->getResultArray();
        if(sizeof($results)>0)
        {
            return true;
        }else{
            return false;
        }
    }
    
    public function getTableDataByID($table, $id)
    {
        $sql = "SELECT * FROM $table WHERE id = ?";
        $query = $this->db->query($sql, [$id]);
        $results = $query->getResultArray();

        if(sizeof($results)>0)
        {
            $responce['status']=true;
            $responce['is_login']=true;
            $responce['name']=$results[0]["name"];
            $responce['id']=$results[0]["id"];
        }else{
            $responce['status']=false;
            $responce['name']='';
            $responce['id']='';
        }
        return $responce;
    }

    public function saveData($table,$data){     
        $this->db->transStart();
        $builder = $this->db->table($table);
        $result = $builder->insert($data);
        $this->db->transComplete();
        if($result==false){
            return false;
        }
        else{
            return true;
        }
    }

    public function saveDataBatch($table,$data){    
        $this->db->transStart();
        $builder = $this->db->table($table);
        $result = $builder->insertBatch($data);
        $this->db->transComplete();
        if($result==false){
            return false;
        }
        else{
            return true;
        }
    }

    public function saveDataReturnInsertID($table,$data){    
        $this->db->transStart();
        $builder = $this->db->table($table);
        $result = $builder->insert($data);
        $this->db->transComplete();
        if($result==false){
            return false;
        }
        else{
            return $this->db->insertID();
        }
    }

    public function updateDataById($table,$data,$id){  
        $this->db->transStart();
        $builder = $this->db->table($table);
        $builder->set($data);        
        $builder->where('id', $id);
        $result = $builder->update();
        $this->db->transComplete();
        if($result==false){
            return false;
        }
        else{
            return true;
        }
    }

    public function deleteData($table,$id){ 
        $this->db->transStart();
        $builder = $this->db->table($table);
        $builder->where('id', $id);
        $result = $builder->delete();
        $this->db->transComplete();
        if($result==false){
            return false;
        }
        else{
            return true;
        }
    }

    public function deleteDataByCustomField($table,$field,$value){
        $this->db->transStart();
        $builder = $this->db->table($table);
        $builder->where($field, $value);
        $result = $builder->delete();
        $this->db->transComplete();
        if($result==false){
            return false;
        }
        else{
            return true;
        }
    }

    public function deleteAllData($table){
        $this->db->transStart();
        $builder = $this->db->table($table);
        $result = $builder->truncate();
        $this->db->transComplete();
        if($result==false){
            return false;
        }
        else{
            return true;
        }
    }

    public function updateDataByField($table,$data,$key,$value){
        $this->db->transStart();
        $builder = $this->db->table($table);
        $builder->set($data);        
        $builder->where($key, $value);
        $result = $builder->update();
        $this->db->transComplete();
        if($result==false){
            return false;
        }
        else{
            return true;
        }
    }

    public function updateDataByFieldArray($table,$data,$condition){
        $this->db->transStart();
        $builder = $this->db->table($table);
        $builder->set($data);        
        $builder->where($condition);
        $result = $builder->update();
        $this->db->transComplete();
        if($result==false){
            return false;
        }
        else{
            return true;
        }
    }

    public function getInsertIdFromTable($table,$data){        
        $builder = $this->db->table($table);
        $builder->where($data);
        $query = $builder->get();
        $results = $query->getResultArray();
        if(sizeof($results)>0)
        {
            return $results[0]['id'];
        }else{
            return false;
        }
    }

    public function getData($sql){        
        $query = $this->db->query($sql);
        $results = $query->getResultArray();

        if(sizeof($results)>0)
        {
            $responce['status']=true;
            $responce['records']=$results;
        }else{
            $responce['status']=false;
            $responce['records']='No Rocord Found!';
        }
        return $responce;
    }

    public function checkData($sql){        
        $query = $this->db->query($sql);
        $results = $query->getResultArray();
        if(sizeof($results)>0){
            return true;
        }else{
            return false;
        }
    }
}
