<link rel="styleSheet" href="<?php echo base_url('assets/css/ScreeningQuestions.css') ?>" />

<link rel="styleSheet" href="<?php echo base_url('assets/css/family_history.css') ?>" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="container">
	<div class="col-md-12">
		<h1 class="text-center"> Health Tools Assessment Saved </h1>
	</div>
	<div class="cl-md-12">
		<p class="text-center">
			You Have Successfully Saved The Assessment. You Can Proceed With The Next Assessment By Following Link Or You Can Proceed With The Main Page.
		</p>
	</div>
	<div class="container">
		<div class="proceed-health-tools text-center">
			<a href="<?php echo base_url();?>" class="btn proceed-btn"> Click to proceed </a>
		</div>
		<form method="POST" id="assessment_form" action="<?php echo base_url('your_health_tools') ?>">

			 <input type="hidden" name="patient_id" value="<?php echo $patient_id;?>">
			 <input type="hidden" name="assessment_type_id" value="<?php echo $assessment_type_id;?>">
			 <input type="hidden" name="assessment_type_id" value="6">
			 <input type="hidden" name="assessment_sub_type_id" value="1">
			 <input type="hidden" name="assessment_tool_id" value="<?php echo $assessment_tool_id;?>">
			 <input type="hidden" name="facility_id" value="<?php echo $facility_id;?>">
			 <input type="hidden" name="assessment_date" value="<?php echo $assessment_date;?>">
			 <input type="hidden" name="assessment_time" value="<?php echo $assessment_time;?>">
			 <input type="hidden" name="from_thankyou_page" value="yes">
			 <input type="hidden" name="literacy_info_proceed" value="true">
			 <?php
			 if( $assessment_tool_id == 27 ) {
			 	if(isset($HLS_Total_Score) && !is_null($HLS_Total_Score)) {
			 		if( $HLS_Total_Score>0 && $HLS_Total_Score<33 ) {
			 			$text_color_class = 'text-danger';
			 			$text = 'Limited';
			 		} elseif( $HLS_Total_Score>=33 && $HLS_Total_Score<42 ) {
			 			$text_color_class = 'text-warning';
			 			$text = 'Sufficient';
			 		} else {
			 			$text_color_class = 'text-success';
			 			$text = 'Excellent';
			 		}
				 	echo '
				 	<div class="col-md-12">
				 		<div class="literacy_score text-center">
				 			<div>Your score is '.$HLS_Total_Score.'%</div>
				 			<div>You have <span class="'.$text_color_class.'">'.$text.'</span> Health Literacy.</div>
				 		</div>
				 	</div>';
			 	}
			 }
			 ?>
			 <div class="col-md-12">
				<div class="proceed-health-tools text-center">
						<button type="submit" class="btn proceed-btn"> Click to Proceed With <?php
						 if($assessment_tool_id == 26) { echo 'Health Literacy Survey'; } 
						 elseif($assessment_tool_id == 27) { echo 'Cancer Risk Assessment'; }
						 else { echo 'Next Assessment'; }
						?></button>
				</div>
			</div>
		</form>
	</div>
</div>