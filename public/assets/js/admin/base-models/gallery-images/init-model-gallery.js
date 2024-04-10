'use strict';

import { GalleryImageDelete, GalleryImageIsDeleted, GalleryImageRestore } from "./gallery-image.js";

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

            if (GalleryImageIsDeleted(image))
                GalleryImageRestore(image);
            else
                GalleryImageDelete(image);
        });
    }
}


let buttons = document.querySelectorAll('.gallery-images > li button');

InitializeDeleteImageButtons(buttons);
