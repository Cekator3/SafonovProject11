'use strict';

/**
 * Creates a new numerated names attributes of input fields
 *
 * For example, model-sizes[][height], ... -> model-sizes[0][height],
 * model-sizes[1][height]...
 *
 * @param {HTMLElement[]} parents
 * @param {string} prefix - Prefix of the name attribute
 * @param {string} postfix - Postfix of the name attribute
 * @returns {void}
 */
export function FormsNumerateNameAttributes(parents, prefix, postfix)
{
    for (let i = 0; i < parents.length; i++)
    {
        let inputs = parents[i].getElementsByTagName('input');
        for (let input of inputs)
            input.name = prefix + i + postfix;
    }
}
