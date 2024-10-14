<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">

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

<div class="container mx-auto px-4 py-8">
  <button type="button" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded mb-4" id="addNew">
    Add New
  </button>
  <h1 class="text-3xl font-semibold text-center text-white mb-8">Form Structure</h1>
  <div class="overflow-x-auto">
    <table class="table-auto w-full bg-white shadow-md rounded-lg overflow-hidden">
      <thead class="bg-blue-600 text-white uppercase text-sm">
        <tr>
          <th class="py-3 px-6">ID</th>
          <th class="py-3 px-6">Form Name</th>
          <th class="py-3 px-6">Segment</th>
          <th class="py-3 px-6">Field Name</th>
          <th class="py-3 px-6">Column Type</th>
          <th class="py-3 px-6">Length</th>
          <th class="py-3 px-6">Date Type</th>
          <th class="py-3 px-6">Field Type</th>
          <th class="py-3 px-6">Action</th>
        </tr>
      </thead>
      <tbody class="text-gray-50 text-sm bg-gray-700">
        <?php if (!empty($form_structures)): ?>
          <?php $count = 1; ?>
          <?php foreach ($form_structures as $form_structure) { ?>
            <tr class="border-b border-gray-500 hover:bg-gray-600">
              <td class="py-4 px-6"><?php echo $count++; ?></td>
              <td class="py-4 px-6"><?php echo $form_structure->form_name ?></td>
              <td class="py-4 px-6"><?php echo $form_structure->seg_name ?></td>
              <td class="py-4 px-6"><?php echo $form_structure->field_name ?></td>
              <td class="py-4 px-6"><?php echo $form_structure->data_type ?></td>
              <td class="py-4 px-6"><?php echo $form_structure->length ?></td>
              <td class="py-4 px-6"><?php echo $form_structure->type ?></td>
              <td class="py-4 px-6"><?php echo $form_structure->field_type ?></td>
              <td class="py-4 px-6">
                <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-2 rounded" 
                  onclick="openEditModal('<?= $form_structure->id ?>', '<?= $form_structure->form_name_id ?>', '<?= $form_structure->seg_id ?>', '<?= $form_structure->field_name ?>', '<?= $form_structure->colomn_type_id ?>', '<?= $form_structure->length ?>', '<?= $form_structure->data_type_id ?>', '<?= $form_structure->field_type_id ?>')">
                  Edit
                </button>
              </td>
            </tr>
          <?php } ?>
        <?php else: ?> 
          <tr>
            <td colspan="9" class="py-4 px-6 text-center">No records found</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

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
						<label for="formName" class="required">Form Name<span class="error-message" id="errorFormName"></span></label>
						<select class="form-control" id="formName" name="form_name" required>
							<option value="" disabled selected>Select Form Name</option>
							<?php foreach ($form_names as $form_name): ?>
								<option value="<?php echo $form_name->id; ?>"><?php echo $form_name->form_name; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="segment" class="required">Segment<span class="error-message" id="errorSegment"></span></label>
						<select class="form-control" id="segment" name="segment" required>
							<option value="" disabled selected>Select Segment</option>
							<?php foreach ($segments as $segment): ?>
								<option value="<?php echo $segment->id; ?>"><?php echo $segment->seg_name; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="fieldName" class="required">Field Name<span class="error-message" id="errorFieldName"></span></label>
						<input type="text" class="form-control" id="fieldName" name="field_name"
							placeholder="Enter Field Name" required>
					</div>
					<div class="form-group">
						<label for="columnType" class="required">Column Type<span class="error-message" id="errorColumnType"></span></label>
						<select class="form-control" id="columnType" name="column_type" required>
							<option value="" disabled selected>Select Column Type</option>
							<?php foreach ($column_types as $column_type): ?>
								<option value="<?php echo $column_type->id; ?>"><?php echo $column_type->data_type; ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="length" class="required">Length<span class="error-message" id="errorLength"></span></label>
						<input type="number" class="form-control" id="length" name="length" placeholder="Enter Length"
							required>
					</div>
					<div class="form-group">
						<label for="dataType" class="required">Data Type<span class="error-message" id="errorDataType"></span></label>
						<select class="form-control" id="dataType" name="data_type" required>
							<option value="" disabled selected>Select Data Type</option>
							<?php foreach ($data_types as $data_type): ?>
								<option value="<?php echo $data_type->id; ?>"><?php echo $data_type->type; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="fieldType" class="required">Field Type<span class="error-message" id="errorFieldType"></span></label>
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
		$('#errorFormName').text('');
		$('#errorSegment').text('');
		$('#errorFieldName').text('');
		$('#errorColumnType').text('');
		$('#errorLength').text('');
		$('#errorDataType').text('');
		$('#errorFieldType').text('');
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
		$('#errorFormName').text('');
		$('#errorSegment').text('');
		$('#errorFieldName').text('');
		$('#errorColumnType').text('');
		$('#errorLength').text('');
		$('#errorDataType').text('');
		$('#errorFieldType').text('');
	}


	function validateForm() {
		var isValid = true;

		// Validate Form Name
		var formName = $('#formName').val();
		if (formName.trim() === '') {
			$('#errorFormName').text('Form name is required.');
			isValid = false;
		} else {
			$('#errorFormName').text('');
		}

		// Validate Segment
		var segment = $('#segment').val();
		if (segment.trim() === '') {
			$('#errorSegment').text('Segment is required.');
			isValid = false;
		} else {
			$('#errorSegment').text('');
		}

		// Validate Field Name
		var fieldName = $('#fieldName').val();
		if (fieldName.trim() === '') {
			$('#errorFieldName').text('Field name is required.');
			isValid = false;
		} else {
			$('#errorFieldName').text('');
		}

		// Validate Column Type
		var columnType = $('#columnType').val();
		if (columnType.trim() === '') {
			$('#errorColumnType').text('Column type is required.');
			isValid = false;
		} else {
			$('#errorColumnType').text('');
		}

		// Validate Length
		var length = $('#length').val();
		if (length.trim() === '' || isNaN(length) || parseInt(length) <= 0) {
			$('#errorLength').text('Length must be a positive number.');
			isValid = false;
		} else {
			$('#errorLength').text('');
		}

		// Validate Data Type
		var dataType = $('#dataType').val();
		if (dataType.trim() === '') {
			$('#errorDataType').text('Data type is required.');
			isValid = false;
		} else {
			$('#errorDataType').text('');
		}

		// Validate Field Type
		var fieldType = $('#fieldType').val();
		if (fieldType.trim() === '') {
			$('#errorFieldType').text('Field type is required.');
			isValid = false;
		} else {
			$('#errorFieldType').text('');
		}

		return isValid;
	}


	function submitFormStructureForm(event) {

		if (!validateForm()) {
			return;
		}
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