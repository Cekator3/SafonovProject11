/**
 * @file Subsystem for interacting with model's sizes
 */

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
}

/**
 * Creates new empty model's size in the end of the list
 *
 * @returns {void}
 */
export function ModelSizesAdd()
{
    let modelSizes = document.querySelector('.model-sizes');
    let modelSize = modelSizes.firstElementChild.cloneNode(true);
    let deleteButton = modelSizes.lastElementChild;
    ModelSizesInit(modelSize);
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
