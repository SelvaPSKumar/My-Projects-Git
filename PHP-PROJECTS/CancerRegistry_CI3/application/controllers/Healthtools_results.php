<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Healthtools_results extends MY_Controller {
	function __construct(){
		parent::__construct();
		if(!$this->isLoggedIn()){
			redirect(base_url(''));
		}
	}
	public function index(){
	
	}
	public function role_and_access($access_given) {
		$CI = & get_instance();
		if(!in_array($CI->session->userdata('rolecode'), $access_given) ) {
			redirect(base_url(''));
		}
	}

	public function healthtools_result_details( $header_id) {
		$access_given = array(PATIENT);
		$this->role_and_access($access_given);
		$CI = & get_instance();
		
		$sql1 = "SELECT * FROM assessment_header WHERE id = ". $header_id. " AND assessment_type_id=6 AND patient_id = ".$CI->session->userdata('id'). " AND is_completed = 1";
		$header_data = $this->common_model->raw_query($sql1);
		if(!isset($header_data) || empty($header_data) || count($header_data)<1){
			redirect(base_url(''));
		}
		$sql = "Select ad.assement_questionnaires_id, ad.assement_questionnaires_column_id, ad.assessment_questionnaires_value, ad.file_path, aq.q_no, aq.q_identifier, aq.questionnaire, aq.group, aq.assessment_types_id, aq.assessment_tools_id from assessment_detail as ad Inner Join m_assessment_questionnaires as aq 
					ON ad.assement_questionnaires_id = aq.id
					where ad.assessment_header_id = ".$header_id." and ad.is_obsolete = 0 order by aq.q_no,assement_questionnaires_id,assement_questionnaires_column_id";

		$header_detail = $this->common_model->raw_query($sql);
		//calculating score
		$total_score =0;
		$assessment_tool_id = null;
		foreach	($header_detail	as $key => $ans){
			$ans_json=json_decode($ans['assessment_questionnaires_value']);
			if(is_object($ans_json)) {
                foreach($ans_json as $label => $value){
                	$total_score = $total_score + $value;
                }
            } else {
               if($ans['assessment_types_id']==6 && $ans['assessment_tools_id']==26){
               		$total_score = $total_score + $ans['assessment_questionnaires_value'];
               }
            }
                $assessment_tool_id = $ans['assessment_tools_id'];
		}
		if( $assessment_tool_id == 26 ) {
			$total_score = ($total_score/72) * 50;
		} elseif( $assessment_tool_id == 27 ) {
			$total_score = ($total_score/36) * 100;
		} else {}
		$total_score = number_format((float)$total_score, 2, '.', '');
		$sql = "Select q.id, q.questionnaire, q.questionnaire_title,q.group from m_assessment_questionnaires as q where q.assessment_tools_id=".$header_data[0]['assessment_tool_id'];
		$questions = $this->common_model->raw_query($sql);
		foreach($questions as $key => $value){
			$header_questions[$value['id']] = $value['questionnaire'];
			if( !empty($value['questionnaire_title']) ) {
				if(isset($value['questionnaire_title'])) {
				$header_table_title[$value['group']] = $value['questionnaire_title'];
				}
			}
		}
		if(!isset($header_table_title)){
			$header_table_title = '';
		}
		$data['content'] = 'test_results/healthtools_result_details/healthtools';
		$data['is_footer'] = false;
		$data['header_questions'] = $header_questions;
		$data['header_table_title'] = $header_table_title;
		$data['header_detail'] = $header_detail;
		$data['header_total_score'] = $total_score;
		$data['header_data'] = $header_data;
		// pre_d($data);
		$this->load->view('layout/main', $data);

	}

	public function healthtool_result_details_for_doctor($header_id) {


		$sql1 = "Select * from assessment_header where id = ". $header_id;
		$header_data = $this->common_model->raw_query($sql1);
		$sql = "Select ad.assement_questionnaires_id, ad.assement_questionnaires_column_id, ad.assessment_questionnaires_value, ad.file_path, aq.q_no, aq.q_identifier, aq.questionnaire, aq.group 		from assessment_detail as ad Inner Join m_assessment_questionnaires as aq 
					ON ad.assement_questionnaires_id = aq.id
					where ad.assessment_header_id = ".$header_id." and ad.is_obsolete = 0 order by aq.q_no";

		$header_detail = $this->common_model->raw_query($sql);
		$sql = "Select q.id, q.questionnaire, q.questionnaire_title,q.group from m_assessment_questionnaires as q where q.assessment_tools_id=".$header_data[0]['assessment_tool_id'];
		$questions = $this->common_model->raw_query($sql);
		foreach($questions as $key => $value){
			$header_questions[$value['id']] = $value['questionnaire'];
			if( !empty($value['questionnaire_title']) ) {
				if(isset($value['questionnaire_title'])) {
				$header_table_title[$value['group']] = $value['questionnaire_title'];
				}
			}
		}
		if(!isset($header_table_title)){
			$header_table_title = '';
		}
		$comments_sql = "select u.*, dc.id, dc.comments, dc.created_date, dc.comment_author from assessment_doctor_comment as dc Inner Join m_users as u ON dc.created_by = u.id
		where assessment_header_id = ".$header_id." and is_obsoleted = 0 order by dc.id desc";
		$comments = $this->common_model->raw_query($comments_sql);
		
		$comments_user = "select * from m_users where id = " . $this->session->userdata('id');
		$user_result = $this->common_model->raw_query($comments_user);

		$patient = $this->common_model->raw_query("SELECT u.*, up.id_number, up.patient_referral_id FROM ".USERS." AS u INNER JOIN ".USERS_PATIENT." AS up ON u.id = up.user_id WHERE u.id  = ".$header_data[0]['patient_id']." AND u.is_obsolete = 0 ");

		$data['comments_user'] = $user_result;
		$data['patient_data'] = $patient;
		$data['content'] = 'test_results/healthtools_result_details/healthtools_for_doctor';
		$data['is_footer'] = false;
		$data['header_questions'] = $header_questions;
		$data['header_table_title'] = $header_table_title;
		$data['header_detail'] = $header_detail;
		$data['header_data'] = $header_data;
		$data['comments'] = $comments;
		// pre_d($data);
		$this->load->view('layout/main', $data);
	}
}
