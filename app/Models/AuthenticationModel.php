<?php namespace App\Models;
use CodeIgniter\Model;

class AuthenticationModel extends DyoModels
{
    public function __construct(){
        parent::__construct();
    }

    public function getAdminLogin($post){
        $mobile = $post['mobile'];
        $password = $post['password'];
        $results = $this->getEmployeeLogin($mobile,$password);
        if(sizeof($results)>0 && $results['status']){
            $responce['session_status']=true;
            $responce['is_login']=true;
            $responce['session_fname'] = $results["employee_fname"];            
            $responce['session_lname'] = $results["employee_lname"];            
            $responce['session_team_unique_id'] = $results["employee_unique_id"];             
            $responce['session_team_id'] = $results["employee_id"];            
            $responce['session_designation'] = $results["department_name"];    
            $responce['session_role_id'] = $results["role_id"];         
            $responce['session_role_name'] = $results["role_name"];            
            $responce['session_code'] = $results["employee_code"];
        }else{
            $responce['session_status'] = false;
            $responce['is_login'] = false;
            $responce['session_fname'] = "";            
            $responce['session_lname'] = "";            
            $responce['session_team_unique_id'] = "";            
            $responce['session_team_id'] = "";            
            $responce['session_designation'] = "";    
            $responce['session_role_id'] = "";            
            $responce['session_role_name'] = "";            
            $responce['session_code'] = "";
        }
        return $responce;
    }
}