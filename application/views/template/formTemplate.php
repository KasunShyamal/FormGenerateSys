<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php 
    // print_r($structured_fields);
    // die();
    // Check if structured_fields is not empty
    if (!empty($structured_fields)): ?>
        
        <h2><?php echo htmlspecialchars($structured_fields['heading']); ?></h2> <!-- Display the heading -->

        <?php 
        // Loop through each segment (e.g., 'Personal')
        foreach ($structured_fields['fields'] as $segment_name => $fields): ?>
            <h3><?php echo htmlspecialchars($segment_name); ?></h3> <!-- Segment name -->

            <div>
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
            //    echo $output . htmlspecialchars($field) . "";
                echo $field . "<br>";

            endforeach; ?>
        </div>

        <?php endforeach; ?>

    <?php else: ?>
        <p>No fields to display.</p>
    <?php endif; ?>

</body>
</html>
