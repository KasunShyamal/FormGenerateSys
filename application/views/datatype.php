<div class="modal" id="myModal3" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Data Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
        <form id="dataTypeForm"> <!-- Added id to the form -->
          <div class="form-group">
            <label for="dataTypeSelect">Select Data Type:</label>
            <select class="form-control" id="dataTypeSelect">
              <option value="number">Number</option>
              <option value="text">Text</option>
            </select>
          </div>
          <div class="form-group">
            <label for="largeTextBox">Enter HTML Part:</label>
            <textarea class="form-control" id="largeTextBox" rows="5"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById('dataTypeForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission
    const dataType = document.getElementById('dataTypeSelect').value;
    const htmlPart = document.getElementById('largeTextBox').value;
    alert(`Data Type: ${dataType}\nHTML Part: ${htmlPart}`); // Show alert with values
  });
</script>



