/**
 * @file Subsystem for interacting with model's sizes input fields.
 */

/**
 * Prefix of the id attribute that is used in inputs and labels
 */
const ID_PREFIX = 'model_size_';

/**
 * Checks if model's size is last remaining in the list
 *
 * @param {li} modelSize
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
 * @param {li} modelSize
 * @returns {number}
 */
function GetLastUsedIdAttribute(modelSize)
{
    let id = modelSize.querySelector('input[name="model-sizes[][height]"]').id;
    let result = +id.substring(ID_PREFIX.length, id.length);
    return isNaN(result) ? 0 : result;
}

/**
 * Sets id attribute for inputs and appropriate labels for new model size
 *
 * @param {input[]} inputs
 * @param {label[]} labels
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
 * @param {input[]} inputs
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
 * @param {li} modelSize
 * @returns {void}
 */
export function ModelSizesInit(modelSize)
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
    ModelSizesInit(modelSize);

    // Adds element before delete button
    let deleteButton = modelSizes.lastElementChild;
    deleteButton.before(modelSize);
}

/**
 * Removes model's size from list
 * @param {li} modelSize
 * @returns {void}
 */
export function ModelSizesRemove(modelSize)
{
    modelSize.remove();
}
