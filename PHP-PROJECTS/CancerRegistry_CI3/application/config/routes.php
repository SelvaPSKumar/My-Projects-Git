<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] 		= 'home';
$route['signup'] 					= 'user/signup';
$route['login'] 					= 'login/index';
$route['logout'] 					= 'login/logout';
$route['change_password'] 			= 'login/change_password';
$route['update_password'] 			= 'login/update_password';
$route['forgot_password'] 			= 'login/forgot_password';
$route['profile'] 					= 'user_profile/profile';
$route['edit_profile'] 				= 'user_profile/edit_profile';
$route['fetch_state'] 				= 'user_profile/fetch_state';


$route['patient_dashboard'] 		= 'patient/dashboard';


$route['doctor_dashboard'] 			= 'doctor/dashboard';
$route['manage_patients'] 			= 'doctor/manage_patients';
$route['all_assessments/(:any)'] 			= 'test_results/all_assessments/$1';
$route['all_assessments_ajax/(:any)'] 		= 'test_results/all_assessments_ajax/$1';
//$route['all_assessments/patient/(:any)'] 			= 'test_results/all_assessments/$1';
$route['patients_list'] 			= 'patient/patients_list';
$route['settings'] 					= 'settings/index';

$route['admin_dashboard'] 			= 'admin/dashboard';
$route['manage_doctors/datatable_info'] 			= 'admin/datatable_info';
$route['manage_doctors/approve_doctors'] 			= 'admin/approve_doctor';
$route['manage_doctors/doctor_details_modal'] 			= 'admin/doctor_details_modal';
$route['manage_doctors/(:any)'] 			= 'admin/manage_doctors/$1';
$route['manage_doctors/(:any)/(:num)'] 		= 'admin/manage_doctor_details/$1/$2';
$route['manage_doctors/(:any)/(:num)/obsolete'] 		= 'admin/process_obsolete/$1/$2';
$route['manage_doctors/(:any)/(:num)/not_obsolete'] 		= 'admin/process_not_obsolete/$1/$2';


$route['test_results/(:any)'] 		= 'test_results/index/$1';
//$route['test_results_ajax/(:any)'] 		= 'test_results/test_results_ajax/$1';
$route['test_result_details/(:any)/(:num)'] = 'test_results/test_result_details/$1/$2';
$route['test_result_details_for_doctor/(:any)/(:num)'] = 'test_results/test_result_details_for_doctor/$1/$2';


$route['screening/screen'] 			= 'screening/index';
$route['screening/save_selection/(:any)'] 			= 'screening/save_selection/$1';
$route['screening_selection'] 		= 'screening/screening_selection';
$route['screening_note'] 			= 'screening/screening_note';
$route['screening_questions'] 		= 'screening/screening_questions';
$route['save_screening_questions'] 		= 'screening/save_screening_questions';
$route['screening_consult_doc'] 		= 'screening/screening_consult_doc';
$route['screening_success_full'] 		= 'screening/screening_success_full';
$route['screening_questions/(:any)'] = 'screening/screening_questions/$1';
$route['risk_breast_questions'] 	= 'screening/risk_breast_questions';
$route['risk_breast_questions_save'] 	= 'screening/risk_breast_questions_save';

$route['clinical_examination'] 		= 'screening/clinical_examination';
$route['i_breast_examination'] 		= 'screening/i_breast/i_breast_examination';
$route['save_i_breast_questions'] 		= 'screening/save_i_breast_questions';
$route['i_breast_successfull'] 		= 'screening/i_breast_successfull';
$route['clinical_ultra_sound_questions'] 	= 'screening/clinical_ultra_sound_questions';
$route['ultra_sound_ultra_sound'] 	= 'screening/ultra_sound_ultra_sound';
$route['ultra_sound_success_full'] 	= 'screening/ultra_sound_success_full';
$route['clinical_ultra_sound'] 		= 'screening/clinical_ultra_sound';
$route['mammogram_ultra_sound'] 	= 'screening/mammogram_ultra_sound';
$route['mammogram_questions'] 	= 'screening/mammogram_questions';

$route['screening/clinical_questions'] = 'screening/clinical_questions';
$route['screening/save_clinical_questions'] = 'screening/save_clinical_questions';
$route['clinical_success_full'] 		= 'screening/clinical_success_full';
$route['screening/i_breast/(:any)'] = 'screening/i_breast_questions/$1';
$route['screening/ultra_sound/(:any)'] = 'screening/ultra_sound_questions/$1';
$route['ultra_sound_questions1'] = 'screening/ultra_sound_questions1';
$route['save_ultra_sound_questions1'] = 'screening/save_ultra_sound_questions1';
$route['save_clinical_ultra_sound1'] = 'screening/save_clinical_ultra_sound1';
$route['clinical_ultra_sound_success_full'] = 'screening/clinical_ultra_sound_success_full';
$route['save_mammogram_questions'] = 'screening/save_mammogram_questions';
$route['mammogram_questions1'] = 'screening/mammogram_questions1';
$route['save_mammogram_questions1'] = 'screening/save_mammogram_questions1';
$route['mammogram_success_full'] = 'screening/mammogram_success_full';
$route['screening/mammogram/(:any)'] = 'screening/mammogram_questions/$1';


//$route['colorectal_cancer/screen'] 		= 'colorectal_cancer/index';
$route['colorectal_cancer/screen'] 	= 'colorectal_cancer/colorectal_cancer_selection';
$route['colorectal_cancer_questions']	= 'colorectal_cancer/save_colorectal_cancer_header';
//$route['colorectal_questions/(:any)'] 	= 'colorectal_cancer/colorectal_questions/$1';
$route['colorectal_questions'] 	= 'colorectal_cancer/colorectal_questions';
$route['colorectal_cancer/save_colorectal_cancer_questions']	= 'colorectal_cancer/save_colorectal_cancer_questions';
$route['colorectal_result_details/(:num)']	= 'colorectal_results/colorectal_result_details/$1';

$route['colorectal_cancer/risk_assessment_info'] 		= 'colorectal_cancer/risk_assessment_info';
$route['colorectal_cancer/risk_assessment_calculator'] 		= 'colorectal_cancer/risk_assessment_calculator';
$route['colorectal_cancer/risk_assessment_score'] 		= 'colorectal_cancer/risk_assessment_score';

$route['colorectal_cancer/colonoscopy'] 		= 'colorectal_cancer/colonoscopy';
$route['colorectal_cancer/colonoscopy_doctor'] 		= 'colorectal_cancer/colonoscopy_doctor';
$route['colorectal_cancer/ifobt'] 		= 'colorectal_cancer/ifobt/index';
$route['colorectal_cancer/ifobt_doctor'] 		= 'colorectal_cancer/ifobt_doctor';


$route['lungs_cancer/screen'] 			= 'lungs_cancer/index';
$route['lungs_cancer_selection'] 		= 'lungs_cancer/lungs_cancer_selection';


$route['prostate_cancer/screen'] 		= 'prostate_cancer/index';
$route['prostate_cancer_selection'] 	= 'prostate_cancer/prostate_cancer_selection';


$route['cervical_cancer/screen'] 		= 'cervical_cancer/index';
$route['cervical_cancer_selection'] 	= 'cervical_cancer/cervical_cancer_selection';


$route['health_tools/screening']        = 'health_tools/health_tools_screening';
$route['your_health_tools']             = 'health_tools/save_health_tool_assessment_header';
$route['health_tools_assessments']      = 'health_tools/healthtools_assessments';
$route['health_literacy_survey']      	= 'health_tools/save_health_tool_assessment_header';
$route['save_health_tools_questions']   = 'health_tools/save_healthtools_questions';
$route['healthtools_result_details/(:num)'] = 'healthtools_results/healthtools_result_details/$1';
$route['healthtools_for_doctor/(:num)']='healthtools_results/healthtool_result_details_for_doctor/$1';

$route['general_health/screening']		= 'general_health/general_health_screening';
$route['general_health_questions']		= 'general_health/save_general_health_header';
$route['general_health/ajax_save_general_health_questions']		= 'general_health/ajax_save_general_health_questions';
$route['general_health_result_details/(:num)'] = 'general_health_results/general_health_result_details/$1';
$route['general_health_for_doctor/(:num)'] = 'general_health_results/general_health_result_details_for_doctor/$1';

$route['404_override'] 				= '';
$route['translate_uri_dashes'] = FALSE;
$route['test-email'] ='Mail';
$route['verify/(:any)'] 			= 'user/verify/$1';  ////// ahsan
$route['view_image/(:num)/(:num)']	= 'test_results/view_image/$1/$2';
