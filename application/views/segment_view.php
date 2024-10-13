<div class="modal" id="myModal1" tabindex="-1" role="dialog">

	<button type="button" class="btn btn-primary" id="addNew" style="width: 150px; height: 80px; margin: 0 20px">Add
		New</button>
	<table>
		<thead>
			<tr>
				<th>Segment Name</th>
				<!-- Add more table headers as needed -->
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($segments)): ?>
				<?php foreach ($segments as $segment) { ?>
					<tr>
						<td><?php echo $segment->seg_name ?></td>
					</tr>
				<?php }
				; ?>
			<?php else: ?>
				<tr>
					<td colspan="3">No records found</td>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script>
		$('#addNew').on('click', function () {
			$('#formNameModal').modal('show');
		});
	</script>
</div>
