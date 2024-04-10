import { FormsNumerateNameAttributes } from "./forms.js";

/**
 * Initializes the form of the page
 *
 * @param {HTMLFormElement} form
 * @returns {void}
 */
function InitializeForm(form)
{
    form.addEventListener('submit', function (event)
    {
        event.preventDefault();

        // Update model's sizes inputs name attribute
        let modelSizes = document.querySelector('.model-sizes');
        let multipliers = modelSizes.querySelectorAll('input[name$="[multiplier]"]');
        let lengths = modelSizes.querySelectorAll('input[name$="[length]"]');
        let widths = modelSizes.querySelectorAll('input[name$="[width]"]');
        let heights = modelSizes.querySelectorAll('input[name$="[height]"]');
        FormsNumerateNameAttributes(multipliers, 'model-sizes[', '][multiplier]');
        FormsNumerateNameAttributes(lengths, 'model-sizes[', '][length]');
        FormsNumerateNameAttributes(widths, 'model-sizes[', '][width]');
        FormsNumerateNameAttributes(heights, 'model-sizes[', '][height]');

        this.submit();
    });
}

let form = document.getElementById('model-form');
InitializeForm(form);
