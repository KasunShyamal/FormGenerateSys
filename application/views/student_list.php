<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.css">
    <style>
        .text-danger {
            color: red;
        }

        .table-container {
            overflow-x: auto;
            width: 100%;      
        }

        .table-container {
            max-width: 100%;
        }

    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Student List</h2>

        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#studentModal">Add New Student</button>

        <div style="overflow-x: auto;">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>NIC</th>
                    <th>Date Of Birth</th>
                    <th>Gender</th>
                    <th>Civil Status</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Telephone</th>
                    <th>Address</th>
                    <th>Contact Person name</th>
                    <th>Contact Person Mobile</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($students): ?>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?= $student->id?></td>
                            <td><?= $student->first_name?></td>
                            <td><?= $student->middle_name?></td>
                            <td><?= $student->last_name?></td>
                            <td><?= $student->nic?></td>
                            <td><?= $student->dob?></td>
                            <td><?= $student->gender?></td>
                            <td><?= $student->civil_status?></td>
                            <td><?= $student->email ?></td>
                            <td><?= $student->mobile?></td>
                            <td><?= $student->telephone?></td>
                            <td><?= $student->address?></td>
                            <td><?= $student->contact_person_name?></td>
                            <td><?= $student->contact_person_mobile?></td>
                            <td>
                            <button class="btn btn-primary btn-sm edit-student" data-id="<?= $student->id ?>">Edit</button>
                        </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No students found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        </div>
        
    </div>

    <div class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="studentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="studentModalLabel">Student Data Entry Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php include 'student_form.php'; ?>
                    
                    
                </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/parsleyjs"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>


$(document).ready(function() {
    $('#studentForm').parsley();

    // Initialize datepicker
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        endDate: new Date(), // Disable future dates
    }).on('changeDate', function() {
        // Trigger validation when a date is selected
        $(this).parsley().validate();
    });

    // Switch to Contact Info step
    $('#next-to-contact').on('click', function() {
        var isValid = true;

        // Validate only fields in Step 1
        $('#step-1 input, #step-1 select').each(function() {
            if (!$(this).parsley().isValid()) {
                isValid = false;
                $(this).parsley().validate(); // Trigger validation
            }
        });

        // If all fields are valid, proceed to the next step
        if (isValid) {
            $('#step-1').removeClass('show active').addClass('fade');
            $('#step-2').removeClass('fade').addClass('show active');
            $('#prev-to-personal').show(); // Show Back button
            $('#submit').show(); // Show Submit button
            $('#next-to-contact').hide(); // Hide Next button
        }
    });

    // Handle Back button click
    $('#prev-to-personal').on('click', function() {
        $('#step-2').removeClass('show active').addClass('fade');
        $('#step-1').removeClass('fade').addClass('show active');
        $('#prev-to-personal').hide(); // Hide Back button
        $('#submit').hide(); // Hide Submit button
        $('#next-to-contact').show(); // Show Next button
    });

    var oldNICPattern = "^[0-9]{9}[Vv]$"; 
    var newNICPattern = "^[0-9]{12}$";   
    var oldNICHint = "Format: 123456789V"; 
    var newNICHint = "Format: 123456789109";

    function updateNICValidation() {
        if ($('#old_nic').is(':checked')) {
            $('#nicHint').text(oldNICHint);
        } else if ($('#new_nic').is(':checked')) {
            $('#nicHint').text(newNICHint);
        }

        $('#nic').parsley().validate(); // Ensure Parsley is applied
    }

    $('input[name="nic_type"]').on('change', updateNICValidation);
    updateNICValidation();

    window.Parsley.addValidator('notEqual', {
        validateString: function(value, requirement) {
            return value !== $(requirement).val();
        },
        messages: {
            en: 'This value must not be the same as Mobile Number Or Telephpone Number.'
        }
    });
    $('input[name="contact_person_mobile"]').attr('data-parsley-not-equal', 'input[name="mobile"], input[name="telephone"]');

    var isEdit = false;

    // form submition
    $('#studentForm').on('submit', function(e) {
        e.preventDefault(); 

        var url = isEdit ? '<?= base_url('student/update') ?>' : '<?= base_url('student/save') ?>'; // Change URL based on edit or create
        var data = $(this).serialize();

        $.ajax({
            url: url,  
            type: 'POST',
            data: data,
            dataType: 'text',  
            success: function(response) {
                console.log("Success response: ", response); 
                try {
                    var jsonResponse = JSON.parse(response); 
                    if (jsonResponse.status === 'error') {
                        $('#email-error').text(jsonResponse.message).show();
                    } else if (jsonResponse.status === 'success') {
                        alert(jsonResponse.message);
                        location.reload();
                    }
                } catch (e) {
                    console.error("Failed to parse JSON response:", e);
                }
            },
            error: function(xhr, status, error) {
                console.log("Error status: " + status);  
                console.log("Error message: " + error);  
                console.log("Response text: " + xhr.responseText);
                Swal.fire('An error occurred. Please try again.');
            }
        });
    });

    $('input[name="email"]').on('input', function() {
        $('#email-error').hide();
    });

    // fecth single data

    // Assuming this is the code triggered when clicking the "Edit" button
    $('.edit-student').on('click', function() {
        var studentId = $(this).data('id');

        console.log(studentId);
    

        $.ajax({
            url: '<?= base_url('students/get_student/') ?>' + studentId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if(response.error) {
                    alert(response.error);
                } else {

                    const dobDate = new Date(response.dob);
                    const formattedDob = dobDate.toISOString().split('T')[0]; 
                    // Populate the form fields with the returned data
                    $('#studentForm input[name="first_name"]').val(response.first_name);
                    $('#studentForm input[name="middle_name"]').val(response.middle_name);
                    $('#studentForm input[name="last_name"]').val(response.last_name);
                    $('#studentForm input[name="nic"]').val(response.nic);
                    $('#studentForm input[name="dob"]').val(formattedDob);
                    $('#studentForm input[name="nic_type"][value="'+response.nic_type+'"]').prop('checked', true);
                    $('#studentForm select[name="gender"]').val(response.gender).trigger('change');
                    $('#studentForm select[name="civil_status"]').val(response.civil_status).trigger('change');
                    $('#studentForm input[name="email"]').val(response.email);
                    $('#studentForm input[name="mobile"]').val(response.mobile);
                    $('#studentForm input[name="telephone"]').val(response.telephone);
                    $('#studentForm input[name="address"]').val(response.address);
                    $('#studentForm input[name="contact_person_name"]').val(response.contact_person_name);
                    $('#studentForm input[name="contact_person_mobile"]').val(response.contact_person_mobile);

                    $('#studentForm input[name="id"]').val(studentId);
                
                    $('#studentModal').modal('show');
                    isEdit = true;
                }
            },
            error: function() {
                alert('An error occurred while fetching the student data.');
            }
        });
    });

});



    </script>
</body>
</html>
