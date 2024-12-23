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
              <h1>HealthTools Assessment Results</h1>
            </div>
            <div class="col-4 col-md-6">
            <?php if($CI->session->userdata('rolecode') == MEDICPRAC){ ?>
                <a href="<?php echo base_url('health_tools_assessments'); ?>">
            <?php }else{ ?>
                <a href="<?php echo base_url('test_results/healthtools'); ?>">
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
                    <th scope="col">Question</th>
                    <th scope="col">Answer</th>
                  </tr>
                </thead>
               <tbody>
                  <?php
                    if ( !empty( $header_detail ) ) {

                        /*block to organize structure of group and categorize it*/
                        foreach( $header_detail as $ans_key => $ans_value ) {
                           // grouping answers
                            $answers[$ans_value ['group']][]= $ans_value;
                        }
                        for($i=1;$i<=count($answers);$i++) {
                            $its_table = false;
                            $its_single_row_table = false;
                            for($j=0;$j<count($answers[$i]);$j++) {
                                if( ( $answers[$i][0]['assement_questionnaires_column_id'] == 0 ) && ( $answers[$i][$j]['assement_questionnaires_column_id'] != 0 ) ) {
                                    $its_single_row_table = true;
                                } elseif( $answers[$i][$j]['assement_questionnaires_column_id'] != 0 ) {
                                    $its_table=true;
                                } else {

                                }
                            }
                            if($its_table) {
                                $answer_categories[$i]="table";
                            } elseif( $its_single_row_table ) {
                                $answer_categories[$i]="row_table";
                            } else {
                                $answer_categories[$i]="normal";
                            }
                        }
                        /*end of group and organize */
                        for($i=1;$i<=count($answers);$i++) {
                            //normal output
                            if( $answer_categories[$i] == "normal" ) {
                                foreach($answers[$i] as $ans_key => $ans_value) {
                                    $ans_json=json_decode($ans_value['assessment_questionnaires_value']);
                                    echo '<tr>
                                            <td>'.$ans_value ['q_no'].'. '.$ans_value['questionnaire'].'</td>';
                                        if(is_object($ans_json)) {
                                            foreach($ans_json as $label => $value){
                                            echo '<td>'.ucfirst($label).'</td>';
                                            }
                                        } else {
                                            $answer_text = "";
                                            if($ans_value['assessment_questionnaires_value'] == 1){
                                                $answer_text = 'Very Difficult';
                                            }else if($ans_value['assessment_questionnaires_value'] == 2){
                                                $answer_text = 'Fairly Difficult';
                                            }else if($ans_value['assessment_questionnaires_value'] == 3){
                                                $answer_text = 'Fairly Easy';
                                            }else if($ans_value['assessment_questionnaires_value'] == 4){
                                                $answer_text = 'Very Easy';
                                            }
                                            echo '<td>'.$answer_text.'</td>';
                                        }
                                   echo '</tr>';
                                }
                            } 

                            //table output
                            elseif( $answer_categories[$i] =="table" ) {
                                $table_answer=null;
                                $table_columns=null;
                                echo '<tr>';
                                foreach($answers[$i] as $ans_key => $ans_value) {
                                   $table_answer[$ans_value['assement_questionnaires_id']][$ans_value['assement_questionnaires_column_id']] = $ans_value['assessment_questionnaires_value'];
                                   $table_columns[$ans_value['assement_questionnaires_column_id']] ='';
                                }
                                echo '
                                <div class="tabel-results table-responsive">
                                <table class="table table_questions">
                                    <thead>
                                        <tr>
                                            <th> '.$header_table_title[$ans_value['group']].' </th>';
                                    foreach( $table_columns as $column_key => $column_value) {
                                        echo '<td>'.$header_questions[$column_key].'</td>';
                                    }
                                echo '</tr>
                                    </thead>
                                    <tbody>';
                                    foreach( $table_answer as $row_key => $row_value) {
                                        echo '
                                         <tr>
                                          <th>'.$header_questions[$row_key].'</th>';
                                        foreach( $row_value as $column_key => $column_value ) {
                                            echo '<td>'.$column_value.'</td>';
                                        }
                                        echo '</tr>';
                                    }
                                echo '</tbody>
                                    </table>
                                    </div>';
                                echo '</tr>';
                            }

                            //single row table
                            elseif( $answer_categories[$i] =="row_table" ) {
                                echo '
                                <tr>
                                <div class="tabel-results table-responsive">
                                <table class="table table_questions">
                                    <thead>
                                        <tr>
                                            <td>';
                                echo $header_questions[$answers[$i][0]['assement_questionnaires_id']];
                                echo '</th>';
                                foreach( $answers[$i] as $ans_key => $ans_value ) {
                                    if( $ans_value['assement_questionnaires_column_id'] != 0) {
                                    echo '<td>'.$header_questions[$ans_value['assement_questionnaires_column_id']].'</th>';
                                    }
                                }
                                echo '
                                      </tr>
                                    </thead>
                                <tbody>';
                                 foreach( $answers[$i] as $ans_key => $ans_value ) {
                                    echo '<td>'.$ans_value['assessment_questionnaires_value'].'</td>';
                                }
                                echo '
                                </tbody>
                                </table>
                                </div>
                                </tr>';
                            }
                        }
                        //displaying score
                        if($header_total_score > 0 ) {
                         echo '<tr>
                                <th> Total Score is </th>
                                <th>'.$header_total_score.'%<th>
                            </tr>';
                        }
                    }
                  ?>

               </tbody>
              </table>
        </div>
    </div>
