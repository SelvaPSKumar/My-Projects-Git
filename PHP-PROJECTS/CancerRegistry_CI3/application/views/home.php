<?php
if (isset($_GET['adminLog'])) {
  $adminLog = $_GET['adminLog'];
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">
  @media only screen and (max-width: 600px) {  
    div.login-selection-container > div.row {
      row-gap: 20px;
    }
    div.login-form form {
     /* row-gap: 20px; 
      border: 1px solid #c5c5c5;
      border-radius: 0.2em;
      background-color: white;
     */
    }
    div.login-form form div.col-md-4 , div.login-form form div.col-md-3{
     /* border-top: solid;  
      border-radius: 0.2em ;   */
    }  
    div.login-form input:not(:focus) {
     /* box-shadow: 0 0 0 0.25rem rgb(16 16 16);*/
     border: 1px solid #c5c5c5;
    }
  }   
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <div class="container-fluid cancerApp-Home" id="overlay-bg">
    <div class="container">
      <div class="home-content">
        <div class="text-center">
          <h1>National Cancer Screening Registry</h1>
          <!-- <p>Providing the best possible care and support for those affected by cancer.</p> -->
        </div>
        <div class="login-selection-container">
          <div class="row">
            <?php 
              $errors = $this->session->userdata('errors');
              if ($errors) { ?>
                  <div class="alert alert-warning" role="alert" style="display: block;">
                         <?php 
                            echo $errors;
                            unset($_SESSION['errors']); 
                         ?> 
                  </div>
                 
            <?php } ?>

            <?php 
              $success = $this->session->userdata('success');
              if ($success) { ?>
                  <div class="alert alert-success" role="alert" style="display: block;">
                         <?php 
                            echo $success;
                            unset($_SESSION['success']); 
                         ?> 
                  </div>
                 
            <?php } ?>
            <div class="col-sm-12 col-12 d-flex justify-content-center">
            <div class="card">
              <div class="card-body mb-4">
                <div class="row">
                  <div class="col-12">
                    <div class="text-center">
                      <img src="<?php echo base_url('assets/img/') ?>admin.png" class="doctor-image-login" />

                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <h6 class="text-center mt-1">Admin</h6>
                  </div>
                </div>

                </div>
                <div class="card-footer text-center bg-white p-0">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="admin-assesment"
                      value="3" checked onclick="adminAssesment()">
                    <label class="form-check-label" for="admin-assesment">
                      Select
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div>

          </div>
        </div>
        <div class="login-form" id="admin-login" style="max-width: 580px;">
          <form class="row px-2" action="<?php echo base_url('login'); ?>" method="POST">
            <div class="col-md-4 email-field">
              <input type="hidden" name="role" value="<?php echo ($facilityadmin_role->rolecode == FACILITY_ADMIN) ? $facilityadmin_role->id : 0; ?>">
              <input type="email" name="email" class="form-control" id="staticEmail2" placeholder="Email/Username">
            </div>
            <div class="col-md-1" id="mobile-view">
              <p class="center-bar">|</p>
            </div>
            <div class="col-md-4 password-field">
              <div style="display: inline-flex;width:100%;">
                <input type="password" name="password" class="form-control inputPassword2" id="inputPassword2" placeholder="Password" style="padding-right: 25%;">
                <i class="far fa-eye togglePassword" style="margin-top: 25px;    cursor: pointer;   margin-left: -30px;"></i>
              </div>
            </div>
            <div class="col-md-3 login-btn-outer">
              <button type="submit" class="btn btn-primary mb-3 login-btn">Login</button>
            </div>
          </form>
            
            <div class="forget-login-details d-flex" data-bs-toggle="modal"
            data-bs-target="#forgot_password" style="cursor: pointer;">
                  <p class="">Forgot Login Details</p>
                  <span>
                    <ion-icon name="chevron-forward-outline"></ion-icon>
                  </span>
            </div>

        </div>
      </div>
    </div>

  </div>
    <?php } else { ?>

      <style type="text/css">
  @media only screen and (max-width: 600px) {  
    div.login-selection-container > div.row {
      row-gap: 20px;
    }
    div.login-form form {
     /* row-gap: 20px; 
      border: 1px solid #c5c5c5;
      border-radius: 0.2em;
      background-color: white;
     */
    }
    div.login-form form div.col-md-4 , div.login-form form div.col-md-3{
     /* border-top: solid;  
      border-radius: 0.2em ;   */
    }  
    div.login-form input:not(:focus) {
     /* box-shadow: 0 0 0 0.25rem rgb(16 16 16);*/
     border: 1px solid #c5c5c5;
    }
  }  
  /* .individual {
      padding-left: 90px;
    }
  @media (min-width: 320px) and (max-width: 770px) {
    .individual {
      padding-left: 0;
    }
  } */
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <div class="container-fluid cancerApp-Home" id="overlay-bg">
    <div class="container">
      <div class="home-content">
        <div class="text-center">
          <h1>National Cancer Screening Registry</h1>
          <!-- <p>Providing the best possible care and support for those affected by cancer.</p> -->
        </div>
        <div class="login-selection-container">
          <?php 
            $errors = $this->session->userdata('errors');
            if ($errors) { ?>
              <div class="alert alert-warning" role="alert" style="display: block;">
                <?php 
                  echo $errors;
                  unset($_SESSION['errors']); 
                ?> 
              </div>
          <?php } ?>

          <?php 
            $success = $this->session->userdata('success');
            if ($success) { ?>
              <div class="alert alert-success" role="alert" style="display: block;">
                <?php 
                  echo $success;
                  unset($_SESSION['success']); 
                ?> 
              </div>
          <?php } ?>

          <div class="row justify-content-center align-items-center gap-3">
              <div class="card">
                <div class="card-body mb-4">
                  <div class="row">
                    <div class="col-12 text-center"> <!-- Added "text-center" class -->
                      <h6 class="text-center mt-5">Individual</h6>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-center bg-white p-0">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="patient-assesment" value="1" checked onclick="selfAssesment()">
                    <label class="form-check-label" for="patient-assesment">
                      Select
                    </label>
                  </div>
                </div>
            </div>
              <div class="card">
                <div class="card-body mb-4">
                  <div class="row">
                    <div class="col-12 text-center"> <!-- Added "text-center" class -->
                      <h6 class="text-center mt-1">Healthcare Professional (HCP) or Institution</h6>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-center bg-white p-0">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="doctor-assesment" value="2" onclick="clinicalAssesment()">
                    <label class="form-check-label" for="doctor-assesment">
                      Select
                    </label>
                  </div>
                </div>
              </div>
          </div>
        </div>

        <div>

        </div>
      </div>
        <div class="login-form" id="patient-login" style="max-width: 580px;">
          <form class="row px-2" action="<?php echo base_url('login'); ?>" method="POST">
            <div class="col-md-4 email-field">
              <input type="hidden" name="role" value="<?php echo ($patient_role->rolecode == PATIENT) ? $patient_role->id : 0; ?>">
              <input type="email" name="email" class="form-control" id="staticEmail2" placeholder="Email/Username">
            </div>
            <div class="col-md-1" id="mobile-view">
              <p class="center-bar">|</p>
            </div>            
            <div class="col-md-4 password-field">
              <div style="display: inline-flex;width:100%;">
                <input type="password" name="password" class="form-control inputPassword2" id="inputPassword2" placeholder="Password" style="padding-right: 25%;">
                <i class="far fa-eye togglePassword" style="margin-top: 25px;    cursor: pointer;   margin-left: -30px;"></i>
              </div>
            </div>
            <div class="col-md-3 login-btn-outer">
              <button type="submit" class="btn btn-primary mb-3 login-btn">Login</button>
            </div>
          </form>

            <div class="forget-login-details d-flex" data-bs-toggle="modal"
            data-bs-target="#forgot_password" style="cursor: pointer;">
                  <p class="">Forgot Login Details</p>
                  <span>
                    <ion-icon name="chevron-forward-outline"></ion-icon>
                  </span>
            </div>

        </div>
        <div class="login-form" id="doctor-login" style="max-width: 580px;">
          <form class="row px-2" action="<?php echo base_url('login'); ?>" method="POST">
            <div class="col-md-4 email-field">
              <input type="hidden" name="role" value="<?php echo ($medicprac_role->rolecode == MEDICPRAC) ? $medicprac_role->id : 0; ?>">
              <input type="email" name="email" class="form-control" id="staticEmail2" placeholder="Email/Username">
            </div>
            <div class="col-md-1" id="mobile-view">
              <p class="center-bar">|</p>
            </div>
            <div class="col-md-4 password-field">
              <div style="display: inline-flex;width:100%;">
                <input type="password" name="password" class="form-control inputPassword2" id="inputPassword2" placeholder="Password" style="padding-right: 25%;">
                <i class="far fa-eye togglePassword" style="margin-top: 25px;    cursor: pointer;   margin-left: -30px;"></i>
              </div>
            </div>
            <div class="col-md-3 login-btn-outer">
              <button type="submit" class="btn btn-primary mb-3 login-btn">Login</button>
            </div>
          </form>

          <div class="forget-login-details d-flex" data-bs-toggle="modal"
            data-bs-target="#forgot_password" style="cursor: pointer;">
                  <p class="">Forgot Login Details</p>
                  <span>
                    <ion-icon name="chevron-forward-outline"></ion-icon>
                  </span>
            </div>

        </div>
    </div>
  </div>
  <?php } ?>

  <!-- <div class="container-fluid sub-contents">
                <div class="container">
                  <div class="vaccines-details mt-5">
                    <h1 class="topic-headers"><span class="text-warning me-2">|</span>Vaccines Given</h1>

                    <div class="row">
                      <div class="card vaccines-background">
                        <div class="row">
                          <div class="col-4">
                            <img src="<?php echo base_url('assets/img/') ?>vaccines-grains.svg" alt="" class="img-fluid image-sizing" />
                          </div>
                          <div class="col-4">
                            <div class="vaccine-counts">
                              <h6>151,258</h6>
                              <p>Vaccines Given</p>
                            </div>
                          </div>
                          <div class="col-4">
                            <img src="<?php echo base_url('assets/img/') ?>vaccine-frame.svg" alt="" class="img-fluid image-sizing" />

                          </div>

                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 mb-2">
                        <div class="card vaccine-card-outer">
                          <div class="card-body vaccine-card-inner">
                            <div class="card-info">
                              <h5>House-To-House
                              </h5>
                              <h5> Vaccination Programme</h5>
                              <p>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                It has survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 mb-2">
                        <div class="card vaccine-card-outer">
                          <div class="card-body vaccine-card-inner-doc">
                            <div class="card-info">

                              <h5>Public Vaccination
                                Centres</h5>
                              <h2>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </h2>
                              <ul>
                                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                                  the industry's
                                </li>
                                <li> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                                  the industry's
                                </li>
                                <li> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                                  the industry's
                                </li>
                                <li> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                                  the industry's
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="text-center mt-5 mb-5">
                        <button class="btn common-btn">FAQ’s</button>
                      </div>
                    </div>

                    <div class="row">
                      <div class="card volunteers-background">
                        <div class="row text-center volunteers-signup">
                          <h1>Call for Volunteers</h1>
                          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                            when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                            It has survived not only five centuries, but also the leap into electronic typesetting,
                            remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets</p>
                          <div class="text-center mt-4">
                            <button class="btn common-btn">SignUp here</button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-5">
                      <h1 class="topic-headers"><span class="text-warning me-2">|</span>What We Do</h1>
                      <div class="row mb-5 mt-5">
                        <div class="col-4">
                          <img src="<?php echo base_url('assets/img/') ?>doctorset1.svg" alt="doctor" class="doc-image" />
                        </div>
                        <div class="col-8">
                          <div class="we-do-content">
                            <h1>Educate</h1>
                            <p>To minimise cancer in Malaysia by raising public awareness on the prevention,
                              screening and early detection of cancer through education</p>
                            <button class="btn learn-more">Learn More</button>
                          </div>
                        </div>
                      </div>

                      <div class="row mb-5">

                        <div class="col-8">
                          <div class="we-do-content">
                            <h1>Care</h1>
                            <p>To increase access to cancer services in Malaysia by providing affordable as well as advanced
                              screening and diagnostic facilities</p>
                            <button class="btn learn-more">Learn More</button>
                          </div>
                        </div>
                        <div class="col-4">
                          <img src="<?php echo base_url('assets/img/') ?>doctorset2.svg" alt="doctor" class="doc-image" />
                        </div>
                      </div>

                      <div class="row mb-5">
                        <div class="col-4">
                          <img src="<?php echo base_url('assets/img/') ?>doctorset3.svg" alt="doctor" class="doc-image" />
                        </div>
                        <div class="col-8">
                          <div class="we-do-content">
                            <h1>Support</h1>
                            <p>To empower individuals and those affected with cancer to maintain the highest possible quality of
                              life</p>
                            <button class="btn learn-more">Learn More</button>
                          </div>
                        </div>
                      </div>

                    </div>

                    <div class="row mb-5">
                      <h1 class="topic-headers"><span class="text-warning me-2">|</span>Our Impact Across Malaysia in 2021</h1>
                      <div class="card volunteers-background">
                        <div class="row">
                          <div class="col-3">
                            <img src="<?php echo base_url('assets/img/') ?>vaccines-grains.svg" alt="" class="img-fluid image-sizing" />
                          </div>
                          <div class="col-6">
                            <div class="vaccine-counts">
                              <h6>OUR IMPACT</h6>
                              <h5>Across Malaysia</h5>
                              <h3>722,711</h3>
                              <h4>Malaysians in 2021</h4>
                              <button class="btn learn-more-btn mt-5">Learn More</button>
                            </div>
                          </div>
                          <div class="col-3">
                            <img src="<?php echo base_url('assets/img/') ?>vaccines-grains.svg" alt="" class="img-fluid image-sizing" />

                          </div>

                        </div>
                      </div>
                    </div>

                    <div class="row mb-5">
                      <h1 class="topic-headers"><span class="text-warning me-2">|</span>Highlights & Activities</h1>
                      <div class="row mt-5 mb-5">
                        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                          <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                              aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                              aria-label="Slide 2"></button>
                          </div>
                          <div class="carousel-inner">
                            <div class="carousel-item active">
                              <div class="row">
                                <div class="col-4">
                                  <div class="card">
                                    <img src="<?php echo base_url('assets/img/') ?>carosel-doc1.svg" class="card-img-top" alt="...">
                                    <div class="card-body activity-card">
                                      <p>September Clinic Promotion</p>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-4">
                                  <div class="card">
                                    <img src="<?php echo base_url('assets/img/') ?>carosel-doc2.svg" class="card-img-top" alt="...">
                                    <div class="card-body activity-card">
                                      <p>Hospital Partners</p>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-4">
                                  <div class="card">
                                    <img src="<?php echo base_url('assets/img/') ?>carosel-doc3.svg" class="card-img-top" alt="...">
                                    <div class="card-body activity-card">
                                      <p>GynPad Promotion</p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="carousel-item">
                              <div class="row">
                                <div class="col-4">
                                  <div class="card">
                                    <img src="<?php echo base_url('assets/img/') ?>carosel-doc1.svg" class="card-img-top" alt="...">
                                    <div class="card-body activity-card">
                                      <p>September Clinic Promotion</p>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-4">
                                  <div class="card">
                                    <img src="<?php echo base_url('assets/img/') ?>carosel-doc2.svg" class="card-img-top" alt="...">
                                    <div class="card-body activity-card">
                                      <p>Hospital Partners</p>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-4">
                                  <div class="card">
                                    <img src="<?php echo base_url('assets/img/') ?>carosel-doc3.svg" class="card-img-top" alt="...">
                                    <div class="card-body activity-card">
                                      <p>GynPad Promotion</p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>


                        </div>
                      
                      </div>
                    </div>

                    <div class="row mb-5">
                      <h1 class="topic-headers"><span class="text-warning me-2">|</span>News & Features</h1>
                      <div class="row mt-5 mb-5">
                        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                          <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                              aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                              aria-label="Slide 2"></button>
                          </div>
                          <div class="carousel-inner">
                            <div class="carousel-item active">
                              <div class="row">
                                <div class="col-4">
                                  <div class="card">
                                    <img src="<?php echo base_url('assets/img/') ?>card-features1.svg" class="card-img-top" alt="...">
                                    <div class="card-body activity-card">
                                      <p>September Clinic Promotion</p>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-4">
                                  <div class="card">
                                    <img src="<?php echo base_url('assets/img/') ?>card-features2.svg" class="card-img-top" alt="...">
                                    <div class="card-body activity-card">
                                      <p>Hospital Partners</p>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-4">
                                  <div class="card">
                                    <img src="<?php echo base_url('assets/img/') ?>card-features3.svg" class="card-img-top" alt="...">
                                    <div class="card-body activity-card">
                                      <p>GynPad Promotion</p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="carousel-item">
                              <div class="row">
                                <div class="col-4">
                                  <div class="card">
                                    <img src="<?php echo base_url('assets/img/') ?>card-features1.svg" class="card-img-top" alt="...">
                                    <div class="card-body activity-card">
                                      <p>September Clinic Promotion</p>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-4">
                                  <div class="card">
                                    <img src="<?php echo base_url('assets/img/') ?>card-features2.svg" class="card-img-top" alt="...">
                                    <div class="card-body activity-card">
                                      <p>Hospital Partners</p>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-4">
                                  <div class="card">
                                    <img src="<?php echo base_url('assets/img/') ?>card-features3.svg" class="card-img-top" alt="...">
                                    <div class="card-body activity-card">
                                      <p>GynPad Promotion</p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>


                        </div>
                      
                      </div>
                    </div>
                  </div>

                </div>
              </div> -->
<script>
    document.getElementById("doctor-login").style.display = "none";
    // document.getElementById("admin-login").style.display = "none";
    function selfAssesment() {
      var x = document.getElementById("patient-assesment").value;
      if (x == "1") {
        document.getElementById("patient-login").style.display = "block";
        document.getElementById("doctor-login").style.display = "none";
        // document.getElementById("admin-login").style.display = "none";

      }
    }

    function clinicalAssesment() {
      var y = document.getElementById("doctor-assesment").value;
      if (y == "2") {
        document.getElementById("patient-login").style.display = "none";
        document.getElementById("doctor-login").style.display = "block";
        // document.getElementById("admin-login").style.display = "none";

      }
    } 

    function adminAssesment() {
      var y = document.getElementById("admin-assesment").value;
      if (y == "3") {
        document.getElementById("patient-login").style.display = "none";
        document.getElementById("doctor-login").style.display = "none";
        document.getElementById("admin-login").style.display = "block";
      }
    }

    jQuery( document ).ready(function(){ 
      jQuery('.togglePassword').on('click', function (e) {
          // toggle the type attribute
          const inputnode = jQuery(this).parent('div').find('input') ;
          const type = inputnode.attr('type') === 'password' ? 'text' : 'password';
          inputnode.attr('type', type);
          // toggle the eye slash icon
          this.classList.toggle('fa-eye-slash');
      });

      $(".patient").addClass("activeNav");

      $(".admin").click(function() {
        $(".patient").removeClass("activeNav");
        $(this).addClass("activeNav");
      });


      $(".healthcare").click(function() {
        $(".patient").removeClass("activeNav");
        $(".admin").removeClass("activeNav");
        $(this).addClass("activeNav");
      });

    });
  </script>