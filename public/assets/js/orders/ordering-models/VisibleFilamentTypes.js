/**
 * @file A subsystem for hiding filament types.
 */

'use strict';

let ID_PREFIX = 'filament-type-';

/**
 * Retrieves all filament types
 * @returns {HTMLInputElement[]}
 */
function GetAll()
{
    return document.querySelectorAll('.filament-types input');
}

/**
 * Retrieves identifier of filament type
 * @param {HTMLInputElement} filamentType
 * @returns {number}
 */
function GetIdentifier(filamentType)
{
    return +filamentType.id.substring(ID_PREFIX.length, filamentType.id.length);
}

/**
 * Hides filament type
 * @param {HTMLInputElement} filamentType
 * @returns {void}
 */
function Hide(filamentType)
{
    filamentType.closest('li').classList.add('hidden');
}

/**
 * Makes filament type visible
 * @param {HTMLInputElement} filamentType
 * @returns {void}
 */
function Unhide(filamentType)
{
    filamentType.closest('li').classList.remove('hidden');
}

/**
 * Sets filament types that will be visible to the user. Others will be hidden.
 * @param {number[]} ids identifiers of filament types.
 * @returns {void}
 */
export function VisibleFilamentTypesSet(ids)
{
    let filamentTypes = GetAll();
    for (let filamentType of filamentTypes)
    {
        let id = GetIdentifier(filamentType);

        if (ids.includes(id))
            Unhide(filamentType);
        else
            Hide(filamentType);
    }
}
