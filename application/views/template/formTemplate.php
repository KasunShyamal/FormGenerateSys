<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <?php
        // print_r($structured_fields);
        // die();
        // Check if structured_fields is not empty
        if (!empty($structured_fields)): ?>

            <h2><?php echo htmlspecialchars($structured_fields['heading']); ?></h2> <!-- Display the heading -->

            <?php
            // Loop through each segment (e.g., 'Personal')
            foreach ($structured_fields['fields'] as $segment_name => $fields): ?>
                <h3 style="color: green; border-bottom: 2px solid green; padding-bottom: 5px;">
                    <?php echo htmlspecialchars($segment_name); ?>
                </h3> <!-- Segment name -->

                <div class="field-container">
                    <?php
                    // Loop through each field in the segment
                    foreach ($fields as $field):
                        // Create a new DOMDocument instance
                        $doc = new DOMDocument();

                        // Suppress errors when loading HTML
                        @$doc->loadHTML($field);
                        
                        // Check for select elements
                        $selectElement = $doc->getElementsByTagName('select')->item(0);
                        if ($selectElement && $selectElement->hasAttribute('id')) {
                            echo htmlspecialchars($selectElement->getAttribute('id')) . " ";
                        }

                        // Check for input elements
                        $inputElement = $doc->getElementsByTagName('input')->item(0);
                        if ($inputElement && $inputElement->hasAttribute('id')) {
                            echo htmlspecialchars($inputElement->getAttribute('id')) . " ";
                        }

                        // Check for textarea elements
                        $textareaElement = $doc->getElementsByTagName('textarea')->item(0);
                        if ($textareaElement && $textareaElement->hasAttribute('id')) {
                            echo htmlspecialchars($textareaElement->getAttribute('id')) . " ";
                        }

                        // Print the original field
                        echo $field . "<br>";

                    endforeach; ?>
                </div>

            <?php endforeach; ?>

        <?php else: ?>
            <p class="no-fields">No fields to display.</p>
        <?php endif; ?>
    </div>

</body>

</html>
