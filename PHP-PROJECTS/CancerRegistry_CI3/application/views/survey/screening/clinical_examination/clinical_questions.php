<link rel="styleSheet" href="<?php echo base_url('assets/css/ScreeningQuestions.css') ?>" />
<link rel="styleSheet" href="<?php echo base_url('assets/css/breast_questions.css') ?>" />

<div class="container">
        <div class="back-container">
            <a href="<?php echo base_url('clinical_examination'); ?>"><button class="btn next-btn float-end"><span class="prev-icon"><ion-icon name="chevron-back-outline"></ion-icon></span> Back</button></a>
        </div>
        
        <h1 class="screeningHeader">CLINICAL BREAST EXAMINATION</h1>  
    </div>
    <div class="question-container mt-5">
      <div class="prev-next-btn mb-4 headnode">
        <div class="row">
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
                        <ul class="progress_bar clinical_questions">
                            <li class="active" id="group_1">Step</li>
                            <li id="group_2">Step</li>
                            <li id="group_3">Step</li>
                            <li id="group_4">Step</li>
                            <li id="group_5">Step</li>
                            <!-- <li id="group_6">Step</li> -->
                            <li id="completed">Completed</li> 
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



        <div class="questions-section mt-5">

            <form action="<?php echo base_url('screening/save_clinical_questions'); ?>" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="assessment_header_id" value="<?php echo $assessment_header_id; ?>">
              <div class="row">
                <div class="col-md-8 mb-2">
                    <p class="select-msg">Please choose only one option:</p>
                    <?php if(!empty($questions)){
                            foreach ($questions as $key => $question) { 
                              // pre($question);
                              ?>
                            
                              <div class="row">
                                <!-- <p><?php echo $question->q_no.". ", $question->questionnaire; ?></p> -->

                                <?php if($question->input_type == INPUT_TYPE_TEXT || $question->input_type == INPUT_TYPE_NUMBER || $question->input_type == INPUT_TYPE_DATE || $question->input_type == INPUT_TYPE_TIME || $question->input_type == INPUT_TYPE_FILE ) { ?>
                                          <div class="col-md-8 group_<?php echo $question->group;  ?> <?php echo "question".$question->q_no;  ?>">
                                            <div class="form-group">
                                              <label><?php echo $question->q_no.". ", $question->questionnaire; ?></label>
                                              <?php if ($question->input_type == INPUT_TYPE_FILE) { ?>
                                                <input type="<?php echo $question->input_type; ?>" class="form-control" name="<?php echo $question->id ?>" placeholder="<?php echo $question->placeholder; ?>">
                                                <div class="text-secondary">Allowed Types are Images and PDF. File size should not exceed 15mb.</div>
                                              <?php } else { ?>
                                                <input type="<?php echo $question->input_type; ?>" class="form-control" name="<?php echo $question->id ?>[]" placeholder="<?php echo $question->placeholder; ?>">

                                              <?php } ?>
                                            </div>
                                          </div>
                                <?php } else if($question->input_type == INPUT_TYPE_RADIO){ ?>
                                            <div class="col-md-8 mb-2 group_<?php echo $question->group;  ?>">
                                              <div class="form-group">
                                                <label><?php echo $question->q_no.". ", $question->questionnaire; ?></label>
                                                <div class="yes-no-section">
                                                  <div class=" mb-2">
                                                    <input class="<?php echo "question".$question->q_no;  ?>" type="radio" name="<?php echo $question->id ?>[]" value="yes">
                                                    <label>Yes</label>
                                                  </div>
                                                  <div class=" mb-2">
                                                    <input class="<?php echo "question".$question->q_no;  ?>" type="radio"  name="<?php echo $question->id ?>[]" value="no">
                                                    <label>No</label>
                                                  </div>
                                                </div>
                                              </div>
                                              
                                            </div>
                                <?php } else if($question->input_type == INPUT_TYPE_CHECKBOX){ ?>
                                          <div class="col-md-8 mb-2 group_<?php echo $question->group;  ?> <?php echo "question".$question->q_no;  ?>">
                                          <div class="form-group">
                                              <label><?php echo $question->q_no.". ", $question->questionnaire; ?></label>
                                              <input type="checkbox" class="form-control" name="<?php echo $question->id ?>[]"  placeholder="">
                                          </div>
                                        </div>
                                <?php } else if($question->input_type == INPUT_TYPE_SELECT){ ?>
                                  <div class="col-md-8 group_<?php echo $question->group;  ?> <?php echo "question".$question->q_no;  ?>">
                                    <div class="form-group">
                                      
                                              <label><?php echo $question->q_no.". ", $question->questionnaire; ?></label>
                                            <?php if ($question->q_no == 2) { ?>
                                              <div class="form">
                                              <select class="form-select" name="<?php echo $question->id ?>[]" aria-label="Default select example">
                                                  <option selected value="Doctor">Doctor</option>
                                                  <option value="Nurse">Nurse</option>
                                                  <option value="Others">Others</option>

                                              </select>
                                            </div>
                                            <?php } else if($question->q_no == 7) { ?>
                                              <div class="form">
                                              <select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
                                                <option selected value="">Please select Age</option>
                                                <option value="age 7​">7​</option>
                                                <option value="age 8​">8​</option>
                                                <option value="age 9​">9​</option>
                                                <option value="age 10​">10​</option>
                                                <option value="age 11​">11​</option>
                                                <option value="age 12​">12​</option>
                                                <option value="age 13​">13​</option>
                                                <option value="age 14​">14​</option>
                                                <option value="age 15​">15​</option>
                                                <option value="age 16​">16​</option>
                                                <option value="age 17​">17​</option>
                                                <option value="age 18​">18​</option>
                                                <option value="age 19​">19​</option>
                                                <option value="age 20​">20​</option>
                                              </select>
                                            </div>
                                            <?php } else if($question->q_no == 8) { ?>
                                              <div class="form">
                                              <select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
                                                <option selected value="">Please select Age</option>
                                                <option value="age 15​">15​</option>
                                                <option value="age 16​">16​</option>
                                                <option value="age 17​">17​</option>
                                                <option value="age 18​">18​</option>
                                                <option value="age 19​">19​</option>
                                                <option value="age 20​">20​</option>
                                                <option value="age 21​">21​</option>
                                                <option value="age 22">22</option>
                                                <option value="age 23">23</option>
                                                <option value="age 24">24</option>
                                                <option value="age 25">25</option>
                                                <option value="age 26">26</option>
                                                <option value="age 27">27</option>
                                                <option value="age 28">28</option>
                                                <option value="age 29">29</option>
                                                <option value="age 30">30</option>
                                                <option value="age 31">31</option>
                                                <option value="age 32">32</option>
                                                <option value="age 33">33</option>
                                                <option value="age 34">34</option>
                                                <option value="age 35">35</option>
                                                <option value="age 36">36</option>
                                                <option value="age 37">37</option>
                                                <option value="age 38">38</option>
                                                <option value="age 39">39</option>
                                                <option value="age 40">40</option>
                                                <option value="age 41">41</option>
                                                <option value="age 42">42</option>
                                                <option value="age 43">43</option>
                                                <option value="age 44">44</option>
                                                <option value="age 45">45</option>
                                              </select>
                                            </div>
                                             <?php } else if($question->q_no == 10) { ?>
                                              <div class="form">
                                              <select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
                                                <option selected value="">Please select Age</option>
                                               
                                                <option value="age 40">40</option>
                                                <option value="age 41">41</option>
                                                <option value="age 42">42</option>
                                                <option value="age 43">43</option>
                                                <option value="age 44">44</option>
                                                <option value="age 45">45</option>
                                                <option value="age 46">46</option>
                                                <option value="age 47">47</option>
                                                <option value="age 48">48</option>
                                                <option value="age 49">49</option>
                                                <option value="age 50">50</option>
                                                <option value="age 51">51</option>
                                                <option value="age 52">52</option>
                                                <option value="age 53">53</option>
                                                <option value="age 54">54</option>
                                                <option value="age 55">55</option>
                                                <option value="age 56">56</option>
                                                <option value="age 57">57</option>
                                                <option value="age 58">58</option>
                                                <option value="age 59">59</option>
                                                <option value="age 60">60</option>
                                              </select>
                                            </div>
                                             <?php } else if($question->q_no == 20) { ?>
                                              <div class="form">
                                              <select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
                                                <option selected value="">Please select Shape</option>
                                                <?php if (!empty($shapes)) {
                                                  foreach ($shapes as $key => $value) { ?>
                                                <option value="<?php echo $value->id; ?>"><?php echo $value->shape; ?></option>
                                                    
                                                  <?php }
                                                } ?>
                                              </select>
                                            </div>
                                            <?php } else if($question->q_no == 21) { ?>
                                              <div class="form">
                                              <select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
                                                <option selected value="">Please select Edge</option>
                                               <?php if (!empty($edges)) {
                                                  foreach ($edges as $key => $value) { ?>
                                                <option value="<?php echo $value->id; ?>"><?php echo $value->edges; ?></option>
                                                    
                                                  <?php }
                                                } ?>
                                              </select>
                                            </div>
                                            <?php } else if($question->q_no == 22) { ?>
                                              <div class="form">
                                              <select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
                                                <option selected value="">Please select Consistency</option>
                                                <?php if (!empty($consistency)) {
                                                  foreach ($consistency as $key => $value) { ?>
                                                <option value="<?php echo $value->id; ?>"><?php echo $value->consistency; ?></option>
                                                    
                                                  <?php }
                                                } ?>
                                              </select>
                                            </div>
                                          <?php } else if($question->q_no == 33) { ?>
                                              <div class="form">
                                              <select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
                                                <option selected value="">Please select Shape</option>
                                                <?php if (!empty($shapes)) {
                                                  foreach ($shapes as $key => $value) { ?>
                                                <option value="<?php echo $value->id; ?>"><?php echo $value->shape; ?></option>
                                                    
                                                  <?php }
                                                } ?>
                                              </select>
                                            </div>
                                            <?php } else if($question->q_no == 34) { ?>
                                              <div class="form">
                                              <select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
                                                <option selected value="">Please select Edge</option>
                                                 <?php if (!empty($edges)) {
                                                  foreach ($edges as $key => $value) { ?>
                                                <option value="<?php echo $value->id; ?>"><?php echo $value->edges; ?></option>
                                                    
                                                  <?php }
                                                } ?>
                                              </select>
                                            </div>
                                            <?php } else if($question->q_no == 35) { ?>
                                              <div class="form">
                                              <select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
                                                <option selected value="">Please select Consistency</option>
                                                <?php if (!empty($consistency)) {
                                                  foreach ($consistency as $key => $value) { ?>
                                                <option value="<?php echo $value->id; ?>"><?php echo $value->consistency; ?></option>
                                                    
                                                  <?php }
                                                } ?>
                                              </select>
                                            </div>
                                            <?php } ?>
                                          
                                    </div>
                                  </div>
                                <?php } else if($question->input_type == INPUT_TYPE_TEXTAREA){ ?>
                                          <div class="col-md-8 group_<?php echo $question->group;  ?> <?php echo "question".$question->q_no;  ?>">
                                          <div class=" ">
                                           <textarea></textarea>
                                          </div>
                                        </div>
                                <?php } ?>
                              </div>


                    <?php } } ?>
                </div>
                </div>
                  <div class="proceed-footer-coloretal completed">
                    <?php 
                        $date = new DateTime($assessment_header_data->assessment_date);
                        $date->modify('+12 month'); 
                        $next_assessment_date = $date->format('d-m-Y');
                        $next_assessment_date_ymd = $date->format('Y-m-d')
                    ?>
                    <p>This will be the final assessment submission. Are you sure?</p>
                    <p>Next Assessment Date: <?php echo $next_assessment_date;  ?></p>
                    <input type="hidden" name="next_assesment_date" value="<?php echo $next_assessment_date_ymd; ?>">
                      <!-- <a href=""> -->
                          <button class="btn proceed-btn-coloratal">Click to proceed</button>
                      <!-- </a> -->
                      <!-- <p class="footer-risk"> Malaysia Health Technology Assessment Section ( MaHTAS ). Clinical Practice Guidelines: management of colorectal carcinoma.
                          Ministry of Health Malaysia [Internet]. 2017 [cited 11 November 2021]. MOH/P/PAK/352.17(GU).
          </p> -->
                  </div>
            </form>
          </div>

             <div class="prev-next-btn mb-4 footernode">
        <div class="row">
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
                        <ul class="progress_bar clinical_questions">
                            <li class="active" id="group_1">Step</li>
                            <li id="group_2">Step</li>
                            <li id="group_3">Step</li>
                            <li id="group_4">Step</li>
                            <li id="group_5">Step</li>
                            <!-- <li id="group_6">Step</li> -->
                            <li id="completed">Completed</li> 
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
<script src="<?php echo base_url('assets/js/breast_questions.js'); ?>"></script>
