<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Data Table</title>
	<style>
		table {
			width: 100%;
			border-collapse: collapse;
		}
		table, th, td {
			border: 1px solid black;
		}
		th, td {
			padding: 10px;
			text-align: left;
		}
		th {
			background-color: #f2f2f2;
		}
		.new-entry-btn {
			margin-bottom: 20px;
		}
	</style>
</head>
<body>
<h2>Data Table</h2>

<!-- Add New Entry Button -->

<button type="button" class="btn btn-primary" id="openModalBtn2" style="width: 150px; height: 80px; margin: 0 20px">Add New</button>
<?php $this->load->view('formname'); ?>
<table>
	<thead>
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Email</th>
		<!-- Add more table headers as needed -->
	</tr>
	</thead>
	<tbody>
	<?php if(!empty($records)): ?>
		<?php foreach($records as $record): ?>
			<tr>
				<td><?= $record->form_name ?></td>
				<td><?= $record->heading ?></td>
				<td><?= $record->type ?></td>
				<!-- Add more data columns as needed -->
			</tr>
		<?php endforeach; ?>
	<?php else: ?>
		<tr>
			<td colspan="3">No records found</td>
		</tr>
	<?php endif; ?>
	</tbody>
</table>
<script>
	$('#openModalBtn2').on('click', function() {
		$('#myModal2').modal('show');
	});
</script>
</body>
</html>
