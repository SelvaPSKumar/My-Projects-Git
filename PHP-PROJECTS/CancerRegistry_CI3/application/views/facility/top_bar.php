<div class="container-fluid sub-navbar-test-outer">
       <div class="sub-navbar-testresults">
        <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" id="<?php if($active == 'facility') echo 'active'; ?>" href="<?php echo base_url('facility/listing'); ?>">Facility Listings</a>
            </li> 
            <li class="nav-item">
              <a class="nav-link" id="<?php if($active == 'facilityadmin') echo 'active'; ?>" href="<?php echo base_url('facility/adminlisting'); ?>">Facility Admin Listing</a>
            </li> 
        </ul>
       </div>
    </div>
