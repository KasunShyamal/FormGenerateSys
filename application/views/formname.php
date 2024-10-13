<style>
	body {
		font-family: Arial, Helvetica, sans-serif;
		background-color: #f4f4f9;
		margin: 0;
		padding: 0;
		box-sizing: border-box;
	}

	#addNew,
	#editNew {
		width: 150px;
		height: 50px;
		background-color: #007bff;
		color: white;
		border: none;
		border-radius: 5px;
		font-size: 16px;
		cursor: pointer;
		transition: background-color 0.3s ease;
		margin: 20px;
	}

	#addNew:hover,
	#editNew:hover {
		background-color: #0056b3;
	}

	table {
		width: 80%;
		margin: 20px auto;
		border-collapse: collapse;
	}

	thead th {
		background-color: #007bff;
		color: white;
		padding: 10px;
		text-align: left;
		font-size: 16px;
	}

	tbody td {
		border: 1px solid #dddddd;
		padding: 10px;
		text-align: left;
		font-size: 14px;
	}

	tbody tr:nth-child(even) {
		background-color: #f2f2f2;
	}

	tbody tr:hover {
		background-color: #e2e6ea;
	}

	.modal {
		display: none;
		position: fixed;
		z-index: 1;
		left: 0;
		top: 0;
		width: 100%;
		height: 100%;
		overflow: auto;
		background-color: rgba(0, 0, 0, 0.5);
	}

	.modal-content {
		background-color: #fefefe;
		margin: auto;
		padding: 20px;
		border: 1px solid #888;
		width: 40%;
		border-radius: 10px;
		box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
	}

	.modal-header {
		display: flex;
		justify-content: space-between;
		align-items: center;
		border-bottom: 1px solid #e9ecef;
		padding-bottom: 10px;
	}

	.modal-title {
		font-size: 20px;
		font-weight: bold;
	}

	.close {
		color: #aaaaaa;
		font-size: 28px;
		font-weight: bold;
		cursor: pointer;
	}

	.close:hover,
	.close:focus {
		color: #000;
	}

	.modal-body {
		padding-top: 10px;
	}

	.form-group label {
		font-size: 14px;
		color: #333;
	}

	.form-control {
		width: 100%;
		padding: 10px;
		margin-top: 5px;
		margin-bottom: 15px;
		border-radius: 5px;
		border: 1px solid #ddd;
		font-size: 14px;
	}

	.form-control:focus {
		border-color: #007bff;
		outline: none;
		box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
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

<!-- Add New Button -->
<button type="button" class="btn btn-primary" id="addNew">Add New</button>

<!-- Table displaying form data -->
<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Form Name</th>
			<th>Heading</th>
			<th>Type</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php if (!empty($records)): ?>
			<?php $count = 1; ?>
			<?php foreach ($records as $record) { ?>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $record->form_name ?></td>
					<td><?php echo $record->heading ?></td>
					<td><?php echo $record->type ?></td>
					<td>
						<button class="btn btn-primary"
							onclick="openEditModal('<?= $record->id ?>', '<?= $record->form_name ?>', '<?= $record->heading ?>', '<?= $record->type ?>')">Edit</button>
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

<!-- Form Name Modal -->
<div class="modal fade" id="formNameModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTitle">Form Name</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form id="formNameForm">
					<div class="form-group">
						<label for="formName">Form Name</label>
						<input type="text" class="form-control" id="formName" placeholder="Enter Form Name" required>
					</div>
					<div class="form-group">
						<label for="heading">Heading</label>
						<input type="text" class="form-control" id="heading" placeholder="Enter Heading" required>
					</div>
					<div class="form-group">
						<label for="type">Type</label>
						<select class="form-control" id="type" required>
							<option value="">Select Type</option>
							<option value="Type 1">Type 1</option>
							<option value="Type 2">Type 2</option>
							<option value="Type 3">Type 3</option>
							<option value="Type 4">Type 4</option>
						</select>
					</div>
					<input type="hidden" id="formId">
					<button type="button" class="btn btn-primary" onclick="submitFormNameForm()">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- jQuery and Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
	// Add New Modal Display
	$('#addNew').on('click', function () {
		$('#formNameModal').modal('show');
		$('#modalTitle').text('Add New Form');
		$('#formNameForm')[0].reset();
		$('#formId').val('');
	});

	// Open Edit Modal and pre-fill the form
	function openEditModal(id, formName, heading, type) {
		$('#formName').val(formName);
		$('#heading').val(heading);
		$('#type').val(type);
		$('#formId').val(id);
		$('#modalTitle').text('Edit Form');
		$('#formNameModal').modal('show');
	}

	// Submit Form Name (Add/Edit)
	function submitFormNameForm() {
		var formName = $('#formName').val();
		var heading = $('#heading').val();
		var type = $('#type').val();
		var id = $('#formId').val();

		let url = id ? '<?= base_url('form/name/edit/') ?>' + id : '<?= base_url('form/name/add') ?>';
		$.ajax({
			url: url,
			type: 'POST',
			data: { form_name: formName, heading: heading, type: type },
			success: function (response) {
				Swal.fire('Success', id ? 'Form updated successfully!' : 'Form added successfully!', 'success');
				$('#formNameModal').modal('hide');
				$('#formNameForm')[0].reset();
				refreshFormTable();
			},
			error: function (error) {
				console.error(error);
				Swal.fire('Error', 'An error occurred while saving the form name.', 'error');
			}
		});
	}

	// Refresh Table Data
	function refreshFormTable() {
		$.ajax({
			url: '<?= base_url('form/name') ?>',
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
				Swal.fire('Error', 'Failed to get form names.', 'error');
			}
		});
	}
</script>
