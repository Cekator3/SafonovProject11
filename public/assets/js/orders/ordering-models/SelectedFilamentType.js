/**
 * @file A subsystem for interaction with the user-selected filament type
 */

'use strict';

var ID_PREFIX = 'filament-type-';

/**
 * Returns selected filament type DOM element
 * @returns {HTMLInputElement | null}
 */
function getSelected()
{
    return document.querySelector('.filament-types input:checked');
}

/**
 * Retrieves number from filament type DOM element
 * @param {HTMLInputElement} filamentType
 * @returns {number}
 */
function getIdentifier(filamentType)
{
    return +filamentType.id.substring(ID_PREFIX.length, filamentType.id.length);
}

/**
 * Retrieves identifier of filament type that is selected by user
 * @returns {number | null}
 */
export function SelectedFilamentTypeGet()
{
    let filamentType = getSelected();
    if (filamentType === null)
        return null;

    return getIdentifier(filamentType);
}

/**
 * Unselects a filament type if it is selected by user.
 * @param {number} id
 * @returns {void}
 */
export function SelectedFilamentTypeUnselect(id)
{
    let filamentType = document.getElementById(ID_PREFIX + id);
    if (filamentType === null)
        return;
    filamentType.checked = false;
}
