

<link rel="styleSheet" href="<?php echo base_url('assets/css/allTestResults.css'); ?>" />

<div class="container-fluid sub-navbar-test-outer">
    <div class="row">
        <div class="col-9">
          <div class="sub-navbar-testresults">
              <ul class="nav">
                  <li class="nav-item">
                    <a class="nav-link" id="<?php if($active == 'doctors') echo 'active'; ?>" href="<?php echo base_url('manage_doctors/doctors'); ?>">Doctors/HCPs</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="<?php if($active == 'pending_doctors') echo 'active'; ?>"  href="<?php echo base_url('manage_doctors/pending_doctors'); ?>">Pending for Approval</a>
                  </li>
              </ul>
          </div>
        </div>
        <?php if ($active == 'pending_doctors') { ?>
            <div class="col-3">
                <a href="#" onclick="bulkApproveDoctor(event)" class="btn btn-outline-primary mt-1">Approve</a>
            </div>
        <?php } ?>
    </div>
</div>