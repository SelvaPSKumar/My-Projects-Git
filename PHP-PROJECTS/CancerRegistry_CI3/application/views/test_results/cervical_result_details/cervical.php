<link rel="styleSheet" href="<?php echo base_url('assets/css/allTestResults.css'); ?>" />
<link rel="styleSheet" href="<?php echo base_url('assets/css/global.css'); ?>" />

    <?php $CI = & get_instance() ?>
<style>
    .red-color{
        color: red !important;
    }
</style>
<div class="container" style="margin-top: 50px">
        <div class="results-single-page">
        <div class="row">
            <div class="col-8 col-md-6">
              <h1>Cervical Cancer Assessment Results</h1>
            </div>
            <div class="col-4 col-md-6">
            <?php if($CI->session->userdata('rolecode') == MEDICPRAC){ ?>
                <a href="<?php echo base_url('all_assessments/cervical_cancer'); ?>">
            <?php }else{ ?>
                <a href="<?php echo base_url('test_results/cervical'); ?>">
            <?php } ?>
            <button class="btn next-btn float-end"><span class="prev-icon"><ion-icon name="chevron-back-outline"></ion-icon></span> Back</button>
                
            </a>

            </div>
        </div>
        
        </div>
        <?php 
            $assessment_sub_type_id         = $header_data[0]['assessment_sub_type_id']; 
            $assessment_sub_type_name       = $CI->get_assessment_sub_type_info($assessment_sub_type_id)->assessment_sub_type_name;
            $assessment_tool_id             = $header_data[0]['assessment_tool_id'];
            $assessment_tool_name           = $CI->get_assessment_tool_info($assessment_tool_id)->assessment_tool_name; 
        ?>
        <div class="header-component">
            <h6><?php echo  $assessment_sub_type_name." Assessment"; ?> </h6>
            <h5><?php echo isset($assessment_tool_name) ? $assessment_tool_name :'';  ?></h5>
            <h3>Assessment Number: <?php echo $header_data[0]['assessment_prefix'], '-' , $header_data[0]['assessment_number'];; ?></h3>
            <h3>Assessment on: <?php echo $header_data[0]['assessment_date'], ' ' , $header_data[0]['assessment_time'];; ?></h3>
            <h3>Next Assessment date: <?php echo $header_data[0]['next_assesment_date'] ? $header_data[0]['next_assesment_date'] : 'N/A'; ?></h3>
        </div>
        <div class="tabel-results table-responsive">
            <table class="table table-borderless">
                <thead>
                  <tr>
                    <?php
                    switch( $assessment_tool_id ) {
                        default:
                            echo '
                                <th scope="col">Question</th>
                                <th scope="col">Answer</th>';
                        break;
                    }
                    ?>
                  </tr>
                </thead>
               <tbody>
                  <?php

                    $table_title = array();
                    if(!empty($header_detail)){
                        $table_title = get_table_title($header_detail);
                    }
                    
                    if( !empty( $header_detail ) ) {
                        //var_dump($header_detail);
                        $arranged_table = array();
                        //arrange table
                        foreach( $header_detail as $key => $answers ) {
                            if(!isset($arranged_table[$answers['assement_questionnaires_id']])) {
                            $arranged_table[$answers['assement_questionnaires_id']] = $answers;
                            } else {
                                $arranged_table[$answers['assement_questionnaires_id']]['assessment_questionnaires_value'] .= '|'.$answers['assessment_questionnaires_value'];
                            }
                        }
                    }

                    switch($assessment_tool_id) {
                        default:

                            if( !empty( $arranged_table ) ) {
                                foreach( $arranged_table as $key => $answers ) {
                                    $answered_value = null;
                                    $processed_value = get_different_inputs((object)$answers, '', $patient_gender);

                                    $is_json = is_string($answers["assessment_questionnaires_value"]) && is_array(json_decode($answers["assessment_questionnaires_value"], true)) ? true : false;
                                    if($is_json) {
                                        $processed_answer_value = (array)json_decode_and_fetch($answers["assessment_questionnaires_value"], $patient_gender);
                                        $answers["assessment_questionnaires_value"] = array_values($processed_answer_value)[0];
                                        $answered_value = array_keys($processed_answer_value)[0];
                                    }

                                    if(strpos( $answers["assessment_questionnaires_value"], '|' ) !== false) {
                                        $answer_values = explode('|', $answers["assessment_questionnaires_value"]);
                                        $answers["assessment_questionnaires_value"] = '';
                                        if(isset($answer_values)) {
                                            $sno = 1;
                                            foreach($answer_values as $answer_value) {
                                                $answers["assessment_questionnaires_value"] .= '<div>'.$sno.'. '.$answer_value.'</div>';
                                                $sno++;
                                            }
                                        }
                                    }
                                    if(isset($answers['assessment_questionnaires_value'])) {
                                        if($answers['file_path'] == 1) {
                                            $answers["assessment_questionnaires_value"] = '<a href="'.base_url('view_image/').$header_data[0]['id'].'/'.$answers['assement_questionnaires_id'].'" target="_blank"><img src="'.get_encrypted_image($answers['assessment_questionnaires_value']).'" width="100"></a>';
                                        }
                                    }

                                    echo '<tr>
                                            <td>'.$answers["q_no"].". ".$answers["questionnaire"].'</td>
                                            <td>'.$answers["assessment_questionnaires_value"].'</td>
                                        </tr>';
                                }  
                            }

                        break;

                    }

                    switch ($assessment_tool_id) {
                    case 16:
                        $assessment = 'Recommendation';
                        $info = '';
                        if(!isset($answered_value)){
                            break;
                        }
                        switch($answered_value) {
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
                    break;
                    case 17:
                        $assessment = 'Recommendation';
                            $info = '';
                            if(!isset($answered_value)){
                                break;
                            }

                            switch($answered_value) {
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
                    break;

                    case 18:
                        $assessment = 'Recommendation';
                        $info = '';
                        if(!isset($answered_value)){
                            break;
                        }

                            switch($answered_value) {
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
                                    $assessment = '';
                                    $info = '';
                                    break;
                                break;
                            }
                    break;

                    case 24:
                        if($answered_value == 'yes') {
                            $info = 'Please consult your doctor for advice on further diagnostic tests.<br>';
                        }
                    default:
                        $assessment = '';
                        $info = '';
                        break;
                }

                echo '<tr>
                        <td>'.$assessment.'</td>
                        <td>'.$info.'</td>
                    </tr>';
                  ?>

               </tbody>
              </table>
        </div>
    </div>
