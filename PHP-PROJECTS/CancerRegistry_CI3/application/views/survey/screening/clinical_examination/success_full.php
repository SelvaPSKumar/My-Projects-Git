<link rel="styleSheet" href="<?php echo base_url('assets/css/ScreeningQuestions.css') ?>" />
<?php $CI = & get_instance(); ?>
<div class="container">
        <h1 class="screeningHeader">CLINICAL BREAST EXAMINATION</h1>  
    </div>
    <div class="question-container mt-5">
      

        <div class="questions-section-final mt-5">
            <p>You have successfully completed the examination</p>

        </div>
        <div class="proceed-footer">
                    <p>This will be the final assessment submission. Are you sure?</p>
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