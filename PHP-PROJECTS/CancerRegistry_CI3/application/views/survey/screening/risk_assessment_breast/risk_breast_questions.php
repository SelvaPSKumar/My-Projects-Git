<link rel="styleSheet" href="<?php echo base_url('assets/css/ScreeningQuestions.css') ?>" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<div class="container">
        <div class="back-container">
            <a href="<?php echo base_url('screening/screen'); ?>">
            <button class="btn next-btn float-end"><span class="prev-icon"><ion-icon name="chevron-back-outline"></ion-icon></span> Back</button>
              
            </a>
        </div>
        
        <h1 class="screeningHeader">BREAST CANCER RISK ASSESSMENT TOOL </h1>  
    </div>
    <div class="question-container mt-5">
      

        <div class="questions-section-final mt-5">
            <p>The Breast Cancer Risk Assessment Tool (BCRAT) is based on a statistical model known as the Gail Model. 
            </p>
            <p>The tool uses a woman’s own personal information to estimate risk of developing invasive breast cancer over .specific periods of time
            </p>
                 <p class="text-center">Click below to access the BCRAT</p>
                 <a href="https://bcrisktool.cancer.gov/" target="blank">
                    <button class="btn proceed-btn">
                        Open BCRAT            
                      </button>
                </a>
        </div>
        <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
        <div class="">

            <form action="<?php echo base_url('risk_breast_questions_save'); ?>" method="POST">
            <input type="hidden" name="assessment_header_id" value="<?php echo $assessment_header_id ?>">
            <div class="questions-section mt-5">
                <?php if (!empty($questions)) {
                    foreach ($questions as $key => $question) {
                ?>
                        
                        <div class="row">
                            <div class="col-md-8 mb-2">
                                <h6><?php echo $question->q_no . ". ", $question->questionnaire;   ?></h6>
                                
                                <input type="number" class="form-control" name="<?php echo $question->id ?>[]" value="" required="true">
                                
                            </div>
                            
                        </div>

                <?php } } ?>
            </div>

            
            <div class="questions-section mt-5" id="completed_breast">
                <div class="row text-center">
                     <?php 
                        $date = new DateTime($assessment_header_data->assessment_date);
                        $date->modify('+12 month'); // or you can use '-90 day' for deduct
                        $next_assessment_date = $date->format('d-m-Y');
                        $next_assessment_dateymd = $date->format('Y-m-d');
                    ?>
                    <p>This will be the final assessment submission. Are you sure?</p>
                    <p>Next Assessment Date: <?php echo $next_assessment_date;  ?></p>
                    <input type="hidden" name="next_assesment_date" value="<?php echo $next_assessment_dateymd;  ?>">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                    <button class="btn submit-btn w-100" type="Submit">Complete</button>
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </div>

        </form>
<br><br>


            
        </div>
    </div>
    <script>
      var xValues = ['1 Year','2 Year', '3 Year', '4 Year'];
      var yValues = <?php echo json_encode($values); ?>;
      new Chart("myChart", {
        type: "line",
        data: {
          labels: xValues,
          datasets: [{
            fill: false,
            lineTension: 0,
            backgroundColor: "rgba(0,0,255,1.0)",
            borderColor: "rgba(0,0,255,0.1)",
            data: yValues
          }]
        },
        options: {
          legend: {display: false},
          title: {
            display: true,
            text: "% Per Year",
            fontSize: 16
          },
          scales: {
            yAxes: [{ticks: {min: 0, max: 100}}],
          }
        }
      });
</script>
