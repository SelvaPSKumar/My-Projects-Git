<?php
$assessment = null;
$content = null;
$info = '';
switch ($assessment_tools_id) {
    case 22:
        $assessment = 'Prostate Cancer Symptom Assessment Tool';
        $content = '<p>You have successfully completed the Symptoms Assessment Tool. Please perform this assessment again in a year’s time.</p>
            <p>Next Assessment on '.$next_assesment_date.'</p>';
        break;
    case 13:
        $assessment = 'Prostate Specific Antigen (PSA)';
        $content = '<p>You have successfully completed the Prostate Specific Antigen (PSA) Assessment Tool. Please perform this assessment again in a year’s time.</p>
            <p>Next Assessment on '.$next_assesment_date.'</p>';
        break;
    case 14:
        $assessment = 'DIGITAL RECTAL EXAMINATION (DRE)';
        $content = '<p>You have successfully completed the DIGITAL RECTAL EXAMINATION (DRE) Assessment Tool. Please perform this assessment again in a year’s time.</p>
            <p>Next Assessment on '.$next_assesment_date.'</p>';
        break;
    default:
        $assessment = 'Prostate Cancer Assessment Tool';
        $content = '<p>You have successfully completed the this Assessment Tool. Please perform this assessment again in a year’s time.</p>
            <p>Next Assessment on '.$next_assesment_date.'</p>';
        break;
}
?>

<div class="container">
        <h1 class="screeningHeader"><?php echo $assessment; ?></h1>  
    </div>
    <div class="question-container mt-5">
      

        <div class="questions-section-final mt-5">
            <?php echo '<h5 class="text-secondary">'.$info.'</h5>'.$content; ?>
        </div>
        <div class="proceed-footer">
            <?php if($this->session->userdata('rolecode') == PATIENT) {
                echo '
                <a href="'.base_url('test_results/prostate').'">
                    <button class="btn proceed-btn">
                        Click to proceed
                    </button>
                </a>';
            } else {
                echo '
                <a href="'.base_url('all_assessments/cervical_cancer').'">
                    <button class="btn proceed-btn">
                        Click to proceed
                    </button>
                </a>';
            }
            ?>
        </div>
    </div>