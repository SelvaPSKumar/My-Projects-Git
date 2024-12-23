<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Screening extends MY_Controller {
	function __construct(){
		parent::__construct();
		if(!$this->isLoggedIn()){
			redirect(base_url(''));
			$this->load->helper('common_helper');
		}
	}
	public function index(){
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
			$data['content'] = 'survey/screening/patient_selection';
		}else{
			if($this->session->userdata('rolecode') != MEDICPRAC){
				$data['facilities'] = $this->common_model->getAll('m_facility', ['is_obsolete' => 0]);
			}
			$data['content'] = 'survey/screening/selection';
			if(!empty($patient_data)){
				$sql1 = "SELECT u.*, up.id_number FROM ".USERS." AS u LEFT JOIN ".USERS_PATIENT." AS up ON u.id = up.user_id WHERE u.id = ".$patient_data['patient_id']."";
				$data['patient_data'] = $this->common_model->raw_query($sql1);
			}
		}		
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);
	}

	public function save_selection($redirect_route) {
		$form_data = $this->input->post();
		$assessment_data = $this->save_assessment_header($form_data);

		if (!empty($assessment_data)) {
			$this->session->set_userdata('assessment_data',$assessment_data);
		} else {
			die("error in first screen!");
		}
		redirect($redirect_route);
	}

	public function screening_note(){
		$data['content'] = 'survey/screening/screening_note/screening_note';
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);
	}

	public function screening_questions(){
		$assessment_data 		= $this->session->userdata('assessment_data');

		$assessment_types_id 	= $assessment_data['assessment_types_id'];
		$assessment_tools_id 	= $assessment_data['assessment_tools_id'];
		$assessment_header_id 	= $assessment_data['assessment_header_id'];
		
		$data['assessment_header_id'] 	= $assessment_header_id;
		$data['assessment_header_data'] = $this->common_model->getOne(ASSESSMENT_HEADER, ['id' => $assessment_header_id]);
		
		
		$where = [
					'assessment_types_id' => $assessment_types_id, 
					'assessment_tools_id' => $assessment_tools_id
				];
		$data['questions'] 	= $this->common_model->getAll(ASSESSMENT_QUESTIONNAIRES, $where, '', ['q_no', 'q_no']);
		
		$data['content'] 	= 'survey/screening/screening_questions/screening_questions';
		$data['is_footer'] 	= false;
		$this->load->view('layout/main', $data);

	}

	public function save_screening_questions() {
		$form_data = $this->input->post();

		$is_exists = $this->common_model->getOne(ASSESSMENT_DETAIL, ['assessment_header_id' => $form_data['assessment_header_id']]);

		if (!$is_exists) {
			$replies_data = [];
			$assessment_header_id = $form_data['assessment_header_id'];

			unset($form_data['assessment_header_id']);
			foreach ($form_data as $key => $reply) {
				if( is_array($reply) && count($reply) > 1 ){
					$reply[0] = strtoupper(implode(', ', $reply));
				}
				$replies_data[] = ['assessment_header_id' => $assessment_header_id, 'assement_questionnaires_id' => $key, 'assessment_questionnaires_value' => $reply[0], 'file_path' => 0, 'created_by' => $this->session->userdata('id')];
			}

			$msgyesdata = array_filter($replies_data, function( $que ){
				return ($que['assessment_questionnaires_value']=='yes') ; 
			});

			$last_insert_id = $this->common_model->insert_batch(ASSESSMENT_DETAIL, $replies_data);

			if ($last_insert_id > 0) {

				$this->common_model->update(ASSESSMENT_HEADER, ['id' => $assessment_header_id], ['is_completed' => 1, 'next_assesment_date' => $form_data['next_assesment_date']]);
				
				$this->update_assessment_counter($assessment_header_id); 

				if( !empty( $msgyesdata ) ) {
					redirect('screening_consult_doc');
				} else {
					redirect('screening_success_full');		
				}

			} else {
				die("error!");
			}
		} else {
			$quedata = $this->common_model->getAll(ASSESSMENT_DETAIL, [
				'assessment_header_id' => $form_data['assessment_header_id'] ,
				'assessment_questionnaires_value' => 'yes'
			]);

			if( !empty( $quedata ) ) {
				redirect('screening_consult_doc');
			} else {
				redirect('screening_success_full');		
			}

		}

	}
	public function screening_consult_doc() {
		$data['content'] = 'survey/screening/screening_questions/consult_doctor';
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);
	}

	public function screening_success_full() {
		$data['content'] = 'survey/screening/screening_questions/success_full';
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);
	}

// --------------------------------------------



	public function risk_breast_questions(){
		
		$assessment_data 		= $this->session->userdata('assessment_data');
		$assessment_types_id 	= $assessment_data['assessment_types_id'];
		$assessment_tools_id 	= $assessment_data['assessment_tools_id'];
		$assessment_header_id 	= $assessment_data['assessment_header_id'];
		
		$values = [];
		// will calculate years dynamically later @SHOAIB
		/*$year1_start 	= '2023-01-01';
		$year1_end 		= '2023-12-31';
		$year2_start 	= '2024-01-01';
		$year2_end 		= '2024-12-31';
		$year3_start 	= '2025-01-01';
		$year3_end 		= '2025-12-31';
		$year4_start 	= '2026-01-01';
		$year4_end 		= '2026-12-31';*/
		//dynamic last 4 years
		$year = date("Y");
		for($i=3;$i>=0;$i--) {
			$year_start[$i] = $year.'-01-01';
			$year_end[$i] = $year.'-12-31';
			$year--;
		}

		$patient_id = $this->session->userdata('id');
		/*
		$year1_sql = "SELECT id FROM assessment_header WHERE assessment_date IN 
								(SELECT max(assessment_date) FROM assessment_header where assessment_date >= '".$year1_start."' and assessment_date <= '".$year1_end."' )
						and assessment_type_id = 2 and 
						assessment_tool_id = 2 and 
						patient_id = ".$patient_id." and
						is_completed = 1
						order by id desc limit 1";

		$year2_sql = "SELECT id FROM assessment_header WHERE assessment_date IN 
								(SELECT max(assessment_date) FROM assessment_header where assessment_date >= '".$year2_start."' and assessment_date <= '".$year2_end."' )
						and assessment_type_id = 2 and 
						assessment_tool_id = 2 and 
						patient_id = ".$patient_id." and
						is_completed = 1
						order by id desc limit 1";
		$year3_sql = "SELECT id FROM assessment_header WHERE assessment_date IN 
				(SELECT max(assessment_date) FROM assessment_header where assessment_date >= '".$year3_start."' and assessment_date <= '".$year3_end."' )
						and assessment_type_id = 2 and 
						assessment_tool_id = 2 and 
						patient_id = ".$patient_id." and
						is_completed = 1
						order by id desc limit 1";
		$year4_sql = "SELECT id FROM assessment_header WHERE assessment_date IN 
				(SELECT max(assessment_date) FROM assessment_header where assessment_date >= '".$year4_start."' and assessment_date <= '".$year4_end."' )
						and assessment_type_id = 2 and 
						assessment_tool_id = 2 and 
						patient_id = ".$patient_id." and
						is_completed = 1
						order by id desc limit 1";
						// echo $year1_sql;*/
		$prev=array();
		for($i=3;$i>=0;$i--) {
			$year_sql = "SELECT id FROM assessment_header WHERE assessment_date IN 
								(SELECT max(assessment_date) FROM assessment_header where assessment_date >= '".$year_start[$i]."' and assessment_date <= '".$year_end[$i]."' )
						and assessment_type_id = 2 and 
						assessment_tool_id = 2 and 
						patient_id = ".$patient_id." and
						is_completed = 1
						order by id desc";
			$year_res[$i] = $this->common_model->raw_query($year_sql);
			$prev[] = isset($year_res[$i][0]['id']) ? $year_res[$i][0]['id'] :'';
		}
		/*
		$year1_res = $this->common_model->raw_query($year1_sql);
		$year2_res = $this->common_model->raw_query($year2_sql);
		$year3_res = $this->common_model->raw_query($year3_sql);
		$year4_res = $this->common_model->raw_query($year4_sql);
		$prev[] = isset($year1_res[0]['id']) ? $year1_res[0]['id'] :'';
		$prev[] = isset($year2_res[0]['id']) ? $year2_res[0]['id'] :'';
		$prev[] = isset($year3_res[0]['id']) ? $year3_res[0]['id'] :'';
		$prev[] = isset($year4_res[0]['id']) ? $year4_res[0]['id'] :'';
		*/
		if (!empty($prev)) {
			
			foreach ($prev as $key => $value) {
				// pre_d($value);
				$sub_prev[] = $this->common_model->getOne(ASSESSMENT_DETAIL, ['assessment_header_id' => $value]);
			}
			foreach ($sub_prev as $key => $value) {
				if (isset($value->assessment_questionnaires_value)) {
					$values[] = $value->assessment_questionnaires_value;
				}
			}
		}

		$where = ['assessment_types_id' => $assessment_types_id, 'assessment_tools_id' => $assessment_tools_id];
		$data['assessment_header_id'] = $assessment_header_id;
		$data['assessment_header_data'] = $this->common_model->getOne(ASSESSMENT_HEADER, ['id' => $assessment_header_id]);
		$data['questions'] = $this->common_model->getAll(ASSESSMENT_QUESTIONNAIRES, $where, '', ['q_no', 'q_no']);
		$data['content'] = 'survey/screening/risk_assessment_breast/risk_breast_questions';
		$data['values'] = $values;
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);
	}

	public function risk_breast_questions_save(){
		$form_data = $this->input->post();
		$assessment_header_id = $form_data['assessment_header_id'];

		$replies_data = [];
			unset($form_data['assessment_header_id']);
			foreach ($form_data as $key => $reply) {
				$replies_data[] = ['assessment_header_id' => $assessment_header_id, 'assement_questionnaires_id' => $key, 'assessment_questionnaires_value' => $reply[0], 'file_path' => 0, 'created_by' => $this->session->userdata('id')];
			}

			$last_insert_id = $this->common_model->insert_batch(ASSESSMENT_DETAIL, $replies_data);

			if ($last_insert_id > 0) {

				
				$this->common_model->update(ASSESSMENT_HEADER, ['id' => $assessment_header_id], ['is_completed' => 1, 'next_assesment_date' => $form_data['next_assesment_date']]);

				$this->update_assessment_counter($assessment_header_id);

				if($this->session->userdata('rolecode') == MEDICPRAC){
					redirect('all_assessments');
				}else{
					redirect('test_results/breast');
				}
			} else {
				die("error!");
			}

		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);

	}

	public function clinical_examination(){
		$data['content'] = 'survey/screening/clinical_examination/clinical_examination';
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);

	}

	public function clinical_questions(){
		$assessment_data 		= $this->session->userdata('assessment_data');
		$assessment_types_id 	= $assessment_data['assessment_types_id'];
		$assessment_tools_id 	= $assessment_data['assessment_tools_id'];
		$assessment_header_id 	= $assessment_data['assessment_header_id'];
		
		$data['assessment_header_id'] 	= $assessment_header_id;
		$data['assessment_header_data'] = $this->common_model->getOne(ASSESSMENT_HEADER, ['id' => $assessment_header_id]);
		$where 					= ['assessment_types_id' => $assessment_types_id, 'assessment_tools_id' => $assessment_tools_id, 'is_obsolete' => NOT_OBSOLETE];
		$data['questions'] 		= $this->common_model->getAll(ASSESSMENT_QUESTIONNAIRES, $where, '', ['q_no', 'q_no']);
		$data['shapes'] 		= $this->common_model->getAll(BREAST_SHAPE, ['is_obsolete' => 0]);
		$data['edges'] 		= $this->common_model->getAll(BREAST_EDGES, ['is_obsolete' => 0]);
		$data['consistency'] 		= $this->common_model->getAll(BREAST_CONSISTENCY, ['is_obsolete' => 0]);
		$data['content'] 		= 'survey/screening/clinical_examination/clinical_questions';
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);

	}
	public function save_clinical_questions() {

		$form_data = $this->input->post();
		$is_exists = $this->common_model->getOne(ASSESSMENT_DETAIL, ['assessment_header_id' => $form_data['assessment_header_id']]);

		if (!$is_exists) {

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

				$replies_data[] = ['assessment_header_id' => $assessment_header_id, 'assement_questionnaires_id' => $key_name, 'assessment_questionnaires_value' => $this->upload->data('file_name'), 'file_path'=> 1, 'created_by' => $this->session->userdata('id')];
				}
			}

			unset($form_data['assessment_header_id']);
			foreach ($form_data as $key => $reply) {
				if (!empty($reply[0])) {

					$replies_data[] = ['assessment_header_id' => $assessment_header_id, 'assement_questionnaires_id' => $key, 'assessment_questionnaires_value' => $reply[0], 'file_path' => 0, 'created_by' => $this->session->userdata('id')];
				}
			}
			// pre_d($replies_data);
			$last_insert_id = $this->common_model->insert_batch(ASSESSMENT_DETAIL, $replies_data);

			if ($last_insert_id > 0) {
				$next_assessment_date = $form_data['next_assesment_date'];
				$this->common_model->update(ASSESSMENT_HEADER, ['id' => $assessment_header_id], ['is_completed' => 1,'next_assesment_date' => $next_assessment_date]);

				$this->update_assessment_counter($assessment_header_id);

				redirect('clinical_success_full');
			} else {
				die("error!");
			}
			exit();
		} else {
			// update here
		}
		redirect('clinical_success_full');
	}

	public function clinical_success_full() {
		$data['content'] = 'survey/screening/clinical_examination/success_full';
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);
	}

	public function i_breast(){
		$data['content'] = 'survey/screening/i_breast/i_breast_examination';
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);

	}
	public function i_breast_questions(){

		$assessment_data 		= $this->session->userdata('assessment_data');
		$assessment_types_id 	= $assessment_data['assessment_types_id'];
		$assessment_tools_id 	= $assessment_data['assessment_tools_id'];
		$assessment_header_id 	= $assessment_data['assessment_header_id'];

		$data['assessment_header_id'] 	= $assessment_header_id;
		$data['assessment_header_data'] = $this->common_model->getOne(ASSESSMENT_HEADER, ['id' => $assessment_header_id]);
		$where 					= ['assessment_types_id' => $assessment_types_id, 'assessment_tools_id' => $assessment_tools_id];
		$data['questions'] 		= $this->common_model->getAll(ASSESSMENT_QUESTIONNAIRES, $where, '', ['q_no', 'q_no']);
		$data['symptoms'] 		= $this->common_model->getAll(SYMPTOMS, ['is_obsolete' => 0]);

		$data['content'] = 'survey/screening/i_breast/i_breast_questions';

		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);

	}
	public function save_i_breast_questions(){
		$form_data = $this->input->post();
		// pre_d($form_data);
		$is_exists = $this->common_model->getOne(ASSESSMENT_DETAIL, ['assessment_header_id' => $form_data['assessment_header_id']]);

		if (!$is_exists) {
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

				$replies_data[] = ['assessment_header_id' => $assessment_header_id, 'assement_questionnaires_id' => $key_name, 'assessment_questionnaires_value' => $this->upload->data('file_name'), 'file_path' => 1, 'created_by' => $this->session->userdata('id')];
					}
			}

			$ibreast_test_findings_data['assessment_header_id'] = $form_data['assessment_header_id'];
			$ibreast_test_findings_data['assessment_detail_id'] = 216;
			$ibreast_test_findings_data['created_by'] = $this->session->userdata('id');

			if (!empty($form_data['ibreast_test_findings'])) {
				foreach ($form_data['ibreast_test_findings'] as $key => $value) {
					$ibreast_test_findings_data[$key] = ($value == 'on') ? 1 : 0;
				}
				$last_finding_insert_id = $this->common_model->insert(IBREAST_TEST_FINDINGS, $ibreast_test_findings_data);
				$replies_data[] = ['assessment_header_id' => $assessment_header_id, 'assement_questionnaires_id' => $ibreast_test_findings_data['assessment_detail_id'] , 'assessment_questionnaires_value' => $last_finding_insert_id, 'file_path' => 0, 'created_by' => $this->session->userdata('id')];
				
			}

			// pre_d($_FILES);
			unset($form_data['assessment_header_id']);
			unset($form_data['ibreast_test_findings']);
			foreach ($form_data as $key => $reply) {
				if (!empty($reply[0])) {

					$replies_data[] = ['assessment_header_id' => $assessment_header_id, 'assement_questionnaires_id' => $key, 'assessment_questionnaires_value' => $reply[0], 'file_path' => 0, 'created_by' => $this->session->userdata('id')];
				}
			}
			$last_insert_id = $this->common_model->insert_batch(ASSESSMENT_DETAIL, $replies_data);

			if ($last_insert_id > 0) {

				$this->common_model->update(ASSESSMENT_HEADER, ['id' => $assessment_header_id], ['is_completed' => 1,'next_assesment_date' => $form_data['next_assesment_date']]);

				$this->update_assessment_counter($assessment_header_id);

				redirect('i_breast_successfull');
			} else {
				die("error!");
			}
		} else {
			// udpate here
				redirect('i_breast_successfull');
		}

	}
	public function i_breast_successfull(){
		$data['content'] = 'survey/screening/i_breast/success_full';
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);

	}
	public function ultra_sound_ultra_sound(){
		$data['content'] = 'survey/screening/ultra_sound/ultra_sound';
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);

	}

	public function ultra_sound_questions(){
		
		$assessment_data 		= $this->session->userdata('assessment_data');
		$assessment_types_id 	= $assessment_data['assessment_types_id'];
		$assessment_tools_id 	= $assessment_data['assessment_tools_id'];
		$assessment_header_id 	= $assessment_data['assessment_header_id'];

		$data['assessment_header_id'] 	= $assessment_header_id;

			$where 					= ['assessment_types_id' => $assessment_types_id, 'assessment_tools_id' => $assessment_tools_id];
			$data['questions'] 		= $this->common_model->getAll(ASSESSMENT_QUESTIONNAIRES, $where, '', ['q_no', 'q_no']);
			$data['content'] = 'survey/screening/ultra_sound/ultra_sound_questions';


		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);

	}

	public function save_ultra_sound() {
		$form_data = $this->input->post();
		$is_exists = $this->common_model->getOne(ASSESSMENT_DETAIL, ['assessment_header_id' => $form_data['assessment_header_id']]);

		if (!$is_exists) {
			$key_name;
			$replies_data = [];
			$key_name = key($_FILES);
			$assessment_header_id = $form_data['assessment_header_id'];

			if(isset($_FILES[$key_name]) && !empty($_FILES[$key_name]['name'][0])){
				$file_name = $_FILES[$key_name]['name'][0];
				$file_size =$_FILES[$key_name]['size'][0];
				$file_tmp =$_FILES[$key_name]['tmp_name'][0];
				$file_type=$_FILES[$key_name]['type'][0];
				$fileNameCmps = explode(".", $file_name);
				$fileExtension = strtolower(end($fileNameCmps));

				$patient_id_number = $this->session->userdata('id_number');
				$name = $patient_id_number."_".$form_data['assessment_header_id'];
				

				$temp = explode(".", $file_name);
				$newfilename = $name . '.' . end($temp);

				move_uploaded_file($file_tmp,"assets/images/".$newfilename);

				$replies_data[] = ['assessment_header_id' => $assessment_header_id, 'assement_questionnaires_id' => $key_name, 'assessment_questionnaires_value' => $newfilename, 'file_path' => 1, 'created_by' => $this->session->userdata('id')];
			}

			unset($form_data['assessment_header_id']);
			foreach ($form_data as $key => $reply) {
				$replies_data[] = ['assessment_header_id' => $assessment_header_id, 'assement_questionnaires_id' => $key, 'assessment_questionnaires_value' => $reply[0], 'file_path' => 0, 'created_by' => $this->session->userdata('id')];
			}
			$last_insert_id = $this->common_model->insert_batch(ASSESSMENT_DETAIL, $replies_data);

			if ($last_insert_id > 0) {

				$this->common_model->update(ASSESSMENT_HEADER, ['id' => $assessment_header_id], ['is_completed' => 1]);

				$this->update_assessment_counter($assessment_header_id);

				redirect('ultra_sound_success_full');
			} else {
				die("error!");
			}
		} else {
			// update here
				redirect('ultra_sound_success_full');
		}

	}
	public function ultra_sound_success_full() {
		$data['content'] = 'survey/screening/ultra_sound/success_full';
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);
	}

	public function clinical_ultra_sound(){
		$data['content'] = 'survey/screening/clinical_ultra_sound/ultra_sound';
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);

	}

	public function clinical_ultra_sound_questions(){

		$assessment_data 		= $this->session->userdata('assessment_data');

		$assessment_types_id 	= $assessment_data['assessment_types_id'];
		$assessment_tools_id 	= $assessment_data['assessment_tools_id'];
		$assessment_header_id 	= $assessment_data['assessment_header_id'];

		$data['assessment_header_id'] 	= $assessment_header_id;
		$data['assessment_types_id'] 	= $assessment_tools_id;
		$data['assessment_tools_id'] 	= $assessment_tools_id;

		$where 					= ['assessment_types_id' => $assessment_types_id, 'assessment_tools_id' => $assessment_tools_id];
		$data['questions'] 		= $this->common_model->getAll(ASSESSMENT_QUESTIONNAIRES, $where, '', ['q_no', 'q_no']);

		$data['content'] = 'survey/screening/clinical_ultra_sound/ultra_sound_questions';
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);

	}

	public function save_clinical_ultra_sound(){

		$form_data = $this->input->post();
		$is_exists = $this->common_model->getOne(ASSESSMENT_DETAIL, ['assessment_header_id' => $form_data['assessment_header_id']]);

		if (!$is_exists) {
			$key_name;

			$replies_data = [];
			$key_name = key($_FILES);
			$assessment_header_id = $form_data['assessment_header_id'];

			if(isset($_FILES[$key_name]) && !empty($_FILES[$key_name]['name'][0])){
				$file_name = $_FILES[$key_name]['name'][0];
				$file_size =$_FILES[$key_name]['size'][0];
				$file_tmp =$_FILES[$key_name]['tmp_name'][0];
				$file_type=$_FILES[$key_name]['type'][0];
				$fileNameCmps = explode(".", $file_name);
				$fileExtension = strtolower(end($fileNameCmps));

				$patient_id_number = $this->session->userdata('id_number');
				$name = $patient_id_number."_".$form_data['assessment_header_id'];
				

				$temp = explode(".", $file_name);
				$newfilename = $name . '.' . end($temp);

				move_uploaded_file($file_tmp,"assets/images/".$newfilename);

				$replies_data[] = ['assessment_header_id' => $assessment_header_id, 'assement_questionnaires_id' => $key_name, 'assessment_questionnaires_value' => $newfilename, 'file_path' => 1, 'created_by' => $this->session->userdata('id')];
			}

			unset($form_data['assessment_header_id']);
			unset($form_data['assessment_types_id']);
			unset($form_data['assessment_tools_id']);
			foreach ($form_data as $key => $reply) {
				$replies_data[] = ['assessment_header_id' => $assessment_header_id, 'assement_questionnaires_id' => $key, 'assessment_questionnaires_value' => $reply[0], 'file_path' => 0, 'created_by' => $this->session->userdata('id')];
			}
			// pre_d($replies_data);
			$last_insert_id = $this->common_model->insert_batch(ASSESSMENT_DETAIL, $replies_data);

			if ($last_insert_id > 0) {

				
				redirect('ultra_sound_questions1');
			} else {
				die("error!");
			}
		} else {
				redirect('ultra_sound_questions1');

		}

	}

	public function ultra_sound_questions1(){

		$assessment_data 		= $this->session->userdata('assessment_data');
		$assessment_types_id 	= $assessment_data['assessment_types_id'];
		$assessment_tools_id 	= $assessment_data['assessment_tools_id'];
		$assessment_header_id 	= $assessment_data['assessment_header_id'];

		$data['assessment_header_id'] 	= $assessment_header_id;
		$data['assessment_header_data'] = $this->common_model->getOne(ASSESSMENT_HEADER, ['id' => $assessment_header_id]);
		$where 					= ['assessment_types_id' => $assessment_types_id, 'assessment_tools_id' => $assessment_tools_id];
		$data['questions'] 		= $this->common_model->getAll(ASSESSMENT_QUESTIONNAIRES, $where, '', ['q_no', 'q_no']);
		$data['content'] = 'survey/screening/clinical_ultra_sound/ultra_sound_questions1';
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);

	}

	public function save_clinical_ultra_sound1(){
		
		$form_data = $this->input->post();
		$header_details = $this->common_model->getOne(ASSESSMENT_HEADER, ['id' => $form_data['assessment_header_id' ]]);
		$is_exists = $this->common_model->getOne(ASSESSMENT_DETAIL, ['assessment_header_id' => $form_data['assessment_header_id']]);

		if (!$is_exists || $header_details->is_completed == ASSESSMENT_UNCOMPLETED) {
			$replies_data = [];
			$assessment_header_id = $form_data['assessment_header_id'];
			$key_name;

			$key_name = key($_FILES);

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

				$replies_data[] = ['assessment_header_id' => $assessment_header_id, 'assement_questionnaires_id' => $key_name, 'assessment_questionnaires_value' => $this->upload->data('file_name'), 'file_path' => 1, 'created_by' => $this->session->userdata('id')];
				}
			}


			unset($form_data['assessment_header_id']);
			foreach ($form_data as $key => $reply) {
				$replies_data[] = ['assessment_header_id' => $assessment_header_id, 'assement_questionnaires_id' => $key, 'assessment_questionnaires_value' => $reply[0], 'file_path' => 0, 'created_by' => $this->session->userdata('id')];
			}
			$last_insert_id = $this->common_model->insert_batch(ASSESSMENT_DETAIL, $replies_data);

			if ($last_insert_id > 0) {

				$this->common_model->update(ASSESSMENT_HEADER, ['id' => $assessment_header_id], ['is_completed' => 1,'next_assesment_date' => $form_data['next_assesment_date']]);
				$this->update_assessment_counter($assessment_header_id);

				redirect('clinical_ultra_sound_success_full');
			} else {
				die("error!");
			}
		} else {

				redirect('clinical_ultra_sound_success_full');
		}


	}
	public function clinical_ultra_sound_success_full(){
		$data['content'] = 'survey/screening/clinical_ultra_sound/success_full';
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);
	}


	public function mammogram_ultra_sound(){
		$data['content'] = 'survey/screening/mammogram/ultra_sound';
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);

	}

	public function mammogram_questions(){


		$assessment_data 		= $this->session->userdata('assessment_data');

		$assessment_types_id 	= $assessment_data['assessment_types_id'];
		$assessment_tools_id 	= $assessment_data['assessment_tools_id'];
		$assessment_header_id 	= $assessment_data['assessment_header_id'];

		$data['assessment_header_id'] 	= $assessment_header_id;
		$data['assessment_types_id'] 	= $assessment_types_id;
		$data['assessment_tools_id'] 	= $assessment_tools_id;

		$where 					= ['assessment_types_id' => $assessment_types_id, 'assessment_tools_id' => $assessment_tools_id];
		$data['questions'] 		= $this->common_model->getAll(ASSESSMENT_QUESTIONNAIRES, $where, '', ['q_no', 'q_no']);
		$data['content'] = 'survey/screening/mammogram/mammogram_questions';

		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);

	}

	public function save_mammogram_questions(){

		$form_data = $this->input->post();
		$is_exists = $this->common_model->getOne(ASSESSMENT_DETAIL, ['assessment_header_id' => $form_data['assessment_header_id']]);

		if (!$is_exists) {
			$replies_data = [];
			$assessment_header_id = $form_data['assessment_header_id'];
			$assessment_types_id = $form_data['assessment_types_id'];
			$assessment_tools_id = $form_data['assessment_tools_id'];

			unset($form_data['assessment_header_id']);
			unset($form_data['assessment_types_id']);
			unset($form_data['assessment_tools_id']);
			foreach ($form_data as $key => $reply) {
				$replies_data[] = ['assessment_header_id' => $assessment_header_id, 'assement_questionnaires_id' => $key, 'assessment_questionnaires_value' => $reply[0], 'file_path' => 0, 'created_by' => $this->session->userdata('id')];
			}
			// pre_d($replies_data);
			$last_insert_id = $this->common_model->insert_batch(ASSESSMENT_DETAIL, $replies_data);

			if ($last_insert_id > 0) {

					redirect('mammogram_questions1');
			} else {
				die("error!");
			}
		} else {

					redirect('mammogram_questions1');
		}

	}
	public function mammogram_questions1(){
		$user_id = $this->session->userdata('id');
		$assessment_data 		= $this->session->userdata('assessment_data');
		$assessment_types_id 	= $assessment_data['assessment_types_id'];
		$assessment_tools_id 	= $assessment_data['assessment_tools_id'];
		$assessment_header_id 	= $assessment_data['assessment_header_id'];

		$data['currentAge'] = $this->common_model->raw_query("SELECT dob FROM ".USERS." WHERE `id` = {$user_id}");
		$data['assessment_header_id'] 	= $assessment_header_id;
		$data['assessment_header_data'] = $this->common_model->getOne(ASSESSMENT_HEADER, ['id' => $assessment_header_id]);
		$where 					= ['assessment_types_id' => $assessment_types_id, 'assessment_tools_id' => $assessment_tools_id];

		$data['questions'] 		= $this->common_model->getAll(ASSESSMENT_QUESTIONNAIRES, $where, '', ['q_no', 'q_no']);
		$where1 				= ['is_obsolete' => 0];
		$data['associated_features'] 		= $this->common_model->getAll(ASSOCIATED_FEATURES, $where1, '', ['id', 'id'], 'id,associated_feature');
		$data['content'] = 'survey/screening/mammogram/mammogram_questions1';
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);
	}
	
	public function save_mammogram_questions1(){

		$form_data = $this->input->post();
		// pre_d($form_data);
		$header_details = $this->common_model->getOne(ASSESSMENT_HEADER, ['id' => $form_data['assessment_header_id' ]]);
		$is_exists = $this->common_model->getOne(ASSESSMENT_DETAIL, ['assessment_header_id' => $form_data['assessment_header_id' ]]);

		if (!$is_exists || $header_details->is_completed == ASSESSMENT_UNCOMPLETED) {
			$replies_data = [];
			$assessment_header_id = $form_data['assessment_header_id'];

			$key_name;
			$key_name = key($_FILES);
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

				$replies_data[] = ['assessment_header_id' => $assessment_header_id, 'assement_questionnaires_id' => $key_name, 'assessment_questionnaires_value' => $this->upload->data('file_name'), 'file_path' => 1, 'created_by' => $this->session->userdata('id')];
				}
			}



			unset($form_data['assessment_header_id']);
			foreach ($form_data as $key => $reply) {
				if (!empty($reply[0])) {
					
					$replies_data[] = ['assessment_header_id' => $assessment_header_id, 'assement_questionnaires_id' => $key, 'assessment_questionnaires_value' => $reply[0], 'file_path' => 0, 'created_by' => $this->session->userdata('id')];
				}
			}
			// pre_d($replies_data);
			$last_insert_id = $this->common_model->insert_batch(ASSESSMENT_DETAIL, $replies_data);

			if ($last_insert_id > 0) {

				$this->common_model->update(ASSESSMENT_HEADER, ['id' => $assessment_header_id], ['is_completed' => 1,'next_assesment_date' => $form_data['next_assesment_date']]);

				$this->update_assessment_counter($assessment_header_id);

				redirect('mammogram_success_full');
			} else {
				die("error!");
			}
		} else {
				redirect('mammogram_success_full');

		}

	}
	public function mammogram_success_full(){
				$data['content'] = 'survey/screening/mammogram/success_full';
			$data['is_footer'] = false;

		$this->load->view('layout/main', $data);

	}
	public function save_assessment_header($form_data){
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
			$ass_data = [];
			if ($last_insert_id) {
				$ass_data = ['assessment_types_id' => $assessment_data['assessment_type_id'], 'assessment_tools_id' => $assessment_data['assessment_tool_id'], 'assessment_header_id' =>$last_insert_id];

				$current_assessment_header_id = $last_insert_id;
		
				$this->session->set_userdata(['current_assessment_header_id' => $current_assessment_header_id]);
				
			}
			return $ass_data;

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
