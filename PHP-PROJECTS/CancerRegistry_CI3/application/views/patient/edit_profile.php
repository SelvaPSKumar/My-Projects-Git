<div class="container-xxl">
    <div class="row">

        <div class="col-md-12 dashboard-main">
            <div class="container">
                <div class="container mt-2">
                    <div class="back-container d-flex">
                        <a href="<?php echo base_url('profile'); ?>" class="back-link">
                        <button class="btn next-btn float-end"><span class="prev-icon"><ion-icon name="chevron-back-outline"></ion-icon></span> Back</button>
                        </a>
                    </div>
                </div>


                <form action="<?php echo base_url('User_profile/update_profile/' . $value->id); ?>" method="post">

                    <div class="row">
                        <div class="col-md-12 dashboard-main">
                            <div>
                                <div class="text-center">
                                    <img src="<?php echo base_url('assets/img/doctorset1.svg') ?>" alt="image" class="profile-image" />
                                    <!-- <div class="mb-3">
                                        <label for="formFile" class="form-label">
                                            <h2>change photo</h2>
                                            <input class="form-control" type="file" id="formFile">
                                    </div> -->
                                </div>

                            </div>
                            <div class="values-container">
                                <div class="row mt-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label">Name as per NRIC/Passport</label>

                                                <input class="form-control" type="text" name="fname" value="<?php echo $value->fname; ?>" placeholder="Name as per NRIC/Passport">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label for="exampleInputEducation" class="form-label">Nationality</label><br>
                                                <div class="inline-block">
                                                    <input name="nationality_id" <?php echo (isset($values->nationality_id) && $values->nationality_id == 1 ) ? 'checked' : ''; ?> class="" type="radio" name="nationality_id" value="1">
                                                    <label class="" for="">Malaysian</label>
                                                </div>
                                                <div class="inline-block ms-5">
                                                    <input name="nationality_id" <?php echo (isset($values->nationality_id) && $values->nationality_id == 0 ) ? 'checked' : ''; ?> class="" type="radio"  name="nationality_id" value="0">
                                                    <label class="" for="">Non-Malaysian</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label">NRIC/Passport Number</label>
                                                <input name="id_number" class="form-control" type="text" value="<?php echo isset($values->id_number) ? $values->id_number :''; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                        <div class="mb-2">
                                            <label class="form-label">Ethnicity</label>
                                        <select class="form-select" name="ethnicity_id" aria-label="Default select example">
                                          <option value="0">Select Ethnicity</option>
                                           <?php foreach ($ethnicities as $ethnicity) { ?>
                                                        <option value="<?php echo $ethnicity->id; ?>" <?php echo ($values->ethnicity_id == $ethnicity->id) ? "selected" : "" ?>><?php echo $ethnicity->ethnicity; ?></option>
                                                    <?php } ?>
                                      </select>
                                        </div>
                                    </div>
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label">Gender</label>
                                                <select class="form-select" name="gender_id">
                                                    <option value="">Choose Gender</option>
                                                    <?php foreach ($genders as $gender) { ?>
                                                        <option value="<?php echo $gender->id; ?>" <?php echo ($value->gender_id == $gender->id) ? "selected" : "" ?>><?php echo $gender->gender; ?></option>
                                                    <?php } ?>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label">Date of Birth</label>
                                                <input class="form-control" type="date" name="dob" value="<?php echo $value->dob ?>" max="<?php echo date("Y-m-d"); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label">Contact Number</label>
                                                <input class="form-control" type="text" name="contact_number" value="<?php echo $value->contact_number; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label">Address Line 1</label>
                                                <input class="form-control" name="address1" type="text" value="<?php echo isset($values->address1) ? $values->address1 : ''; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label">Address Line 2</label>
                                                <input class="form-control" name="address2" type="text" value="<?php echo isset($values->address2) ? $values->address2 : ''; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label">Zip code</label>
                                                <input class="form-control" type="number" name="postcode" value="<?php echo isset($values->postcode) ? $values->postcode : ''; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label">City</label>
                                                <input class="form-control" name="city" type="text" value="<?php echo isset($values->city) ? $values->city : ''; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label for="Country" class="form-label">Country</label>

                                                <select class="form-select" name="country_name" id="country" onchange="changeCountry()">

                                                    <option value="">Choose Country </option>
                                                    <?php foreach ($countries as $country) { ?>
                                                        <option value="<?php echo $country->id; ?>" <?php echo (isset($values->country_id) && $country->id == $values->country_id) ? "selected" : "" ?>><?php echo $country->country_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label">State</label>
                                                <select class="form-select" name="state_id" id="state">
                                                    <option value="">Choose State </option>
                                                    <!-- <?php foreach ($states as $state) { ?>
                                                        <option value="<?php echo $state->id; ?>" <?php echo (isset($values->state_id) && $state->id == $values->state_id) ? "selected" : "" ?>><?php echo $state->state; ?></option>
                                                    <?php } ?> -->
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label">Blood Group</label>
                                                <select class="form-select" name="blood_name">
                                                    <option selected value="">Choose Blood Group</option>
                                                    <?php foreach ($all_bloods as $blood) { ?>
                                                        <option value="<?php echo $blood->id; ?>" <?php echo (isset($values->bloodgroup_id) && $blood->id == $values->bloodgroup_id) ? "selected" : "" ?>><?php echo $blood->bloodgroup_name; ?></option>


                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label for="" class="form-label">Socioeconomic Background</label>
                                                <select class="form-select" name="socioeconomic_id">
                                                    <option value="">Choose Socioeconomic Background</option>
                                                    <?php foreach ($socioeconomics as $socioeconomic) { ?>
                                                        <option value="<?php echo $socioeconomic->id; ?>" <?php echo (isset($values->socioeconomic_id) && $socioeconomic->id == $values->socioeconomic_id)   ? "selected" : "" ?>><?php echo $socioeconomic->socio_tips; ?></option>


                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label for="education_level" class="form-label">Education level</label>
                                                <select class="form-select" name="education_level">

                                                    <option value="">Choose Education level</option>
                                                    <?php foreach ($education as $educations) { ?>
                                                        <option value="<?php echo $educations->id; ?>" <?php echo (isset($values->education_level_id) && $educations->id == $values->education_level_id)   ? "selected" : "" ?>><?php echo $educations->education_level; ?></option>


                                                    <?php } ?>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label">Family History of Cancer</label><br>
                                                <div class="inline-block">
                                                    <input class="" type="radio" name="family_history_of_cancer" value="1" <?php echo (isset($values->family_history_of_cancer) && $values->family_history_of_cancer == 1) ? 'checked' : ''; ?>>
                                                    <label class="" for="">
                                                        Yes
                                                    </label>
                                                </div>
                                                <div class="inline-block ms-5">
                                                    <input class="" type="radio"  name="family_history_of_cancer" value="0" <?php echo (isset($values->family_history_of_cancer) && $values->family_history_of_cancer == 0) ? 'checked' : ''; ?>>
                                                    <label class="" for="">
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label for="Marital_status" class="form-label">Marital status</label>

                                                <select class="form-select" name="marital_status">

                                                    <option value="">Choose Marital status </option>
                                                    <?php foreach ($maritalstatus as $status) { ?>
                                                        <option value="<?php echo $status->id; ?>" <?php echo (isset($values->maritalstatus_id) && $status->id == $values->maritalstatus_id) ? "selected" : "" ?>><?php echo $status->marital_status; ?></option>


                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label">Are you a PERKESO member?</label><br>
                                                <div class="inline-block">
                                                    <input class="" type="radio" name="perkeso_member" value="1" <?php echo (isset($values->perkeso_member) && $values->perkeso_member == 1) ? 'checked' : ''; ?>>
                                                    <label class="" for="">
                                                        Yes
                                                    </label>
                                                </div>
                                                <div class="inline-block ms-5">
                                                    <input class="" type="radio"  name="perkeso_member" value="0" <?php echo (isset($values->perkeso_member) && $values->perkeso_member == 0) ? 'checked' : ''; ?>>
                                                    <label class="" for="">
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-5 mt-5 btn-peofile">
                                        <div class="col">
                                            <a href="<?php echo base_url('profile'); ?>">
                                                <button class="Cancel-button">Cancel</button>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <button type="submit" class="edit-button">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

    <?php if (isset($values->state_id)) { ?>
        var state_id = <?php echo $values->state_id; ?>;
    <?php } ?>

    <?php if (isset($values->country_id)) { ?>
        changeCountry();
    <?php } ?>

    function changeCountry() {
        var country = document.getElementById("country");
        var country_id = country.value;
        document.getElementById("state").innerHTML = "";

        var option = document.createElement("option");
        option.text = "Choose State";
        option.value = "";
        var select = document.getElementById("state");
        select.appendChild(option);

        if (country_id) {
            var url = 'user_profile/fetch_state?country_id=' + country_id;
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
            .catch(error => console.error('Error:', error));
        }
    }
</script>
