<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMS - Dynamic Form</title>
    <link rel="stylesheet" href="https://parsleyjs.org/src/parsley.css"> <!-- Parsley CSS -->
    <style>
        /* For radio button container */
        .radio-group {
            display: flex;
            flex-wrap: wrap;
            gap: 20px; /* Adjust the space between radio buttons */
        }

        .radio-group label {
            display: inline-flex;
            align-items: center;
            cursor: pointer;
        }

        .radio-group input[type="radio"] {
            margin-right: 8px; /* Space between radio and label */
        }
        body {
            font-family: 'Arial', sans-serif;
            background-color: lightgray; /* Light blue-grey background */
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
            border-left: 8px solid #6c63ff; /* Accent color on the left */
        }

        h2 {
            text-align: center;
            color: #333;
            font-size: 2rem;
            margin-bottom: 25px;
            font-weight: bold;
            color: #6c63ff; /* Accent color */
            letter-spacing: 1px;
        }

        h3 {
            color: #444;
            font-size: 1.4rem;
            margin-top: 30px;
            margin-bottom: 15px;
            border-bottom: 2px solid #dfe4ea;
            padding-bottom: 8px;
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

        input,
        select,
        textarea {
            width: 100%;
            padding: 12px;
            font-size: 1rem;
            border: 2px solid #dfe4ea; /* Soft grey border */
            border-radius: 6px;
            background-color: #f9f9f9; /* Light background for inputs */
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: border 0.3s ease, background-color 0.3s ease;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #6c63ff; /* Accent color for focus */
            background-color: #fff; /* White background on focus */
            outline: none;
        }

        select {
            appearance: none;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 140 140"><polyline points="20,60 70,110 120,60" stroke="%236c63ff" stroke-width="10" fill="none" stroke-linecap="round"/></svg>') no-repeat right 12px center;
            background-size: 10px;
            padding-right: 35px;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .no-fields {
            text-align: center;
            color: #888;
            font-size: 1.2rem;
        }

        /* Optional: If you want to add buttons */
        .btn {
            display: inline-block;
            padding: 12px 24px;
            font-size: 1rem;
            color: #fff;
            background-color: #6c63ff; /* Accent button color */
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #5848e5; /* Darker on hover */
        }

    </style>
</head>
<body>
    <div class="container">
        <?php if (!empty($structured_fields)): ?>
            <form id="dynamicForm" data-parsley-validate> <!-- Form tag for validation -->
                <h2><?php echo htmlspecialchars($structured_fields['heading']); ?></h2>

                <?php foreach ($structured_fields['fields'] as $segment_name => $fields): ?>
                    <h3 style="color: green; border-bottom: 2px solid green; padding-bottom: 5px;">
                        <?php echo htmlspecialchars($segment_name); ?>
                    </h3>
                    
                    <div class="field-container">
                        <?php foreach ($fields as $field):
                            // Load and parse the dynamic field
                            $doc = new DOMDocument();
                            @$doc->loadHTML($field);
                            
                            // Handle select elements
                            $selectElement = $doc->getElementsByTagName('select')->item(0);
                            if ($selectElement && $selectElement->hasAttribute('id')) {
                                echo htmlspecialchars($selectElement->getAttribute('id')) . " ";
                                $selectElement->setAttribute('required', 'required'); // Make select required
                                echo $doc->saveHTML($selectElement) . "<br>";
                            }

                            // Handle input elements
                            $inputElement = $doc->getElementsByTagName('input')->item(0);
                            if ($inputElement && $inputElement->hasAttribute('id')) {
                                $inputType = $inputElement->getAttribute('type');
                                
                                // Dynamically add required and validation attributes
                                if ($inputType === 'text') {
                                    echo htmlspecialchars($inputElement->getAttribute('id')) . " ";
                                    $inputElement->setAttribute('required', 'required');
                                    $inputElement->setAttribute('data-parsley-pattern', '^[a-zA-Z ]+$'); // Example: Only letters
                                    $inputElement->setAttribute('data-parsley-trigger', 'change');
                                } elseif ($inputType === 'email') {
                                    $inputElement->setAttribute('required', 'required');
                                    $inputElement->setAttribute('data-parsley-type', 'email'); // Validate email format
                                } elseif ($inputType === 'number') {
                                    echo htmlspecialchars($inputElement->getAttribute('id')) . " ";
                                    $inputElement->setAttribute('required', 'required');
                                    $inputElement->setAttribute('data-parsley-type', 'number'); // Validate numbers only
                                    $inputElement->setAttribute('min', '1'); // Min value for example
                                } elseif ($inputElement->getAttribute('id') === 'mobile') {
                                    echo htmlspecialchars($inputElement->getAttribute('id')) . " ";
                                    $inputElement->setAttribute('required', 'required');
                                    $inputElement->setAttribute('data-parsley-pattern', '^\\d{10}$'); // Mobile: 10 digits
                                    $inputElement->setAttribute('data-parsley-trigger', 'change');
                                    $inputElement->setAttribute('data-parsley-error-message', 'Enter a valid 10-digit mobile number');
                                }
                                echo $doc->saveHTML($inputElement) . "<br>";
                            }

                            // Handle textarea elements
                            $textareaElement = $doc->getElementsByTagName('textarea')->item(0);
                            if ($textareaElement && $textareaElement->hasAttribute('id')) {
                                echo htmlspecialchars($textareaElement->getAttribute('id')) . " ";
                                $textareaElement->setAttribute('required', 'required'); // Make textarea required
                                $textareaElement->setAttribute('data-parsley-trigger', 'change');
                                echo $doc->saveHTML($textareaElement) . "<br>";
                            }
                        endforeach; ?>
                    </div>
                <?php endforeach; ?>
                <button type="submit" class="btn">Submit</button>
            </form>
        <?php else: ?>
            <p class="no-fields">No fields to display.</p>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://parsleyjs.org/dist/parsley.min.js"></script> <!-- Parsley JS -->
    <script>
        $(document).ready(function() {
            // Initialize Parsley for form validation
            $('#dynamicForm').parsley();

            // Custom validation messages can be added if needed
            window.Parsley.addMessages('en', {
                defaultMessage: "This value seems to be invalid.",
                required: "This field is required."
            });
        });
    </script>
</body>
</html>
