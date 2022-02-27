<?php namespace App\Controllers;
use CodeIgniter\Controller;
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 

class Team extends BaseController
{
	public function __construct() {	
        date_default_timezone_set("Australia/Sydney");
		require_once APPPATH.'ThirdParty/PHPmailer/Exception.php'; 
		require_once APPPATH.'ThirdParty/PHPmailer/PHPMailer.php'; 
		require_once APPPATH.'ThirdParty/PHPmailer/SMTP.php'; 
    }

	public function index(){
        $session = \Config\Services::session();
        $dyomodels = model('App\Models\DyoModels');
        if($session->get('is_login') && $dyomodels->checkRolePermission($session->get('session_role_id'),5,'can_view')){            
            $data['fname'] = $session->get('fname');
            $data['team_id'] = $session->get('team_id');
            $data['designation'] = $session->get('designation');
            $data['is_admin'] = $session->get('is_admin');
            $data['access_type'] = $session->get('access_type');
            $data['team'] = $dyomodels->getData('SELECT * FROM `team` ORDER BY id');
            $data['roles'] = $dyomodels->getData('SELECT * FROM `role`');
            $data['all_member'] = $dyomodels->getData('SELECT id, fname, lname, code, status FROM `team` ORDER BY id DESC');
            $data['master_partner_code'] = $dyomodels->getData('SELECT id, company_name, code, status FROM `team` WHERE member_type = 2 ORDER BY id DESC');
            //$data['access'] = $dyomodels->getData('SELECT * FROM `access`');
            echo view('team/manage',$data);
        }
        else{
            return redirect()->to(base_url()); 
        }
	}

	public function details($id){
        $session = \Config\Services::session();
        $dyomodels = model('App\Models\DyoModels');
        if($session->get('is_login') && $dyomodels->checkRolePermission($session->get('session_role_id'),5,'can_view')){            
            $sql = "SELECT team.*,role.name as member_type FROM team, role WHERE team.id = $id AND team.member_type = role.id";
            $team_member = $dyomodels->getData($sql);
            if($team_member['status']){             
                $data = $team_member['records'][0];
                $data['f_name'] = $team_member['records'][0]['fname'];
            }else{
                return redirect()->to(base_url()."/team");
            }
            $data['fname'] = $session->get('fname');
            $data['designation'] = $session->get('designation');
            $data['team_id'] = $session->get('team_id');
            $data['is_admin'] = $session->get('is_admin');
            $data['access_type'] = $session->get('access_type');
            $sql = "SELECT team_commission.*, retailers.name as retailers_name FROM team_commission LEFT JOIN retailers ON retailers.id = team_commission.retailer_id WHERE team_commission.team_id = $id ORDER BY team_commission_id DESC";
            $data['team_commission'] =  $dyomodels->getData($sql);
            $data['lead_notes'] = '';
            $sql = "SELECT team_notes.*, team.fname, team.lname FROM team_notes, team WHERE team_notes.team_id = team.id AND team_member_id = $id ORDER BY team_notes.id DESC";
            $lead_notes = $dyomodels->getData($sql);
            if($lead_notes['status']){
                $i = sizeof($lead_notes['records']);
                foreach($lead_notes['records'] as $rec){
                    $row = "row$i";
                    $create_date = date("d F Y", strtotime($rec['create_date'])) . " at " . date("h:i:s A", strtotime($rec['create_date']));
                    $data['lead_notes'] .= '<tr id="'.$row.'">
                        <td>'.$rec['notes'].'</td>
                        <td>
                            <div class="row">
                                <div class="col-12 small-grey">'.$create_date.' by '.$rec['fname'].' '.$rec['lname'].'</div>
                            </div>
                        </td>                            
                        <td>
                            <button class="btn btn-link" style="color:black;" onclick="showAddNotes('.$rec['team_member_id'].','.$rec['id'].',`'.$row.'`)"><i class="material-icons">create</i></button>
                        </td>
                    </tr>';
                    $i--;
                }
            }
            $data['lead_attachment'] = '';
            $sql = "SELECT team_attachment.*, team.fname, team.lname FROM team_attachment, team WHERE team_attachment.team_id = team.id AND team_member_id = $id ORDER BY team_attachment.id DESC";
            $lead_attachment = $dyomodels->getData($sql);
            $url = base_url().'/assets/leads/';
            if($lead_attachment['status']){
                $i = sizeof($lead_attachment['records']);
                foreach($lead_attachment['records'] as $rec){
                    $row = "attachment_row$i";
                    $file_url = $url.$rec['attachment'];
                    $create_date = date("d F Y", strtotime($rec['create_date'])) . " at " . date("h:i:s A", strtotime($rec['create_date']));
                    $data['lead_attachment'] .= '<tr id="'.$row.'">
                        <td><a target="_blank" href="'.$file_url.'">'.$rec['attachment'].'</a></td>
                        <td>
                            <div class="row">
                                <div class="col-12 small-grey">'.$create_date.' by '.$rec['fname'].' '.$rec['lname'].'</div>
                            </div>
                        </td>
                        <td>
                            <button class="btn btn-link" style="color:#cd201f;" onclick="deleteAttachment('.$rec['id'].',`'.$row.'`,`'.$rec['attachment'].'`)"><i class="material-icons">delete</i></button>
                        </td>
                    </tr>';
                    $i--;
                }
            }
            $data['reporting_manager_list'] = $dyomodels->getData('SELECT id, fname, lname, code, status FROM `team` ORDER BY id DESC');
            $data['master_partner_code_list'] = $dyomodels->getData('SELECT id, company_name, code, status FROM `team` WHERE member_type = 2 ORDER BY id DESC');
            $data['roles_list'] = $dyomodels->getData('SELECT * FROM `role`');
            $data['retailers'] = $dyomodels->getData('SELECT * FROM retailers');
            echo view('team/details',$data);
        }
        else{
            return redirect()->to(base_url()); 
        }
	}

    public function save(){
        $session = \Config\Services::session();
        $table = 'team';
        $dyomodels = model('App\Models\DyoModels');
        if($session->get('is_login') && $dyomodels->checkRolePermission($session->get('session_role_id'),5,'can_add')){
            $data = $this->request->getRawInput();
            //var_dump($data);
            $to = $data['email'];
            $password = $data['password'];
            $data['password'] = md5($data['password']);
            $email = $data['email'];
            $email = $dyomodels->checkData("SELECT * FROM team WHERE email = '$email'");
            $total = $dyomodels->getData('SELECT * FROM `team`');
            $code = $total['status']==false?0:sizeof($total['records']);
            if($email==false){
                $data['code'] = "SSP00". ($code + 1);
                $result = $dyomodels->saveData($table,$data);
                if($result){
                    $result = $this->sendEmail($to,$password);
                    $responce['status'] = "Success";
                    $responce['msg'] = "Data Saved! Please Wait...";
                }else{
                    $responce['status'] = "Fail";
                    $responce['msg'] = "Network error plese try again";
                }
            }else{
                $responce['status'] = "Fail";
                $responce['msg'] = "This Email Already Exists!";
            }
            echo json_encode($responce);
        }
        else{
            return redirect()->to(base_url());
        }
    }

    public function updateEachValue(){
        $session = \Config\Services::session();
        $table = 'team';
        $dyomodels = model('App\Models\DyoModels');
        if($session->get('is_login') && $dyomodels->checkRolePermission($session->get('session_role_id'),5,'can_edit')){
            $request = \Config\Services::request();
            $id = $this->request->getGet('id');
            $name = $this->request->getGet('name');
            $data[$name] = $this->request->getGet('value');
            $result = $dyomodels->updateDataById($table,$data,$id);
        }
        else{
            return redirect()->to(base_url());
        }
    }

    public function getTeamNotes($id){
        $session = \Config\Services::session();            
        $dyomodels = model('App\Models\DyoModels');
        if($session->get('is_login') && $dyomodels->checkRolePermission($session->get('session_role_id'),5,'can_view')){
            echo json_encode($dyomodels->getData("SELECT * FROM team_notes WHERE id = $id"));
        }
        else{
            return redirect()->to(base_url()); 
        }
    }

    public function getTeamCommission($id){
        $session = \Config\Services::session();            
        $dyomodels = model('App\Models\DyoModels');
        if($session->get('is_login') && $dyomodels->checkRolePermission($session->get('session_role_id'),5,'can_view')){
            echo json_encode($dyomodels->getData("SELECT * FROM team_commission WHERE team_commission_id = $id"));
        }
        else{
            return redirect()->to(base_url()); 
        }
    }

    public function saveTeamNotes(){
        $session = \Config\Services::session();
        $table = 'team_notes';
        $dyomodels = model('App\Models\DyoModels');
        if($session->get('is_login') && $dyomodels->checkRolePermission($session->get('session_role_id'),5,'can_add')){
            $data = $this->request->getRawInput();
            $notes = $data['notes'];
            $data['create_date'] = date('Y-m-d H:i:s');
            $create_date = date("d F Y", strtotime($data['create_date'])) . " at " . date("h:i:s A", strtotime($data['create_date']));
            $data['team_id'] = $session->get('team_id');
            $emp_name = $session->get('fname');
            $row_id = $data['row_id'];
            unset($data['row_id']);
            if(empty($data['note_id']) || $data['note_id'] == 0){
                unset($data['note_id']);
                $result = $dyomodels->saveDataReturnInsertID($table,$data);
                if($result!=false){
                    echo '
                        <td>'.$notes.'</td>
                        <td>
                            <div class="row">
                                <div class="col-12 small-grey">'.$create_date.' by '.$emp_name.'
                            </div>
                        </td>
                        <td>
                            <button class="btn btn-link" style="color:black;" onclick="showAddNotes('.$data['lead_id'].','.$result.',`'.$row_id.'`)"><i class="material-icons">create</i></button>
                        </td>';
                }else{                
                    echo "";
                }
            }else{
                $id = $data['note_id'];
                unset($data['note_id']);
                $result = $dyomodels->updateDataById($table,$data,$id);
                if($result){
                    echo '
                    <td>'.$notes.'</td>
                        <td>
                            <div class="row">
                                <div class="col-12 small-grey">'.$create_date.' by '.$emp_name.'
                            </div>
                        </td>
                        <td>
                            <button class="btn btn-link" style="color:black;" onclick="showAddNotes('.$data['lead_id'].','.$id.',`'.$row_id.'`)"><i class="material-icons">create</i></button>
                        </td>';
                }else{                
                    echo "";
                }
            }
        }
        else{
            return redirect()->to(base_url());
        }
    }

    public function saveTeamCommission(){
        $session = \Config\Services::session();
        $table = 'team_commission';
        $dyomodels = model('App\Models\DyoModels');
        if($session->get('is_login') && $dyomodels->checkRolePermission($session->get('session_role_id'),5,'can_add')){
            $data = $this->request->getRawInput();
            $data['create_date'] = date('Y-m-d H:i:s');
            $data['update_date'] = date('Y-m-d H:i:s');
            $effective_date = date("d/m/Y", strtotime($data['effective_date']));
            //$data['team_id'] = $session->get('team_id');
            //$emp_name = $session->get('fname');
            $row_id = $data['row_id'];
            unset($data['row_id']);
            $retailers_name = '';
            if(!empty($data['retailer_id'])){
                $retailers = $dyomodels->getData("SELECT name FROM retailers WHERE id = ".$data['retailer_id']);
                if($retailers['status']){
                    $retailers_name = " (".$retailers['records'][0]['name'].")";
                }
            }
            if(empty($data['team_commission_id']) || $data['team_commission_id'] == 0){
                unset($data['team_commission_id']);
                $result = $dyomodels->saveDataReturnInsertID($table,$data);
                if($result!=false){
                    $data['service_type'] = $data['service_type'] . $retailers_name;
                    echo '<td>'.$data['service_type'].'</td>
                        <td>'.$data['customer_type'].'</td>
                        <td>'.$data['deliverable_start_range'].' - '.$data['deliverable_end_range'].'</td>
                        <td>'.$data['deliverable_period'].'</td>
                        <td>'.$data['clawback_period'].' days</td>
                        <td>'.$data['clawback_criteria'].' days</td>
                        <td>$'.$data['upfront_commission'].'</td>
                        <td>'.$effective_date.'</td>
                        <td><button class="btn btn-link" style="color:black;padding:0px;" onclick="showAddCommission('.$data['team_id'].','.$result.',`'.$row_id.'`)"><i class="material-icons">create</i></button></td>
                        <td><button class="btn btn-link" style="color:#cd201f;padding:0px;" onclick="deleteCommission('.$result.',`'.$row_id.'`)"><i class="material-icons">delete</i></button></td>';
                }else{                
                    echo "";
                }
            }else{
                $id = $data['team_commission_id'];
                unset($data['team_commission_id']);
                $result = $dyomodels->updateDataByField($table,$data,'team_commission_id',$id);
                if($result){  
                    $data['service_type'] = $data['service_type'] . $retailers_name;                  
                    echo '<td>'.$data['service_type'].'</td>
                        <td>'.$data['customer_type'].'</td>
                        <td>'.$data['deliverable_start_range'].' - '.$data['deliverable_end_range'].'</td>
                        <td>'.$data['deliverable_period'].'</td>
                        <td>'.$data['clawback_period'].' days</td>
                        <td>'.$data['clawback_criteria'].' days</td>
                        <td>$'.$data['upfront_commission'].'</td>
                        <td>'.$effective_date.'</td>
                        <td><button class="btn btn-link" style="color:black;padding:0px;" onclick="showAddCommission('.$data['team_id'].','.$id.',`'.$row_id.'`)"><i class="material-icons">create</i></button></td>
                        <td><button class="btn btn-link" style="color:#cd201f;padding:0px;" onclick="deleteCommission('.$id.',`'.$row_id.'`)"><i class="material-icons">delete</i></button></td>';
                }else{                
                    echo "";
                }
            }
        }
        else{
            return redirect()->to(base_url());
        }
    }

    public function saveTeamAttachment(){
        $session = \Config\Services::session();
        $table = 'team_attachment';
        $dyomodels = model('App\Models\DyoModels');
        if($session->get('is_login') && $dyomodels->checkRolePermission($session->get('session_role_id'),5,'can_add')){
            $file = $this->request->getFile('attachment');
            $data = $this->request->getPost();
            $data['create_date'] = date('Y-m-d H:i:s');
            $create_date = date("d F Y", strtotime($data['create_date'])) . " at " . date("h:i:s A", strtotime($data['create_date']));
            $data['team_id'] = $session->get('team_id');
            $emp_name = $session->get('fname');
            $url = WRITEPATH;
            $url = str_replace("writable","assets",$url);
            $row_id = $data['row_id'];
            unset($data['row_id']);
            if($file->isValid() && !$file->hasMoved()){
                if($file->getClientExtension()=="pdf"){                    
                    $newName = $file->getRandomName();
                    try {
                        $file->move($url.'leads', $newName);
                        $data = array_merge($data,array("attachment"=>$newName));
                        $result = $dyomodels->saveDataReturnInsertID($table,$data);
                        $url = base_url().'/assets/leads/';
                        if($result!=false){
                            echo '
                                <td><a target="_blank" href="'.$url.$newName.'">'.$newName.'</a></td>
                                <td>
                                    <div class="row">
                                        <div class="col-12 small-grey">'.$create_date.' by '.$emp_name.'</div>
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-link" style="color:#cd201f;" onclick="deleteAttachment('.$result.',`'.$row_id.'`,`'.$newName.'`)"><i class="material-icons">delete</i></button>
                                </td>';
                        }else{                
                            echo "Error accured please refresh page.";
                        }
                    }catch (\Exception $e){                        
                        echo "Error accured please refresh page.";
                    }
                }
            }
        }
        else{
            return redirect()->to(base_url());
        }
    }

	public function deleteCommission($id){
		$session = \Config\Services::session();            
        $dyomodels = model('App\Models\DyoModels');
        if($session->get('is_login') && $dyomodels->checkRolePermission($session->get('session_role_id'),5,'can_edit')){
        	$table = "team_commission";
        	if($dyomodels->deleteDataByCustomField($table,'team_commission_id',$id)){
        		echo true;
        	}else{                
        		echo false;
            }
        }
        else{
            return redirect()->to(base_url()); 
        }
	}

	public function deleteTeamAttachment($id){
		$session = \Config\Services::session();            
        $dyomodels = model('App\Models\DyoModels');
        if($session->get('is_login') && $dyomodels->checkRolePermission($session->get('session_role_id'),5,'can_edit')){
        	$table = "team_attachment";
        	if($dyomodels->deleteData($table,$id)){
                $file = $this->request->getRawInput();
                $file_name = $file['file_name'];
                $url = WRITEPATH;
                $url = str_replace("writable","assets/leads",$url);
                $url = $url.$file_name;
                unlink($url);
        		echo true;
        	}else{                
        		echo false;
            }
        }
        else{
            return redirect()->to(base_url()); 
        }
	}

    public function sendEmail($to,$password){	
		$mail = new PHPMailer;
        $mail->SMTPDebug = SMTP_Debug;
        $mail->isSMTP();
        $mail->Host     = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_UNAME;
        $mail->Password = SMTP_PWORD;
        $mail->SMTPSecure = SMTP_SSL;
        $mail->Port     = SMTP_PORT;
        $mail->setFrom(SMTP_FROM_EMAIL, 'no reply');
        $mail->addReplyTo(SMTP_FROM_EMAIL, 'no reply');    
        // Add a recipient
        $mail->addAddress($to);
        // Email subject
        $mail->Subject = 'Your new password';    
        // Set email format to HTML
        $mail->isHTML(true);    
        // Email body content
        $mailContent = "Thank you for being a member of team. Your username is: ".$to." and password is ".$password."<br/>Regards<br/>Select and Switch Team";
        $mail->Body = $mailContent;    
        // Send email
        if(!$mail->send()){
            return false;
        }else{
            return true;
        }
    }

    public function getData($id){
        $session = \Config\Services::session();
        $dyomodels = model('App\Models\DyoModels');
        if($session->get('is_login') && $dyomodels->checkRolePermission($session->get('session_role_id'),5,'can_view')){            
            echo json_encode($dyomodels->getData("SELECT * FROM team WHERE id = $id"));
        }
        else{
            return redirect()->to(base_url()); 
        }
    }

    public function update(){
        $session = \Config\Services::session();   
        $dyomodels = model('App\Models\DyoModels');
        if($session->get('is_login') && $dyomodels->checkRolePermission($session->get('session_role_id'),5,'can_edit')){
            $data = $this->request->getRawInput();
            $table = "team";
            $id = $data['id'];
            $email = $data['email'];
            if(empty($data['password'])){
                unset($data['password']);
            }else{
                $data['password'] = md5($data['password']);
            }
            if(empty($data['code'])){
                unset($data['code']);
            }
            if ($this->request->isAJAX() && $this->request->getMethod()=='post' && $this->checkEmpty($data))
            {
                $email = $dyomodels->checkData("SELECT * FROM team WHERE email = '$email'");
                if($email!=false){
                    $result = $dyomodels->updateDataById($table, $data,$id);
                    if($result){
                        $responce['status'] = "Success";
                        $responce['msg'] = "Details Updated! Please Wait...";
                    }else{
                        $responce['status'] = "Fail";
                        $responce['msg'] = "Network error plese try again";
                    }
                }else{
                    $responce['status'] = "Fail";
                    $responce['msg'] = "This Email Already Exists!";
                }
            }
            else{
                $responce['status'] = "Fail";
                $responce['msg'] = "Wrong Request Type!";
            }
            echo json_encode($responce);
        }
        else{
            return redirect()->to(base_url()); 
        }
    }

    public function changePassword(){
        $session = \Config\Services::session();      
        $responce = array();
        $dyomodels = model('App\Models\DyoModels');
        if($session->get('is_login') && $dyomodels->checkRolePermission($session->get('session_role_id'),5,'can_edit')){ 
            $data = $this->request->getRawInput();
            $table = "team";
            $id = $data['id'];
            $password = $data['password'];
            $is_send_notification = empty($data['is_send_notification'])?0:1;
            unset($data['is_send_notification']);
            if(empty($data['password'])){
                unset($data['password']);
            }else{
                $data['password'] = md5($data['password']);
            }
            if ($this->request->isAJAX() && $this->request->getMethod()=='post' && $this->checkEmpty($data))
            {
                $result = $dyomodels->updateDataById($table, $data, $id);
                if($result){
                    if($is_send_notification){
                        $teams = $dyomodels->getData("SELECT email FROM team WHERE id = $id");
                        if($teams['status']){
                            $to = $teams['records'][0]['email'];
                            $result = $this->sendEmail($to,$password);
                        }
                    }
                    $responce['status'] = "Success";
                    $responce['msg'] = "Password changes successfully!";
                }else{
                    $responce['status'] = "Fail";
                    $responce['msg'] = "Network error plese try again";
                }
            }
            else{
                $responce['status'] = "Fail";
                $responce['msg'] = "Wrong Request Type!";
            }
        }
        else{
            $responce['status'] = "Fail";
            $responce['msg'] = "Please Login First!";
        }
        echo json_encode($responce);
    }
}
