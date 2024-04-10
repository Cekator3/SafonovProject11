import { FormInputsNamesNumerate } from "../../forms/form-inputs-names";

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

        let modelSizes = document.querySelector('.model-sizes');
        let multipliers = modelSizes.querySelectorAll('input[name$="[multiplier]"]');
        let lengths = modelSizes.querySelectorAll('input[name$="[length]"]');
        let widths = modelSizes.querySelectorAll('input[name$="[width]"]');
        let heights = modelSizes.querySelectorAll('input[name$="[height]"]');
        FormInputsNamesNumerate(multipliers, 'model-sizes[', '][multiplier]');
        FormInputsNamesNumerate(lengths, 'model-sizes[', '][length]');
        FormInputsNamesNumerate(widths, 'model-sizes[', '][width]');
        FormInputsNamesNumerate(heights, 'model-sizes[', '][height]');

        this.submit();
    });
}

let form = document.getElementById('model-form');
InitializeForm(form);
