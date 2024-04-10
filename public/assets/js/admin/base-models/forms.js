'use strict';

/**
 * Creates a new numerated names attributes of input fields
 *
 * For example, model-sizes[][height], ... -> model-sizes[0][height],
 * model-sizes[1][height]...
 *
 * @param {HTMLInputElement[]} inputs - inputs to numerate
 * @param {string} prefix - Prefix of the name attribute
 * @param {string} postfix - Postfix of the name attribute
 * @returns {void}
 */
export function FormsNumerateNameAttributes(inputs, prefix, postfix)
{
    for (let i = 0; i < inputs.length; i++)
        inputs[i].name = prefix + i + postfix;
}
