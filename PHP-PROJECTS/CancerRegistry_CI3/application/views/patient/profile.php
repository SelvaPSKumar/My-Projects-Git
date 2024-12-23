<div class="container">
    <div class="row mt-2">
        <div class="col-md-10">
            <!-- <p>Profile Setting</p> -->
        </div>
        <div class="col-md-2">

            <!-- <p class="edit-profile-text"> -->
                <a href="<?php echo base_url('edit_profile'); ?>"><button class="btn next-btn float-end">Edit Profile</button></a>
            <!-- </p> -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 dashboard-main">
            <div>
                <div class="text-center">
                    <img src="<?php echo base_url('assets/img/doctorset1.svg') ?>" alt="image" class="profile-image" />
                </div>

            </div>
            <div class="values-container">
                <div class="row mt-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">Name as per NRIC/Passport</label>
                                <input class="form-control" type="text" value="<?php echo $value->fname ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">Nationality</label><br>
                                <div class="inline-block">
                                    <input name="nationality_id" <?php echo (isset($values->nationality_id) && $values->nationality_id == 1 ) ? 'checked' : ''; ?> type="radio" name="nationality_id" value="1" disabled>
                                    <label class="label">Malaysian</label>
                                </div>
                                <div class="inline-block ms-5">
                                    <input name="nationality_id" <?php echo (isset($values->nationality_id) && $values->nationality_id == 0 ) ? 'checked' : ''; ?>  type="radio"  name="nationality_id" value="0" disabled>
                                    <label class="label">Non-Malaysian</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">NRIC/Passport Number</label>
                                <input class="form-control" type="text" value="<?php echo isset($values->id_number) ? $values->id_number : ''; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">Ethnicity</label>
                            <select class="form-select" name="ethnicity_id" aria-label="Default select example" disabled>
                              <option value="0">Select Ethnicity</option>
                               <?php foreach ($ethnicities as $ethnicity) { ?>
                                                        <option value="<?php echo $ethnicity->id; ?>" <?php echo ($values->ethnicity_id == $ethnicity->id) ? "selected" : "" ?>><?php echo $ethnicity->ethnicity; ?></option>
                                                    <?php } ?>
                          </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="exampleInputGender" class="form-label">Gender</label>
                                <input class="form-control" type="text" value="<?php echo get_gender($value->gender_id) ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">Date of Birth</label>
                                <input class="form-control" type="date" value="<?php echo $value->dob ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">Contact Number</label>
                                <input class="form-control" type="text" value="<?php echo $value->contact_number ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">Email address</label>
                                <input class="form-control" type="text" value="<?php echo $value->email ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">Address1</label>
                                <input class="form-control" type="text" value="<?php echo isset($values->address1) ? $values->address1 : ''; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">Address2</label>
                                <input class="form-control" type="text" value="<?php echo isset($values->address2) ? $values->address2 : ''; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">Zip code</label>
                                <input class="form-control" type="text" value="<?php echo isset($values->postcode) ? $values->postcode : ''; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">City</label>
                                <input class="form-control" type="text" value="<?php echo isset($values->city) ? $values->city : ''; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">Country</label>
                                <input class="form-control" type="text" value="<?php echo isset($values->country_id) ? get_country($values->country_id) : '' ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">State</label>
                                <input class="form-control" type="text" value="<?php echo isset($values->state_id) ? get_state($values->state_id) : ''; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">Blood Group</label>
                                <input class="form-control" type="text" value="<?php echo isset($values->bloodgroup_id) ? get_blood($values->bloodgroup_id) : '' ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">Socioeconomic Background</label>
                                <input class="form-control" type="text" value="<?php echo isset($values->socioeconomic_id) ? get_socioeconomic($values->socioeconomic_id) : ''; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">Educational Level</label>
                                <input class="form-control" type="text" value="<?php echo isset($values->education_level_id) ? get_education($values->education_level_id) : ''; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">Family History of Cancer</label><br>
                                <div class="inline-block">
                                    <input name="family_history_of_cancer" <?php echo (isset($values->family_history_of_cancer) && $values->family_history_of_cancer == 1 ) ? 'checked' : ''; ?> type="radio" name="family_history_of_cancer" value="1" disabled>
                                    <label class="label">Yes</label>
                                </div>
                                <div class="inline-block ms-5">
                                    <input name="family_history_of_cancer" <?php echo (isset($values->family_history_of_cancer) && $values->family_history_of_cancer == 0 ) ? 'checked' : ''; ?>  type="radio"  name="family_history_of_cancer" value="0" disabled>
                                    <label class="label">No</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">Marital Status</label>
                                <input class="form-control" type="text" value="<?php echo isset($values->maritalstatus_id) ? get_maritial($values->maritalstatus_id) : ''; ?>" readonly>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">Are you a PERKESO member?</label><br>
                                <div class="inline-block">
                                    <input name="perkeso_member" <?php echo (isset($values->perkeso_member) && $values->perkeso_member == 1 ) ? 'checked' : ''; ?> type="radio" name="perkeso_member" value="1" disabled>
                                    <label class="label">Yes</label>
                                </div>
                                <div class="inline-block ms-5">
                                    <input name="perkeso_member" <?php echo (isset($values->perkeso_member) && $values->perkeso_member == 0 ) ? 'checked' : ''; ?>  type="radio"  name="perkeso_member" value="0" disabled>
                                    <label class="label">No</label>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                    
                    

                    <!-- <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">Area</label>
                                <input class="form-control" type="text" value="XXXX" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">Apartment, suite, etc</label>
                                <input class="form-control" type="text" value="123/a XXX," readonly>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
