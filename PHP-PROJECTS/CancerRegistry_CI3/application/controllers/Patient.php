<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends MY_Controller {

	public function dashboard()
	{
		$data['content'] = 'patient/dashboard';
		$data['assessments_completed'] = $this->db->where(['patient_id'=> $this->session->userdata('id'), 'is_completed' => 1])->from(ASSESSMENT_HEADER)->count_all_results();
		$data['is_footer'] = false;
		$data['active'] = 'dashboard';
		$data['next_assesment_dates'] = array();
		$user_id = $this->session->userdata('id');
		$data['breast_self_ass'] = $this->common_model->raw_query("SELECT * FROM `assessment_header` WHERE `patient_id` = {$user_id} AND `assessment_type_id` = 2 AND `assessment_sub_type_id` = 1 AND `assessment_tool_id` = 1 AND `is_completed` = 1 ORDER BY id DESC LIMIT 0,1");
		if(!empty($data['breast_self_ass'])){
			$data['breast_self_ass'] = array_merge(...$data['breast_self_ass']);
			$data['next_assesment_dates']['breast_self_ass'] = $data['breast_self_ass']['next_assesment_date'];
		}
		//all cancer related data stored here
		$data['cancer_list'] = array(
					'breast_cancer' => array(
								'title'=>'Breast Cancer',
								'link' => base_url('screening/screen'),
								'img_src' => base_url('assets/img/dashboard/breast_cancer.png'),
								'type'=>2,
								),
					'colorectal_cancer' => array(
								'title'=>'Colorectal Cancer',
								'link'=>base_url('colorectal_cancer/screen'),
								'img_src' => base_url('assets/img/dashboard/colorectal_cancer.png'),
								'type'=>3,
								),
					'lung_cancer' => array(
								'title'=>'Lung Cancer',
								'link'=>base_url('lungs_cancer/screen'),
								'img_src' => base_url('assets/img/dashboard/lung_cancer.png'),
								'type'=>3,
								),
					'cervical_cancer' => array(
								'title'=>'Cervical Cancer',
								'link'=>base_url('cervical_cancer/screen'),
								'img_src' => base_url('assets/img/dashboard/cervical_cancer.png'),
								'type'=>2,
								),
					'prostate_cancer' => array(
								'title'=>'Prostate  Cancer',
								'link'=>base_url('prostate_cancer/screen'),
								'img_src' => base_url('assets/img/dashboard/prostate_cancer.png'),
								'type'=>1,
								),
		);

		//seperating and storing assessment data
		$data['male_assessment']=null;
		$data['female_assessment']=null;
		$data['common_assessment']=null;

		if(count($data['breast_self_ass'])>0){
			$data['female_assessment']['breast_cancer']['breast_self_ass']=$data['breast_self_ass'];
			$data['female_assessment']['breast_cancer']['breast_self_ass']['title_text']='Symptom Assessment (SYP)';
			$data['female_assessment']['breast_cancer']['breast_self_ass']['img_src']='assets/img/dashboard/syp_image.png';
			$data['female_assessment']['breast_cancer']['breast_self_ass']['assessment_link']='assets/img/dashboard/syp_image.png';
		}

		$data['breast_risk_ass'] = $this->common_model->raw_query("SELECT * FROM `assessment_header` WHERE `patient_id` = {$user_id} AND `assessment_type_id` = 2 AND `assessment_sub_type_id` = 1 AND `assessment_tool_id` = 2 AND `is_completed` = 1 ORDER BY id DESC LIMIT 0,1");
		if(!empty($data['breast_risk_ass'])){
			$data['breast_risk_ass'] = array_merge(...$data['breast_risk_ass']);
			$data['next_assesment_dates']['breast_risk_ass'] = $data['breast_risk_ass']['next_assesment_date'];
		}
		if(count($data['breast_risk_ass'])>0) {
			$data['female_assessment']['breast_cancer']['breast_risk_ass']=$data['breast_risk_ass'];
			$data['female_assessment']['breast_cancer']['breast_risk_ass']['title_text']='Risk Assessment (RSK)';
			$data['female_assessment']['breast_cancer']['breast_risk_ass']['img_src']='assets/img/dashboard/rsk_image.png';
			$data['female_assessment']['breast_cancer']['breast_risk_ass']['assessment_link']='assets/img/dashboard/rsk_image.png';
		}

		$data['breast_clinical_ass'] = $this->common_model->raw_query("SELECT * FROM `assessment_header` WHERE `patient_id` = {$user_id} AND `assessment_type_id` = 2 AND `assessment_sub_type_id` = 2 AND `assessment_tool_id` = 5 AND `is_completed` = 1 ORDER BY id DESC LIMIT 0,1");
		if(!empty($data['breast_clinical_ass'])){
			$data['breast_clinical_ass'] = array_merge(...$data['breast_clinical_ass']);
			$data['next_assesment_dates']['breast_clinical_ass'] = $data['breast_clinical_ass']['next_assesment_date'];
		}
		if(count($data['breast_clinical_ass'])>0){
			$data['female_assessment']['breast_cancer']['breast_clinical_ass']=$data['breast_clinical_ass'];
			$data['female_assessment']['breast_cancer']['breast_clinical_ass']['title_text']='Clinical Breast Examination (CBE)';
			$data['female_assessment']['breast_cancer']['breast_clinical_ass']['img_src']='assets/img/dashboard/cbe_image.png';
			$data['female_assessment']['breast_cancer']['breast_clinical_ass']['assessment_link']='assets/img/dashboard/cbe_image.png';		
		}
	
		
		$data['ibreast'] = $this->common_model->raw_query("SELECT * FROM `assessment_header` WHERE `patient_id` = {$user_id} AND `assessment_type_id` = 2 AND `assessment_sub_type_id` = 2 AND `assessment_tool_id` = 6 AND `is_completed` = 1 ORDER BY id DESC LIMIT 0,1");
		if(!empty($data['ibreast'])){
			$data['ibreast'] = array_merge(...$data['ibreast']);
			$data['next_assesment_dates']['ibreast'] = $data['ibreast']['next_assesment_date'];
		}
		if(count($data['ibreast'])>0) {
		$data['female_assessment']['breast_cancer']['ibreast']=$data['ibreast'];
		$data['female_assessment']['breast_cancer']['ibreast']['title_text']='iBREAST';
		$data['female_assessment']['breast_cancer']['ibreast']['img_src']='assets/img/dashboard/ibreast.png';
		$data['female_assessment']['breast_cancer']['ibreast']['assessment_link']='assets/img/dashboard/ibreast.png';
		}

		$data['care_ultrasound'] = $this->common_model->raw_query("SELECT * FROM `assessment_header` WHERE `patient_id` = {$user_id} AND `assessment_type_id` = 2 AND `assessment_sub_type_id` = 2 AND `assessment_tool_id` = 7 AND `is_completed` = 1 ORDER BY id DESC LIMIT 0,1");
		if(!empty($data['care_ultrasound'])){
			$data['care_ultrasound'] = array_merge(...$data['care_ultrasound']);
			$data['next_assesment_dates']['care_ultrasound'] = $data['care_ultrasound']['next_assesment_date'];
		}
		if(count($data['care_ultrasound'])>0) {
		$data['female_assessment']['breast_cancer']['care_ultrasound']=$data['care_ultrasound'];
		$data['female_assessment']['breast_cancer']['care_ultrasound']['title_text']='Point of Care Ultrasound';
		$data['female_assessment']['breast_cancer']['care_ultrasound']['img_src']='assets/img/dashboard/care_ultrasound.png';
		$data['female_assessment']['breast_cancer']['care_ultrasound']['assessment_link']='assets/img/dashboard/care_ultrasound.png';
		}

		$data['clinical_ultrasound'] = $this->common_model->raw_query("SELECT * FROM `assessment_header` WHERE `patient_id` = {$user_id} AND `assessment_type_id` = 2 AND `assessment_sub_type_id` = 2 AND `assessment_tool_id` = 8 AND `is_completed` = 1 ORDER BY id DESC LIMIT 0,1");
		if(!empty($data['clinical_ultrasound'])){
			$data['clinical_ultrasound'] = array_merge(...$data['clinical_ultrasound']);
			$data['next_assesment_dates']['clinical_ultrasound'] = $data['clinical_ultrasound']['next_assesment_date'];
		}
		if(count($data['clinical_ultrasound'])>0) {
		$data['female_assessment']['breast_cancer']['clinical_ultrasound']=$data['clinical_ultrasound'];
		$data['female_assessment']['breast_cancer']['clinical_ultrasound']['title_text']='Clinical Ultrasound';
		$data['female_assessment']['breast_cancer']['clinical_ultrasound']['img_src']='assets/img/dashboard/clinical_ultrasound.png';
		$data['female_assessment']['breast_cancer']['clinical_ultrasound']['assessment_link']='assets/img/dashboard/clinical_ultrasound.png';
		}

		$data['mammogram'] = $this->common_model->raw_query("SELECT * FROM `assessment_header` WHERE `patient_id` = {$user_id} AND `assessment_type_id` = 2 AND `assessment_sub_type_id` = 2 AND `assessment_tool_id` = 9 AND `is_completed` = 1 ORDER BY id DESC LIMIT 0,1");
		if(!empty($data['mammogram'])){
			$data['mammogram'] = array_merge(...$data['mammogram']);
			$data['next_assesment_dates']['mammogram'] = $data['mammogram']['next_assesment_date'];
		}
		if(count($data['mammogram'])>0) {
		$data['female_assessment']['breast_cancer']['mammogram']=$data['mammogram'];
		$data['female_assessment']['breast_cancer']['mammogram']['title_text']='Mammogram';
		$data['female_assessment']['breast_cancer']['mammogram']['img_src']='assets/img/dashboard/mammogram.png';
		$data['female_assessment']['breast_cancer']['mammogram']['assessment_link']='assets/img/dashboard/mammogram.png';
		}

		$data['colonoscopy'] = $this->common_model->raw_query("SELECT * FROM `assessment_header` WHERE `patient_id` = {$user_id} AND `assessment_type_id` = 1 AND `assessment_sub_type_id` = 2 AND `assessment_tool_id` = 3 AND `is_completed` = 1 ORDER BY id DESC LIMIT 0,1");
		if(!empty($data['colonoscopy'])){
			$data['colonoscopy'] = array_merge(...$data['colonoscopy']);
			$data['next_assesment_dates']['colonoscopy'] = $data['colonoscopy']['next_assesment_date'];
		}
		if(count($data['colonoscopy'])>0) {
		$data['common_assessment']['colorectal_cancer']['colonoscopy']=$data['colonoscopy'];
		$data['common_assessment']['colorectal_cancer']['colonoscopy']['title_text']='Colonoscopy';
		$data['common_assessment']['colorectal_cancer']['colonoscopy']['img_src']='assets/img/dashboard/colonoscopy.png';
		$data['common_assessment']['colorectal_cancer']['colonoscopy']['assessment_link']='assets/img/dashboard/colonoscopy.png';
		}

		$data['iFOBT'] = $this->common_model->raw_query("SELECT * FROM `assessment_header` WHERE `patient_id` = {$user_id} AND `assessment_type_id` = 1 AND `assessment_sub_type_id` = 2 AND `assessment_tool_id` = 4 AND `is_completed` = 1 ORDER BY id DESC LIMIT 0,1");
		if(!empty($data['iFOBT'])){
			$data['iFOBT'] = array_merge(...$data['iFOBT']);
			$data['next_assesment_dates']['iFOBT'] = $data['iFOBT']['next_assesment_date'];
		}
		if(count($data['iFOBT'])>0) {
		$data['common_assessment']['colorectal_cancer']['iFOBT']=$data['iFOBT'];
		$data['common_assessment']['colorectal_cancer']['iFOBT']['title_text']='iFOBT';
		$data['common_assessment']['colorectal_cancer']['iFOBT']['img_src']='assets/img/dashboard/ifobt.png';
		$data['common_assessment']['colorectal_cancer']['iFOBT']['assessment_link']='assets/img/dashboard/ifobt.png';
		}

		$data['DCT'] = $this->common_model->raw_query("SELECT * FROM `assessment_header` WHERE `patient_id` = {$user_id} AND `assessment_type_id` = 3 AND `assessment_sub_type_id` = 1 AND `assessment_tool_id` = 10 AND `is_completed` = 1 ORDER BY id DESC LIMIT 0,1");
		if(!empty($data['DCT'])){
			$data['DCT'] = array_merge(...$data['DCT']);
			$data['next_assesment_dates']['DCT'] = $data['DCT']['next_assesment_date'];
		}
		if(count($data['DCT'])>0) {
		$data['common_assessment']['lung_cancer']['DCT']=$data['DCT'];
		$data['common_assessment']['lung_cancer']['DCT']['title_text']='Low-dose CT (LDCT)';
		$data['common_assessment']['lung_cancer']['DCT']['img_src']='assets/img/dashboard/ldct.png';
		$data['common_assessment']['lung_cancer']['DCT']['assessment_link']='assets/img/dashboard/colonoscopy.png';
		}

		$data['CXR'] = $this->common_model->raw_query("SELECT * FROM `assessment_header` WHERE `patient_id` = {$user_id} AND `assessment_type_id` = 3 AND `assessment_sub_type_id` = 3 AND `assessment_tool_id` = 12 AND `is_completed` = 1 ORDER BY id DESC LIMIT 0,1");
		if(!empty($data['CXR'])){
			$data['CXR'] = array_merge(...$data['CXR']);
			$data['next_assesment_dates']['CXR'] = $data['CXR']['next_assesment_date'];
		}
		if(count($data['CXR'])>0) {
		$data['common_assessment']['lung_cancer']['CXR']=$data['CXR'];
		$data['common_assessment']['lung_cancer']['CXR']['title_text']='Chest X-ray (CXR)';
		$data['common_assessment']['lung_cancer']['CXR']['img_src']='assets/img/dashboard/cxr.png';
		$data['common_assessment']['lung_cancer']['CXR']['assessment_link']='assets/img/dashboard/cxr.png';
		}

		$data['pap'] = $this->common_model->raw_query("SELECT * FROM `assessment_header` WHERE `patient_id` = {$user_id} AND `assessment_type_id` = 5 AND `assessment_sub_type_id` = 2 AND `assessment_tool_id` = 16 AND `is_completed` = 1 ORDER BY id DESC LIMIT 0,1");
		if(!empty($data['pap'])){
			$data['pap'] = array_merge(...$data['pap']);
			$data['next_assesment_dates']['pap'] = $data['pap']['next_assesment_date'];
		}
		if(count($data['pap'])>0) {
		$data['female_assessment']['cervical_cancer']['pap']=$data['pap'];
		$data['female_assessment']['cervical_cancer']['pap']['title_text']='Pap Smear';
		$data['female_assessment']['cervical_cancer']['pap']['img_src']='assets/img/dashboard/pap.png';
		$data['female_assessment']['cervical_cancer']['pap']['assessment_link']='assets/img/dashboard/pap.png';
		}

		$data['HPV'] = $this->common_model->raw_query("SELECT * FROM `assessment_header` WHERE `patient_id` = {$user_id} AND `assessment_type_id` = 5 AND `assessment_sub_type_id` = 2 AND `assessment_tool_id` = 17 AND `is_completed` = 1 ORDER BY id DESC LIMIT 0,1");
		if(!empty($data['HPV'])){
			$data['HPV'] = array_merge(...$data['HPV']);
			$data['next_assesment_dates']['HPV'] = $data['HPV']['next_assesment_date'];
		}
		if(count($data['HPV'])>0) {
		$data['female_assessment']['cervical_cancer']['HPV']=$data['HPV'];
		$data['female_assessment']['cervical_cancer']['HPV']['title_text']='HPV DNA';
		$data['female_assessment']['cervical_cancer']['HPV']['img_src']='assets/img/dashboard/hpv.png';
		$data['female_assessment']['cervical_cancer']['HPV']['assessment_link']='assets/img/dashboard/hpv.png';
		}

		$data['PSA'] = $this->common_model->raw_query("SELECT * FROM `assessment_header` WHERE `patient_id` = {$user_id} AND `assessment_type_id` = 4 AND `assessment_sub_type_id` = 2 AND `assessment_tool_id` = 13 AND `is_completed` = 1 ORDER BY id DESC LIMIT 0,1");
		if(!empty($data['PSA'])){
			$data['PSA'] = array_merge(...$data['PSA']);
			$data['next_assesment_dates']['PSA'] = $data['PSA']['next_assesment_date'];
		}
		if(count($data['PSA'])>0) {
		$data['male_assessment']['prostate_cancer']['PSA']=$data['PSA'];
		$data['male_assessment']['prostate_cancer']['PSA']['title_text']='Prostate Specific Antigen (PSA)';
		$data['male_assessment']['prostate_cancer']['PSA']['img_src']='assets/img/dashboard/psa.png';
		$data['male_assessment']['prostate_cancer']['PSA']['assessment_link']='assets/img/dashboard/psa.png';
		}

		$data['DRE'] = $this->common_model->raw_query("SELECT * FROM `assessment_header` WHERE `patient_id` = {$user_id} AND `assessment_type_id` = 4 AND `assessment_sub_type_id` = 2 AND `assessment_tool_id` = 14 AND `is_completed` = 1 ORDER BY id DESC LIMIT 0,1");
		if(!empty($data['DRE'])){
			$data['DRE'] = array_merge(...$data['DRE']);
			$data['next_assesment_dates']['DRE'] = $data['DRE']['next_assesment_date'];
		}
		if(count($data['DRE'])>0) {
		$data['male_assessment']['prostate_cancer']['DRE']=$data['DRE'];
		$data['male_assessment']['prostate_cancer']['DRE']['title_text']='Digital Rectal Examination (DRE)';
		$data['male_assessment']['prostate_cancer']['DRE']['img_src']='assets/img/dashboard/dre.png';
		$data['male_assessment']['prostate_cancer']['DRE']['assessment_link']='assets/img/dashboard/dre.png';	
		}

//collecting data of not done assessments
$temp=$data['cancer_list'];
if($data['female_assessment'] != null) {
	foreach($data['female_assessment'] as $cancer_type => $value ){
		unset($temp[$cancer_type]);
	}
}
$data['assessment_not_done']=$temp;

		$data['FHQ'] = $this->common_model->raw_query("SELECT * FROM `assessment_header` WHERE `patient_id` = {$user_id} AND `assessment_tool_id` = 25 AND `is_completed` = 1 ORDER BY id DESC LIMIT 0,1");	
		if(!empty($data['FHQ'])){
			$data['FHQ'] = array_merge(...$data['FHQ']);
			$data['next_assesment_dates']['FHQ'] = $data['FHQ']['next_assesment_date'];
		}	
		$data['HLS'] = $this->common_model->raw_query("SELECT * FROM `assessment_header` WHERE `patient_id` = {$user_id} AND `assessment_tool_id` = 26 AND `is_completed` = 1 ORDER BY id DESC LIMIT 0,1");	
		if(!empty($data['HLS'])){
			$data['HLS'] = array_merge(...$data['HLS']);
			$data['next_assesment_dates']['HLS'] = $data['HLS']['next_assesment_date'];
		}	
		$data['CRA'] = $this->common_model->raw_query("SELECT * FROM `assessment_header` WHERE `patient_id` = {$user_id} AND `assessment_tool_id` = 27 AND `is_completed` = 1 ORDER BY id DESC LIMIT 0,1");	
		if(!empty($data['CRA'])){
			$data['CRA'] = array_merge(...$data['CRA']);
			$data['next_assesment_dates']['CRA'] = $data['CRA']['next_assesment_date'];
		}	
		if(isset($data['HLS'])) {
			$HLS_Total_Score= $this->common_model->raw_query("SELECT SUM(`ad`.`assessment_questionnaires_value`) as `HLS_SCORE` FROM `assessment_detail` `ad` RIGHT JOIN (SELECT `ah`.`id` from `assessment_header` `ah` WHERE `ah`.`patient_id` = {$user_id} AND `ah`.`assessment_type_id` = 6 AND `ah`.`assessment_sub_type_id` = 1 AND `ah`.`assessment_tool_id` = 26 AND `ah`.`is_completed` = 1 ORDER BY `ah`.`id` DESC LIMIT 0,1) as `answers` ON (`ad`.`assessment_header_id`=`answers`.`id`)")[0]['HLS_SCORE'];
			$HLS_Total_Score = ($HLS_Total_Score/72)*100;
			$HLS_Total_Score = number_format((float)$HLS_Total_Score, 2, '.', '');
		}

		$CRA= $this->common_model->raw_query("SELECT * FROM `assessment_detail` `ad` RIGHT JOIN (SELECT `ah`.`id` from `assessment_header` `ah` WHERE `ah`.`patient_id` = {$user_id} AND `ah`.`assessment_type_id` = 6 AND `ah`.`assessment_sub_type_id` = 1 AND `ah`.`assessment_tool_id` = 27 AND `ah`.`is_completed` = 1 ORDER BY `ah`.`id` DESC LIMIT 0,1) as `answers` ON (`ad`.`assessment_header_id`=`answers`.`id`)");	

		$CRA_All = $this->common_model->raw_query("SELECT * FROM `assessment_detail` `ad` RIGHT JOIN (SELECT `ah`.`id` from `assessment_header` `ah` WHERE `ah`.`patient_id` = {$user_id} AND `ah`.`assessment_type_id` = 6 AND `ah`.`assessment_sub_type_id` = 1 AND `ah`.`assessment_tool_id` = 27 AND `ah`.`is_completed` = 1 ORDER BY `ah`.`id` DESC) as `answers` ON (`ad`.`assessment_header_id`=`answers`.`id`)");	


		$BMI_All = $this->common_model->raw_query("SELECT *  FROM `assessment_detail` AS ad INNER JOIN assessment_header AS ah ON ah.id = ad.assessment_header_id WHERE ah.patient_id = {$user_id} AND ad.assement_questionnaires_id = (SELECT id  FROM `m_assessment_questionnaires` WHERE q_identifier = 'YHT_CRA_1') ORDER BY ad.id DESC");

		$Waist_All = $this->common_model->raw_query("SELECT *  FROM `assessment_detail` AS ad INNER JOIN assessment_header AS ah ON ah.id = ad.assessment_header_id WHERE ah.patient_id = {$user_id} AND ad.assement_questionnaires_id = (SELECT id  FROM `m_assessment_questionnaires` WHERE q_identifier = 'YHT_CRA_2') ORDER BY ad.id DESC");

		$BMI_array = array();
		foreach($BMI_All as $tmp_bmi){
			$BMI_array[] = $tmp_bmi;
		}

		$BMI_points = array();
		foreach($BMI_array as $tmp2){
			$total_points = 0;
			if(!empty($tmp2['assessment_questionnaires_value'])){
			$answer=json_decode($tmp2['assessment_questionnaires_value']);
			if($answer){
				foreach($answer as $ans => $point) {
					$total_points=$total_points+$point;		
				}
			}
		}

			$BMI_points[] = $total_points;
		}


		$Waist_array = array();
		foreach($Waist_All as $tmp_waist){
			$Waist_array[] = $tmp_waist;
		}

		$Waist_points = array();
		foreach($Waist_array as $tmp2){
			$total_points = 0;
			if(!empty($tmp2['assessment_questionnaires_value'])){
			$answer=json_decode($tmp2['assessment_questionnaires_value']);
			if($answer){
				foreach($answer as $ans => $point) {
					$total_points=$total_points+$point;		
				}
			}
		}

			$Waist_points[] = $total_points;
		}

		$CRA_by_header = array();
		foreach($CRA_All as $tmp_cra){
			$CRA_by_header[$tmp_cra['assessment_header_id']][] = $tmp_cra;//$this->get_points($tmp_cra,36);
		}

		$CRA_all_points = array();
		foreach($CRA_by_header as $tmp2){
			$CRA_all_points[] = $this->get_points($tmp2,36);
		}
		//echo "<pre>";print_r($CRA_all_points);exit();
//its positive points. means good points. risk level calculated by 100 - this point
		$CRA_point=$this->get_points($CRA,36);
		$CRA_point=100-$CRA_point;
		//adding all assessment points to this array	

		$data['next_ass_dates'] = implode("','", array_unique($data['next_assesment_dates']));
		$data['all_assessments']['CRA']=$CRA_point;
		$data['CRA_all_points'] = implode(',',$CRA_all_points);
		$data['BMI_points'] = implode(',', $BMI_points);
		$data['Waist_points'] = implode(',',$Waist_points);
		$data['HLS_Total_Score']=$HLS_Total_Score; 
		$this->load->view('layout/main', $data);
	}

	public function test(){
		echo "h";
		sendEmail();
	}
	public function get_points($mypoint,$outof) {
		$result = 0;//array();
		$total_points=0;
		foreach($mypoint as $key => $value){
			if(!empty($value['assessment_questionnaires_value'])){
			$answer=json_decode($value['assessment_questionnaires_value']);
			if($answer){
				foreach($answer as $ans => $point) {
					$total_points=$total_points+$point;		
				}
			}
			}	
		}
		$result = round($total_points/$outof*100);
		//echo "<pre>";print_r($result);exit();
		return $result;
	}
}
