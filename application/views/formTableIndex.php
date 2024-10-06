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
        <thead>
            <tr>
                <th>#</th>
                <th>Form Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($form_names as $index => $form){
                // var_dump($form);die;
                $form_id = $form->id;
            ?>
                <tr>
                    <td><?php echo ($index + 1); ?></td>
                    <td><?php echo $form->heading; ?></td>
                    <td>
                        <!-- <button class="btn btn-primary btn-sm" href="javascript:void(0);" onclick="editForm(<?php echo $form_id; ?>)" title="Edit" style="margin-left: 10px;"><i class="bi bi-pencil-square"></i> Edit</button> -->
                        <button class="btn btn-secondary btn-sm" href="javascript:void(0);" onclick="viewForm(<?php echo $form_id; ?>)" title="View" style="margin-left: 10px;"><i class="bi bi-eye"></i> View</button>
                        <button class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="deleteForm(<?php echo $form_id; ?>)" title="Delete" style="margin-left: 10px;"><i class="bi bi-trash"></i> Delete</button>
                        <button class="btn btn-success btn-sm" href="javascript:void(0);" onclick="generateFormTable(<?php echo $form_id; ?>)" title="Generate Form Table" style="margin-left: 10px;"><i class="bi bi-table"></i> Generate Table</button>
                        <!-- <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#formTableModal" data-form-id="<?php echo $form_id; ?>" title="Generate Form Table" style="margin-left: 10px;"><i class="bi bi-table"></i> Generate Table</button> -->
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
        
    </table>

    <!-- generate table -->
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
                            <!-- <select id="form_list" name="form_list[]" class="form-select" multiple>
                                
                            </select> -->
                            <div id="form_list">
                                <!-- checkboxes will be loaded here -->
                            </div>
                        </div>
                        <div id="form_id"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submitFormTable()">Save changes</button>
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
                        $('#form_id').append(`<input type="hidden" name="form_name_id" value="${option.form_name_id}">`);
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
        $('#form_list input[type="checkbox"]:checked').each(function() {
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