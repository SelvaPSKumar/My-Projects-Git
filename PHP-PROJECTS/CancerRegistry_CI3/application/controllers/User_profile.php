<?php
defined('BASEPATH') or exit('No direct script access allowed');
class User_profile extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		// $this->load->model("ajax_pagination_model");
		if (!$this->isLoggedIn())
			redirect(base_url('login'));
	}

	public function profile()
	{
		$id 	= $this->current_user_id;

		$data['sub_title'] = 'Profile';
		$data['active'] = 'profile';
		$data['value'] = $this->common_model->getById(USERS, $id);
		$role_id = $data['value']->role_id;
		$data['is_footer'] = false;
		$role_as = $this->common_model->getById('m_roles', $role_id);
		$data['values']  = $this->common_model->getOne(' m_users_patient', ['user_id' => $id]);
		// $data['values']  = $this->common_model->getById(' m_users_patient', $id);
		$data['ethnicities'] = $this->common_model->getAll('m_ethnicity');

		// print_r($data['zipcode']);
		// die();
		if (isset($role_as->rolename) &&  $role_as->rolename == 'Patient') {
			$data['content'] = 'patient/profile';
		} else if (isset($role_as->rolename) &&  $role_as->rolename == 'Medical Practitioner') {
			$data['content'] = 'doctor/profile';
		} else if (isset($role_as->rolename) &&  $role_as->rolename == 'System Admin') {
			$data['content'] = 'admin/profile';
		} else if(isset($role_as->rolename) &&  $role_as->rolename == 'Facility Admin') {
			redirect('admin_dashboard');
		}

		$this->load->view('layout/main', $data);
	}
	public function edit_profile()
	{
		$id 	= $this->current_user_id;

		$data['sub_title'] = 'Profile';
		$data['value'] = $this->common_model->getById(USERS, $id);

		$role_id = $data['value']->role_id;
		$data['is_footer'] = false;
		$role_as = $this->common_model->getById('m_roles', $role_id);
		$data['state'] = $this->common_model->getById('m_state', $id);
		$data['genders'] = $this->common_model->getdata();
		$data['values']  = $this->common_model->getOne(' m_users_patient', ['user_id' => $id]);
		// $data['values']  = $this->common_model->getById(' m_users_patient', $id);
		$data['all_bloods'] = $this->common_model->getAll('m_bloodgroup');
		$data['education'] = $this->common_model->getAll('m_educationlevel');
		$data['socioeconomics'] = $this->common_model->getAll('m_socioeconomic', ['is_obsolete' => 0]);

		$data['maritalstatus'] = $this->common_model->getAll('m_maritalstatus');
		$data['countries'] = $this->common_model->getAll('m_country');
		$data['states'] = $this->common_model->getAll('m_state');

		$data['emergency_name']  = $this->common_model->getById(' m_users_patient', $id);

		$data['is_footer'] = false;
		$data['ethnicities'] = $this->common_model->getAll('m_ethnicity');
		if (isset($role_as->rolename) &&  $role_as->rolename == 'Patient') {

			$data['content'] = 'patient/edit_profile';
		} else if (isset($role_as->rolename) &&  $role_as->rolename == 'Medical Practitioner') {


			$data['content'] = 'doctor/edit_profile';
		} else if (isset($role_as->rolename) &&  $role_as->rolename == 'System Admin') {
			$data['content'] = 'admin/edit_profile';
		}

		$this->load->view('layout/main', $data);
	}
	public function update_password()
	{
		// getting data from form
		$formData = $this->input->post();
		$old_password = md5($formData['old_password']);
		$id = $this->session->userdata('id');

		$check_password = $this->common_model->getOne('users', array('password' => $old_password));
		if (empty($check_password->id)) {
			$this->session->set_flashdata('errors', "Wrong! Old Password!");
			redirect($_SERVER['HTTP_REFERER']);
		}
		if ($formData['new_password'] != $formData['confirm_password']) {
			$this->session->set_flashdata('errors', "Both Passwords don't match!");
			redirect($_SERVER['HTTP_REFERER']);
		}
		if ($id) {
			$data['password'] = md5($formData['new_password']);
			$update = $this->common_model->update('users', array('id' => $id), $data);
			if (!empty($update)) {
				$this->session->set_flashdata('success', 'Updated! Successfully!');
			} else {
				$this->session->set_flashdata('errors', 'Error! error Occured!');
			}
		}
		redirect($_SERVER['HTTP_REFERER']);
	}


	public function update_profile($id)
	{
		if($id == $this->session->userdata('id')) {
		$form_data = $this->input->post();
		$fname 						= $this->input->post('fname');
		$nationality_id 			    = $this->input->post('nationality_id');
		$ethnicity_id 			= $this->input->post('ethnicity_id');
		$gender_id 					= $this->input->post('gender_id');
		$id_number 					= $this->input->post('id_number');
		$dob 						= $this->input->post('dob');
		$registration_number 		= $this->input->post('registration_number');
		$contact_number 			= $this->input->post('contact_number');
		$postcode 					= $this->input->post('postcode');
		$address1 					= $this->input->post('address1');
		$address2 					= $this->input->post('address2');
		$city 						= $this->input->post('city');
		$state_id 					= $this->input->post('state_id');
		$country_name 				= $this->input->post('country_name');
		$blood_name 				= $this->input->post('blood_name');
		$socioeconomic_id 			= $this->input->post('socioeconomic_id');
		$education_level 			= $this->input->post('education_level');
		$family_history_of_cancer 	= $this->input->post('family_history_of_cancer');
		$perkeso_member 			= $this->input->post('perkeso_member');
		$marital_status 			= $this->input->post('marital_status');

		$user_data = [
			'fname' => $fname,
			'dob' => $dob,
			'registration_number' => $registration_number,
			'contact_number' => $contact_number,
			'gender_id' => $gender_id,

		];
		$update = $this->common_model->update('m_users', array('id' => $id), $user_data);

		$patient_user_data['nationality_id '] 		= $nationality_id;
		$patient_user_data['ethnicity_id '] 		= $ethnicity_id;
		$patient_user_data['id_number '] 			= $id_number;
		$patient_user_data['bloodgroup_id '] 		= $blood_name;
		$patient_user_data['maritalstatus_id'] 		= $marital_status;
		$patient_user_data['education_level_id '] 	= $education_level;
		$patient_user_data['address1'] 				= $address1;
		$patient_user_data['address2'] 				= $address2;
		$patient_user_data['city'] 					= $city;
		$patient_user_data['state_id'] 				= $state_id;
		$patient_user_data['country_id'] 			= $country_name;
		$patient_user_data['postcode'] 				= $postcode;
		$patient_user_data['socioeconomic_id'] 		= $socioeconomic_id;
		$patient_user_data['family_history_of_cancer'] 	= $family_history_of_cancer;
		$patient_user_data['perkeso_member'] 		= $perkeso_member;

		$this->common_model->update('m_users_patient', array('user_id' => $id), $patient_user_data);
	}
		if($perkeso_member == 1) {
			$where = ['assessment_type_id' => 7, 'assessment_tool_id' => 29, 'patient_id' => $this->session->userdata('id'), 'is_completed' => 1, 'is_obsolete' => 0];
			$assessments_results = $this->common_model->getOne(ASSESSMENT_HEADER, $where, '', ['id', 'desc']);
			if(isset($assessments_results) && !empty($assessments_results)) {
				redirect(base_url('profile'));
			} else {
			redirect(base_url('general_health/screening'));
			}
		} else {
			redirect(base_url('profile'));
		}
	}

	public function fetch_state()
	{
		$country_id = $this->input->get('country_id');
		$states = $this->common_model->getAll('m_state', array('country_id' => $country_id));

		echo json_encode($states);		
	}
}
