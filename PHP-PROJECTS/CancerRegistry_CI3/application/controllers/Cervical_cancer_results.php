<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cervical_cancer_results extends MY_Controller {
	function __construct(){
		parent::__construct();
		if(!$this->isLoggedIn()){
			redirect(base_url(''));
		}
	}

	public function index(){
	
	}

	public function role_and_access($access_given) {
		if(!in_array($this->session->userdata('rolecode'), $access_given) ) {
			redirect(base_url(''));
		}
	}

	public function cervical_result_details( $header_id) {
		$access_given = array(PATIENT);
		$this->role_and_access($access_given);
		$this->load->helper('common_helper');
		$sql1 = "SELECT * from ".ASSESSMENT_HEADER." WHERE id = ". $header_id. " AND assessment_type_id = 5 AND patient_id = ".$this->session->userdata('id'). " AND is_completed = 1 AND is_obsolete = 0";
		$header_data = $this->common_model->raw_query($sql1);
		if(!isset($header_data) || empty($header_data) || count($header_data)<1){
			redirect(base_url(''));
		}
		$sql = "SELECT ad.assement_questionnaires_id, ad.assement_questionnaires_column_id, ad.assessment_questionnaires_value, ad.file_path, aq.* FROM ".ASSESSMENT_DETAIL." as ad INNER JOIN ".ASSESSMENT_QUESTIONNAIRES." AS aq 
					ON ad.assement_questionnaires_id = aq.id
					WHERE ad.assessment_header_id = ".$header_id." AND ad.is_obsolete = 0 ORDER BY aq.q_no,assement_questionnaires_id,assement_questionnaires_column_id";

		$header_detail = $this->common_model->raw_query($sql);
		$data['content'] = 'test_results/cervical_result_details/cervical';
		$data['is_footer'] = false;
		$data['header_detail'] = $header_detail;
		$data['patient_gender'] = $this->session->userdata('gender_id');
		$data['header_data'] = $header_data;
		// pre_d($data);
		$this->load->view('layout/main', $data);

	}

}