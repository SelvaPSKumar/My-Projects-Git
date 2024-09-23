		<link rel="styleSheet" href="<?php echo base_url('assets/css/ScreeningQuestions.css') ?>" />

		<link rel="styleSheet" href="<?php echo base_url('assets/css/mamogram.css') ?>" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<div class="container">
			<div class="back-container">
	            <a href="<?php echo base_url('mammogram_questions'); ?>">
	            <button class="btn next-btn float-end"><span class="prev-icon"><ion-icon name="chevron-back-outline"></ion-icon></span> Back</button>
	                
	            </a>
	        </div>
			<h1 class="screeningHeader">MAMMOGRAM</h1>  
		</div>
		<div class="question-container mt-5">
			<div class="prev-next-btn mb-4">
        <div class="headernode row">
            <div class="col">
                <div class="">
                    <button class="btn prev-btn" id="previous">
                        <span class="prev-icon"><ion-icon name="chevron-back-outline"></ion-icon></span>
                        Previous
                          <input type="hidden" name="" value="group_1" id="previous_page">
                  	</button>
                </div>
            </div>
            <div class="col hide_progress_responsive">
                <!-- <div class="container"> -->
                    <div class="card">
                        <ul class="progress_bar mammogram_questions1">
                            <li class="active" id="group_2">Step</li>
                            <li id="group_3">Step</li>
                            <li id="group_4">Step</li>
                            <li id="group_5">Step</li>
                            <li id="group_6">Step</li>
                            <li id="completed">Completed</li> 
                        </ul>
                    </div>
                    
                <!-- </div> -->
            </div>
            <div class="col">
                <div class="">
                    <!-- <a href="../ScreeningQuestions/ScreeningQuestionTwo.html"> -->
                        <button class="btn next-btn float-end" id="next">
                            Next <span class="next-icon"><ion-icon name="chevron-forward-outline"></ion-icon></span>
                            <input type="hidden" name="" value="group_2" id="current_page">
                        </button>
                    <!-- </a> -->
                </div>
            </div>
        </div>
        </div>
			<hr />
			<form action="<?php echo base_url('save_mammogram_questions1'); ?>" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="assessment_header_id" value="<?php echo $assessment_header_id ?>">
				<div class="questions-section mt-5">
					<?php if (!empty($questions)) {
						$currentDate = date('Y-m-d'); 
						foreach ($questions as $key => $question) { ?>
							<div class="row">
								<?php if($question->q_no == 6){ ?>
									<div class="col-md-8 mb-2 group_2">
										<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
										<div class="yes-no-section">
											<div class=" mb-2">
												<input class="" type="radio" name="<?php echo $question->id ?>[]" value="yes">
												<label>Yes</label>
											</div>
											<div class=" mb-2">
												<input class="" type="radio"  name="<?php echo $question->id ?>[]" value="no">
												<label>No</label>
											</div>
										</div>
									</div>
								<?php } else if($question->q_no == 7){ ?>
									<div class="col-md-8 mb-2 group_2">
										<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
										<div class="yes-no-section">
											<div class=" mb-2">
												<input class="" type="radio" name="<?php echo $question->id ?>[]" value="yes">
												<label>Yes</label>
											</div>
											<div class=" mb-2">
												<input class="" type="radio"  name="<?php echo $question->id ?>[]" value="no" >
												<label>No</label>
											</div>
										</div>
									</div>
								<?php } else if($question->q_no == 8){ ?>
									<div class="col-md-8 mb-2 group_2">
										<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
										<div class="yes-no-section">
											<div class=" mb-2">
												<input class="question8" type="radio" name="<?php echo $question->id ?>[]" value="yes">
												<label>
													Yes
												</label>
											</div>
											<div class=" mb-2">
												<input class="question8" type="radio"  name="<?php echo $question->id ?>[]" value="no" >
												<label>
													No
												</label>
											</div>
										</div>
									</div>
								<?php } else if($question->q_no == 9){ ?>
									<div class="col-md-8 mb-2 question9 group_2">
										<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
										<div class="yes-no-section">
											<div class="input-group mb-3 mt-4">
												<input type="text" name="<?php echo $question->id ?>[]" class="form-control" placeholder="location to be filled in by patient or HCP" aria-label="Username" aria-describedby="basic-addon1">
											</div>
										</div>
									</div>
								<?php } else if($question->q_no == 10){ ?>
									<div class="col-md-8 mb-2 question10 group_2">
										<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
										<div class="yes-no-section">
											<div class="input-group mb-3 mt-4">
												<input type="date" name="<?php echo $question->id ?>[]" class="form-control" max="<?php echo $currentDate; ?>" placeholder="date (mm/yyyy) to be filled in by patient/HCP" aria-label="Username" aria-describedby="basic-addon1">
											</div>
										</div>
									</div>
								<?php } else if($question->q_no == 11){ ?>
									<div class="col-md-8 mb-2 group_2">
										<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
										<div class="yes-no-section">
											<div class=" mb-2">
												<input class="question11" type="radio" name="<?php echo $question->id ?>[]" value="yes">
												<label>
													Yes
												</label>
											</div>
											<div class=" mb-2">
												<input class="question11" type="radio"  name="<?php echo $question->id ?>[]" value="no" >
												<label>
													No
												</label>
											</div>
										</div>
									</div>
								<?php } else if($question->q_no == 12){ ?>

									<div class="col-md-8 mb-2 question12 group_2">
										<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
										<div class="yes-no-section mt-4">
											<select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
												<option selected value="">Please select one option only</option>
												<option value="ombined oral contraceptive pill​">Combined oral contraceptive pill​</option>
												<option value="progestin-only pill">progestin-only pill</option>
												<option value="hormone depot injections">hormone depot injections</option>
												<option value="hormone replacement therapy">hormone replacement therapy </option>
											</select>
										</div>
									</div>
								<?php } else if($question->q_no == 13){ ?>

									<div class="col-md-8 mb-2 group_2">
										<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
										<div class="yes-no-section">
											<div class=" mb-2">
												<input class="question13" type="radio" name="<?php echo $question->id ?>[]" value="yes">
												<label>
													Yes
												</label>
											</div>
											<div class=" mb-2">
												<input class="question13" type="radio"  name="<?php echo $question->id ?>[]" value="no" >
												<label>
													No
												</label>
											</div>
										</div>
									</div>
								<?php } else if($question->q_no == 14){ ?>
									<div class="col-md-8 mb-2 question14 group_2">
										<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
										<div class="yes-no-section mt-4">
												<input type="number" name="<?php echo $question->id ?>[]" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
											
										</div>
									</div>

								<?php } else if($question->q_no == 15){ ?>
									<div class="col-md-8 mb-2 group_2">
										<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
										<div class="yes-no-section group_2">
											<select class="form-select question15" aria-label="Default select example" name="<?php echo $question->id ?>[]">
												<option selected value="">Please select one option</option>
												<option value="premenopausal/still having periods​">Premenopausal/still having periods​</option>
												<option value="perimenopausal">Perimenopausal</option>
												<option value="postmenopausal">Postmenopausal</option>
											</select>
										</div>
									</div>
								<?php } else if($question->q_no == 16){ ?>

									<div class="row mt-5 question16 group_2">
									    <div class="col-md-8 mb-2">
									        <label><?php echo $question->q_no.". ".$question->questionnaire; ?><?php if (!empty($question->tip)) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
									        <!-- <div class="yes-no-section mt-4">
									        	<select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
													<option selected value="">Please select Age</option>
													<option value="age 35​">35​</option>
													<option value="age 36​">36​</option>
													<option value="age 37​">37​</option>
													<option value="age 38​">38​</option>
													<option value="age 39​">39​</option>
													<option value="age 40​">40​</option>
													<option value="age 41​">41​</option>
													<option value="age 42​">42​</option>
													<option value="age 43​">43​</option>
													<option value="age 44​">44​</option>
													<option value="age 45​">45​</option>
													<option value="I have not started menstruating​">I have not started menstruating​</option>
												</select>
									            	
									        </div> -->
									        <!-- <div class="yes-no-section mt-4">
    <select class="form-select" aria-label="Default select example" name="ageSelect[]" id="ageSelect">
        <option selected value="">Please select Age</option>
        <?php
        if (!empty($currentAge[0]['dob'])) {
            $dob = $currentAge[0]['dob'];
            $dateOfBirth = new DateTime($dob);
            $currentDate = new DateTime();
            $diff = $currentDate->diff($dateOfBirth);
            $currentAge = $diff->y;

            for ($i = 35; $i <= 55; $i++) {
                if ($i <= $currentAge) {
                    echo '<option value="age ' . $i . '">' . $i . '</option>';
                }
            }
        } else {
            for ($i = 35; $i <= 45; $i++) {
                echo '<option value="age ' . $i . '">' . $i . '</option>';
            }
        }
        ?>
        <option value="I have not started menstruating">I have not started menstruating</option>
    </select>
</div> -->
									<div class="row mt-5 question16 group_2">
									    <div class="col-md-8 mb-2">
									        <label><?php echo $question->q_no.". ".$question->questionnaire; ?><?php if (!empty($question->tip)) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
									        <div class="yes-no-section mt-4">
									            <?php
												if (!empty($currentAge[0]['dob'])) {
												    $dob = $currentAge[0]['dob'];
												    $dateOfBirth = new DateTime($dob);
												    $currentDate = new DateTime();
												    $diff = $currentDate->diff($dateOfBirth);
												    $currentAge = $diff->y;

												    echo '<select class="form-select" aria-label="Default select example" name="'.$question->id.'[]">';
												    echo '<option selected value="">Please select Age</option>';
												    for ($i = 35; $i <= $currentAge; $i++) {
												        echo '<option value="age '.$i.'">'.$i.'</option>';
												    }
												    echo '<option value="I have not started menstruating">I have not started menstruating</option>';
												    echo '</select>';
												}
												?>
									        </div>
									    </div>
									</div>

									    </div>
									</div>

								<?php } else if($question->q_no == 17){ ?>
									<div class="row mt-5 group_2">
										<div class="col-md-8 mb-2">
											<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
											<div class="yes-no-section">
												<select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
													<option selected value="">Please select Age</option>
													<option value="age 7​">7​</option>
													<option value="age 8​">8​</option>
													<option value="age 9​">9​</option>
													<option value="age 10​">10​</option>
													<option value="age 11​">11​</option>
													<option value="age 12​">12​</option>
													<option value="age 13​">13​</option>
													<option value="age 14​">14​</option>
													<option value="age 15​">15​</option>
													<option value="age 16​">16​</option>
													<option value="age 17​">17​</option>
													<option value="age 18​">18​</option>
													<option value="age 19​">19​</option>
													<option value="age 20​">20​</option>
													<option value="I have not started menstruating​">I have not started menstruating​</option>

												</select>
											</div>
										</div>
									</div>
								<?php } else if($question->q_no == 18){ ?>
									<div class="col-md-8 mb-2 group_3">
										<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
										<div class="yes-no-section">
											<div class=" mb-2">
												<input class="question18" type="radio" name="<?php echo $question->id ?>[]" value="yes">
												<label>
													Yes
												</label>
											</div>
											<div class=" mb-2">
												<input class="question18" type="radio"  name="<?php echo $question->id ?>[]" value="no" >
												<label>
													No
												</label>
											</div>
										</div>
									</div>
								<?php } else if($question->q_no == 19){ ?>
									<div class="col-md-8 mb-2 question19 group_3">
										<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
										<div class="yes-no-section mt-4">
											<select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
												<option selected value="">Please select one option</option>
												<option value="Mother​">Mother​</option>
												<option value="Father​">Father​</option>
												<option value="Sibling​">Sibling​</option>
												<option value="Child​">Child​</option>
												<option value="Aunt​">Aunt​</option>
												<option value="Uncle​">Uncle​</option>
												<option value="Grandparent​">Grandparent​</option>
												<option value="Cousin​">Cousin​</option>
												<option value="Niece​">Niece​</option>
												<option value="Nephew​">Nephew​</option>
												<option value="Others​">Others​</option>

											</select>
										</div>
									</div>
								<?php } else if($question->q_no == 20){ ?>
									<div class="col-md-8 mb-2 group_3">
										<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
										<div class="yes-no-section">
											<div class=" mb-2">
												<input class="question20" type="radio" name="<?php echo $question->id ?>[]" value="yes">
												<label>
													Yes
												</label>
											</div>
											<div class=" mb-2">
												<input class="question20" type="radio"  name="<?php echo $question->id ?>[]" value="no" >
												<label>
													No
												</label>
											</div>
										</div>
									</div>
								<?php } else if($question->q_no == 21){ ?>
									<div class="col-md-8 mb-2 question21 group_3">
										<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
										<div class="yes-no-section mt-4">
											<select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
												<option selected value="">Please select one option</option>
												<option value="Mother​">Mother​</option>
												<option value="Father​">Father​</option>
												<option value="Sibling​">Sibling​</option>
												<option value="Child​">Child​</option>
												<option value="Aunt​">Aunt​</option>
												<option value="Uncle​">Uncle​</option>
												<option value="Grandparent​">Grandparent​</option>
												<option value="Cousin​">Cousin​</option>
												<option value="Niece​">Niece​</option>
												<option value="Nephew​">Nephew​</option>
												<option value="Others​">Others​</option>
											</select>
										</div>
									</div>
								<?php } else if($question->q_no == 22){ ?>
									<div class="col-md-8 mb-2 group_3">
										<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
										<div class="yes-no-section">
											<div class=" mb-2">
												<input class="question22" type="radio" name="<?php echo $question->id ?>[]" value="yes">
												<label>
													Yes
												</label>
											</div>
											<div class=" mb-2">
												<input class="question22" type="radio"  name="<?php echo $question->id ?>[]" value="no" >
												<label>
													No
												</label>
											</div>
										</div>
									</div>
								<?php } else if($question->q_no == 23){ ?>
									<div class="col-md-8 mb-2 question23 group_3">
										<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label> 
										<div class="yes-no-section mt-4">
											<div class="input-group mb-3 mt-4">
												<input type="date" name="<?php echo $question->id ?>[]" class="form-control" placeholder="date (mm/yyyy) to be filled in by patient/HCP" aria-label="Username" aria-describedby="basic-addon1" max="<?php echo $currentDate; ?>">
											</div>
														</div>
													</div>
												<?php } else if($question->q_no == 24){ ?>
													<div class="col-md-8 mb-2 question24 group_3">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														<div class="yes-no-section mt-4">
															<select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
																<option selected value="">Please select one option</option>
																<option value="Normal​">Normal​</option>
																<option value="Abnormal​">Abnormal​</option>
															</select>
														</div>
													</div>
												<?php } else if($question->q_no == 25){ ?>
													<div class="col-md-8 mb-2 group_4">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														<div class="yes-no-section">
															<div class="input-group mb-3 mt-4">
																<input type="text" name="<?php echo $question->id ?>[]" class="form-control" placeholder="Insert full name of procedure. Eg: 3D mammogram with tomosynthesis" aria-label="Username" aria-describedby="basic-addon1">
															</div>
														</div>
													</div>
												<?php } else if($question->q_no == 26){ ?>
													<div class="col-md-8 mb-2 group_4">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														<div class="yes-no-section mt-4">
															<select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
																<option selected value="">Please select one option</option>
																<option value="The breasts are entirely fatty​">The breasts are entirely fatty​
																​</option>
																<option value="There are scattered areas of fibroglandular density.​">There are scattered areas of fibroglandular density.​</option>
																<option value="The breasts are heterogeneously dense, which may obscure small masses​">The breasts are heterogeneously dense, which may obscure small masses​
																​</option>
																<option value="The breasts are extremely dense, which lowers the sensitivity of mammography">The breasts are extremely dense, which lowers the sensitivity of mammography
																​</option>

															</select>
														</div>
													</div>
												<?php } else if($question->q_no == 27){ ?>
													<div class="col-md-8 mb-2 group_4">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														<div class="yes-no-section">
															<div class=" mb-2">
																<input class="question27" type="radio" name="<?php echo $question->id ?>[]" value="yes">
																<label>
																	Yes
																</label>
															</div>
															<div class=" mb-2">
																<input class="question27" type="radio"  name="<?php echo $question->id ?>[]" value="no" >
																<label>No</label>
															</div>
														</div>
													</div>
												<?php } else if($question->q_no == 28){ ?>
													<div class="col-md-8 mb-2 group_4 right-mass-present" style="display: none;">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														<select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
																<option selected value="">Please select one option only</option>
																<option value="Oval">Oval</option>
																<option value="Round">Round</option>
																<option value="Irregular">Irregular</option>
														</select>
													</div>
												<?php } else if($question->q_no == 29){ ?>
													<div class="col-md-8 mb-2 group_4 right-mass-present" style="display: none;">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														<select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
																<option selected value="">Please select one option only</option>
																<option value="Circumscribed">Circumscribed</option>
																<option value="Obscured">Obscured</option>
																<option value="Microlobulated">Microlobulated</option>
																<option value="Spiculated">Spiculated</option>
														</select>
													</div>
												<?php } else if($question->q_no == 30){ ?>
													<div class="col-md-8 mb-2 group_4 right-mass-present" style="display: none;">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														<select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
																<option selected value="">Please select one option only</option>
																<option value="High">High</option>
																<option value="Equal">Equal</option>
																<option value="Low">Low</option>
																<option value="Fat-containing">Fat-containing</option>
														</select>
													</div>
												<?php } else if($question->q_no == 31){ ?>
													
													<div class="col-md-8 mb-2 group_4">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														<div class="yes-no-section">
															<div class=" mb-2">
																<input class="question31" type="radio" name="<?php echo $question->id ?>[]" value="yes">
																<label>Yes</label>
															</div>
															<div class=" mb-2">
																<input class="question31" type="radio"  name="<?php echo $question->id ?>[]" value="no" >
																<label>No</label>
															</div>
														</div>
													</div>
												<?php } else if($question->q_no == 32){ ?>

													<div class="col-md-8 mb-2 group_4 left-mass-present">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														<select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
																<option selected value="">Please select one option only</option>
																<option value="Oval">Oval</option>
																<option value="Round">Round</option>
																<option value="Irregular">Irregular</option>
															</select>
													</div>

												<?php } else if($question->q_no == 33){ ?>
													<div class="col-md-8 mb-2 question33 group_4 left-mass-present">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														<select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
																<option selected value="">Please select one option only</option>
																<option value="Circumscribed">Circumscribed</option>
																<option value="Obscured">Obscured</option>
																<option value="Microlobulated">Microlobulated</option>
																<option value="Spiculated">Spiculated</option>
														</select>
													</div>
												<?php } else if($question->q_no == 34){ ?>
													<div class="col-md-8 mb-2 question34 group_4 left-mass-present">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
															<select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
																<option selected value="">Please select one option only</option>
																<option value="High">High</option>
																<option value="Equal">Equal</option>
																<option value="Low">Low</option>
																<option value="Fat-containing">Fat-containing</option>
															</select>
															
													</div>
												<?php } else if($question->q_no == 35){ ?>
													<div class="col-md-8 mb-2 question35 group_4">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>

														<div class="yes-no-section">
															<div class=" mb-2">
																<input class="question35" type="radio" name="<?php echo $question->id ?>[]" value="yes">
																<label>
																	Yes
																</label>
															</div>
															<div class=" mb-2">
																<input class="question35" type="radio"  name="<?php echo $question->id ?>[]" value="no" >
																<label>
																	No
																</label>
															</div>
														</div>
															
													</div>
												<?php } else if($question->q_no == 36){ ?>
													<div class="col-md-8 mb-2 question36 group_4 left-calcifications-present">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														<select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
																<option selected value="">Please select one option only</option>
																<option value="Diffuse">Diffuse</option>
																<option value="Regional​">Regional​</option>
																<option value="Grouped​">Grouped​</option>
																<option value="Linear">Linear</option>
																<option value="Segmental">Segmental</option> 
															</select>
													</div>
												<?php } else if($question->q_no == 37){ ?>
													<div class="col-md-8 mb-2 question37 group_4 left-calcifications-present">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														<div class="yes-no-section">
															<select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
																<option selected value="">Please select one option only</option>
																<option value="Typically benign">Typically benign</option>
																<option value="Suspicious">Suspicious</option> 
															</select>
														</div>
													</div>
												<?php } else if($question->q_no == 38){ ?>
													<div class="col-md-8 mb-2 question38 group_4 question37sup left-typically-benign-present">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														<select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
																<option selected value="">Please select one option only</option>
																<option value="Skin">Skin</option>
																<option value="Vascular">Vascular</option>
																<option value="Coarse or 'Popcorn-like'">Coarse or 'Popcorn-like'</option>
																<option value="Large Rod-Like">Large Rod-Like</option>
																<option value="Round">Round</option>
																<option value="Rim">Rim</option>
																<option value="Dystrophic">Dystrophic</option>
																<option value="Milk of calcium">Milk of calcium</option>
																<option value="Suture">Suture</option>
															</select>
														<!-- <div class="yes-no-section">
															<div class="input-group mb-3 mt-4">
																<input type="text" name="<?php echo $question->id ?>[]" class="form-control" placeholder="HCP to fill in" aria-label="Username" aria-describedby="basic-addon1">
															</div>
														</div> -->
														
														
													</div>
												<?php } else if($question->q_no == 39){ ?>
													<div class="col-md-8 mb-2 group_4 question37sup question39 left-suspicious-present">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														<div class="yes-no-section">
															<select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
																<option selected value="">Please select one option only</option>
																<option value="Amorphouse">Amorphouse</option>
																<option value="Coarse heterogeneous">Coarse heterogeneous</option>
																<option value="Fine pleomorphic">Fine pleomorphic</option>
																<option value="Fine linear or fine-linear branching">Fine linear or fine-linear branching</option>
															</select>
														</div>
													</div>

												<?php } else if($question->q_no == 40){ ?>
													<div class="col-md-8 mb-2 group_5 question40">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														<div class="yes-no-section">
															<div class="yes-no-section">
																<div class=" mb-2">
																	<input class="question40" type="radio" name="<?php echo $question->id ?>[]" value="yes">
																	<label>
																		Yes
																	</label>
																</div>
																<div class=" mb-2">
																	<input class="question40" type="radio"  name="<?php echo $question->id ?>[]" value="no" >
																	<label>
																		No
																	</label>
																</div>
															</div>
														</div>
													</div>

												<?php } else if($question->q_no == 41){ ?>

													<div class="col-md-8 mb-2 group_5 question41 right-calcifications-present">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														<div class="yes-no-section">
															<select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
																<option selected value="">Please select one option only</option>
																<option value="Diffuse">Diffuse</option>
																<option value="Regional​">Regional​</option>
																<option value="Grouped​">Grouped​</option>
																<option value="Linear">Linear</option>
																<option value="Segmental">Segmental</option>
															</select>
														</div>
													</div>
												<?php } else if($question->q_no == 42){ ?>

													<div class="col-md-8 mb-2 group_5 question42">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														<div class="yes-no-section">
															<select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
																<option selected value="">Please select one option only</option>
																<option value="Typically benign">Typically benign</option>
																<option value="Suspicious">Suspicious</option> 
															</select>
														</div>
													</div>
												<?php } else if($question->q_no == 43){ ?>
													<div class="col-md-8 mb-2 group_6 question42sup right-typically-benign-present">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														<div class="yes-no-section">
															<select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
																<option selected value="">Please select one option only</option>
																<option value="Skin">Skin</option>
																<option value="Coarse or 'Popcorn-like'">Coarse or 'Popcorn-like'</option>
																<option value="Large Rod-Like">Large Rod-Like</option>
																<option value="Round">Round</option>
																<option value="Rim">Rim</option>
																<option value="Dystrophic">Dystrophic</option>
																<option value="Milk of calcium">Milk of calcium</option>
																<option value="Suture">Suture</option>
															</select>
														</div>
													</div>
												<?php } else if($question->q_no == 44){ ?>
													<div class="col-md-8 mb-2 group_6 question42sup right-suspicious-present">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														<div class="yes-no-section">
															<select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
																<option selected value="">Please select one option only</option>
																<option value="Amorphouse">Amorphouse</option>
																<option value="Coarse heterogeneous">Coarse heterogeneous</option>
																<option value="Fine pleomorphic">Fine pleomorphic</option>
																<option value="Fine linear or fine-linear branching">Fine linear or fine-linear branching</option>
															</select>
														</div>
													</div>
												<?php } else if($question->q_no == 45){ ?>
													<div class="col-md-8 mb-2 group_6">

														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														<div class="yes-no-section">
															<div class=" mb-2">
																<input class="" type="radio" name="<?php echo $question->id ?>[]" value="yes">
																<label>Yes</label>
															</div>
															<div class=" mb-2">
																<input class="" type="radio"  name="<?php echo $question->id ?>[]" value="no">
																<label>No</label>
															</div>
														</div>
													</div>
												<?php } else if($question->q_no == 46){ ?>
													<div class="col-md-8 mb-2 group_6">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														<div class="yes-no-section">
															<div class=" mb-2">
																<input class="" type="radio" name="<?php echo $question->id ?>[]" value="yes">
																<label>Yes</label>
															</div>
															<div class=" mb-2">
																<input class="" type="radio"  name="<?php echo $question->id ?>[]" value="no">
																<label>No</label>
															</div>
														</div>
													</div>
												<?php } else if($question->q_no == 47){ ?>
													<div class="col-md-8 mb-2 group_6">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														<div class="yes-no-section">

															<select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
																<option selected value="">Please select one option only</option>
																<option value="None">None</option>
																<option value="Asymmetry"> Asymmetry </option>
																<option value="Global asymmetry"> Global asymmetry</option>
																<option value="Focal asymmetry"> Focal asymmetry</option>
																<option value="Developing asymmetry">Developing asymmetry</option>
															</select>
														</div>
													</div>
												<?php } else if($question->q_no == 48){ ?>
													<div class="col-md-8 mb-2 group_6">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>

														<div class="yes-no-section">
															<div class="input-group mb-3 mt-4">

															<select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
																<option selected value="">Please select one option only</option>
																<option value="None">None</option>
																<option value="Present">Present</option>
															</select>
															</div>
														</div>
														
														
													</div>

												<?php } else if($question->q_no == 49){ ?>
													<div class="col-md-8 mb-2 group_6">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														<div class="yes-no-section">

														<select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
																<option selected value="">Please select one option only</option>
																<option value="None">None</option>
																<option value="Present">Present</option>
															</select>
														</div>
													</div>
												<?php } else if($question->q_no == 50){ ?>
													<div class="col-md-8 mb-2 group_6">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														<div class="yes-no-section">

														<select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
																<option selected value="">Please select one option only</option>
																<option value="None">None</option>
																<option value="Present">Present</option>
															</select>
														</div>
													</div>
												<?php } else if($question->q_no == 51){ ?>
													<div class="col-md-8 mb-2 group_6">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														<div class="yes-no-section">
														<select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
																<option selected value="">Please select one option only</option>
																<option value="None">None</option>
																<option value="Skin retraction"> Skin retraction</option>
																<option value="Nipple retraction"> Nipple retraction</option>
																<option value="Skin thickening"> Skin thickening</option>
																<option value="Trabecular thickening"> Trabecular thickening</option>
																<option value="Axillary adenopathy"> Axillary adenopathy</option>
																<option value="Architectural distortion"> Architectural distortion</option>
																<option value="Calcifications"> Calcifications</option>
															</select>
														</div>
													</div>
												<?php } else if($question->q_no == 52){ ?>
													<div class="col-md-8 mb-2 group_6">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
															<select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
																<option selected value="">Please select one option only</option>
																<option value="BIRADS 0​">BIRADS 0​</option>
																<option value="BIRADS 1​">BIRADS 1​</option>
																<option value="BIRADS 2​">BIRADS 2​</option>
																<option value="BIRADS 3​">BIRADS 3​</option>
																<option value="BIRADS 4">BIRADS 4</option>
																<option value="BIRADS 5​">BIRADS 5​</option>
																<option value="BIRADS 6">BIRADS 6</option>
															</select>
													</div>
												<?php } else if($question->q_no == 53){ ?>
													<div class="col-md-8 mb-2 group_6">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														<div class="yes-no-section">
																<input type="text" name="<?php echo $question->id ?>[]" class="form-control" placeholder="HCP to fill in" aria-label="Username" aria-describedby="basic-addon1">
														</div>												
													</div>
												<?php } else if($question->q_no == 54){ ?>
													<div class="col-md-8 mb-2 group_6">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														<select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
																<option selected value="">Please select one option only</option>
																<option value="None">None</option>
																<option value="Asymmetry"> Asymmetry </option>
																<option value="Global asymmetry"> Global asymmetry</option>
																<option value="Focal asymmetry"> Focal asymmetry</option>
																<option value="Developing asymmetry">Developing asymmetry</option>
															</select>
														
													</div>
												<?php } else if($question->q_no == 55){ ?>
													<div class="col-md-8 mb-2 group_6">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														<select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
																<option selected value="">Please select one option only</option>
																<option value="None">None</option>
																<option value="Present">Present</option>
															</select>
														
													</div>
												<?php } else if($question->q_no == 56){ ?>
													<div class="col-md-8 mb-2 group_6">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														<select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
																<option selected value="">Please select one option only</option>
																<option value="None">None</option>
																<option value="Present">Present</option>
															</select>
														
													</div>
												<?php } else if($question->q_no == 57){ ?>
													<div class="col-md-8 mb-2 group_6">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														<select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
																<option selected value="">Please select one option only</option>
																<option value="None">None</option>
																<option value="Present">Present</option>
															</select>
														
													</div>
												<?php } else if($question->q_no == 58){ ?>
													<div class="col-md-8 mb-2 group_6">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														<select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
																<option selected value="">Please select one option only</option>
																<option value="None">None</option>
																<option value="Skin retraction"> Skin retraction</option>
																<option value="Nipple retraction"> Nipple retraction</option>
																<option value="Skin thickening"> Skin thickening</option>
																<option value="Trabecular thickening"> Trabecular thickening</option>
																<option value="Axillary adenopathy"> Axillary adenopathy</option>
																<option value="Architectural distortion"> Architectural distortion</option>
																<option value="Calcifications"> Calcifications</option>
															</select>
														
													</div>
												<?php } else if($question->q_no == 59){ ?>
													<div class="col-md-8 mb-2 group_6">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														<select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
																<option selected value="">Please select one option only</option>
																<option value="BIRADS 0​">BIRADS 0​</option>
																<option value="BIRADS 1​">BIRADS 1​</option>
																<option value="BIRADS 2​">BIRADS 2​</option>
																<option value="BIRADS 3​">BIRADS 3​</option>
																<option value="BIRADS 4">BIRADS 4</option>
																<option value="BIRADS 5​">BIRADS 5​</option>
																<option value="BIRADS 6">BIRADS 6</option>
															</select>
														
													</div>
												<?php } else if($question->q_no == 60){ ?>
													<div class="col-md-8 mb-2 group_6">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														<div class="yes-no-section">
																<input type="text" name="<?php echo $question->id ?>[]" class="form-control" placeholder="HCP to fill in" aria-label="Username" aria-describedby="basic-addon1">
															
														</div>
														
													</div>
												<?php } else if($question->q_no == 61){ ?>
													<div class="col-md-8 mb-2 group_6">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														<select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
																<option selected value="">Please select one option only</option>
																<option value="BIRADS 0​">BIRADS 0​</option>
																<option value="BIRADS 1​">BIRADS 1​</option>
																<option value="BIRADS 2​">BIRADS 2​</option>
																<option value="BIRADS 3​">BIRADS 3​</option>
																<option value="BIRADS 4">BIRADS 4</option>
																<option value="BIRADS 5​">BIRADS 5​</option>
																<option value="BIRADS 6">BIRADS 6</option>
															</select>
														
													</div>
												<?php } else if($question->q_no == 62){ ?>
													<div class="col-md-8 mb-2 group_6">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														<select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
																<option selected value="">Please select one option only</option>
																<option value="BIRADS 0​">BIRADS 0​</option>
																<option value="BIRADS 1​">BIRADS 1​</option>
																<option value="BIRADS 2​">BIRADS 2​</option>
																<option value="BIRADS 3​">BIRADS 3​</option>
																<option value="BIRADS 4">BIRADS 4</option>
																<option value="BIRADS 5​">BIRADS 5​</option>
																<option value="BIRADS 6">BIRADS 6</option>
															</select>
														
													</div>
												<?php } else if($question->q_no == 63){ ?>
													<div class="col-md-8 mb-2 group_6">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														<select class="form-select" aria-label="Default select example" name="<?php echo $question->id ?>[]">
																<option selected value="">Please select one option only</option>
																<option value="None">None</option>
																<option value="Present">Present</option>
															</select>
														
													</div>
												<?php } else if($question->q_no == 64){ ?>
													<div class="col-md-8 mb-2 group_6">
														<label><?php echo $question->q_no.". ", $question->questionnaire; ?><?php if( !empty( $question->tip ) ) { ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" title='<?php echo $question->tip; ?>'></i><?php } ?></label>
														
														<div class="yes-no-section">
															<div class="input-group mb-3 mt-4">
																<input type="file" name="<?php echo $question->id ?>" class="form-control">
															</div>

																<div class="text-secondary">Allowed Types are Images and PDF. File size should not exceed 15mb.</div>
														</div>														
													</div>
												<?php }  ?>

												
											</div>
										<?php } } ?>

										<div class="row mt-5 mb-5 completed text-center">
												<?php 
                        $date = new DateTime($assessment_header_data->assessment_date);
                        $date->modify('+12 month'); 
                        $next_assessment_date = $date->format('jS F Y');
                        $next_assessment_date_ymd = $date->format('Y-m-d');
                    ?>
                     <p><span class="next-ass-date">Next Assessment Date: <?php echo $next_assessment_date;  ?></span></p>
                    <input type="hidden" name="next_assesment_date" value="<?php echo $next_assessment_date_ymd; ?>">
												<p>This will be the final assessment submission. Are you sure?</p>
												<!-- <a href="<?php echo base_url('screening/mammogram/success_full'); ?>"> -->
												<div class="row">
													<div class="col-md-4"></div>
													<div class="col-md-4">
														<button class="btn submit-btn w-100">Submit</button> 
														<!-- </a> -->
													</div> 
													<div class="col-md-4"></div>
												</div>
											</div>
										</div>
									</form>

									<hr/>

									<div class="prev-next-btn mb-4">
        <div class="row footernode">
            <div class="col">
                <div class="">
                    <button class="btn prev-btn" id="previous">
                        <span class="prev-icon"><ion-icon name="chevron-back-outline"></ion-icon></span>
                        Previous
                          <input type="hidden" name="" value="group_1" id="previous_page">
                      </button>
                </div>
            </div>
            <div class="col hide_progress_responsive">
                <!-- <div class="container"> -->
                    <div class="card">
                        <ul class="progress_bar mammogram_questions1">
                            <li class="active" id="group_2">Step</li>
                            <li id="group_3">Step</li>
                            <li id="group_4">Step</li>
                            <li id="group_5">Step</li>
                            <li id="group_6">Step</li>
                            <li id="completed">Completed</li> 
                        </ul>
                    </div>
                    
                <!-- </div> -->
            </div>
            <div class="col">
                <div class="">
                    <!-- <a href="../ScreeningQuestions/ScreeningQuestionTwo.html"> -->
                        <button class="btn next-btn float-end" id="next">
                            Next <span class="next-icon"><ion-icon name="chevron-forward-outline"></ion-icon></span>
                            <input type="hidden" name="" value="group_2" id="current_page">
                        </button>
                    <!-- </a> -->
                </div>
            </div>
        </div>
        </div> 
										
									</div>

									<!-- <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
									<script>
									    $(document).ready(function() {
									    	<?php
									            if (!empty($currentAge[0]['dob'])) {
									                $dob = $currentAge[0]['dob'];
									                $dateOfBirth = new DateTime($dob);
									                $currentDate = new DateTime();
									                $diff = $currentDate->diff($dateOfBirth);
									                $currentAge = $diff->y;
									            } else {
									                $currentAge = 0;
									            }
									        ?>
									        
									        var currentAge = <?php echo $currentAge; ?>;
									        
									        if (currentAge) {
									            for (var i = 35; i <= currentAge; i++) {
									                $('#ageSelect').append($('<option>', {
									                    value: 'age ' + i,
									                    text: i
									                }));
									            }
									            $('#ageSelect').append($('<option>', {
									                value: 'I have not started menstruating',
									                text: 'I have not started menstruating'
									            }));
									        } else {
									            for (var i = 35; i <= 45; i++) {
									                $('#ageSelect').append($('<option>', {
									                    value: 'age ' + i,
									                    text: i
									                }));
									            }
									            $('#ageSelect').append($('<option>', {
									                value: 'I have not started menstruating',
									                text: 'I have not started menstruating'
									            }));
									        }
									        
									        // Display selected age
									        $('#ageSelect').change(function() {
									            var selectedAge = $(this).val();
									            if (selectedAge !== "") {
									                console.log('Selected Age:', selectedAge);
									                // Add your desired code here to handle the selected age
									            }
									        });
									</script> -->

									<script src="<?php echo base_url('assets/js/mamogram.js'); ?>"></script>
						<script>
									var tooltipList1 = [].slice.call(document.querySelectorAll('[data-bs-toggle = "tooltip"]'))
									var tooltipList2 = tooltipList1.map(function(tooltipTriggerfun) {
										return new bootstrap.Tooltip(tooltipTriggerfun)
									})									
								</script>
