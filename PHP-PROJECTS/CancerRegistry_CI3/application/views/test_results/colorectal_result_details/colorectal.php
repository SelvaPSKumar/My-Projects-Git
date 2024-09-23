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
              <h1>Colorectal Cancer Assessment Results</h1>
            </div>
            <div class="col-4 col-md-6">
            <?php if($CI->session->userdata('rolecode') == MEDICPRAC){ ?>
                <a href="<?php echo base_url('all_assessments/colorectal_cancer'); ?>">
            <?php }else{ ?>
                <a href="<?php echo base_url('test_results/colorectal'); ?>">
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
                        case 20:
                        case 21:
                            echo '
                                <th scope="col">Question</th>
                                <th scope="col">Answer</th>';
                        break;

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
                        case 20:
                        case 21:
                        default:

                            if( !empty( $header_detail ) ) {
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
                                    echo '<tr>
                                            <td>'.$answers["q_no"].". ".$answers["questionnaire"].'</td>
                                            <td>'.$answers["assessment_questionnaires_value"].'</td>
                                        </tr>';
                                }  
                            }

                        break;

                    }
                    if($assessment_tool_id == 21) {
                        if(isset($answers["assessment_questionnaires_value"])) {
                            $total_point = $answers["assessment_questionnaires_value"];
                            $text_val = '';
                            if( $total_point == 0 || $total_point == 1 ) {
                                $text_val = "<div class='text-success'>You are of low risk and should continue preventative practices. It is ideal to do a baseline Faecal Occult Blood Test (FOBT) at any Klinik Kesihatan. Otherwise, contact National Cancer Society Malaysia (NCSM) at 03-26987351 for further details on FOBT.</div>";
                            } elseif( $total_point ==2 || $total_point == 3 ) {
                                $text_val = "<div class='text-warning'>You are of moderate risk. It is recommended for you to do the FOBT at any Klinik Kesihatan. Otherwise, contact National Cancer Society Malaysia (NCSM) at 03-26987351 for further details on FOBT.</div>";
                            } elseif( $total_point >= 4 && 7 >= $total_point ) {
                                $text_val ="<div class='text-danger'>You are high risk: Please consult a gastroenterologist, colorectal surgeon or general surgeon. You may do this in any private hospital or the respective units of gastroenterology in a government hospital. An urgent colonoscopy will be scheduled for you.</div>";
                            } else{ }
                            echo '
                                <tr>
                                    <td>Recommendation</td>
                                    <td>'.$text_val.'</td>
                                </tr>
                            ';
                        }
                    }

                    if($assessment_tool_id == 3) {
                        if( isset($answered_value) ) {
                            $text_val = '';
                            switch($answered_value) {
                                case 'haemorrhoids':
                                    $text_val = '<div class="text-secondary">Consult a GP or surgeon for further management.</div>';
                                break;

                                case 'diverticular disease':
                                case 'benign colonic polyps':
                                case 'neoplastic colonic polyps':
                                case 'inflammation/ulceration':
                                case 'bleeding':
                                    $text_val = '<div class="text-secondary">Consult a gastroenterologist, or colorectal surgeon or general surgeon for further management.</div>';
                                break;

                                default:
                                break;
                            }
                            echo '
                                <tr>
                                    <td>Recommendation</td>
                                    <td>'.$text_val.'</td>
                                </tr>
                            ';
                        }
                    }
                  ?>

               </tbody>
              </table>
        </div>
    </div>
