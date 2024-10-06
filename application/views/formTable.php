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
    
    <table id="formList" class="table table-striped" style="width:100%">
        <h3><?php echo $table_heading; ?></h3>
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
            
        </tbody>
        
    </table>

    <!-- generate table
    <div class="modal fade" id="formTableModal" tabindex="-1" aria-labelledby="formTableModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formTableModalLabel">Generate Form Table</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formTableForm">
                        <div class="mb-3">
                            <label for="form_list" class="form-label">Select Form Fields</label>
                            
                            <div id="form_list">
                                
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submitFormTable()">Save changes</button>
                </div>
            </div>
        </div>
    </div> -->

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

    function generateFormTable(formId) {
        // Replace the content inside the modal with a loading message
        // $('#formTableModal .modal-body').html('<p>Loading...</p>');
        
        // Make an AJAX request to fetch the form data
        $.ajax({
            url: "<?php echo base_url('FormTableCon/get_form_fields'); ?>", // Replace with your actual server endpoint
            type: 'POST',
            data: { 
                form_id: formId 
            },
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    $('#form_list').empty();
                    $('#formTableModal').modal('show');
                    
                    $.each(data.options, function(index, option) {
                        $('#form_list').append(` 
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
        // Get form data
        // var form_fields = $('#form_list').val();

        var form_fields = [];
        $('#form_list input[type="checkbox"]:checked').each(function() {
            form_fields.push($(this).val());
        });
        // AJAX POST request
        $.ajax({
            url: "<?php echo base_url('FormTableCon/save_form_table'); ?>",  // Update with your actual endpoint
            type: "POST",
            data: {
                form_fields: form_fields,
            },
            success: function(response) {
                // Parse JSON response from the server
                var result = JSON.parse(response);
                
                if (result.status === 'success') {
                    alert(result.message);
                    // Optionally, refresh data on the page or update UI
                } else {
                    alert('Error: ' + result.message);
                }
                
                // Close the modal
                var modal = bootstrap.Modal.getInstance(document.getElementById('formTableModal'));
                modal.hide();
            },
            error: function() {
                alert('An error occurred while saving the data.');
            }
        });
    }

    
</script>