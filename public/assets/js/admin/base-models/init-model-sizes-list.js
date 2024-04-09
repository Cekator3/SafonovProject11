import { ModelSizesInit, ModelSizesAdd } from "./model-sizes.js";

let modelSizes = document.querySelectorAll('.model-sizes li');
for (let i = 0; i < modelSizes.length - 1; i++)
    ModelSizesInit(modelSizes[i]);

let addModelSizeButton = document.querySelector('.model-sizes .add');
addModelSizeButton.addEventListener('click', function (event)
{
    event.preventDefault();
    ModelSizesAdd();
});
