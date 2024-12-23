<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends CI_Controller{
	public $current_user_id=null;
	public $current_user=null;
	public function __construct(){
		parent::__construct();
		// $this->load->helper('urlencode_helper');
		if($this->session->userdata('id')){
			$this->current_user_id 		= $this->session->userdata('id');
			$this->current_user_role 	= $this->session->userdata('role');
			$this->current_user 		= $this->common_model->getOne(USERS,array('id'=>$this->current_user_id));
		}
	}

	public function logger( $to = null, $subject = null , $body = null ){     
           $log  = date("j.n.Y h:i:s")." || " .  $to  ." || " .  $subject . " || " .  $body ; 
           file_put_contents('application/logs.txt', $log.PHP_EOL , FILE_APPEND | LOCK_EX);                
    }

	public function isLoggedIn(){
	
		 $userID = $this->session->userdata('id');
		 if($userID != null && $userID > 0){
		 	return true;
		 }else{
	 	return false;
		 }
	}

	public function get_role_info($role_id=null, $rolecode=null){

		if (!empty($role_id)) {
			return $this->common_model->getById(ROLES, $role_id);	
		} else if(!empty($rolecode)){
			return $this->common_model->getOne(ROLES, ['rolecode' => $rolecode]);	
		} else {
			false;
		}
	}

	public function showFlash(){
		  $error = $this->session->userdata('errors');
		  $success = $this->session->userdata('success');
		  if($error){
		      echo '<div class="alert alert-danger alert-dismissable"> ';
	          echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
	          print_r($error);
	         
	          echo'</div>';
	          unset($_SESSION['errors']);
		  }else if($success) {
	          echo '<div class="alert alert-success alert-dismissable"> ';
              echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
              print_r($success);
              
              echo'</div>';
              unset($_SESSION['success']);
		  }
	}

	public function menus() {
		$this->db->select("
    		menus.*
    	");

        $this->db->from("menus");
        $this->db->join('menu_orders', 'menus.id = menu_orders.menu_id', "inner");
        $this->db->join('categories', 'categories.menu_id = menus.id', "inner");
        $this->db->group_by('categories.menu_id');
        $this->db->order_by("menu_orders.id");
        $menus = $this->db->get()->result();
        // debug($menus);
        return $menus;
	}

	public function get_assessments_info(){
		$assessment_types = $this->common_model->getAll(ASSESSMENT_TYPES, ['is_obsolete' => NOT_OBSOLETE]);				
		$data = [];
		foreach ($assessment_types as $key => $assessment_type) {
			$data[$assessment_type->assessment_type."_assessment"] = [
				'assessment_type' => $assessment_type->assessment_type,
				'assessment_type_id' => $assessment_type->assessment_type_id,
			];
			
			$assessment_tools = $this->common_model->getAll(ASSESSMENT_TOOLS, ['is_obsolete' => NOT_OBSOLETE, 'assessment_types_id' => $assessment_type->assessment_type_id]);				
			if(!empty($assessment_tools)){
				foreach ($assessment_tools as $key => $assessment_tool) {
					if ($assessment_tool->assessment_sub_type_id == 1) {
						$data[$assessment_type->assessment_type."_assessment"]['assessment_tools']['self'][] = [
							'id' => $assessment_tool->id,
							'assessment_tool_code' => $assessment_tool->assessment_tool_code,
							'assessment_tool' => $assessment_tool->assessment_tool,
							'assessment_tool_name' => $assessment_tool->assessment_tool_name,
							'assessment_sub_type_id' => $assessment_tool->assessment_sub_type_id,
						];	

					} else if($assessment_tool->assessment_sub_type_id == 2){
						$data[$assessment_type->assessment_type."_assessment"]['assessment_tools']['clinical'][] = [
							'id' => $assessment_tool->id,
							'assessment_tool_code' => $assessment_tool->assessment_tool_code,
							'assessment_tool' => $assessment_tool->assessment_tool,
							'assessment_tool_name' => $assessment_tool->assessment_tool_name,
							'assessment_sub_type_id' => $assessment_tool->assessment_sub_type_id,
						];
					} else if($assessment_tool->assessment_sub_type_id == 3){
						$data[$assessment_type->assessment_type."_assessment"]['assessment_tools']['other'][] = [
							'id' => $assessment_tool->id,
							'assessment_tool_code' => $assessment_tool->assessment_tool_code,
							'assessment_tool' => $assessment_tool->assessment_tool,
							'assessment_tool_name' => $assessment_tool->assessment_tool_name,
							'assessment_sub_type_id' => $assessment_tool->assessment_sub_type_id,
						];
					}
				}
			}

		}

		return $data;
	}

	public function get_assessment_type_info($id=null, $code=null){

		if ($id) {
			$where = ['assessment_type_id' => $id];
		} else if ($code) {
			$where = ['assessment_type_code' => $code];
		}

		$data = $this->common_model->getOne(ASSESSMENT_TYPES, $where);
		return $data;
	}

	public function get_assessment_sub_type_info($id=null, $code=null){
		if ($id) {
			$where = ['id' => $id];
		} else if ($code) {
			$where = ['assessment_sub_type_code' => $code];
		}

		$data = $this->common_model->getOne(M_ASSESSMENT_SUB_TYPES, $where);
		return $data;
	}

	public function get_assessment_tool_info($id=null, $code=null){
		if ($id) {
			$where = ['id' => $id];
		} else if ($code) {
			$where = ['assessment_tool_code' => $code];
		}

		$data = $this->common_model->getOne(ASSESSMENT_TOOLS, $where);

		return $data;
	}

	public function send_email($to = null, $subject = null , $body = null) {

		//$this->logger( $to, $subject, $body);
		
		$SMTP_User = $this->common_model->getOne(GLOBALSETTING, ['keyname' => 'SMTP_User', 'is_obsolete' => NOT_OBSOLETE])->keyvalue;
		$SMTP_PASS = $this->common_model->getOne(GLOBALSETTING, ['keyname' => 'SMTP_PASS', 'is_obsolete' => NOT_OBSOLETE])->keyvalue;
		$SMTP_PORT = $this->common_model->getOne(GLOBALSETTING, ['keyname' => 'SMTP_PORT', 'is_obsolete' => NOT_OBSOLETE])->keyvalue;
		$SMTP_SECURE = $this->common_model->getOne(GLOBALSETTING, ['keyname' => 'SMTP_SECURE', 'is_obsolete' => NOT_OBSOLETE])->keyvalue;
		$SMTP_HOST = $this->common_model->getOne(GLOBALSETTING, ['keyname' => 'SMTP_HOST', 'is_obsolete' => NOT_OBSOLETE])->keyvalue;

		try{

			require APPPATH.'third_party/e_mail/class.phpmailer.php';

			$to = str_replace("'", "", $to);

		    $mail = new PHPMailer(); // create a new object
		    $mail->IsSMTP(); // enable SMTP
		    $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
		    $mail->SMTPAuth = true; // authentication enabled
		    $mail->SMTPSecure = $SMTP_SECURE ; // secure transfer enabled REQUIRED for GMail
		    $mail->Host = $SMTP_HOST;
		    $mail->Port = $SMTP_PORT; // or 587
		    $mail->IsHTML(true);
		    $mail->Username = $SMTP_User;
		    $mail->Password = $SMTP_PASS;
		    $mail->SetFrom('ncsm.official@gmail.com','ncsm.official');
		    $mail->Subject = $subject;
		    $mail->Body = $body;
		    $mail->AddAddress($to);
		    
		    
		    if(!$mail->Send()){
		    	$response['success'] = false;
		    	$response['msg'] = $mail->ErrorInfo;
		    } else {
		    	$response['success'] = true;
		    	$response['msg'] = "Signup email sent successfully!";
		    } 
		} catch(Exception $e){ 
		    $response['success'] = false;
		    $response['msg'] = "Error";

		}
	    return $response;
	}

	public function update_assessment_counter($assessment_header_id) {
		$assessment_header = $this->common_model->getById(ASSESSMENT_HEADER, $assessment_header_id);
		if (!empty($assessment_header)) {
			$patient_id = $assessment_header->patient_id;
			$user_patient = $this->common_model->getOne(USERS_PATIENT, ['user_id' => $patient_id]);
			$assessment_counter = $user_patient->assessment_counter;
			$assessment_counter++;
			$this->common_model->update(USERS_PATIENT, ['user_id' => $patient_id], ['assessment_counter' => $assessment_counter]);
		}
	}

}
