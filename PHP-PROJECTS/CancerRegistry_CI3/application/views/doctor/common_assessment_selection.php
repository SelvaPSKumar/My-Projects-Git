<link rel="styleSheet" href="<?php base_url('assets/css/Selection.css'); ?>" />
<?php $CI = & get_instance(); ?>
<div class="container">
        <h1 class="screeningHeader">Patient Selection</h1>
    </div>
    <div class="container mt-2">
        <div class="back-container d-flex">
        <?php if($CI->session->userdata('rolecode') == MEDICPRAC){ ?>
            <a href="<?php echo $backlink; ?>" class="back-link">
        <?php } ?>
            <!-- <p> Back</p> -->
            <button class="btn next-btn float-end"><span class="prev-icon"><ion-icon name="chevron-back-outline"></ion-icon></span> Back</button>
        </a>
        </div>
    </div>
    <div class="container">
        <form method="POST" id="assessment_form">
            <div class="screening-info-container">
                <div class="form">

                    <label class="form-label mt-5">Select Assessment Type</label>
                    <select class="form-select" name="assessment_type_id" aria-label="Default select example" id="">
                        <option value="">Select Assessment Type</option>
                        <option value="2"><?php echo $assessment_name;?></option>
                        <?php /*if (!empty($assessment_types)) {
                                foreach ($assessment_types as $key => $assessment_type) { ?>
                                <option value="<?php echo $assessment_type->id ?>"><?php echo ucwords(str_replace('_', ' ', $assessment_type->assessment_type)); ?></option>                        
                        <?php } }*/ ?>
                    </select>

                    <?php if($CI->session->userdata('rolecode') == MEDICPRAC){ ?>
                        <label class="form-label mt-3">Select Patient</label>
                        <select class="form-select js-basic-single" name="patient_id" aria-label="Default select example" id="">
                            <option value="">Select Patient</option>
                            <?php if (!empty($patients)) {
                                foreach ($patients as $key => $patient) { ?>
                                  <option value="<?php echo $patient['id'] ?>"><?php echo "[NRIC-".$patient['id_number'] ."] ".$patient['fname']. " (".$patient['email'].")" ?></option>
                            <?php } } ?>
                        </select>
                    <?php } ?> 


                        <div class="screening-btn-selection">
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <a href="../DashBoard/Dashboard.html">
                                    <button class="btn">
                                        Cancel</button></a>
                                </div>

                                <div class="col-6">
                                    
                                    <div id="proceed-self">
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

      
        document.getElementById('assessment_form').setAttribute('action', '<?php echo $doctor_assessment_link ?>');

      
    </script>
    
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(window).load(function(){
            $(".js-basic-single").select2();
        });
    </script>
    <style>.select2-container .select2-selection--single{height: 35px; }</style>
    
