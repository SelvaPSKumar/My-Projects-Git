<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	private $table = USERS;
	function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('common_model');
		$this->load->helper('email');

		$this->load->library('encryption');
		$this->encryption->initialize([ 'cipher' => 'aes-256', 'mode' => 'ctr', 'key' => SECRET_KEY ]);
	}

public function test(){
	$this->send_email('shoaibjakhar11@gmail.com', "testing", "Hello world!");

}

	public function signup()
	{
		$form_data = $this->input->post();
		$user_data['user_type']			= isset($form_data['user_type']) ? $form_data['user_type'] : '';
		$user_data['fname'] 			= isset($form_data['fname']) ? $form_data['fname'] : '';
		$user_data['mname'] 			= isset($form_data['mname']) ? $form_data['fname'] : '';
		$user_data['lname'] 			= isset($form_data['lname']) ? $form_data['lname'] : '';
		$user_data['registration_number'] 	= isset($form_data['registration_number']) ? $form_data['registration_number'] : '';
		$user_data['gender_id'] 		= isset($form_data['gender_id']) ? $form_data['gender_id'] : '';
		$user_data['facility_id'] 		= isset($form_data['facility_id']) ? $form_data['facility_id'] : '';
		$user_data['contact_number'] 	= isset($form_data['contact_number']) ? $form_data['contact_number'] : '';
		$user_data['email'] 			= isset($form_data['email']) ? $form_data['email'] : '';
		$user_data['password'] 			= isset($form_data['password']) ? md5($form_data['password']) : '';
		$user_data['role_id'] 			= isset($form_data['role_id']) ? $form_data['role_id'] : '';
		$id_number;
		$is_exists = $this->common_model->getOne($this->table, ['email' => $user_data['email']]);

		if (!empty($is_exists)) {

			$response['message'] = "Email Already Exists!";
			$response['success'] = false;
			echo json_encode($response); die();
		}
		$last_user_insert_id = $this->common_model->insert($this->table, $user_data);

		if(!empty($last_user_insert_id)){

			if ($user_data['role_id'] == 5) {

				$response['role'] = $user_data['role_id'];
				$patient_ref_prefix = $this->common_model->getOne(GLOBALSETTING, ['keyname' => 'PatientReferralPrefix'])->keyvalue;
				$current_year = date("y");
				$last_id = $this->common_model->raw_query("SELECT id FROM ".USERS_PATIENT." ORDER BY id DESC LIMIT 1");
				if (empty($last_id)) {
					$last_id = 1;
				} else {
					$last_id = $last_id[0]['id']+1;
				}
				$patient_referral_id = $patient_ref_prefix.$current_year.$last_id;

				$nationality_id = isset($form_data['nationality_id']) ? $form_data['nationality_id'] : '';

				$ethnicity_id = isset($form_data['ethnicity_id']) ? $form_data['ethnicity_id'] : '';

				$id_number = isset($form_data['id_number']) ? $form_data['id_number'] : '';

				$user_patient_data = ['user_id' => $last_user_insert_id, 'patient_referral_id' => $patient_referral_id, 'id_number'=> $id_number, 'nationality_id' => $nationality_id,'ethnicity_id' => $ethnicity_id ];

				$this->common_model->insert(USERS_PATIENT, $user_patient_data);

				$email_to 	= $form_data['email'];
				$to 		= $email_to;
				$subject 	= "Welcome to National Cancer Screening Registry";

				$encrypt_url = $this->encryption->encrypt($last_user_insert_id) ;
		
				$url = base_url('verify/auth?id='.$encrypt_url);
	
				$body = 'Welcome '.$user_data['fname'].' to National Cancer Screening Registry'
				. '<br><br>'
				. 'You registered an account on National Cancer Screening Registry with ID Number '.$id_number.' .Before being able to use your account you need to verify that this is your email address by clicking here: '
				. '<a href="'.$url.'">Please Verify Your Email</a><br>'
				. '<br><br>'
				. 'Kind Regards,'
				. '<br>'
				. 'NCSM Registry'
				. '<br>';
			} elseif ($user_data['role_id'] == 4) {
				$response['role'] = $user_data['role_id'];
				$email_to 	= $form_data['email'];
				$to 		= $email_to;
				$subject 	= "Welcome to National Cancer Screening Registry";

				$encrypt_url = $this->encryption->encrypt($last_user_insert_id) ;
	
				$url = base_url('verify/auth?id='.$encrypt_url);
	
				$body = 'Welcome '.$user_data['fname'].' to National Cancer Screening Registry'
				. '<br><br>'
				. 'You registered an account on National Cancer Screening Registry with registration number '.$user_data['registration_number'].'. Before being able to use your account you need to verify that this is your email address by clicking here: '
				. '<a href="'.$url.'">Please Verify Your Email</a><br>'
				. '<br><br>'
				. 'Kind Regards,'
				. '<br>'
				. 'NCSM Registry'
				. '<br>';
			}

			$email_response = $this->send_email($to, $subject, $body);

			if ($email_response['success'] == false) {
				$response['message'] = "Error Occured! Please Try Later.";
				$response['success'] = false;
			} else {
				$response['message'] = "Successfully registered. Please check email to verify your email";
				$response['success'] = true;
			}

		}
		else{
			$response['message'] = "Error Occured! Please Try Later.";
			$response['success'] = false;
		}

		echo json_encode($response); die();

	}

	public function verify( $auth="")
	{ 
		$encrypt = $this->input->get('id');
		$encrypt = str_replace(" ", "+", $encrypt ) ;
		$user_id = $this->encryption->decrypt($encrypt);
		if ( $user_id == "") { 
			redirect($_SERVER['HTTP_REFERER']);
		} 
		$user = $this->common_model->getById(USERS, $user_id); 
		if (!empty($user)) {
			if( $user->email_verified ){
				redirect($_SERVER['HTTP_REFERER']);
			}
			$data['email_verified'] = VERIFIED;
			$userdata = array();

			$t_psw = "" ; 
			if ($user->role_id == PATIENT_ROLE_ID) {
				$userdata['user_id'] = $user->id ;
				$this->common_model->update(USERS_PATIENT, $userdata,$data);
			} else {			    
			    $userdata['id'] = $user_id;
			    if( $user->updated_by != "" ) {
					$psw = $user->password;
					$t_psw = "Temporary Password : ".$psw."<br>" ;					
			    	$data['password'] = md5($psw);
			    }
				$this->common_model->update(USERS, $userdata ,$data);
			}

			$to 		= $user->email;
			$user_name  = $user->fname;
			$user_id  	= $user->id;
			// $user_pass  = $user->password;
			$portal_link= $this->common_model->getOne(GLOBALSETTING, ['keyname' => 'Portal_URL'])->keyvalue;

			$subject 	= "Welcome to National Cancer Screening Registry";

			$body = 'Welcome '.$user_name.' to National Cancer Screening Registry'
			. '<br><br>'
			. 'Below is your login user name, temporay password and portal link details to login to National Cancer Screening Registry portal and please change your password at your first login'
			. '<br><br>'
			. 'Username : ' . $to
			. '<br>' . $t_psw
			. 'Portal Link : ' . $portal_link
			. '<br><br>'
			. 'Kind Regards,'
			. '<br>'
			. 'NCSM Registry'
			. '<br>'; 

			$email_response = $this->send_email($to, $subject, $body);

			if ($email_response['success'] == false) {
				$this->session->set_flashdata('success','Error Occured! Please Try Later.');
			} else {
				$this->session->set_flashdata('success','Email Verified Successfully! Try Login');
			}
			redirect($_SERVER['HTTP_REFERER']);			
		}

		$this->session->set_flashdata('success','Not Found The User. Try Again');
		redirect($_SERVER['HTTP_REFERER']);

	}
}
