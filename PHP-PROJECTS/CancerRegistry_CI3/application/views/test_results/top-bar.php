<link rel="styleSheet" href="<?php echo base_url('assets/css/allTestResults.css'); ?>" />

<div class="container-fluid sub-navbar-test-outer">
       <div class="sub-navbar-testresults">
        <ul class="nav">
        <li class="nav-item">
              <a class="nav-link" id="<?php if($active == 'healthtools') echo 'active'; ?>" href="<?php echo base_url('test_results/healthtools'); ?>">Your Health Tools</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="<?php if($active == 'general_health') echo 'active'; ?>" href="<?php echo base_url('test_results/general_health'); ?>">General Health Screening</a>
            </li>
          <?php if($this->session->userdata('gender_id') == 2){ ?>
            <li class="nav-item">
              <a class="nav-link" id="<?php if($active == 'breast') echo 'active'; ?>"  href="<?php echo base_url('test_results/breast'); ?>">Breast Cancer</a>
            </li>
              <li class="nav-item">
                <a class="nav-link" id="<?php if($active == 'cervical') echo 'active'; ?>" href="<?php echo base_url('test_results/cervical'); ?>">Cervical Cancer</a>
              </li>
            <li class="nav-item">
              <a class="nav-link" id="<?php if($active == 'colorectal') echo 'active'; ?>" href="<?php echo base_url('test_results/colorectal'); ?>">Colorectal Cancer</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="<?php if($active == 'lungs') echo 'active'; ?>" href="<?php echo base_url('test_results/lungs'); ?>">Lung Cancer</a>
            </li>
            <?php }else if($this->session->userdata('gender_id') == 1){ ?>
            <li class="nav-item">
                <a class="nav-link" id="<?php if($active == 'prostate') echo 'active'; ?>" href="<?php echo base_url('test_results/prostate'); ?>">Prostate Cancer</a>
              </li>
            <li class="nav-item">
              <a class="nav-link" id="<?php if($active == 'colorectal') echo 'active'; ?>" href="<?php echo base_url('test_results/colorectal'); ?>">Colorectal Cancer</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="<?php if($active == 'lungs') echo 'active'; ?>" href="<?php echo base_url('test_results/lungs'); ?>">Lung Cancer</a>
            </li>
            <?php }else{ ?>
            <li class="nav-item">
              <a class="nav-link" id="<?php if($active == 'colorectal') echo 'active'; ?>" href="<?php echo base_url('test_results/colorectal'); ?>">Colorectal Cancer</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="<?php if($active == 'breast') echo 'active'; ?>"  href="<?php echo base_url('test_results/breast'); ?>">Breast Cancer</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="<?php if($active == 'lungs') echo 'active'; ?>" href="<?php echo base_url('test_results/lungs'); ?>">Lung Cancer</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="<?php if($active == 'prostate') echo 'active'; ?>" href="<?php echo base_url('test_results/prostate'); ?>">Prostate Cancer</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="<?php ($active == 'cervical' ?  'active' : '') ?>" href="<?php echo base_url('test_results/cervical'); ?>">Cervical Cancer</a>
              </li>
            <?php } ?>
        </ul>
       </div>
    </div>
