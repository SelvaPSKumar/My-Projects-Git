<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Lungs_cancer_results extends MY_Controller {
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

	public function lungs_result_details( $header_id) {
		$access_given = array(PATIENT);
		$this->role_and_access($access_given);
		$this->load->helper('common_helper');
		$sql1 = "SELECT * from ".ASSESSMENT_HEADER." WHERE id = ". $header_id. " AND assessment_type_id=3 AND patient_id = ".$this->session->userdata('id'). " AND is_completed = 1 AND is_obsolete = 0";
		$header_data = $this->common_model->raw_query($sql1);
		if(!isset($header_data) || empty($header_data) || count($header_data)<1){
			redirect(base_url(''));
		}
		$sql = "SELECT ad.assement_questionnaires_id, ad.assement_questionnaires_column_id, ad.assessment_questionnaires_value, ad.file_path, aq.* FROM ".ASSESSMENT_DETAIL." as ad INNER JOIN ".ASSESSMENT_QUESTIONNAIRES." AS aq 
					ON ad.assement_questionnaires_id = aq.id
					WHERE ad.assessment_header_id = ".$header_id." AND ad.is_obsolete = 0 ORDER BY aq.q_no,assement_questionnaires_id,assement_questionnaires_column_id";

		$header_detail = $this->common_model->raw_query($sql);
		$data['values'] = $this->get_smokelyzer_chart_data();
		$data['content'] = 'test_results/lungs_result_details/lungs';
		$data['is_footer'] = false;
		$data['header_detail'] = $header_detail;

		$adult_or_adolescent = null;
		$dob = $this->session->userdata('dob');
		if($dob == '0000-00-00') {
			//if dob not entered by default it will be adult
			$adult_or_adolescent = '1';
		} else {
			$age = date_diff(date_create($dob), date_create('today'))->y;
			if($age >= 21) {
				$adult_or_adolescent = '1';
			} else {
				$adult_or_adolescent = '0';
			}
		}
		$data['patient_adult_or_adolescent'] = $adult_or_adolescent;

		$data['patient_gender'] = $this->session->userdata('gender_id');
		$data['header_data'] = $header_data;
		// pre_d($data);
		$this->load->view('layout/main', $data);

	}

	public function get_smokelyzer_chart_data() {
		$values = [];
		$label = [];

		$patient_id = $this->session->userdata('id');
			
			$chart_question_row = $this->common_model->getOne(ASSESSMENT_QUESTIONNAIRES, ['assessment_types_id' => 3, 'assessment_tools_id' => 11, 'q_identifier' => 'LUN_SMO_5', 'is_obsolete' => 0]);
			$chart_question_id = $chart_question_row->id ? $chart_question_row->id : 0;
			$sub_prev_sql = "SELECT ad.*, DATE_FORMAT(ah.assessment_date,'%M-%y') AS assessment_date FROM assessment_detail  AS ad LEFT JOIN assessment_header AS ah ON ad.assessment_header_id = ah.id WHERE ad.assement_questionnaires_id = ".$chart_question_id." AND ah.assessment_type_id = 3 AND 
						ah.assessment_tool_id = 11 AND 
						ah.patient_id = ".$this->session->userdata('id')." AND
						is_completed = 1 AND ah.is_obsolete = 0
						ORDER BY id ASC";
			$sub_prev = $this->common_model->raw_query($sub_prev_sql);
			foreach ($sub_prev as $key => $value) {
				$values['labels'][] = $value['assessment_date'];
				$values['values'][] = $value['assessment_questionnaires_value'];
			}
		return $values;


	}
}