<?php $CI = & get_instance(); 

if($CI->current_user->gender_id == 1) { ?>
<div class="container">
        <div class="col-md-12 dashboard-main">
            <div class="row mt-3">
                <h6>Welcome to your Dashboard, <?php echo $CI->current_user->fname; ?> !</h6>
                <?php
                $last_logged_at = $CI->common_model->getById('m_users', $CI->current_user->id)->last_logged_at;
                if(!empty($last_logged_at)){
                $last_logged_at = date('d-m-Y', strtotime($last_logged_at));
                ?>
                <p>Your last login was on <?php echo $last_logged_at; ?></p>
                <?php } ?>
            </div>
        </div>
    </div>
    <div></div>
</div>
<div class="container">
    <div class="row mb-3">
        <div class="col-md-7 col-sm-12 mb-4">
            <div class="card" style="padding: 0; height: 570px;">
                <div class="card-header d-flex justify-content-center align-items-center" style="background-color: #deebf7">
                    Your Health Calendar
                </div>
                <div class="card-body" style="padding: 0;height: 350px;">
                    <div id="calendar1" class="calendar2"></div>
                </div>
            </div>
        </div>

        <div class="col-md-5 col-sm-12 mb-4">
            <div class="card" style="height: 570px;">
                <div class="card-body d-flex justify-content-center align-items-center">
                    <div class="row g-2">
                        <div class="col-6">
                            <div class="p-2 border rounded" style="background-color: #deebf7">
                                <p class="fw-bold text-center">42 Years</p>
                                <p class="fw-light text-center">Age</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 border rounded" style="background-color: #deebf7">
                                <p class="fw-bold text-center">O+</p>
                                <p class="fw-light text-center">Blood Group</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 border rounded" style="background-color: #deebf7">
                                <p class="fw-bold text-center">1.40</p>
                                <p class="fw-light text-center">Height (M)</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 border rounded" style="background-color: #deebf7">
                                <p class="fw-bold text-center">47</p>
                                <p class="fw-light text-center">Weight (Kg)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4 col-sm-12 mb-4">
            <div class="card" style="height: 400px;">
                <div class="card-header d-flex justify-content-center align-items-center" style="background-color: #deebf7">
                    Body Mass Index (BMI)
                </div>
                <div class="card-body d-flex justify-content-center align-items-center">
                    <canvas id="lineChart1"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-12 mb-4">
            <div class="card" style="height: auto;">
                <div class="card-body justify-content-center align-items-center" style="height: auto;">
                    <div>
                        <h5>Colorectal Cancer</h5>
                        <p>iFOBT due in XX days on 1.7.2023</p>
                        <p>Colonoscope was due YY days ago! on 20.6.2023</p>
                    </div>
                    <div style="background-color: #deebf7; border-radius: 5px; padding: 4px;">
                        <h5>Prostate Cancer</h5>
                        <p>PSA due in XX days on 10.7.2023</p>
                        <p>DRE due YY days ago! on 20.7.2023</p>
                    </div>
                    <div>
                        <h5>Lung Cancer</h5>
                        <p>CXR due in XX days on 23.7.2023</p>
                        <p>LDCT due YY days ago! on 30.7.2023</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-12 mb-4">
            <div class="card" style="height: 400px;">
              <div class="card-header d-flex justify-content-center align-items-center" style="background-color: #deebf7">
                Waist Circumference
              </div>
              <div class="card-body d-flex justify-content-center align-items-center">
                <canvas id="lineChart2"></canvas>
              </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4 col-sm-12 mb-4">
            <div class="card" style="height: 515px;">
                <div class="card-body d-flex justify-content-between justify-content-center align-items-center">
                    <canvas id="lineChart3" width="200" height="200"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-12 mb-4">
            <div class="card" style="height: 515px;">
                <div class="card-body d-flex justify-content-center align-items-center">
                    <canvas id="lineChart4" width="200" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } else if($CI->current_user->gender_id == 2) { ?>
    <div class="container">
        <div class="col-md-12 dashboard-main">
            <div class="row mt-3">
                <h6>Welcome to your Dashboard, <?php echo $CI->current_user->fname; ?> !</h6>
                <?php
                $last_logged_at = $CI->common_model->getById('m_users', $CI->current_user->id)->last_logged_at;
                if(!empty($last_logged_at)){
                $last_logged_at = date('d-m-Y', strtotime($last_logged_at));
                ?>
                <p>Your last login was on <?php echo $last_logged_at; ?></p>
                <?php } ?>
            </div>
        </div>
    </div>
    <div></div>
</div>
<div class="container">
    <div class="row mb-3">
        <div class="col-md-7 col-sm-12 mb-4">
            <div class="card" style="padding: 0; height: 570px;">
                <div class="card-header d-flex justify-content-center align-items-center" style="background-color: #F8C8DC">
                    Your Health Calendar
                </div>
                <div class="card-body" style="padding: 0;height: 350px;">
                    <div id="calendar2" class="calendar2"></div>
                </div>
            </div>
        </div>

        <div class="col-md-5 col-sm-12 mb-4">
            <div class="card" style="height: 570px;">
                <div class="card-body d-flex justify-content-center align-items-center">
                    <div class="row g-2">
                        <div class="col-6">
                            <div class="p-2 border rounded" style="background-color: #F8C8DC">
                                <p class="fw-bold text-center">42 Years</p>
                                <p class="fw-light text-center">Age</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 border rounded" style="background-color: #F8C8DC">
                                <p class="fw-bold text-center">O+</p>
                                <p class="fw-light text-center">Blood Group</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 border rounded" style="background-color: #F8C8DC">
                                <p class="fw-bold text-center">1.40</p>
                                <p class="fw-light text-center">Height (M)</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 border rounded" style="background-color: #F8C8DC">
                                <p class="fw-bold text-center">47</p>
                                <p class="fw-light text-center">Weight (Kg)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4 col-sm-12 mb-4">
            <div class="card" style="height: 370px;">
                <div class="card-header d-flex justify-content-center align-items-center" style="background-color: #F8C8DC">
                    Body Mass Index (BMI)
                </div>
                <div class="card-body d-flex justify-content-center align-items-center">
                    <canvas id="lineChart5"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-12 mb-4">
            <div class="card" style="height: 370px;">
                <div class="card-header d-flex justify-content-center align-items-center" style="background-color: #F8C8DC">
                    HPV Vaccination
                </div>
                <div class="card-body">
                    <!-- Wait for Content -->
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-12 mb-4">
            <div class="card" style="height: 370px;">
              <div class="card-header d-flex justify-content-center align-items-center" style="background-color: #F8C8DC">
                Waist Circumference
              </div>
              <div class="card-body d-flex justify-content-center align-items-center">
                <canvas id="lineChart6"></canvas>
              </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4 col-sm-12 mb-4">
            <div class="card" style="height: auto;">
                <div class="card-body justify-content-center align-items-center" style="height: auto;">
                    <div style="background-color: #F8C8DC; border-radius: 5px; padding: 5px;">
                        <h5>Breast Cancer</h5>
                        <p>iFOBT due in XX days on 1.7.2023</p>
                        <p>Colonoscope was due YY days ago! on 20.6.2023</p>
                    </div>
                    <div>
                        <h5>Cervical Cancer</h5>
                        <p>PSA due in XX days on 10.7.2023</p>
                        <p>DRE due YY days ago! on 20.7.2023</p>
                    </div>
                    <div>
                        <h5>Lung Cancer</h5>
                        <p>CXR due in XX days on 23.7.2023</p>
                        <p>LDCT due YY days ago! on 30.7.2023</p>
                    </div>
                    <div>
                        <h5>Colorectal Cancer</h5>
                        <p>CXR due in XX days on 23.7.2023</p>
                        <p>LDCT due YY days ago! on 30.7.2023</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-12 mb-4">
            <div class="card" style="height: 515px;">
                <div class="card-body d-flex justify-content-between justify-content-center align-items-center">
                    <canvas id="lineChart7" width="200" height="200"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-12 mb-4">
            <div class="card" style="height: 515px;">
                <div class="card-body d-flex justify-content-center align-items-center">
                    <canvas id="lineChart8" width="200" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } else {echo "Attempt Failed";} ?>
<style type="text/css">
    .highlighted-date{
        background: #fcf8e3;
    }
    .fc-unthemed td.fc-today {
        background: none!important; 
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js"></script>
<?php //echo "<pre>";print_r($all_assessments['CRA']);exit(); ?>

<?php
//implode(',', $Waist_points)
// echo '<pre>';print_r(implode(',', $Waist_points));exit();
// $assessment_label = array();
// $inc = 1;
// foreach ($CRA_all_points as $assessment => $point){
//     $assessment_label[] = 'Assmnt '.$inc;
//     $inc++;
// }

$BMI_label = array();
$inc = 1;
foreach ($BMI_points as $assessment => $point){
    $BMI_label[] = 'Assmnt '.$inc;
    $inc++;
}

$Waist_label = array();
$inc = 1;
foreach ($Waist_points as $assessment => $point){
    $Waist_label[] = 'Assmnt '.$inc;
    $inc++;
}
?>

<script>
    $(document).ready(function() {

        // Calendar 1
        $('#calendar1').fullCalendar({
            header: {
              left: '',
              center: 'title',
              right: ''
            },
            customButtons: {},
            views: {
              month: {
                eventLimit: 0
              }
            },
            events: [],
            dayRender: function(date, cell) {
                var highlightDates = ['<?php echo $next_ass_dates; ?>']; // Dates to be highlighted

                if (highlightDates.includes(date.format('YYYY-MM-DD'))) {
                    cell.addClass('highlighted-date'); // Add a CSS class to highlight the date
                }
            }
        });

      // Calendar 2
        $('#calendar2').fullCalendar({
            header: {
              left: '',
              center: 'title',
              right: ''
            },
            customButtons: {},
            views: {
              month: {
                eventLimit: 0
              }
            },
            events: [],
            dayRender: function(date, cell) {
                var highlightDates = ['<?php echo $next_ass_dates; ?>']; // Dates to be highlighted

                if (highlightDates.includes(date.format('YYYY-MM-DD'))) {
                    cell.addClass('highlighted-date'); // Add a CSS class to highlight the date
                }
            }
        });

        // BMI Assessment
        var ctx1 = document.getElementById('lineChart1').getContext('2d');
        var bmiArray = [<?php echo $BMI_points;?>];
        var BMIData = [];

        for (var i = 0; i < bmiArray.length; i++) {
          var dataPoint = {
            x: i + 1,
            y: bmiArray[i]
          };
          BMIData.push(dataPoint);
        }
        var chart1 = new Chart(ctx1, {
          type: 'line',
          data: {
            datasets: [
              {
                label: 'BMI Assessment',
                data: BMIData,
                backgroundColor: 'rgba(222, 235, 247, 0.4)', // #ff529a with alpha 0.4
                borderColor: 'rgba(222, 235, 247, 1)', // #ff529a with alpha 1
                pointRadius: 5,
                pointBackgroundColor: 'rgba(222, 235, 247, 1)', // #ff529a with alpha 1
                pointBorderColor: 'rgba(0, 0, 0, 0)',
                pointHoverRadius: 7,
                pointHoverBackgroundColor: 'rgba(222, 235, 247, 1)', // #ff529a with alpha 1
                pointHoverBorderColor: 'rgba(0, 0, 0, 0)',
                fill: false,
                tension: 0.1
              }
            ]
          },
          options: {
            scales: {
              xAxes: [{
                type: 'linear',
                position: 'bottom'
              }]
            }
          }
        });

        // Waist Circumference
        var ctx2 = document.getElementById('lineChart2').getContext('2d');
        var waistArray = [<?php echo $Waist_points;?>];
        var WaistData = [];

        for (var i = 0; i < waistArray.length; i++) {
          var dataPoint = {
            x: i + 1,
            y: waistArray[i]
          };
          WaistData.push(dataPoint);
        }
        var chart2 = new Chart(ctx2, {
          type: 'line',
          data: {
            datasets: [
              {
                label: 'Data Points',
                data: WaistData,
                backgroundColor: 'rgba(222, 235, 247, 0.4)', // #ff529a with alpha 0.4
                borderColor: 'rgba(222, 235, 247, 1)', // #ff529a with alpha 1
                pointRadius: 5,
                pointBackgroundColor: 'rgba(222, 235, 247, 1)', // #ff529a with alpha 1
                pointBorderColor: 'rgba(0, 0, 0, 0)',
                pointHoverRadius: 7,
                pointHoverBackgroundColor: 'rgba(222, 235, 247, 1)', // #ff529a with alpha 1
                pointHoverBorderColor: 'rgba(0, 0, 0, 0)',
                fill: false
              }
            ]
          },
          options: {
            scales: {
              xAxes: [{
                type: 'linear',
                position: 'bottom'
              }]
            }
          }
        });

        // Cancer Risk Assessment
        const data1 = {
          labels: ['Cancer Risk Assessment'],
          datasets: [
            {
              label: 'My Dataset',
              data: [75, 25],
              backgroundColor: ['rgba(54, 162, 235, 1)'],
            },
          ],
        };

        const config1 = {
          type: 'doughnut',
          data: data1,
          options: {
            cutout: '70%',
            plugins: {
              legend: {
                display: false,
              },
            },
            elements: {
              center: {
                text: '75%',
                fontColor: '#000',
                fontStyle: 'Arial',
                sidePadding: 20,
              },
            },
          },
        };

        const myChart1 = new Chart(document.getElementById('lineChart3'), config1);

        // Health Literacy Survey
        const data2 = {
          labels: ['Health Literacy Survey'],
          datasets: [
            {
              label: 'My Dataset',
              data: [65, 35],
              backgroundColor: ['rgba(222, 235, 247, 1)'],
            },
          ],
        };

        const config2 = {
          type: 'doughnut',
          data: data2,
          options: {
            cutout: '70%',
            plugins: {
              legend: {
                display: false,
              },
            },
            elements: {
              center: {
                text: '75%',
                fontColor: '#000',
                fontStyle: 'Arial',
                sidePadding: 20,
              },
            },
          },
        };

        const myChart2 = new Chart(document.getElementById('lineChart4'), config2);
  });

        // BMI Assessment2
        var ctx3 = document.getElementById('lineChart5').getContext('2d');
        
        var bmiArray = [<?php echo $BMI_points;?>];
        var BMIData = [];

        for (var i = 0; i < bmiArray.length; i++) {
          var dataPoint = {
            x: i + 1,
            y: bmiArray[i]
          };
          BMIData.push(dataPoint);
        }

        var chart3 = new Chart(ctx3, {
          type: 'line',
          data: {
            datasets: [
              {
                label: 'BMI Assessment',
                data: BMIData,
                backgroundColor: 'rgba(248, 200, 220, 0.4)', // #ff529a with alpha 0.4
                borderColor: 'rgba(248, 200, 220, 1)', // #ff529a with alpha 1
                pointRadius: 5,
                pointBackgroundColor: 'rgba(248, 200, 220, 1)', // #ff529a with alpha 1
                pointBorderColor: 'rgba(0, 0, 0, 0)',
                pointHoverRadius: 7,
                pointHoverBackgroundColor: 'rgba(248, 200, 220, 1)', // #ff529a with alpha 1
                pointHoverBorderColor: 'rgba(0, 0, 0, 0)',
                fill: false,
                tension: 0.1
              }
            ]
          },
          options: {
            scales: {
              xAxes: [{
                type: 'linear',
                position: 'bottom'
              }]
            }
          }
        });

        // Waist Circumference2
        var ctx4 = document.getElementById('lineChart6').getContext('2d');
        
        var waistArray = [<?php echo $Waist_points;?>];
        var WaistData = [];

        for (var i = 0; i < waistArray.length; i++) {
          var dataPoint = {
            x: i + 1,
            y: waistArray[i]
          };
          WaistData.push(dataPoint);
        }

        var chart4 = new Chart(ctx4, {
          type: 'line',
          data: {
            datasets: [
              {
                label: 'Data Points',
                data: WaistData,
                backgroundColor: 'rgba(248, 200, 220, 0.4)', // #ff529a with alpha 0.4
                borderColor: 'rgba(248, 200, 220, 1)', // #ff529a with alpha 1
                pointRadius: 5,
                pointBackgroundColor: 'rgba(248, 200, 220, 1)', // #ff529a with alpha 1
                pointBorderColor: 'rgba(0, 0, 0, 0)',
                pointHoverRadius: 7,
                pointHoverBackgroundColor: 'rgba(248, 200, 220, 1)', // #ff529a with alpha 1
                pointHoverBorderColor: 'rgba(0, 0, 0, 0)',
                fill: false
              }
            ]
          },
          options: {
            scales: {
              xAxes: [{
                type: 'linear',
                position: 'bottom'
              }]
            }
          }
        });

        // Cancer Risk Assessment
        const data3 = {
          labels: ['Cancer Risk Assessment'],
          datasets: [
            {
              label: 'My Dataset',
              data: [75, 25],
              backgroundColor: ['rgba(54, 162, 235, 1)'],
            },
          ],
        };

        const config3 = {
          type: 'doughnut',
          data: data3,
          options: {
            cutout: '70%',
            plugins: {
              legend: {
                display: false,
              },
            },
            elements: {
              center: {
                text: '75%',
                fontColor: '#000',
                fontStyle: 'Arial',
                sidePadding: 20,
              },
            },
          },
        };

        const myChart3 = new Chart(document.getElementById('lineChart7'), config3);

        // Health Literacy Survey
        const data4 = {
          labels: ['Health Literacy Survey'],
          datasets: [
            {
              label: 'My Dataset',
              data: [65, 35],
              backgroundColor: ['rgba(222, 235, 247, 1)'],
            },
          ],
        };

        const config4 = {
          type: 'doughnut',
          data: data4,
          options: {
            cutout: '70%',
            plugins: {
              legend: {
                display: false,
              },
            },
            elements: {
              center: {
                text: '75%',
                fontColor: '#000',
                fontStyle: 'Arial',
                sidePadding: 20,
              },
            },
          },
        };

        const myChart4 = new Chart(document.getElementById('lineChart8'), config4);


</script>

<script type="text/javascript">
    // jQuery(document).ready(function(){
    //     let ctx = document.getElementById("myChart").getContext("2d");
    //     let myChart = new Chart(ctx, {
    //         type: "line",
    //         data: {
    //             labels: ["<?php echo implode('","', $assessment_label); ?>"],
    //             datasets: [
    //                 {
    //                     label: "All Assessment",
    //                     data: [<?php echo implode(',', $CRA_all_points); ?>],
    //                     backgroundColor: "rgba(153,205,1,0.6)",
    //                     fill: false,
    //                     borderColor: 'rgb(75, 192, 192)',
    //                     tension: 0.1
    //                 },
    //             ],
    //         },
    //     });



    //     let ctxBMI = document.getElementById("myChartBMI").getContext("2d");
    //     let myChartBMI = new Chart(ctxBMI, {
    //         type: "line",
    //         data: {
    //             labels: ["<?php echo implode('","', $BMI_label); ?>"],
    //             datasets: [
    //                 {
    //                     label: "BMI Assessment",
    //                     data: [<?php echo implode(',', $BMI_points); ?>],
    //                     backgroundColor: "rgba(153,205,1,0.6)",
    //                     fill: false,
    //                     borderColor: 'rgb(75, 192, 192)',
    //                     tension: 0.1
    //                 },
    //             ],
    //         },
    //     });

    //     let ctxWaist = document.getElementById("myChartWaist").getContext("2d");
    //     let myChartWaist = new Chart(ctxWaist, {
    //         type: "line",
    //         data: {
    //             labels: ["<?php echo implode('","', $Waist_label); ?>"],
    //             datasets: [
    //                 {
    //                     label: "Waist Assessment",
    //                     data: [<?php echo implode(',', $Waist_points); ?>],
    //                     backgroundColor: "rgba(153,205,1,0.6)",
    //                     fill: false,
    //                     borderColor: 'rgb(75, 192, 192)',
    //                     tension: 0.1
    //                 },
    //             ],
    //         },
    //     });

        
    // });
</script>


<script>
   /* // Get the canvas element
    var ctx = document.getElementById('myChart').getContext('2d');

    // Define the data for the chart
    var data = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June'],
        datasets: [{
            label: 'Sample Line Chart',
            data: [10, 20, 30, 25, 40, 35],
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }]
    };

    // Configure the chart options
    var options = {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    };

    // Create the line chart
    var myChart = new Chart(ctx, {
        type: 'line',
        data: data,
        options: options
    });*/
</script>