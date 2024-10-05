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
    if (!empty($structured_fields)): ?>
        <?php foreach ($structured_fields as $segment): ?>
            <h3><?php echo htmlspecialchars($segment['seg_name']); ?></h3>
            <div>
                <?php echo $segment['data_html']; // Display the generated HTML for the field ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No fields to display.</p>
    <?php endif; ?>
</body>
</html>