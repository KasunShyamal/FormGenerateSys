<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMS - Dynamic Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
 
    <style>
        .bg-dark-purple {
            background-color: #1e1e2d;
        }
 
        .bg-darker-purple {
            background-color: #151521;
        }
 
        .text-light-purple {
            color: #a2a5b9;
        }
 
        .border-dark-purple {
            border-color: #2f2f40;
        }
 
        .focus-visible:focus-visible {
            outline: 2px solid #6366f1;
            outline-offset: 2px;
        }
    </style>
 
</head>
 
<body class="flex items-center min-h-screen bg-dark-purple p-4">
<div class="w-auto px-20 mx-auto bg-white rounded-2xl">
    <?php if (!empty($structured_fields)): ?>
        <form id="dynamicForm" class="p-8 md:p-10">
            <h2 class="text-5xl font-bold text-center text-gray-800 mb-12 relative">
                <?php echo htmlspecialchars($structured_fields['heading']); ?>
            </h2>
 
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($structured_fields['id']); ?>">
            <input type="hidden" name="formName" value="<?php echo htmlspecialchars($structured_fields['formName']); ?>">
 
            <!-- Stepper -->
            <div class="relative mb-16">
                <div class="absolute top-1/2 left-0 right-0 transform -translate-y-1/2 h-2 bg-gray-200"></div>
                <div class="relative flex justify-between">
                    <?php
                    $step_count = count($structured_fields['fields']);
                    $step_number = 1;
                    foreach ($structured_fields['fields'] as $segment_name => $fields): ?>
                        <div class="step flex flex-col items-center relative z-10 <?php echo $step_number === 1 ? 'active' : ''; ?>">
                            <div class="w-16 h-16 rounded-full bg-white border-2 border-gray-300 flex items-center justify-center font-semibold text-3xl text-gray-500 transition-all duration-200 <?php echo $step_number === 1 ? 'bg-indigo-500 border-indigo-500 text-white' : ''; ?>">
                                <?php echo $step_number; ?>
                            </div>
                            <div class="mt-4 text-3xl font-medium text-gray-600">
                                <?php echo htmlspecialchars($segment_name); ?>
                            </div>
                        </div>
                    <?php
                        $step_number++;
                    endforeach; ?>
                </div>
            </div>
 
            <!-- Progress Bar -->
            <div class="h-4 bg-gray-200 rounded-full mb-12">
                <div class="progress-bar-fill h-full bg-indigo-500 rounded-full transition-all duration-300" style="width: 0%"></div>
            </div>
 
            <!-- Form Segments -->
            <?php
            $segment_number = 1;
            foreach ($structured_fields['fields'] as $segment_name => $fields): ?>
                <div class="form-segment <?php echo $segment_number === 1 ? 'block' : 'hidden'; ?>" data-step="<?php echo $segment_number; ?>">
                    <h3 class="text-4xl font-semibold text-gray-800 mb-10 pb-3 border-b-2 border-indigo-500 inline-block">
                        <?php echo htmlspecialchars($segment_name); ?>
                    </h3>
                   
                    <div class="grid grid-cols-1 gap-12">
                        <?php foreach ($fields as $field): ?>
                            <div class="field-wrapper w-full">
                                <?php
                                    $doc = new DOMDocument();
                                    @$doc->loadHTML($field);
                                   
                                    $elements = $doc->getElementsByTagName('*');
                                    foreach ($elements as $element) {
                                        if ($element->tagName === 'input' || $element->tagName === 'select' || $element->tagName === 'textarea') {
                                            $currentClasses = $element->getAttribute('class');
                                            $element->setAttribute('class', $currentClasses . ' w-full px-8 py-6 rounded-lg border-2 border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 text-3xl');
                                        }
                                        if ($element->tagName === 'label') {
                                            $currentClasses = $element->getAttribute('class');
                                            $element->setAttribute('class', $currentClasses . ' block text-3xl font-medium text-gray-700 mb-4');
                                        }
                                        if ($element->tagName === 'div' && $element->getAttribute('class') && strpos($element->getAttribute('class'), 'radio-group') !== false) {
                                            $currentClasses = $element->getAttribute('class');
                                            $element->setAttribute('class', $currentClasses . ' flex flex-row justify-start gap-16 mb-6');
                                        }
                                        if ($element->tagName === 'input' && $element->getAttribute('type') === 'radio') {
                                            $element->setAttribute('class', 'w-8 h-8 text-indigo-500 border-gray-300 focus:ring-indigo-500 mr-4');
                                        }
                                        if ($element->tagName === 'label' && $element->parentNode && $element->parentNode->getAttribute('class') && strpos($element->parentNode->getAttribute('class'), 'radio-group') !== false) {
                                            $element->setAttribute('class', 'flex items-center text-3xl font-medium text-gray-700 cursor-pointer px-8 py-4 rounded-lg hover:bg-gray-50 transition-colors duration-200');
                                        }
                                    }
                                    echo $doc->saveHTML();
                                ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
 
                    <!-- Navigation Buttons -->
                    <div class="flex justify-between mt-12 pt-8 border-t-2 border-gray-200">
                        <?php if ($segment_number > 1): ?>
                            <button type="button" class="btn-prev px-10 py-5 bg-gray-100 text-gray-700 rounded-lg text-3xl font-medium hover:bg-gray-200 transition-all duration-200">
                                Previous
                            </button>
                        <?php else: ?>
                            <div></div>
                        <?php endif; ?>
                       
                        <?php if ($segment_number < $step_count): ?>
                            <button type="button" class="btn-next px-10 py-5 bg-indigo-500 text-white rounded-lg text-3xl font-medium hover:bg-indigo-600 transition-all duration-200">
                                Next
                            </button>
                        <?php else: ?>
                            <button type="submit" class="px-10 py-5 bg-indigo-500 text-white rounded-lg text-3xl font-medium hover:bg-indigo-600 transition-all duration-200">
                                Submit
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            <?php
                $segment_number++;
            endforeach; ?>
        </form>
    <?php else: ?>
        <p class="text-center text-gray-500 text-3xl py-12">No fields to display.</p>
    <?php endif; ?>
</div>
 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            const totalSteps = $('.form-segment').length;
            let currentStep = 1;
 
            function updateProgress() {
                const progress = ((currentStep - 1) / (totalSteps - 1)) * 100;
                $('.progress-bar-fill').css('width', `${progress}%`);
 
                // Update stepper circles
                $('.step').each(function(index) {
                    const stepNumber = index + 1;
                    const circle = $(this).find('div:first');
 
                    if (stepNumber < currentStep) {
                        // Completed step
                        circle.removeClass('bg-white border-gray-300 text-gray-500')
                            .addClass('bg-green-500 border-green-500 text-white');
                    } else if (stepNumber === currentStep) {
                        // Current step
                        circle.removeClass('bg-white border-gray-300 text-gray-500')
                            .addClass('bg-indigo-500 border-indigo-500 text-white');
                    } else {
                        // Future step
                        circle.removeClass('bg-indigo-500 border-indigo-500 text-white bg-green-500 border-green-500')
                            .addClass('bg-white border-gray-300 text-gray-500');
                    }
                });
            }
 
            function validateStep(step) {
                let isValid = true;
                const currentSegment = $(`.form-segment[data-step="${step}"]`);
                currentSegment.find('input[required], select[required], textarea[required]').each(function() {
                    if (!$(this).val()) {
                        isValid = false;
                        $(this).addClass('border-red-500 ring-red-200');
                    } else {
                        $(this).removeClass('border-red-500 ring-red-200');
                    }
                });
                return isValid;
            }
 
            function showStep(step) {
                $('.form-segment').addClass('hidden');
                $(`.form-segment[data-step="${step}"]`).removeClass('hidden');
                updateProgress();
            }
 
            $('.btn-next').click(function() {
                if (validateStep(currentStep)) {
                    if (currentStep < totalSteps) {
                        currentStep++;
                        showStep(currentStep);
                    }
                } else {
                    // Show error toast
                    const toast = $('<div>').addClass('fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg')
                        .text('Please fill in all required fields.')
                        .appendTo('body');
 
                    setTimeout(() => toast.remove(), 3000);
                }
            });
 
            $('.btn-prev').click(function() {
                if (currentStep > 1) {
                    currentStep--;
                    showStep(currentStep);
                }
            });
 
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
 
            // Initialize progress
            updateProgress();
        });
    </script>
</body>
 
</html>