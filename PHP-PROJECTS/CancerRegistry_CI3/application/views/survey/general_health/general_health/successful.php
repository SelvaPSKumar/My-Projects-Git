<link rel="styleSheet" href="<?php echo base_url('assets/css/ScreeningQuestions.css'); ?>" />
<?php $CI = & get_instance(); ?>
<div class="container">
        <h1 class="screeningHeader">GENERAL HEALTH SCREENING</h1>  
    </div>
    <div class="question-container mt-5 text-center">
      

        <div class="questions-section-final mt-5">
            <p>You have successfully completed the General Health Screening.</p>
            <p>Next Assessment Date is <?php echo $next_assesment_date; ?></p>
        </div>
        <div class="proceed-footer">
        <?php if($CI->session->userdata('rolecode') == MEDICPRAC){ ?>
            <a href="<?php echo base_url('all_assessments/general_health'); ?>">
        <?php }else{ ?>
            <a href="<?php echo base_url('test_results/general_health'); ?>">
        <?php } ?>
                <button class="btn proceed-btn">
                    Click to proceed
                </button>
            </a>
        </div>
    </div>