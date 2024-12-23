<link rel="styleSheet" href="<?php echo base_url('assets/css/ScreeningQuestions.css') ?>" />

<div class="container">
    <div class="back-container">
            <a onclick="window.history.go(-1); return false;" >
                <button class="btn next-btn float-end">
                    <span class="prev-icon">
                        <ion-icon name="chevron-back-outline" role="img" class="md hydrated" aria-label="back outline">                            
                        </ion-icon>
                    </span> 
                    Back
                </button>

            </a>
    </div>

        <h1 class="screeningHeader">CLINICAL ULTRASOUND</h1>  
    </div>
    <div class="question-container mt-5">
        <div class="prev-next-btn mb-4">
        <!-- <div class="row">
            <div class="col-6">
                <div class="">
                    <button class="btn prev-btn" disabled>
                        <span class="prev-icon"><ion-icon name="chevron-back-outline"></ion-icon></span>
                        Previous</button>
                </div>
            </div>
            <div class="col-6">
                <div class="">
                    <a href="./QuestionTwo.html">
                        <button class="btn next-btn float-end">
                            Next <span class="next-icon"><ion-icon name="chevron-forward-outline"></ion-icon></span>
                        </button>
                    </a>
                </div>
            </div>
        </div> -->
        </div>
        <hr />


        <form action="<?php echo base_url('save_clinical_ultra_sound1'); ?>" method="POST" id="clinical_ultrasound" enctype="multipart/form-data">
            <input type="hidden" name="assessment_header_id" value="<?php echo $assessment_header_id ?>">
            <div class="questions-section mt-5">
                <?php if (!empty($questions)) {
                        foreach ($questions as $key => $question) { 
                    ?>
                            <div class="row">
                                <?php if($question->q_no == 6){ ?>

                                    <div class="col-md-8 mb-2">
                                    <h6><?php echo $question->q_no . ". ", $question->questionnaire;   ?></h6>
                                    <!-- <p>Please answer accordingly</p> -->
                                    <div class="yes-no-section">
                                        <div class=" mb-2">
                                            <input class="" type="radio" name="<?php echo $question->id ?>[]" value="yes" id="flexRadioDefault1">
                                            <label class="" for="flexRadioDefault1">
                                              Yes
                                            </label>
                                          </div>
                                          <div class=" mb-2">
                                            <input class="" type="radio"  name="<?php echo $question->id ?>[]" value="no" id="flexRadioDefault2" >
                                            <label class="" for="flexRadioDefault2">
                                              No
                                            </label>
                                          </div>
                                    </div>
                                </div>
                                <?php }else if($question->q_no == 7){ ?>


                                <div class="col-md-8 mb-2">
                                    <h6><?php echo $question->q_no . ". ", $question->questionnaire;   ?></h6>
                                    <!-- <p>Please answer accordingly</p> -->
                                    <div class="yes-no-section">
                                        <div class=" mb-2">
                                            <input class="" type="radio" name="<?php echo $question->id ?>[]" value="yes" id="flexRadioDefault1">
                                            <label class="" for="flexRadioDefault1">
                                              Yes
                                            </label>
                                          </div>
                                          <div class=" mb-2">
                                            <input class="" type="radio"  name="<?php echo $question->id ?>[]" value="no" id="flexRadioDefault2" >
                                            <label class="" for="flexRadioDefault2">
                                              No
                                            </label>
                                          </div>
                                    </div>
                                </div>



                                
                                <div class="col-md-4">
                                    <!-- <div class="question-image-container">
                                        <img src="../assets/image 8.svg" class="questionSideImage" />
                                   </div> -->
                                </div>
                          <?php } else if($question->q_no == 8){ ?>

                                <div class="col-md-8 mb-2">
                                    <h6><?php echo $question->q_no . ". ", $question->questionnaire;   ?></h6>
                                    <p>Please answer accordingly</p>
                                    <div class="yes-no-section">
                                                <select name="<?php echo $question->id ?>[]" class="form-select" aria-label="Default select example" name="form-selection">
                                                    <option selected value="">Please select one option only</option>
                                                    <option value="Homogenous background echotexture – fat​">Homogenous background echotexture – fat​</option>
                                                    <option value="Homogenous background echotexture – fibroglandular">Homogenous background echotexture – fibroglandular</option>
                                                    <option value="Heteregenous background echotexture">Heteregenous background echotexture</option>

                                                  </select>
                                                  <!-- <div class="col-md-4">
                                                    <a href="../ScreeningQuestions/ScreeningQuestionTwo.html">
                                                    <button class="btn submit-btn">Submit</button> </a>
                                                  </div> -->
                                            </div>
                                </div>
                          <?php } else if($question->q_no == 9){ ?>
                                        <div class="col-md-8 mb-2">
                                    <p>Please answer accordingly</p>
                                    <h6><?php echo $question->q_no . ". ", $question->questionnaire;   ?></h6>
                                            <div class="yes-no-section">
                                                <select name="<?php echo $question->id ?>[]" class="form-select" aria-label="Default select example" name="form-selection">
                                                    <option selected value="">Please select one option only</option>
                                                    <option value="BIRADS 0">BIRADS 0</option>
                                                    <option value="BIRADS 1">BIRADS 1</option>
                                                    <option value="BIRADS 2">BIRADS 2</option>
                                                    <option value="BIRADS 3">BIRADS 3</option>
                                                    <option value="BIRADS 4">BIRADS 4</option>
                                                    <option value="BIRADS 5">BIRADS 5</option>
                                                    <option value="BIRADS 6">BIRADS 6</option>
                                                  </select>
                                                  <!-- <div class="col-md-4">
                                                    <a href="../ScreeningQuestions/ScreeningQuestionTwo.html">
                                                    <button class="btn submit-btn">Submit</button> </a>
                                                  </div> -->
                                            </div>
                                        </div>
                          <?php } else if($question->q_no == 10){ ?>
                                        <div class="col-md-8 mb-2">
                                    <p>Please answer accordingly</p>
                                    <h6><?php echo $question->q_no . ". ", $question->questionnaire;   ?></h6>
                                            <div class="yes-no-section">
                                                <select name="<?php echo $question->id ?>[]" class="form-select" aria-label="Default select example" name="form-selection">
                                                    <option selected value="">Please select one option only</option>
                                                    <option value="Homogenous background echotexture – fat​">Homogenous background echotexture – fat​</option>
                                                    <option value="Homogenous background echotexture – fibroglandular">Homogenous background echotexture – fibroglandular</option>
                                                    <option value="Heteregenous background echotexture">Heteregenous background echotexture</option>
                                                  </select>
                                                  <!-- <div class="col-md-4">
                                                    <a href="../ScreeningQuestions/ScreeningQuestionTwo.html">
                                                    <button class="btn submit-btn">Submit</button> </a>
                                                  </div> -->
                                            </div>
                                        </div>
                          <?php } else if($question->q_no == 11){ ?>
                                        <div class="col-md-8 mb-2">
                                    <p>Please answer accordingly</p>
                                    <h6><?php echo $question->q_no . ". ", $question->questionnaire;   ?></h6>
                                            <div class="yes-no-section">
                                                <select name="<?php echo $question->id ?>[]" class="form-select" aria-label="Default select example" name="form-selection">
                                                    <option selected value="">Please select one option only</option>
                                                    <option value="BIRADS 0">BIRADS 0</option>
                                                    <option value="BIRADS 1">BIRADS 1</option>
                                                    <option value="BIRADS 2">BIRADS 2</option>
                                                    <option value="BIRADS 3">BIRADS 3</option>
                                                    <option value="BIRADS 4">BIRADS 4</option>
                                                    <option value="BIRADS 5">BIRADS 5</option>
                                                    <option value="BIRADS 6">BIRADS 6</option>                           
                                                  </select>
                                                  <!-- <div class="col-md-4">
                                                    <a href="../ScreeningQuestions/ScreeningQuestionTwo.html">
                                                    <button class="btn submit-btn">Submit</button> </a>
                                                  </div> -->
                                            </div>
                                        </div>
                        <?php } else if($question->q_no == 12){ ?>
                                        <div class="col-md-8 mb-2">
                                    <p>Please answer accordingly</p>
                                    <h6><?php echo $question->q_no . ". ", $question->questionnaire;   ?></h6>
                                            <div class="yes-no-section">
                                                <select name="<?php echo $question->id ?>[]" class="form-select" aria-label="Default select example" name="form-selection">
                                                    <option selected value="">Please select one option only</option>
                                                    <option value="None">None</option>
                                                    <option value="Present">Present</option>
                                                  </select>
                                                  <!-- <div class="col-md-4">
                                                    <a href="../ScreeningQuestions/ScreeningQuestionTwo.html">
                                                    <button class="btn submit-btn">Submit</button> </a>
                                                  </div> -->
                                            </div>
                                        </div>
                            <?php } else if($question->q_no == 13){ ?>
                                        <div class="col-md-8 mb-2">
                                    <p>Please answer accordingly</p>
                                    <h6><?php echo $question->q_no . ". ", $question->questionnaire;   ?></h6>
                                            <div class="yes-no-section">
                                                <textarea cols="50" rows="10" name="<?php echo $question->id ?>[]"></textarea>
                                            </div>
                                        </div>
                                        <?php } else if($question->q_no == 14){ ?>
                                        <div class="col-md-8 mb-2">
                                    <p>Please answer accordingly</p>
                                    <h6><?php echo $question->q_no . ". ", $question->questionnaire;   ?></h6>
                                            <div class="yes-no-section">
                                                <select name="<?php echo $question->id ?>[]" class="form-select" aria-label="Default select example" name="form-selection">
                                                    <option selected value="">Please select one option only</option>
                                                    <option value="Symptomatic patient">Symptomatic patient</option>
                                                    <option value="Routine screening">Routine screening</option>
                                                  </select>
                                                 
                                            </div>
                                        </div>
                                        <?php } else if($question->q_no == 15){ ?>
                                        <div class="col-md-8 mb-2">
                                    <p>Please answer accordingly</p>
                                    <h6><?php echo $question->q_no . ". ", $question->questionnaire;   ?></h6>
                                            <div class="col-md-8">
                          <div class="form">
                              <div class="mb-3">
                                  <input name="<?php echo $question->id ?>" class="form-control" type="file" id="formFile" required="true">
				  <div class="text-secondary">Allowed Types are Images and PDF. File size should not exceed 15mb.</div>
                                </div>
                                </div>
                              </div>
                                        </div>
                            <?php } ?>
                                   
                            </div>

                    <?php } } ?>
                <div class="row mt-2 text-center">
                        <?php 
                        $date = new DateTime($assessment_header_data->assessment_date);
                        $date->modify('+12 month'); 
                        $next_assessment_date = $date->format('d-m-Y');
                        $next_assessment_date_ymd = $date->format('Y-m-d')
                    ?>
                     <p>Next Assessment Date: <?php echo $next_assessment_date;  ?></p>
                    <input type="hidden" name="next_assesment_date" value="<?php echo $next_assessment_date_ymd; ?>">

                        <!-- <a href="<?php echo base_url('screening/clinical_ultra_sound/two'); ?>"> -->
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                        <button class="btn submit-btn w-100" id="submit_btn">Submit</button> 
                    <!-- </a> -->
                      </div>
                      <div class="col-md-4"></div> 
                </div>
            </div>
        </form>
      
    </div>

    <script>
        $("#submit_btn").on('click', function(e){
            e.preventDefault();
            var radios=0;
            $("#clinical_ultrasound").find(':radio').each(function(){
               radios++;
            });

            var checked_radios=0;
            $("#clinical_ultrasound").find(':radio:checked').each(function(){
               checked_radios++;
            });

            radios_length = radios/2;
            checked_radios_length = checked_radios;

            if (radios_length != checked_radios_length) {
                alert("Please fill all fields!");
                return false;
            }


        var form = document.querySelector('#clinical_ultrasound');
        const formData = new FormData(form);
        var response =true;
        formData.forEach(function(value, key){
            
            if (value=='') {
                response = false;
            }

        });
            if (response == false) {
                alert("Please answer to all questions to proceed!");
                return false;

            } else {
                $('#clinical_ultrasound').unbind('submit').submit();
            }

        });
    </script>
