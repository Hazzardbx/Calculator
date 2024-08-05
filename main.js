document.addEventListener("DOMContentLoaded", function() {
    const display = document.getElementById('display');
    const operationInput = document.getElementById('operation');
    const form = document.querySelector('form');
    const resetButton = document.getElementById('reset');
    const equalsButton = document.getElementById('equals');

    document.querySelectorAll('button[type="button"]').forEach(button => {
        button.addEventListener('click', function() {
            if (button.value === 'C') {
                // clear display
                display.value = '';
            } else {
                display.value += button.value;
            }
        });
    });

    equalsButton.addEventListener('click', function() {
        operationInput.value = display.value;
        form.submit(); 
    });
});
