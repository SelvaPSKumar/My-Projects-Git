<link rel="styleSheet" href="<?php echo base_url('assets/css/family_history.css') ?>" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script type="text/javascript" src="<?php echo base_url('assets/js/healthtools_questions.js') ?>"></script>

<div class="container">
     <div class="back-container">
             <a href="<?php echo base_url('health_tools/screening'); ?>"><button class="btn next-btn float-end"><span class="prev-icon"><ion-icon name="chevron-back-outline"></ion-icon></span> Back</button></a>
    </div>
    <?php
    $js_function ='';
    $total_group = $questions[count($questions)-1]->group;
    echo '<input type="hidden" id="total_page" value="'.$total_group.'" />';

    $default_column_id=0;
    if( $questions[0]->assessment_tools_id == "25" ) {           
        echo '<h1 class="screeningHeader">FAMILY HISTORY</h1>'; 
    } elseif ( $questions[0]->assessment_tools_id == "26" ) {
        echo '<h1 class="screeningHeader">HEALTH LITERACY</h1>';
       $js_function = "generate_result(this)";
    }elseif ( $questions[0]->assessment_tools_id == "27" ) {
        echo '<h1 class="screeningHeader">CANCER RISK ASSESSMENT</h1>';
        $js_function = "generate_result_json(this)";
        echo '<div class="image_vegetable_intake hint_images">
            <img src="'.base_url('assets/img/healthtools/fruit_and_vegetables.png').'">
            </div>';
        echo '<div class="image_whole_grains hint_images">
            <img src="'.base_url('assets/img/healthtools/whole_grains.png').'">
            </div>';
        echo '<div class="image_alcohol_intake hint_images">
            <img src="'.base_url('assets/img/healthtools/alcohol_intake.png').'">
            </div>';
    } else {}
    ?>
</div>

<div class="question-container mt-5">
    <div class="prev-next-btn mb-4">
<div class="headernode row">
    <div class="col">
        <div class="">
            <button class="btn prev-btn" id="previous">
                <span class="prev-icon"><ion-icon name="chevron-back-outline"></ion-icon></span>
                Previous
                  <input type="hidden" name="" value="group_1" id="previous_page">
              </button>
        </div>
    </div>
    <div class="col hide_progress_responsive">
        <!-- <div class="container"> -->
            <div class="card">
                <ul class="progress_bar">
                    <?php
                    for($group=1; $group<=$total_group;$group++) {
                        if($group==1) {
                            echo '<li class="active" id="group_'.$group.'">Step</li>';
                        } elseif($group==$total_group) {
                            echo '<li id="completed">Completed</li>';
                        } else {
                            echo '<li id="group_'.$group.'">Step</li>';
                        }
                    }
                    ?>
                </ul>
            </div>
        <!-- </div> -->
    </div>
    <div class="col">
        <div class="">
            <!-- <a href="../ScreeningQuestions/ScreeningQuestionTwo.html"> -->
                <button class="btn next-btn float-end" id="next">
                    Next <span class="next-icon"><ion-icon name="chevron-forward-outline"></ion-icon></span>
                    <input type="hidden" name="" value="group_1" id="current_page">
                </button>
            <!-- </a> -->
        </div>
    </div>
</div>
</div>
    <hr />
    <form action="<?php echo base_url('save_health_tools_questions'); ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="assessment_header_id" value="<?php echo $assessment_header_id ?>">
        <input type="hidden" name="assessment_tool_id" id="assessment_tool_id" value="<?php echo $questions[0]->assessment_tools_id; ?>">
        <div class="questions-section mt-5">
            <?php
                
            function print_table($column_data,$row_data,$table_title, $js_function) {
				$default_column_id=0;
				if( $column_data[0]->assessment_tools_id == "25" ) {
				    $head_title = "Biological Family History";
                    $head_sub_title = "Please fill out the following information where it applies to your <span class='text-warning biological_family'>biological family</span> only.";
                    
                echo '<div class="col-md-12 group_'.$column_data[0]->group.'">
                            <h4 class="text-center">'.$head_title.'</h4>
                            <h5 class="text-center">'.$head_sub_title.'</h5>
                        </div>';
                } elseif( $column_data[0]->assessment_tools_id == "26" ) {
                    $head_title = "Please tick (√) in the appropriate box.";
                    $head_sub_title = "On a scale from “very difficult” to “very easy”, evaluate how easy it is for you to:";
                    
                    echo '<div class="col-md-12 group_'.$column_data[0]->group.'">
                                <h4 class="text-center">'.$head_title.'</h4>
                                <h5 class="text-center">'.$head_sub_title.'</h5>
                            </div>';
                    }
                
                if($table_title==null) {
                    if( count($column_data) <= 1 ) {
                    //<!---- bof table build code ---->
                    echo '
                    <div class="col-md-12 group_'.$column_data[0]->group.'">
                    <table class="table">
                        <tr class="heading_row">';
                            foreach($column_data as $result_column) {
                                echo '<td scope="row" ">'.$result_column->questionnaire.'</td>';
                            }
                            foreach($row_data as $result_row){ 
                                echo '<td scope="row"">'.$result_row->questionnaire.'</td>';
                            }
                        echo '</tr>';
                        
                        foreach($column_data as $result_column){ 
                            echo '
                            <tr>';

                                if($result_column->input_type=="text"){
                                    echo '
                                    <td>
                                        <div class="responsive_title">'.$result_column->questionnaire.'</div>
                                        <input type="text" name="question['.$result_column->id.']['.$default_column_id.']" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                                    </td>';
                                }
                                if( $result_column->input_type== "select") {
                                    if($result_column->input_values==null || empty($result_column->input_values)) {
                                        $select_values[0]=0;
                                        $select_values[1]=50;
                                    } else {
                                        $select_values=explode('-', $result_column->input_values );
                                    }
                                    echo '
                                    <td>
                                        <div class="responsive_title">'.$result_column->questionnaire.'</div>
                                        <div class="question'.$result_column->q_no.' group_'.$result_column->group.'">
                                                <select class="form-select" aria-label="Default select example" name="question['.$result_column->id.']['.$default_column_id.']">
                                                    <option selected value=""> --Select-- </option>';
                                                    for($k=intval($select_values[0]); $k<=intval($select_values[1]);$k++) {
                                                        echo '<option value="'.$k.'">'.$k. '</option>';
                                                    }
                                        echo '</select>
                                        </div>
                                    </td>';
                                }

                                foreach($row_data as $result_cell_row){
                                    if($result_cell_row->input_type=="text"){
                                        echo '
                                        <td>
                                            <div class="responsive_title">'.$result_cell_row->questionnaire.'</div>
                                            <input type="text" name="question['.$result_column->id.']['.$result_cell_row->id.']" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                                        </td>';
                                    }
                                    if( $result_cell_row->input_type== "select") {
                                        if($result_cell_row->input_values==null || empty($result_cell_row->input_values)) {
                                            $select_values[0]=0;
                                            $select_values[1]=50;
                                        } else {
                                            $select_values=explode('-', $result_cell_row->input_values );
                                        }
                                        echo '
                                        <td>
                                            <div class="responsive_title">'.$result_cell_row->questionnaire.'</div>
                                            <div class="question'.$result_cell_row->q_no.' group_'.$result_cell_row->group.'">
                                                    <select class="form-select" aria-label="Default select example" name="question['.$result_column->id.']['.$result_cell_row->id.']">
                                                        <option selected value=""> --Select-- </option>';
                                                        for($k=intval($select_values[0]); $k<=intval($select_values[1]);$k++) {
                                                            echo '<option value="'.$k.'">'.$k. '</option>';
                                                        }
                                             echo '</select>
                                            </div>
                                        </td>';
                                    }
        
                                }
                        echo '
                            </tr>';
                        } 
                    echo '</table>
                    </div>';
                    //<!---- eof table build code ----> 
                    } else {
                    
                     //<!---- bof table build code ---->
                     
                   
      echo '
                    <div class="col-md-12 group_'.$column_data[0]->group.'">
                    <table class="table">
                        <div class="responsive_main_title">
                            '.$table_title.'
                        </div>
                        <tr class="heading_row">
                            <th scope="row">'.$table_title.'</th>';
                            foreach($row_data as $result_row){ 
                                echo '<td scope="row"">'.$result_row->questionnaire.'</td>';
                            }
                        echo '</tr>';
                        foreach($column_data as $result_column){ 
                            echo '
                            <tr>
                                <td scope="row">'.$result_column->questionnaire.'</td>';
                                foreach($row_data as $result_cell_row){
                                    if($result_cell_row->input_type=="text"){
                                        echo '
                                        <td>
                                            <div class="responsive_title">'.$result_cell_row->questionnaire.'</div>
                                            <input type="text" name="question['.$result_column->id.']['.$result_cell_row->id.']" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                                        </td>';
                                    }
                                    if( $result_cell_row->input_type== "select") {
                                        if($result_cell_row->input_values==null || empty($result_cell_row->input_values)) {
                                            $select_values[0]=0;
                                            $select_values[1]=50;
                                        } else {
                                            $select_values=explode('-', $result_cell_row->input_values );
                                        }
                                        echo '
                                        <td>
                                            <div class="responsive_title">'.$result_cell_row->questionnaire.'</div>
                                            <div class="question'.$result_cell_row->q_no.' group_'.$result_cell_row->group.'">
                                                    <select class="form-select" aria-label="Default select example" name="question['.$result_column->id.']['.$result_cell_row->id.']">
                                                        <option selected value=""> --Select-- </option>';
                                                        for($k=intval($select_values[0]); $k<=intval($select_values[1]);$k++) {
                                                            echo '<option value="'.$k.'">'.$k. '</option>';
                                                        }
                                             echo '</select>
                                            </div>
                                        </td>';
                                    }
                                     if( $result_cell_row->input_type== "radio") {
                                        
                                        echo '
                                            <!--<div class="responsive_title">'.$result_cell_row->questionnaire.'</div>-->
                                            <div class="question'.$result_cell_row->q_no.' group_'.$result_cell_row->group.'">
                                                  <td>
                                                    <input type="radio" name="question['.$result_column->id.']['.$default_column_id.']" value="'.$result_cell_row->input_values.'" onchange="'.$js_function.'">
                                                    <label class="responsive_radio_label" for="question['.$result_column->id.']['.$default_column_id.']">'.$result_cell_row->questionnaire.'</label>
                                                </td>
                                            </div>';
                                    }
        
                                }
                        echo '
                            </tr>';
                        } 
                    echo '</table>
                    </div>';

                   //<!---- eof table build code ----> 
                        
                    }
                } else {
                    //<!---- bof table build code ---->
                    echo '
                    <div class="col-md-12 group_'.$column_data[0]->group.'">
                    <table class="table">
                        <div class="responsive_main_title">
                            '.$table_title.'
                        </div>
                        <tr class="heading_row">
                            <th scope="row">'.$table_title.'</th>';
                            foreach($row_data as $result_row){ 
                                echo '<td scope="row"">'.$result_row->questionnaire.'</td>';
                            }
                        echo '</tr>';
                        foreach($column_data as $result_column){ 
                            echo '
                            <tr>
                                <th scope="row">'.$result_column->questionnaire.'</th>';
                                foreach($row_data as $result_cell_row){
                                    if($result_cell_row->input_type=="text"){
                                        echo '
                                        <td>
                                            <div class="responsive_title">'.$result_cell_row->questionnaire.'</div>
                                            <input type="text" name="question['.$result_column->id.']['.$result_cell_row->id.']" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                                        </td>';
                                    }
                                    if( $result_cell_row->input_type== "select") {
                                        if($result_cell_row->input_values==null || empty($result_cell_row->input_values)) {
                                            $select_values[0]=0;
                                            $select_values[1]=50;
                                        } else {
                                            $select_values=explode('-', $result_cell_row->input_values );
                                        }
                                        echo '
                                        <td>
                                            <div class="responsive_title">'.$result_cell_row->questionnaire.'</div>
                                            <div class="question'.$result_cell_row->q_no.' group_'.$result_cell_row->group.'">
                                                    <select class="form-select" aria-label="Default select example" name="question['.$result_column->id.']['.$result_cell_row->id.']">
                                                        <option selected value=""> --Select-- </option>';
                                                        for($k=intval($select_values[0]); $k<=intval($select_values[1]);$k++) {
                                                            echo '<option value="'.$k.'">'.$k. '</option>';
                                                        }
                                             echo '</select>
                                            </div>
                                        </td>';
                                    }
        
                                }
                        echo '
                            </tr>';
                        } 
                    echo '</table>
                    </div>';
                    //<!---- eof table build code ---->
                }
            }

            if (!empty($questions)) {
                $html ='';
                $same_table="";
                $print_table=null;
                $column_data=null;
                $row_data=null;
                $table_title=null;
                $current_group=null;
                foreach ($questions as $key => $question) { 

                    if( !empty( $question->tip ) ) {
                        $tip='<i class="fa fa-info-circle" data-bs-toggle="tooltip" title="'. $question->tip.'"></i>';
                    } else {
                        $tip='';
                    }
                    if( !empty( $question->placeholder ) ) {
                        $placeholder= $question->placeholder;
                    } else {
                        $placeholder='';
                    }
                    $for_table=false;

                    //Data should arrange on asc order of 'group' for error free excecution
                    if($current_group==null){
                    $current_group=$question->group;
                    } elseif($current_group != $question->group) {
                        if($column_data!=null || $row_data!=null){
                            print_table($column_data,$row_data,$table_title, $js_function);
                            }
                            $current_group=$question->group;
                            $column_data=null;
                            $row_data=null;
                            $table_title=null;
     
                    } else{}

                    if($current_group == $question->group) {
                        if( $question->question_type=="column") {
                            $column_data[]=$question;
                            $table_title=$question->questionnaire_title?$question->questionnaire_title:null;
                            $for_table=true;
                        } else {
                            if($column_data!=null) {
                                $row_data[]=$question;
                                $for_table=true;
                            } 
                        }
                    }
                    


 //breaking loop for remove error
 //if($question->group > 2 ) {
  //  break;
//}



                    if( $question->input_type == "radio" && !$for_table) {
                        $input_values=explode( "|", $question->input_values);
                        $html .= '
                        <div class="row" id="qno'.$question->q_no.'">
                            <div class="col-md-8 mb-2 group_'.$question->group.'">
                                <label>'. $question->q_no.". ". $question->questionnaire .$tip.'</label>
                                <div class="yes-no-section">';
                                foreach( $input_values as $input_value ) {
                                    $selection = ( strtolower( $input_value ) == 'yes' ) ? 1 : 0;
                                     if( $question->q_identifier == 'YHT_FHQ_1' ) {
                                            $question_show_hide='onchange="show_hide('.$question->q_no.', [2], '.$selection.')"';
                                        } elseif( $question->q_identifier == 'YHT_FHQ_4' ) {
                                            $question_show_hide='onchange="show_hide('.$question->q_no.', [5], '.$selection.')"';
                                        } else {
                                             $question_show_hide="";
                                        }

                                   $html .= '
                                   <div class=" mb-2">
                                        <input class="" type="radio" name="question['.$question->id.']['.$default_column_id.']" value="'.$input_value.'" '.$question_show_hide.'>
                                        <label>'.ucfirst($input_value).'</label>
                                    </div>';
                                }
                                $html .='</div>
                            </div>
                        </div>';
                    }
                    if( $question->input_type== "text" && !$for_table) {
                        $hide1 = '';
                        if($question->q_identifier=='YHT_FHQ_2' || $question->q_identifier=='YHT_FHQ_5') {
                            $hide1 = ' display: none; ';
                        }
                        $html .= 
                        '<div class="row" id="qno'.$question->q_no.'" style="'.$hide1.'">
                            <div class="col-md-8 mb-2 question'.$question->q_no.' group_'.$question->group.'">
                                <label>'.$question->q_no.". ". $question->questionnaire . $tip.'</label>
                                <div class="yes-no-section mt-4">
                                        <input type="text" name="question['.$question->id.']['.$default_column_id.']" class="form-control" placeholder="'.$placeholder.'" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>';
                    }
                    if( $question->input_type== "select" && !$for_table) {
                        if($question->input_values==null || empty($question->input_values)) {
                            $select_values[0]=0;
                            $select_values[1]=50;
                            $default=true;
                        } else {
                                $json_format = json_decode($question->input_values);
                                if($json_format){
                                    if(isset($json_format->male) || isset($json_format->female)){
                                        if ($patient_gender == 1 ) {
                                            $select_values=$json_format->male;
                                        } elseif( $patient_gender == 2) {
                                            $select_values=$json_format->female;
                                        } else {
                                            $select_values=$json_format->male;
                                        }
                                    } else {
                                        $select_values=$json_format;
                                    }
                                    $default=false;
                                } elseif (strpos($question->input_values,"|") !== false) {  
                                    $select_values=explode('|', $question->input_values );
                                    $default=false;
                                }
                                elseif (strpos($question->input_values,"-") !== false) {  
                                    $select_values=explode('-', $question->input_values );
                                    $default=true;
                                } else{

                                }
                        }
                        if( $question->q_identifier == 'YHT_CRA_4' ) {
                            $label_hover='onmouseover="show_image(1)" onmouseout="hide_image(1)"';
                        } elseif( $question->q_identifier == 'YHT_CRA_5' ) {
                             $label_hover='onmouseover="show_image(2)" onmouseout="hide_image(2)"';
                        } elseif( $question->q_identifier == 'YHT_CRA_9' ) {
                             $label_hover='onmouseover="show_image(3)" onmouseout="hide_image(3)"';
                        } else {
                             $label_hover="";
                        }
                        $html .='
                        <div class="row" id="qno'.$question->q_no.'">
                            <div class="col-md-8 mb-2 question'.$question->q_no.' group_'.$question->group.'">
                                <label '.$label_hover.'>'.$question->q_no.". ". $question->questionnaire. $tip.'</label>
                                <div class="yes-no-section mt-4">
                                    <select class="form-select" aria-label="Default select example" name="question['.$question->id.']['.$default_column_id.']" onchange="'.$js_function.'">
                                        <option selected value=""> --Select-- </option>';
                                        if( $default ){
                                                for($i=intval($select_values[0]); $i<=intval($select_values[1]);$i++) {
                                                $html .="<option value='".$i."'>".$i."</option>";
                                            }
                                        } else {
                                            foreach($select_values as $label => $point){
                                                $decoded=json_encode(array($label=>$point),JSON_FORCE_OBJECT);
                                                $html .="<option value='".htmlspecialchars($decoded)."'>".$label."</option>";
                                            }
                                           
                                        }
                            $html .='</select>
                                </div>
                            </div>
                        </div>';
                    }

                 }
                 echo $html;
                }
                if($column_data!=null || $row_data!=null){
                    print_table($column_data,$row_data,$table_title, $js_function);
                    $current_group=$question->group;
                    $column_data=null;
                    $row_data=null;
                    $table_title=null;

                    }
                    
                    if($assessment_tool_id == 25 ) {
                    echo ' <div class="col-md-12 group_'.$questions[count($questions)-1]->group.'">
                            <h5 class="text-center"> Thank you for completing the Family History Assessment. </h5>
                        </div>
                        <div class="row mt-5 mb-5 group_'.$questions[count($questions)-1]->group.'">
                            <div class="text-center">
                                <!-- <a href="'.base_url('screening/family_history/success_full').' -->
                                    <button type="submit" class="btn proceed-btn">Click to Save the Family Healthtools Questions</button> 
                                    <!-- </a> -->
                                </div> 
                            </div>
                        </div>
                        ';
                    } elseif($assessment_tool_id == 26) {
                        echo ' <div class="col-md-12 group_'.$questions[count($questions)-1]->group.'">
                            <h5 class="text-center"> Thank you for completing the Health Literacy Survey. </h5>
                            <h5 class="text-center score_text"> Your score is <span class="score"></span>%. You have <span class="literacy_level"></span> Health Literacy. </h5>
                        </div>
                        <div class="row mt-5 mb-5 group_'.$questions[count($questions)-1]->group.'">
                            <div class="text-center">
                                <!-- <a href="'.base_url('screening/family_history/success_full').' -->
                                    <button type="submit" class="btn proceed-btn">Click to Save the Health Literacy Survey </button> 
                                    <!-- </a> -->
                                </div> 
                            </div>
                        </div>
                        ';

                    } elseif($assessment_tool_id == 27) {
                        echo '<div class="col-md-12 group_'.$questions[count($questions)-1]->group.'">
                            <br><h5 class="text-center score_text"> Your score is <span class="score"></span>%.</h5>
                            </div>
                            <div class="col-md-12 group_'.$questions[count($questions)-1]->group.'">
                            <br><h5 class="text-center">'.$health_beauty_website.'</h5>
                            </div>
                            <div class="row mt-5 mb-5 group_'.$questions[count($questions)-1]->group.'">
                                <div class="text-center">
                                    <!-- <a href="'.base_url('screening/family_history/success_full').' -->
                                        <button type="submit" class="btn proceed-btn">Thank you for completing the Cancer Risk Assessment. </button> 
                                        <!-- </a> -->
                                    </div> 
                                </div>
                            </div>
                            ';
                    } else {}
                  ?>

                              
                            </form>

                            <hr/>

                            <div class="prev-next-btn mb-4">
<div class="row footernode">
    <div class="col">
        <div class="">
            <button class="btn prev-btn" id="previous">
                <span class="prev-icon"><ion-icon name="chevron-back-outline"></ion-icon></span>
                Previous
                  <input type="hidden" name="" value="group_1" id="previous_page">
              </button>
        </div>
    </div>
    <div class="col hide_progress_responsive">
        <!-- <div class="container"> -->
            <div class="card">
                <ul class="progress_bar">
                <?php
                    $total_group = $questions[count($questions)-1]->group;
                    for($group=1; $group<=$total_group;$group++) {
                        if($group==1) {
                            echo '<li class="active" id="group_'.$group.'">Step</li>';
                        } elseif($group==$total_group) {
                            echo '<li id="completed">Completed</li>';
                        } else {
                            echo '<li id="group_'.$group.'">Step</li>';
                        }
                    }
                    ?>
                </ul>
            </div>
            
        <!-- </div> -->
    </div>
    <div class="col">
        <div class="">
            <!-- <a href="../ScreeningQuestions/ScreeningQuestionTwo.html"> -->
                <button class="btn next-btn float-end" id="next">
                    Next <span class="next-icon"><ion-icon name="chevron-forward-outline"></ion-icon></span>
                    <input type="hidden" name="" value="group_1" id="current_page">
                </button>
            <!-- </a> -->
        </div>
    </div>
</div>
</div> 
                                
                            </div>

                            <script src="<?php echo base_url('assets/js/family_history.js'); ?>"></script>
                <script>
                            var tooltipList1 = [].slice.call(document.querySelectorAll('[data-bs-toggle = "tooltip"]'))
                            var tooltipList2 = tooltipList1.map(function(tooltipTriggerfun) {
                                return new bootstrap.Tooltip(tooltipTriggerfun)
                            })                                  
                        </script>
