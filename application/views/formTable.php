<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form List</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Bootstrap Multiselect CSS -->
    <link rel="stylesheet" href="css/bootstrap-multiselect.css">

</head>
<body>
    
<div class="container justify-content-center mt-3">
    <div class="clearfix">
        <h3 class="float-start"><?php echo $table_heading; ?></h3>
        <button class="btn btn-success mt-2 float-end" onclick="generateReport()">GENERATE REPORT</button>
    </div>
    <div class="mt-5">
        <table id="formList" class="table table-striped p-3 border bg-light mt-3" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <?php
                    foreach($table_col as $column){
                        ?>
                        <th><?php echo strtoupper($column['field_name']);  ?></th>
                    <?php
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1;
                foreach($table_data as $tbl){
                    ?>
                    <tr>
                        <td><?php echo $counter; ?></td>
                        <?php
                        foreach($tbl as $name){
                            ?>
                            <td><?php echo $name; ?></td>
                            <?php
                        }
                        ?>
                    </tr>
                    <?php
                    $counter += 1;
                }
                ?>
            </tbody>
            
        </table>

    </div>

</div>

    <div class="modal fade" id="formReportModal" tabindex="-1" aria-labelledby="formReportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formReportModalLabel">Generate Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formReportForm">
                        <div class="mb-3">
                            <label for="report_title" class="form-label">Report Title</label>
                            <input type="text" name="report_title" id="report_title">
                        </div>
                        <div class="mb-3">
                            <label for="report_list" class="form-label">Select Form Fields</label>
                            
                            <div id="report_list">
                                
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submitReport()">Create</button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>

<!-- Bootstrap Multiselect JS -->
<script data-main="dist/js/" src="js/require.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $('#formList').DataTable();
    });

    function generateReport(formId) {
        
        $.ajax({
            url: "<?php echo base_url('FormReportCon/get_report_data'); ?>", 
            type: 'POST',
            data: { 
                form_id: formId 
            },
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    $('#report_list').empty();
                    $('#formReportModal').modal('show');
                    
                    $.each(data.options, function(index, option) {
                        $('#report_list').append(` 
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="option-${option.id}" value="${option.id}">
                            <label class="form-check-label" for="option-${option.id}">${option.field_name}</label>
                        </div>
                        `);
                    });
                    
                } else {
                    console.error('Failed to load options:', data.message);
                    alert("No Form Fields to load")
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching options:', error);
            }
        });
    }

    

    function submitFormTable() {
        
        var form_id = $('#form_id input[name="form_name_id"]').val();
        
        var form_fields = [];
        $('#report_list input[type="checkbox"]:checked').each(function() {
            form_fields.push($(this).val());
        });

        
        $.ajax({
            url: "<?php echo base_url('FormTableCon/save_form_table'); ?>",  
            type: "POST",
            data: {
                form_fields: form_fields,
                form_id: form_id,
            },
            success: function(response) {
                var data = JSON.parse(response);
                if (data.success) {
                    alert('Form saved successfully!');
                    $('#formTableModal').modal('hide');
                    window.location.href = data.redirect; 
                } else {
                    alert('An error occurred while saving the data.');
                }
            },
            error: function() {
                alert('An error occurred while saving the data.');
            }
        });
    }

    
</script>