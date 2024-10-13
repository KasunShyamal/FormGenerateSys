<style>
	body {
		font-family: Arial, Helvetica, sans-serif;
		background-color: #f4f4f9;
		margin: 0;
		padding: 0;
		box-sizing: border-box;
	}

	#addNew {
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

	#addNew:hover {
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
<button type="button" class="btn btn-primary" id="addNew" >
	Add New
</button>

<table>
	<thead>
		<tr>
			<th>Segment Name</th>
		</tr>
	</thead>
	<tbody>
		<?php if (!empty($segments)): ?>
			<?php foreach ($segments as $segment) { ?>
				<tr>
					<td><?php echo $segment->seg_name ?></td>
				</tr>
			<?php } ?>
		<?php else: ?>
			<tr>
				<td colspan="3">No records found</td>
			</tr>
		<?php endif; ?>
	</tbody>
</table>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Modal structure -->
<div class="modal fade" id="segmentModal" tabindex="-1" role="dialog" aria-labelledby="segmentModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Segment</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="segmentForm">
					<div class="form-group">
						<label for="segmentName">Segment Name</label>
						<input type="text" class="form-control" id="segmentName" placeholder="Enter Segment Name"
							required>
					</div>
					<button type="button" class="btn btn-primary" onclick="submitSegmentForm()">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- jQuery function to show modal -->
<script>
	var modal = document.getElementById("segmentModal");
	var btn = document.getElementById("addNew");
	var span = document.getElementsByClassName("close")[0];
	btn.onclick = function () {
		modal.style.display = "block";
	}
	span.onclick = function () {
		modal.style.display = "none";
	}
	window.onclick = function (event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	}

	// Submit Form
	function submitSegmentForm() {
		var segmentName = document.getElementById('segmentName').value;
		$.ajax({
			url: '<?= base_url('form/segment/add') ?>',
			type: 'POST',
			data: { seg_name: segmentName },
			success: function (response) {
				Swal.fire('Segment added successfully!');
				modal.style.display = "none";
				$('#segmentForm')[0].reset();
				refreshSegmentTable();
			},
			error: function (error) {
				console.error(error);
				Swal.fire('Error occurred while adding!');
			}
		});
	}

	function refreshSegmentTable() {
		$.ajax({
			url: '<?= base_url('form/segment') ?>',
			type: 'GET',
			success: function (data) {
				var tempDiv = document.createElement('div');
				tempDiv.innerHTML = data;
				var newTbody = tempDiv.querySelector('tbody');
				if (newTbody) {
					document.querySelector('table tbody').innerHTML = newTbody.innerHTML;
				}
			},
			error: function (error) {
				Swal.fire('Failed to load data!', error);
			}
		});
	}
</script>
