<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Facility extends MY_Controller {
	function __construct(){
		parent::__construct();
		if(!$this->isLoggedIn()){
			redirect(base_url(''));
		}
		if (!($this->session->userdata('rolecode') == SYSTEM_ADMIN)) {
			$this->session->set_flashdata('errors', "You don't have permission there.");
			redirect(base_url(''));
		}

		$this->load->model('common_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$this->load->library('encryption');
		$this->encryption->initialize([ 'cipher' => 'aes-256', 'mode' => 'ctr', 'key' => SECRET_KEY ]);
	}

	public function listing(){
		$data = array();
		$sql = "SELECT id,facility_code,facility_name,registration_number,is_superadmin FROM ".FACILITY;
		$data['facility_details'] = $this->common_model->raw_query($sql); 
		$data['active'] = 'facility';
		$data['content'] = 'facility/all_facility';
		$data['is_footer'] = false;		
		$this->load->view('layout/main', $data);		
	}  
	public function index(){

		$id 	= $this->current_user_id;
		$data = array();
		$data['sub_title'] = 'Facility';
		$data['active'] = 'facility';
		$data['value'] = $this->common_model->getById(USERS, $id);
		$role_id = $data['value']->role_id;
		$data['is_footer'] = false;
		$role_as = $this->common_model->getById('m_roles', $role_id);
		$data['values']  = $this->common_model->getOne(' m_users_patient', ['user_id' => $id]);

		$data['countries'] = $this->common_model->getAll('m_country');
		$data['states'] = $this->common_model->getAll('m_state');

		$data['facility_save_url'] = base_url('facility/save/');

		$data['content'] = 'facility/facility';
		$data['view_mode'] = 'new';
	 	$this->load->view('layout/main', $data);
	}

	/**
     * Validate the Date
     *
     * @param string $dob
     *
     * @return bool
     */

	public function date_check($dob)
    {
    	$dob = new DateTime($dob);
		$now = new DateTime(); 
	    if( !( $now->diff($dob)->y > 16 ) ) { 
            $this->form_validation->set_message('date_check', 'The {field} must be above 16 years');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * Validate the password
     *
     * @param string $password
     *
     * @return bool
     */
    public function valid_password($password = '')
    {
        $password = trim($password);
        $regex_lowercase = '/[a-z]/';
        $regex_uppercase = '/[A-Z]/';
        $regex_number = '/[0-9]/';
        $regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';
        if (empty($password))
        {
            $this->form_validation->set_message('valid_password', 'The {field} field is required.');
            return FALSE;
        }
        if (preg_match_all($regex_lowercase, $password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must be at least one lowercase letter.');
            return FALSE;
        }
        if (preg_match_all($regex_uppercase, $password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must be at least one uppercase letter.');
            return FALSE;
        }
        if (preg_match_all($regex_number, $password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must have at least one number.');
            return FALSE;
        }
        if (preg_match_all($regex_special, $password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must have at least one special character.' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>§~'));
            return FALSE;
        }
        if (strlen($password) < 5)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must be at least 5 characters in length.');
            return FALSE;
        }
        if (strlen($password) > 32)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field cannot exceed 32 characters in length.');
            return FALSE;
        }
        return TRUE;
    }

	public function adminsave( $facilityid = '' ){
		$form_data = $this->input->post(); 	
			
 		$this->form_validation->set_rules( 'nric', 'Name as per NRIC', 'required');
 		$this->form_validation->set_rules( 'email', 'Email', 'trim|required|valid_email');
 		$this->form_validation->set_rules( 'c_number', 'Contact number', 'required|min_length[10]|max_length[12]|regex_match[/^[0-9]+$/]' );
 		$this->form_validation->set_rules( 'gender_id', 'Gender', 'required' );
 		$this->form_validation->set_rules( 'dob', 'DOB', 'callback_date_check');
 		if ( $facilityid == '' ) { 
 			$this->form_validation->set_rules( 't_password', 'Password', 'callback_valid_password');
 		}	
 		$this->form_validation->set_rules( 'facility_id', 'Facility name', 'required' );
 		$this->form_validation->set_rules( 'is_active', 'Status', 'required');

		$response = array();		

		if ( $this->form_validation->run() == FALSE ) {
			$response['res'] = 'error';
			$response['error'] =  $this->form_validation->error_array();
			echo json_encode($response,true);
        } else{
        	
			$user_data['fname'] 			= isset($form_data['nric']) ? $form_data['nric'] : '';
			$user_data['gender_id'] 		= isset($form_data['gender_id']) ? $form_data['gender_id'] : '';
			$user_data['contact_number'] 	= isset($form_data['c_number']) ? $form_data['c_number'] : '';
			$user_data['email'] 			= isset($form_data['email']) ? $form_data['email'] : '';
			$user_data['facility_id'] 		= isset($form_data['facility_id']) ? $form_data['facility_id'] : '';

			$where = array();
			$where['email'] = $user_data['email'] ;

			if ( $facilityid == '' ) {				
				$user_data['password'] 			= isset($form_data['t_password']) ? $form_data['t_password'] : '';
			} else{
				$where['id !='] = $facilityid;  
			}	

			$is_exists = $this->common_model->getOne( USERS, $where ); 

			if (!empty($is_exists)) {
				$response['error'] = array( 'email'=>"Email Already Exists!" );
				$response['res'] = 'error';
				echo json_encode($response); die();
			}

			$user_data['role_id'] 			= 3;
			$user_data['is_obsolete'] = isset($form_data['is_active']) ? $form_data['is_active'] : '';		
			$user_data['dob'] = isset($form_data['dob']) ? $form_data['dob'] : '';			
			$response = array();
			if ( $facilityid == "" ) { 				

				$user_data['updated_date'] = date("Y/m/d h:i:sa");	
				$user_data['updated_by'] = $this->session->userdata('id');

				$last_user_insert_id = $this->common_model->insert(USERS,$user_data); 
				$facility_admin_data = array();
				$facility_admin_data['user_id'] = $last_user_insert_id;
				$facility_admin_data['facility_id'] = $user_data['facility_id'];
				$facility_admin_insert_id = $this->common_model->insert('facility_admin',$facility_admin_data); 

				$to 		= $form_data['email'];
				$subject 	= "Welcome to NCSM Registry";

				$encrypt_url = $this->encryption->encrypt($last_user_insert_id) ;
	
				$url = base_url('verify/auth?id='.$encrypt_url);
	
				$body = 'Welcome '.$user_data['fname'].' to NCSM Cancer Registry'
				. '<br><br>'
				. 'You registered an account on NCSM Cancer Registry with Email '.$to.' come and before being able to use your account you need to verify that this is your email address by clicking here: ' 
				. '<a href="'.$url.'">Please Verify Your Email</a><br>'				
				. '<br><br>'
				. 'Kind Regards,'
				. '<br>'
				. 'NCSM Registry'
				. '<br>';

				$email_response = $this->send_email($to, $subject, $body); 
				$response['res'] = 'success';
				$response['success'] = 'New Facility admin added successfully.'; 

				echo json_encode($response,true);	die();

    		} else {  
    			$user_data['id'] = $facilityid; 
    			$result = $this->common_model->update_table( USERS, $user_data, $facilityid);  


    			$facility_admin_count = $this->common_model->countRows("facility_admin", array('user_id' => $facilityid));
    			if($facility_admin_count>0){
    				$facility_admin_data = array();
					$facility_admin_data['facility_id'] = $form_data['facility_id']; 
					$facility_admin_insert_id = $this->common_model->update('facility_admin', array('user_id' => $facilityid), $facility_admin_data);
    			} else {
    				$facility_admin_data = array();
					$facility_admin_data['user_id'] = $facilityid;
					$facility_admin_data['facility_id'] = $user_data['facility_id'];
					$facility_admin_insert_id = $this->common_model->insert('facility_admin',$facility_admin_data); 
    			}
    			
				$response['res'] = 'success';
				$response['success'] = 'Facility admin updated successfully'; 
				echo json_encode($response,true); die();
			}

        }
	}

	public function save( $facilityid = '' ){
	 	$form_data = $this->input->post();
	 	$rules = array(
				        array(
			                'field' => 'facility_code',
			                'label' => 'facility code',
			                'rules' => 'required'
				        ),  
				        array(
			                'field' => 'facility_name',
			                'label' => 'facility name',
			                'rules' => 'required'
				        ),  
				        array(
			                'field' => 'reg_number',
			                'label' => 'registration number',
			                'rules' => 'required'
				        ),  
				        array(
			                'field' => 'post_code',
			                'label' => 'post code',
			                'rules' => 'required|regex_match[/^[0-9]{5}$/]'
				        ),  
				        array(
			                'field' => 'phone_number',
			                'label' => 'phone number',
			                'rules' => 'required|min_length[10]|max_length[12]|regex_match[/^[0-9]+$/]'
				        ),   
					);
		$this->form_validation->set_rules($rules); 
		$response = array();
		if ( $this->form_validation->run() == FALSE ) {
			$response['res'] = 'error';
			$response['error'] =  $this->form_validation->error_array();
			echo json_encode($response,true);
        } else {
		 	$field_data = array();
		 	$field_data['facility_code'] = isset($form_data['facility_code']) ? $form_data['facility_code'] : '';
			$field_data['facility_name'] = isset($form_data['facility_name']) ? $form_data['facility_name'] : '';
			$field_data['registration_number'] = isset($form_data['reg_number']) ? $form_data['reg_number'] : '';
			$field_data['address1'] = isset($form_data['address1']) ? $form_data['address1'] : '';
			$field_data['address2'] = isset($form_data['address2']) ? $form_data['address2'] : '';
			$field_data['address3'] = isset($form_data['address3']) ? $form_data['address3'] : '';
			$field_data['postcode'] = isset($form_data['post_code']) ? $form_data['post_code'] : '';
			$field_data['city	'] = isset($form_data['city']) ? $form_data['city'] : '';
			$field_data['countryid'] = isset($form_data['country_name']) ? $form_data['country_name'] : '';
			$field_data['stateid'] = isset($form_data['state_id']) ? $form_data['state_id'] : '';
			$field_data['phonenumber1'] = isset($form_data['phone_number']) ? $form_data['phone_number'] : '';
			$field_data['is_obsolete'] = isset($form_data['is_obsolete']) ? $form_data['is_obsolete'] : '';

			$error = array(); 

			if( $facilityid == "" ){
				if($field_data['facility_code'] != ""){ 
					$where1 = ['facility_code' => $field_data['facility_code']];
					$result = $this->common_model->getAll('m_facility',$where1); 
					if(!empty($result)){
						$error['facility_code'] = 'Facility Code already exist';
					}
				} 
				if($field_data['facility_name'] != ""){
					$where1 = ['facility_name' => $field_data['facility_name']];
					$result = $this->common_model->getAll('m_facility',$where1);
					if(!empty($result)){
						$error['facility_name'] = 'Facility Name already exist';
					}
				} 
			}
					

			if(empty($error)){
        		if ( $facilityid == "" ) { 
					$result = $this->common_model->insert('m_facility',$field_data);  
					if($result != 0){
						$response['res'] = 'success';
						$response['success'] = 'New Facility added successfully';
					}
        		} else {  
        			$field_data['id'] = $facilityid;
        			unset( $field_data['facility_code'] ); 
        			unset( $field_data['facility_name'] ); 
        			$result = $this->common_model->update_table( FACILITY, $field_data, $facilityid); 
    				if($result != 0){
						$response['res'] = 'success';
						$response['success'] = 'Facility updated successfully';
					} 
				}		
				
			}else{
				$response['res'] = 'error';
				$response['error'] = $error;
			}
			echo json_encode($response); 
		}
		exit();	
	}	

	public function view( $facilityid ){
	 	$id 	= $this->current_user_id;
		$data = array();
		$data['sub_title'] = 'Facility';
		$data['active'] = 'facility';
		$data['value'] = $this->common_model->getById(USERS, $id);
		$role_id = $data['value']->role_id;
		$data['is_footer'] = false;
		$role_as = $this->common_model->getById('m_roles', $role_id);
		$data['values']  = $this->common_model->getOne(' m_users_patient', ['user_id' => $id]);
		$data['countries'] = $this->common_model->getAll('m_country');
		$data['states'] = $this->common_model->getAll('m_state');
		$data['content'] = 'facility/facility';

		$facility_details = $this->common_model->getOne( FACILITY, ['id' => $facilityid ]);  
		if( empty( $facility_details ) ) {
			$this->output->set_status_header('404');
       		echo "404 - page not found";
		} else {	
			$data['facility_details'] = (array)$facility_details;
			$data['facility_save_url'] = base_url('facility/save/'.$facilityid);
			$data['view_mode'] = 'view';
		 	$this->load->view('layout/main', $data);
		}
	}

	public function edit( $facilityid ){
	 	$id 	= $this->current_user_id;
		$data = array();
		$data['sub_title'] = 'Facility';
		$data['active'] = 'facility';
		$data['value'] = $this->common_model->getById(USERS, $id);
		$role_id = $data['value']->role_id;
		$data['is_footer'] = false;
		$role_as = $this->common_model->getById('m_roles', $role_id);
		$data['values']  = $this->common_model->getOne(' m_users_patient', ['user_id' => $id]);
		$data['countries'] = $this->common_model->getAll('m_country');
		$data['states'] = $this->common_model->getAll('m_state');
		$data['content'] = 'facility/facility';
		$facility_details = $this->common_model->getOne( FACILITY, ['id' => $facilityid ]);  
		if( empty( $facility_details ) ) {
			$this->output->set_status_header('404');
       		echo "404 - page not found";
		} else {	
			$data['facility_details'] = (array)$facility_details;
			$data['facility_save_url'] = base_url('facility/save/'.$facilityid);
			$data['view_mode'] = 'edit';
		 	$this->load->view('layout/main', $data);
		}
	}
	
	public function fetch_state(){
		$country_id = $this->input->get('country_id');
		$states = $this->common_model->getAll('m_state', array('country_id' => $country_id));
		echo json_encode($states);
	}

	public function adminlisting(){
		$data = array(); 
		$updated_by = $this->session->userdata('id');
		$sql = "SELECT mfu.id,mfu.fname,mf.facility_name,mfu.is_obsolete FROM ".USERS." as mfu LEFT JOIN m_facility as mf ON mfu.facility_id = mf.id where mfu.updated_by = $updated_by;";
		$data['facility_details'] = $this->common_model->raw_query($sql); 
		$data['active'] = 'facilityadmin';
		$data['content'] = 'facility/all_admin_facility';
		$data['is_footer'] = false;		
		$this->load->view('layout/main', $data);
	}
	public function adminfacility( $facilityid = '' ){  
	 	$id 	= $this->current_user_id;
		$data = array();
		$data['sub_title'] = 'Facility';
		$data['active'] = 'facility';
		$data['value'] = $this->common_model->getById(USERS, $id);
		$role_id = $data['value']->role_id;
		$data['is_footer'] = false;
		$role_as = $this->common_model->getById('m_roles', $role_id);
		$data['values']  = $this->common_model->getOne(' m_users_patient', ['user_id' => $id]);
		$data['countries'] = $this->common_model->getAll('m_country');
		$data['states'] = $this->common_model->getAll('m_state');
		$data['content'] = 'facility/adminfacility';
		$data['genders'] = $this->common_model->getdata();		
		$sql = "SELECT id,facility_name FROM ".FACILITY;
		$data['facility'] = $this->common_model->raw_query( $sql );

		$sql = "SELECT DISTINCT facility_id FROM facility_admin WHERE facility_id != 0";
		$data['assignedfacility'] = $this->common_model->raw_query( $sql );

		$current_facility = $this->common_model->getOne( 'facility_admin', ['user_id' => $facilityid ] );
		if(empty($current_facility)){
			$data['current_facility'] = 0;
		} else {
			$data['current_facility'] = $current_facility->facility_id;
		}

		$facility_details = (array)$this->common_model->getOne( USERS, ['id' => $facilityid ]);   

		if( $facilityid != '' and empty( $facility_details ) ) {
			$this->output->set_status_header('404');
       		echo "404 - page not found";
		} else {	
			$data['facility_details'] = (array)$facility_details;
			$data['facility_save_url'] = base_url('facility/adminsave/'.$facilityid);
			$data['view_mode'] = 'view';
		 	$this->load->view('layout/main', $data);
		}
	}
	public function adminfacilityedit( $facilityid = '' ){
	 	$id 	= $this->current_user_id;
		$data = array();
		$data['sub_title'] = 'Facility';
		$data['active'] = 'facility';
		$data['value'] = $this->common_model->getById(USERS, $id);
		$role_id = $data['value']->role_id;
		$data['is_footer'] = false;
		$role_as = $this->common_model->getById('m_roles', $role_id);
		$data['values']  = $this->common_model->getOne(' m_users_patient', ['user_id' => $id]);
		$data['countries'] = $this->common_model->getAll('m_country');
		$data['states'] = $this->common_model->getAll('m_state');
		$data['content'] = 'facility/adminfacility';
		$data['genders'] = $this->common_model->getdata();		
		$sql = "SELECT id,facility_name FROM ".FACILITY;
		$data['facility'] = $this->common_model->raw_query( $sql );

		$sql = "SELECT DISTINCT facility_id FROM facility_admin WHERE facility_id != 0 and user_id != $facilityid";
		$data['assignedfacility'] = $this->common_model->raw_query( $sql );

		$current_facility = $this->common_model->getOne( 'facility_admin', ['user_id' => $facilityid ] );
		if(empty($current_facility)){
			$data['current_facility'] = 0;
		} else {
			$data['current_facility'] = $current_facility->facility_id;
		}

		$facility_details = (array)$this->common_model->getOne( USERS, ['id' => $facilityid ]);   
		if( $facilityid != '' and empty( $facility_details ) ) {
			$this->output->set_status_header('404');
       		echo "404 - page not found";
		} else {	
			$data['facility_details'] = (array)$facility_details;
			$data['facility_save_url'] = base_url('facility/adminsave/'.$facilityid);
			$data['view_mode'] = 'edit';
		 	$this->load->view('layout/main', $data);
		}
	}
	public function facilityadmin(){
		$id 	= $this->current_user_id;
		$data = array();
		$data['sub_title'] = 'Facility';
		$data['active'] = 'facility';
		$data['value'] = $this->common_model->getById(USERS, $id);
		$role_id = $data['value']->role_id;
		$data['is_footer'] = false;
		$role_as = $this->common_model->getById('m_roles', $role_id);
		$data['values']  = $this->common_model->getOne(' m_users_patient', ['user_id' => $id]);

		$sql = "SELECT id,facility_name FROM ".FACILITY;
		$data['facility'] = $this->common_model->raw_query( $sql ); 

		$sql = "SELECT DISTINCT facility_id FROM facility_admin WHERE facility_id != 0";
		$data['assignedfacility'] = $this->common_model->raw_query( $sql );
		
		$data['facility_save_url'] = base_url('facility/adminsave/');
		$data['genders'] = $this->common_model->getdata();		
		$data['content'] = 'facility/adminfacility';
		$data['view_mode'] = 'new';
	 	$this->load->view('layout/main', $data);
	}

}
