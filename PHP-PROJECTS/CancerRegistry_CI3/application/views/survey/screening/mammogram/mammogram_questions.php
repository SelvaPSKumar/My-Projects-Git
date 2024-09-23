<link rel="styleSheet" href="<?php echo base_url('assets/css/ScreeningQuestions.css') ?>" />

<div class="container">
        <div class="back-container">
            <a href="<?php echo base_url('mammogram_ultra_sound'); ?>">
            <button class="btn next-btn float-end"><span class="prev-icon"><ion-icon name="chevron-back-outline"></ion-icon></span> Back</button>
                
            </a>
        </div>
        
        <h1 class="screeningHeader">MAMMOGRAM</h1>  

    </div>
    <div class="question-container mt-5">
        <div class="questions-section mt-5">
          <form action="<?php echo base_url('save_mammogram_questions'); ?>" method="POST" enctype="multipart/form-data">
                   <input type="hidden" name="assessment_types_id" value="<?php echo $assessment_types_id ?>">
        <input type="hidden" name="assessment_tools_id" value="<?php echo $assessment_tools_id ?>">
              <input type="hidden" name="assessment_header_id" value="<?php echo $assessment_header_id; ?>">
            <div class="row">
                <div class="col-md-8 mb-2">
              <?php if(!empty($questions)){
                            foreach ($questions as $key => $question) { ?>
                      <?php if($question->q_no == 1){ ?>
                                <p>Please choose only one option:</p>
                                <p><?php echo $question->q_no.". ", $question->questionnaire; ?></p>

                                <div class="col-md-8">
                                    <div class=" ">
                                        <input type="text" name="<?php echo $question->id ?>[]" class="form-control" id="exampleFormControlInput1" placeholder="HCP Name" required="true">
                                      </div>
                                    </div>
                      <?php } else if($question->q_no == 2){ ?>
                                <p><?php echo $question->q_no.". ", $question->questionnaire; ?></p>
                                  <div class="col-md-8">
                                  <div class="form">
                                      <select name="<?php echo $question->id ?>[]" class="form-select" aria-label="Default select example">
                                          <option selected value="Doctor">Doctor</option>
                                          <option value="Nurse">Nurse</option>
                                          <option value="Others">Others</option>

                                        </select>
                                        </div>
                                      </div>
                      <?php } else if($question->q_no == 3){ ?>
                                <p><?php echo $question->q_no.". ", $question->questionnaire; ?></p>
                    <div class="col-md-8">
                        <div class=" ">
                            <input type="text" name="<?php echo $question->id ?>[]" class="form-control" id="exampleFormControlInput1" placeholder="Registration Number of HCP" required="true">
                          </div>
                        </div>
                      <?php } else if($question->q_no == 4){ ?>
                                <p><?php echo $question->q_no.". ", $question->questionnaire; ?></p>
                    <div class="col-md-8">
                        <div class=" ">
                            <input type="text" name="<?php echo $question->id ?>[]" class="form-control" id="exampleFormControlInput1" placeholder="Institution mammogram was performed at" required="true">
                          </div>
                        </div>
                 
                      <?php } else if($question->q_no == 5){ ?>
                                <p><?php echo $question->q_no.". ", $question->questionnaire; ?></p>
                                <div class="col-md-8">
                        <div class=" ">
                            <input type="date" name="<?php echo $question->id ?>[]" max="<?php echo date("Y-m-d"); ?>" class="form-control" id="" value="" required="true">
                          </div>
                        </div>
              <?php } } } ?>

                </div>
                </div>

      
        <div class="proceed-footer-coloretal">
            <!-- <a href="<?php echo base_url('screening/mammogram/one'); ?>"> -->
                <button class="btn proceed-btn-coloratal">Click to proceed</button>
            <!-- </a> -->
            <p class="footer-risk"> Malaysia Health Technology Assessment Section ( MaHTAS ). Clinical Practice Guidelines: management of colorectal carcinoma.
                Ministry of Health Malaysia [Internet]. 2017 [cited 11 November 2021]. MOH/P/PAK/352.17(GU).
</p>
        </div>
      </form>
    </div>
