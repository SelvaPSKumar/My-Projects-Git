<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/x-icon" href="<?=base_url('favicon.ico')?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Space+Grotesk:wght@500;600&family=Work+Sans:wght@300;400;500&display=swap"
    rel="stylesheet">
  

  <link rel="styleSheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" />

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link href="<?php echo base_url('assets/css/Selection.css') ?>" rel="styleSheet" />
  <link rel="styleSheet" href="<?php echo base_url('assets/css/DashBoardScreening.css?v1.2') ?>" />


  <!-- CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" crossorigin="anonymous" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" rel="stylesheet">

<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

  <link rel="styleSheet" href="<?php echo base_url('assets/css/app.css') ?>" />
  <link rel="styleSheet" href="<?php echo base_url('assets/css/Dashboard.css') ?>" />
<link rel="styleSheet" href="<?php echo base_url('assets/css/ScreeningQuestions.css') ?>" />
  
  
  <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
  <!-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <script type="text/javascript">
    var site_url = "<?php echo base_url(''); ?>";
  </script>
  <script src="<?php echo base_url('assets/js/idleCheck.js'); ?>" ></script>
    <style type="text/css">
      .form-group{
        padding-bottom: 15px;
      }
      @media only screen and (min-width: 578px) {  
        nav {
          margin-bottom: 50px
        }
      }


      .calendar1,.calendar2 {
            background-color: white;
            height: 100%;
            overflow: hidden;
        }

    </style>
  <title>Cancer Registry</title>
</head>

<?php $CI = & get_instance(); ?>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-white" >
    <div class="container-xxl navbar-header">
      <?php if($CI->session->userdata('id')) { ?>
      <?php if($CI->session->userdata('rolecode') == PATIENT){ ?>
      <a href="<?php echo base_url('patient/dashboard'); ?>">
      <?php } else if($CI->session->userdata('rolecode') == MEDICPRAC){ ?>
      <a href="<?php echo base_url('doctor_dashboard'); ?>">
      <?php } else if($CI->session->userdata('rolecode') == SYSTEM_ADMIN){ ?>
      <a href="<?php echo base_url('admin_dashboard'); ?>">
      <?php } else if($CI->session->userdata('rolecode') == FACILITY_ADMIN){?>
      <a href="<?php echo base_url('admin_dashboard'); ?>">
      <?php } else { ?>
      <a href="<?php echo base_url(); ?>">
      <?php } ?>
      <?php } else { ?>
      <a href="<?php echo base_url(); ?>">
      <?php } ?>

      <img class="navbar-brand navbar-logo" style="width: 150px; height: auto;" src="<?php echo base_url('assets/img/Logo.svg') ?>" /></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <?php if (!$CI->session->userdata('id')){ ?>
          <ul class="navbar-nav  ms-auto mb-2 mb-lg-0">
            <li class="nav-item mx-3">
            <a class="nav-link patient"  id="patientLog" href="<?php echo base_url(); ?>">Patient</a>
            </li>
            <li class="nav-item mx-3">
            <a class="nav-link healthcare" id="healthLog" href="#">Healthcare</a>
            </li>
            <li class="nav-item mx-3">
            <a class="nav-link admin <?php echo ($this->input->get('adminLog') && $this->input->get('adminLog') === 'true') ? 'activeNav' : '' ?>" aria-current="page" href="?adminLog=true">Admin</a>
              <!-- <a class="nav-link" href="<?php echo base_url(); ?>?adminLog" id="adminLog">Admin</a> -->
            </li>
            <li class="mx-3 mt-2">
              <div class="dropdown mx-sm-3 ">
                <span class="text-muted dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Register Now 
                </span>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <li>
                    <a class="dropdown-item" href="#">
                      <button type="button" class="btn register-btn-dropdown" data-bs-toggle="modal"
                        data-bs-target="#patient">
                        Patient
                      </button>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">
                      <button type="button" class="btn register-btn-dropdown" data-bs-toggle="modal"
                        data-bs-target="#doctor">
                        HCP/Institution Registration </button>
                    </a>
                  </li>
                </ul>
              </div>
            </li>

          </ul>
        <?php } else if($CI->session->userdata('rolecode') == PATIENT){ ?>
          <ul class="navbar-nav  ms-auto mb-2 mb-lg-0">
            <li class="nav-item mx-3">
              <a class="nav-link <?php echo (isset($active) && $active == 'dashboard') ? 'activeNav' : ''; ?>" aria-current="page" href="<?php echo base_url('patient/dashboard'); ?>">Dashboard</a>
            </li>
            <li class="nav-item mx-3">
              <a class="nav-link <?php echo (isset($active) && ($active == 'breast' || $active == 'colorectal' || $active == 'lungs' || $active == 'prostate' || $active == 'cervical')) ? 'activeNav' : ''; ?>" href="<?php echo base_url('test_results/breast'); ?>">Assessment</a>
            </li>
           <li class="mx-3 mt-2">
              <div class="dropdown mx-sm-3 ">
                  <span class="text-muted"><?php echo $this->session->userdata('fname'); ?></span>&nbsp;
                      <img
                      src="<?php echo base_url('assets/img/patient-icon.png') ?>"
                      roundedCircle
                      width="30px"
                      height="30px"
                      class="dropdown-toggle"
                      data-bs-toggle="dropdown" 
                      id="dropdownMenuButton1" aria-expanded="false"
                  />
                  <ul class="dropdown-menu me-5" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="<?php echo base_url('profile'); ?>">Profile</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('change_password'); ?>">Change Password</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('logout'); ?>">Logout</a></li>
                  </ul>
                </div>
           </li>
          </ul>

        <?php } else if($CI->session->userdata('rolecode') == MEDICPRAC){?>
          <ul class="navbar-nav  ms-auto mb-2 mb-lg-0">
              <li class="nav-item mx-2">
                <a class="nav-link <?php echo (isset($active) && $active == 'doctor_dashboard') ? 'activeNav' :'' ?>" aria-current="page" href="<?php echo base_url('doctor_dashboard'); ?>">Dashboard</a>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link <?php echo (isset($active) && $active == 'manage_patients') ? 'activeNav' :'' ?>" aria-current="page" href="<?php echo base_url('manage_patients'); ?>">Manage Patients</a>
              </li>
              <li class="mx-2 mt-2">
                <div class="dropdown mx-sm-3">
                    <span class="text-muted"><?php echo $this->session->userdata('fname'); ?></span>&nbsp;
                        <img
                        src="<?php echo base_url('assets/img/doctorset1.svg') ?>"
                        roundedCircle
                        class=" dropdown-toggle profile-image-nav"
                        data-bs-toggle="dropdown" 
                        id="dropdownMenuButton1" aria-expanded="false"
                    />
                    <ul class="dropdown-menu me-5" aria-labelledby="dropdownMenuButton1">
                      <li><a class="dropdown-item" href="<?php echo base_url('profile'); ?>">Profile</a></li>
                      <li><a class="dropdown-item" href="<?php echo base_url('change_password'); ?>">Change Password</a></li>
                      <li><a class="dropdown-item" href="<?php echo base_url('logout'); ?>">Logout</a></li>
                    </ul>
                  </div>
             </li>
            </ul>
            <?php } else if($CI->session->userdata('rolecode') == SYSTEM_ADMIN){?>
              <ul class="navbar-nav  ms-auto mb-2 mb-lg-0">
                <li class="nav-item mx-2">
                  <a class="nav-link <?php echo ($CI->uri->segment(1) == 'admin_dashboard') ? 'activeNav' : '' ?>" aria-current="page" href="<?php echo base_url('admin_dashboard'); ?>">DashBoard</a>
                </li>
                <li class="nav-item mx-2">
                  <a class="nav-link <?php echo ($CI->uri->segment(1) == 'manage_doctors') ? 'activeNav' : '' ?>" aria-current="page" href="<?php echo base_url('manage_doctors/doctors'); ?>">Manage Doctors/HCPs</a>
                </li> 
                <li class="nav-item mx-2"> 
                  <a class="nav-link <?php echo ($CI->uri->segment(1) == 'facility') ? 'activeNav' : '' ?>" aria-current="page" href="<?php echo base_url('facility/listing'); ?>">Facility</a>
                </li>
                <li class="mx-0 mt-2">
                  <div class="dropdown mx-3 ">
                      <span class="text-muted"><?php echo $this->session->userdata('fname'); ?></span>&nbsp;
                          <img
                          src="<?php echo base_url('assets/img/doctorset1.svg') ?>"
                          roundedCircle
                          class=" dropdown-toggle profile-image-nav"
                          data-bs-toggle="dropdown" 
                          id="dropdownMenuButton1" aria-expanded="false"
                      />
                      <ul class="dropdown-menu me-5" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="<?php echo base_url('profile'); ?>">Profile</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('change_password'); ?>">Change Password</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('logout'); ?>">Logout</a></li>
                      </ul>
                    </div>
                </li>
              </ul>
            <?php } else if($CI->session->userdata('rolecode') == FACILITY_ADMIN){?>
              <ul class="navbar-nav  ms-auto mb-2 mb-lg-0">
                <li class="nav-item mx-2">
                  <a class="nav-link <?php echo ($CI->uri->segment(1) == 'admin_dashboard') ? 'activeNav' : '' ?>" aria-current="page" href="<?php echo base_url('admin_dashboard'); ?>">DashBoard</a>
                </li>
                <li class="nav-item mx-2">
                  <a class="nav-link <?php echo ($CI->uri->segment(1) == 'manage_doctors') ? 'activeNav' : '' ?>" aria-current="page" href="<?php echo base_url('manage_doctors/doctors'); ?>">Manage Doctors/HCPs</a>
                </li> 
                <li class="mx-0 mt-2">
                  <div class="dropdown mx-3 ">
                      <span class="text-muted"><?php echo $this->session->userdata('fname'); ?></span>&nbsp;
                          <img
                          src="<?php echo base_url('assets/img/doctorset1.svg') ?>"
                          roundedCircle
                          class=" dropdown-toggle profile-image-nav"
                          data-bs-toggle="dropdown" 
                          id="dropdownMenuButton1" aria-expanded="false"
                      />
                      <ul class="dropdown-menu me-5" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="<?php echo base_url('profile'); ?>">Profile</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('change_password'); ?>">Change Password</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('logout'); ?>">Logout</a></li>
                      </ul>
                    </div>
                </li>
              </ul>
            <?php } ?>
      </div>
    </div>
  </nav>

  <div class="register-modals">
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="doctor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-body">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            <h5 class="modal-title text-center" id="exampleModalLabel "></h5>
            <div class="text-center">
              <img src="<?php echo base_url('assets/img/') ?>Logo.svg" />
              <div class="sign-up-headers">
              <h5 class="modal-title mt-5" id="exampleModalLabel"> HCP/Institution Registration </h5>
                <!-- <h5 class="modal-title mt-5" id="exampleModalLabel"> Medical Practitioner </h5> -->
                <p>Sign up</p>
                <div id="medical_practitioner_signup_success_msg" style="color: green">
                </div>
               
                <div id="medical_practitioner_signup_error_msg" style="color: red;">
                </div>
              </div>

            </div>
            <form action="<?php echo base_url('signup'); ?>" id="medical_practitioner_signup">
              <div class="signup-modal">
                <div class="mb-4">
                  <div class="inline-block">
                    <input class="form-check-input1" type="radio" value="<?php echo HCP_ID ?>" name="user_type" id="hcp">
                    <label class="form-check-label1" for="hcp">
                      HCP
                    </label>
                  </div>
                  <div class="inline-block ms-5">
                    <input class="form-check-input1" type="radio" value="<?php echo INSTITUTE_ID ?>" name="user_type" id="institute">
                    <label class="form-check-label1" for="institute">
                      Institute
                    </label>
                  </div>
                </div>
                <div class="mb-4">
                  <input type="hidden" name="role_id" value="<?php echo isset($medicprac_role->id) ? $medicprac_role->id :''; ?>">
                  <input class="form-control" type="text" name="fname" placeholder="Name as per NRIC/Passport" aria-label="">
                </div>
                <div class="mb-4">
                  <div class="inline-block">
                    <input class="form-check-input1" type="radio" value="<?php echo MALE_GENDER_ID ?>" name="gender_id" id="male_gender" checked>
                    <label class="form-check-label1" for="male_gender">
                      Male
                    </label>
                  </div>
                  <div class="inline-block ms-5">
                    <input class="form-check-input1" type="radio" value="<?php echo FEMALE_GENDER_ID ?>" name="gender_id" id="female_gender">
                    <label class="form-check-label1" for="female_gender">
                      Female
                    </label>
                  </div>
                  <!-- <input class="form-control" type="text" name="registration_number" placeholder="Registration Number" aria-label="" required> -->
                </div>
                <div class="mb-4">
                  <input class="form-control" type="text" name="registration_number" placeholder="Registration Number" aria-label="">
                </div>
                <div class="mb-4">
                  <select class="form-select" aria-label="Default select example" name="facility_id">
                    <option value="0"> Select Facility</option>
                    <?php foreach ($facilities as $facility) { ?>
                      <option value="<?php echo $facility->id; ?>"><?php echo $facility->facility_name; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="mb-4">
                  <input class="form-control" type="text" name="contact_number" placeholder="Contact number" aria-label="">
                </div>
                <div class="mb-4">
                  <input class="form-control" type="text" name="email" placeholder="Email" aria-label="readonly input example">
                </div>
                <div class="mb-4">
                  <input class="form-control" type="password" name="password" placeholder="Password " aria-label="readonly input example">
                </div>
                <div class="mb-4">
                  <input class="form-control" type="password" name="confirm_password" placeholder="Confirm password" aria-label="readonly input example">
                </div>
                <div class="text-center mb-5">
                  <button type="submit" class="btn register-btn" id="medical_practitioner_signup_register">Register<span class="spinner-border spinner-border-sm visually-hidden" role="status" aria-hidden="true"></span>
                    <span class="visually-hidden">Loading...</span>
                  </button>
                  <!-- <input type="submit" class="btn register-btn" value="Register"> -->
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="patient" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-body">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            <h5 class="modal-title text-center" id="exampleModalLabel "></h5>
            <div class="text-center">
              
              <img src="<?php echo base_url('assets/img/') ?>Logo.svg" />
              <div class="sign-up-headers">
                <h5 class="modal-title mt-4 mb-1" id="exampleModalLabel">Patient</h5>
                <p>Sign up</p>
                <div id="patient_signup_success_msg" style="color: green">
                </div>
                <div id="patient_signup_error_msg" style="color: red;">
                </div>
              </div>
            </div>
            <form action="<?php echo base_url('signup'); ?>" id="patient_signup">
              <div class="signup-modal">
                <div class="mb-4">
                  <input type="hidden" name="role_id" value="<?php echo isset($patient_role->id) ? $patient_role->id :''; ?>">
                  <input class="form-control" type="text" name="fname" placeholder="Name as per NRIC/Passport" aria-label="" >
                </div>
                <!-- <div class="mb-4">
                  <input class="form-control" type="text" name="mname" placeholder="Middle name" aria-label="">
                </div> -->
                <!-- <div class="mb-4">
                  <input class="form-control" type="text" name="lname" placeholder="Last name" aria-label="">
                </div> -->

                <div class="mb-4">
                    <div class="inline-block">
                          <input class="" type="radio" name="nationality_id" value="1" id="flexRadioDefault1" checked>
                          <label class="" for="flexRadioDefault1">
                            Malaysian
                          </label>
                    </div>
                    <div class="inline-block ms-5">
                          <input class="" type="radio"  name="nationality_id" value="0" id="flexRadioDefault2">
                          <label class="" for="flexRadioDefault2">
                            Non-Malaysian
                          </label>
                        
                  </div>
                </div>

                <div class="mb-4">
                  <select class="form-select" name="ethnicity_id" aria-label="Default select example">
                      <option value="0">Select Ethnicity</option>
                      <?php foreach ($ethnicities as $ethnicity) { ?>
                        <option value="<?php echo $ethnicity->id; ?>"><?php echo $ethnicity->ethnicity; ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="mb-4">
                  <input class="form-control" type="text" name="id_number" placeholder="NRIC/Passport" aria-label="" >
                </div>

                <div class="mb-4">
                  <select class="form-select" name="gender_id" aria-label="Default select example">
                      <option value="1">Male</option>
                      <option value="2">Female</option>
                      <option value="3">Other</option>

                  </select>
                </div>
                <!-- <div class="mb-4">
                  <select class="form-select" aria-label="Default select example" name="facility_id">
                    <option selected>Facility</option>
                    <?php foreach ($facilities as $facility) { ?>
                        <option value="<?php echo $facility->id; ?>"><?php echo $facility->facility_name; ?></option>
                    <?php } ?>
                  </select>
                </div> -->
                <div class="mb-4">
                  <input class="form-control" type="text" name="contact_number" placeholder="Contact number" aria-label="" >
                </div>

                <div class="mb-4">
                  <input class="form-control" type="text" name="email" placeholder="Email" aria-label="readonly input example" >
                </div>
                <!-- <div class="mb-4">
                  <select class="form-select" name="gender" aria-label="Default select example">
                    <option selected>Gender</option>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                    <option value="3">No to say</option>
                  </select>
                </div> -->
                <!-- <div class="mb-4">
                  <input class="form-control" type="date" name="dob" placeholder="Date of birth" aria-label="readonly input example">
                </div> -->
                <!-- <div class="mb-4">
                  <select class="form-select" name="blood_group" aria-label="Default select example">
                    <option selected>Blood Group</option>
                    <option value="1">A+</option>
                    <option value="2">A-</option>
                    <option value="3">B+</option>
                    <option value="4">B-</option>
                    <option value="5">AB+</option>
                    <option value="6">AB-</option>
                    <option value="7">O+</option>
                    <option value="8">O-</option>
                  </select>
                </div> -->
                <div class="mb-4">
                  <input class="form-control" type="password" name="password" placeholder="Password " aria-label="readonly input example" >
                </div>
                <div class="mb-4">
                  <input class="form-control" type="password" name="confirm_password" placeholder="Confirm password"
                    aria-label="readonly input example" >
                </div>
                <div class="text-center mb-5">
                  <button type="submit" class="btn register-btn" id="patient_signup_register">Register<span class="spinner-border spinner-border-sm visually-hidden" role="status" aria-hidden="true"></span>
                    <span class="visually-hidden">Loading...</span>
                  </button>
                  <!-- <input type="submit" class="btn register-btn" value="Register"> -->
                </div>
              </div>
            </form>
          </div>
          <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
        </div>
      </div>
    </div>



    <form action="<?php echo base_url('forgot_password'); ?>" id="patient_forgot_password">
      <div class="modal fade" id="forgot_password" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-body">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

              <h5 class="modal-title text-center" id="exampleModalLabel "></h5>
              <div class="text-center">
                
                <img src="<?php echo base_url('assets/img/') ?>Logo.svg" />
                <div class="sign-up-headers">
                  <h5 class="modal-title mt-4 mb-1" id="exampleModalLabel">Forgot Password</h5>
                  <p>Please fill out your email. A link to reset password will be sent to you.</p>
                  <div id="fsuccess_msg" style="color: green">
                </div>
                <div id="ferror_msg" style="color: red;">
                </div>
                </div>
              </div>
              <form action="" id="">
                <div class="signup-modal">
                  
                  <div class="mb-4">
                    <input class="form-control" type="text" name="email" placeholder="Email ">
                  </div>
                  <div class="text-center mb-5">
                  <button type="submit" class="btn register-btn" id="reset_password">Reset Password<span class="spinner-border spinner-border-sm visually-hidden" role="status" aria-hidden="true"></span>
                    <span class="visually-hidden">Loading...</span>
                  </button>
                  <!-- <input type="submit" class="btn register-btn" value="Register"> -->
                </div>
                  <!-- <div class="text-center mb-5">
                    <input type="submit" class="btn register-btn" value="Reset Password">
                  </div> -->
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </form>


  </div>
  <script>
    $(document).ready(function() {
      $("#hcp").on("click", function() {
        if ($(this).is(":checked")) {
          $("#institute").prop("checked", false);
          enableFields();
        }
      });

      $("#institute").on("click", function() {
        if ($(this).is(":checked")) {
          $("#hcp").prop("checked", false);
          disableFields();
        }
      });

      function enableFields() {
        $('input[name=gender_id]').prop('disabled', false).closest('.mb-4').show();
        $('input[name=registration_number]').prop('disabled', false).closest('.mb-4').show();
      }

      function disableFields() {
        $('input[name=gender_id]').prop('disabled', true).closest('.mb-4').hide();
        $('input[name=registration_number]').prop('disabled', true).closest('.mb-4').hide();
      }
    });
</script>


