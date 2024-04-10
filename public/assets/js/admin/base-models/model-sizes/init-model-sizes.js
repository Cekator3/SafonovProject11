'use strict';

import { ModelSizesInit, ModelSizesAdd } from "./model-sizes.js";

/**
 * Initializes the model's sizes list elements
 *
 * @param {HTMLLIElement[]} modelSizes
 * @returns{void}
 */
function InitializeModelSizes(modelSizes)
{
    for (let modelSize of modelSizes)
        ModelSizesInit(modelSize);
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


let modelSizes = Array.from(document.querySelectorAll('.model-sizes li'));
let addModelSizeButton = modelSizes.pop();

InitializeModelSizes(modelSizes);
InitializeAddModelSizeButton(addModelSizeButton);
