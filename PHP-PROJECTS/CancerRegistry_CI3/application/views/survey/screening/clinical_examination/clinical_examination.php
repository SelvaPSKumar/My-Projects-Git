<link rel="styleSheet" href="<?php echo base_url('assets/css/ScreeningQuestions.css') ?>" />

<div class="container">
        <div class="back-container">
                <a href="<?php echo base_url('screening/screen'); ?>">
            <button class="btn next-btn float-end"><span class="prev-icon"><ion-icon name="chevron-back-outline"></ion-icon></span> Back</button>
            
                
            </a>
        </div>
        
        <h1 class="screeningHeader">CLINICAL BREAST EXAMINATION</h1>  
    </div>
        <div class="question-container mt-5">

            <div class="questions-section-final mt-5">
                <p>A clinical breast exam (CBE) is an examination by a healthcare professional 
                    who uses his or her hands to feel for lumps or other changes that might occur in the breasts. </p>
            </div>
            <div class="proceed-footer">
                <a href="<?php echo base_url('screening/clinical_questions'); ?>">
                    <button class="btn proceed-btn" type="submit">
                        Click to proceed
                    </button>
                </a>
            </div>
        </div>
