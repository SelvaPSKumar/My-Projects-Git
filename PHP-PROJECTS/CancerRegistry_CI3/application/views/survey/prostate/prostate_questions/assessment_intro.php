    <link rel="styleSheet" href="<?php echo base_url('assets/css/ScreeningQuestions.css') ?>" />

<link rel="styleSheet" href="<?php echo base_url('assets/css/family_history.css') ?>" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php
    $title = "";
    $subtitle = "";
    $content = "";
    $button_caption = "";
    switch($assessment_tool_id) {
        case 22:
            $title = "PROSTATE CANCER SYMPTOM ASSESSMENT TOOL";
            $subtitle = "International Prostate Symptom Score (IPSS)";
            $content = "PSS is used to measure lower urinary tract symptom severity.<br>
                    This test is made up of 7 questions that focus on urinary voiding symptoms. Score of 0-7 indicate mild symptoms, 8-19 moderate symptoms and 20-35 severe symptoms.";
            $button_caption = "Click to proceed";
        break;
        case 13:
            $title = "Prostate Specific Antigen (PSA)";
            $content = "The Prostate Specific Antigen test is a blood test used to screen for prostate cancer. It is used to quantify the amount of PSA present in the blood.
                <br><br>
                High amounts of PSA in blood could be an indication of prostate cancer.";
            $button_caption = "Click to proceed";
        case 14:
            $title = "DIGITAL RECTAL EXAMINATION (DRE)";
            $content = "A Digital Rectal Examination (DRE) is used to examine an individual’s rectum.
                    <br><br>
                    A DRE performed by a doctor can help to detect cancer and other diseases that might develop in the surrounding area.";
            $button_caption = "Click to proceed";
        default:
            
        break;

    }
?>
<div class="container">
    <div class="col-md-12">
        <h3 class="text-center"> <?php echo $title; ?> </h3>
    </div>
    <div class="col-md-12">
        <h4 class="text-center"> <?php echo $subtitle; ?> </h4>
    </div>
    <div class="cl-md-12">
        <p class="text-center">
        <?php echo $content; ?>
        </p>
    </div>
    <div class="container">
        <form method="POST" id="assessment_form" action="<?php echo base_url('prostate_cancer/questions') ?>">
             <div class="col-md-12">
                <div class="proceed-prostate-cancer text-center">
                        <button type="submit" class="btn proceed-btn"> <?php echo $button_caption; ?> </button>
                </div>
            </div>
        </form>
    </div>
</div>