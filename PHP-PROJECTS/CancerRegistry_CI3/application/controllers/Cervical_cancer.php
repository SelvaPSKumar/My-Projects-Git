<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cervical_cancer extends MY_Controller {
	function __construct(){
		parent::__construct();
		if(!$this->isLoggedIn()){
			redirect(base_url(''));
		}
	}
	
	public function index(){
		redirect(base_url('test_results/cervical'));
	}

	public function verify_assessment_type() {
		if( !$this->session->userdata('assessment_data') ) {
			redirect(base_url(''));
		} else {
			$assessment_data = $this->session->userdata( 'assessment_data' );
			if( !isset($assessment_data['assessment_type_id']) || $assessment_data['assessment_type_id'] != 5 ) {
				redirect(base_url('cervical_cancer/screening'));
			}
		}
	}

	public function cervical_cancer_selection(){
		$data['content'] = 'survey/cervical/selection';
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);
	}

	public function screening() {
		unset($this->session->userdata['assessment_data']);
		$data['assessments_info'] = $this->get_assessments_info();
		$data['previous'] = base_url('test_results/cervical');
		$patient_data = $this->input->post();

		$where 					= ['assessment_types_id' => 5, 'assessment_sub_type_id' => 1, 'is_obsolete' => 0];
		$data['assessment_tools']['self'] = $this->common_model->getAll(ASSESSMENT_TOOLS, $where);
		$where 					= ['assessment_types_id' => 5, 'assessment_sub_type_id' => 2, 'is_obsolete' => 0];
		$data['assessment_tools']['clinical'] = $this->common_model->getAll(ASSESSMENT_TOOLS, $where);
		$where 					= ['assessment_types_id' => 5, 'assessment_sub_type_id' => 3, 'is_obsolete' => 0];
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

			$dob = $data['patients']['dob'];
			$age = date_diff(date_create($dob), date_create('today'))->y;
			// $data['patients'] = $this->common_model->getAll(USERS, ['is_obsolete' => 0, 'facility_id' => $this->session->userdata('facility_id'), 'role_id' => $patient_rolecode->id]);
			$data['assessment_types'] = $this->common_model->getAll(ASSESSMENT_TYPES, ['is_obsolete' => 0]);
			$data['assessment_name'] = 'Cervical Cancer';
			$data['backlink'] = base_url('all_assessments/cervical_cancer');
			$data['doctor_assessment_link'] = base_url("cervical_cancer/screening");
			$data['content'] = 'doctor/common_assessment_selection';
		}else{
			if($this->session->userdata('rolecode') != MEDICPRAC){
				$data['facilities'] = $this->common_model->getAll('m_facility', ['is_obsolete' => 0]);
			}
			$data['content'] = 'survey/cervical/selection';
			if(!empty($patient_data)){
				$sql1 = "SELECT u.*, up.id_number FROM ".USERS." AS u LEFT JOIN ".USERS_PATIENT." AS up ON u.id = up.user_id WHERE u.id = ".$patient_data['patient_id']."";
				$data['patient_data'] = $this->common_model->raw_query($sql1);
			}

			
			$dob = $this->session->userdata('dob');
			$age = date_diff(date_create($dob), date_create('today'))->y;

			//for vaccine
			if( $assessment_data['assessment_tool_id'] == 30 ) {
				$where = ['patient_id' => $assessment_data['patient_id'], 'is_acknowledged' => 1, 'is_obsolete' => 0];
				$acknowledged = $this->common_model->getOne(HPV_CONSENT, $where);
				if(!$acknowledged) {
					if( isset( $form_data['condition'] ) ) {
						$acknowledge_data['patient_id'] = $assessment_data['patient_id'];
						$acknowledge_data['kesan_sampingan_teruk'] = $form_data['condition'][1] ? $form_data['condition'][1] : 0;
						$acknowledge_data['sejarah_alahan_teruk'] = $form_data['condition'][2] ? $form_data['condition'][2] : 0;
						$acknowledge_data['hamil'] = $form_data['condition'][3] ? $form_data['condition'][3] : 0;
						$acknowledge_data['menyusukan_bayi'] = $form_data['condition'][4] ? $form_data['condition'][4] : 0;
						$acknowledge_data['is_acknowledged'] = $form_data['acknowledge_concern'] ? $form_data['acknowledge_concern'] : 0;
						$acknowledge_data['created_by'] = $this->session->userdata('id');
						$acknowledge_data_submit = $this->common_model->insert(HPV_CONSENT, $acknowledge_data);
					}
				}
			}
			
			if(isset($age)) {
				$vaccine_two_min_interval_in_months = null;
				$vaccine_three_min_interval_in_months = null;
				if( $age < 15 ) {
					$vaccine_two_min_interval_in_months = 5;
				} else{
					$vaccine_two_min_interval_in_months = 1;
					$vaccine_three_min_interval_in_months = 3;
				}
			}

		}
			

		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);
	}

	public function save_cervical_cancer_header() {
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
			if($assessment_data['assessment_tool_id'] == 17 || $assessment_data['assessment_tool_id'] == 18 || $assessment_data['assessment_tool_id'] == 30) {
				$assessment_data['assessment_date'] = date("Y-m-d");
				$assessment_data['assessment_time'] = date("H:i:s");
			}
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

			//for vaccine
			if( $assessment_data['assessment_tool_id'] == 30 ) {
				$where = ['patient_id' => $assessment_data['patient_id'], 'is_acknowledged' => 1, 'is_obsolete' => 0];
				$acknowledged = $this->common_model->getOne(HPV_CONSENT, $where);
				if(!$acknowledged) {
					if( isset( $form_data['condition'] ) ) {
						$acknowledge_data['patient_id'] = $assessment_data['patient_id'];
						$acknowledge_data['kesan_sampingan_teruk'] = $form_data['condition'][1] ? $form_data['condition'][1] : 0;
						$acknowledge_data['sejarah_alahan_teruk'] = $form_data['condition'][2] ? $form_data['condition'][2] : 0;
						$acknowledge_data['hamil'] = $form_data['condition'][3] ? $form_data['condition'][3] : 0;
						$acknowledge_data['menyusukan_bayi'] = $form_data['condition'][4] ? $form_data['condition'][4] : 0;
						$acknowledge_data['is_acknowledged'] = $form_data['acknowledge_concern'] ? $form_data['acknowledge_concern'] : 0;
						$acknowledge_data['created_by'] = $this->session->userdata('id');
						$acknowledge_data_submit = $this->common_model->insert(HPV_CONSENT, $acknowledge_data);
					}
				}
			}

			redirect(base_url('cervical_cancer/questions'));
		}

	public function save_cervical_cancer_questions() {
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

			$assessment_answer_for_result = null;
			if(isset($form_data['question'])) {
				foreach ($form_data['question'] as $key => $reply) {
					if(is_array($reply)){
						foreach($reply as $sub_key => $sub_reply){
							//checking if value set yes
							if(isset($sub_reply) && strtolower($sub_reply) == 'yes' && $assessment_tools_id == 24) {
								$assessment_answer_for_result = true;
							}

							if(isset($sub_reply) && ($assessment_tools_id == 16 || $assessment_tools_id == 17 || $assessment_tools_id == 18)) {
								$assessment_answer_for_result = $sub_reply;
							}
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
			$data['assessment_answer_for_result'] = $assessment_answer_for_result;
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
				$data['content'] = 'survey/cervical/cervical_questions/successful';
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
				$data['content'] = 'survey/cervical/cervical_questions/successful';
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
		$data['patient_gender'] = $user_patient->gender_id;
		$data['content'] = 'survey/cervical/cervical_questions/cervical_questions';
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);
	}
	public function vaccine_information_sheet() {

		$original_file = 'assets/img/HPV_Vaccine_Information_Sheet.pdf';
		header('Content-Description: File Transfer');
		header('Content-Type: '.mime_content_type($original_file));
		header('Content-Disposition: inline; filename="vaccine_information_sheet"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($original_file));
		readfile($original_file);
		die();
	}
}
