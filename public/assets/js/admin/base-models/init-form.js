'use strict';

import { FormsNumerateNameAttributes } from "./forms.js";
import { ModelSizesInit, ModelSizesAdd } from "./model-sizes.js";

/**
 * Initializes the model's sizes list elements
 *
 * @param {HTMLLIElement[]} modelSizes
 * @returns{void}
 */
function InitializeModelSizes(modelSizes)
{
    for (let i = 0; i < modelSizes.length; i++)
        ModelSizesInit(modelSizes[i]);
}

/**
 * Initializes add model's size button.
 *
 * @param {HTMLButtonElement} addModelSizeButton
 * @returns {void}
 */
function InitializeAddModelSizeButton(addModelSizeButton)
{
    addModelSizeButton.addEventListener('click', function (event)
    {
        event.preventDefault();
        ModelSizesAdd();
    });
}

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
        FormsNumerateNameAttributes(multipliers, 'model-sizes[', '][multiplier]');
        FormsNumerateNameAttributes(lengths, 'model-sizes[', '][length]');
        FormsNumerateNameAttributes(widths, 'model-sizes[', '][width]');
        FormsNumerateNameAttributes(heights, 'model-sizes[', '][height]');

        this.submit();
    });
}

let form = document.getElementById('model-form');

let modelSizes = Array.from(form.querySelectorAll('.model-sizes li'));
let addModelSizeButton = modelSizes.pop();

InitializeForm(form);
InitializeModelSizes(modelSizes);
InitializeAddModelSizeButton(addModelSizeButton);
