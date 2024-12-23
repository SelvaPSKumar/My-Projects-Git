<link rel="styleSheet" href="<?php echo base_url('assets/css/allTestResults.css'); ?>" />
<?php include(VIEWPATH.'doctor/top_bar.php'); ?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">

    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
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
        <div class="tabel-results table-responsive mt-5">

            <table id="example" class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">Patient Name</th>
                    <th scope="col">Patient NRIC/Passport</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Assessment Count</th>
                    <th scope="col">View Assessments</th>
                  </tr>
                </thead>
               <tbody>
                  <?php if (!empty($all_patients)) { 
                      foreach ($all_patients as $key => $result) { $result = (object) $result; $header_id = $result->id; ?>
                          <tr onclick="gotoresults('<?php echo $header_id ?>');">
                              <td><?php echo $result->fname; ?></td>
                              <td><?php echo $result->id_number; ?></td>
                              <td><?php echo $result->email; ?></td>
                              <td><?php echo $result->contact_number; ?></td>
                              <td><?php echo $result->gender; ?></td>
                              <td><?php echo $result->assessment_counter; ?></td>
                              <td>
                                  <ion-icon name="chevron-forward-outline"></ion-icon>
                              </td>
                            </tr>
                  <?php } } ?>
                   
               </tbody>
              </table>
        </div>
    
       
    </div>
    <script>
      function gotoresults(header_id){
        window.location = "<?php echo base_url('all_assessments/patient/'); ?>" + header_id;
      }
    </script>
    <script>
  $(document).ready(function() {
    $('#example').DataTable({
     "order": []
    });
  });
</script>
