<link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">

<div class="container mx-auto px-4 py-8">
  <button type="button" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded shadow-md transition duration-300 ease-in-out mb-6" id="addNew">
    Add New
  </button>
  <h1 class="text-3xl font-semibold text-center text-white mb-8">Form Name</h1>
  <div class="mx-auto bg-darker-purple rounded-lg shadow-lg p-6 overflow-x-auto">
<table class="table-auto w-full bg-white shadow-md rounded-lg overflow-hidden">
      <thead class="bg-blue-500 text-white">
        <tr>
          <th class="py-2 px-4 text-left">ID</th>
          <th class="py-2 px-4 text-left">Form Name</th>
          <th class="py-2 px-4 text-left">Heading</th>
          <th class="py-2 px-4 text-left">Type</th>
          <th class="py-2 px-4 text-left">Action</th>
        </tr>
      </thead>
      <tbody class="text-gray-50 text-sm bg-gray-700">
        <?php if (!empty($records)): ?>
          <?php $count = 1; ?>
          <?php foreach ($records as $record) { ?>
            <tr class="border-b border-gray-500 hover:bg-gray-600">
              <td class="py-2 px-4 text-left"><?php echo $count++; ?></td>
              <td class="py-2 px-4 text-left"><?php echo $record->form_name ?></td>
              <td class="py-2 px-4 text-left"><?php echo $record->heading ?></td>
              <td class="py-2 px-4 text-left"><?php echo $record->type ?></td>
              <td class="py-2 px-4 text-left">
                <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-2 rounded transition duration-300 ease-in-out" onclick="openEditModal('<?= $record->id ?>', '<?= $record->form_name ?>', '<?= $record->heading ?>', '<?= $record->type ?>')">
                  Edit
                </button>
              </td>
            </tr>
          <?php } ?>
        <?php else: ?>
          <tr>
            <td colspan="5" class="py-2 px-4 text-center">No records found</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Form Name Modal -->
<div class="fixed z-10 inset-0 overflow-y-auto" id="formNameModal" style="display: none;">
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
              Form Name
            </h3>
            <div class="mt-2">
              <form id="formNameForm">
                <div class="mb-4">
                  <label for="formName" class="block text-gray-700 font-semibold mb-2">
                    Form Name <span class="text-red-500">*</span>
                  </label>
                  <input type="text" id="formName" name="formName" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter Form Name" required>
                  <span class="text-red-500 text-sm" id="errorFormName"></span>
                </div>
                <div class="mb-4">
                  <label for="heading" class="block text-gray-700 font-semibold mb-2">
                    Heading <span class="text-red-500">*</span>
                  </label>
                  <input type="text" id="heading" name="heading" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter Heading" required>
                  <span class="text-red-500 text-sm" id="errorHeading"></span>
                </div>
                <div class="mb-4">
                  <label for="type" class="block text-gray-700 font-semibold mb-2">
                    Type <span class="text-red-500">*</span>
                  </label>
                  <select id="type" name="type" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Select Type</option>
                    <option value="Type 1">Type 1</option>
                    <option value="Type 2">Type 2</option>
                    <option value="Type 3">Type 3</option>
                    <option value="Type 4">Type 4</option>
                  </select>
                  <span class="text-red-500 text-sm" id="errorType"></span>
                </div>
                <input type="hidden" id="formId">
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm" onclick="submitFormNameForm()">
          Submit
        </button>
        <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" data-dismiss="modal">
          Cancel
        </button>
      </div>
    </div>
  </div>
</div>

<!-- jQuery and SweetAlert JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  // Add New Modal Display
  $('#addNew').on('click', function () {
    $('#formNameModal').show();
    $('#modalTitle').text('Add New Form');
    $('#formNameForm')[0].reset();
    $('#formId').val('');
    $('#errorFormName').text('');
    $('#errorHeading').text('');
    $('#errorType').text('');
  });

  // Open Edit Modal and pre-fill the form
  function openEditModal(id, formName, heading, type) {
    $('#formName').val(formName);
    $('#heading').val(heading);
    $('#type').val(type);
    $('#formId').val(id);
    $('#modalTitle').text('Edit Form');
    $('#formNameModal').show();
    $('#errorFormName').text('');
    $('#errorHeading').text('');
    $('#errorType').text('');
  }

  function validateForm() {
    var isValid = true;
    var formName = $('#formName').val();
    var heading = $('#heading').val();
    var type = $('#type').val();

    // Validate formName
    if (formName.trim() === '') {
      $('#errorFormName').text('Form name is required.');
      isValid = false;
    } else {
      $('#errorFormName').text('');
    }

    // Validate heading
    if (heading.trim() === '') {
      $('#errorHeading').text('Heading is required.');
      isValid = false;
    } else {
      $('#errorHeading').text('');
    }

    // Validate type
    if (type === '') {
      $('#errorType').text('Type is required.');
      isValid = false;
    } else {
      $('#errorType').text('');
    }

    return isValid;
  }

  // Submit Form Name (Add/Edit)
  function submitFormNameForm() {
    if (!validateForm()) {
      return;
    }

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
        $('#formNameModal').hide();
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

  // Close Modal
  $('[data-dismiss="modal"]').on('click', function () {
    $('#formNameModal').hide();
  });
</script>