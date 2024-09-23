<link rel="styleSheet" href="<?php echo base_url('assets/css/ScreeningQuestions.css'); ?>" />
<?php $CI = & get_instance(); ?>
<div class="container">
        <h1 class="screeningHeader">Breast Cancer Symptom Assessment Tool</h1>  
    </div>
    <div class="question-container mt-5">
      

        <div class="questions-section-final mt-5">
            <p>You have successfully completed the Symptoms Assessment Tool. Please perform this assessment again in a month’s time.</p>
        </div>
        <div class="proceed-footer">
        <?php if($CI->session->userdata('rolecode') == MEDICPRAC){ ?>
            <a href="<?php echo base_url('all_assessments'); ?>">
        <?php }else{ ?>
            <a href="<?php echo base_url('test_results/breast'); ?>">
        <?php } ?>
                <button class="btn proceed-btn">
                    Click to proceed
                </button>
            </a>
        </div>
    </div>