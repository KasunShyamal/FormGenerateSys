<!DOCTYPE html>
<html>

<head>
	<title>Form Structure</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css" rel="stylesheet">
	<style>
		.card {
			box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
			border: none;
			border-radius: 0.5rem;
		}

		.card-header {
			background-color: #f8f9fa;
			border-bottom: 1px solid #dee2e6;
			padding: 1rem;
		}

		.card-title {
			margin-bottom: 0;
			text-align: center;
			font-size: 1.5rem;
			font-weight: 500;
		}

		.card-body {
			padding: 2rem;
		}

		.form-group label {
			font-weight: 500;
		}

		.required:after {
			content: " *";
			color: red;
		}

		.btn-primary {
			width: 100%;
			margin-top: 1rem;
			padding: 0.5rem;
		}

		.form-control:focus {
			border-color: #80bdff;
			box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
		}

		@media (min-width: 768px) {
			.container {
				max-width: 500px;
			}
		}
	</style>
</head>

<body>
	<div class="container mt-5 mb-5">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Form Structure</h5>
			</div>
			<div class="card-body">
				<form id="formStructureForm">
					<div class="form-group">
						<label for="formName" class="required">Form Name</label>
						<select class="form-control" id="formName" name="form_name" required>
							<option value="" disabled selected>Select Form Name</option>
							<?php foreach ($form_names as $form_name): ?>
								<option value="<?php echo $form_name->id; ?>"><?php echo $form_name->form_name; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="segment" class="required">Segment</label>
						<select class="form-control" id="segment" name="segment" required>
							<option value="" disabled selected>Select Segment</option>
							<?php foreach ($segments as $segment): ?>
								<option value="<?php echo $segment->id; ?>"><?php echo $segment->seg_name; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="fieldName" class="required">Field Name</label>
						<input type="text" class="form-control" id="fieldName" name="field_name"
							placeholder="Enter Field Name" required>
					</div>
					<div class="form-group">
						<label for="columnType" class="required">Column Type</label>
						<select class="form-control" id="columnType" name="column_type" required>
							<option value="" disabled selected>Select Column Type</option>
							<?php foreach ($column_types as $column_type): ?>
								<option value="<?php echo $column_type->id; ?>"><?php echo $column_type->data_type; ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="length" class="required">Length</label>
						<input type="number" class="form-control" id="length" name="length" placeholder="Enter Length"
							required>
					</div>
					<div class="form-group">
						<label for="dataType" class="required">Data Type</label>
						<select class="form-control" id="dataType" name="data_type" required>
							<option value="" disabled selected>Select Data Type</option>
							<?php foreach ($data_types as $data_type): ?>
								<option value="<?php echo $data_type->id; ?>"><?php echo $data_type->type; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="fieldType" class="required">Field Type</label>
						<select class="form-control" id="fieldType" name="field_type" required>
							<option value="" disabled selected>Select Field Type</option>
							<?php foreach ($field_types as $field_type): ?>
								<option value="<?php echo $field_type->id; ?>"><?php echo $field_type->field_type; ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
					<button type="submit" class="btn btn-primary" onclick="submitFormStructureForm()">
						<i class="fas fa-save mr-2"></i>Save Form Structure
					</button>
				</form>
			</div>
		</div>
	</div>
</body>

</html>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
	function submitFormStructureForm() {
		var formName = document.getElementById('formName').value;
		var segment = document.getElementById('segment').value;
		var fieldName = document.getElementById('fieldName').value;
		var columnType = document.getElementById('columnType').value;
		var length = document.getElementById('length').value;
		var dataType = document.getElementById('dataType').value;
		var fieldType = document.getElementById('fieldType').value;
		$.ajax({
			url: '<?= base_url('FormStructureController/add_form_structure') ?>',
			type: 'POST',
			data: {
				form_name: formName,
				segment: segment,
				field_name: fieldName,
				column_type: columnType,
				length: length,
				data_type: dataType,
				field_type: fieldType,
			},
			success: function (response) {
				alert('Form structure added successfully!');
				$('#myModal3').modal('hide');
				$('#formStructureForm')[0].reset();
			},
			error: function (error) {
				console.error(error);
				alert('An error occurred!');
			}
		});
	}
</script>
