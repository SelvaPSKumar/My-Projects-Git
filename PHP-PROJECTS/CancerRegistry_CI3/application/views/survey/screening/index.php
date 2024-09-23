<!-- <link rel="styleSheet" href="<?php echo base_url('assets/css/DashBoardScreening.css') ?>" /> -->

<div class="container">
        <h1 class="screeningHeader">Breast Cancer Screening</h1>
    </div>
    <div class="container mt-2">
        <div class="back-container d-flex">
            <span class="backward-icon"><ion-icon name="chevron-back-outline"></ion-icon></span>
            <a href="../TestResults/BreastTestResults.html" class="back-link">
            <p> Back</p>
        </a>
        </div>
    </div>
    <div class="container">
        <div class="screening-info-container">
            <p>Please click an option below to begin.</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-5">
                        <div class="card-body mb-4">
                            <div class="row">
                                <div class="col-2">
                                    <img src="<?php echo base_url('assets/img//selfawareness.svg') ?>" />
                                </div>
                                <div class="col-10">
                                    <h6 class="mt-2 mx-3">Self Assessment</h6>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer text-center bg-white p-0">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="sflexRadioDefault2">
                                <label class="form-check-label" for="sflexRadioDefault2">
                                    Select
                                </label>
                              </div>                        
                            </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-5">
                        <div class="card-body mb-4">
                            <div class="row">
                                <div class="col-2">
                                    <img src="<?php echo base_url('assets/img//Clinic.svg') ?>" />
                                </div>
                                <div class="col-10">
                                    <h6 class="mt-2 mx-3">Clinical Assessment</h6>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer text-center bg-white p-0">
                            <div class="form-check mt-0">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="cflexRadioDefault1">
                                <label class="form-check-label" for="cflexRadioDefault1">
                                 Select
                                </label>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="screening-btn">
                <div class="row">
                    <div class="col-6 mb-3">
                        <a href="../DashBoard/Dashboard.html">
                        <button class="btn">
                            Cancel</button></a>
                    </div>
                    <div class="col-6">
                        <a href="<?php echo base_url('screening_selection'); ?>">
                        <button class="btn">
                           Click to proceed</button>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>