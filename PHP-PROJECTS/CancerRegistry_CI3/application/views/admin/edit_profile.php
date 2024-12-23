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
                    <!-- <div class="row mt-2">
                        <div class="col-md-12">
                            <p>Edit Profile</p>
                        </div>
                       
                    </div> -->
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
                                            <label for="exampleInputEmail1" class="form-label">Name as per NRIC/Passport</label>
                                            <input class="form-control" type="text" name="fname" value="<?php echo $value->fname ?>" aria-label="readonly input example" placeholder="Name as per NRIC/Passport">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-2">
                                        <label for="exampleInputEmail1" class="form-label">Contact Number</label>
                                            <input class="form-control" type="text" name="contact_number" value="<?php echo $value->contact_number ?>" aria-label="readonly input example" placeholder="Contact Number">
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

                                <div class="row mb-5 mt-5 btn-peofile">
                                    
                                    <div class="col">
                                        <button class="Cancel-button">Cancel</button>
                                    </a>
                                    </div>
                                    <div class="col">
                                        <button class="edit-button">Save</button>
                                    </a>
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