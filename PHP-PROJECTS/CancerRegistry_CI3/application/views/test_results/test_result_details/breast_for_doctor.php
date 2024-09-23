<link rel="styleSheet" href="<?php echo base_url('assets/css/allTestResults.css'); ?>" />
<link rel="styleSheet" href="<?php echo base_url('assets/css/global.css'); ?>" />
    <?php $CI = & get_instance() ?>
    <?php $this->load->helper('common_helper'); ?>
<style>
    .red-color{
        color: red !important;
    }
</style>
<div class="container" style="margin-top: 50px">
        <div class="results-single-page">
        <div class="row">
            <div class="col-10">
              <h1><?php 
                if(isset($assessment_type)) {
                    if(count($assessment_type[0])>0) {
                        foreach($assessment_type[0] as $type) {
                            switch($type) {
                                case 'colorectal_cancer':
                                    echo 'Colorectal Cancer Results';
                                break;
                                case 'breast_cancer':
                                    echo 'Breast Cancer Results';
                                break;
                                case 'lungs_cancer':
                                    echo 'Lungs Cancer Results';
                                break;
                                case 'prostate_cancer':
                                    echo 'Prostate Cancer Results';
                                break;
                                case 'cervical_cancer':
                                    echo 'Cervical Cancer Results';
                                break;
                                case 'your_health_tools':
                                    echo 'Your Health Tools Results';
                                break;
                                default:
                                break;
                            }
                        }
                    }
                }
              ?>    
              </h1>
            </div>
            <div class="col-12 col-sm-2">
                <a href="<?php echo base_url('manage_patients'); ?>">
                    <button class="btn next-btn float-end"><span class="prev-icon"><ion-icon name="chevron-back-outline"></ion-icon></span> Back</button>
                </a>
            </div>
        </div>
        
        </div>
        <?php 
            $assessment_sub_type_id         = $header_data[0]['assessment_sub_type_id']; 
            $assessment_sub_type_name       = $CI->get_assessment_sub_type_info($assessment_sub_type_id)->assessment_sub_type_name;
            $assessment_tool_id             = $header_data[0]['assessment_tool_id'];
            $assessment_tool_name           = $CI->get_assessment_tool_info($assessment_tool_id)->assessment_tool_name; 
        ?>
        <div class="header-component">
            <?php if($CI->session->userdata('rolecode') == MEDICPRAC){ ?>
                <h5>Patient Information</h5>
                <h3>Name as per NRIC/Passport: <?php echo $patient_data[0]['fname']; ?></h3>
                <h3>Patient ID: <?php echo $patient_data[0]['patient_referral_id']; ?></h3>
                <h3>NRIC/Passport Number: <?php echo $patient_data[0]['id_number']; ?></h3>
                <h3>Patient's Contact Number: <?php echo $patient_data[0]['contact_number']; ?></h3>
            <?php } ?>
            <h6><?php echo  $assessment_sub_type_name." Assessment"; ?> </h6>
            <h5><?php echo isset($assessment_tool_name) ? $assessment_tool_name :'';  ?></h5>
            <h3>Assessment Number: <?php echo $header_data[0]['assessment_prefix'], '-' , $header_data[0]['assessment_number'];; ?></h3>
            <h3>Assessment on: <?php echo $header_data[0]['assessment_date'], ' ' , $header_data[0]['assessment_time'];; ?></h3>
            <h3>Next Assessment date: <?php echo $header_data[0]['next_assesment_date']; ?></h3>
        </div>
        <div class="tabel-results table-responsive">
            <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">Question</th>
                    <th scope="col">Answer</th>
                  </tr>
                </thead>
               <tbody>
                <?php if (!empty($header_detail)) { ?>
                <?php foreach ($header_detail as $key => $value) { ?>
                  <tr onclick="gotoresults('$id')">
                    <td>
                        <?php 
                            // echo $value['q_identifier'];
                            echo $value['q_no'].". ".$value['questionnaire'];
                    ?></td>
                    <!-- #F62817 -->
                    <?php if($value['file_path'] == 1) { ?>
                        <td><a href="<?php echo base_url('view_image/').$header_data[0]['id'].'/'.$value['assement_questionnaires_id'];  ?>" target="_blank"><img src="<?php echo get_encrypted_image($value['assessment_questionnaires_value']);  ?>" width="100"></a></td>

                    <?php } else if($value['q_identifier'] == "BRE_CBE_20" || $value['q_identifier'] == "BRE_CBE_33"){ ?>

                        <td>
                            
                            <?php if (!empty($shapes)) {
                                    foreach ($shapes as $key => $shape) {
                                        if ($shape->id == $value['assessment_questionnaires_value']) {
                                            echo ucfirst($shape->shape);
                                        }
                                    }
                            } ?>

                        </td>

                    <?php } else if($value['q_identifier'] == "BRE_CBE_21" || $value['q_identifier'] == "BRE_CBE_34"){ ?>
                        
                        <td>
                            
                            <?php if (!empty($edges)) {
                                    foreach ($edges as $key => $edge) {
                                        if ($edge->id == $value['assessment_questionnaires_value']) {
                                            echo ucfirst($edge->edges);
                                        }
                                    }
                            } ?>

                        </td>

                    <?php } else if($value['q_identifier'] == "BRE_CBE_22" || $value['q_identifier'] == "BRE_CBE_35"){ ?>
                        <td>
                            
                            <?php if (!empty($consistency)) {
                                    foreach ($consistency as $key => $consisten) {
                                        if ($consisten->id == $value['assessment_questionnaires_value']) {
                                            echo ucfirst($consisten->consistency);
                                        }
                                    }
                            } ?>

                        </td>

                    <?php } else if($value['q_identifier'] == "BRE_IBR_5"){ ?>

                        <td>
                            
                            <?php if (!empty($symptoms)) {
                                    foreach ($symptoms as $key => $symptom) {
                                        if ($symptom->id == $value['assessment_questionnaires_value']) {
                                            echo ucfirst($symptom->symptom);
                                        }
                                    }
                            } ?>

                        </td>

                    <?php } else if($value['q_identifier'] == "BRE_IBR_9"){ ?>

                                <td>
                                    <div class="row">

                                        <?php if (!empty($ibreast_test_findings)) {
                                            $i=0;
                                            $j=0;
                                            foreach ($ibreast_test_findings as $key => $ibreast_test_finding) { ?>
                                            
                                                <?php if($j == 0 && $i==0){ ?>
                                                    <div class="col-md-4">
                                                <?php } ?>

                                                <?php if ($i == 4) { 
                                                            echo "<br>"; $i=0; $j++;
                                                                if ($j >=4) {
                                                                    $j=0;
                                                ?>
                                                    </div><div class="col-md-4">

                                                <?php } } $i++;?>
                                              
                                                    <input type="checkbox" <?php echo ($ibreast_test_finding == 1) ? "checked" :''; ?>  class="form-check-input" name="ibreast_test_findings[right_breast_1]" id="" onclick="return false;" style="font-size: 20px">

                                        <?php  } } ?>

                                          </div>

                                        
                                        
                                    </div>

                                    <!-- <div class="row">

                                            <div class="col-md-3">
                                              <input type="checkbox" <?php echo ($key == 'left_breast_1' && $val == 1) ? "checked" :''; ?>  class="" name="ibreast_test_findings[left_breast_1]" id="" >
                                              <input type="checkbox" <?php echo ($key == 'left_breast_2' && $val == 1) ? "checked" :''; ?>  class="" name="ibreast_test_findings[left_breast_2]" id="" >
                                              <input type="checkbox" <?php echo ($key == 'left_breast_3' && $val == 1) ? "checked" :''; ?>  class="" name="ibreast_test_findings[left_breast_3]" id="" >
                                              <input type="checkbox" <?php echo ($key == 'left_breast_4' && $val == 1) ? "checked" :''; ?>  class="" name="ibreast_test_findings[left_breast_4]" id="" ><br>
                                              <input type="checkbox" <?php echo ($key == 'left_breast_5' && $val == 1) ? "checked" :''; ?>  class="" name="ibreast_test_findings[left_breast_5]" id="" >
                                              <input type="checkbox" <?php echo ($key == 'left_breast_6' && $val == 1) ? "checked" :''; ?>  class="" name="ibreast_test_findings[left_breast_6]" id="" >
                                              <input type="checkbox" <?php echo ($key == 'left_breast_7' && $val == 1) ? "checked" :''; ?>  class="" name="ibreast_test_findings[left_breast_7]" id="" >
                                              <input type="checkbox" <?php echo ($key == 'left_breast_8' && $val == 1) ? "checked" :''; ?>  class="" name="ibreast_test_findings[left_breast_8]" id="" ><br>
                                              <input type="checkbox" <?php echo ($key == 'left_breast_9' && $val == 1) ? "checked" :''; ?>  class="" name="ibreast_test_findings[left_breast_9]" id="" >
                                              <input type="checkbox" <?php echo ($key == 'left_breast_10' && $val == 1) ? "checked" :''; ?>  class="" name="ibreast_test_findings[left_breast_10]" id="" >
                                              <input type="checkbox" <?php echo ($key == 'left_breast_11' && $val == 1) ? "checked" :''; ?>  class="" name="ibreast_test_findings[left_breast_11]" id="" >
                                              <input type="checkbox" <?php echo ($key == 'left_breast_12' && $val == 1) ? "checked" :''; ?>  class="" name="ibreast_test_findings[left_breast_12]" id="" ><br>
                                              <input type="checkbox" <?php echo ($key == 'left_breast_13' && $val == 1) ? "checked" :''; ?>  class="" name="ibreast_test_findings[left_breast_13]" id="" >
                                              <input type="checkbox" <?php echo ($key == 'left_breast_14' && $val == 1) ? "checked" :''; ?>  class="" name="ibreast_test_findings[left_breast_14]" id="" >
                                              <input type="checkbox" <?php echo ($key == 'left_breast_15' && $val == 1) ? "checked" :''; ?>  class="" name="ibreast_test_findings[left_breast_15]" id="" >
                                              <input type="checkbox" <?php echo ($key == 'left_breast_16' && $val == 1) ? "checked" :''; ?>  class="" name="ibreast_test_findings[left_breast_16]" id="" >
                                            </div>
                                            
                                          </div> -->


                                </td>



                    <?php } else { ?>

                        <td style="<?php echo ($value['assessment_questionnaires_value'] == 'yes') ? 'color: red !important' : ''; ?>"><?php echo ucfirst($value['assessment_questionnaires_value']);  ?></td>


                    <?php  } ?>
                    
                  </tr>
                <?php } } else {?>
                  <tr>
                    <td></td>
                    <td></td>
                    <td class="asses">
                        <h6 >No Records Found!</h6>
                    </td>
                    <td class="completed"></td>
                    <td></td>
                  </tr>
                <?php } ?>
               </tbody>
              </table>
        </div>

        <!-- <div class="container bg-light rounded" style="padding: 15px;">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <h5>Dr. Babu Rao Apte</h5>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                        <span>23/02/2023</span><span>06:50 PM</span>
                    </p>
                    <hr>
                    <p>
                        <h5>Dr. Babu Rao Apte</h5>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                        <span>23/02/2023</span><span>06:50 PM</span>
                    </p>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <form class="form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Comment</label>
                                    <textarea class="form-control" cols="50" rows="10" name="" placeholder="Write comment..."></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="" value="Comment">
                        </div>
                    </form>
                </div>
                <div class="col-md-6"></div>
                
            </div>
        </div> -->

    <style type="text/css">.link-muted { color: #aaa; } .link-muted:hover { color: #1266f1; }.card-body{height:auto;}</style>
<section class="bg-light">
  <div class="container my-5 py-5">
    <form class="form" action="<?php echo base_url('doctor/add_comment'); ?>" method="post">
<?php if ($this->session->flashdata('success')) { ?>
  <div class="alert alert-success" role="alert">
    <?php echo $this->session->flashdata('success'); ?>
  </div>
<?php } ?>


<?php if ($this->session->flashdata('errors')) { ?>
    <div class="alert alert-warning" role="alert">
    <?php echo $this->session->flashdata('errors'); ?>
  </div>
<?php } ?>


      <input type="hidden" name="assessment_header_id" value="<?php echo isset($header_data[0]['id']) ? $header_data[0]['id'] : ''; ?>">
      <input type="hidden" name="created_by" value="<?php echo $this->session->userdata('id'); ?>">
      <?php
       if (!empty($comments_user) && $comments_user[0]['user_type'] == INSTITUTE_ID) { ?>
        <div class="form-group">
          <label class="label">Comment Author Name</label>
          <input type="text" name="comment_author" required class="form-control">
        </div>
      <?php } ?>
        <div class="form-group">
            <label class="label">Comment</label>
            <textarea name="comment" class="form-control" cols="50" rows="8"></textarea>
        </div>
        <div class="form-group">
            <input type="submit" name="" class="btn btn-sm btn-primary" value="Add">
        </div>
        
    </form>
    <div class="row d-flex justify-content-center">
      <div class="col-md-12 col-lg-12">
        <div class="card text-dark">
            <div class="p-4">
              <h4 class="mb-0">Recent comments</h4>
              <p class="fw-light mb-4 pb-2">Latest Comments section by doctors</p>
            </div>
          <?php if (!empty($comments)) {
                  foreach ($comments as $key => $comment) { ?>

                    <div class="card-body p-4">

                      <div class="d-flex flex-start">
                        <img class="rounded-circle shadow-1-strong me-3"
                          src="<?php echo base_url('assets/img/patient-icon.png') ?>" alt="avatar" width="60"
                          height="60" />
                        <div>
                          <h6 class="fw-bold mb-1"><?php echo isset($comment['comment_author']) ? $comment['comment_author'].' - ' : ''; ?> <?php echo isset($comment['fname']) ? $comment['fname'] : ''; ?></h6>
                          <div class="d-flex align-items-center mb-3">
                            <p class="mb-0">
                              <?php echo isset($comment['created_date']) ? $comment['created_date'] : ''; ?>
                              <!-- <span class="badge bg-primary">Pending</span> -->
                            </p>
                            <a href="#!" class="link-muted"><i class="fas fa-pencil-alt ms-2"></i></a>
                            <a href="#!" class="link-muted"><i class="fas fa-redo-alt ms-2"></i></a>
                            <a href="#!" class="link-muted"><i class="fas fa-heart ms-2"></i></a>
                          </div>
                          <p class="mb-0">
                              <?php echo isset($comment['comments']) ? $comment['comments'] : ''; ?>
                          </p>
                        </div>
                      </div>
                    </div>

                  <hr class="my-0" />

          <?php } } ?>
          
        </div>
      </div>
    </div>
  </div>
</section>
    </div>
