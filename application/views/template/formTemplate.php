<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMS - Dynamic Form</title>
    <style>
        .radio-group {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .radio-group label {
            display: inline-flex;
            align-items: center;
            cursor: pointer;
        }

        .radio-group input[type="radio"] {
            margin-right: 8px;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: lightgray;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #eef2f7;
            padding: 30px;
            max-width: 800px;
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-left: 8px solid #6c63ff;
        }

        h2 {
            text-align: center;
            color: #6c63ff;
            font-size: 2rem;
            margin-bottom: 25px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        h3 {
            color: green;
            font-size: 1.4rem;
            margin-top: 30px;
            margin-bottom: 15px;
            border-bottom: 2px solid green;
            padding-bottom: 5px;
        }

        .field-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
        }

        .field-container div {
            flex: 1 1 48%;
        }

        input, select, textarea {
            width: 100%;
            padding: 12px;
            font-size: 1rem;
            border: 2px solid #dfe4ea;
            border-radius: 6px;
            background-color: #f9f9f9;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: border 0.3s ease, background-color 0.3s ease;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #6c63ff;
            background-color: #fff;
            outline: none;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            font-size: 1rem;
            color: #fff;
            background-color: #6c63ff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #5848e5;
        }

        .no-fields {
            text-align: center;
            color: #888;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (!empty($structured_fields)): ?>
            <form id="dynamicForm">
                <h2><?php echo htmlspecialchars($structured_fields['heading']); ?></h2>
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($structured_fields['id']); ?>">
                <input type="hidden" name="formName" value="<?php echo htmlspecialchars($structured_fields['formName']); ?>">

                <?php foreach ($structured_fields['fields'] as $segment_name => $fields): ?>
                    <h3><?php echo htmlspecialchars($segment_name); ?></h3>

                    <div class="field-container">
                        <?php foreach ($fields as $field): ?>
                            <?php
                                $doc = new DOMDocument();
                                @$doc->loadHTML($field);
                                echo $doc->saveHTML();
                            ?>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>

                <button type="submit" class="btn">Submit</button>
            </form>
        <?php else: ?>
            <p class="no-fields">No fields to display.</p>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#dynamicForm').on('submit', function (e) {
                e.preventDefault();

                let isValid = true;
                $('#dynamicForm input[required], #dynamicForm select[required], #dynamicForm textarea[required]').each(function () {
                    if (!$(this).val()) {
                        isValid = false;
                        $(this).css('border-color', 'red');
                    } else {
                        $(this).css('border-color', '');
                    }
                });

                if (isValid) {
                    const formData = $(this).serialize();
                    $.ajax({
                        url: '<?= base_url('form/add') ?>',
                        type: 'POST',
                        data: formData,
                        beforeSend: function () {
                            $('.btn').prop('disabled', true).text('Submitting...');
                        },
                        success: function (response) {
                            $('#dynamicForm')[0].reset();
                            $('.btn').prop('disabled', false).text('Submit');
                            alert('Form submitted successfully!');
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            $('.btn').prop('disabled', false).text('Submit');
                            alert('Error: ' + errorThrown);
                        }
                    });
                } else {
                    alert('Please fill in all required fields.');
                }
            });
        });
    </script>
</body>
</html>
