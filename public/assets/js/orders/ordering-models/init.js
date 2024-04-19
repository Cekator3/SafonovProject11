import { SelectedFilamentTypeGet, SelectedFilamentTypeUnselect } from "./SelectedFilamentType.js";
import { SupportedFilamentTypesGet, SupportedFilamentTypesInit } from "./SupportedFilamentTypes.js";
import { VisibleFilamentTypesSet } from './VisibleFilamentTypes.js';

SupportedFilamentTypesInit();

let printingTechnologies = document.querySelectorAll('.printing-technologies input');

for (let printingTechnology of printingTechnologies)
{
    printingTechnology.addEventListener('change', (event) =>
    {
        let printingTechnologyId = +event.target.value;
        let supportedFilamentTypesIds = SupportedFilamentTypesGet(printingTechnologyId);

        let selectedFilamentTypeId = SelectedFilamentTypeGet();
        if (supportedFilamentTypesIds.includes(selectedFilamentTypeId))
            SelectedFilamentTypeUnselect(selectedFilamentTypeId);

        VisibleFilamentTypesSet(supportedFilamentTypesIds);
    });
}
