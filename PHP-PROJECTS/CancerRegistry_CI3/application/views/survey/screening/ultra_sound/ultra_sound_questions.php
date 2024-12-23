<link rel="styleSheet" href="<?php echo base_url('assets/css/ScreeningQuestions.css') ?>" />

<div class="container">
        <div class="back-container">
            <span class="position-relative"><ion-icon name="chevron-back-outline"></ion-icon></span>
            <p ><a href="<?php echo base_url('ultra_sound_ultra_sound'); ?>">Back</a></p>
        </div>
        
        <h1 class="screeningHeader">POINT OF CARE ULTRASOUND (POCUS)
        </h1>  
    </div>
    <div class="question-container mt-5">
        <div class="questions-section mt-5">
          <form action="<?php echo base_url('screening/save_ultra_sound'); ?>" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="assessment_header_id" value="<?php echo $assessment_header_id; ?>">
            <div class="row">
                <div class="col-md-8 mb-2">
                    <p>Please choose only one option:</p>
                    <?php if(!empty($questions)){
                            foreach ($questions as $key => $question) { ?>
                  <div class="row">
                    <p><?php echo $question->q_no.". ", $question->questionnaire; ?></p>
                      <?php if($question->q_no == 1){ ?>
                            <div class="col-md-8">
                                <div class=" ">
                                    <input type="text" name="<?php echo $question->id ?>[]" class="form-control" id="exampleFormControlInput1" placeholder="HCP Name" required="true">
                                  </div>
                                </div>
                      <?php } else if($question->q_no == 2){ ?>
                              <div class="col-md-8">
                              <div class="form">
                                  <select name="<?php echo $question->id ?>[]" class="form-select" aria-label="Default select example">
                                      <option selected>Doctor</option>
                                      <option value="1">Nurse</option>
                                      <option value="1">Others</option>

                                    </select>
                                    </div>
                                  </div>
                      <?php } else if($question->q_no == 3){ ?>
                                  <div class="col-md-8">
                                      <div class=" ">
                                          <input type="text" name="<?php echo $question->id ?>[]" class="form-control" id="exampleFormControlInput1" placeholder="Registration Number of HCP" required="true">
                                        </div>
                                      </div>
                      <?php } else if($question->q_no == 4){ ?>
                                    <div class="col-md-8">
                                        <div class=" ">
                                            <input type="text" name="<?php echo $question->id ?>[]" class="form-control" id="exampleFormControlInput1" placeholder="institution POCUS was performed at" required="true">
                                          </div>
                                        </div>
                      <?php } else if($question->q_no == 5){ ?>
                                  <div class="col-md-8">
                                  <div class="form">
                                      <select name="<?php echo $question->id ?>[]" class="form-select" aria-label="Default select example">
                                          <option selected>Normal</option>
                                          <option value="1">Abnormal</option>
                                        </select>
                                        </div>
                                      </div>
                      <?php } else if($question->q_no == 6){ ?>
                                  <div class="col-md-8">
                                  <div class="form">
                                      <div class="mb-3">
                                          <input name="<?php echo $question->id ?>[]" class="form-control" type="file" id="formFile" required="true">
                                        </div>
                                        </div>
                                      </div>
                        <?php } ?>

                    </div>
                    
              <?php } } ?>
                  
                </div>
                </div>

      
        <div class="proceed-footer-coloretal">
            <!-- <a href="<?php echo base_url('screening/ultra_sound/success_full'); ?>"> -->
                <button class="btn proceed-btn-coloratal">Click to proceed</button>
            <!-- </a> -->
            <p class="footer-risk"> Malaysia Health Technology Assessment Section ( MaHTAS ). Clinical Practice Guidelines: management of colorectal carcinoma.
                Ministry of Health Malaysia [Internet]. 2017 [cited 11 November 2021]. MOH/P/PAK/352.17(GU).
</p>
        </div>
    </div>