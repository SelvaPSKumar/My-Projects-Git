<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Prostate_cancer_results extends MY_Controller {
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

	public function prostate_result_details( $header_id) {
		$access_given = array(PATIENT);
		$this->role_and_access($access_given);
		$this->load->helper('common_helper');
		$sql1 = "SELECT * from ".ASSESSMENT_HEADER." WHERE id = ". $header_id. " AND assessment_type_id = 4 AND patient_id = ".$this->session->userdata('id'). " AND is_completed = 1 AND is_obsolete = 0";
		$header_data = $this->common_model->raw_query($sql1);
		if(!isset($header_data) || empty($header_data) || count($header_data)<1){
			redirect(base_url(''));
		}
		$sql = "SELECT ad.assement_questionnaires_id, ad.assement_questionnaires_column_id, ad.assessment_questionnaires_value, ad.file_path, aq.* FROM ".ASSESSMENT_DETAIL." as ad INNER JOIN ".ASSESSMENT_QUESTIONNAIRES." AS aq 
					ON ad.assement_questionnaires_id = aq.id
					WHERE ad.assessment_header_id = ".$header_id." AND ad.is_obsolete = 0 ORDER BY aq.q_no,assement_questionnaires_id,assement_questionnaires_column_id";

		$header_detail = $this->common_model->raw_query($sql);
		$data['content'] = 'test_results/prostate_result_details/prostate';
		$data['values'] = $this->get_symptom_assessment_chart_data();
		$data['is_footer'] = false;
		$data['header_detail'] = $header_detail;
		$data['patient_gender'] = $this->session->userdata('gender_id');
		$data['header_data'] = $header_data;
		// pre_d($data);
		$this->load->view('layout/main', $data);

	}

	public function get_symptom_assessment_chart_data() {
		$values['labels'] = [];
		$values['values'] = [];
		$assessment_data 		= $this->session->userdata();
		$patient_id = $assessment_data['id'];
			//recommendation 1 start
			$chart_question_row = $this->common_model->getAll(ASSESSMENT_QUESTIONNAIRES, ['assessment_types_id' => 4, 'assessment_tools_id' => 22, 'group' => 1,  'is_obsolete' => 0]);
			$ids = array();
			if(isset($chart_question_row)) {
				foreach($chart_question_row as $row => $questions) {
					$ids = array_merge($ids, array($questions->id));
				}
			}
			$chart_question_id = $chart_question_row->id ? $chart_question_row->id : 0;
			//need to alter query to get group 1
			$sub_prev_sql = "SELECT ad.*, DATE_FORMAT(ah.assessment_date,'%M-%y') AS assessment_date FROM assessment_detail  AS ad LEFT JOIN assessment_header AS ah ON ad.assessment_header_id = ah.id WHERE ad.assement_questionnaires_id IN (".implode( ",", $ids ) .") AND ah.assessment_type_id = 4 AND 
						ah.assessment_tool_id = 22 AND 
						ah.patient_id = ".$patient_id." AND
						is_completed = 1 AND ah.is_obsolete = 0
						ORDER BY id ASC";
			$sub_prev = $this->common_model->raw_query($sub_prev_sql);

			//group and calculate
			$group_total = array();
			foreach ($sub_prev as $key => $value) {
				$total = 0;
				$is_json = is_string($value['assessment_questionnaires_value']) && is_array(json_decode($value['assessment_questionnaires_value'], true)) ? true : false;
				if($is_json) {
					$decoded_value = json_decode($value['assessment_questionnaires_value'], true);
					$point = key($decoded_value);
					if(isset($group_total[$value['assessment_header_id']]['values'])) {
						$group_total[$value['assessment_header_id']]['values'] = $group_total[$value['assessment_header_id']]['values'] + $point;
					} else {
						$group_total[$value['assessment_header_id']]['values'] = $point;
						$group_total[$value['assessment_header_id']]['labels'] = $value['assessment_date'];
					}
				}
			}
			
			//get final value
			if(isset($group_total) && count($group_total)>0) {
				foreach($group_total as $header_id => $result ) {
					$values['labels'][] = $result['labels'];
					$values['values'][] = $result['values'];
				}
			}

			//recommendation 1 ends

			//recommendation 2 starts
			$chart_question_row = $this->common_model->getAll(ASSESSMENT_QUESTIONNAIRES, ['assessment_types_id' => 4, 'assessment_tools_id' => 22, 'group' => 2,  'is_obsolete' => 0]);
			$ids = array();
			if(isset($chart_question_row)) {
				foreach($chart_question_row as $row => $questions) {
					$ids = array_merge($ids, array($questions->id));
				}
			}
			$chart_question_id = $chart_question_row->id ? $chart_question_row->id : 0;
			//need to alter query to get group 1
			$sub_prev_sql = "SELECT ad.*, DATE_FORMAT(ah.assessment_date,'%M-%y') AS assessment_date FROM assessment_detail  AS ad LEFT JOIN assessment_header AS ah ON ad.assessment_header_id = ah.id WHERE ad.assement_questionnaires_id IN (".implode( ",", $ids ) .") AND ah.assessment_type_id = 4 AND 
						ah.assessment_tool_id = 22 AND 
						ah.patient_id = ".$patient_id." AND
						is_completed = 1 AND ah.is_obsolete = 0
						ORDER BY id ASC";
			$sub_prev = $this->common_model->raw_query($sub_prev_sql);

			//group and check yes no
			$group_yes_no = array();
			foreach ($sub_prev as $key => $value) {
				$total = 0;
				$is_json = is_string($value['assessment_questionnaires_value']) && is_array(json_decode($value['assessment_questionnaires_value'], true)) ? true : false;
				if($is_json) {
					$decoded_value = json_decode($value['assessment_questionnaires_value'], true);
					$yes_no = key($decoded_value);
					if(isset($group_yes_no[$value['assessment_header_id']]['yes_no'])) {
						if($yes_no == 'yes') {
							$group_yes_no[$value['assessment_header_id']]['yes_no'] = true;
						}
					} else {
						$group_yes_no[$value['assessment_header_id']]['yes_no'] = false;
					}
				}
			}
			
			//get final value
			if(isset($group_yes_no) && count($group_yes_no)>0) {
				foreach($group_yes_no as $header_id => $result ) {
					$values['yes_no'][] = $result['yes_no'];
				}
			}
			//recommenddation 2 ends
		return $values;


	}

}