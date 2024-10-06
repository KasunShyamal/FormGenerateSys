<div class="modal" id="myModal5" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">DataBase Data Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
        <form id="dataTypeForm"> <!-- Added id to the form -->
          <div class="form-group">
            <label for="dataTypeSelect">Select Data Type:</label>
            <select class="form-control" id="dataTypeSelect">
              <option value="int">INT</option>
              <option value="varchar">VARCHAR</option>
              <option value="char">CHAR</option>
              <option value="text">TEXT</option>
              <option value="date">DATE</option>
              <option value="time">TIME</option>
              <option value="datetime">DATETIME</option>
              <option value="timestamp">TIMESTAMP</option>
              <option value="year">YEAR</option>
              <option value="float">FLOAT</option>
              <option value="double">DOUBLE</option>
              <option value="decimal">DECIMAL</option>
              <option value="bit">BIT</option>
              <option value="binary">BINARY</option>
              <option value="varbinary">VARBINARY</option>
              <option value="tinyint">TINYINT</option>
              <option value="smallint">SMALLINT</option>
              <option value="mediumint">MEDIUMINT</option>
              <option value="bigint">BIGINT</option>
            </select>
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
    const dataTypeSelect = document.getElementById('dataTypeSelect').value;
    alert(`Data Type: ${dataTypeSelect}`); // Show alert with selected data type
  });
</script>


