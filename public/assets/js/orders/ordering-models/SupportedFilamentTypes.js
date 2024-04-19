/**
 * @file A subsystem for getting supported filament types of printing technology.
 */

'use strict';

var supportedFilamentTypes = new Map();

/**
 * Initializes subsystem
 * @returns {void}
 */
export function SupportedFilamentTypesInit()
{
    let objects = JSON.parse(document.getElementById('printing-technologies-supported-filament-types').innerHTML);
    for (let object of objects)
        supportedFilamentTypes.set(object.printingTechnologyId, object.supportedFilamentTypes);
}

/**
 * Retrieves identifiers of supported filament types
 * of the user-selected printing technology
 * @param {number} printingTechnologyId
 * @returns {number[] | undefined}
 */
export function SupportedFilamentTypesGet(printingTechnologyId)
{
    return supportedFilamentTypes.get(printingTechnologyId);
}
