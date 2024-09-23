<link rel="styleSheet" href="<?php echo base_url('assets/css/ScreeningNote.css'); ?>" />
<?php $CI = & get_instance(); ?>
<div class="container">
    <div class="container mt-2">
        <div class="back-container d-flex">
        <?php if($CI->session->userdata('rolecode') == MEDICPRAC){ ?>
            <a href="<?php echo base_url('all_assessments'); ?>" class="back-link">
        <?php }else{ ?>
            <a href="<?php echo base_url('test_results/breast'); ?>" class="back-link">
        <?php } ?>
            <button class="btn next-btn float-end"><span class="prev-icon"><ion-icon name="chevron-back-outline"></ion-icon></span> Back</button>
            </a>
        </div>
    </div>
        <h1 class="screeningHeader">Breast Cancer Symptom Assessment Tool</h1>  
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <div class="screening-info-card">
                <h6>Breast Self Examination</h6>
                <div class="card">
                    <div class="card-body card-body1 mb-0 mt-2">
                        <p>Breast Self Examination (BSE) should be performed 7-10 days after the first day of your period. </p>
                        <p>BSE is best performed during a shower or right after. </p>
                        <p>Stand in front of a mirror. Note any changes to your breast.</p>
                    </div>

                </div>

                <div class="row mt-5">
                    <div class="col-md-12">
                        <div class="info-notes-screening">
                        <div class="row">
                            <h1>1. Raise your right arm and place it at the back of your head.</h1>
                            <div class="mb-2">
                                 <img src="<?php echo base_url('assets/img/image 1.svg') ?>" />
                            </div>
                        </div>
                        <div class="row mt-4">
                            <h1>2. Use the ends of your fingers to massage your right breast.</h1>
                            <div class="mb-2">
                                <img src="<?php echo base_url('assets/img/image 2.svg') ?>" />
                           </div>
                        </div>
                        <div class="row mt-4">
                            <h1>3. Follow a motion of up to down or in circles.</h1>
                            <div class="mb-2">
                                <div class="row">
                                    <div class="col-md-3">
                                        <img src="<?php echo base_url('assets/img/image 3.svg') ?>" />
                                    </div>
                                    <div class="col-md-9">
                                        <img src="<?php echo base_url('assets/img/image 4.png') ?>" />
                                    </div>
                                </div>
                                
                           </div>
                        </div>
                        <div class="row mt-4">
                            <h1>4. Feel for any change in size, shape, swelling, or lumps in your breast.</h1>
                            <div class="mb-2">
                                <img src="<?php echo base_url('assets/img/image 5.png') ?>" />
                           </div>
                        </div>
                        <div class="row mt-4">
                            <h1>5. Look for changes to the skin of your breasts such as dimpling or redness.</h1>
                            <div class="mb-2">
                                <img src="<?php echo base_url('assets/img/image 6.png') ?>" />
                           </div>
                        </div>
                        <div class="row mt-4">
                            <h1>6. Look for changes to your nipple such as folding inwards or discharge.</h1>
                            <div class="mb-2">
                                <img src="<?php echo base_url('assets/img/image 7.png') ?>" />
                           </div>
                        </div>
                       <div class="mt-5">
                        <p>Now repeat steps 1 through 6 for your left breast.</p>
                        <p>Based on this BSE, answer the following questions to assess your symptoms for cancer.</p>
                       </div>
                    </div>
                </div>
                </div>
                <!-- <form action="<?php echo base_url('screening_questions'); ?>" method="POST"> -->
                    <div class="screening-btn-selection mt-5 mb-5">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <a href="../DashBoard/Dashboard.html">
                                <button class="btn">
                                    Back</button></a>
                            </div>
                            <div class="col-6">
                                <a href="<?php echo base_url('screening_questions'); ?>">
                                <button class="btn" type="submit">
                                   Click to proceed</button>
                                </a>
                            </div>
                        </div>
        
                    </div>
                <!-- </form> -->
            </div>
            </div>
        </div>

       
        
    </div>