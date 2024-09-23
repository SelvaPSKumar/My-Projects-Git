    <link rel="styleSheet" href="<?php echo base_url('assets/css/ScreeningQuestions.css') ?>" />

<link rel="styleSheet" href="<?php echo base_url('assets/css/family_history.css') ?>" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php
    $title = "";
    $content = "";
    $button_caption = "";
    switch($assessment_tool_id) {
        case 10:
            $title = "LOW DOSE CT SCAN (LDCT)";
            $content = "A low-dose CT scan is a special kind of X-ray that takes multiple pictures as you lie on a table that slides in and out of the machine. A computer then combines these images into a detailed picture of your lungs";
            $button_caption = "Click to proceed";
        break;
        case 11:
            $title = "Smokerlyzer";
            $content = "A hand-held carbon monoxide monitor, such as a Smokerlyzer*, is a device used to measure the level of carbon monoxide (CO) in the body via a breath test. Test monitor measures the level of CO in a person's breath, which is indirectly measures the level in the blood.<br>
                The monitor can be used to measure CO levels in adults and adolescents and can provide a reading for both smokers and passive smokers.";
            $button_caption = "Click to proceed";
        break;
        case 12:
            $title = "CHEST X-RAY";
            $content = "Chest x-ray uses radation to produce images of the inner chest.
                        <br><br>
                        Can be used to evaluate heart, lungs, and chest walls. Also used as an aid to diagnose lung cancer and various other lung or chest related conditions.";
            $button_caption = "Click to proceed";
        break;
        default:
            
        break;

    }
?>
<div class="container">
    <div class="col-md-12">
        <h1 class="text-center"> <?php echo $title; ?> </h1>
    </div>
    <div class="cl-md-12">
        <p class="text-center">
        <?php echo $content; ?>
        </p>
    </div>
    <div class="container">
        <form method="POST" id="assessment_form" action="<?php echo base_url('lungs_cancer/questions') ?>">
             <div class="col-md-12">
                <div class="proceed-health-tools text-center">
                        <button type="submit" class="btn proceed-btn"> <?php echo $button_caption; ?> </button>
                </div>
            </div>
        </form>
    </div>
</div>