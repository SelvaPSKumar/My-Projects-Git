<link rel="styleSheet" href="<?php base_url('assets/css/Selection.css'); ?>" />
<?php $CI = & get_instance(); ?>
<div class="container">
        <h1 class="screeningHeader">Cervical Cancer Screening</h1>
    </div>
    <div class="container mt-2">
        <div class="back-container d-flex">
        <?php if($CI->session->userdata('rolecode') == MEDICPRAC){ ?>
            <a href="<?php echo base_url('all_assessments/cervical_cancer'); ?>" class="back-link">
        <?php }else{ ?>
            <a href="<?php echo isset($previous) ? $previous : ''; ?>" class="back-link">
        <?php } ?>
            
            <!-- <p> Back</p> -->
            <button class="btn next-btn float-end"><span class="prev-icon"><ion-icon name="chevron-back-outline"></ion-icon></span> Back</button>
        </a>
        </div>
    </div>
    <div class="container">
        <form method="POST" id="assessment_form" action="<?php echo base_url('cervical_cancer/save_cervical_cancer_header'); ?>">
            <input type="hidden" name="assessment_type_id" value="5">
        <div class="screening-info-container">

            <div class="form">
                <div class="row">
                    <label class="form-label">Please click an option below to begin.</label>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body mb-4">
                                <div class="row">
                                    <div class="col-2">
                                        <img src="<?php echo base_url('assets/img/selfawareness.svg'); ?>" />
                                    </div>
                                    <div class="col-10">
                                        <h6 class="mt-2 mx-3">Self Assessment</h6>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-center bg-white p-0">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="assessment_sub_type_id" id="cflexRadioDefault1" value="1" checked >
                                    <label class="form-check-label" for="cflexRadioDefault1">
                                        Select
                                    </label>
                                  </div>                       
                                </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body mb-4">
                                <div class="row">
                                    <div class="col-2">
                                        <img src="<?php echo base_url('assets/img/hls.png'); ?>" />
                                    </div>
                                    <div class="col-10">
                                        <h6 class="mt-2 mx-3">Clinical Assessment</h6>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-center bg-white p-0">
                                <div class="form-check" >
                                    <input class="form-check-input" type="radio" name="assessment_sub_type_id" id="cflexRadioDefault2" value="2" >
                                    <label class="form-check-label" for="cflexRadioDefault2">
                                     Select
                                    </label>
                                  </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body mb-4">
                                <div class="row">
                                    <div class="col-2">
                                        <img src="<?php echo base_url('assets/img/cra.png'); ?>" />
                                    </div>
                                    <div class="col-10">
                                        <h6 class="mt-2 mx-3">Others</h6>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-center bg-white p-0">
                                <div class="form-check" >
                                    <input class="form-check-input" type="radio" name="assessment_sub_type_id" id="cflexRadioDefault3" value="3" >
                                    <label class="form-check-label" for="cflexRadioDefault3">
                                     Select
                                    </label>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  

            <div class="row">
                <label class="form-label" > Select Assessment Tool</label>
                <div class="col-md-12">                
                    <select class="form-select" name="assessment_tool_id" aria-label="Default select example" id="formSelection">
                        <option value="">Select Assessment Tool</option>
                            <?php if (!empty($assessment_tools['self'])) {
                                foreach ($assessment_tools['self'] as $key => $assessment_tool) { ?>
                                    <option value="<?php echo $assessment_tool->id; ?>"><?php echo $assessment_tool->assessment_tool_name; ?></option>                        
                    <?php } } ?>
                    </select>
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
                        </div>
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

                <div class="row vaccine_section">
                    
                </div>


<!-- Modal -->
<div class="modal fade" id="view_concern" tabindex="-1" role="dialog" aria-labelledby="view_concern_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="view_concern_label">Concern Form</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4>BORANG PERSETUJUAN SUNTIKAN VAKSIN  
HUMAN PAPILOMAVIRUS (HPV)</h4>
        Vaksin HPV diberi bagi mengawal penularan jangkitan HPV di negara ini. Apabila semakin ramai orang mendapat vaksinasi, semakin ramai penduduk membentuk antibodi dan seterusnya mengurangkan kebarangkalian kejadian kanser serviks (pangkal rahim). Secara tidak langsung kita boleh melindungi golongan berisiko yang tidak layak menerima suntikan vaksin. 

        Suntikan Vaksin HPV memerlukan  dua (2) atau tiga (3) dos bergantung kepada umur individu. Suntikan ini kebiasaannya diberi pada otot bahu kecuali dalam keadaan tertentu. Jenis vaksin yang diberikan bergantung kepada bekalan vaksin semasa.
        <div class="row">
            <div class="col-md-6">
                <b>a.</b> Mengalami kesan sampingan teruk (seperti sawan, pengsan dan kemasukan ke hospital) selepas mendapat mana-mana imunisasi sebelum ini? 
            </div>
            <div class="col-md-6">
                <div class="input_radio_buttons">
                    <input class="" type="radio" name="condition[1]" id="condition_1_1" value="1" checked>
                    <label for="condition_1_1">Ya</label>
                    <input class="" type="radio" name="condition[1]" id="condition_1_2" value="0">
                    <label for="condition_1_2">Tidak</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <b>b.</b> Pernah mempunyai sejarah alahan teruk?
            </div>
            <div class="col-md-6">
                <div class="input_radio_buttons">
                    <input class="" type="radio" name="condition[2]" id="condition_2_1" value="1" checked>
                    <label for="condition_2_1">Ya</label>
                    <input class="" type="radio" name="condition[2]" id="condition_2_2" value="0">
                    <label for="condition_2_2">Tidak</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">            
                <b>c.</b> Adakah anda sedang hamil atau bercadang untuk hamil? (bagi wanita)
            </div> 
            <div class="col-md-6">
                <div class="input_radio_buttons">
                    <input class="" type="radio" name="condition[3]" id="condition_3_1" value="1" checked>
                    <label for="condition_3_1">Ya</label>
                    <input class="" type="radio" name="condition[3]" id="condition_3_2" value="0">
                    <label for="condition_3_2">Tidak</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <b>d.</b> Adakah anda sedang menyusukan bayi? (bagi wanita)
            </div> 
            <div class="col-md-6">
                <div class="input_radio_buttons">
                    <input class="" type="radio" name="condition[4]" id="condition_4_1" value="1" checked>
                    <label for="condition_4_1">Ya</label>
                    <input class="" type="radio" name="condition[4]" id="condition_4_2" value="0">
                    <label for="condition_4_2">Tidak</label>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" id="agree_concern" class="btn btn-primary" data-bs-dismiss="modal">I agree</button>
      </div>
    </div>
  </div>
</div>



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
            if( $('select[name="assessment_tool_id"]').val() == 30 )
            {
                if( !$("#acknowledge_concern").is(":checked") ) {
                    $(".concern_form_link").css({'border': 'red solid 1px'});
                    return false;
                }   
            }
            $('input[type="radio"]:disabled, input[type="checkbox"]:disabled, select:disabled').prop('disabled', false);
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

        $(document).on("ready", function(){
            $('input[name="assessment_sub_type_id"]').on("click", function() {
                var sub_type_selection = $(this).val();
                var options = '';
                if( sub_type_selection == 1 ) {
                    <?php
                    $self_option = '<option value="">Select Assessment Tool</option>';
                    if (!empty($assessment_tools['self'])) {
                        foreach ($assessment_tools['self'] as $key => $assessment_tool) {
                            $self_option .= '<option value="'.$assessment_tool->id.'">'.$assessment_tool->assessment_tool_name.'</option> ';                       
                    } } ?>
                    options = '<?php echo $self_option; ?>';
                } else if( sub_type_selection == 2 ) {
                    <?php
                    $clinical_option = '<option value="">Select Assessment Tool</option>';
                    if (!empty($assessment_tools['clinical'])) {
                        foreach ($assessment_tools['clinical'] as $key => $assessment_tool) {
                            $clinical_option .= '<option value="'.$assessment_tool->id.'">'.$assessment_tool->assessment_tool_name.'</option> ';                       
                    } } ?>
                    options = '<?php echo $clinical_option; ?>';
                } else if( sub_type_selection == 3 ) {
                    <?php
                    $clinical_option = '<option value="">Select Assessment Tool</option>';
                    if (!empty($assessment_tools['others'])) {
                        foreach ($assessment_tools['others'] as $key => $assessment_tool) {
                            $clinical_option .= '<option value="'.$assessment_tool->id.'">'.$assessment_tool->assessment_tool_name.'</option> ';                       
                    } } ?>
                    options = '<?php echo $clinical_option; ?>';
                }
                $('select[name="assessment_tool_id"]').empty();
                $('select[name="assessment_tool_id"]').html(options);
            });

            $('select[name="assessment_tool_id"]').on("change", function(e) {
                    if($(this).val()==17 || $(this).val()==18 || $(this).val()==30) {
                        $("#assessment_date").prop("disabled", true);
                        $("#assessment_time").prop("disabled", true);
                    } else {
                        $("#assessment_date").prop("disabled", false);
                        $("#assessment_time").prop("disabled", false);
                    }
<?php
$vaccine_info_link = base_url('cervical_cancer/vaccine_information_sheet');
$vaccine_tutorial_link = base_url('cervical_cancer/vaccine_information_sheet');
$vaccine_content =<<<HTML
    <div class="col-md-12"> 
        <a href="$vaccine_info_link" target="_blank">Vaccine Information Sheet</a>
    </div>
    <div class="col-md-12">
        <a href="$vaccine_tutorial_link" >Digital Consent Tutorial</a>
    </div>
    <div class="col-md-12">
        <div class="alert alert-primary concern_form_link" role="alert">
            <input type="checkbox" name="acknowledge_concern" id="acknowledge_concern" value="1" disabled>
            <label for="acknowledge_concern" style="display: inline;">I have read and acknowledge accepting the concern forms – <a data-bs-toggle="modal" href="#view_concern" title="Click to open" class="alert-link">click to view concern form</a></label>
        </div>
    </div>
HTML;
 ?>
                    if($(this).val()==30) {
                        $('.vaccine_section').html(`<?php echo $vaccine_content; ?>`);
                    } else {
                        $('.vaccine_section').empty();
                    }
            });

            $('#agree_concern').on("click", function() {
                $("#acknowledge_concern").prop("checked", true);
                $('[id*="condition"]').prop("disabled", true);
            });
        });
    </script>