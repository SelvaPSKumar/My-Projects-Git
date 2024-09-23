<div class="container">
        <div class="back-container">
            <span class="position-relative"><ion-icon name="chevron-back-outline"></ion-icon></span>
            <p ><a href="../ColorectalSelection.html">Back</a></p>
        </div>
        
        <h1 class="screeningHeader">Colonoscopy</h1>  
    </div>
    <div class="question-container mt-5">
        <div class="questions-section mt-5">
            <div class="row">
                <div class="col-md-8 mb-2">
                    <p>Please choose only one option:</p>
                  <div class="row">
                    <p>1. Name of Healthcare Professional</p>
                    <div class="col-md-8">
                        <div class=" ">
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="HCP Name">
                          </div>
                        </div>
                  </div>
                  <div class="row">
                    <p>2. Designation of HCP</p>
                    <div class="col-md-8">
                    <div class="form">
                        <select class="form-select" aria-label="Default select example" id="formSelection" onchange={onChangeSection()}>
                            <option selected>Doctor</option>
                            <option value="1">Nurse</option>
                            <option value="1">Others</option>

                          </select>
                          </div>
                        </div>
                  </div>
                  <div class="row">
                    <p>3. Registration Number of HCP</p>
                    <div class="col-md-8">
                        <div class=" ">
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Registration Number of HCP">
                          </div>
                        </div>
                  </div>
                  <div class="row">
                    <p>4. Institution colonoscopy was performed at</p>
                    <div class="col-md-8">
                        <div class=" ">
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Institution iFOBT exam was performed at">
                          </div>
                        </div>
                  </div>
            
                </div>
                </div>

      
        <div class="proceed-footer-coloretal">
            <a href="<?php echo base_url('colorectal_cancer/colonoscopy_doctor'); ?>">
                <button class="btn proceed-btn-coloratal">Click to proceed</button>
            </a>
            <p class="footer-risk"> Malaysia Health Technology Assessment Section ( MaHTAS ). Clinical Practice Guidelines: management of colorectal carcinoma.
                Ministry of Health Malaysia [Internet]. 2017 [cited 11 November 2021]. MOH/P/PAK/352.17(GU).
</p>
        </div>
    </div>
