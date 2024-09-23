<div class="container">
        <div class="back-container">
            <span class="position-relative"><ion-icon name="chevron-back-outline"></ion-icon></span>
            <p ><a href="./Info.html">Back</a></p>
        </div>
        
        <h1 class="screeningHeader">Asia Pacific Colorectal Screening</h1>  
    </div>
    <div class="question-container mt-5">
        <div class="questions-section mt-5">
            <div class="row">
                <div class="col-md-8 mb-2">
                    <p>Please choose only one option:</p>
                  <div class="row">
                    <p>1. What is your age (in years according to your NRIC)?</p>
                    <div class="col-md-8">
                    <div class="form">
                        <select class="form-select" aria-label="Default select example" id="formSelection" onchange={onChangeSection()}>
                            <option selected>age <50</option>
                            <option value="1">age 50-69</option>
                            <option value="2">age >70</option>
                          </select>
                          </div>
                        </div>
                  </div>
                  <div class="row">
                    <p>2. What is your Sex?</p>
                    <div class="col-md-8">
                    <div class="form">
                        <select class="form-select" aria-label="Default select example" id="formSelection" onchange={onChangeSection()}>
                            <option selected>male</option>
                            <option value="1">female</option>
                          </select>
                          </div>
                        </div>
                  </div>
                  <div class="row">
                    <p>3. Do you have an immediate family member (parent, sibling, child) who has or had colorectal cancer?</p>
                    <div class="col-md-8">
                    <div class="form">
                        <select class="form-select" aria-label="Default select example" id="formSelection" onchange={onChangeSection()}>
                            <option selected>absent</option>
                            <option value="1">present</option>
                          </select>
                          </div>
                        </div>
                  </div>
                  <div class="row">
                    <p>4. Do you currently smoke or have smoked in the past?</p>
                    <div class="col-md-8">
                    <div class="form">
                        <select class="form-select" aria-label="Default select example" id="formSelection" onchange={onChangeSection()}>
                            <option selected>never</option>
                            <option value="1">currently</option>
                            <option value="2">past</option>
                          </select>
                          </div>
                        </div>
                  </div>
            
                </div>
                </div>

      
        <div class="proceed-footer-coloretal">
            <a href="<?php echo base_url('colorectal_cancer/risk_assessment_score'); ?>">
                <button class="btn proceed-btn-coloratal">
                    Calculate
                                  </button>
            </a>
            <p class="footer-risk">Yeoh K, Ho K, Chiu H, et al. The Asia Pacific Colorectal Screening score: a validated tool that stratifies risk for colorectal advanced neoplasia in asymptomatic Asian subjects. Gut 2011;60:1236 1241. Available from: http://dx.doi.org/10.1136/gut.2010.221168 [Accessed 3rd March 2021].</p>
        </div>
    </div>