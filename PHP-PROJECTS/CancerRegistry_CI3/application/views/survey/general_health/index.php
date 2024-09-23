<link rel="styleSheet" href="<?php base_url('assets/css/Selection.css'); ?>" />
<?php $CI = & get_instance(); ?>
<div class="container">
        <h1 class="screeningHeader">General Health Screening</h1>
    </div>
    <div class="container mt-2">
        <div class="back-container d-flex">
        <?php if($CI->session->userdata('rolecode') == MEDICPRAC){ ?>
            <a href="<?php echo base_url('all_assessments'); ?>" class="back-link">
        <?php }else{ ?>
            <a href="<?php echo base_url('test_results/general_health'); ?>" class="back-link">
        <?php } ?>
            
            <!-- <p> Back</p> -->
            <button class="btn next-btn float-end"><span class="prev-icon"><ion-icon name="chevron-back-outline"></ion-icon></span> Back</button>
        </a>
        </div>
    </div>
    <div class="container">
        <form method="POST" id="assessment_form" action="<?php echo base_url('general_health_questions') ?>">
            <input type="hidden" name="assessment_type_id" value="7">
            <input type="hidden" name="assessment_sub_type_id"  value="1"> 
        <div class="screening-info-container">

            <div class="form">
                <div class="row">
                    <label class="form-label">Please click an option below to begin.</label>
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-body mb-4">
                                <div class="row">
                                    <div class="col-2">
                                        <img src="<?php echo base_url('assets/img/selfawareness.svg'); ?>" />
                                    </div>
                                    <div class="col-10">
                                        <h6 class="mt-2 mx-3">General Health Screening</h6>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-center bg-white p-0">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="assessment_tool_id" id="cflexRadioDefault1" value="28" checked >
                                    <label class="form-check-label" for="cflexRadioDefault1">
                                        Select
                                    </label>
                                  </div>                       
                                </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-body mb-4">
                                <div class="row">
                                    <div class="col-2">
                                        <img src="<?php echo base_url('assets/img/hls.png'); ?>" />
                                    </div>
                                    <div class="col-10">
                                        <h6 class="mt-2 mx-3">PERKESO HSP 3.0</h6>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-center bg-white p-0">
                                <div class="form-check" >
                                    <input class="form-check-input" type="radio" name="assessment_tool_id" id="cflexRadioDefault2" value="29" >
                                    <label class="form-check-label" for="cflexRadioDefault2">
                                     Select
                                    </label>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  

                <?php if($CI->session->userdata('rolecode') != MEDICPRAC){ ?>

                    <div class="row">
                        <label class="form-label mt-3">Select Facility</label>
                        <div class="col-md-12"> 
                            <select class="form-select" name="facility_id" aria-label="Default select example" id="">
                                <option value="">Select Facility</option>
                                <?php if (!empty($facilities)) {
                                        foreach ($facilities as $key => $facility) { ?>
                                        <option value="<?php echo $facility->id ?>"><?php echo $facility->facility_name ?></option>                        
                                <?php } } ?>
                            </select>
                        <div class="col-md-12"> 
                    </div>
                <?php }else{ ?>
                    <div class="row">
                        <input type="hidden" name="facility_id" value="<?php echo $CI->session->userdata('facility_id'); ?>">
                        <label class="form-label mt-3">Patient: [NRIC-<?php echo $patient_data[0]['id_number']."] ".$patient_data[0]['fname'] ?> <input type="hidden" name="patient_id" value="<?php echo $patient_data[0]['id']; ?>"></label>
                    </div>
                <?php } ?>

                <!--
                <?php if($CI->session->userdata('rolecode') == MEDICPRAC){ ?>
                    <p class="mt-3">Select Patient</p>
                    <select class="form-select" name="patient_id" aria-label="Default select example" id="">
                        <option value="">Select Patient</option>
                         <?php if (!empty($patients)) {
                                foreach ($patients as $key => $patient) { ?>
                                <option value="<?php echo $patient->id ?>"><?php echo "[NRIC-".$patient->id ."] ".$patient->fname ?></option>                        
                        <?php } } ?>
                    </select>
                <?php } ?>  -->


                <div class="row">
                    <label class="form-label mt-3">Please enter date and time Performed</label>
                    <div class="col-md-6">
                        <label class="form-label" >Date</label>
                        <div class="input-outer">
                            <input type="date" id="assessment_date" name="assessment_date" class="date-input" max="<?php echo date("Y-m-d"); ?>"
                          value="<?php echo date('m-d-Y'); ?>" onchange="onChangeAssessmentTime()">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Time</label>
                        <div class="input-outer">
                            <input type="time" id="assessment_time" name="assessment_time" class="date-input" max="<?php echo date("H:i"); ?>"
                          value="" onchange="onChangeAssessmentTime()">
                        </div>
                    </div>
                </div>

                    <div class="screening-btn-selection">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <a href="../DashBoard/Dashboard.html">
                                <button class="btn">
                                    Cancel</button></a>
                            </div>

                            <div class="col-6">
                                  
                                <div id="proceed-health-tools">
                                    <button type="submit" class="btn"> Click to proceed </button>
                                </div>
                                
                                
                            </div>
                        </div>

                    </div>
                </div>
           </div>
        </div>
        </form>
    </div>


    <script>
jQuery(function(){
    var current_tool_id = window.location.hash.replace('#', '');
    jQuery('input[type="radio"][value="'+current_tool_id+'"]').trigger('click');
});


$("#assessment_form").submit(function(e){
        e.preventDefault();
        if(validate_selection_form()){
            $(this).unbind(e).submit();;
        } else {
            return false;
        }
        
  });

 function validate_selection_form(){
          var form = document.querySelector('#assessment_form');
          const formData = new FormData(form);

          var response = true;
          formData.forEach(function(value, key){

            if (value == '') {
              $('select[name="'+ key +'"]').css({'border': 'red solid 1px'});
              $('#error_msg').text("All fields are required!");  
              response = false;
            } else {
              $('select[name="'+ key +'"]').css({'border': '1px solid #ced4da'});
            }


          });
          return response;
      }

var time = calculate_time("MTY", "+8");
function calculate_time(city, offset){
    var b= new Date();
    var utc = b.getTime()+(b.getTimezoneOffset()*60000);
    var nd = new Date(utc+(3600000*offset));
    return nd;
}

// console.log(time.toLocaleDateString());
// console.log(new Date().toISOString().substring(0, 10));
// document.getElementById('assessment_time').value = time.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'}).substring(0,5);

document.getElementById('assessment_date').value = new Date().toISOString().substring(0, 10);
document.getElementById('assessment_time').value = "<?php echo date("H:i",strtotime('-5 minutes')); ?>"
// time.getHours()+":"+(time.getMinutes()<10?'0':'') + time.getMinutes();

        function onChangeAssessmentTime() {
            var currentDateTime = new Date();

            // Get the user-entered date and time values
            var userDate = new Date($('#assessment_date').val());
            var userTime = $('#assessment_time').val().split(":");
            var userHours = parseInt(userTime[0], 10);
            var userMinutes = parseInt(userTime[1], 10);

            userDate.setHours(userHours);
            userDate.setMinutes(userMinutes);

            if (userDate > currentDateTime) {
              alert('Not allowed future date and time.');
                currentDateTime.setMinutes(currentDateTime.getMinutes() - 5);
                $('#assessment_date').val(currentDateTime.toISOString().split('T')[0]);
                $('#assessment_time').val(currentDateTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }));
            }
        }
/*
function familyHistory() {
    document.getElementById('assessment_form').setAttribute('action', '<?php echo base_url('your_health_tools/family_history_questions') ?>');
}    

function healthLiteracy() {
    document.getElementById('assessment_form').setAttribute('action', '<?php echo base_url('your_health_tools/health_literacy_survey') ?>');
} 
function riskAssessment() {
    document.getElementById('assessment_form').setAttribute('action', '<?php echo base_url('your_health_tools/cancer_risk_assessment') ?>');
} */
    </script>
