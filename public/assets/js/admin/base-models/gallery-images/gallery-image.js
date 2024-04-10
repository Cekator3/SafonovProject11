/**
 * @file Subsystem for interacting with model's gallery images.
 */

'use strict';

/**
 * Prefix of the id attribute that is used to identify the gallery images
 */
const ID_PREFIX = 'gallery_image_';

/**
 * Returns id of the image. Returns NaN if can't do this.
 *
 * @param {HTMLLIElement} image
 * @returns {number}
 */
function GetImageId(image)
{
    return +image.id.substring(ID_PREFIX.length, image.id.length);
}

/**
 * Marks a gallery image for deletion.
 *
 * @param {HTMLLIElement} image
 * @returns {void}
 */
export function GalleryImageDelete(image)
{
    image.classList.add('deletion-mark');
}

/**
 * Removes deletion mark from the gallery image.
 *
 * @param {HTMLLIElement} image
 * @returns {void}
 */
export function GalleryImageRestore(image)
{
    image.classList.remove('deletion-mark');
}

/**
 * Checks if the gallery image has been deleted.
 *
 * @param {HTMLLIElement} image
 * @returns {boolean}
 */
export function GalleryImageIsDeleted(image)
{
    return image.classList.contains('deletion-mark');
}

/**
 * Returns identifiers of all marked for deletion images.
 *
 * @returns {number[]}
 */
export function GalleryImageGetDeleted()
{
    let result = [];

    let imagesToDelete = document.querySelectorAll('.gallery-images li[class~=deletion-mark]');
    for (let image of imagesToDelete)
    {
        let id = GetImageId(image);

        if (isNaN(id))
            continue;
        result.push(id);
    }

    return result;
}
