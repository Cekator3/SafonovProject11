'use strict';

import { GalleryImageDelete, GalleryImageIsDeleted, GalleryImageRestore } from "./gallery-image";

/**
 * Initializes delete buttons of gallery images
 *
 * @param {HTMLButtonElement} button
 * @returns {void}
 */
function InitializeDeleteGalleryImageButton(buttons)
{
    for (let button of buttons)
    {
        button.addEventListener('click', function (event)
        {
            event.preventDefault();
            let image = event.target.closest('li');
            if (GalleryImageIsDeleted(image))
                GalleryImageRestore(image);
            else
                GalleryImageDelete(image);
        });
    }
}


let buttons = document.querySelectorAll('.delete-gallery button');

InitializeDeleteGalleryImageButton(buttons);
