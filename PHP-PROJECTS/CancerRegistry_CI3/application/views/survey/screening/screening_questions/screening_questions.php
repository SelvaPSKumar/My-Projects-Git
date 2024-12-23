<link rel="styleSheet" href="<?php echo base_url('assets/css/ScreeningQuestions.css'); ?>" />
<link rel="styleSheet" href="<?php echo base_url('assets/css/progress_bar.css'); ?>" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="container">
        <h1 class="screeningHeader">Breast Cancer Symptom Assessment Tool</h1>  
    </div>
    <div class="question-container mt-5">
        <div class="prev-next-btn mb-4">
            <div class="headernode row">
                <div class="col">
                    <div class="">
                        <button class="btn prev-btn" id="previous">
                            <span class="prev-icon"><ion-icon name="chevron-back-outline"></ion-icon></span>
                            Previous</button>
                    </div>
                </div>
                <div class="col hide_progress_responsive">
                    <!-- <div class="container"> -->
                        <div class="card">
                            <ul class="progress_bar screening_questions">
                                <li class="active left">Left Breast</li>
                                <li class=" right">Right Breast</li>
                                <li class=" completed">Completed</li>
                            </ul>
                        </div>
                        
                    <!-- </div> -->
                </div>
                <div class="col">
                    <div class="">
                        <!-- <a href="../ScreeningQuestions/ScreeningQuestionTwo.html"> -->
                            <button class="btn next-btn float-end" id="next">
                                Next <span class="next-icon"><ion-icon name="chevron-forward-outline"></ion-icon></span>
                                <input type="hidden" name="" value="left" id="current_page">
                            </button>
                        <!-- </a> -->
                    </div>
                </div>
            </div>
        </div>
        <hr />

        <form action="<?php echo base_url('save_screening_questions'); ?>" method="POST">
            <input type="hidden" name="assessment_header_id" value="<?php echo $assessment_header_id ?>">
            <div class="questions-section mt-5" id="left_breast">
                <?php if (!empty($questions)) {
                    foreach ($questions as $key => $question) { 
                        if ($question->group == 'left') {
                ?>
                        
                        <div class="row ques<?php echo $question->q_no; ?>" >
                            <div class="col-md-8 mb-2">
                                <h6><?php echo $question->q_no . ". ", $question->questionnaire;   ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></h6>
                                <?php if($question->input_type == 'checkbox') { ?>
                                    <p>Please tick any one of the options</p>
                                    <div class="yes-no-section">
                                        <div class=" mb-2">

                                        <?php 
                                        $option_inc = 1;
                                        $input_values = explode('|', $question->input_values);
                                        foreach($input_values as $input_value) {
                                        ?>
                                        <div class=" mb-2">
                                            <input class="question<?php echo $question->q_no; ?>" type="checkbox" name="<?php echo $question->id ?>[]" value="<?php echo $input_value; ?>" id="flexRadioDefault<?php echo $option_inc; ?>">
                                            <label class="" for="flexRadioDefault<?php echo $option_inc; ?>">
                                              <?php echo ucfirst($input_value); ?>
                                            </label>
                                          </div>
                                        <?php $option_inc++; } ?>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                <p>Please tick Yes or No</p>
                                <div class="yes-no-section">
                                    <div class=" mb-2">
                                        <input class="question<?php echo $question->q_no; ?>" type="radio" name="<?php echo $question->id ?>[]" value="yes" id="flexRadioDefault1">
                                        <label class="" for="flexRadioDefault1">
                                          Yes
                                        </label>
                                      </div>
                                      <div class=" mb-2">
                                        <input class="question<?php echo $question->q_no; ?>" type="radio"  name="<?php echo $question->id ?>[]" value="no" id="flexRadioDefault2" >
                                        <label class="" for="flexRadioDefault2">
                                          No
                                        </label>
                                      </div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="col-md-4">
                                <div class="question-image-container">
                                    <img src="<?php echo base_url('assets/img/breast/image'); echo " ".$question->q_no.".svg"; ?>" class="questionSideImage" />
                               </div>
                            </div>
                        </div>

                <?php } } } ?>
            </div>

            <div class="questions-section mt-5" id="right_breast" style="display: none">
                <?php if (!empty($questions)) {
                    // pre($questions);
                    foreach ($questions as $key => $question) { 
                        if ($question->group == 'right') {
                ?>
                        
                        <div class="row ques<?php echo $question->q_no; ?>">
                            <div class="col-md-8 mb-2">
                                <h6><?php echo $question->q_no . ". ", $question->questionnaire;   ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></h6>
                                 <?php if($question->input_type == 'checkbox') { ?>
                                    <p>Please tick any one of the options</p>
                                    <div class="yes-no-section">
                                        <?php 
                                        $option_inc = 1;
                                        $input_values = explode('|', $question->input_values);
                                        foreach($input_values as $input_value) {
                                        ?>
                                        <div class=" mb-2">
                                            <input class="question<?php echo $question->q_no; ?>" type="checkbox" name="<?php echo $question->id ?>[]" value="<?php echo $input_value; ?>" id="flexRadioDefault<?php echo $option_inc; ?>">
                                            <label class="" for="flexRadioDefault<?php echo $option_inc; ?>">
                                              <?php echo ucfirst($input_value); ?>
                                            </label>
                                          </div>
                                        <?php $option_inc++; } ?>
                                    </div>
                                <?php } else { ?>
                                <p>Please tick Yes or No</p>
                                <div class="yes-no-section">
                                    <div class=" mb-2">
                                        <input class="question<?php echo $question->q_no; ?>" type="radio" name="<?php echo $question->id ?>[]" value="yes" id="flexRadioDefault1">
                                        <label class="" for="flexRadioDefault1">
                                          Yes
                                        </label>
                                      </div>
                                      <div class=" mb-2">
                                        <input class="question<?php echo $question->q_no; ?>" type="radio"  name="<?php echo $question->id ?>[]" value="no" id="flexRadioDefault2" >
                                        <label class="" for="flexRadioDefault2">
                                          No
                                        </label>
                                      </div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="col-md-4">
                                <div class="question-image-container breast_images">
                                    <img src="<?php echo base_url('assets/img/breast/image'); echo " ".$question->q_no.".svg"; ?>" class="questionSideImage" />
                               </div>
                            </div>
                        </div>

                <?php } } } ?>

            </div>
            <div class="questions-section mt-5" id="completed_breast" style="display: none">
                <div class="text-center">
                    <?php 
                        $date = new DateTime($assessment_header_data->assessment_date);
                        $date->modify('+1 month'); // or you can use '-90 day' for deduct
                        $next_assessment_date = $date->format('d-m-Y');
                        $next_assessment_date_ymd = $date->format('Y-m-d');
                    ?>
                    <p>This will be the final assessment submission. Are you sure?</p>
                    <p>Next Assessment Date: <?php echo $next_assessment_date;  ?></p>
                    <input type="hidden" name="next_assesment_date" value="<?php echo $next_assessment_date_ymd;  ?>">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <button class="btn submit-btn w-100" type="Submit">Complete</button>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </div>
            </div>

        </form>
        <hr />

        <div class="prev-next-btn mb-4">
            <div class="footernode row">
                <div class="col">
                    <div class="">
                        <button class="btn prev-btn" id="previous">
                            <span class="prev-icon"><ion-icon name="chevron-back-outline"></ion-icon></span>
                            Previous</button>
                    </div>
                </div>
                <div class="col hide_progress_responsive">
                    <!-- <div class="container"> -->
                        <div class="card">
                            <ul class="progress_bar screening_questions">
                                <li class="active left">Left Breast</li>
                                <li class="right">Right Breast</li>
                                <li class="completed">Completed</li> 
                            </ul>
                        </div>
                        
                    <!-- </div> -->
                </div>
                <div class="col">
                    <div class="">
                        <!-- <a href="../ScreeningQuestions/ScreeningQuestionTwo.html"> -->
                            <button class="btn next-btn float-end" id="next">
                                Next <span class="next-icon"><ion-icon name="chevron-forward-outline"></ion-icon></span>
                                <input type="hidden" name="" value="left" id="current_page">
                            </button>
                        <!-- </a> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="question-footer">
            <p> </p>
        </div>
    </div>
<script src="<?php echo base_url('assets/js/progress_bar.js'); ?>"></script>

<script>
     var tooltipList1 = [].slice.call(document.querySelectorAll('[data-bs-toggle = "tooltip"]'))
     var tooltipList2 = tooltipList1.map(function(tooltipTriggerfun) {
                                        return new bootstrap.Tooltip(tooltipTriggerfun)
    })
    $(document).ready(function(){
        $('.ques2').hide();
        $('.question1').on('click', 
            () => {  
                if( $('.question1:checked').val() == 'yes' ) {   
                        $('.ques2').show() ; 
                }  else {  
                    $(".question2").prop('checked', false); 
                    $('.ques2').hide() ;
                }   
            } 
        );
        $('.ques13').hide();
        $('.question12').on('click', 
            () => {  
                if( $('.question12:checked').val() == 'yes' ) {   
                        $('.ques13').show() ; 
                }  else { 
                    $(".question13").prop('checked', false);  
                    $('.ques13').hide() ;
                }   
            } 
        );
    });
</script>