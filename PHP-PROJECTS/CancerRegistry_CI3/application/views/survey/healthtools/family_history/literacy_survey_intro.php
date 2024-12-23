<link rel="styleSheet" href="<?php echo base_url('assets/css/ScreeningQuestions.css') ?>" />

<link rel="styleSheet" href="<?php echo base_url('assets/css/family_history.css') ?>" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="container">
	 <div class="back-container">
             <a href="<?php echo base_url('health_tools/screening'); ?>"><button class="btn next-btn float-end"><span class="prev-icon"><ion-icon name="chevron-back-outline"></ion-icon></span> Back</button></a>
    </div>
	<div class="col-md-12">
		<h1 class="text-center"> Health Literacy Survey </h1>
	</div>
	<div class="cl-md-12">
		<p class="text-center">
			This survey comprises 18 questions covering 3 domains, namely <strong>Healthcare, Disease Prevention 
and Health Promotion.</strong>


		</p>
		<p class="text-centeer">It is done to determine the motivation and ability of individuals to gain access, to understand and use information in ways which promote and maintain good health. </p>
	</div>
	<div class="container">
		<form method="POST" id="assessment_form" action="<?php echo base_url('health_literacy_survey') ?>">

			 <input type="hidden" name="patient_id" value="<?php echo $patient_id;?>">
			 <input type="hidden" name="assessment_type_id" value="<?php echo $assessment_type_id;?>">
			 <input type="hidden" name="assessment_type_id" value="6">
			 <input type="hidden" name="assessment_sub_type_id" value="1">
			 <input type="hidden" name="assessment_tool_id" value="26">
			 <input type="hidden" name="facility_id" value="<?php echo $facility_id;?>">
			 <input type="hidden" name="assessment_date" value="<?php echo $assessment_date;?>">
			 <input type="hidden" name="assessment_time" value="<?php echo $assessment_time;?>">
			 <input type="hidden" name="literacy_info_proceed" value="true">
			 <div class="col-md-12">
				<div class="proceed-health-tools text-center">
						<button type="submit" class="btn proceed-btn"> Click to proceed </button>
				</div>
			</div>
		</form>
	</div>
</div>