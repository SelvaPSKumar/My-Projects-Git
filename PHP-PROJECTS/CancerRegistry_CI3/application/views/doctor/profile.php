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
                            <label for="exampleInputEmail1" class="form-label">Name as per NRIC/Passport</label>
                            <input class="form-control" type="text" value="<?php echo $value->fname ?>" aria-label="readonly input example" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label for="exampleInputEmail1" class="form-label">Gender</label>
                            <input class="form-control" type="text" value="<?php echo get_gender($value->gender_id) ?>" aria-label="readonly input example" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label for="exampleInputEmail1" class="form-label">Registration Number</label>
                            <input class="form-control" type="text" value="<?php echo $value->registration_number ?>" aria-label="readonly input example" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label for="exampleInputEmail1" class="form-label">Facility</label>
                            <input class="form-control" type="text" value="<?php echo get_facility_name($value->facility_id) ?>" aria-label="readonly input example" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label for="exampleInputEmail1" class="form-label">Contact Number</label>
                            <input class="form-control" type="text" value="<?php echo $value->contact_number ?>" aria-label="readonly input example" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label for="exampleInputEmail1" class="form-label">Date Of birth</label>
                            <input class="form-control" type="text" value="<?php echo $value->dob ?>" aria-label="readonly input example" readonly>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input class="form-control" type="text" value="<?php echo $value->email ?>" aria-label="readonly input example" readonly>
                        </div>
                    </div>
                </div>
            </div>
           </div>
            </div>
        </div>
    </div>
