<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dynamic Form Generation</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
	<style>
		.bg-dark-purple {
			background-color: #1e1e2d;
		}

		.bg-darker-purple {
			background-color: #151521;
		}

		.text-light-purple {
			color: #a2a5b9;
		}

		 /* Update the hover background color */
		 .hover-bg-purple {
            transition: background-color 0.2s ease-in-out;
        }

        .hover-bg-purple:hover {
            background-color: #2a2a3c;
        }

        /* Sidebar link styles */
        .sidebar-link {
            text-decoration: none;
            color: #a2a5b9; /* Light purple text color */
            transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out;
        }

        .sidebar-link:hover,
        .sidebar-link:focus {
            text-decoration: none;
            color: #ffffff; /* White text on hover */
            background-color: #2a2a3c; /* Consistent with hover-bg-purple */
        }

	</style>
</head>

<body class="bg-dark-purple text-light-purple font-sans">
	<div class="flex h-screen">
		<!-- Sidebar -->
		<aside id="sidebar" class="bg-darker-purple flex-shrink-0 flex flex-col sidebar-transition sidebar-expanded">
			<div class="p-4 flex items-center justify-between">
				<h1 id="brand" class="text-xl font-bold text-white">Form Builder.</h1>
				<button id="toggleBtn" class="text-light-purple hover:text-white">
					<i class="fas fa-chevron-left"></i>
				</button>
			</div>
			<div id="searchContainer" class="px-4 mb-4">
				<input type="text" placeholder="Search" class="w-full bg-dark-purple text-light-purple px-3 py-2 rounded">
			</div>
			<nav class="mt-4 flex flex-col">

				<a href="<?= base_url('form/segment'); ?>" class="sidebar-link flex items-center py-2 px-4 hover-bg-purple transition duration-200">
					<i class="fas fa-layer-group w-5 text-center"></i> <span class="ml-3 sidebar-text">Segment</span>
				</a>

				<a href="<?= base_url('form/name'); ?>" class="sidebar-link flex items-center py-2 px-4 hover-bg-purple transition duration-200">
					<i class="fas fa-font w-5 text-center"></i> <span class="ml-3 sidebar-text">Form Name</span>
				</a>
				<a href="<?= base_url('form/structure'); ?>" class="sidebar-link flex items-center py-2 px-4 hover-bg-purple transition duration-200">
					<i class="fas fa-sitemap w-5 text-center"></i> <span class="ml-3 sidebar-text">Form Structure</span>
				</a>
				<a href="<?= base_url('form/generate'); ?>" class="sidebar-link flex items-center py-2 px-4 hover-bg-purple transition duration-200">
					<i class="fas fa-magic w-5 text-center"></i> <span class="ml-3 sidebar-text">Form Generate</span>

				</a>
				<a href="<?= base_url('login/logout'); ?>" class="sidebar-link flex items-center py-2 px-4 mt-4 hover-bg-purple transition duration-200 rounded">
					<i class="fas fa-sign-out-alt w-5 text-center"></i> <span class="ml-3 sidebar-text">Logout</span>
				</a>
			</nav>
		</aside>

		<!-- Main Content -->
		<div id="mainContent" class="flex-1 flex flex-col overflow-hidden content-transition">
  <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gradient-to-br from-dark-purple to-darker-purple p-8">
    <?php if (!isset($content)): ?>
      <div class="container mx-auto">
        <div class="bg-darker-purple rounded-lg shadow-lg p-8">
          <h1 class="text-4xl font-bold text-white mb-4">Unlock Your Form Building Experience</h1>
          <p class="text-xl text-light-purple mb-8">Welcome to Dynamic Form Builder V 1.0, your one-stop solution for creating dynamic and interactive forms. Explore the limitless possibilities of form creation with our intuitive interface and cutting-edge technology.</p>
          <div class="flex justify-center">
            <a href="#" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-8 rounded-full transition duration-300 ease-in-out transform hover:scale-105">Get Started</a>
          </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
          <div class="bg-darker-purple rounded-lg shadow-lg p-6">
            <div class="flex items-center mb-4">
              <div class="bg-blue-500 rounded-full p-3 mr-4">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
              </div>
              <h2 class="text-xl font-bold text-white">Intuitive Form Creation</h2>
            </div>
            <p class="text-light-purple">Create forms effortlessly with our user-friendly drag-and-drop interface. No coding required!</p>
          </div>
          <div class="bg-darker-purple rounded-lg shadow-lg p-6">
            <div class="flex items-center mb-4">
              <div class="bg-blue-500 rounded-full p-3 mr-4">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
              </div>
              <h2 class="text-xl font-bold text-white">Advanced Security</h2>
            </div>
            <p class="text-light-purple">Ensure the safety and privacy of your form data with our robust security measures and encryption.</p>
          </div>
          <div class="bg-darker-purple rounded-lg shadow-lg p-6">
            <div class="flex items-center mb-4">
              <div class="bg-blue-500 rounded-full p-3 mr-4">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
              </div>
              <h2 class="text-xl font-bold text-white">Powerful Analytics</h2>
            </div>
            <p class="text-light-purple">Gain valuable insights into your form performance with our comprehensive analytics and reporting tools.</p>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <!-- Main Content Here -->
    <?php if (isset($content)) echo $content; ?>
  </main>
</div>
	</div>

	<script>
		const sidebar = document.getElementById('sidebar');
		const toggleBtn = document.getElementById('toggleBtn');
		const brand = document.getElementById('brand');
		const searchContainer = document.getElementById('searchContainer');
		const mainContent = document.getElementById('mainContent');
		const sidebarTexts = document.querySelectorAll('.sidebar-text');

		function toggleSidebar() {
			
		}

		toggleBtn.addEventListener('click', toggleSidebar);
	</script>
</body>

</html>