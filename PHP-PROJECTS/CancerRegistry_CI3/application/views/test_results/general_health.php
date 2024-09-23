    <?php include('top-bar.php'); ?>
    <!--
<link rel="stylesheet" href="<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">

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
                            <a href="<?php echo $new_assessment_link; ?>">
                            <Button>New Assessment</Button>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tabel-results table-responsive">

            <table id="example" class="display nowrap table table-borderless" style="width:100%" >
                <thead>
                  <tr>
                    <th scope="col">Type of Assessment</th>
                    <th scope="col">Assessment Number</th>
                    <th scope="col">Assessment Date</th>
                    <!--<th scope="col">Next Assessment Date</th>-->
                    <!-- <th scope="col">MP Reviewed</th> -->
                    <th scope="col">View</th>
                  </tr>
                </thead>
               <tbody>
                <?php
                  if(isset($tests_data['data']) && !empty($tests_data['data']) && (count($tests_data['data'])>0)) {
                    foreach($tests_data['data'] as $test_overview) {
                        echo '<tr>
                                <td>'.$test_overview['type_of_assessment'].'</td>
                                <td>'.$test_overview['assessment_number'].'</td>
                                <td>'.$test_overview['assessment_date'].'</td>
                                <td>'.$test_overview['view'].'</td>'
                            .'</tr>';

                    }
                  }
                ?>
               </tbody>
              </table>
        </div>
    
       
    </div>
    <script>
      function gotoresults(header_id){
        window.location = "<?php echo $assessment_header_detail_link; ?>" + header_id;
      }
    </script>
    <script>
  $(document).ready(function() {
    $('#example').DataTable({
     "order": [],
     rowReorder: {
        selector: 'td:nth-child(2)'
    },
    responsive: true
    });
/*
    $('#example').DataTable({
        ajax: function (d, cb) {
            fetch("<?php echo base_url('test_results_ajax/').$assessment_type;?>")
                .then(response => response.json())
                .then(data => cb(data));
        },
        columns: [
            { data: 'type_of_assessment' },
            { data: 'assessment_number' },
            { data: 'assessment_date' },
            { data: 'view' },
        ],
        "columnDefs": [
          { className: "asses", "targets": [ 0 ] }
        ],
        rowId: 'id',
        responsive: true,
    });

    $(document).on('click', '#example tr', function(e) {
        var header_id = $(this).attr('id');
        window.location = "<?php echo base_url('general_health_result_details/'); ?>" + header_id;
    });*/
  });
</script>
