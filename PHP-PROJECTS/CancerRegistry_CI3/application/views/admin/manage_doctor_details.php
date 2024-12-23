<link rel="styleSheet" href="<?php echo base_url('assets/css/allTestResults.css'); ?>" />
<link rel="styleSheet" href="<?php echo base_url('assets/css/global.css'); ?>" />
    <?php $CI = & get_instance() ?>
<style>
    .red-color{
        color: red !important;
    }
</style>
<div class="container">
    <div class="results-single-page">
        <div class="row">
            <div class="col-10">
              <h1>Doctor Details</h1>
            </div>
            <div class="col-2">
                <a href="<?php echo $_SERVER['HTTP_REFERER'] ?>">
                    <button class="btn next-btn float-end"><span class="prev-icon"><ion-icon name="chevron-back-outline"></ion-icon></span> Back</button>
                </a>
            </div>
        </div>
    </div>
    
    <div class="header-component">
        <h6><?php echo $doctor['fname'] ?></h6>
        <h5>Registration Number : <?php echo $doctor['registration_number'] ?></h5>
        <h3>Eamil : <?php echo $doctor['email'] ?></h3>
        <h3>Contact Number : </span><?php echo $doctor['contact_number'] ?></h3>
        <h3>Facility Name : </span><?php echo $doctor['facility_name'] ?></h3>
    </div>

    <div class="form-switch">
        <input class="form-check-input" onclick="processObsolete(this, <?php echo $doctor['id']; ?>)" type="checkbox" id="doctor-status" <?php echo (!$doctor['is_obsolete']) ? 'checked' : ''; ?>>
        <label class="form-check-label" for="doctor-status">Active</label>
    </div>


    <!-- <div class="row mt-3">
        <div class="col-5">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-start"><span class="text-muted">Name : </span><?php echo $doctor['fname'] ?></li>
                <li class="list-group-item d-flex justify-content-between align-items-start"><span class="text-muted">Eamil : </span><?php echo $doctor['email'] ?></li>
                <li class="list-group-item d-flex justify-content-between align-items-start"><span class="text-muted">Contact Number : </span><?php echo $doctor['contact_number'] ?></li>
                <li class="list-group-item d-flex justify-content-between align-items-start"><span class="text-muted">Registration Number : </span><?php echo $doctor['registration_number'] ?></li>
                <li class="list-group-item d-flex justify-content-between align-items-start"><span class="text-muted">Facility Name : </span><?php echo $doctor['facility_name'] ?></li>
            </ul>

            <br>
            <div class="form-switch text-center">
                <input class="form-check-input" onclick="processObsolete(this, <?php echo $doctor['id']; ?>)" type="checkbox" id="doctor-status" <?php echo (!$doctor['is_obsolete']) ? 'checked' : ''; ?>>
                <label class="form-check-label" for="doctor-status">Active</label>
            </div>
        </div>
    </div> -->
</div>

<script>
    function processObsolete(that, id){
        if($(that).is(':checked')) {
            window.location = "<?php echo base_url('manage_doctors/'. $list_type .'/'); ?>" + id + '/not_obsolete';
        } else {
            window.location = "<?php echo base_url('manage_doctors/'. $list_type .'/'); ?>" + id + '/obsolete';
        }
    }
</script>