<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dynamic Form Generation</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
			display: flex;
			height: 100vh;
		}

		/* Left Sidebar */
		.sidebar {
			width: 200px;
			background-color: #333;
			color: white;
			height: 100%;
			padding-top: 20px;
			position: fixed;
		}

		.sidebar a {
			display: block;
			color: white;
			padding: 10px;
			text-decoration: none;
		}

		.sidebar a:hover {
			background-color: #575757;
		}

		/* Right Content */
		.content {
			margin-left: 200px;
			padding: 20px;
			width: calc(100% - 200px);
			height: 100%;
		}
	</style>
</head>

<body>

	<div class="sidebar">
		<a href="<?= base_url('home'); ?>">Home</a>
		<a href="<?= base_url('form/segment'); ?>">Segment</a>
		<a href="<?= base_url('form/name'); ?>">Form Name</a>
		<a href="<?= base_url('form/structure'); ?>">Form Structure</a>
		<a href="<?= base_url('form/generate'); ?>">Form Generate</a>
	</div>

	<div class="content">
		<!-- Load dynamic content here -->
		<?php if (isset($content))
			echo $content; ?>
	</div>

</body>

</html>
