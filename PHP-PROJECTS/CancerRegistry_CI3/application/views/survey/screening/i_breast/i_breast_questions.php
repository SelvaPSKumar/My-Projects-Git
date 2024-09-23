<link rel="styleSheet" href="<?php echo base_url('assets/css/ScreeningQuestions.css') ?>" />

<style type="text/css">
  @media only screen and (max-width: 568px){
    .box-inputs {
      max-width: 100vw !important;
    } 
  }
</style>

<div class="container" style="margin-top: 50px">
        <div class="back-container">
            <p ><a href="<?php echo base_url('i_breast_examination'); ?>">
            <button class="btn next-btn float-end"><span class="prev-icon"><ion-icon name="chevron-back-outline"></ion-icon></span> Back</button>
            
          </a></p>
        </div>
        
        <h1 class="screeningHeader">iBREAST EXAMINATION</h1>  
    </div>
    <div class="question-container mt-5">
        <div class="questions-section mt-5">
          <form action="<?php echo base_url('save_i_breast_questions'); ?>" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="assessment_header_id" value="<?php echo $assessment_header_id; ?>">
              <div class="row">
                <div class="col-md-8 mb-2">
                    <p>Please choose only one option:</p>
                    <?php if(!empty($questions)){
                            foreach ($questions as $key => $question) { 
                              // pre($question);
                              ?>
                            
                              <div class="row">
                                <!-- <p><?php echo $question->q_no.". ", $question->questionnaire; ?></p> -->

                                <?php if($question->input_type == INPUT_TYPE_TEXT || $question->input_type == INPUT_TYPE_NUMBER || $question->input_type == INPUT_TYPE_DATE || $question->input_type == INPUT_TYPE_TIME || $question->input_type == INPUT_TYPE_FILE ) { 
                                  if($question->input_type == INPUT_TYPE_FILE) { ?>
                                          <div class="col-md-8">
                                              <div class="form-group">
                                                
                                                <label><?php echo $question->q_no.". ", $question->questionnaire; ?></label>
                                                <div class="<?php echo $question->group;  ?>">
                                                  <input type="<?php echo $question->input_type; ?>" class="form-control" name="<?php echo $question->id ?>" id="exampleFormControlInput1" placeholder="<?php echo $question->placeholder; ?>" required="true">
						  <div class="text-secondary">Allowed Types are Images and PDF. File size should not exceed 15mb.</div>
                                                </div>
                                              </div>
                                          </div>
                                        <?php } else { ?>
                                          <div class="col-md-8">
                                              <div class="form-group">
                                                
                                                <label><?php echo $question->q_no.". ", $question->questionnaire; ?></label>
                                                <div class="<?php echo $question->group;  ?>">
                                                  <input type="<?php echo $question->input_type; ?>" class="form-control" name="<?php echo $question->id ?>[]" id="exampleFormControlInput1" placeholder="<?php echo $question->placeholder; ?>" required="true">
                                                </div>
                                              </div>
                                          </div>
                                        <?php } ?>
                                <?php } else if($question->input_type == INPUT_TYPE_RADIO){ ?>
                                            <div class="col-md-8 mb-2 <?php echo $question->group;  ?>">
                                              <label><?php echo $question->q_no.". ", $question->questionnaire; ?></label>
                                              <div class="yes-no-section">
                                                <div class=" mb-2">
                                                  <input class="" type="radio" name="<?php echo $question->id ?>[]" value="yes">
                                                  <label>Yes</label>
                                                </div>
                                                <div class=" mb-2">
                                                  <input class="" type="radio"  name="<?php echo $question->id ?>[]" value="no">
                                                  <label>No</label>
                                                </div>
                                              </div>
                                            </div>
                                <?php } else if($question->input_type == INPUT_TYPE_CHECKBOX){ ?>
                                          <div class="box-inputs mb-2 <?php echo $question->group;  ?>" style="width: 140%;">
                                              <label><?php echo $question->q_no.". ", $question->questionnaire; ?></label>
                                          <div class="row">
                                            <div class="col-6">
                                              <input type="hidden" class="" name="<?php echo $question->id ?>[]" id="" >
                                              <input type="<?php echo $question->input_type; ?>" class="form-check-input" style="font-size:30px" name="ibreast_test_findings[right_breast_1]" id="" >
                                              <input type="<?php echo $question->input_type; ?>" class="form-check-input" style="font-size:30px" name="ibreast_test_findings[right_breast_2]" id="" >
                                              <input type="<?php echo $question->input_type; ?>" class="form-check-input" style="font-size:30px" name="ibreast_test_findings[right_breast_3]" id="" >
                                              <input type="<?php echo $question->input_type; ?>" class="form-check-input" style="font-size:30px" name="ibreast_test_findings[right_breast_4]" id="" ><br>
                                              <input type="<?php echo $question->input_type; ?>" class="form-check-input" style="font-size:30px" name="ibreast_test_findings[right_breast_5]" id="" >
                                              <input type="<?php echo $question->input_type; ?>" class="form-check-input" style="font-size:30px" name="ibreast_test_findings[right_breast_6]" id="" >
                                              <input type="<?php echo $question->input_type; ?>" class="form-check-input" style="font-size:30px" name="ibreast_test_findings[right_breast_7]" id="" >
                                              <input type="<?php echo $question->input_type; ?>" class="form-check-input" style="font-size:30px" name="ibreast_test_findings[right_breast_8]" id="" ><br>
                                              <input type="<?php echo $question->input_type; ?>" class="form-check-input" style="font-size:30px" name="ibreast_test_findings[right_breast_9]" id="" >
                                              <input type="<?php echo $question->input_type; ?>" class="form-check-input" style="font-size:30px" name="ibreast_test_findings[right_breast_10]" id="" >
                                              <input type="<?php echo $question->input_type; ?>" class="form-check-input" style="font-size:30px" name="ibreast_test_findings[right_breast_11]" id="" >
                                              <input type="<?php echo $question->input_type; ?>" class="form-check-input" style="font-size:30px" name="ibreast_test_findings[right_breast_12]" id="" ><br>
                                              <input type="<?php echo $question->input_type; ?>" class="form-check-input" style="font-size:30px" name="ibreast_test_findings[right_breast_13]" id="" >
                                              <input type="<?php echo $question->input_type; ?>" class="form-check-input" style="font-size:30px" name="ibreast_test_findings[right_breast_14]" id="" >
                                              <input type="<?php echo $question->input_type; ?>" class="form-check-input" style="font-size:30px" name="ibreast_test_findings[right_breast_15]" id="" >
                                              <input type="<?php echo $question->input_type; ?>" class="form-check-input" style="font-size:30px" name="ibreast_test_findings[right_breast_16]" id="" >
                                          </div>

                                            <div class="col-6">
                                              <input type="<?php echo $question->input_type; ?>" class="form-check-input" style="font-size:30px" name="ibreast_test_findings[left_breast_1]" id="" >
                                              <input type="<?php echo $question->input_type; ?>" class="form-check-input" style="font-size:30px" name="ibreast_test_findings[left_breast_2]" id="" >
                                              <input type="<?php echo $question->input_type; ?>" class="form-check-input" style="font-size:30px" name="ibreast_test_findings[left_breast_3]" id="" >
                                              <input type="<?php echo $question->input_type; ?>" class="form-check-input" style="font-size:30px" name="ibreast_test_findings[left_breast_4]" id="" ><br>
                                              <input type="<?php echo $question->input_type; ?>" class="form-check-input" style="font-size:30px" name="ibreast_test_findings[left_breast_5]" id="" >
                                              <input type="<?php echo $question->input_type; ?>" class="form-check-input" style="font-size:30px" name="ibreast_test_findings[left_breast_6]" id="" >
                                              <input type="<?php echo $question->input_type; ?>" class="form-check-input" style="font-size:30px" name="ibreast_test_findings[left_breast_7]" id="" >
                                              <input type="<?php echo $question->input_type; ?>" class="form-check-input" style="font-size:30px" name="ibreast_test_findings[left_breast_8]" id="" ><br>
                                              <input type="<?php echo $question->input_type; ?>" class="form-check-input" style="font-size:30px" name="ibreast_test_findings[left_breast_9]" id="" >
                                              <input type="<?php echo $question->input_type; ?>" class="form-check-input" style="font-size:30px" name="ibreast_test_findings[left_breast_10]" id="" >
                                              <input type="<?php echo $question->input_type; ?>" class="form-check-input" style="font-size:30px" name="ibreast_test_findings[left_breast_11]" id="" >
                                              <input type="<?php echo $question->input_type; ?>" class="form-check-input" style="font-size:30px" name="ibreast_test_findings[left_breast_12]" id="" ><br>
                                              <input type="<?php echo $question->input_type; ?>" class="form-check-input" style="font-size:30px" name="ibreast_test_findings[left_breast_13]" id="" >
                                              <input type="<?php echo $question->input_type; ?>" class="form-check-input" style="font-size:30px" name="ibreast_test_findings[left_breast_14]" id="" >
                                              <input type="<?php echo $question->input_type; ?>" class="form-check-input" style="font-size:30px" name="ibreast_test_findings[left_breast_15]" id="" >
                                              <input type="<?php echo $question->input_type; ?>" class="form-check-input" style="font-size:30px" name="ibreast_test_findings[left_breast_16]" id="" >
                                            </div>
                                            
                                          </div>

                                        </div>
                                <?php } else if($question->input_type == INPUT_TYPE_SELECT){ ?>
                                  <div class="col-md-8 <?php echo $question->group;  ?>">
                                              <label><?php echo $question->q_no.". ", $question->questionnaire; ?></label>
                                            <?php if ($question->q_no == 2) { ?>
                                              <div class="form">
                                              <select class="form-select" name="<?php echo $question->id ?>[]" aria-label="Default select example">
                                                  <option selected value="Doctor">Doctor</option>
                                                  <option value="Nurse">Nurse</option>
                                                  <option value="Others">Others</option>

                                              </select>
                                            </div>
                                            <?php } else if($question->q_no == 5) { ?>
                                              <div class="form">
                                              <select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
                                                <option selected value="">Please select Symptoms</option>
                                                <?php if (!empty($symptoms)) {
                                                  foreach ($symptoms as $key => $value) { ?>
                                                <option value="<?php echo $value->id; ?>"><?php echo $value->symptom; ?></option>
                                                    
                                                  <?php }
                                                } ?>
                                              </select>
                                            </div>
                                            <?php } else if($question->q_no == 10) { ?>
                                              <div class="form">
                                              <select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
                                                <option selected value="">Please select finding</option>
                                                <option value="None">None</option>
                                                <option value="Upper outer">Upper outer</option>
                                                <option value="Lower outer">Lower outer</option>
                                                <option value="Upper inner">Upper inner</option>
                                                <option value="Lower inner">Lower inner</option>
                                                <option value="Around Areola">Around Areola</option>
                                             
                                              </select>
                                            </div>
                                             <?php } else if($question->q_no == 11) { ?>
                                              <div class="form">
                                              <select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
                                                <option selected value="">Please select finding</option>
                                                <option value="None">None</option>
                                                <option value="Upper outer">Upper outer</option>
                                                <option value="Lower outer">Lower outer</option>
                                                <option value="Upper inner">Upper inner</option>
                                                <option value="Lower inner">Lower inner</option>
                                                <option value="Around Areola">Around Areola</option>
                                             
                                              </select>
                                            </div>
                                             <?php } else if($question->q_no == 12) { ?>
                                              <div class="form">
                                              <select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
                                                <option selected value="">Please select result</option>
                                                <option value="Normal">Normal</option>
                                                <option value="Abnormal">Abnormal</option>
                                              </select>
                                            </div>
                                            
                                            <?php } ?>
                                          </div>
                                <?php } else if($question->input_type == INPUT_TYPE_TEXTAREA){ ?>
                                          <div class="col-md-8">
                                          <div class="form-group">
                                              <label><?php echo $question->q_no.". ", $question->questionnaire; ?></label><br>

                                           <textarea name="<?php echo $question->id ?>[]" cols="50" rows="8"></textarea>
                                          </div>
                                        </div>
                                <?php } ?>
                              </div>


                    <?php } } ?>
                </div>
                </div>
      
        <div class="proceed-footer-coloretal">
                    <?php 
                        $date = new DateTime($assessment_header_data->assessment_date);
                        $date->modify('+12 month'); 
                        $next_assessment_date = $date->format('d-m-Y');
                        $next_assessment_date_ymd = $date->format('Y-m-d')
                    ?>
            <!-- <a href="<?php echo base_url('screening/i_breast/success_full'); ?>"> -->
        <p>Next Assessment Date: <?php echo $next_assessment_date;  ?></p>
                    <input type="hidden" name="next_assesment_date" value="<?php echo $next_assessment_date_ymd; ?>">
                <button class="btn proceed-btn-coloratal">Click to proceed</button>
            <!-- </a> -->
            <p class="footer-risk"> Malaysia Health Technology Assessment Section ( MaHTAS ). Clinical Practice Guidelines: management of colorectal carcinoma.
                Ministry of Health Malaysia [Internet]. 2017 [cited 11 November 2021]. MOH/P/PAK/352.17(GU).
</p>
        </div>
            </form>

    </div>
