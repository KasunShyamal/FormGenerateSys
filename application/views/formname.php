<div class="modal" id="myModal2" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Form Name</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
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
					<button type="button" class="btn btn-primary" onclick="submitFormNameForm()">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	function submitFormNameForm() {
		var formName = document.getElementById('formName').value;
		var heading = document.getElementById('heading').value;
		var type = document.getElementById('type').value;
		$.ajax({
			url: '<?= base_url('FormNameController/add_form_name') ?>',
			type: 'POST',
			data: { form_name: formName, heading: heading, type: type },
			success: function (response) {
				alert('Form name added successfully!');
				$('#myModal2').modal('hide');
				$('#formNameForm')[0].reset();
			},
			error: function (error) {
				console.error(error);
				alert('An error occurred!');
			}
		});
	}
</script>
