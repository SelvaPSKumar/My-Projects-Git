<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Test_results extends MY_Controller {
	function __construct(){
		parent::__construct();
		if(!$this->isLoggedIn()){
			redirect(base_url(''));
		} else {
			$this->load->helper("common_helper");
		}
	}
	public function role_and_access($access_given) {
		if(!in_array($this->session->userdata('rolecode'), $access_given) ) {
			redirect(base_url(''));
		}
	}
	public function view_image($header_id, $image_id) {
		if(!$this->isLoggedIn()){
			return;
		} else {
			if($this->session->userdata('rolecode') == MEDICPRAC) {
				$sql = "SELECT ad.assessment_questionnaires_value FROM ".ASSESSMENT_DETAIL." AS ad WHERE ad.assessment_header_id = ".$header_id." AND ad.assement_questionnaires_id=".$image_id." AND file_path=1 AND ad.is_obsolete = 0";
			} elseif($this->session->userdata('rolecode') == PATIENT) {
				$patient_id = $this->session->userdata('id');
				$sql = "SELECT ad.assessment_questionnaires_value FROM ".ASSESSMENT_DETAIL." AS ad INNER JOIN ".ASSESSMENT_HEADER." AS ah ON ad.assessment_header_id=ah.id WHERE ad.assessment_header_id = ".$header_id." AND ad.assement_questionnaires_id=".$image_id." AND file_path=1 AND ad.is_obsolete = 0 AND ah.patient_id=".$patient_id;
			}
		}
		
		$image_files = $this->common_model->raw_query($sql);
		//echo '<img src="'.get_encrypted_image($image_files[0]['assessment_questionnaires_value']).'"/>';

		$original_file = 'assets/images/'.$image_files[0]['assessment_questionnaires_value'];
		header('Content-Description: File Transfer');
		header('Content-Type: '.mime_content_type($original_file));
		header('Content-Disposition: inline; filename="view_file"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($original_file));
		readfile($original_file);
		die();
	}
	public function index($result){
		$access_given = array(PATIENT);
		$this->role_and_access($access_given);

		if (isset($result) && $result !='') {

			$tests_data = $this->test_results_ajax($result);
			$about_assessment = $this->get_about_assessments_patient($result);
			$data['assessment_header_detail_link'] = $about_assessment['assessment_header_detail_link'];
			$data['new_assessment_link'] = $about_assessment['new_assessment_link'];
			$data['assessment_type'] = $result;
			$data['content'] = 'test_results/' . $result;
			$data['is_footer'] = false;
			$data['active'] = $result;
			// pre($data);
			$data['tests_data'] = $tests_data;
			$this->load->view('layout/main', $data);
			
		}
	}
	public function get_about_assessments_patient($assessment) {
		switch($assessment) {
				case 'general_health':
					$assessment_type_id = 7;
					$assessment_header_detail_link = base_url('general_health_result_details/');
					$new_assessment_link = base_url('general_health/screening');
				break;

				case 'colorectal':
					$assessment_type_id = 1;
					$assessment_header_detail_link = base_url('colorectal_result_details/');
					$new_assessment_link = base_url('colorectal_cancer/screen');
				break;

				case 'lungs':
					$assessment_type_id = 3;
					$assessment_header_detail_link = base_url('lungs_cancer_results/lungs_result_details/');
					$new_assessment_link = base_url('lungs_cancer/screening');
				break;

				case 'breast':
					$assessment_type_id = 2;
					$assessment_header_detail_link = base_url('test_result_details/breast/');
					$new_assessment_link = base_url('screening/screen');
				break;

				case 'cervical':
					$assessment_type_id = 5;
					$assessment_header_detail_link = base_url('cervical_cancer_results/cervical_result_details/');
					$new_assessment_link = base_url('cervical_cancer/screening');
				break;

				case 'healthtools':
					$assessment_type_id = 6;
					$assessment_header_detail_link = base_url('healthtools_result_details/');
					$new_assessment_link = base_url('health_tools/screening');
				break;

				case 'prostate':
					$assessment_type_id = 4;
					$assessment_header_detail_link = base_url('prostate_cancer_results/prostate_result_details/');
					$new_assessment_link = base_url('prostate_cancer/screening');
				break;

				default:
					$assessment_type_id = 0;
					$assessment_header_detail_link = '';
					$new_assessment_link = '';
				break;
			}
			$about_assessment = array(
										'assessment_type_id' => $assessment_type_id,
										'assessment_header_detail_link' => $assessment_header_detail_link,
										'new_assessment_link' => $new_assessment_link,
									);
			return $about_assessment;
	}
	public function get_about_assessments_doctor($assessment) {
		$new_assessment_link ='';
		switch($assessment){
			case 'general_health':
				$assessment_type_id = 7;
				$assessment_header_detail_link = base_url('test_result_details_for_doctor/general_health_for_doctor');
				$new_assessment_link = base_url('general_health/screening');
				$table_head = '
                    <th scope="col">Type of Assessment</th>
                    <th scope="col">Assessment Number</th>
                    <th scope="col">Assessment Date</th>
                    <th scope="col">View</th>';
                $data_table_order_index = 2;
			break;
			case 'breast_cancer':
				$assessment_type_id = 2;
				$assessment_header_detail_link = base_url('test_result_details_for_doctor/breast_for_doctor');
				$new_assessment_link = base_url('screening/screen');
				$table_head = '
					<th scope="col">Patient Name</th>
                    <th scope="col">Patient NRIC/Passport</th>
                    <th scope="col">Type of Assessment</th>
                    <th scope="col">Assessment Number</th>
                    <th scope="col">Cancer Type</th>
                    <th scope="col">Assessment Date</th>
                    <th scope="col">Next Assessment Date</th>
                    <!-- <th scope="col">MP Reviewed</th> -->
                    <th scope="col">View</th>';
                $data_table_order_index = 5;
			break;
			case 'cervical_cancer':
				$assessment_type_id = 5;
				$assessment_header_detail_link = base_url('test_result_details_for_doctor/cervical_for_doctor');
				$new_assessment_link = base_url('cervical_cancer/screening');
				$table_head = '
                    <th scope="col">Type of Assessment</th>
                    <th scope="col">Assessment Number</th>
                    <th scope="col">Assessment Date</th>
                    <th scope="col">View</th>';
                $data_table_order_index = 2;
			break;
			case 'colorectal_cancer':
				$assessment_type_id = 1;
				$assessment_header_detail_link = base_url('test_result_details_for_doctor/colorectal_for_doctor');
				$new_assessment_link = base_url('colorectal_cancer/screen');
				$table_head = '
                    <th scope="col">Type of Assessment</th>
                    <th scope="col">Assessment Number</th>
                    <th scope="col">Assessment Date</th>
                    <th scope="col">View</th>';
                $data_table_order_index = 2;
			break;
			case 'prostate_cancer':
			$assessment_type_id = 4;
				$assessment_header_detail_link = base_url('');
				$new_assessment_link = base_url('');
				$table_head = '
                    <th scope="col">Type of Assessment</th>
                    <th scope="col">Assessment Number</th>
                    <th scope="col">Assessment Date</th>
                    <th scope="col">View</th>';
                $data_table_order_index = 2;
			break;
			case 'lung_cancer':
			$assessment_type_id = 3;
				$assessment_header_detail_link = base_url('test_result_details_for_doctor/lungs_for_doctor');
				$new_assessment_link = base_url('lungs_cancer/screening');
				$table_head = '
                    <th scope="col">Type of Assessment</th>
                    <th scope="col">Assessment Number</th>
                    <th scope="col">Assessment Date</th>
                    <th scope="col">View</th>';
                $data_table_order_index = 2;
			break;
			default:
			redirect(base_url());
			break;
		}
		$about_assessment = array(
							'assessment_type_id' => $assessment_type_id,
							'assessment_header_detail_link' => $assessment_header_detail_link,
							'new_assessment_link' => $new_assessment_link,
							'table_head' => $table_head,
							'data_table_order_index' => $data_table_order_index,
						);
		return $about_assessment;
	}

	public function test_results_ajax($result){
		$access_given = array(PATIENT);
		$this->role_and_access($access_given);

		if (isset($result) && $result !='') {

			$about_assessment = $this->get_about_assessments_patient($result);

			$where = ['assessment_type_id' => $about_assessment['assessment_type_id'], 'patient_id' => $this->session->userdata('id'), 'is_completed' => 1, 'is_obsolete' => 0];
			$assessments_results = $this->common_model->getAll(ASSESSMENT_HEADER, $where, '', ['id', 'desc']);


			
			$ajax_data = array();
			if (!empty($assessments_results)) { 
	           foreach ($assessments_results as $key => $result) { 

	           		$header_id 		= $result->id;
	           		$type_of_assessment		= '<h6 >'.$this->get_assessment_tool_info($result->assessment_tool_id)->assessment_tool_name.'</h6>
	                                  <p>'.$this->get_assessment_sub_type_info($result->assessment_sub_type_id)->assessment_sub_type_name. ' Assessment </p>';
	                $assessment_number 		= $result->assessment_prefix."- ". $result->assessment_number;
	           		$assessment_date 		= date("d-m-Y", strtotime($result->assessment_date))." ". date("h:i:s A", strtotime($result->assessment_time));
	           		$next_assessment_date 	= date("d-m-Y", strtotime($result->next_assesment_date));
	           		$view 					= '<a onclick="gotoresults('.$header_id.');" class="sys_view" >
                                  <ion-icon name="chevron-forward-outline"></ion-icon>
                                </a>
                                <a onclick="gotoresults('.$header_id.');" class="mob_view">Click here</a>';
	           		$ajax_data['data'][] = array(
		           			'id' => $header_id,
		           			'type_of_assessment' => $type_of_assessment,
		           			'assessment_number' => $assessment_number,
		           			'assessment_date' => $assessment_date,
		           			'next_assessment_date' => $next_assessment_date,
		           			'view' => $view,
		           		);

	           	}
	        }
			//$data['assessments_results'] = $assessments_results;
			//echo json_encode($ajax_data);
			return $ajax_data;
		}
			die();

	}

	public function all_assessments($assessment){

		$access_given = array(MEDICPRAC);
		$this->role_and_access($access_given);
		$about_assessment = $this->get_about_assessments_doctor($assessment);
		$data['assessment_header_detail'] = $this->all_assessments_ajax($assessment);
		$data['new_assessment_link'] = $about_assessment['new_assessment_link'];
		$data['assessment_type_id'] = $about_assessment['assessment_type_id'];
		$data['assessment_header_detail_link'] = $about_assessment['assessment_header_detail_link'];
		$data['table_head'] = $about_assessment['table_head'];
		$data['data_table_order_index'] = $about_assessment['data_table_order_index'];
		$data['active'] = $assessment;
		$data['content'] = 'doctor/all_assessments';
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);
			
	}

	public function all_assessments_ajax($assessment) {

		$access_given = array(MEDICPRAC);
		$this->role_and_access($access_given);
		$about_assessment = $this->get_about_assessments_doctor($assessment);

		$where = ['is_completed' => 1];
		
		$facility_details = $this->common_model->getById(FACILITY, $this->session->userdata('facility_id'));

		$sql = "SELECT u.*, up.id_number FROM ".USERS." AS u INNER JOIN ".USERS_PATIENT." AS up ON u.id = up.user_id WHERE u.role_id= 5 and u.is_obsolete =0 AND u.id IN (SELECT DISTINCT(patient_id) FROM assessment_header WHERE is_completed = 1 ";

		if ($this->session->userdata('rolecode') == MEDICPRAC && empty($facility_details->is_superadmin)) {
			$sql .= " AND facility_id = ".$this->session->userdata('facility_id').") ";
		}else{
			$sql .= " ) ";
		}
		/*
		if($patient_id != 0){
			$sql .= " AND u.id = ".$patient_id." ";
		}*/

		
		$data['all_patients'] = $this->common_model->raw_query($sql);
		$patient_ids = '';

		foreach ($data['all_patients'] as $key => $patient) {
			$patient_ids .= $patient['id'].",";
		}
		$patient_ids = rtrim($patient_ids, ',');


		$assessments_results = [];
		if (!empty($patient_ids)) {
			$sql1 = "SELECT * FROM assessment_header WHERE patient_id IN (".$patient_ids.") AND assessment_type_id=".$about_assessment['assessment_type_id']." AND is_completed = 1 AND is_obsolete = 0 ";
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

		$ajax_data = array();
		if (!empty($assessments_results)) { 
           foreach ($assessments_results as $key => $result) {
           		$result = (object) $result; 

           		$header_id 		= $result->id;
           		$patient_name 	= isset($result->patient_data['fname']) ? $result->patient_data['fname'] :'';
           		$nric_passport_number 	= isset($result->patient_data['id_number']) ? $result->patient_data['id_number'] :'';
           		$type_of_assessment		= '<h6 >'.$this->get_assessment_tool_info($result->assessment_tool_id)->assessment_tool_name.'</h6>
                                  <p>'.$this->get_assessment_sub_type_info($result->assessment_sub_type_id)->assessment_sub_type_name. ' Assessment </p>';
                $assessment_number 		= $result->assessment_prefix."- ". $result->assessment_number;
           		$cancer_type = isset($this->get_assessment_type_info($result->assessment_type_id)->assessment_type) ? ucwords(str_replace('_', ' ', $this->get_assessment_type_info($result->assessment_type_id)->assessment_type)) :'';
           		$assessment_date 		= date("d-m-Y", strtotime($result->assessment_date))." ". date("h:i:s A", strtotime($result->assessment_time));
           		$next_assessment_date 	= date("d-m-Y", strtotime($result->next_assesment_date));
           		$view 					= '<a onclick="gotoresults('.$header_id.');" class="sys_view" >
                                  <ion-icon name="chevron-forward-outline"></ion-icon>
                                </a>
                                <a onclick="gotoresults('.$header_id.');" class="mob_view">Click here</a>';

           		$ajax_data['data'][] = array(
	           			'id' => $header_id,
	           			'name' => $patient_name,
	           			'nric_passport' => $nric_passport_number,
	           			'type_of_assessment' => $type_of_assessment,
	           			'assessment_number' => $assessment_number,
	           			'cancer_type' => $cancer_type,
	           			'assessment_date' => $assessment_date,
	           			'next_assessment_date' => $next_assessment_date,
	           			'view' => $view,
	           		);
           	}
        }
		//$data['assessments_results'] = $assessments_results;
		//echo json_encode($ajax_data);
		return $ajax_data;
		die();
	}

	public function test_result_details($page, $header_id) {

		// $header_data = $this->common_model->getOne(ASSESSMENT_HEADER, ['id' => $header_id]);

		// if (!empty($header_data)) {
		// 	$assessment_type_id 		= $header_data->assessment_type_id;
		// 	$assessment_sub_type_id 	= $header_data->assessment_sub_type_id;
		// 	$assessment_tool_id 		= $header_data->assessment_tool_id;

		// 	// $assessment_type_type 		= $this->get_assessment_type_info($assessment_type_id);
		// 	// $assessment_sub_type_type 	= $this->get_assessment_sub_type_info($assessment_sub_type_id);
		// 	// $assessment_tool_type 		= $this->get_assessment_tool_info($assessment_tool_id);
			

		// 	if ($assessment_type_id == 2 && $assessment_tool_id == 5 && $assessment_sub_type_id == 2) {
				
		// 		$data['accociated_features'] = $this->common_model->getAll(ASSOCIATED_FEATURES, ['is_obsolete' => NOT_OBSOLETE]);
		// 		$data['shapes'] = $this->common_model->getAll(BREAST_SHAPE, ['is_obsolete' => NOT_OBSOLETE]);
		// 		$data['edges'] = $this->common_model->getAll(BREAST_EDGES, ['is_obsolete' => NOT_OBSOLETE]);
		// 		$data['consistency'] = $this->common_model->getAll(BREAST_CONSISTENCY, ['is_obsolete' => NOT_OBSOLETE]);
		// 		$data['symptoms'] = $this->common_model->getAll(SYMPTOMS, ['is_obsolete' => NOT_OBSOLETE]);

		// 		// $page = 'clinical';

		// 	}
		// }

		$access_given = array(PATIENT);
		$this->role_and_access($access_given);
		$CI = & get_instance();

		$data['accociated_features'] = $this->common_model->getAll(ASSOCIATED_FEATURES, ['is_obsolete' => NOT_OBSOLETE]);
		$data['shapes'] = $this->common_model->getAll(BREAST_SHAPE, ['is_obsolete' => NOT_OBSOLETE]);
		$data['edges'] = $this->common_model->getAll(BREAST_EDGES, ['is_obsolete' => NOT_OBSOLETE]);
		$data['consistency'] = $this->common_model->getAll(BREAST_CONSISTENCY, ['is_obsolete' => NOT_OBSOLETE]);
		$data['symptoms'] = $this->common_model->getAll(SYMPTOMS, ['is_obsolete' => NOT_OBSOLETE]);

		$sql1 = "SELECT * FROM assessment_header WHERE id = ". $header_id. " AND patient_id = ".$CI->session->userdata('id'). " AND is_completed = 1";
		$header_data = $this->common_model->raw_query($sql1);
		if(!isset($header_data) || empty($header_data) || count($header_data)<1){
			redirect(base_url(''));
		}
		$sql = "SELECT ad.assement_questionnaires_id, ad.assessment_questionnaires_value, ad.file_path, aq.q_no, aq.q_identifier, aq.questionnaire FROM assessment_detail as ad INNER JOIN m_assessment_questionnaires AS aq 
					ON ad.assement_questionnaires_id = aq.id
					WHERE ad.assessment_header_id = ".$header_id." AND ad.is_obsolete = 0 ORDER BY aq.q_no";

		$header_detail = $this->common_model->raw_query($sql);
		// $sql2 = "Select right_breast_1,right_breast_2,right_breast_3,right_breast_4,right_breast_5,right_breast_6,right_breast_7,right_breast_8,right_breast_9,right_breast_10,right_breast_11,right_breast_12,right_breast_13,right_breast_14,right_breast_15,right_breast_16,left_breast_1,left_breast_2,left_breast_3,left_breast_4,left_breast_5,left_breast_6,left_breast_7,left_breast_8,left_breast_9,left_breast_10,left_breast_11,left_breast_12,left_breast_13,left_breast_14,left_breast_15,left_breast_16 from ibreast_test_findings where assessment_header_id = ". $header_id;
		// $ibreast_test_findings = $this->common_model->raw_query($sql2);
		$ibreast_test_findings = $this->common_model->getOne(IBREAST_TEST_FINDINGS, ['assessment_header_id' => $header_id]);

		unset($ibreast_test_findings->id);
		unset($ibreast_test_findings->assessment_header_id);
		unset($ibreast_test_findings->assessment_detail_id);
		unset($ibreast_test_findings->is_obsolete);
		unset($ibreast_test_findings->created_by);
		unset($ibreast_test_findings->created_date);
		unset($ibreast_test_findings->updated_by);
		unset($ibreast_test_findings->updated_date);

		$data['content'] = 'test_results/test_result_details/' . $page;
		$data['is_footer'] = false;
		// echo $sql;
		// pre_d($header_detail);
		$data['ibreast_test_findings'] = $ibreast_test_findings;
		$data['header_detail'] = $header_detail;
		$data['header_data'] = $header_data;
		// pre_d($data);
		$this->load->view('layout/main', $data);


	}
	public function get_page_test_result_details_for_doctor($page, $header_id) {
		$access_given = array(MEDICPRAC);
		$this->role_and_access($access_given);
		switch($page) {
			case 'general_health_for_doctor':
				$this->get_general_health_for_doctor($page,$header_id);
			break;
			case 'breast_for_doctor':
				$this->get_breast_for_doctor($page,$header_id);
			break;
			case 'colorectal_for_doctor':
				$this->get_colorectal_for_doctor($page,$header_id);
			break;
			case 'lungs_for_doctor':
				$this->get_lungs_for_doctor($page, $header_id);
			break;
			case 'cervical_for_doctor':
				$this->get_cervical_for_doctor($page, $header_id);
			break;
			default:
				redirect(base_url(''));
			break;
		}
	}
	public function get_general_health_for_doctor($page, $header_id) {
		$access_given = array(MEDICPRAC);
		$this->role_and_access($access_given);
		$sql1 = "Select * from assessment_header where id = ". $header_id;
		$header_data = $this->common_model->raw_query($sql1);
		$sql = "SELECT ad.assement_questionnaires_id, ad.assessment_questionnaires_value, ad.file_path, aq.* FROM assessment_detail as ad INNER JOIN m_assessment_questionnaires as aq 
					ON ad.assement_questionnaires_id = aq.id
					WHERE ad.assessment_header_id = ".$header_id." AND ad.is_obsolete = 0 order by aq.q_no";
		$header_detail = $this->common_model->raw_query($sql);
		$assessment_type = $this->common_model->raw_query("SELECT assessment_type FROM m_assessment_types LEFT JOIN assessment_header ON m_assessment_types.assessment_type_id = assessment_header.assessment_type_id WHERE assessment_header.id = ".$header_id . " AND assessment_header.assessment_type_id=7");
		if(count($assessment_type)==0) {
			redirect(base_url(''));
		}
		$comments_sql = "SELECT u.*, dc.id, dc.comments, dc.created_date FROM assessment_doctor_comment as dc INNER JOIN m_users as u ON dc.created_by = u.id
WHERE assessment_header_id = ".$header_id." AND is_obsoleted = 0 ORDER BY dc.id DESC";
		$comments = $this->common_model->raw_query($comments_sql);

		$patient = $this->common_model->raw_query("SELECT u.*, up.id_number, up.patient_referral_id FROM ".USERS." AS u INNER JOIN ".USERS_PATIENT." AS up ON u.id = up.user_id WHERE u.id  = ".$header_data[0]['patient_id']." AND u.is_obsolete = 0 ");

		$data['patient_data'] = $patient;
		// $data['doctor_info'] = $this->session->userdata;
		$data['content'] = 'test_results/general_health_result_details/' . $page;
		$data['is_footer'] = true;
		$data['header_detail'] = $header_detail;
		$data['header_data'] = $header_data;
		$data['assessment_type'] = $assessment_type;
		$data['comments'] = $comments;
		
		// pre_d($data);
		$this->load->view('layout/main', $data);

	}
	public function get_colorectal_for_doctor($page, $header_id) {
		$access_given = array(MEDICPRAC);
		$this->role_and_access($access_given);
		$sql1 = "Select * from assessment_header where id = ". $header_id;
		$header_data = $this->common_model->raw_query($sql1);
		$sql = "SELECT ad.assement_questionnaires_id, ad.assessment_questionnaires_value, ad.file_path, aq.* FROM assessment_detail as ad INNER JOIN m_assessment_questionnaires as aq 
					ON ad.assement_questionnaires_id = aq.id
					WHERE ad.assessment_header_id = ".$header_id." AND ad.is_obsolete = 0 order by aq.q_no";
		$header_detail = $this->common_model->raw_query($sql);
		$assessment_type = $this->common_model->raw_query("SELECT assessment_type FROM m_assessment_types LEFT JOIN assessment_header ON m_assessment_types.assessment_type_id = assessment_header.assessment_type_id WHERE assessment_header.id = ".$header_id . " AND assessment_header.assessment_type_id=1");
		if(count($assessment_type)==0) {
			redirect(base_url(''));
		}
		$comments_sql = "SELECT u.*, dc.id, dc.comments, dc.created_date FROM assessment_doctor_comment as dc INNER JOIN m_users as u ON dc.created_by = u.id
WHERE assessment_header_id = ".$header_id." AND is_obsoleted = 0 ORDER BY dc.id DESC";
		$comments = $this->common_model->raw_query($comments_sql);

		$patient = $this->common_model->raw_query("SELECT u.*, up.id_number, up.patient_referral_id FROM ".USERS." AS u INNER JOIN ".USERS_PATIENT." AS up ON u.id = up.user_id WHERE u.id  = ".$header_data[0]['patient_id']." AND u.is_obsolete = 0 ");

		$data['patient_data'] = $patient;
		// $data['doctor_info'] = $this->session->userdata;
		$data['content'] = 'test_results/colorectal_result_details/' . $page;
		$data['is_footer'] = true;
		$data['header_detail'] = $header_detail;
		$data['header_data'] = $header_data;
		$data['assessment_type'] = $assessment_type;
		$data['comments'] = $comments;
		
		// pre_d($data);
		$this->load->view('layout/main', $data);

	}
	public function get_lungs_for_doctor($page, $header_id) {
		$access_given = array(MEDICPRAC);
		$this->role_and_access($access_given);
		$sql1 = "Select * from assessment_header where id = ". $header_id;
		$header_data = $this->common_model->raw_query($sql1);
		$sql = "SELECT ad.assement_questionnaires_id, ad.assessment_questionnaires_value, ad.file_path, aq.* FROM assessment_detail as ad INNER JOIN m_assessment_questionnaires as aq 
					ON ad.assement_questionnaires_id = aq.id
					WHERE ad.assessment_header_id = ".$header_id." AND ad.is_obsolete = 0 order by aq.q_no";
		$header_detail = $this->common_model->raw_query($sql);
		$assessment_type = $this->common_model->raw_query("SELECT assessment_type FROM m_assessment_types LEFT JOIN assessment_header ON m_assessment_types.assessment_type_id = assessment_header.assessment_type_id WHERE assessment_header.id = ".$header_id . " AND assessment_header.assessment_type_id=3");
		if(count($assessment_type)==0) {
			redirect(base_url(''));
		}
		$comments_sql = "SELECT u.*, dc.id, dc.comments, dc.created_date FROM assessment_doctor_comment as dc INNER JOIN m_users as u ON dc.created_by = u.id
WHERE assessment_header_id = ".$header_id." AND is_obsoleted = 0 ORDER BY dc.id DESC";
		$comments = $this->common_model->raw_query($comments_sql);

		$patient = $this->common_model->raw_query("SELECT u.*, up.id_number, up.patient_referral_id FROM ".USERS." AS u INNER JOIN ".USERS_PATIENT." AS up ON u.id = up.user_id WHERE u.id  = ".$header_data[0]['patient_id']." AND u.is_obsolete = 0 ");

		$patient_id = $patient[0]['id'];
			$chart_question_row = $this->common_model->getOne(ASSESSMENT_QUESTIONNAIRES, ['assessment_types_id' => 3, 'assessment_tools_id' => 11, 'q_identifier' => 'LUN_SMO_5', 'is_obsolete' => 0]);
			$chart_question_id = $chart_question_row->id ? $chart_question_row->id : 0;
			$sub_prev_sql = "SELECT ad.*, DATE_FORMAT(ah.assessment_date,'%M-%y') AS assessment_date FROM assessment_detail  AS ad LEFT JOIN assessment_header AS ah ON ad.assessment_header_id = ah.id WHERE ad.assement_questionnaires_id = ".$chart_question_id." AND ah.assessment_type_id = 3 AND 
						ah.assessment_tool_id = 11 AND 
						ah.patient_id = ".$patient_id." AND
						is_completed = 1 AND ah.is_obsolete = 0
						ORDER BY id ASC";
			$sub_prev = $this->common_model->raw_query($sub_prev_sql);
			if(isset($sub_prev)) {
				foreach ($sub_prev as $key => $value) {
					$values['labels'][] = $value['assessment_date'];
					$values['values'][] = $value['assessment_questionnaires_value'];
				}
			}

		$data['patient_data'] = $patient;


		$adult_or_adolescent = null;
		$dob = $patient['dob'];
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

		$data['values'] = $values;
		// $data['doctor_info'] = $this->session->userdata;
		$data['content'] = 'test_results/lungs_result_details/' . $page;
		$data['is_footer'] = true;
		$data['header_detail'] = $header_detail;
		$data['header_data'] = $header_data;
		$data['assessment_type'] = $assessment_type;
		$data['comments'] = $comments;
		
		// pre_d($data);
		$this->load->view('layout/main', $data);

	}
	public function get_cervical_for_doctor($page, $header_id) {
		$access_given = array(MEDICPRAC);
		$this->role_and_access($access_given);
		$sql1 = "Select * from assessment_header where id = ". $header_id;
		$header_data = $this->common_model->raw_query($sql1);
		$sql = "SELECT ad.assement_questionnaires_id, ad.assessment_questionnaires_value, ad.file_path, aq.* FROM assessment_detail as ad INNER JOIN m_assessment_questionnaires as aq 
					ON ad.assement_questionnaires_id = aq.id
					WHERE ad.assessment_header_id = ".$header_id." AND ad.is_obsolete = 0 order by aq.q_no";
		$header_detail = $this->common_model->raw_query($sql);
		$assessment_type = $this->common_model->raw_query("SELECT assessment_type FROM m_assessment_types LEFT JOIN assessment_header ON m_assessment_types.assessment_type_id = assessment_header.assessment_type_id WHERE assessment_header.id = ".$header_id . " AND assessment_header.assessment_type_id=5");
		if(count($assessment_type)==0) {
			redirect(base_url(''));
		}
		$comments_sql = "SELECT u.*, dc.id, dc.comments, dc.created_date FROM assessment_doctor_comment as dc INNER JOIN m_users as u ON dc.created_by = u.id
WHERE assessment_header_id = ".$header_id." AND is_obsoleted = 0 ORDER BY dc.id DESC";
		$comments = $this->common_model->raw_query($comments_sql);

		$patient = $this->common_model->raw_query("SELECT u.*, up.id_number, up.patient_referral_id FROM ".USERS." AS u INNER JOIN ".USERS_PATIENT." AS up ON u.id = up.user_id WHERE u.id  = ".$header_data[0]['patient_id']." AND u.is_obsolete = 0 ");

		$data['patient_data'] = $patient;
		$data['values'] = $values;
		// $data['doctor_info'] = $this->session->userdata;
		$data['content'] = 'test_results/cervical_result_details/' . $page;
		$data['is_footer'] = true;
		$data['header_detail'] = $header_detail;
		$data['header_data'] = $header_data;
		$data['assessment_type'] = $assessment_type;
		$data['comments'] = $comments;
		
		// pre_d($data);
		$this->load->view('layout/main', $data);

	}
	
	public function get_breast_for_doctor($page, $header_id) {
		$access_given = array(MEDICPRAC);
		$this->role_and_access($access_given);
		$data['accociated_features'] = $this->common_model->getAll(ASSOCIATED_FEATURES, ['is_obsolete' => NOT_OBSOLETE]);
		$data['shapes'] = $this->common_model->getAll(BREAST_SHAPE, ['is_obsolete' => NOT_OBSOLETE]);
		$data['edges'] = $this->common_model->getAll(BREAST_EDGES, ['is_obsolete' => NOT_OBSOLETE]);
		$data['consistency'] = $this->common_model->getAll(BREAST_CONSISTENCY, ['is_obsolete' => NOT_OBSOLETE]);
		$data['symptoms'] = $this->common_model->getAll(SYMPTOMS, ['is_obsolete' => NOT_OBSOLETE]);

		$sql1 = "SELECT * FROM assessment_header WHERE id = ". $header_id;
		$header_data = $this->common_model->raw_query($sql1);
		$sql = "SELECT ad.assement_questionnaires_id, ad.assessment_questionnaires_value, ad.file_path, aq.q_no, aq.q_identifier, aq.questionnaire FROM assessment_detail as ad Inner Join m_assessment_questionnaires as aq 
					ON ad.assement_questionnaires_id = aq.id
					WHERE ad.assessment_header_id = ".$header_id." AND ad.is_obsolete = 0 ORDER BY aq.q_no";

		$header_detail = $this->common_model->raw_query($sql);
		// $sql2 = "Select right_breast_1,right_breast_2,right_breast_3,right_breast_4,right_breast_5,right_breast_6,right_breast_7,right_breast_8,right_breast_9,right_breast_10,right_breast_11,right_breast_12,right_breast_13,right_breast_14,right_breast_15,right_breast_16,left_breast_1,left_breast_2,left_breast_3,left_breast_4,left_breast_5,left_breast_6,left_breast_7,left_breast_8,left_breast_9,left_breast_10,left_breast_11,left_breast_12,left_breast_13,left_breast_14,left_breast_15,left_breast_16 from ibreast_test_findings where assessment_header_id = ". $header_id;
		// $ibreast_test_findings = $this->common_model->raw_query($sql2);
		$assessment_type = $this->common_model->raw_query("SELECT assessment_type FROM m_assessment_types LEFT JOIN assessment_header ON m_assessment_types.assessment_type_id = assessment_header.assessment_type_id WHERE assessment_header.id = ".$header_id. " AND assessment_header.assessment_type_id=2");
		if(count($assessment_type)==0) {
			redirect(base_url(''));
		}
		$ibreast_test_findings = $this->common_model->getOne(IBREAST_TEST_FINDINGS, ['assessment_header_id' => $header_id]);
		unset($ibreast_test_findings->id);
		unset($ibreast_test_findings->assessment_header_id);
		unset($ibreast_test_findings->assessment_detail_id);
		unset($ibreast_test_findings->is_obsolete);
		unset($ibreast_test_findings->created_by);
		unset($ibreast_test_findings->created_date);
		unset($ibreast_test_findings->updated_by);
		unset($ibreast_test_findings->updated_date);

		$comments_sql = "select u.*, dc.id, dc.comments, dc.created_date, dc.comment_author from assessment_doctor_comment as dc Inner Join m_users as u ON dc.created_by = u.id
where assessment_header_id = ".$header_id." and is_obsoleted = 0 order by dc.id desc";
		$comments = $this->common_model->raw_query($comments_sql);

		$patient = $this->common_model->raw_query("SELECT u.*, up.id_number, up.patient_referral_id FROM ".USERS." AS u INNER JOIN ".USERS_PATIENT." AS up ON u.id = up.user_id WHERE u.id  = ".$header_data[0]['patient_id']." AND u.is_obsolete = 0 ");

		$comments_user = "select * from m_users where id = " . $this->session->userdata('id');
		$user_result = $this->common_model->raw_query($comments_user);

		$data['comments_user'] = $user_result;
		$data['patient_data'] = $patient;
		// $data['doctor_info'] = $this->session->userdata;
		$data['content'] = 'test_results/test_result_details/' . $page;
		$data['is_footer'] = true;
		// echo $sql;
		// pre_d($header_detail);
		$data['ibreast_test_findings'] = $ibreast_test_findings;
		$data['header_detail'] = $header_detail;
		$data['header_data'] = $header_data;
		$data['assessment_type'] = $assessment_type;
		$data['comments'] = $comments;
		
		// pre_d($data);
		$this->load->view('layout/main', $data);


	}
	public function test_result_details_for_doctor($page, $header_id) {
		$access_given = array(MEDICPRAC);
		$this->role_and_access($access_given);
		$this->get_page_test_result_details_for_doctor($page, $header_id);
	}
}
