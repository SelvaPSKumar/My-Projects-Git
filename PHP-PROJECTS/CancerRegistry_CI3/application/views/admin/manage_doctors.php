<?php include('top-bar.php'); ?>
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
      #doctor-datatable th{
        font-weight: 600;
      }  
      #doctor-datatable tr:hover{
        background-color: #fafafa;
      }
      div.dataTables_wrapper div.dataTables_length select{
        width: -webkit-fill-available;
      }
    </style>

    <?php $CI = & get_instance() ?>
    <div class="container">
        
        <div class="tabel-results mt-5">

            <table class="table table-borderless" id="doctor-datatable">
                <thead>
                  <tr>
                    <th data-column-name="inputField" scope="col">Name</th>
                    <th data-column-name="inputField" scope="col">Registration Number</th>
                    <th data-column-name="inputField" scope="col">Facility</th>
                    <?php if($active == 'doctors') { ?>
                      <th scope="col">View</th>
                    <?php } else if($active == 'pending_doctors') { ?>
                      <th scope="col">Approve</th>
                    <?php } ?>
                  </tr>
                </thead>
               <tbody>
                  <?php if (!empty($doctors)) {
                      foreach ($doctors as $key => $doctor) { $header_id = $doctor['id']; ?>
                          <tr onclick="gotoresults('<?php echo $header_id ?>');">
                              <td class="asses">
                                  <span class="" onclick="modalDoctorDetail(event, <?php echo $doctor['id']; ?>)"><?php echo $doctor['fname']; ?></span>
                              </td>
                              <td><?php echo $doctor['registration_number']; ?></td>
                              <td><?php echo $doctor['facility_name']; ?></td>
                              <td>
                                  <?php if ($active == 'doctors') { ?>
                                      <span class="" onclick="goToDoctorDetail(<?php echo $doctor['id']; ?>)"><ion-icon name="chevron-forward-outline"></ion-icon></span>
                                  <?php } else if ($active == 'pending_doctors') { ?>
                                      <input type="checkbox" class="approve-doctor" name="approve_doctor_ids[]" value="<?php echo $doctor['id']; ?>">
                                  <?php } ?>
                              </td>
                          </tr>
                  <?php } } ?>
               </tbody>
              </table>
        </div>
    </div>

    <div class="modal fade" id="doctor-details-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Doctor Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="doctor-details-modal-body">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <script>
        $(document).ready(function() {
          $('#doctor-datatable').DataTable({
          "order": [],
          rowReorder: {
              selector: 'td:nth-child(2)'
          },
          responsive: true
          });
        });

      $(document).ready( function () {
          $('#doctor-table thead tr')
              .clone(true)
              .addClass('filters')
              .appendTo('#doctor-table thead');

          var table = $('#doctor-table').DataTable({
                "processing": true,
                "serverSide": true,
                // "info": false,
                orderCellsTop: true,
                dom: 'Brtip',                    
                lengthMenu: [[50, 100, 500, -1], [50, 100, 500, "All"]],
                "ajax":{
                    "url": "<?php echo base_url('manage_doctors/datatable_info'); ?>",
                    "dataType": "json",
                    "type": "GET",
                    "data": {
                        "list_type": "<?php echo $active; ?>" 
                    }
                },
                "columns": [
                    { "data": "fname", "orderable": true },
                    { "data": "registration_number", "orderable": true },
                    { "data": "facility_name", "orderable": true },
                    { "data": "view_or_approve_link", "orderable": false },
                ],
                language: {
                    processing: "Loading..."
                },
                initComplete: function () {
                    var api = this.api();
                    api
                        .columns()
                        .eq(0)
                        .each(function (colIdx) {
                            // Set the header cell to contain the input element
                            var cell = $('.filters th').eq(
                                $(api.column(colIdx).header()).index()
                            );

                            var title = $(cell).text();
                            if (cell.data('column-name') == 'inputField') {
                                $(cell).html('<input type="text" style="font-weight: normal; width: 100%;" placeholder="' + title + '" />');
                            }

                            // On every keypress in this input
                            $(
                                'input',
                                $('.filters th').eq($(api.column(colIdx).header()).index())
                            )
                                .off('keyup change')
                                .on('keyup change', function (e) {
                                    e.stopPropagation();

                                    // Get the search value
                                    $(this).attr('title', $(this).val());
                                    var regexr = '({search})'; //$(this).parents('th').find('select').val();

                                    var cursorPosition = this.selectionStart;
                                    // Search the column for that value
                                    // jQuery.ajaxSetup({async:false});
                                    api
                                        .column(colIdx)
                                        .search(this.value)
                                        .draw();
                                    // jQuery.ajaxSetup({async:true});

                                    if (inputType == 'dateField') {
                                        $(this)
                                            .focus()[0]
                                            .setSelectionRange(cursorPosition, cursorPosition);
                                    }
                                });
                        });
                }
            });

      } );

      function goToDoctorDetail(header_id){
        window.location = "<?php echo base_url('manage_doctors/'. $active .'/'); ?>" + header_id;
      }

      function bulkApproveDoctor(e) {
        e.preventDefault();
        $.ajax({
          url: "<?php echo base_url('manage_doctors/approve_doctors'); ?>",
          type: "post",
          data: $('.approve-doctor:checked').serialize(),
          success: function(data) {
            data = JSON.parse(data);
            if (data['success']) {
                alert(data['message']);
                location.reload();
            } else {
                alert(data['message']);
            }
          }
        });
      }

      function modalDoctorDetail(e, doctor_id) {
        e.preventDefault();

        $.ajax({
          url: "<?php echo base_url('manage_doctors/doctor_details_modal'); ?>",
          type: "post",
          data: {
            id: doctor_id
          },
          success: function(data) {
            data = JSON.parse(data);
            if (data['success']) {
                $('#doctor-details-modal-body').empty();
                $('#doctor-details-modal-body').html(data['html_content']);
                $('#doctor-details-modal').modal('show');
            } else {
                alert(data['message']);
            }
          }
        });
      }
    </script>
