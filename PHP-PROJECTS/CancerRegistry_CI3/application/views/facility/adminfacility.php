<div class="container">
    <div class="row">
        <form id="facility_form" method="post">
            <div class="col-md-12 dashboard-main">
                <div class="container mt-2 back-container d-flex">
                    <?php if( isset( $view_mode ) && $view_mode != 'edit' ) { ?>
                        <div class="col-md-2">
                            <a href="<?php echo base_url('facility/adminlisting/'); ?>" class="back-link btn next-btn float-end" target="_self"> 
                                    <span class="prev-icon">
                                        <ion-icon name="chevron-back-outline"></ion-icon>
                                    </span>
                                    Back 
                            </a>
                        </div>
                    <?php } else { ?>
                        <div class="col-md-2">
                            <a href="<?php echo base_url('facility/adminfacility/'.$facility_details['id']); ?>" class="back-link btn next-btn float-end" target="_self"> 
                                    <span class="prev-icon">
                                        <ion-icon name="chevron-back-outline"></ion-icon>
                                    </span>
                                    Back 
                            </a>
                        </div>
                    <?php } ?>    
                    <?php if( isset( $view_mode ) && $view_mode == 'view' ) { ?>
                    <div class="col-md-9"> 
                            <a href="<?php echo base_url('facility/adminfacilityedit/'.$facility_details['id']); ?>" target="_self" class="btn next-btn float-end" style="width:160px;">
                                Edit Facility Admin
                            </a> 
                    </div>
                    <?php } ?>
                </div>
                <div class="values-container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="exampleInputEmail1" class="form-label">Name as per NRIC</label>
                                <input class="form-control" name='nric' type="text" aria-label="readonly input example" value="<?php echo isset( $facility_details ) ? $facility_details['fname'] : '';?>" >
                            </div>
                            <p class="error" id="nric_error"></p>

                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                <input class="form-control" name='email'  type="text" aria-label="readonly input example" value="<?php echo isset( $facility_details ) ? $facility_details['email'] : '';?>" >
                            </div>
                            <p class="error" id="email_error"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                            <label for="exampleInputEmail1" class="form-label">Contact Number</label>
                                <input class="form-control" type="text" name="c_number" aria-label="readonly input example"  value="<?php echo isset( $facility_details ) ?  $facility_details['contact_number'] : '';?>" >
                            </div>
                            <p class="error" id="c_number_error"></p>                            
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                            <label class="form-label">Gender</label>
                            <select class="form-select" name="gender_id">
                                <option value="">Choose Gender</option>
                                <?php foreach ($genders as $gender) { ?>
                                    <option value="<?php echo $gender->id; ?>" 
                                        <?php 
                                        echo isset( $facility_details ) && $facility_details['gender_id'] == $gender->id ? 'selected' : '';
                                        ?>
                                        >
                                        <?php echo $gender->gender; ?>
                                            
                                    </option>
                                <?php } ?>
                            </select>
                            </div>
                            <p class="error" id="gender_id_error"></p>   
                        </div>                    
                    </div>
                    <div class="row">
                         <div class="col-md-6">
                            <div class="mb-2">
                                <label for="exampleFacilityName" class="form-label">Date Of Birth</label>
                                <input class="form-control" type="date" id="dob" name="dob" aria-label="input example" value="<?php echo isset( $facility_details ) ? $facility_details['dob'] : '';?>">
                                <p class="error" id="dob_error"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="exampleFacilityName" class="form-label">Facility </label>
                                <select class="form-select" name="facility_id">
                                    <option value="">Choose Facility</option>
                                    <?php foreach ($facility as $facility_info) { ?>
                                        <option 
                                        value="<?php echo $facility_info['id']; ?>" 
                                        <?php 
                                        echo (isset($current_facility) && ($current_facility == $facility_info['id'] )? 'selected' : '');
                                        ?> 
                                        <?php
                                        echo in_array( $facility_info['id'] , array_column($assignedfacility,'facility_id'))?"disabled":'';
                                        ?>                                       
                                         >                                         
                                            <?php echo $facility_info['facility_name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <p class="error" id="facility_id_error"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                                <label class="form-label">Status</label><br>
                                <div class="inline-block">
                                    <input class="" type="radio" id="is_obsolete_active" name="is_active" value="0"
                                    <?php echo isset( $facility_details ) && $facility_details['is_obsolete'] == '0' ? 'checked' : '';?>  >
                                    <label class="" for="is_obsolete_active" >Active</label>
                                </div> 
                                <div class="inline-block ms-5">
                                    <input class="" type="radio" id="is_obsolete_inactive" name="is_active" value="1" <?php echo isset( $facility_details ) && $facility_details['is_obsolete'] == '1' ? 'checked' : '';?>>
                                    <label class="" for="is_obsolete_inactive" >In Active</label>
                            </div>
                            <p class="error" id="is_active_error"></p>

                        </div>
                        <?php if( isset( $view_mode ) && ! in_array( $view_mode , array('view', 'edit') ) ) { ?>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="exampleFacilityName" class="form-label">Temporary Password </label>
                                <input class="form-control" type="password" id="t_password" name="t_password" aria-label="input example" value="">
                                <p class="error" id="t_password_error"></p>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                   
                    <?php if( isset( $view_mode ) && $view_mode != 'view' ) { ?>
                        <div class="row mb-5 mt-5 btn-peofile">
                            <div class="col">
                                <input
                                type="button" 
                                onclick="window.open('<?php echo (isset( $view_mode ) && $view_mode != 'edit')? base_url('facility/adminlisting/'): base_url('facility/adminfacility/'.$facility_details['id']) ; ?>', '_self')" 
                                class="Cancel-button"
                                value="Cancel"
                                /> 
                            </div>
                            <div class="col">
                                <button type="button" id="facility_form_submit" class="edit-button" onclick="formSubmit()" >Save</button>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </form>
    </div>
</div>
<style type="text/css">
    .error{
        color: red;
    }
    .error_field{
        border: 1px solid red;
    }
</style>
<script> 
    <?php if( isset( $view_mode ) && $view_mode != 'view' ) { ?>
    const formSubmit = () => {   
        document.getElementById("facility_form_submit").disabled = true;
        var form = jQuery("#facility_form");
        var data = form.serialize();          
        jQuery.ajax({
            type: "POST",
            url: '<?php echo $facility_save_url; ?>',
            data: data,
            success: (response) => {
              var response = jQuery.parseJSON(response);
              $('.error').empty();
              if(response.res == 'error'){
                document.getElementById("facility_form_submit").disabled = false;
                $.each(response.error, (id, error) => { 
                  jQuery('#'+id+'_error').text(error);
                });
              }
              if(response.res == 'success'){
                alert(response.success);
                jQuery('.Cancel-button').trigger('click');
              }
            },
            error: (xhr, status, error) => {
                document.getElementById("facility_form_submit").disabled = false;
                console.log("Error: " + error);
            }
        }); 
    };
    <?php } else { ?>
        $('form input[type=text]').attr('readonly', 'readonly'); 
        $('form input[type=date]').attr('readonly', 'readonly'); 
        $('form select, input[type=radio]').prop('disabled', 'disabled');
    <?php } ?>   
  
</script>
