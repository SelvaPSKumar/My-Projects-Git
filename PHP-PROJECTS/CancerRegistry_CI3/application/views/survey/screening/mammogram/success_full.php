<link rel="styleSheet" href="<?php echo base_url('assets/css/ScreeningQuestions.css') ?>" />
<?php $CI = & get_instance(); ?>
<div class="container">
        <h1 class="screeningHeader">MAMMOGRAM</h1>  
    </div>
    <div class="question-container mt-5">
      

        <div class="questions-section-final mt-5">
            <p>You have successfully completed the MAMMOGRAM</p>
        </div>
        <div class="proceed-footer">
        <?php if($CI->session->userdata('rolecode') == MEDICPRAC){ ?>
            <a href="<?php echo base_url('all_assessments'); ?>">
        <?php }else{ ?>
            <a href="<?php echo base_url('test_results/breast'); ?>">
        <?php } ?>
                <button class="btn proceed-btn">
                    Click to return to homepage
                </button>
            </a>
        </div>
    </div>