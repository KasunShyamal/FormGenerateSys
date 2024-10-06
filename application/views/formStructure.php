<div class="modal" id="myModal3" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Form Name</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="formStructureForm">
					<div class="form-group">
						<label for="formName">Form Name</label>
						<select class="form-control" id="formName" required>
							<option value="" disabled selected>Select Form Name</option>
							<?php foreach ($form_names as $form_name) { ?>
								<option value="<?php echo $form_name->id ?>"><?php echo $form_name->form_name ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="segment">Segments</label>
						<select class="form-control" id="segment" required>
							<option value="" disabled selected>Select Segment</option>
							<?php foreach ($segments as $segment) { ?>
								<option value="<?php echo $segment->id ?>"><?php echo $segment->seg_name ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="fieldName">Field Name</label>
						<input type="text" class="form-control" id="fieldName" placeholder="Enter Field Name" required>
					</div>
					<div class="form-group">
						<label for="columnType">Column Type</label>
						<select class="form-control" id="columnType" required>
							<option value="" disabled selected>Select Column Type</option>
							<?php foreach ($column_types as $column_type) { ?>
								<option value="<?php echo $column_type->id ?>"><?php echo $column_type->data_type ?>
								</option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="length">Length</label>
						<input type="text" class="form-control" id="length" placeholder="Enter Length" required>
					</div>
					<div class="form-group">
						<label for="dataType">Data Type</label>
						<select class="form-control" id="dataType" required>
							<option value="" disabled selected>Select Data Type</option>
							<?php foreach ($data_types as $data_type) { ?>
								<option value="<?php echo $data_type->id ?>"><?php echo $data_type->type ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="fieldType">Field Type</label>
						<select class="form-control" id="fieldType" required>
							<option value="" disabled selected>Select Field Type</option>
							<?php foreach ($field_types as $field_type) { ?>
								<option value="<?php echo $field_type->id ?>"><?php echo $field_type->field_type ?></option>
							<?php } ?>
						</select>
					</div>
					<button type="button" class="btn btn-primary" onclick="submitFormStructureForm()">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>
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
