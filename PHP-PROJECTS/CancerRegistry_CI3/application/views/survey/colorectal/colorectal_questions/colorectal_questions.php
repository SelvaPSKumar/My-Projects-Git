<link rel="styleSheet" href="<?php echo base_url('assets/css/family_history.css') ?>" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php

$assessment_info = $this->session->assessment_data;
$javascript_include = '';

//risk assessment
if( $assessment_info['assessment_tool_id'] == 21 ) {
    $javascript_include = base_url('assets/js/colorectal_questions.js');
} elseif($assessment_info['assessment_tool_id'] == 3) {
    $javascript_include = base_url('assets/js/colorectal_questions_colonoscopy.js');
}
?>
<link rel="styleSheet" href="<?php echo base_url('assets/css/ScreeningQuestions.css') ?>" />
<script src="<?php echo $javascript_include; ?>"></script>
<style>
    .question {
        margin-bottom: 0px;
    }
    .question_section_parent {
        margin-bottom: 1rem;
    }
    .question_section input, .question_section select {
        margin-left: 10px;
    }
</style>
<?php
$this->load->helper('common_helper');
//will helpfull in future
$js_function = '';
$total_group = $questions[count($questions)-1]->group;
 echo '<input type="hidden" id="total_page" value="'.$total_group.'" />';
 echo '<input type="hidden" id="patient_gender" value="'.$patient_gender.'" />';

?>
<div class="container">
        <div class="back-container">
            <a href="<?php echo base_url('colorectal_cancer/screen'); ?>">
            <button class="btn next-btn float-end"><span class="prev-icon"><ion-icon name="chevron-back-outline"></ion-icon></span> Back</button>

            </a>
        </div>
        
        <h1 class="screeningHeader">COLORECTAL CANCER SCREENING
        </h1>  
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
           <form name="colorectal_cancer_question" id="colorectal_cancer_question" action="<?php echo base_url('colorectal_cancer/save_colorectal_cancer_questions'); ?>" method="POST">
                   <input type="hidden" name="assessment_types_id" value="<?php echo $assessment_types_id ?>">
        <input type="hidden" name="assessment_tools_id" value="<?php echo $assessment_tools_id ?>">
              <input type="hidden" name="assessment_header_id" value="<?php echo $assessment_header_id; ?>">
              <div class="row">
                      <?php if(!empty($questions)){
                            foreach ($questions as $key => $question) {
                                $inputs_and_related = get_different_inputs($question, $js_function, $patient_gender );
                                echo '
                                <div class ="question_section_parent group_'.$question->group.' question_row_id_'.$question->q_no.'">
                                    <div class="row"></div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="question">'.$question->q_no.". ", $question->questionnaire.'</p>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="question_section">'
                                               .$inputs_and_related["input_content"].
                                            '</div>
                                        </div>
                                    </div>
                                </div>
                                ';
                            }
                        }?>
                  </div>
                
        <br>
        <div class="row">
            <div class="text-center"><h6 class="result_message"></h6></div>
        </div>
        
        <br>      
        <div class="proceed-footer-general-health group_<?php echo $questions[count($questions)-1]->group; ?>">
            <!-- <a href="<?php echo base_url('colorectal_cancer_question/save_questions'); ?>"> -->

            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <button type="submit" class="btn proceed-btn proceed-btn-colorectal_cancer_question">Click to proceed</button>
                </div>
                <div class="col-md-4"></div>
            </div>
            <!-- </a> -->
</p>
        </div>
      </form>
    </div>


                            <hr/>
<div class="question-container mt-5">
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