<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Generator</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: lightgray;
            color: #333;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #4a4a4a;
        }
        .no-forms {
            text-align: center;
            padding: 20px;
            font-style: italic;
            color: #888;
        }
        .table-container {
            margin: 20px auto;
            padding: 15px;
            max-width: 100%;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            background-color: #eef2f7;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #eef2f7;
        }

        thead {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
            text-align: left;
        }

        thead th {
            padding: 12px;
            font-size: 16px;
            text-transform: uppercase;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tbody tr:hover {
            background-color: #d1f5d3;
            cursor: pointer;
        }

        tbody td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            font-size: 15px;
            color: #333;
        }

        /* Add nice borders */
        table, th, td {
            border: 1px solid #ddd;
        }

        /* Responsive table - scroll on small screens */
        @media screen and (max-width: 768px) {
            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
        }

    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Form Generation</h1>

        <!-- Table to display the form structure -->
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Form Name</th>
                    <th>Form Heading</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($form_structure)) : ?>
                    <?php foreach ($form_structure as $structure) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($structure->id); ?></td>
                            <td><?php echo htmlspecialchars($structure->form_name); ?></td>
                            <td><?php echo htmlspecialchars($structure->heading); ?></td>
                            <td>
                            <button type="button" class="btn btn-success" onclick="fetchFormStructure(<?php echo $structure->form_name_id; ?>)">Generate Form</button>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4" class="no-forms">No form structures available.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div id ="test"></div>
    </div>

    <!-- Bootstrap JS and dependencies (optional) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function fetchFormStructure(formId) {
            $.ajax({
                url: '<?= base_url('form/get_structure/') ?>' + formId,
                type: 'GET',
                dataType:'html',
                success: function(data) {
                   // $('#test').html(data);
                   var newWindow = window.open();
                   newWindow.document.write(data);
                   newWindow.document.close(); 
                },
                error: function(xhr, status, error) {
               
                    console.error('AJAX request failed:', error);
                }
            });
        }
    </script>
</body>
</html>
