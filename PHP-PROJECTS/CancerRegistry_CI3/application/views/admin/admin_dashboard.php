<?php $CI = & get_instance(); ?>
<div class="container">
        <div class="row">
           
            <div class="col-md-12 dashboard-main">
              <div class="row mt-3">
                <h6>Welcome Back !!</h6>
              
              </div>
               <div class="row mt-3">
                  <?php if($CI->session->userdata('rolecode') == SYSTEM_ADMIN) { ?>
                      <div class="col-sm-12 col-md-4">
                          <div class="card dashboard-results-body">
                              <div class="card-body">
                                  <p>Total Facilites</p>
                                  <h6><?php echo  isset($facility_count) ? $facility_count : 0;  ?></h6>
                              </div>
                          </div>
                      </div>
                  <?php } ?>
                  <div class="col-sm-12 col-md-4">
                      <div class="card dashboard-results-body">
                          <div class="card-body">
                              <p>Total Doctors/HCPs</p>
                              <h6><?php echo  isset($doctors_count) ? $doctors_count : 0;  ?></h6>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-12 col-md-4">
                      <div class="card dashboard-results-body">
                          <div class="card-body">
                              <p>Total Pending Doctors/HCPs</p>
                              <h6><?php echo  isset($pending_doctors_count) ? $pending_doctors_count : 0;  ?></h6>
                          </div>
                      </div>
                  </div>

               </div>
            </div>
        </div>
    </div>