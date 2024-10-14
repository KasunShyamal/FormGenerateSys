<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Generator</title>
    <!-- Tailwind CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        .bg-dark-purple { background-color: #1e1e2d; }
        .bg-darker-purple { background-color: #151521; }
        .text-light-purple { color: #a2a5b9; }
        .border-dark-purple { border-color: #2f2f40; }
        .focus-visible:focus-visible {
            outline: 2px solid #6366f1;
            outline-offset: 2px;
        }
    </style>
</head>
<body class="bg-dark-purple text-light-purple">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold text-center text-white mb-8">Form Generation</h1>

        <div class="max-w-4xl mx-auto bg-darker-purple rounded-lg shadow-lg p-6 overflow-x-auto">
            <table class="min-w-full table-auto border-collapse bg-dark-purple text-white">
                <thead>
                    <tr class="bg-blue-600">
                        <th class="px-4 py-2 text-left">ID</th>
                        <th class="px-4 py-2 text-left">Form Name</th>
                        <th class="px-4 py-2 text-left">Form Heading</th>
                        <th class="px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($form_structure)) : ?>
                        <?php $rowCount = 1; ?>
                        <?php foreach ($form_structure as $structure) : ?>
                            <tr class="border-b border-dark-purple hover:bg-darker-purple">
                                <td class="px-4 py-2"><?php echo $rowCount++; ?></td>
                                <td class="px-4 py-2"><?php echo htmlspecialchars($structure->form_name); ?></td>
                                <td class="px-4 py-2"><?php echo htmlspecialchars($structure->heading); ?></td>
                                <td class="px-4 py-2">
                                    <button type="button" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus-visible" onclick="fetchFormStructure(<?php echo $structure->form_name_id; ?>)">
                                        Generate Form
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="4" class="text-center py-4 italic text-red-500">No form structures available.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div id="test"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function fetchFormStructure(formId) {
            $.ajax({
                url: '<?= base_url('form/get_structure/') ?>' + formId,
                type: 'GET',
                dataType: 'html',
                success: function (data) {
                    var newWindow = window.open();
                    newWindow.document.write(data);
                    newWindow.document.close();
                },
                error: function (xhr, status, error) {
                    console.error('AJAX request failed:', error);
                }
            });
        }
    </script>
</body>
</html>
