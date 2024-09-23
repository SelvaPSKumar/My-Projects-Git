<link rel="styleSheet" href="<?php echo base_url('assets/css/allTestResults.css'); ?>" />
<?php include(VIEWPATH.'facility/top_bar.php'); ?>
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
                            <a href="<?php echo base_url('facility/'); ?>">
                            <Button>New Facility</Button>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tabel-results table-responsive">

            <table id="example" class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">Facility Code</th>
                    <th scope="col">Facility Name</th>
                    <th scope="col">Registration Number</th> 
                    <th scope="col">View</th>
                  </tr>
                </thead>
               <tbody>
                  <?php if (!empty($facility_details)) { 
                      foreach ($facility_details as $key => $result) {
                       $result = (object) $result; $header_id = $result->id;  
                  ?>
                          <tr onclick="gotoresults('<?php echo $header_id ?>');"> 
                              <td><?php echo $result->facility_code; ?></td>
                              <td><?php echo $result->facility_name; ?></td>
                              <td><?php echo $result->registration_number; ?></td> 
                              <td><ion-icon name="chevron-forward-outline"></ion-icon></td>
                          </tr>
                  <?php } } ?>
                   
               </tbody>
              </table>
        </div>
    
       
    </div>
    <script>
      function gotoresults(header_id){
        window.location = "<?php echo base_url('facility/view/'); ?>" + header_id;
      }
    </script>
    <script>
  $(document).ready(function() {
    $('#example').DataTable({
     "order": [3, 'desc'],
     rowReorder: {
              selector: 'td:nth-child(2)'
     },
     responsive: true
    });
  });
</script>
