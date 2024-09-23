<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class general_health extends MY_Controller {
	function __construct(){
		parent::__construct();
		if(!$this->isLoggedIn()){
			redirect(base_url(''));
		}
	}
	
	public function index() {
		
	}

	public function general_health_screening() {
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
			$data['assessment_name'] = 'General Health';
			$data['doctor_assessment_link'] = base_url("general_health/screening");
			$data['content'] = 'doctor/common_assessment_selection';
		}else{
			if($this->session->userdata('rolecode') != MEDICPRAC){
				$data['facilities'] = $this->common_model->getAll('m_facility', ['is_obsolete' => 0]);
			}
			$data['content'] = 'survey/general_health/index';
			if(!empty($patient_data)){
				$sql1 = "SELECT u.*, up.id_number FROM ".USERS." AS u LEFT JOIN ".USERS_PATIENT." AS up ON u.id = up.user_id WHERE u.id = ".$patient_data['patient_id']."";
				$data['patient_data'] = $this->common_model->raw_query($sql1);
			}
		}		
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);

	}

	public function save_general_health_header() {
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
			if( $assessment_data['assessment_tool_id'] == "28" || $assessment_data['assessment_tool_id'] == "29" ) {
				$this->general_health_questions();
			} else {
			}
	}
	public function general_health_questions() {

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

		$data['content'] = 'survey/general_health/general_health/general_health_questions';
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);
	}

	public function ajax_save_general_health_questions() {
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

			$data['next_assesment_date'] = $next_assessment_date;
			if ($last_insert_id > 0) {
				$this->common_model->update(ASSESSMENT_HEADER, ['id' => $assessment_header_id], ['is_completed' => 1, 'next_assesment_date' => $next_assessment_date ]);
				$this->update_assessment_counter($assessment_header_id); 
				/*$data_to_send = array(
							'assessment_header_id'=>$assessment_header_id,
							);*/
				if( $assessment_tools_id == '28' ){
					$data['content'] = 'survey/general_health/general_health/successful';
					$data['is_footer'] = false;
					$this->load->view('layout/main', $data);
					//echo json_encode(array('result'=>'success', 'url'=>base_url("test_results/healthtools"), 'data'=>json_encode($data_to_send)));
				} else {
					if($this->session->userdata('rolecode') != MEDICPRAC){
					//echo json_encode(array('result'=>'success', 'url'=>base_url("test_results/healthtools"), 'data'=>json_encode($data_to_send)));
					} else {
					//echo json_encode(array('result'=>'success', 'url'=>base_url("test_results/healthtools"), 'data'=>json_encode($data_to_send)));
					}
					$data['content'] = 'survey/general_health/general_health/successful';
					$data['is_footer'] = false;
					$this->load->view('layout/main', $data);
				}

			} else {
				//die("error!");
				//redirect("test_results/healthtools");
				if( $assessment_tools_id == '28' ){
					$data['content'] = 'survey/general_health/general_health/successful';
					$data['is_footer'] = false;
					$this->load->view('layout/main', $data);
					//echo json_encode(array('result'=>'success', 'url'=>base_url("test_results/healthtools"), 'data'=>json_encode($data_to_send)));
				} else {
					if($this->session->userdata('rolecode') != MEDICPRAC){
					//echo json_encode(array('result'=>'success', 'url'=>base_url("test_results/healthtools"), 'data'=>json_encode($data_to_send)));
					} else {
					//echo json_encode(array('result'=>'success', 'url'=>base_url("test_results/healthtools"), 'data'=>json_encode($data_to_send)));
					}
					$data['content'] = 'survey/general_health/general_health/successful';
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
}