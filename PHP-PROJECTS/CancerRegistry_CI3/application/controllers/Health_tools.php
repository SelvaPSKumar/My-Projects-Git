<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class health_tools extends MY_Controller {
	function __construct(){
		parent::__construct();
		if(!$this->isLoggedIn()){
			redirect(base_url(''));
		}
	}
	
	public function index(){
		
	}
	
	public function health_tools_screening(){
		unset($this->session->userdata['assessment_data']);
		$data['assessments_info'] = $this->get_assessments_info();
		$patient_data = $this->input->post();
		if ($this->session->userdata('rolecode') != PATIENT && (empty($patient_data) || empty($patient_data['patient_id']))) {
			$patient_rolecode = $this->common_model->getOne(ROLES, ['rolecode' => PATIENT]);
			$sql1 = "SELECT u.*, up.id_number FROM ".USERS." AS u LEFT JOIN ".USERS_PATIENT." AS up ON u.id = up.user_id WHERE u.id IN (SELECT DISTINCT(patient_id) FROM assessment_header WHERE is_completed = 1 AND role_id= 5 AND is_obsolete = 0 ";
			
			$facility_details = $this->common_model->getById(FACILITY, $this->session->userdata('facility_id'));

			if ($this->session->userdata('rolecode') == MEDICPRAC && empty($facility_details->is_superadmin)) {
				$sql1 .= " AND facility_id = ".$this->session->userdata('facility_id').") ";
			}else{
				$sql1 .= " )";
			}
			$data['patients'] = $this->common_model->raw_query($sql1);
			// $data['patients'] = $this->common_model->getAll(USERS, ['is_obsolete' => 0, 'facility_id' => $this->session->userdata('facility_id'), 'role_id' => $patient_rolecode->id]);
			$data['assessment_types'] = $this->common_model->getAll(ASSESSMENT_TYPES, ['is_obsolete' => 0]);
			$data['content'] = 'doctor/healthtools_selection';
		}else{
			if($this->session->userdata('rolecode') != MEDICPRAC){
				$data['facilities'] = $this->common_model->getAll('m_facility', ['is_obsolete' => 0]);
			}
			$data['content'] = 'survey/healthtools/index';
			if(!empty($patient_data)){
				$sql1 = "SELECT u.*, up.id_number FROM ".USERS." AS u LEFT JOIN ".USERS_PATIENT." AS up ON u.id = up.user_id WHERE u.id = ".$patient_data['patient_id']."";
				$data['patient_data'] = $this->common_model->raw_query($sql1);
			}
		}		
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);
	}
	public function healthtools_assessments($patient_id = 0){

		$where = ['is_completed' => 1];
		
		$facility_details = $this->common_model->getById(FACILITY, $this->session->userdata('facility_id'));

		$sql = "SELECT u.*, up.id_number FROM ".USERS." AS u INNER JOIN ".USERS_PATIENT." AS up ON u.id = up.user_id WHERE u.role_id= 5 and u.is_obsolete =0 AND u.id IN (SELECT DISTINCT(patient_id) FROM assessment_header WHERE is_completed = 1 ";

		if ($this->session->userdata('rolecode') == MEDICPRAC && empty($facility_details->is_superadmin)) {
			$sql .= " AND facility_id = ".$this->session->userdata('facility_id').") ";
		}else{
			$sql .= " ) ";
		}
		
		if($patient_id != 0){
			$sql .= " AND u.id = ".$patient_id." ";
		}

		
		$data['all_patients'] = $this->common_model->raw_query($sql);
		$patient_ids = '';

		foreach ($data['all_patients'] as $key => $patient) {
			$patient_ids .= $patient['id'].",";
		}
		$patient_ids = rtrim($patient_ids, ',');


		$assessments_results = [];
		if (!empty($patient_ids)) {
			$sql1 = "select * from assessment_header where patient_id IN (".$patient_ids.") AND assessment_type_id=6 and is_completed = 1 ";
			if( empty($facility_details->is_superadmin) ){
				$sql1 .= "AND facility_id = ".$this->session->userdata('facility_id')." ";
			}
			$assessments_results = $this->common_model->raw_query($sql1);
		}
		
		if (!empty($assessments_results)) {
			foreach ($assessments_results as $key => $assessment) {
				foreach ($data['all_patients'] as $key1 => $patients) {
					if ($assessment['patient_id'] == $patients['id']) {
						$assessments_results[$key]['patient_data'] = $patients;
					}
				}
			}
		}

		$data['assessments_results'] = $assessments_results;


		$data['active'] = 'health_tools_assessments';
		$data['content'] = 'doctor/healthtools_assessments';
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);
			
	}

	public function save_health_tool_assessment_header(){
		$form_data = $this->input->post();
		if ($this->session->userdata('rolecode') == MEDICPRAC) {
			$assessment_data['patient_id'] 				= isset($form_data['patient_id']) ? $form_data['patient_id'] : '';
		} else {
			$assessment_data['patient_id'] 				= $this->session->userdata('id');
		}
			
			$last_assessment_number_sql = $this->common_model->raw_query("SELECT assessment_number FROM ".ASSESSMENT_HEADER." Where patient_id = ". $assessment_data['patient_id'] ." and is_completed = 1 ORDER BY id DESC LIMIT 1 ");
			if (!empty($last_assessment_number_sql[0]['assessment_number'])) {
				
				$last_assessment_number = $last_assessment_number_sql[0]['assessment_number'];
				
			} else {

				$last_assessment_number = 0;
			}
			$assessment_data['assessment_type_id'] 		= isset($form_data['assessment_type_id']) ? $form_data['assessment_type_id'] :'';
			$assessment_data['assessment_sub_type_id'] 	= isset($form_data['assessment_sub_type_id']) ? $form_data['assessment_sub_type_id'] :'';
			$assessment_data['assessment_tool_id'] 		= isset($form_data['assessment_tool_id']) ? $form_data['assessment_tool_id'] :'';
			$assessment_data['facility_id'] 			= isset($form_data['facility_id']) ? $form_data['facility_id'] :'';
			$assessment_data['assessment_date'] 		= isset($form_data['assessment_date']) ? $form_data['assessment_date'] :'';
			$assessment_data['assessment_time'] 		= isset($form_data['assessment_time']) ? $form_data['assessment_time'] :'';

			$assessment_type_code = $this->get_assessment_type_info($form_data['assessment_type_id'])->assessment_type_code;
			$assessment_tool_code = $this->get_assessment_tool_info($form_data['assessment_tool_id'])->assessment_tool_code;

			$assessment_data['assessment_prefix'] 		= $assessment_type_code."".$assessment_tool_code;
			$assessment_data['assessment_number'] 		= $last_assessment_number+1;
			$assessment_data['created_by'] 				= $this->session->userdata('id');

			$last_insert_id = $this->common_model->insert(ASSESSMENT_HEADER, $assessment_data);
			$assessment_data['assessment_header_id'] 		= isset($last_insert_id) ? $last_insert_id :'';

			if ($last_insert_id) {
				$current_assessment_header_id = $last_insert_id;
		
				$this->session->set_userdata(['current_assessment_header_id' => $current_assessment_header_id]);
				
			}
			if (!empty($assessment_data)) {
				$this->session->set_userdata('assessment_data',$assessment_data);
			} else {
				die("error in first screen!");
			}
			if( $assessment_data['assessment_tool_id'] == "26" && $form_data['literacy_info_proceed'] == "false") {
				$this->literacy_survey_intro();
			} else {
			$this->your_health_tools();
			}
	}
	public function your_health_tools(){
		
		$assessment_data 		= $this->session->userdata('assessment_data');

		$assessment_types_id 	= $assessment_data['assessment_type_id'];
		$assessment_tools_id 	= $assessment_data['assessment_tool_id'];
		$assessment_header_id 	= $assessment_data['assessment_header_id'];
		
		$data['assessment_type_id'] 	= $assessment_types_id;
		$data['assessment_sub_type_id'] = $assessment_data['assessment_sub_type_id'];
		$data['assessment_header_id'] 	= $assessment_header_id;
		$data['assessment_tool_id']  =  $assessment_tools_id;

		$where = ['id' => $assessment_data['patient_id']];
		$user_patient = $this->common_model->getOne(USERS, $where);
		$data['patient_gender'] = $user_patient->gender_id; 
		
		$where 					= ['assessment_types_id' => $assessment_types_id, 'assessment_tools_id' => $assessment_tools_id, 'is_obsolete' => 0];

		$data['questions'] 		= $this->common_model->getAll(ASSESSMENT_QUESTIONNAIRES, $where, '', ['q_no', 'q_no']);
		$where1 				= ['is_obsolete' => 0];
		$data['associated_features'] 		= $this->common_model->getAll(ASSOCIATED_FEATURES, $where1, '', ['id', 'id'], 'id,associated_feature');
		$data['health_beauty_website'] = '';
		if( $data['assessment_tool_id'] == 27 ) {
			$data['health_beauty_website'] = $this->get_healthbeauty_website_link();
		}
		$data['content'] = 'survey/healthtools/family_history/family_history_question';
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);
		
	}
	public function literacy_survey_intro() {
		$assessment_data 		= $this->session->userdata('assessment_data');
		$data['patient_id'] = $assessment_data['patient_id'];
		$data['assessment_type_id'] = $assessment_data['assessment_type_id'];
		$data['assessment_sub_type_id'] = $assessment_data['assessment_sub_type_id'];
		$data['facility_id'] = $assessment_data['facility_id'];
		$data['assessment_date'] = $assessment_data['assessment_date'];
		$data['assessment_time'] = $assessment_data['assessment_time'];
		$data['content'] = 'survey/healthtools/family_history/literacy_survey_intro';
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);
	}
	public function moveto_risk_assesment() {
		$assessment_data 		= $this->session->userdata('assessment_data');
		$assessment_data['assessment_tool_id']=27;
		$assessment_type_code = $this->get_assessment_type_info($assessment_data['assessment_type_id'])->assessment_type_code;
		$assessment_tool_code = $this->get_assessment_tool_info($assessment_data['assessment_tool_id'])->assessment_tool_code;

		$assessment_data['assessment_prefix'] 		= $assessment_type_code."".$assessment_tool_code;

		$last_assessment_number_sql = $this->common_model->raw_query("SELECT assessment_number FROM ".ASSESSMENT_HEADER." Where patient_id = ". $assessment_data['patient_id'] ." and is_completed = 1 ORDER BY id DESC LIMIT 1 ");
			if (!empty($last_assessment_number_sql[0]['assessment_number'])) {
				
				$last_assessment_number = $last_assessment_number_sql[0]['assessment_number'];
				
			} else {

				$last_assessment_number = 0;
			}
		$assessment_data['assessment_number'] 		= $last_assessment_number+1;
		$assessment_data['created_by'] 				= $this->session->userdata('id');
		unset($assessment_data['assessment_header_id']);

		$last_insert_id = $this->common_model->insert(ASSESSMENT_HEADER, $assessment_data);
		$assessment_data['assessment_header_id'] 		= isset($last_insert_id) ? $last_insert_id :'';

		if ($last_insert_id) {
			$current_assessment_header_id = $last_insert_id;

			$this->session->set_userdata(['current_assessment_header_id' => $current_assessment_header_id]);
			
		}
		if (!empty($assessment_data)) {
			$this->session->set_userdata('assessment_data',$assessment_data);
		} else {
			die("error in first screen!");
		}
		$this->your_health_tools();
	}
	public function save_healthtools_questions() {
		$form_data = $this->input->post();
		$is_exists = $this->common_model->getOne(ASSESSMENT_DETAIL, ['assessment_header_id' => $form_data['assessment_header_id']]);
		$assessment_header = $this->common_model->getById(ASSESSMENT_HEADER, $form_data['assessment_header_id']); 
		$assessment_date = $assessment_header->assessment_date;
		$date = new DateTime($assessment_date);
        $date->modify('+12 month');
        $next_assessment_date = $date->format('Y-m-d');

		$last_insert_id = 0;
		if (!$is_exists) {
			$replies_data = [];
			$assessment_header_id = $form_data['assessment_header_id'];

			unset($form_data['assessment_header_id']);
			if(isset($form_data['question'])) {
				foreach ($form_data['question'] as $key => $reply) {
					if(is_array($reply)){
						foreach($reply as $sub_key => $sub_reply){
						$replies_data[] = ['assessment_header_id' => $assessment_header_id, 'assement_questionnaires_id' => $key, 'assement_questionnaires_column_id' => $sub_key, 'assessment_questionnaires_value' => $sub_reply, 'file_path' => 0, 'created_by' => $this->session->userdata('id')];
						}
					} else {
					$replies_data[] = ['assessment_header_id' => $assessment_header_id, 'assement_questionnaires_id' => $key, 'assement_questionnaires_column_id' => 0, 'assessment_questionnaires_value' => $reply[$key], 'file_path' => 0, 'created_by' => $this->session->userdata('id')];
					}
				}
				$last_insert_id = $this->common_model->insert_batch(ASSESSMENT_DETAIL, $replies_data);
			}
			if ($last_insert_id > 0) {

				$this->common_model->update(ASSESSMENT_HEADER, ['id' => $assessment_header_id], ['is_completed' => 1, 'next_assesment_date' => $next_assessment_date ]);
				
				$this->update_assessment_counter($assessment_header_id); 
				if( $form_data['assessment_tool_id'] == '25' ){
					$this->thankyou_screen(26);
				} elseif( $form_data['assessment_tool_id'] == '26' ){
					$this->thankyou_screen(27);
				} else {
					if($this->session->userdata('rolecode') != MEDICPRAC){
					redirect("test_results/healthtools");
					} else {
						redirect("health_tools_assessments");
					}
				}

			} else {
				//die("error!");
				//redirect("test_results/healthtools");
				if( $form_data['assessment_tool_id'] == '25' ){
					$this->thankyou_screen(26);
				} elseif( $form_data['assessment_tool_id'] == '26' ){
					$this->thankyou_screen(27);
				} else {
					if($this->session->userdata('rolecode') != MEDICPRAC){
					redirect("test_results/healthtools");
					} else {
						redirect("healthtools");
					}
				}
			}
		}

	}
	public function thankyou_screen($assessment_tool_id){
		$assessment_data 		= $this->session->userdata('assessment_data');
		$data['patient_id'] = $assessment_data['patient_id'];
		$data['assessment_tool_id'] = $assessment_tool_id;
		$data['assessment_type_id'] = $assessment_data['assessment_type_id'];
		$data['assessment_sub_type_id'] = $assessment_data['assessment_sub_type_id'];
		$data['facility_id'] = $assessment_data['facility_id'];
		$data['assessment_date'] = $assessment_data['assessment_date'];
		$data['assessment_time'] = $assessment_data['assessment_time'];
		$data['HLS_Total_Score'] = null;
		$data['beauty_webite'] = null;
		if( $assessment_tool_id == 27 ) {
			$HLS = $this->common_model->raw_query("SELECT * FROM `assessment_header` WHERE `patient_id` = {$assessment_data['patient_id']} AND `assessment_tool_id` = 26 AND `is_completed` = 1 ORDER BY id DESC LIMIT 0,1");
			if(isset($HLS)) {
				$HLS_Total_Score= $this->common_model->raw_query("SELECT SUM(`ad`.`assessment_questionnaires_value`) as `HLS_SCORE` FROM `assessment_detail` `ad` RIGHT JOIN (SELECT `ah`.`id` from `assessment_header` `ah` WHERE `ah`.`patient_id` = {$assessment_data['patient_id']} AND `ah`.`assessment_type_id` = 6 AND `ah`.`assessment_sub_type_id` = 1 AND `ah`.`assessment_tool_id` = 26 AND `ah`.`is_completed` = 1 ORDER BY `ah`.`id` DESC LIMIT 0,1) as `answers` ON (`ad`.`assessment_header_id`=`answers`.`id`)")[0]['HLS_SCORE'];
				$HLS_Total_Score = ($HLS_Total_Score/72)*50;
				$data['HLS_Total_Score'] = number_format((float)$HLS_Total_Score, 2, '.', '');
			}
		}
		$data['content'] = 'survey/healthtools/family_history/thankyou_screen';
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);
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
	public function get_healthbeauty_website_link() {
		$health_beauty_website = $this->common_model->getOne(GLOBALSETTING, ['keyname' => 'CancerRiskAssessWebsite']);
		if(isset($health_beauty_website)) {
			return $health_beauty_website->keyvalue;
		} else {
			return '';
		}
	}
}
	
