<div class="container-fluid sub-navbar-test-outer">
       <div class="sub-navbar-testresults">
        <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" id="<?php if($active == 'health_tools_assessments') echo 'active'; ?>" href="<?php echo base_url('health_tools_assessments'); ?>">Health Tools Listings</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="<?php if($active == 'general_health') echo 'active'; ?>" href="<?php echo base_url('all_assessments/general_health'); ?>">General Screening</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="<?php if($active == 'breast_cancer') echo 'active'; ?>" href="<?php echo base_url('all_assessments/breast_cancer'); ?>">Breast Cancer</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="<?php if($active == 'cervical_cancer') echo 'active'; ?>" href="<?php echo base_url('all_assessments/cervical_cancer'); ?>">Cervical Cancer</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="<?php if($active == 'colorectal_cancer') echo 'active'; ?>" href="<?php echo base_url('all_assessments/colorectal_cancer'); ?>">Colorectal Cancer</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="<?php if($active == 'prostate_cancer') echo 'active'; ?>" href="<?php echo base_url('all_assessments/prostate_cancer'); ?>">Prostate Cancer</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="<?php if($active == 'lung_cancer') echo 'active'; ?>" href="<?php echo base_url('all_assessments/lung_cancer'); ?>">Lung Cancer</a>
            </li>
            <!--
            <li class="nav-item">
              <a class="nav-link" id="<?php if($active == 'all_assessments') echo 'active'; ?>" href="<?php echo base_url('all_assessments'); ?>">Assesssment Listings</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="<?php if($active == 'manage_patients') echo 'active'; ?>" href="<?php echo base_url('manage_patients'); ?>">Patient Listing</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Reports</a>
            </li>
          -->
        </ul>
       </div>
    </div>