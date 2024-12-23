<link rel="styleSheet" href="<?php base_url('assets/css/Selection.css'); ?>" />

<div class="container">
        <h1 class="screeningHeader">Forgot Password</h1>
    </div>
    <div class="container mt-2">
        <div class="back-container d-flex">
            <span class="backward-icon"><ion-icon name="chevron-back-outline"></ion-icon></span>
            <a href="../Screening/DashBoardScreening.html" class="back-link">
            <p> Back</p>
        </a>
        </div>
    </div>
    <div class="container">
        <div class="questions-section mt-5">

            <form action="<?php echo base_url('screening/clinical_questions/success_full'); ?>" method="POST">
              <div class="row">
                <div class="col-md-8 mb-2">
                    <h1>Forgot Password?</h1>
                    <div class="row">
                                <p>Please fill out your email. A link to reset password will be sent to you.</p>
                                  <div class="col-md-8">
                                    <div class=" ">
                                      <input type="text" class="form-control" name="" id="" placeholder="Email">
                                    </div>
                                  </div>

                              </div>
                </div>
                </div>
                  
            </form>

      
    </div>
    </div>
