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

	.form-control:focus {
		border-color: #80bdff;
		box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
	}

	.btn-primary {
		background-color: #007bff;
		border: none;
		padding: 10px 20px;
		font-size: 16px;
		border-radius: 5px;
		cursor: pointer;
		transition: background-color 0.3s ease;
	}

	.btn-primary:hover {
		background-color: #0056b3;
	}

	@media screen and (max-width: 768px) {
		.modal-content {
			width: 90%;
		}

		table {
			width: 95%;
		}
	}
</style>

<button type="button" class="btn btn-primary" id="addNew">Add New</button>

<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Form Name</th>
			<th>Segment</th>
			<th>Field Name</th>
			<th>Column Type</th>
			<th>Length</th>
			<th>Date Type</th>
			<th>Field Type</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php if (!empty($form_structures)): ?>
			<?php $count = 1; ?>
			<?php foreach ($form_structures as $form_structure) { ?>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $form_structure->form_name ?></td>
					<td><?php echo $form_structure->seg_name ?></td>
					<td><?php echo $form_structure->field_name ?></td>
					<td><?php echo $form_structure->data_type ?></td>
					<td><?php echo $form_structure->length ?></td>
					<td><?php echo $form_structure->type ?></td>
					<td><?php echo $form_structure->field_type ?></td>
					<td>
						<button class="btn btn-primary"
							onclick="openEditModal('<?= $form_structure->id ?>', '<?= $form_structure->form_name_id ?>', '<?= $form_structure->seg_id ?>', '<?= $form_structure->field_name ?>', '<?= $form_structure->colomn_type_id ?>', '<?= $form_structure->length ?>', '<?= $form_structure->data_type_id ?>', '<?= $form_structure->field_type_id ?>')">Edit</button>
					</td>
				</tr>
			<?php } ?>
		<?php else: ?>
			<tr>
				<td colspan="4">No records found</td>
			</tr>
		<?php endif; ?>
	</tbody>
</table>

<div class="modal fade container mt-5 mb-5" id="formStructureModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTitle">Add Form Structure</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
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
					<input type="hidden" id="formId">
					<button type="submit" class="btn btn-primary" onclick="submitFormStructureForm()">
						Save Form Structure
					</button>
				</form>
			</div>
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
	$('#addNew').on('click', function () {
		$('#formStructureModal').modal('show');
		$('#modalTitle').text('Add Form Structure');
		$('#formStructureForm')[0].reset();
		$('#formId').val('');
	});

	function openEditModal(id, formName, segment, fieldName, columnType, length, dataType, fieldType) {
		$('#formName').val(formName);
		$('#segment').val(segment);
		$('#fieldName').val(fieldName);
		$('#columnType').val(columnType);
		$('#length').val(length);
		$('#dataType').val(dataType);
		$('#fieldType').val(fieldType);
		$('#formId').val(id);
		$('#modalTitle').text('Edit Form Structure');
		$('#formStructureModal').modal('show');
	}

	function submitFormStructureForm(event) {
		event.preventDefault();
		var id = $('#formId').val();
		var formName = $('#formName').val();
		var segment = $('#segment').val();
		var fieldName = $('#fieldName').val();
		var columnType = $('#columnType').val();
		var length = $('#length').val();
		var dataType = $('#dataType').val();
		var fieldType = $('#fieldType').val();
		let url = id ? '<?= base_url('form/structure/edit/') ?>' + id : '<?= base_url('form/structure/add') ?>';
		$.ajax({
			url: url,
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
				Swal.fire('Success', id ? 'Form structure updated successfully!' : 'Form structure added successfully!', 'success');
				$('#formStructureModal').modal('hide');
				$('#formStructureForm')[0].reset();
				refreshFormTable();
			},
			error: function (error) {
				Swal.fire('Error', 'An error occurred while saving the form structure.', 'error');
			}
		});
	}

	$('#formStructureForm').on('submit', submitFormStructureForm);

	function refreshFormTable() {
		$.ajax({
			url: '<?= base_url('form/structure') ?>',
			type: 'GET',
			success: function (data) {
				var tempDiv = document.createElement('div');
				tempDiv.innerHTML = data;
				var newTbody = tempDiv.querySelector('tbody');
				if (newTbody) {
					document.querySelector('tbody').innerHTML = newTbody.innerHTML;
				}
			},
			error: function (error) {
				Swal.fire('Error', 'Failed to get form structures.', 'error');
			}
		});
	}
</script>
