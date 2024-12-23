<link rel="styleSheet" href="<?php echo base_url('assets/css/family_history.css') ?>" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="styleSheet" href="<?php echo base_url('assets/css/ScreeningQuestions.css') ?>" />
<link rel="styleSheet" href="<?php echo base_url('assets/css/general_health_question.css') ?>" />
<?php if( $assessment_tools_id == 28 ) { ?>
<script type="text/javascript" src="<?php echo base_url('assets/js/general_health.js') ?>"></script>
<?php } else if( $assessment_tools_id == 29 ) { ?>
<script type="text/javascript">
$(document).ready(function() {
    var total_page = $('#total_page').val();
    for(var i=2; i<=total_page; i++) {
        $(".group_"+i).hide();
    }
    $(".group_1").show();
});

$(document).ready(function(){
    $(".full-row .input_checkboxes").addClass('col-md-3');
    $(".half-row .input_checkboxes").addClass('col-md-12');

    $(document).on("click", function() {
        show_block();
        hide_block();
    });
    $('input[type="radio"]').on("click", function() {
        show_block();
    });
     $('input[type="radio"]').on("click", function() {
        hide_block();
    });
     function show_block() {
        var radioButton = $("#question_9_0_");
        if( radioButton.is(':checked') ) {
            var selected_title = $(".show_hide_depend_q_no_9").data("title");
            $(".question_rows").each(function(){
                if($(this).data("title") == selected_title) {
                    $(this).show();
                }
              });
        }
     }
     function hide_block() {
        var radioButton = $("#question_9_1_");
        if( radioButton.is(':checked') ) {
            var selected_title = $(".show_hide_depend_q_no_9").data("title");
            $(".question_rows").each(function(){
                if($(this).data("title") == selected_title) {
                    $(this).hide();
                    $(this).find("input").prop("checked", false);
                }
              });
        }
     }
});
</script>
<?php } ?>

<?php
$this->load->helper('common_helper');
//will helpfull in future
$js_function = '';
$total_group = $questions[count($questions)-1]->group;
$page_title = '';
if($assessment_tools_id == "28") {
    $page_title ="GENERAL HEALTH SCREENING";
}elseif($assessment_tools_id == "29") {
    $page_title = "PERKESO SCREENING";
}

 echo '<input type="hidden" id="total_page" value="'.$total_group.'" />';
?>
<div class="container">
        <div class="back-container">
            <a href="<?php echo base_url('general_health/screening'); ?>">
            <button class="btn next-btn float-end"><span class="prev-icon"><ion-icon name="chevron-back-outline"></ion-icon></span> Back</button>

            </a>
        </div>
        
        <h1 class="screeningHeader"><?php echo $page_title; ?>
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
           <form name="general_health_question" id="general_health_question" action="<?php echo base_url('general_health/ajax_save_general_health_questions'); ?>" method="POST">
                   <input type="hidden" name="assessment_types_id" value="<?php echo $assessment_types_id ?>">
        <input type="hidden" name="assessment_tools_id" value="<?php echo $assessment_tools_id ?>">
              <input type="hidden" name="assessment_header_id" value="<?php echo $assessment_header_id; ?>">
              <div class="row">
                      <?php

                        $table_title = array();
                        if(!empty($questions)){
                            $table_title = get_table_title($questions);
                        }
                        
                        switch( $assessment_tools_id ) {
                            case "28":
                            default:

                                if(!empty($questions)){
                                    foreach ($questions as $key => $question) {
                                        if(isset($table_title[$question->q_no])) {
                                            echo '<div class="question_title w-100 group_'.$question->group.'" data-title="'.$question->questionnaire_title.'"><h5 align="center">'.$table_title[$question->q_no].'</h5></div>';
                                            unset($table_title[$question->q_no]);
                                        }
                                        $inputs_and_related = get_different_inputs($question, $js_function, $patient_gender );
                                        echo '
                                        <div class ="question_section_parent group_'.$question->group.'">
                                            <div class="row"><p class="question">'.$question->q_no.". ", $question->questionnaire.'</p></div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="question_section">'
                                                       .$inputs_and_related["input_content"].
                                                    '</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="normal_value_section">'
                                                        .$inputs_and_related["normal_value_info_content"].
                                                    '</div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="warning_info_section">'
                                                    .$inputs_and_related["warning_info_content"].
                                                '</div>
                                            </div>
                                        </div>
                                        ';
                                    }
                                }

                            break;

                            case "29":

                                //desctiption of the checkbox table
                                $description = '
                                <div class="w-100">
                                    <p>Sila baca setiap kenyataan dan bulatkan jawapan (skala markah 0,1,2,3) yang menggambarkan keadaan anda SEMINGGU YANG LEPAS. Tidak ada jawapan betul atau salah. JANGAN guna terlalu banyak masa untuk mana-mana kenyataan.</p>
                                    <p>Skala markah adalah seperti berikut:</p>
                                    <p class="text-center">0=Tidak pernah sama sekali 1=Jarang 2=Kerap 3=Sangat Kerap</p>
                                </div>';
                                $sno =null;
                                if(!empty($questions)){
                                        echo '<div class="HSP_Section">';
                                        foreach($questions as $key=>$question) {
                                            $inputs_and_related = get_different_inputs($question, $js_function, $patient_gender );
                                            //to wrap with same line q-6 and 1-7
                                            if($question->q_no != 7) {
                                            echo '<div class="row group_'.$question->group.' question_rows" data-title="'.$question->questionnaire_title.'">';
                                            }
                                            if(isset($table_title[$question->q_no])) {
                                                echo '<div class="question_title w-100" data-title="'.$question->questionnaire_title.'"><h5 align="center">'.$table_title[$question->q_no].'</h5></div>';
                                                if($table_title[$question->q_no] == 'UJIAN MINDA SIHAT - DASS21') {
                                                    echo $description;
                                                    echo '<div class="show_hide_depend_q_no_9" data-title="'.$question->questionnaire_title.'"></div>';
                                                    $sno = 1;
                                                    echo '</div>';
                                                    $table_head = '
                                                        <div class="row group_'.$question->group.' question_rows" data-title="'.$question->questionnaire_title.'">
                                                            <div class="row question_table_head">
                                                                <div class="col-md-1">No.</div>
                                                                <div class="col-md-7 text-center">Soalan DASS21</div>
                                                                <div class="col-md-4 text-center">Skala</div>
                                                            </div>
                                                        </div>';
                                                    echo $table_head;
                                                    echo '<div class="row group_'.$question->group.' question_rows" data-title="'.$question->questionnaire_title.'">';
                                                }
                                            }
                                            switch($question->input_type) {
                                                case 'radio';
                                                    if($question->q_no != 7) {
                                                        $serial_no = $sno ? $sno++.'. ' : ''; 
                                                        echo '
                                                        <div class="row question_section">
                                                            <div class="col-md-8"><div class="sno">'.$serial_no.'</div><div class="question">'.$question->questionnaire.'</div></div>
                                                            <div class="col-md-4">'.$inputs_and_related["input_content"].'</div>
                                                        </div>';
                                                    } else {
                                                        echo '
                                                        <div class="col-md-4 half-row question_section">
                                                            <div class="col-md-12">'.$question->questionnaire.'</div>
                                                            <div class="col-md-12">'.$inputs_and_related["input_content"].'</div>
                                                        </div>';
                                                    }

                                                break;

                                                case 'checkbox':
                                                    if($question->q_no != 6) {
                                                        echo '
                                                        <div class="row full-row question_section">
                                                            <div class="col-md-12">'.$question->questionnaire.'</div>
                                                            <div class="col-md-12">'.$inputs_and_related["input_content"].'</div>
                                                        </div>';
                                                    } else {
                                                        echo '
                                                        <div class="col-md-8 half-row question_section">
                                                            <div class="col-md-12">'.$question->questionnaire.'</div>
                                                            <div class="col-md-12">'.$inputs_and_related["input_content"].'</div>
                                                        </div>';
                                                    }
                                                break;

                                                case 'text':
                                                    echo '
                                                        <div class="row full-row question_section">
                                                            <div class="col-md-12">'.$question->questionnaire.'</div>
                                                            <div class="col-md-12">'.$inputs_and_related["input_content"].'</div>
                                                        </div>';
                                                break;
                                            }
                                            if($question->q_no != 6) {
                                            echo '</div>';
                                            }
                                        }
                                    echo '</div>';
                                     
                                }
                        

                            break;
                        }
                    ?>
                  </div>

        <br><br>      
        <div class="proceed-footer-general-health group_<?php echo $questions[count($questions)-1]->group; ?>">
            <!-- <a href="<?php echo base_url('general_health_question/save_questions'); ?>"> -->
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <button type="submit" class="btn proceed-btn proceed-btn-general_health_question">Click to proceed</button>
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