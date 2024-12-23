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
              <h1>General Health Assessment Results</h1>
            </div>
            <div class="col-4 col-md-6">
            <?php if($CI->session->userdata('rolecode') == MEDICPRAC){ ?>
                <a href="<?php echo base_url('all_assessments/general_health'); ?>">
            <?php }else{ ?>
                <a href="<?php echo base_url('test_results/general_health'); ?>">
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
                        case 28:
                            echo '
                                <th scope="col">Question</th>
                                <th scope="col">Normal Value</th>
                                <th scope="col">Answer</th>';
                        break;

                        case 29:
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

                    switch( $assessment_tool_id ) {
                        case 28:
                            if ( !empty( $header_detail ) ) {
                                $hide = '';
                                foreach( $header_detail as $key => $answers ) {
                                    $processed_value = get_different_inputs((object)$answers, '', $patient_gender);
                                    $is_json = is_string($answers["assessment_questionnaires_value"]) && is_array(json_decode($answers["assessment_questionnaires_value"], true)) ? true : false;
                                    if($is_json) {
                                        $processed_answer_value = (array)json_decode_and_fetch($answers["assessment_questionnaires_value"], $patient_gender);
                                        $processed_answer_value = array_values($processed_answer_value)[0];

                                    } else {
                                        $processed_answer_value = $answers["assessment_questionnaires_value"];
                                    }
                                    //its static checking. need sql data to make dynamic
                                    if($hide != $answers["q_no"]) {
                                        if($answers["q_no"] == 4){
                                            if(strtolower($processed_answer_value) == 'fasting') {
                                                $hide = 6;
                                            } elseif(strtolower($processed_answer_value) == 'random') {
                                                $hide = 5;
                                            }
                                        }

                                        if($processed_value['normal_value']) {
                                            $user_answer = ucfirst($processed_answer_value);
                                        } else {
                                            $user_answer = '<strong>'.ucfirst($processed_answer_value).'<strong>';
                                        }
                                        if(isset($table_title[$answers["q_no"]])) {
                                            echo '<tr>
                                                    <td colspan="3"><h5 align="center">'.$table_title[$answers["q_no"]].'</h5></td>
                                                </tr>';
                                            unset($table_title[$answers["q_no"]]);
                                        }
                                        echo '<tr>
                                                <td>'.$answers["q_no"].". ".$answers["questionnaire"].'</td>
                                                <td>'.$processed_value["normal_value_info_content"].'</td>
                                                <td>'.$user_answer.'</td>
                                            </tr>';
                                    }
                                }
                            }
                        break;


                        case 29:
                        default:
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

                                foreach( $arranged_table as $key => $answers ) {
                                    $processed_value = get_different_inputs((object)$answers, '', $patient_gender);
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

                                    if(isset($table_title[$answers["q_no"]])) {
                                        echo '<tr>
                                                <td colspan="2"><h5 align="center">'.$table_title[$answers["q_no"]].'</h5></td>
                                            </tr>';
                                        unset($table_title[$answers["q_no"]]);
                                    }
                                    echo '<tr>
                                            <td>'.$answers["q_no"].". ".$answers["questionnaire"].'</td>
                                            <td>'.$answers["assessment_questionnaires_value"].'</td>
                                        </tr>';
                                }   
                            }
                        break;
                    }

                  ?>

               </tbody>
              </table>
        </div>
    </div>
