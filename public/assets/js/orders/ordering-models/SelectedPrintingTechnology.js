/**
 * @file A subsystem for interaction with the user-selected printing technology
 */

'use strict';

/**
 * Returns selected printing technology DOM element
 * @returns {HTMLLIElement | null}
 */
function getSelected()
{
    return document.querySelector('.printing-technologies input:checked')?.closest('li');
}

/**
 * Retrieves number from filament type DOM element
 * @param {HTMLLIElement} printingTechnology
 * @returns {number[]}
 */
function GetSupportedFilamentTypes(printingTechnology)
{
    let idsStr = printingTechnology.getAttribute('data-supported-filament-types-ids');
    return JSON.parse(idsStr);
}

/**
 * Retrieves identifiers of supported filament types
 * of the user-selected printing technology
 * @returns {number[]}
 */
export function SelectedPrintingTechnologyGetSupportedFilamentTypes()
{
    let printingTechnology = getSelected();
    return GetSupportedFilamentTypes(printingTechnology);
}
