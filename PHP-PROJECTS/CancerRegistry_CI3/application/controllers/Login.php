<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('common_model');
	}
	public function index(){

		if($this->input->post()){

			$role	= $this->input->post('role');
			if ($role == FACILITY_ADMIN_ROLE_ID) {
				$system_admin_role_id = SYSTEM_ADMIN_ROLE_ID;
				$role = "(role_id = '$role' OR role_id = '$system_admin_role_id')";
			} else {
				$role = "role_id = '$role'";
			}

			$username	= $this->input->post('email');
			$password 	= md5($this->input->post('password'));
			$where		= "email = '$username' AND password = '$password' AND $role AND is_obsolete = 0";
			$data 	= $this->user_model->user_login(USERS, $where);

			if(sizeof($data) > 0){
				if ($data[0]['role_id'] == PATIENT_ROLE_ID) {
					$where = ['user_id' => $data[0]['id']];
					$user_patient = $this->common_model->getOne(USERS_PATIENT, $where);

					$this->common_model->update_table('m_users', array('last_logged_at'=>date('Y-m-d')), $data[0]['id']);

					if (!empty($user_patient) && !$user_patient->email_verified) {
						$this->session->set_flashdata('errors','Please verify your email first.');
						redirect($_SERVER['HTTP_REFERER']);
					}
				} else {
					if (!$data[0]['email_verified']) {
						$this->session->set_flashdata('errors','Please verify your email first.');
						redirect($_SERVER['HTTP_REFERER']);
					}
				}

				if (!$data[0]['is_approve'] && $data[0]['role_id'] == MEDICPRAC_ROLE_ID) {
					$this->session->set_flashdata('errors','Your account not approved yet.');
					redirect($_SERVER['HTTP_REFERER']);
				}

				foreach($data[0] as $key => $value){
					$userData[$key]=$value;
				}
				$role_id = $data[0]['role_id'];
				$id = $data[0]['id'];
				unset($data[0]);
				$role_data = $this->get_role_info($role_id);
				if ($role_data->rolecode == PATIENT) { 
					$userData['rolecode'] = $role_data->rolecode;
					$this->session->set_userdata($userData);

					//check perkeso data entered
					$patient_values  = $this->common_model->getOne(' m_users_patient', ['user_id' => $id]);
					if(isset($patient_values->perkeso_member) || $patient_values->perkeso_member != null) {
					redirect(base_url('patient/dashboard'));
					} else {
						redirect(base_url('profile'));
					}
				} else if($role_data->rolecode == MEDICPRAC){
					$userData['rolecode'] = $role_data->rolecode;
					$this->session->set_userdata($userData);
					redirect(base_url('manage_patients'));
				} else if($role_data->rolecode == FACILITY_ADMIN || $role_data->rolecode == SYSTEM_ADMIN){
					$userData['rolecode'] = $role_data->rolecode;
					$this->session->set_userdata($userData);
					redirect(base_url('admin_dashboard'));
				}
			}else{
				$this->session->set_flashdata('errors','Wrong Email OR Password Try Again!');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
	}
	public function logout(){
		if(isset($_SESSION['__ci_last_regenerate']))
			unset($_SESSION['__ci_last_regenerate']);
		if(isset($_SESSION['FBRLH_state']))
	    	unset($_SESSION['FBRLH_state']);
			unset($_SESSION['id']);
	  		redirect(base_url(''));
	}
	public function forgot_password(){

		$form_data = $this->input->post();

		$is_exists = $this->common_model->getOne(USERS, ['email' => $form_data['email']]);
		
		$response['success'] = false;

		if (!empty($is_exists)) {
			
			$this->common_model->update(USERS, ['id' => $is_exists->id], ['password' => md5('Helloworld00@')]);
			$email_to 	= $form_data['email'];
			$to 		= $email_to;
			$subject 	= "Reset Password for NCSM Registry";

			$body = 'Hi ' . $is_exists->fname
			. '<br><br>'
			. 'Here is your temporary password for NCSM Registry. It is advisable to change your temporary password once login: '
			. '<br><br>'
			. 'Helloworld00@'
			. '<br><br>'
			. 'Kind Regards,'
			. '<br>'
			. 'NCSM Registry'
			. '<br>';
			$email_response = $this->send_email($to, $subject, $body);
			$response['success'] = true;
			$response['message'] = "Password reset. Please check your email for your temporary password!";
		} else {
			$response['message'] = "No Record Found!";

		}

		echo json_encode($response); die();


	}
	public function change_password(){

		$data['content'] = 'patient/change_password';
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);

		
	}
	public function update_password(){
		$id=$this->current_user_id;
		$password=md5($this->input->post('password'));
		$new_password=md5($this->input->post('new_password'));
		$re_password=md5($this->input->post('re_password'));
		$where="id = '$id' AND password = '$password' ";
		if($this->user_model->user_login(USERS, $where))
		{

			if ($new_password==$re_password) {
				if($this->user_model->update_password(USERS ,array('id' =>$id),array('password'=>$new_password))){
					$this->session->set_flashdata('success','Password has been changed successfully!');
					redirect($_SERVER['HTTP_REFERER']);
				}
			}
			$this->session->set_flashdata('errors','New passwords Don\'t match');
			redirect($_SERVER['HTTP_REFERER']);
		}
		$this->session->set_flashdata('errors','Old password is not correct');
		redirect($_SERVER['HTTP_REFERER']);
	}
}