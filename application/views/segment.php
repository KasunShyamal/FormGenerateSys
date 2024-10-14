<link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">


<!-- Add New Button -->
<button type="button" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded shadow-md transition duration-300 ease-in-out mb-6" id="addNew">
  Add New
</button>

<!-- Segment Table -->
<h1 class="text-3xl font-semibold text-center text-white mb-8">Segment Table</h2>
<div class="overflow-x-auto bg-gray-700 rounded-lg shadow-md">
  <table class="w-full table-auto">
    <thead class="bg-blue-500 text-white">
      <tr>
        <th class="py-2 px-4">ID</th>
        <th class="py-2 px-4">Segment Name</th>
        <th class="py-2 px-4">Action</th>
      </tr>
    </thead>
    <tbody class="text-gray-50 ">
      <?php if (!empty($segments)): ?>
        <?php $count = 1; ?>
        <?php foreach ($segments as $segment) { ?>
          <tr class="border-b border-gray-500 hover:bg-gray-600">
            <td class="py-2 px-4"><?php echo $count++; ?></td>
            <td class="py-2 px-4"><?php echo $segment->seg_name ?></td>
            <td class="py-2 px-4">
              <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-2 rounded transition duration-300 ease-in-out" onclick="openEditModal('<?php echo $segment->id ?>', '<?php echo $segment->seg_name ?>')">Edit</button>
            </td>
          </tr>
        <?php } ?>
      <?php else: ?>
        <tr>
          <td colspan="3" class="py-2 px-4 text-center">No records found</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<!-- Modal for Add/Edit Segment -->
<div class="fixed z-10 inset-0 overflow-y-auto" id="segmentModal" style="display: none;">
  <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
      <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="sm:flex sm:items-start">
          <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modalTitle">
              Add Segment
            </h3>
            <div class="mt-2">
              <form id="segmentForm">
                <div class="mb-4">
                  <label for="segmentName" class="block text-gray-700 font-semibold mb-2">
                    Segment Name <span class="text-red-500">*</span>
                  </label>
                  <input type="text" id="segmentName" name="segmentName" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter Segment Name" required>
                  <span class="text-red-500 text-sm" id="errorSegmentName"></span>
                </div>
                <input type="hidden" id="segmentId">
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm" onclick="submitSegmentForm()">
          Submit
        </button>
        <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="closeModal()">
          Cancel
        </button>
      </div>
    </div>
  </div>
</div>

<!-- jQuery and SweetAlert2 for Alerts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  // Existing JavaScript code remains unchanged
  // ...
</script>

<!-- jQuery, Bootstrap, and SweetAlert2 for Alerts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
	// Open Add Modal
	$('#addNew').on('click', function () {
		$('#segmentModal').show();
		$('#segmentForm')[0].reset();
		$('#segmentId').val('');
		$('#modalTitle').text('Add Segment');
		$('#errorSegmentName').text(''); // Clear error message
	});

	// Close Modal
	function closeModal() {
		$('#segmentModal').hide();
	}

	// Open Edit Modal
	function openEditModal(id, seg_name) {
		$('#segmentName').val(seg_name);
		$('#segmentId').val(id);
		$('#modalTitle').text('Edit Segment');
		$('#segmentModal').show();
		$('#errorSegmentName').text(''); // Clear error message
	}

	// Validate form fields
	function validateForm() {
		var isValid = true;
		var segmentName = $('#segmentName').val();

		if (segmentName.trim() === '') {
			$('#errorSegmentName').text('Segment name is required.');
			isValid = false;
		} else {
			$('#errorSegmentName').text('');
		}

		return isValid;
	}

	// Submit Form (Add/Edit)
	function submitSegmentForm() {
		if (!validateForm()) {
			return;
		}

		var segmentName = $('#segmentName').val();
		var id = $('#segmentId').val();
		var url = id ? '<?php echo base_url("form/segment/edit/"); ?>' + id : '<?php echo base_url("form/segment/add"); ?>';

		$.ajax({
			url: url,
			type: 'POST',
			data: { seg_name: segmentName },
			success: function (response) {
				Swal.fire('Success', id ? 'Segment updated successfully!' : 'Segment added successfully!', 'success');
				$('#segmentModal').hide();
				$('#segmentForm')[0].reset();
				refreshSegmentTable();
			},
			error: function (error) {
				Swal.fire('Error', 'An error occurred while saving the segment.', 'error');
			}
		});
	}

	// Refresh Segment Table after Add/Edit
	function refreshSegmentTable() {
		$.ajax({
			url: '<?php echo base_url("form/segment"); ?>',
			type: 'GET',
			success: function (data) {
				var tempDiv = document.createElement('div');
				tempDiv.innerHTML = data;
				var newTbody = tempDiv.querySelector('tbody');
				if (newTbody) {
					$('table tbody').html(newTbody.innerHTML);
				}
			},
			error: function (error) {
				Swal.fire('Error', 'Failed to get segments.', 'error');
			}
		});
	}
</script>
