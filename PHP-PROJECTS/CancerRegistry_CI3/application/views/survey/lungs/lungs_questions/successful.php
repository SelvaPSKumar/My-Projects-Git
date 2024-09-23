<?php
$assessment = null;
$content = null;
switch ($assessment_tools_id) {
    case 10:
        $assessment = 'Low Dose CT Scan Assessment Tool';
        $content = '<p>You have successfully completed the Low Dose CT Scan Assessment Tool. Please perform this assessment again in a month’s time.</p>
            <p>Next Assessment on '.$next_assesment_date.'</p>';
    break;
    case 11:
        $assessment = 'Smokerlyzer Assessment Tool';
        $content = '<p>You have successfully completed the Smokerlyzer Assessment Tool. Please perform this assessment again in a month’s time.</p>
            <p>Next Assessment on '.$next_assesment_date.'</p>';
    break;
    case 12:
        $assessment = 'Chest X-Ray Assessment Tool';
        $content = '<p>You have successfully completed the Chest X-Ray Assessment Tool. Please perform this assessment again in a month’s time.</p>
            <p>Next Assessment on '.$next_assesment_date.'</p>';
    break;
    case 19:
    default:
        $assessment = 'Lung Cancer Symptom Assessment Tool';
        $content = '<p>You have successfully completed the Symptoms Assessment Tool. Please perform this assessment again in a month’s time.</p>
            <p>Next Assessment on '.$next_assesment_date.'</p>';
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
            <?php if($this->session->userdata('rolecode') == PATIENT) {
                echo '
                <a href="'.base_url('test_results/lungs').'">
                    <button class="btn proceed-btn">
                        Click to proceed
                    </button>
                </a>';
            } else {
                echo '
                <a href="'.base_url('all_assessments/lung_cancer').'">
                    <button class="btn proceed-btn">
                        Click to proceed
                    </button>
                </a>';
            }
            ?>
        </div>
    </div>