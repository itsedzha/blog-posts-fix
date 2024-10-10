import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('fileInput');
    const fileNameDisplay = document.getElementById('fileNameDisplay');
    const fileNameSpan = document.getElementById('fileName');

    if (fileInput) {
        fileInput.addEventListener('change', function() {
            // Check if a file is selected
            if (fileInput.files.length > 0) {
                const fileName = fileInput.files[0].name;
                fileNameSpan.textContent = fileName;
                fileNameDisplay.classList.remove('hidden');
            } else {
                fileNameDisplay.classList.add('hidden');
            }
        });
    }
});
