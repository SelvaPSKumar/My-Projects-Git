    <link rel="styleSheet" href="<?php echo base_url('assets/css/ScreeningQuestions.css') ?>" />

<link rel="styleSheet" href="<?php echo base_url('assets/css/family_history.css') ?>" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php
    $title = "";
    $content = "";
    $button_caption = "";
    switch($assessment_tool_id) {
        case 3:
            $title = "COLONOSCOPY";
            $content = "A colonoscopy is done to check inside your intestines, both small and big.
                        A long, thin, flexible tube with a small camera inside it is passed through your anus.
                        This test can help find what's causing your bowel symptoms.";
            $button_caption = "Click to Proceed";
        break;

        case 4:
            $title = "FAECAL OCCULT BLOOD TEST";
            $content = "The Faecal Occult Blood Test is a laboratory examination testing stool samples for blood that cannot be seen by the naked eye, which can be caused by a number of diseases.";
            $button_caption ="Click to proceed";
        break;

        case 21:
            $title = "Colorectal Cancer Risk Assessment Tool";
            $content = "The Asia-Pacific Colorectal Screening Score is a validated tool based on a statistical model
                known as the Pearson Chi-squared method, understanding the association between
                 the risk factors and neoplasia in Asians.";
            $button_caption = "Click to proceed to the APCS";
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
        <form method="POST" id="assessment_form" action="<?php echo base_url('colorectal_questions') ?>">
             <div class="col-md-12">
                <div class="proceed-health-tools text-center">
                        <button type="submit" class="btn proceed-btn"> <?php echo $button_caption; ?> </button>
                </div>
            </div>
        </form>
    </div>
</div>