'use strict';

import { GalleryImagesDelete, GalleryImagesIsDeleted, GalleryImagesRestore } from "./gallery-images.js";

/**
 * Initializes delete buttons of gallery images
 *
 * @param {HTMLButtonElement[]} buttons
 * @returns {void}
 */
function InitializeDeleteImageButtons(buttons)
{
    for (let button of buttons)
    {
        button.addEventListener('click', function (event)
        {
            event.preventDefault();
            let image = event.target.closest('li');

            if (GalleryImagesIsDeleted(image))
                GalleryImagesRestore(image);
            else
                GalleryImagesDelete(image);
        });
    }
}


let buttons = document.querySelectorAll('.gallery-images > li button');

InitializeDeleteImageButtons(buttons);
