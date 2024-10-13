<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PHP Home Page with Sidebar</title>
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
		<a href="HomePage?page=home">Home</a>
		<a href="HomePage?page=segment">Segment</a>
		<a href="HomePage?page=form_name">Form Name</a>
	</div>

	<div class="content">
		<?php
		// Check if 'page' is set in the query string
		if (isset($_GET['page'])) {
			$page = $_GET['page'];

			// Load the corresponding page content
			switch ($page) {
				case 'home':
					include 'welcome_message.php';
					break;
				case 'segment':
					include 'segment_view.php';
					break;
				case 'form_name':
					include 'formNameView.php';
					break;
				default:
					echo "<h1>404 - Page not found</h1>";
					break;
			}
		} else {
			// Default content if no page is selected
			include 'welcome_message.php';
		}
		?>
	</div>

</body>

</html>
