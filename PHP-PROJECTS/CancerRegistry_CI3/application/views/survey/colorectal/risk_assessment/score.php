<div class="container">
        <div class="back-container">
            <span class="position-relative"><ion-icon name="chevron-back-outline"></ion-icon></span>
            <p ><a href="./Calculator.html">Back</a></p>
        </div>
        
        <h1 class="screeningHeader">Colorectal Cancer Risk Assessment Tool</h1> 
        <div class="total-Score">
            <h6>Total Score: <span>score 0</span></h6>

        </div> 
    </div>
    <div class="question-container mt-5">
        <div class="questions-section mt-5">
           
            <div class="result-outer">
                <div class="result-inner">
                    <p>If patient’s total score is 0-1, display: “You are of low risk and should continue preventative practices. It is ideal to do a baseline Faecal Occult Blood Test (FOBT) at any Klinik Kesihatan. Otherwise, 
                        contact National Cancer Society Malaysia (NCSM) at 03-26987351 for further details on FOBT.”</p>
                        <p> If patient’s total score is 2-3, display: “You are of moderate risk.
                         It is recommended for you to do the FOBT at any Klinik Kesihatan. 
                         Otherwise, contact National Cancer Society Malaysia (NCSM) at 03-26987351 for further details on FOBT.”</p>
                        <p>If patient’s total score is 4-7, display: “You are high risk: 
                            Please consult a gastroenterologist, colorectal surgeon or general surgeon. You may do this in any private 
                            hospital or the respective units of gastroenterology 
                            in a government hospital. An urgent colonoscopy will be scheduled for you.”</p>
                </div>

            </div>
      
        <div class="proceed-footer-coloretal">
            <a href="<?php echo base_url('test_results/colerectal'); ?>">
                <button class="btn proceed-btn-coloratal">
                    Back to Home
                                  </button>
            </a>
            <p class="footer-risk">Yeoh K, Ho K, Chiu H, et al. The Asia Pacific Colorectal Screening score: a validated tool that stratifies risk for colorectal advanced neoplasia in asymptomatic Asian subjects. Gut 2011;60:1236 1241. Available from: http://dx.doi.org/10.1136/gut.2010.221168 [Accessed 3rd March 2021].</p>
        </div>
    </div>