<link rel="styleSheet" href="<?php echo base_url('assets/css/allTestResults.css'); ?>" />
<link rel="styleSheet" href="<?php echo base_url('assets/css/global.css'); ?>" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

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
              <h1>Prostate Cancer Assessment Results</h1>
            </div>
            <div class="col-4 col-md-6">
            <?php if($CI->session->userdata('rolecode') == MEDICPRAC){ ?>
                <a href="<?php echo base_url('all_assessments/prostate_cancer'); ?>">
            <?php }else{ ?>
                <a href="<?php echo base_url('test_results/prostate'); ?>">
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

                    if($assessment_tool_id == 22) {
                        $label = '';
                        $value = '';
                        if(isset($values['labels'])) {
                            $label = "'" . implode("','", $values['labels']) . "'";
                        }
                        if(isset($values['values'])) {
                            $value = json_encode($values['values']);
                        }
                        $chart = '
                        <tr><td colspan="2">
                        <div class="row">
                            <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                        </div>
                        </td>
                        </tr>
                        <script>
                              var xValues = ['.$label.'];
                              var yValues = '.$value.';
                              new Chart("myChart", {
                                type: "line",
                                data: {
                                  labels: xValues,
                                  datasets: [{
                                    fill: false,
                                    lineTension: 0,
                                    backgroundColor: "rgba(0,0,255,1.0)",
                                    borderColor: "rgba(0,0,255,0.1)",
                                    data: yValues
                                  }]
                                },
                                options: {
                                  legend: {display: false},
                                  title: {
                                    display: true,
                                    text: "IPSS Result",
                                    fontSize: 16
                                  },
                                  scales: {
                                    yAxes: [{ticks: {min: 0, max: 50}}],
                                  }
                                }
                              });
                        </script>';
                        echo $chart;

                    $recommendation_1 = '';
                    $recommendation_2 = '';
                    if(isset($values['values']) && count($values['values']) > 0) {
                        $total_point = end($values['values']);
                        if($total_point > 0 && $total_point <= 7) {
                            $recommendation_1 = 'You have mild symptoms.';
                        } elseif($total_point > 7 && $total_point <= 19) {
                            $recommendation_1 = 'You have moderate symptoms. Please consult a doctor for further diagnostic tests.';
                        } elseif($total_point > 19 && $total_point <= 35) {
                            $recommendation_1 = 'You have severe symptoms. Please consult a doctor urgently for further diagnostic tests.';
                        } else {}
                    }
                    if(isset($values['yes_no']) && count($values['yes_no']) > 0) {
                        if(end($values['yes_no'])) {
                        $recommendation_2 = 'The symptom(s) that you are experiencing can be caused by a variety of reasons, which are not serious most of the time. We recommend that you discuss these symptoms with your healthcare provider. They will be able to fully assess your condition and carry out any relevant tests to determine the cause for your symptoms.';
                        }
                    }
                    echo '<tr>
                            <td>Recommendation 1</td>
                            <td>'.$recommendation_1.'</td>
                        </tr>
                        <tr>
                            <td>Recommendation 2</td>
                            <td>'.$recommendation_2.'</td>
                        </tr>';
                    }

                  ?>

               </tbody>
              </table>
        </div>
    </div>
