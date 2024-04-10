'use strict';

import { FormInputsRemove } from "../../forms/form-inputs.js";
import { GalleryImagesGetRemoved } from "./gallery-images/gallery-images.js";
import { FormInputsNamesNumerate } from '/assets/js/forms/form-inputs-names.js';
import { FormInputsAddHidden } from '/assets/js/forms/form-inputs.js';

/**
 * Initializes the form of the page
 *
 * @param {HTMLFormElement} form
 * @returns {void}
 */
function InitializeForm(form)
{
    form.addEventListener('submit', function (event)
    {
        event.preventDefault();

        // Update model's sizes inputs name attribute
        let modelSizes = document.querySelector('.model-sizes');
        let multipliers = modelSizes.querySelectorAll('input[name$="[multiplier]"]');
        let lengths = modelSizes.querySelectorAll('input[name$="[length]"]');
        let widths = modelSizes.querySelectorAll('input[name$="[width]"]');
        let heights = modelSizes.querySelectorAll('input[name$="[height]"]');
        FormInputsNamesNumerate(multipliers, 'model-sizes[', '][multiplier]');
        FormInputsNamesNumerate(lengths, 'model-sizes[', '][length]');
        FormInputsNamesNumerate(widths, 'model-sizes[', '][width]');
        FormInputsNamesNumerate(heights, 'model-sizes[', '][height]');

        // Add deleted gallery images as an input
        FormInputsRemove(this, 'removed-gallery-images[]');
        let removedImagesIds = GalleryImagesGetRemoved();
        for (let imageId of removedImagesIds)
            FormInputsAddHidden(this, 'removed-gallery-images[]', imageId);

        this.submit();
    });
}

let form = document.getElementById('model-form');
InitializeForm(form);
