/**
 * @file Subsystem for interacting with model's sizes input fields.
 */

'use strict';

/**
 * Prefix of the id attribute that is used in inputs and labels
 */
const ID_PREFIX = 'model_size_li_';

/**
 * Checks if model's size is last remaining in the list
 *
 * @param {HTMLLIElement} modelSize
 * @returns {boolean}
 */
function IsLastRemaining(modelSize)
{
    // Model size and add button
    return modelSize.parentElement.children.length === 2;
}

/**
 * Returns the last id attribute value used in old model size.
 *
 * @param {HTMLLIElement} modelSize
 * @returns {number}
 */
function GetLastUsedIdAttribute(modelSize)
{
    let id = modelSize.querySelector('input[name$="[height]"]').id;
    let result = +id.substring(ID_PREFIX.length, id.length);

    if (! isNaN(result))
        return result;

    // Get last used id attribute from previous model sizes (if they are exists)
    if (modelSize.previousElementSibling === null)
        return 0;
    return GetLastUsedIdAttribute(modelSize.previousElementSibling);
}

/**
 * Sets id attribute for inputs and appropriate labels for new model size
 *
 * @param {HTMLInputElement[]} inputs
 * @param {HTMLLabelElement[]} labels
 * @param {number} id
 * @returns {void}
 */
function SetIdAttributes(inputs, labels, id)
{
    for (let i = 0; i < inputs.length; i++)
    {
        inputs[i].id = ID_PREFIX + id;
        labels[i].setAttribute('for', ID_PREFIX + id);
        id++;
    }
}

/**
 * Clears value attribute for inputs
 * @param {HTMLInputElement[]} inputs
 * @returns {void}
 */
function ClearInputsValues(inputs)
{
    for (let input of inputs)
        input.value = '';
}

/**
 * Initializes the element of the list (so he will work as expected)
 *
 * @param {HTMLLIElement} modelSize
 * @param {bool} clearValues Indicates whether the values from inputs should be cleared
 * @returns {void}
 */
export function ModelSizesInit(modelSize, clearValues = false)
{
    // Adds event listener to delete button
    let deleteButton = modelSize.querySelector('button.delete');
    deleteButton.addEventListener('click', function (event)
    {
        event.preventDefault();
        // Removes model's size if he is not the last remaining
        let modelSize = event.target.closest('li');
        if (! IsLastRemaining(modelSize))
            ModelSizesRemove(modelSize);
    });

    let id = GetLastUsedIdAttribute(modelSize);
    id++;
    let inputs = modelSize.getElementsByTagName('input');
    let labels = modelSize.getElementsByTagName('label');
    SetIdAttributes(inputs, labels, id);
    if (clearValues)
        ClearInputsValues(inputs);
}

/**
 * Creates new empty model's size in the end of the list
 *
 * @returns {void}
 */
export function ModelSizesAdd()
{
    let modelSizes = document.querySelector('.model-sizes');
    let modelSize = modelSizes.lastElementChild.previousElementSibling.cloneNode(true);
    ModelSizesInit(modelSize, true);

    // Adds element before 'add model size' button
    let addButton = modelSizes.lastElementChild;
    addButton.before(modelSize);
}

/**
 * Removes model's size from list
 *
 * @param {HTMLLIElement} modelSize
 * @returns {void}
 */
export function ModelSizesRemove(modelSize)
{
    modelSize.remove();
}
