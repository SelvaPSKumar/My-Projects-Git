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
            <div class="col-8 col-md-6">
              <h1>Breast Cancer Results</h1>
            </div>
            <div class="col-4 col-md-6">
            <?php if($CI->session->userdata('rolecode') == MEDICPRAC){ ?>
                <a href="<?php echo base_url('all_assessments'); ?>">
            <?php }else{ ?>
                <a href="<?php echo base_url('test_results/breast'); ?>">
            <?php } ?>
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
        <!-- <div class="result-container">
            <h6>SYMPTOM ASSESSMENT TOOL</h6>
            <p>You have successfully completed the Symptoms Assessment Tool. Please perform this assessment again in a month’s time.</p>
            <h6>RISK ASSESSMENT TOOL</h6>
            <p>Score: 0</p>
            <P>Management Recommendation: “You are of low risk and should continue preventative practices. It is ideal to do a baseline Faecal Occult Blood Test (FOBT) at any Klinik Kesihatan. Otherwise, contact National Cancer Society Malaysia (NCSM) at 03-26987351 for further details on FOBT.”
            </P>
            <h6>COLONOSCOPY</h6>
            <p>Normal</p>
            <h6>iFOBT</h6>
            <p>Negative</p>
        </div> -->
    </div>
