<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Colorectal_cancer extends MY_Controller {
	function __construct(){
		parent::__construct();
		if(!$this->isLoggedIn()){
			redirect(base_url('colorectal_cancer/screen'));
			$this->load->helper('common_helper');
		}
	}
	
	public function index(){
		
	}
	public function verify_assessment_type() {
		if( !$this->session->userdata('assessment_data') ) {
			redirect(base_url(''));
		} else {
			$assessment_data = $this->session->userdata( 'assessment_data' );
			if( !isset($assessment_data['assessment_type_id']) || $assessment_data['assessment_type_id'] != 1 ) {
				redirect(base_url('colorectal_cancer/screen'));
			}
		}
	}

	public function colorectal_cancer_selection(){
		unset($this->session->userdata['assessment_data']);
		$data['assessments_info'] = $this->get_assessments_info();
		$data['previous'] = $_SERVER['HTTP_REFERER'];
		$patient_data = $this->input->post();

		$where 					= ['assessment_types_id' => 1, 'assessment_sub_type_id' => 1, 'is_obsolete' => 0];
		$data['assessment_tools']['self'] = $this->common_model->getAll(ASSESSMENT_TOOLS, $where);
		$where 					= ['assessment_types_id' => 1, 'assessment_sub_type_id' => 2, 'is_obsolete' => 0];
		$data['assessment_tools']['clinical'] = $this->common_model->getAll(ASSESSMENT_TOOLS, $where);

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
			$data['assessment_name'] = 'Colorectal Cancer';
			$data['backlink'] = base_url('all_assessments/colorectal_cancer');
			$data['doctor_assessment_link'] = base_url("colorectal_cancer/screen");
			$data['content'] = 'doctor/common_assessment_selection';
		}else{
			if($this->session->userdata('rolecode') != MEDICPRAC){
				$data['facilities'] = $this->common_model->getAll('m_facility', ['is_obsolete' => 0]);
			}
			$data['content'] = 'survey/colorectal/selection';
			if(!empty($patient_data)){
				$sql1 = "SELECT u.*, up.id_number FROM ".USERS." AS u LEFT JOIN ".USERS_PATIENT." AS up ON u.id = up.user_id WHERE u.id = ".$patient_data['patient_id']."";
				$data['patient_data'] = $this->common_model->raw_query($sql1);
			}
		}		
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);
	}

	public function save_colorectal_cancer_header() {
		$form_data = $this->input->post();
		if ($this->session->userdata('rolecode') == MEDICPRAC) {
			$assessment_data['patient_id'] 				= isset($form_data['patient_id']) ? $form_data['patient_id'] : '';
		} else {
			$assessment_data['patient_id'] 				= $this->session->userdata('id');
		}
			
			$last_assessment_number_sql = $this->common_model->raw_query("SELECT assessment_number FROM ".ASSESSMENT_HEADER." Where patient_id = ". $assessment_data['patient_id'] ." AND is_completed = 1 AND is_obsolete = 0 ORDER BY id DESC LIMIT 1 ");
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

			if( $assessment_data["assessment_tool_id"] == 3 || $assessment_data["assessment_tool_id"] == 4 ||$assessment_data['assessment_tool_id'] == "21" ) {
				$this->risk_assessment_intro();
			} else {
				redirect(base_url('colorectal_questions'));
			}
	}

	public function colorectal_questions() {
		$this->verify_assessment_type();
		$assessment_data 		= $this->session->userdata('assessment_data');

		$assessment_types_id 	= $assessment_data['assessment_type_id'];
		$assessment_tools_id 	= $assessment_data['assessment_tool_id'];
		$assessment_header_id 	= $assessment_data['assessment_header_id'];

		$data['assessment_header_id'] 	= $assessment_header_id;
		$data['assessment_types_id'] 	= $assessment_types_id;
		$data['assessment_tools_id'] 	= $assessment_tools_id;

		$where 					= ['assessment_types_id' => $assessment_types_id, 'assessment_tools_id' => $assessment_tools_id, 'is_obsolete' => 0];
		$data['questions'] 		= $this->common_model->getAll(ASSESSMENT_QUESTIONNAIRES, $where, '', ['q_no', 'q_no']);
		
		$where = ['id' => $assessment_data['patient_id']];
		$user_patient = $this->common_model->getOne(USERS, $where);
		$data['patient_gender'] = $user_patient->gender_id; 

		$data['content'] = 'survey/colorectal/colorectal_questions/colorectal_questions';
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);
	}

	public function save_colorectal_cancer_questions() {
		$form_data = $this->input->post();
		$is_exists = $this->common_model->getOne(ASSESSMENT_DETAIL, ['assessment_header_id' => $form_data['assessment_header_id']]);
		$last_insert_id = 0;
		if (!$is_exists) {
			$replies_data = [];
			$assessment_header_id = $form_data['assessment_header_id'];
			$assessment_types_id = $form_data['assessment_types_id'];
			$assessment_tools_id = $form_data['assessment_tools_id'];

			unset($form_data['assessment_header_id']);
			unset($form_data['assessment_types_id']);
			unset($form_data['assessment_tools_id']);

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
			$assessment_header = $this->common_model->getById(ASSESSMENT_HEADER, $assessment_header_id); 
			$assessment_date = $assessment_header->assessment_date;
			$date = new DateTime($assessment_date);
	        $date->modify('+12 month');
	        $next_assessment_date = $date->format('Y-m-d');
	        $data['assessment_tools_id'] = $assessment_tools_id;
			$data['next_assesment_date'] = $next_assessment_date;
			if ($last_insert_id > 0) {
				$this->common_model->update(ASSESSMENT_HEADER, ['id' => $assessment_header_id], ['is_completed' => 1, 'next_assesment_date' => $next_assessment_date ]);
				$this->update_assessment_counter($assessment_header_id); 
				/*$data_to_send = array(
							'assessment_header_id'=>$assessment_header_id,
							);*/
				if( $assessment_tools_id == '20' ){
					$data['content'] = 'survey/colorectal/colorectal_questions/success_full';
					$data['is_footer'] = false;
					$this->load->view('layout/main', $data);
					//echo json_encode(array('result'=>'success', 'url'=>base_url("test_results/healthtools"), 'data'=>json_encode($data_to_send)));
				} else {
					if($this->session->userdata('rolecode') != MEDICPRAC){
					//echo json_encode(array('result'=>'success', 'url'=>base_url("test_results/healthtools"), 'data'=>json_encode($data_to_send)));
					} else {
					//echo json_encode(array('result'=>'success', 'url'=>base_url("test_results/healthtools"), 'data'=>json_encode($data_to_send)));
					}
					$data['content'] = 'survey/colorectal/colorectal_questions/success_full';
					$data['is_footer'] = false;
					$this->load->view('layout/main', $data);
				}

			} else {
				//die("error!");
				//redirect("test_results/healthtools");
				if( $assessment_tools_id == '28' ){
					$data['content'] = 'survey/colorectal/colorectal_questions/success_full';
					$data['is_footer'] = false;
					$this->load->view('layout/main', $data);
					//echo json_encode(array('result'=>'success', 'url'=>base_url("test_results/healthtools"), 'data'=>json_encode($data_to_send)));
				} else {
					if($this->session->userdata('rolecode') != MEDICPRAC){
					//echo json_encode(array('result'=>'success', 'url'=>base_url("test_results/healthtools"), 'data'=>json_encode($data_to_send)));
					} else {
					//echo json_encode(array('result'=>'success', 'url'=>base_url("test_results/healthtools"), 'data'=>json_encode($data_to_send)));
					}
					$data['content'] = 'survey/colorectal/colorectal_questions/success_full';
					$data['is_footer'] = false;
					$this->load->view('layout/main', $data);
				}
			}
		} else {
			//echo json_encode(array('result'=>'fail', 'message'=>'Invalid Data' ));
		}
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

	/*
	public function colorectal_questions($param = null){

		if ($this->input->post('new_test') && empty($this->session->userdata('test_id'))) {
			$data['assessment_type'] =  $this->input->post('assessment_type');
			$data['assessment_sub_type'] =  $this->input->post('assessment_sub_type');
			$data['assessment_tool'] =  $this->input->post('assessment_tool');
			$data['date'] =  $this->input->post('date');
			$data['time'] =  $this->input->post('time');
			$data['user_id'] =  $this->current_user_id;
			$test_id = $this->common_model->insert(TESTS, $data);
			if (!$test_id) {
				redirect($_SERVER['HTTP_REFERER']);
			}
			$this->session->set_userdata('test_id', $test_id);
		}
		$post_data = $this->input->post();
		if (($param != 'one' && !empty($post_data)) || $param == 'success_full') {
			
			if ($param != 'success_full') {
				$question_id 	= $key 		= key($this->input->post());
				$reply 			= $value 	= $this->input->post($key);
				$reply_data['reply'] = make_replies_data($reply);
				$reply_data['test_id'] = $this->session->userdata('test_id');
				$reply_data['question'] = $question_id;
				$is_exists = $this->common_model->getOne(REPLIES, ['test_id' => $this->session->userdata('test_id'), 'question' => $question_id]);
				if ($is_exists) {
					$saved = $this->common_model->update(REPLIES, ['test_id' => $this->session->userdata('test_id'), 'question' => $question_id], ['reply' => $reply]);
				} else {
					$saved = $this->common_model->insert(REPLIES, $reply_data);
				}
			}
			if ($param == 'consult_doctor') {
				$data['content'] = 'survey/colorectal/colorectal_questions/consult_doctor';
			} else if($param == 'success_full'){
				$saved = $this->common_model->update(TESTS, ['id' => $this->session->userdata('test_id')], ['status' => "Completed"]);
				$this->session->unset_userdata('test_id');
				$data['content'] = 'survey/colorectal/colorectal_questions/success_full';
			}else{
				$data['content'] = 'survey/colorectal/colorectal_questions/colorectal_question_' . $param;
			}
		} else{
			// die('ere');
			$data['content'] = 'survey/colorectal/colorectal_questions/colorectal_question_' . $param;
		}
		$data['is_footer'] = false;
		$data['previous'] = base_url('test_results/colorectal');
		$this->load->view('layout/main', $data);

	}*/

	public function risk_assessment_intro(){
		$assessment_data 		= $this->session->userdata('assessment_data');
		$data['assessment_tool_id'] = $assessment_data['assessment_tool_id'];
		$data['content'] = 'survey/colorectal/colorectal_questions/risk_assessment_intro';
		$data['is_footer'] = false;
		// pre_d($data);
		$this->load->view('layout/main', $data);
	}
	
	public function risk_assessment_calculator(){
		$data['content'] = 'survey/colorectal/risk_assessment/calculator';
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);
	}
	
	public function risk_assessment_score(){
		$data['content'] = 'survey/colorectal/risk_assessment/score';
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);
	}

	public function colonoscopy(){
		$data['content'] = 'survey/colorectal/colonoscopy/index';
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);
	}

	public function colonoscopy_doctor(){
		$data['content'] = 'survey/colorectal/colonoscopy/doctor';
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);
	}

	public function ifobt(){
		$data['content'] = 'survey/colorectal/ifobt/index';
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);
	}

	public function ifobt_doctor(){
		$data['content'] = 'survey/colorectal/ifobt/doctor';
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);
	}

	
}
