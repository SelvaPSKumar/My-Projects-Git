<div class="container">
    <div class="row">
        <form id="facility_form" method="post">
            <div class="col-md-12 dashboard-main">
                <div class="container mt-2 back-container d-flex">
                    <?php if( isset( $view_mode ) && $view_mode != 'edit' ) { ?>
                        <div class="col-md-2">
                            <a href="<?php echo base_url('facility/listing/'); ?>" class="back-link btn next-btn float-end" target="_self"> 
                                    <span class="prev-icon">
                                        <ion-icon name="chevron-back-outline"></ion-icon>
                                    </span>
                                    Back 
                            </a>
                        </div>
                    <?php } else { ?>
                        <div class="col-md-2">
                            <a href="<?php echo base_url('facility/view/'.$facility_details['id']); ?>" class="back-link btn next-btn float-end" target="_self"> 
                                    <span class="prev-icon">
                                        <ion-icon name="chevron-back-outline"></ion-icon>
                                    </span>
                                    Back 
                            </a>
                        </div>
                    <?php } ?>    
                    <?php if( isset( $view_mode ) && $view_mode == 'view' ) { ?>
                        <div class="col-md-8"></div>
                    <div class="col-md-2"> 
                            <a href="<?php echo base_url('facility/edit/'.$facility_details['id']); ?>" target="_self" class="btn next-btn facility-admin-btn" >
                                Edit Facility
                            </a> 
                    </div>
                    <?php } ?>
                </div>
                <div class="values-container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2"> 
                                <label for="exampleFacilityCode" class="form-label">Facility Code</label>
                                <input class="form-control" type="text" id="facility_code" name="facility_code" aria-label="input example" value="<?php if( isset( $facility_details )){ echo $facility_details['facility_code']; } ?>" <?php echo !isset( $facility_details ) ? '' : 'readonly';?> >
                                <p class="error" id="facility_code_error"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="exampleFacilityName" class="form-label">Facility Name</label>
                                <input class="form-control" type="text" id="facility_name" name="facility_name" aria-label="input example" value="<?php if( isset( $facility_details )){ echo $facility_details['facility_name']; } ?>" <?php echo !isset( $facility_details ) ? '' : 'readonly';?> >
                                <p class="error" id="facility_name_error"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                               <label for="exampleRegistrationNumber" class="form-label">Registration Number</label>
                                <input class="form-control" type="text" id="reg_number" name="reg_number" aria-label="input example" value="<?php if( isset( $facility_details )){ echo $facility_details['registration_number']; } ?>" >
                                <p class="error" id="reg_number_error"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                           <div class="mb-2">
                                <label for="exampleAddress1" class="form-label">Address 1</label>
                                <input class="form-control" type="text" name="address1" value="<?php if( isset( $facility_details )){ echo $facility_details['address1']; } ?>" aria-label="input example" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="exampleAddress3" class="form-label">Address 2</label>
                                <input class="form-control" type="text" name="address2" value="<?php if( isset( $facility_details )){ echo $facility_details['address2']; } ?>" aria-label="input example" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="exampleAddress3" class="form-label">Address 3</label>
                                <input class="form-control" type="text" name="address3" value="<?php if( isset( $facility_details )){ echo $facility_details['address3']; } ?>" aria-label="input example" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="examplePostCode" class="form-label">Post Code</label>
                                <input class="form-control" type="text" name="post_code" value="<?php if( isset( $facility_details )){ echo $facility_details['postcode']; } ?>" aria-label="input example" >
                            </div>
                            <p class="error" id="post_code_error"></p>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="exampleCity" class="form-label">City</label>
                                <input class="form-control" type="text" name="city" value="<?php if( isset( $facility_details )){ echo $facility_details['city']; } ?>" aria-label="input example" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="exampleCountry" class="form-label">Country</label>
                                <select class="form-select" name="country_name" id="country" onchange="changeCountry()">
                                    <option value="">Choose Country </option>
                                    <?php foreach ($countries as $country) { ?>
                                        <option value="<?php echo $country->id; ?>" <?php if( isset( $facility_details )){ echo 
                                        $facility_details['countryid'] == $country->id ? 'selected': '' ; } ?>><?php echo $country->country_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="exampleState" class="form-label">State</label>
                                <select class="form-select" name="state_id" id="state">
                                    <option value="">Choose State </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2"> 
                                <label for="examplePhoneNumber" class="form-label">Phone Number</label>
                                <input class="form-control" type="text" name="phone_number" value="<?php if( isset( $facility_details )){ echo $facility_details['phonenumber1']; } ?>"> 

                            </div>
                            <p class="error" id="phone_number_error"></p>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">Status</label><br>
                                <div class="inline-block">
                                    <input class="" type="radio" id="is_obsolete_active" name="is_obsolete" value="0" <?php if( isset( $facility_details )){ echo ($facility_details['is_obsolete'] == 0) ?'checked':'' ;  } ?>>
                                    <label class="" for="is_obsolete_active" >Active</label>
                                </div> 
                                <div class="inline-block ms-5">
                                    <input class="" type="radio" id="is_obsolete_inactive" name="is_obsolete" value="1" <?php if( isset( $facility_details )){ echo ($facility_details['is_obsolete'] == 1) ?'checked':'' ;  } ?>>
                                    <label class="" for="is_obsolete_inactive" >In Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if( isset( $view_mode ) && $view_mode != 'view' ) { ?>
                        <div class="row mb-5 mt-5 btn-peofile">
                            <div class="col">
                                <input
                                type="button" 
                                onclick="window.open('<?php echo (isset( $view_mode ) && $view_mode != 'edit')? base_url('facility/listing/'): base_url('facility/view/'.$facility_details['id']) ; ?>', '_self')" 
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
        $('form select, input[type=radio]').prop('disabled', 'disabled');
    <?php } ?>   

    const changeCountry = ( state_id ='' ) => {
        var country = document.getElementById("country");
        var country_id = country.value;
        document.getElementById("state").innerHTML = "";

        var option = document.createElement("option");
        option.text = "Choose State";
        option.value = "";
        var select = document.getElementById("state");
        select.appendChild(option);

        if (country_id) {
            var url = '<?php echo base_url('facility/fetch_state?country_id='); ?>'+ country_id;
            fetch(url, {
                method: 'GET',
                headers:{
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(response => {
                for (var i = 0; i < response.length; i++ ) {
                    var option = document.createElement("option");
                    option.text = response[i].state;
                    option.value = response[i].id; 
                    var select = document.getElementById("state");
                    select.appendChild(option);
                }

                if (state_id) {
                    document.getElementById("state").value = state_id;
                    state_id = '';
                }

            })
            .catch(error => console.log(error));
        }
    };
    changeCountry('<?php if( isset( $facility_details )){ echo $facility_details["stateid"]; } ?>');    
</script>
