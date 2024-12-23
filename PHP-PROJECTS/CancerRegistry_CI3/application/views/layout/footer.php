<h6 class="text-center p-1 p-md-1 p-sm-1" style="background-color: black; color: white;">In Collaboration with:</h6>

<div class="row p-2 d-flex align-items-center justify-content-center text-center" style="background-color: transparent; border-bottom: 1px solid silver;">
  <div class="col-md-1 p-2">
    <img style="max-height: 55px;width: auto;" src="<?php echo base_url('assets/img/') ?>beauty-logo.png">
  </div>
  <div class="col-md-1 p-2">
    <img style="max-height: 55px;width: auto;" src="<?php echo base_url('assets/img/') ?>asia-cancer-forum-logo.jpeg">
  </div>
  <div class="col-md-2 p-2">
    <img style="max-height: 55px;width: auto;" src="<?php echo base_url('assets/img/') ?>astel-logo.jpeg">
  </div>
  <div class="col-md-2 p-2">
    <img style="max-height: 55px;width: auto;" src="<?php echo base_url('assets/img/') ?>loook-east-logo.jpeg">
  </div>
  <div class="col-md-1 p-2">
    <img style="max-height: 55px;width: auto;" src="<?php echo base_url('assets/img/') ?>ncd-logo.png">
  </div>
  <div class="col-md-1 p-2">
    <img style="max-height: 55px;width: auto;" src="<?php echo base_url('assets/img/') ?>hp-logo.jpeg">
  </div>
  <div class="col-md-1 p-2">
    <img style="max-height: 55px;width: auto;" src="<?php echo base_url('assets/img/') ?>aspen-logo.jpeg">
  </div>
  <div class="col-md-1 p-2">
    <img style="max-height: 55px;width: auto;" src="<?php echo base_url('assets/img/') ?>fitline-logo.jpeg">
  </div>
</div>

<div class="row p-4" style="background-color: black;"></div>

<div class="row p-1" style="background-color: transparent;">
  <div class="col-md-12 d-flex align-items-center justify-content-center">
    <p style="margin-bottom: 0;margin-right: 10px;">Powered By</p>
    <img style="max-height: 45px;width: auto;" src="<?php echo base_url('assets/img/') ?>anteligence_logo.jpeg">
  </div>
</div>
<div class="footer mb-0 pb-0">
    <div class="footer-content">
      <div class="row">
        <div class="col-md-6">
          <p class="copy-right-content">©COPYRIGHT 2023 NATIONAL CANCER SOCIETY MALAYSIA. All Rights Reserved</p>
        </div>
        <div class="col-md-6">
          <p class="copy-right-subContent">Other sites: <a href="https://cancer.org.my" target="_blank">cancer.org.my</a>, <a href="https://relayforlifemalaysia.com/" target="_blank">Relay For Life</a></p>
        </div>
      </div>
    </div>
  </div>
<script>
  $(document).ready(function(){
      function signup(form_data, role, e) {
         if (role == 4) {
          form_identifier = "medical_practitioner_signup";
        } else if (role == 5) {
          form_identifier = "patient_signup";

        }
        var action_url = e.currentTarget.action;
        $('#'+form_identifier+'_register').prop('disabled', true);
        $('#'+form_identifier+'_register span').removeClass('visually-hidden');
        $('#'+form_identifier+'_success_msg').text("");
        $('#'+form_identifier+'_error_msg').text("");
        $.ajax({
                url: action_url,
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function(data) {
                    $('#'+form_identifier+'_register').prop('disabled', false);
                    $('#'+form_identifier+'_register span').addClass('visually-hidden');
                    $('#'+form_identifier+'_register').text("Register");
                  if (data.success) {
                    $('#'+form_identifier+'_success_msg').text(data.message);
                    document.querySelector('#patient_signup').reset();
                    document.querySelector('#medical_practitioner_signup').reset();

                    setTimeout(function(){
                      $('#'+form_identifier+'_success_msg').text("");
                    }, 15000); 
                  } else {
                    $('#'+form_identifier+'_error_msg').text(data.message);
                  }
                }
        });
      }
      function forgot_password(form_data, e) {
        var action_url = e.currentTarget.action;
        $('#reset_password').prop('disabled', true);
        $('#reset_password span').removeClass('visually-hidden');
        $('#fsuccess_msg').text("");
        $('#ferror_msg').text("");
        $.ajax({
                url: action_url,
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function(data) {
                  $('#reset_password').prop('disabled', false);
                    $('#reset_password span').addClass('visually-hidden');
                    $('#reset_password').text("Reset Password");
                  if (data.success) {
                    $('#fsuccess_msg').text(data.message);
                    document.querySelector('#patient_forgot_password').reset();
                    setTimeout(function(){
                      $('#fsuccess_msg').text("");
                    }, 15000);
                  } else {
                    console.log(data.message);
                    $('#ferror_msg').text(data.message);
                  }
                }
        });
      }
      $("#patient_signup").submit(function(e){
        e.preventDefault();
        if(validate_signup_form('#patient_signup')){
          var form_data = $('#patient_signup').serialize();
          signup(form_data, 5, e);
        }
      
      });

      function validate_signup_form(form_identifier){
        $(form_identifier + '_error_msg').text("");
        $('#success_msg').text("");
          var form = document.querySelector(form_identifier);
          const formData = new FormData(form);
          var password;
          var confirm_password;
          var confirm_password_key;
          var response = true;
          formData.forEach(function(value, key){
            if (value == '' || ( key == 'facility_id' && value == '0')  ) {
              if(  key == 'facility_id' ){
                $('select[name="'+ key +'"]').css({'border': 'red solid 1px'});
              } else{
                $('input[name="'+ key +'"]').css({'border': 'red solid 1px'});
              }
              $(form_identifier + '_error_msg').text("All fields are required!");
              response = false;
            } else {
              $('input[name="'+ key +'"]').css({'border': '1px solid #ced4da'});
              $('select[name="'+ key +'"]').css({'border': '1px solid #ced4da'});
            }
            if (key == 'fname') {
              if (/^[\p{L} ]+$/u.test(value)) {
              } else{
                $('input[name="'+ key +'"]').css({'border': 'red solid 1px'});
                $(form_identifier + '_error_msg').text("Name must contain letters and spaces only!")
                response = false;
              }
            } else if (key == 'contact_number') {
              if (/^\d+$/.test(value)) {
              } else{
                $('input[name="'+ key +'"]').css({'border': 'red solid 1px'});
                $(form_identifier + '_error_msg').text("You have entered an invalid mobile number!")
                response = false;
              }
            } else if (key == 'email') {
              if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value)) {
              } else{
                $('input[name="'+ key +'"]').css({'border': 'red solid 1px'});
                $(form_identifier + '_error_msg').text("You have entered an invalid email address!")
                response = false;
              }
            } else if (key == 'password') {
                password = value;
                // var passw=  /^[A-Za-z]\w{9,17}$/;
                var passw=  /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
                // var passw=  /^(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
                if(value.match(passw)) { 
                } else { 
                  $('input[name="'+ key +'"]').css({'border': 'red solid 1px'});
                  $(form_identifier + '_error_msg').text("Password must contain 8-16 characters, a number, a lowercase letter and an uppercase letter and a special character!")
                  response = false;   
                }
            }
            if (key == 'confirm_password') {
              confirm_password_key = key;
              confirm_password = value;
            }

            if(key == 'ethnicity_id' && value == '0'){
              $('select[name="'+ key +'"]').css({'border': 'red solid 1px'});
            }
          });
          if (password != confirm_password && response == true) {
            $('input[name="'+ confirm_password_key +'"]').css({'border': 'red solid 1px'});
            $(form_identifier + '_error_msg').text("Confirm Password Not Match!");
            response = false
          }
          // if (password == confirm_password) {
          //   $('input[name="'+ confirm_password_key +'"]').css({'border': '1px solid #ced4da'});
          // }
          return response;
      }
      $("#medical_practitioner_signup").submit(function(e){
        e.preventDefault();
        if(validate_signup_form('#medical_practitioner_signup')){
          var form_data = $('#medical_practitioner_signup').serialize();
          signup(form_data, 4, e);
        }        
      });
      $("#patient_forgot_password").submit(function(e){
        e.preventDefault();
        // if(validate_signup_form()){
          var form_data = $('#patient_forgot_password').serialize();
          forgot_password(form_data, e);
        // }
      
      });
    });
</script>
</body>

</html>
