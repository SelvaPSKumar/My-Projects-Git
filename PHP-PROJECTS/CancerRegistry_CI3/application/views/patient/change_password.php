<div class="container">
    <div class="row mt-2">
        <div class="col-md-10">
            <!-- <p>Profile Setting</p> -->
        </div>
    </div>
    <form action="<?php echo base_url('update_password'); ?>" method="POST" id="simpleId">
        <div class="row">
            
            <div class="col-md-12 dashboard-main">
                <div class="values-container">
                    <div class="row mt-3">
                        <div class="row">
                            <div class="col-md-6">
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

                                <div class="mb-2">
                                    <label class="form-label">Current Password</label>
                                    <input class="form-control current_pass" name="password" type="password" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label class="form-label">New Password</label>
                                    <input class="form-control new_pass" name="new_password" type="password" value="">
                                    <small class="pass_error_msg" style="color: red;"></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label class="form-label">Confirm Password</label>
                                    <input class="form-control re_pass" name="re_password" type="password" value="">
                                    <small class="re_pass_error_msg" style="color: red;"></small>
                                </div>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <input class="btn btn-primary" id="change_password_btn" name="submit" type="submit" value="Change Password">
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
       $("body").on('click', '#change_password_btn', function(){
            
            response = true;
            var current_pass    = $('.current_pass').val();
            var new_pass        = $('.new_pass').val();
            var re_pass         = $('.re_pass').val();
            $('.pass_error_msg').text("");
            $('.re_pass_error_msg').text("");
            $('.new_pass').css({'border': '1px solid #ced4da'});
            $('.re_pass').css({'border': '1px solid #ced4da'});
            $('.current_pass').css({'border': '1px solid #ced4da'});
            if (!current_pass) {
                  $('.current_pass').css({'border': 'red solid 1px'});
                  response = false;
            }


            var passw=  /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
                // var passw=  /^(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
                if(new_pass.match(passw)) { 
                } else { 
                  $('.new_pass').css({'border': 'red solid 1px'});
                  $('.pass_error_msg').text("Password must contain 8-16 characters, a number, a lowercase letter and an uppercase letter and a special character!")
                  response = false;   
                }

                if(re_pass.match(passw)) { 
                } else { 
                  $('.re_pass').css({'border': 'red solid 1px'});
                  $('.re_pass_error_msg').text("Password must contain 8-16 characters, a number, a lowercase letter and an uppercase letter and a special character!")
                  response = false;   
                }

        if (response == false) {
            return false;
        } else {
            $('#simpleId').submit();
        }


        });
    
</script>