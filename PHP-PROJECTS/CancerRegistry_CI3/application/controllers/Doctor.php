<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor extends MY_Controller {
	function __construct(){
		parent::__construct();
		if(!$this->isLoggedIn()){
			redirect(base_url(''));
		}
	}
	public $access_given = array(MEDICPRAC);

	public function role_and_access() {
		//$CI = & get_instance();
		if(!in_array($this->session->userdata('rolecode'), $this->access_given) ) {
			redirect(base_url(''));
		}
	}
	public function dashboard()
	{
		$this->role_and_access();

		$data['content'] = 'doctor/doctor_dashboard';
		$data['active'] = 'doctor_dashboard';
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);
	}

	public function manage_patients()
	{
		$this->role_and_access();
		redirect('all_assessments/breast_cancer');
		$data['content'] = 'doctor/manage_patients';
		$data['active'] = 'manage_patients';

		$facility_details = $this->common_model->getById(FACILITY, $this->session->userdata('facility_id'));

		/*if (!empty($facility_details->is_superadmin)) {
			$sql = "SELECT u.*, up.id_number, up.assessment_counter, g.gender FROM ".USERS." AS u INNER JOIN ".USERS_PATIENT." AS up ON u.id = up.user_id LEFT JOIN ".GENDER." as g ON u.gender_id = g.id WHERE u.role_id= 5 and u.is_obsolete =0 AND u.id IN (SELECT DISTINCT(patient_id) FROM assessment_header WHERE is_completed = 1) AND u.role_id = 5";
		} else {
			$sql = "SELECT u.*, up.id_number, up.assessment_counter, g.gender FROM ".USERS." AS u INNER JOIN ".USERS_PATIENT." AS up ON u.id = up.user_id LEFT JOIN ".GENDER." as g ON u.gender_id = g.id WHERE u.role_id= 5 and u.is_obsolete =0 AND u.id IN (SELECT DISTINCT(patient_id) FROM assessment_header WHERE is_completed = 1 AND facility_id = ".$this->session->userdata('facility_id').") AND u.role_id = 5";
		}*/
		$sql = "SELECT u.*, up.id_number, up.assessment_counter, g.gender FROM ".USERS." AS u INNER JOIN ".USERS_PATIENT." AS up ON u.id = up.user_id LEFT JOIN ".GENDER." as g ON u.gender_id = g.id WHERE u.role_id= 5 and u.is_obsolete =0 AND u.id IN (SELECT DISTINCT(patient_id) FROM assessment_header WHERE is_completed = 1 AND facility_id = ".$this->session->userdata('facility_id').") AND u.role_id = 5";

		$data['all_patients'] = $this->common_model->raw_query($sql);
		
		$patient_ids = '';

		foreach ($data['all_patients'] as $key => $patient) {
			$patient_ids .= $patient['id'].",";
		}
		$patient_ids = rtrim($patient_ids, ',');

		$assessments_results = [];
		if (!empty($patient_ids)) {
			$sql1 = "select count(*) c, patient_id from assessment_header where patient_id IN (".$patient_ids.") AND is_completed = 1 ";
				$sql1 .= "AND facility_id = ".$this->session->userdata('facility_id')." Group by patient_id";
			$assessments_results = $this->common_model->raw_query($sql1);
		}

		
		if (!empty($assessments_results)) {
			foreach ($assessments_results as $key => $assessment) {
				foreach ($data['all_patients'] as $key1 => $patients) {
					if ($assessment['patient_id'] == $patients['id']) {
						$data['all_patients'][$key]['assessment_counter'] = $assessment['c'];
					}
				}
			}
		}
		$data['assessments_results'] = $assessments_results;

		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);
	}

	public function add_comment() {
		$this->role_and_access();
		
		$form_data = $this->input->post();
		
		$assessment_header_id 	= $form_data['assessment_header_id'];
		$comment_author 		= $form_data['comment_author'];
		$comment 				= $form_data['comment'];
		$created_by 			= $this->session->userdata('id');

		$comment_data = [
			'assessment_header_id' 	=> $assessment_header_id,
			'comment_author'		=> $comment_author,
			'comments' 				=> $comment,
			'created_by' 			=> $created_by,
		];

		$saved = $this->common_model->insert(ASSESSMENT_DOCTOR_COMMENT, $comment_data);

		if ($saved) {
			$this->session->set_flashdata('success','You have added new comment!');
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$this->session->set_flashdata('errors','Error Occured, Please try Again!');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
}
