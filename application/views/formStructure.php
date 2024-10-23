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
  <div class="mx-auto bg-darker-purple rounded-lg shadow-lg p-6 overflow-hidden">
    <table class="table-auto w-full bg-white shadow-md rounded-lg overflow-hidden">
      <thead class="bg-blue-500 text-white uppercase text-sm">
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

<!-- Form Structure Modal -->
<div class="fixed z-10 inset-0 overflow-y-auto" id="formStructureModal" style="display: none;">
  <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
      <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="sm:flex sm:items-start">
          <div class="mt-0 text-left sm:mt-0 sm:ml-4 sm:text-left w-full">
            <h3 class="text-xl leading-6 mb-4 font-medium text-gray-900" id="modalTitle">
              Form Structure
            </h3>
            <div class="mt-2">
              <form id="formStructureForm" class="flex flex-wrap -mx-3">
                <div class="w-1/2 px-3">
                  <div class="mb-4">
                    <label for="formName" class="block text-gray-700 font-semibold mb-2">
                      Form Name <span class="text-red-500">*</span>
                    </label>
                    <select id="formName" name="form_name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                      <option value="" disabled selected>Select Form Name</option>
                      <?php foreach ($form_names as $form_name): ?>
                        <option value="<?php echo $form_name->id; ?>"><?php echo $form_name->form_name; ?></option>
                      <?php endforeach; ?>
                    </select>
                    <span class="text-red-500 text-sm" id="errorFormName"></span>
                  </div>
                  <div class="mb-4">
                    <label for="segment" class="block text-gray-700 font-semibold mb-2">
                      Segment <span class="text-red-500">*</span>
                    </label>
                    <select id="segment" name="segment" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                      <option value="" disabled selected>Select Segment</option>
                      <?php foreach ($segments as $segment): ?>
                        <option value="<?php echo $segment->id; ?>"><?php echo $segment->seg_name; ?></option>
                      <?php endforeach; ?>
                    </select>
                    <span class="text-red-500 text-sm" id="errorSegment"></span>
                  </div>
                  <div class="mb-4">
                    <label for="fieldName" class="block text-gray-700 font-semibold mb-2">
                      Field Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="fieldName" name="field_name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter Field Name" required>
                    <span class="text-red-500 text-sm" id="errorFieldName"></span>
                  </div>
                  <div class="mb-4">
                    <label for="columnType" class="block text-gray-700 font-semibold mb-2">
                      Column Type <span class="text-red-500">*</span>
                    </label>
                    <select id="columnType" name="column_type" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                      <option value="" disabled selected>Select Column Type</option>
                      <?php foreach ($column_types as $column_type): ?>
                        <option value="<?php echo $column_type->id; ?>"><?php echo $column_type->data_type; ?></option>
                      <?php endforeach; ?>
                    </select>
                    <span class="text-red-500 text-sm" id="errorColumnType"></span>
                  </div>
                </div>
                <div class="w-1/2 px-3">
                  <div class="mb-4">
                    <label for="length" class="block text-gray-700 font-semibold mb-2">
                      Length <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="length" name="length" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter Length" required>
                    <span class="text-red-500 text-sm" id="errorLength"></span>
                  </div>
                  <div class="mb-4">
                    <label for="dataType" class="block text-gray-700 font-semibold mb-2">
                      Data Type <span class="text-red-500">*</span>
                    </label>
                    <select id="dataType" name="data_type" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                      <option value="" disabled selected>Select Data Type</option>
                      <?php foreach ($data_types as $data_type): ?>
                        <option value="<?php echo $data_type->id; ?>"><?php echo $data_type->type; ?></option>
                      <?php endforeach; ?>
                    </select>
                    <span class="text-red-500 text-sm" id="errorDataType"></span>
                  </div>
                  <div class="mb-4">
                    <label for="fieldType" class="block text-gray-700 font-semibold mb-2">
                      Field Type <span class="text-red-500">*</span>
                    </label>
                    <select id="fieldType" name="field_type" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                      <option value="" disabled selected>Select Field Type</option>
                      <?php foreach ($field_types as $field_type): ?>
                        <option value="<?php echo $field_type->id; ?>"><?php echo $field_type->field_type; ?></option>
                      <?php endforeach; ?>
                    </select>
                    <span class="text-red-500 text-sm" id="errorFieldType"></span>
                  </div>
                </div>
                <input type="hidden" id="formId">
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-gray-50 px-4 py-3 ">
        <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm" onclick="submitFormStructureForm(event)">
          Save Form Structure
        </button>
        <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" data-dismiss="modal">
          Cancel
        </button>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
	$('#addNew').on('click', function () {
		$('#formStructureModal').show();
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
		$('#formStructureModal').show();
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
				$('#formStructureModal').hide();
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

	// Add this at the end of your script
$('[data-dismiss="modal"]').on('click', function () {
  $('#formStructureModal').hide();
});
</script>