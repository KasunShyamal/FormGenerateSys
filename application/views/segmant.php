<div class="modal" id="myModal1" tabindex="-1" role="dialog">
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
						<input type="text" class="form-control" id="segmentName" placeholder="Enter Segment Name" required>
					</div>
					<button type="button" class="btn btn-primary" onclick="submitSegmentForm()">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	function submitSegmentForm() {
		var segmentName = document.getElementById('segmentName').value;
		$.ajax({
			url: '<?= base_url('SegmentController/add_segment') ?>',
			type: 'POST',
			data: { seg_name: segmentName },
			success: function (response) {
				alert('Segment added successfully!');
				$('#myModal1').modal('hide');
				$('#segmentForm')[0].reset();
			},
			error: function (error) {
				console.error(error);
				alert('An error occurred!');
			}
		});
	}
</script>
