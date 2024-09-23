<?php
$assessment = null;
$content = null;
$info = '';
switch ($assessment_tools_id) {
    case 16:
        $assessment = 'Cervical Cancer PAP SMEAR Assessment Tool';
        $content = '';
        if(!isset($assessment_answer_for_result)){
            break;
        }
        $is_json = is_string($assessment_answer_for_result) && is_array(json_decode($assessment_answer_for_result, true)) ? true : false;
        if($is_json) {
            $selected = key(json_decode($assessment_answer_for_result, true));

            switch($selected) {
                case 'normal':
                    $info = 'Repeat every three years after 2 normal annual smears.';
                break;
                case 'unsatisfactory':
                    $info = 'Repeat after 3 months, treat infection and give a course of local oestrogen therapy if cytology reported atrophic smear. REFER for Colposcopy if similar findings in 3 consecutive smears.';
                break;
                case 'inflammatory':
                    $info = 'Treat with antifungal, antibiotic or antiviral according to organisms involved. REFER for Colposcopy if similar findings in 3 consecutive smears.';
                break;
                case 'asc_us':
                    $info = 'This result means atypical squamous cells are present in the cervix. Repeat Pap in 6months. REFER for Colposcopy if 2 consecutive ASCUS. Refer for Colposcopy directly without a second Pap if:
                    <ul>
                    <li>ASCUS + Positive High-Risk HPV DNA</li>
                    <li>ASC-H</li>
                    <li>Immunocompromised</li>
                    <ul>';
                break;
                case 'lsil_lgsil':
                    $info = 'This result means low-grade squamous intraepithelial lesion. LSIL usually is caused by an HPV infection that often goes away on its own. Repeat Pap in 6months. REFER for Colposcopy if 2 consecutive LSIL. REFER for Colposcopy if poor compliance, immunocompromised, positive high risk HPV, history of CIN.';
                break;
                case 'hsil_hgsil':
                    $info = 'This means high-grade squamous intraepithelial lesion. Urgent referral for colposcopy needed.';
                break;
                case 'agc_agus':
                    $info = 'This means high-grade squamous intraepithelial lesion. Urgent referral for colposcopy needed.';
                break;
                default:
                    $info = '';
                break;
            }
        }
    break;
    case 17:
        $assessment = 'Cervical Cancer HPV DNA Testing Assessment Tool';
            $content = '';
            if(!isset($assessment_answer_for_result)){
                break;
            }
            $is_json = is_string($assessment_answer_for_result) && is_array(json_decode($assessment_answer_for_result, true)) ? true : false;
            if($is_json) {
                $selected = key(json_decode($assessment_answer_for_result, true));
            switch($selected) {
                case 'unsatisfactory':
                    $info = 'Repeat test within 12 weeks.';
                break;
                case 'negative':
                    $info = 'Repeat HPV DNA test in 5 years.';
                break;
                case 'positive non':
                    $info = 'Refer to hospital for liquid based cytology papsmear / papsmear to test for abnormal cell changes in the cervix.';
                break;
                case 'positive':
                case 'high risk':
                case 'low risk':
                    $info = 'Refer to hospital for diagnostic procedure (colposcopy)';
                break;
                default:
                break;
            }
            }
    break;

    case 18:
        $assessment = 'Cervical Cancer Colposcopy Assessment Tool';
        $content = '';
        if(!isset($assessment_answer_for_result)){
            break;
        }
        $is_json = is_string($assessment_answer_for_result) && is_array(json_decode($assessment_answer_for_result, true)) ? true : false;
        if($is_json) {
            $selected = key(json_decode($assessment_answer_for_result, true));
            switch($selected) {
                case 'inflammation_infection':
                case 'leukoplakia':
                case 'condyloma':
                    $info = 'Follow up with your gynaecologist. Depending on your age, you\'ll be invited for a cervical screening appointment in 3 or 5 years.';
                break;

                case 'low-grade CIN':
                case 'high-grade CIN':
                case 'invasive cancer':
                    $info = 'Follow up with your gynaecologist as soon as possible. Abnormal cells present could turn into cancer if not treated.';
                break;

                case 'others':
                default:
                    $assessment = 'Cervical Cancer Colposcopy Assessment Tool';
                    $content = '<p>You have successfully completed the Colposcopy Assessment Tool. Please perform this assessment again in a month’s time.</p>
                        <p>Next Assessment on '.$next_assesment_date.'</p>';
                    break;
                break;
            }
        }
    break;

    case 24:
        if($assessment_answer_for_result) {
            $info = 'Please consult your doctor for advice on further diagnostic tests.<br>';
        }
    default:
        $assessment = 'Cervical Cancer Symptom Assessment Tool';
        $content = '<p>You have successfully completed the This Assessment Tool. Please perform this assessment again in a month’s time.</p>
            <p>Next Assessment on '.$next_assesment_date.'</p>';
        break;
}
?>

<div class="container">
        <h1 class="screeningHeader"><?php echo $assessment; ?></h1>  
    </div>
    <div class="question-container mt-5">
      

        <div class="questions-section-final mt-5">
            <?php echo '<h5 class="text-secondary">'.$info.'</5>'.$content; ?>
        </div>
        <div class="proceed-footer">
            <?php if($this->session->userdata('rolecode') == PATIENT) {
                echo '
                <a href="'.base_url('test_results/cervical').'">
                    <button class="btn proceed-btn">
                        Click to proceed
                    </button>
                </a>';
            } else {
                echo '
                <a href="'.base_url('all_assessments/cervical_cancer').'">
                    <button class="btn proceed-btn">
                        Click to proceed
                    </button>
                </a>';
            }
            ?>
        </div>
    </div>