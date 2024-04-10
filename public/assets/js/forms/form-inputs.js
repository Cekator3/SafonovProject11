/**
 * @file Subsystem (module) for interacting with input fields of the form.
 */
'use strict';

/**
 * Adds hidden input to the form.
 *
 * @param {HTMLFormElement} form
 * @param {string} name
 * @param {string} value
 * @returns {void}
 */
export function FormInputsAddHidden(form, name, value)
{
    let input = document.createElement('input');
    input.type = 'hidden';
    input.name = name;
    input.value = value;
    form.appendChild(input);
}

/**
 * Removes all input fields from the form with the given name.
 *
 * @param {HTMLFormElement} form
 * @param {string} name
 * @returns {void}
 */
export function FormInputsRemove(form, name)
{
    let inputs = form.querySelectorAll('input[name="' + name + '"]');
    for (let input of inputs)
        form.removeChild(input);
}
