<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Optional: Bootstrap for modal styling -->
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        color: #333;
    }

    .header {
        background: rgba(255, 255, 255, 0.95);
        padding: 1rem 0;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    }

    .nav-container {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 2rem;
    }

    .logo {
        font-size: 1.8rem;
        font-weight: 700;
        color: #2c3e50;
    }

    .main-content {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    h1 {
        font-size: 2.5rem;
        text-align: center;
        color: #2c3e50;
        margin-top: 150px;
        margin-bottom: 20px;
    }

    .buttons {
        display: flex;
        flex-direction: row;

    }
</style>

<body>


    <header class="header">
        <nav class="nav-container">
            <div class="logo">Dynamic Forms.</div>
        </nav>
    </header>

    <div class="main-content">
        <h1>Only for Backend</h1>

        <div class="buttons">

            <button type="button" class="btn btn-primary" id="openModalBtn1" style="width: 150px; height: 80px; margin: 0 20px">Segment</button>
            <button type="button" class="btn btn-primary" id="openModalBtn2" style="width: 150px; height: 80px; margin: 0 20px">Form Name</button>
            <button type="button" class="btn btn-primary" id="openModalBtn3" style="width: 150px; height: 80px; margin: 0 20px">Data Type</button>
            <button type="button" class="btn btn-primary" id="openModalBtn4" style="width: 150px; height: 80px; margin: 0 20px">Field Type</button>
            <button type="button" class="btn btn-primary" id="openModalBtn5" style="width: 150px; height: 80px; margin: 0 20px">DataBase Data Type</button>



            <!-- Include the pop-ups from separate views -->
            <?php $this->load->view('segmant'); ?> <!-- Load first pop-up -->
            <?php $this->load->view('formNameView'); ?> <!-- Load second pop-up -->
            <?php $this->load->view('datatype'); ?> <!-- Load third pop-up -->
            <?php $this->load->view('fieldtype'); ?> <!-- Load third pop-up -->
            <?php $this->load->view('dbdatatype'); ?> <!-- Load third pop-up -->


        </div>
        <!-- Button 1 to trigger modal 1 -->

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Show the modals when the respective buttons are clicked
        $('#openModalBtn1').on('click', function() {
            $('#myModal1').modal('show');
        });

        $('#openModalBtn2').on('click', function() {
            $('#myModal2').modal('show');
        });

        $('#openModalBtn3').on('click', function() {
            $('#myModal3').modal('show');
        });

        $('#openModalBtn4').on('click', function() {
            $('#myModal4').modal('show');
        });

        $('#openModalBtn5').on('click', function() {
            $('#myModal5').modal('show');
        });
    </script>

</body>

</html>
