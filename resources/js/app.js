import 'bootstrap';
import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import * as bootstrap from 'bootstrap';

// Custom JavaScript for enhanced interactivity
document.addEventListener('DOMContentLoaded', () => {
    // Form Validation
    const forms = document.querySelectorAll('.needs-validation');
    
    forms.forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });

    // Tooltips Initialization
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => 
        new bootstrap.Tooltip(tooltipTriggerEl)
    );

    // Popovers Initialization (Optional)
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
    const popoverList = [...popoverTriggerList].map(popoverTriggerEl => 
        new bootstrap.Popover(popoverTriggerEl)
    );

    // Smooth Scrolling
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // File Input Preview (Optional)
    const fileInputs = document.querySelectorAll('input[type="file"]');
    fileInputs.forEach(input => {
        input.addEventListener('change', function() {
            const file = this.files[0];
            const fileNameSpan = this.nextElementSibling || 
                this.parentElement.querySelector('.file-name');
            
            if (fileNameSpan && file) {
                fileNameSpan.textContent = file.name;
            }
        });
    });

    // Optional: Dynamic Form Field Interactions
    const dynamicFields = document.querySelectorAll('[data-dynamic-field]');
    dynamicFields.forEach(field => {
        field.addEventListener('input', function() {
            const targetSelector = this.getAttribute('data-dynamic-field');
            const targetField = document.querySelector(targetSelector);
            
            if (targetField) {
                targetField.value = this.value;
            }
        });
    });
});
