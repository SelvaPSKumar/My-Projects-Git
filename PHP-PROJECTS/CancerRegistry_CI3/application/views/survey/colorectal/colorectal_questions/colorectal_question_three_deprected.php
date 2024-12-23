<div class="container">
        <h1 class="screeningHeader">Colorectal Cancer Symptom Assessment Tool</h1>  
    </div>
    <div class="question-container mt-5">
        <div class="prev-next-btn mb-4">
        <div class="row">
              <div class="col-6">
                <div class="">
                    <a href="<?php echo isset($previous) ? $previous :''; ?>">
                    <button class="btn prev-btn">
                        <span class="prev-icon"><ion-icon name="chevron-back-outline"></ion-icon></span>
                        Previous</button>
                    </a>
                </div>
            </div>
       
             <div class="col-6">
                <div class="">
                    <a href="#">
                    <button class="btn next-btn float-end">
                        Next <span class="next-icon"><ion-icon name="chevron-forward-outline"></ion-icon></span>
                    </button>
                </a>
            </div>
            </div>
        </div>
        </div>
        <hr />

        <form action="<?php echo base_url('colorectal_questions/four'); ?>" method="POST">
            <div class="questions-section mt-5">
                <div class="row">
                    <div class="col-md-8 mb-2">
                        <h6>3. Do you feel weak and fatigued for no known reason?</h6>
                        <p>Please tick Yes or No</p>
                        <div class="yes-no-section">
                            <div class=" mb-2">
                                <input class="" type="radio" name="3" value="y" id="flexRadioDefault1">
                                <label class="" for="flexRadioDefault1">
                                  Yes
                                </label>
                              </div>
                              <div class=" mb-2">
                                <input class="" type="radio"  name="3" value="n" id="flexRadioDefault2" checked>
                                <label class="" for="flexRadioDefault2">
                                  No
                                </label>
                              </div>
                              
                        </div>
                    </div>
                    
                    
                </div>
                <div class="col-md-4">
                    <!-- <a href="<?php echo base_url('colorectal_questions/four'); ?>"> -->
                    <button type="submit" class="btn submit-btn">Submit</button>
                <!-- </a> -->
                  </div>
            </div>
        </form>

        <!-- <div class="questions-section mt-5">
            <div class="row">
                <div class="col-md-8 mb-2">
                    <h6>3. Do you feel weak and fatigued for no known reason?</h6>
                    <p>Please tick Yes or No</p>
                    <div class="yes-no-section">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                              Yes
                            </label>
                          </div>
                          <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                            <label class="form-check-label" for="flexCheckChecked">
                              No
                            </label>
                          </div>
                          
                    </div>
                </div>
                
                
            </div>
            <div class="col-md-4">
                <a href="<?php echo base_url('colorectal_questions/four'); ?>">
                <button class="btn submit-btn">Submit</button>
            </a>
              </div>
        </div> -->
        <div class="question-footer">
            <p> </p>
        </div>
    </div>