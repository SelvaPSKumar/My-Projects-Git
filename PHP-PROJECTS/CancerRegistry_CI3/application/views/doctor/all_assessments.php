<link rel="styleSheet" href="<?php echo base_url('assets/css/allTestResults.css'); ?>" />
<?php include(VIEWPATH.'doctor/top_bar.php'); ?>
 <!--
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
-->


<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.3.3/css/rowReorder.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.3.3/js/dataTables.rowReorder.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>


<style>
  .page-item.active .page-link{
    background-color: #FFC220 !important
  }
  table.dataTable{
    border-collapse: separate !important;
  }
  #example th{
    font-weight: 600;
  }  
  #example tr:hover{
    background-color: #fafafa;
  }
  div.dataTables_wrapper div.dataTables_length select{
    width: -webkit-fill-available;
  }
  .page-item.active .page-link{
    background-color: #FFC220 !important
  }
  table.dataTable{
    border-collapse: separate !important;
  }
  #example th{
    font-weight: 600;
  }  
  #example tr:hover{
    background-color: #fafafa;
  }
  div.dataTables_wrapper div.dataTables_length select{
    width: -webkit-fill-available;
  }
  .sys_view,.mob_view{
    color: black;
    text-decoration: none;
  }
  .sys_view{
      display: block;
    }
    .mob_view{
      display: none;
    }
  @media only screen and (min-width: 300px) and (max-width: 700px) {
    .sys_view{
      display: none;
    }
    .mob_view{
      display: inline-block;
    }
  }
</style>
    <?php $CI = & get_instance() ?>
    <div class="container">
        <div class="sub-header-results" style="margin-bottom: 10px">
            <div class="row">
                <div class="col-md-8">
                    <div class="input-group mb-3 mt-3 w-50">
                        <!-- <input type="text" class="form-control search-bar" placeholder="Search" aria-label="Username" aria-describedby="basic-addon1"> -->
                      </div>
                </div>
                <div class="col-md-4">
                    <div class="mt-3">
                        <div class="d-flex justify-content-end">
                            <!-- <p>Next test on 25/08/2022</p> -->
                            <a href="<?php echo $new_assessment_link; ?>">
                            <Button>New Assessment</Button>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tabel-results table-responsive">

            <table id="example" class="table table-borderless">
                <thead>
                    <?php echo $table_head ? $table_head : ''; ?>
                  <!---<tr>
                    <th scope="col">Patient Name</th>
                    <th scope="col">Patient NRIC/Passport</th>
                    <th scope="col">Type of Assessment</th>
                    <th scope="col">Assessment Number</th>
                    <th scope="col">Cancer Type</th>
                    <th scope="col">Assessment Date</th>
                    <th scope="col">Next Assessment Date</th>-->
                    <!-- <th scope="col">MP Reviewed</th> -->
                    <!--<th scope="col">View</th>
                  </tr>-->

                </thead>
               <tbody>
                   <?php
                    if(isset($assessment_header_detail['data']) && !empty($assessment_header_detail['data']) && (count($assessment_header_detail['data'])>0)) {
                        if($assessment_type_id == 1) {
                            foreach($assessment_header_detail['data'] as $assessment_header_data) {
                                echo '<tr>';
                                echo $assessment_header_data['type_of_assessment'] ? '<td>'.$assessment_header_data['type_of_assessment'].'</td>' : '';
                                echo $assessment_header_data['assessment_number'] ? '<td>'.$assessment_header_data['assessment_number'].'</td>' : '';
                                echo $assessment_header_data['assessment_date'] ? '<td>'.$assessment_header_data['assessment_date'].'</td>' : '';
                                echo $assessment_header_data['view'] ? '<td>'.$assessment_header_data['view'].'</td>' : '';
                                echo '</tr>';
                            }
                        } elseif($assessment_type_id == 2) {
                            foreach($assessment_header_detail['data'] as $assessment_header_data) {
                                echo '<tr>';
                                echo $assessment_header_data['name'] ? '<td>'.$assessment_header_data['name'].'</td>' : '';
                                echo $assessment_header_data['nric_passport'] ? '<td>'.$assessment_header_data['nric_passport'].'</td>' : '';
                                echo $assessment_header_data['type_of_assessment'] ? '<td>'.$assessment_header_data['type_of_assessment'].'</td>' : '';
                                echo $assessment_header_data['assessment_number'] ? '<td>'.$assessment_header_data['assessment_number'].'</td>' : '';
                                echo $assessment_header_data['cancer_type'] ? '<td>'.$assessment_header_data['cancer_type'].'</td>' : '';
                                echo $assessment_header_data['assessment_date'] ? '<td>'.$assessment_header_data['assessment_date'].'</td>' : '';
                                echo $assessment_header_data['next_assessment_date'] ? '<td>'.$assessment_header_data['next_assessment_date'].'</td>' : '';
                                echo $assessment_header_data['view'] ? '<td>'.$assessment_header_data['view'].'</td>' : '';
                                echo '</tr>';
                            }
                        } elseif($assessment_type_id == 3) {
                            foreach($assessment_header_detail['data'] as $assessment_header_data) {
                                echo '<tr>';
                                echo $assessment_header_data['type_of_assessment'] ? '<td>'.$assessment_header_data['type_of_assessment'].'</td>' : '';
                                echo $assessment_header_data['assessment_number'] ? '<td>'.$assessment_header_data['assessment_number'].'</td>' : '';
                                echo $assessment_header_data['assessment_date'] ? '<td>'.$assessment_header_data['assessment_date'].'</td>' : '';
                                echo $assessment_header_data['view'] ? '<td>'.$assessment_header_data['view'].'</td>' : '';
                                echo '</tr>';
                            }
                        } elseif($assessment_type_id == 7) {
                            foreach($assessment_header_detail['data'] as $assessment_header_data) {
                                echo '<tr>';
                                echo $assessment_header_data['type_of_assessment'] ? '<td>'.$assessment_header_data['type_of_assessment'].'</td>' : '';
                                echo $assessment_header_data['assessment_number'] ? '<td>'.$assessment_header_data['assessment_number'].'</td>' : '';
                                echo $assessment_header_data['assessment_date'] ? '<td>'.$assessment_header_data['assessment_date'].'</td>' : '';
                                echo $assessment_header_data['view'] ? '<td>'.$assessment_header_data['view'].'</td>' : '';
                                echo '</tr>';
                            }
                        } else {
                            foreach($assessment_header_detail['data'] as $assessment_header_data) {
                                echo '<tr>';
                                echo $assessment_header_data['type_of_assessment'] ? '<td>'.$assessment_header_data['type_of_assessment'].'</td>' : '';
                                echo $assessment_header_data['assessment_number'] ? '<td>'.$assessment_header_data['assessment_number'].'</td>' : '';
                                echo $assessment_header_data['assessment_date'] ? '<td>'.$assessment_header_data['assessment_date'].'</td>' : '';
                                echo $assessment_header_data['view'] ? '<td>'.$assessment_header_data['view'].'</td>' : '';
                                echo '</tr>';
                            }
                        }
                    }
                   ?>
               </tbody>
              </table>
        </div>
    
       
    </div>
    <script>
    function gotoresults(header_id){
        window.location = "<?php echo $assessment_header_detail_link; ?>/" + header_id;
    }
  $(document).ready(function() {
    $('#example').DataTable({
     "order": [<?php echo $data_table_order_index?>, 'desc'],
      rowReorder: {
          selector: 'td:nth-child(2)'
      },
      responsive: true
    });
/*
    $('#example').DataTable({
        ajax: function (d, cb) {
            fetch("<?php echo base_url('all_assessments_ajax/general_health');?>")
                .then(response => response.json())
                .then(data => cb(data));
        },
        columns: [
            { data: 'name' },
            { data: 'nric_passport' },
            { data: 'type_of_assessment' },
            { data: 'assessment_number' },
            { data: 'cancer_type' },
            { data: 'assessment_date' },
            { data: 'next_assessment_date' },
            { data: 'view' },
        ],
        "columnDefs": [
          { className: "asses", "targets": [ 2 ] }
        ],
        rowId: 'id',
        responsive: true
    });

    $(document).on('click', '#example tr', function(e) {
        var header_id = $(this).attr('id');
        window.location = "<?php echo base_url('test_result_details_for_doctor/breast_for_doctor/'); ?>" + header_id;
    });*/
  });
</script>
