<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Lungs_cancer extends MY_Controller {
	function __construct(){
		parent::__construct();
		if(!$this->isLoggedIn()){
			redirect(base_url(''));
		}
	}
	
	public function index(){
		redirect(base_url('test_results/lungs'));
	}

	public function verify_assessment_type() {
		if( !$this->session->userdata('assessment_data') ) {
			redirect(base_url(''));
		} else {
			$assessment_data = $this->session->userdata( 'assessment_data' );
			if( !isset($assessment_data['assessment_type_id']) || $assessment_data['assessment_type_id'] != 3 ) {
				redirect(base_url('lungs_cancer/screening'));
			}
		}
	}

	public function lungs_cancer_selection(){
		$data['content'] = 'survey/lungs/selection';
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);
	}

	public function screening() {
		unset($this->session->userdata['assessment_data']);
		$data['assessments_info'] = $this->get_assessments_info();
		$data['previous'] = $_SERVER['HTTP_REFERER'];
		$patient_data = $this->input->post();

		$where 					= ['assessment_types_id' => 3, 'assessment_sub_type_id' => 1, 'is_obsolete' => 0];
		$data['assessment_tools']['self'] = $this->common_model->getAll(ASSESSMENT_TOOLS, $where);
		$where 					= ['assessment_types_id' => 3, 'assessment_sub_type_id' => 2, 'is_obsolete' => 0];
		$data['assessment_tools']['clinical'] = $this->common_model->getAll(ASSESSMENT_TOOLS, $where);
		$where 					= ['assessment_types_id' => 3, 'assessment_sub_type_id' => 3, 'is_obsolete' => 0];
		$data['assessment_tools']['others'] = $this->common_model->getAll(ASSESSMENT_TOOLS, $where);

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
			$data['assessment_name'] = 'Lungs Cancer';
			$data['backlink'] = base_url('all_assessments/lung_cancer');
			$data['doctor_assessment_link'] = base_url("lungs_cancer/screening");
			$data['content'] = 'doctor/common_assessment_selection';
		}else{
			if($this->session->userdata('rolecode') != MEDICPRAC){
				$data['facilities'] = $this->common_model->getAll('m_facility', ['is_obsolete' => 0]);
			}
			$data['content'] = 'survey/lungs/selection';
			if(!empty($patient_data)){
				$sql1 = "SELECT u.*, up.id_number FROM ".USERS." AS u LEFT JOIN ".USERS_PATIENT." AS up ON u.id = up.user_id WHERE u.id = ".$patient_data['patient_id']."";
				$data['patient_data'] = $this->common_model->raw_query($sql1);
			}
		}		
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);
	}

	public function save_lungs_cancer_header() {
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

			if( $assessment_data["assessment_tool_id"] == 10 || $assessment_data["assessment_tool_id"] == 11 || $assessment_data["assessment_tool_id"] == 12 ) {
				$this->assessment_intro();
			} else {
				redirect(base_url('lungs_cancer/questions'));
			}
		}

	public function assessment_intro(){
		$assessment_data 		= $this->session->userdata('assessment_data');
		$data['assessment_tool_id'] = $assessment_data['assessment_tool_id'];
		$data['content'] = 'survey/lungs/lungs_questions/assessment_intro';
		$data['is_footer'] = false;
		// pre_d($data);
		$this->load->view('layout/main', $data);
	}
	public function save_lungs_cancer_questions() {
		$form_data = $this->input->post();
		$is_exists = $this->common_model->getOne(ASSESSMENT_DETAIL, ['assessment_header_id' => $form_data['assessment_header_id']]);
		$last_insert_id = 0;
		if (!$is_exists) {
			$replies_data = [];
			$assessment_header_id = $form_data['assessment_header_id'];
			$assessment_types_id = $form_data['assessment_types_id'];
			$assessment_tools_id = $form_data['assessment_tools_id'];

			$key_name;

			$replies_data = [];
			$key_name = key($_FILES);
			$assessment_header_id = $form_data['assessment_header_id'];

			if(isset($_FILES[$key_name]) && !empty($_FILES[$key_name]['name'])){
				$file_name = $_FILES[$key_name]['name'];
				$file_size =$_FILES[$key_name]['size'];
				$file_tmp =$_FILES[$key_name]['tmp_name'];
				$file_type=$_FILES[$key_name]['type'];
				$fileNameCmps = explode(".", $file_name);
				$fileExtension = strtolower(end($fileNameCmps));
				
				$patient_id_number = $this->session->userdata('id_number');
				$name = $patient_id_number."_".$form_data['assessment_header_id'];
				
				$temp = explode(".", $file_name);
				$newfilename = $name . '.' . end($temp);
				$newfilename = md5($newfilename);
				$this->load->library('upload', get_image_upload_config($newfilename));
				if ( ! $this->upload->do_upload($key_name))
                {
                        $error = array('error' => $this->upload->display_errors());
                        echo $error['error'];
                        die();
                }
                else {
				//move_uploaded_file($file_tmp,"assets/images/".$newfilename);

				$replies_data[] = ['assessment_header_id' => $assessment_header_id, 'assement_questionnaires_id' => $key_name, 'assement_questionnaires_column_id' => 0, 'assessment_questionnaires_value' => $this->upload->data('file_name'), 'file_path'=> 1, 'created_by' => $this->session->userdata('id')];
				}
			}

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
	        $date->modify('+1 month');
	        $next_assessment_date = $date->format('Y-m-d');
	        $data['assessment_tools_id'] = $assessment_tools_id;
			$data['next_assesment_date'] = $next_assessment_date;
			if ($last_insert_id > 0) {
				$this->common_model->update(ASSESSMENT_HEADER, ['id' => $assessment_header_id], ['is_completed' => 1, 'next_assesment_date' => $next_assessment_date ]);
				$this->update_assessment_counter($assessment_header_id); 
				/*$data_to_send = array(
							'assessment_header_id'=>$assessment_header_id,
							);*/
				if($this->session->userdata('rolecode') != MEDICPRAC){
				//echo json_encode(array('result'=>'success', 'url'=>base_url("test_results/healthtools"), 'data'=>json_encode($data_to_send)));
				} else {
				//echo json_encode(array('result'=>'success', 'url'=>base_url("test_results/healthtools"), 'data'=>json_encode($data_to_send)));
				}
				$data['content'] = 'survey/lungs/lungs_questions/successful';
				$data['is_footer'] = false;
				$this->load->view('layout/main', $data);

			} else {
				//die("error!");
				//redirect("test_results/healthtools");
				if($this->session->userdata('rolecode') != MEDICPRAC){
				//echo json_encode(array('result'=>'success', 'url'=>base_url("test_results/healthtools"), 'data'=>json_encode($data_to_send)));
				} else {
				//echo json_encode(array('result'=>'success', 'url'=>base_url("test_results/healthtools"), 'data'=>json_encode($data_to_send)));
				}
				$data['content'] = 'survey/lungs/lungs_questions/successful';
				$data['is_footer'] = false;
				$this->load->view('layout/main', $data);
			}
		} else {
			//echo json_encode(array('result'=>'fail', 'message'=>'Invalid Data' ));
		}
	}

	public function questions() {
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

		$adult_or_adolescent = null;
		$dob = $user_patient->dob;
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
		$data['patient_gender'] = $user_patient->gender_id; 
		$data['values'] = $this->get_smokelyzer_chart_data();
		$data['content'] = 'survey/lungs/lungs_questions/lungs_questions';
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);
	}

	public function get_smokelyzer_chart_data() {
		$values['labels'] = [];
		$values['values'] = [];
		$assessment_data 		= $this->session->userdata('assessment_data');
		
		$patient_id = $assessment_data['patient_id'];
			
			$chart_question_row = $this->common_model->getOne(ASSESSMENT_QUESTIONNAIRES, ['assessment_types_id' => 3, 'assessment_tools_id' => 11, 'q_identifier' => 'LUN_SMO_5', 'is_obsolete' => 0]);
			$chart_question_id = $chart_question_row->id ? $chart_question_row->id : 0;
			$sub_prev_sql = "SELECT ad.*, DATE_FORMAT(ah.assessment_date,'%M-%y') AS assessment_date FROM assessment_detail  AS ad LEFT JOIN assessment_header AS ah ON ad.assessment_header_id = ah.id WHERE ad.assement_questionnaires_id = ".$chart_question_id." AND ah.assessment_type_id = 3 AND 
						ah.assessment_tool_id = 11 AND 
						ah.patient_id = ".$patient_id." AND
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
