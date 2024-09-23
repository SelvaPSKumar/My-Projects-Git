<?php
$assessment = null;
$content = null;
switch ($assessment_tools_id) {
    case 20:
        $assessment = 'Colorectal Cancer Symptom Assessment Tool';
        $content = '<p>You have successfully completed the Symptoms Assessment Tool. Please perform this assessment again in a year’s time.</p>
            <p>Next Assessment on '.$next_assesment_date.'</p>';
        break;
    case 21:
        $assessment = 'Colorectal Cancer Risk Assessment Tool';
        $content = '<p>You have successfully completed the Risk Assessment Tool. Please perform this assessment again in a year’s time.</p>
            <p>Next Assessment on '.$next_assesment_date.'</p>';
        break;
    case 3:
        $assessment = 'Colorectal Cancer Colonoscopy Assessment Tool';
        $content = '<p>You have successfully completed the Colonoscopy Assessment Tool. Please perform this assessment again in a year’s time.</p>
            <p>Next Assessment on '.$next_assesment_date.'</p>';
        break;
    case 4:
        $assessment = 'Colorectal Cancer iFOBT Assessment Tool';
        $content = '<p>You have successfully completed the iFOBT Assessment Tool. Please perform this assessment again in a year’s time.</p>
            <p>Next Assessment on '.$next_assesment_date.'</p>';
        break;
    default:
        break;
}
?>

<div class="container">
        <h1 class="screeningHeader"><?php echo $assessment; ?></h1>  
    </div>
    <div class="question-container mt-5">
      

        <div class="questions-section-final mt-5">
            <?php echo $content; ?>
        </div>
        <div class="proceed-footer">
            <a href="<?php echo base_url('test_results/colorectal'); ?>">
                <button class="btn proceed-btn">
                    Click to proceed
                </button>
            </a>
        </div>
    </div>