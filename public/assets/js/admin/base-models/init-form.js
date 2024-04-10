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
 * @param {HTMLButtonElement} submitFormButton
 * @returns {void}
 */
function InitializeSubmitFormButton(submitFormButton)
{
    submitFormButton.addEventListener('submit', function ()
    {
        let modelSizes = document.querySelectorAll('.model-sizes li');
        FormsNumerateNameAttributes(modelSizes, 'model-sizes[', '][Multiplier]');
    });
}

let form = document.querySelector('form');

let submitButton = form.querySelector('button[type="submit"]');
let modelSizes = Array.from(form.querySelectorAll('.model-sizes li'));
let addModelSizeButton = modelSizes.pop();

InitializeModelSizes(modelSizes);
InitializeSubmitFormButton(submitButton);
InitializeAddModelSizeButton(addModelSizeButton);
