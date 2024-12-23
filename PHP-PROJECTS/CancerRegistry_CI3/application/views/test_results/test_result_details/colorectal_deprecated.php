<link rel="styleSheet" href="<?php echo base_url('assets/css/allTestResults.css'); ?>" />
<link rel="styleSheet" href="<?php echo base_url('assets/css/global.css'); ?>" />
<div class="container">
        <div class="results-single-page">
        <div class="row">
            <div class="col-10">
              <h1>Colorectal Cancer Results</h1>
            </div>
            <div class="col-2">
                <a href="<?php echo base_url('test_results/colorectal'); ?>">
                <h2>
                    Back
                </h2>
            </a>

            </div>
        </div>
        
        </div>
        <div class="header-component">
            <h6><?php echo ucfirst($test_details[0]['assessment_sub_type']." Assessment"); ?> </h6>
            <h5><?php echo ucfirst(str_replace("_", " ", $test_details[0]['assessment_tool']));  ?></h5>
            <h3>Tested on: <?php echo $test_details[0]['date']. ", ". $test_details[0]['time']; ?></h3>
            <h3>Next Test date: --</h3>
        </div>
        <div class="tabel-results">
            <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">Question</th>
                    <th scope="col">Answer</th>
                  </tr>
                </thead>
               <tbody>
                <?php if (!empty($form_data)) { ?>
                <?php foreach ($form_data as $key => $value) { ?>
                  <tr onclick="gotoresults('$id')">
                    <td>
                        <?php 
                            if($value['question'] == 1){
                                echo "1. Do you have blood in your stool?";
                            }
                            if($value['question'] == 2){
                                echo "2. Have you experienced a change in your bowel habits?";
                            }
                            if($value['question'] == 3){
                                echo "3. Do you feel weak and fatigued for no known reason?";

                            }
                            if($value['question'] == 4){
                                echo "4. Do you have unexplained weight loss?";

                            }
                            if($value['question'] == 5){
                                echo "5. Do you have constant abdominal discomfort like cramps, pain or bloating for a while?";

                            }
                    ?></td>
                    <td><?php echo ($value['reply'] == 'n') ? "NO" : "YES";  ?></td>
                    
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
