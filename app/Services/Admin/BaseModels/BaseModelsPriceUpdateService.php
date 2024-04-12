<?php

namespace App\Services\Admin\BaseModels;

use App\Errors\UserInputErrors;
use App\Repositories\Admin\BaseModels\BaseModelPriceRepository;
use App\Services\Admin\BaseModels\UserInputValidation\BaseModelPriceValidationService;
use App\ViewModels\Admin\BaseModel\Price\BaseModelPricesUpdateViewModel;

/**
 * Subsystem for updating stored information on base models prices.
 */
class BaseModelsPriceUpdateService
{
    private function validateUserInput(BaseModelPricesUpdateViewModel $model,
                                       UserInputErrors $errors)
    {
        $priceValidator = new BaseModelPriceValidationService();

        // Validate printing technologies prices
        foreach ($model->printingTechnologiesPrices as $printingTechnology)
            $priceValidator->validate($printingTechnology->price, $printingTechnology->inputName, $errors);

        // Validate filament types prices
        foreach ($model->filamentTypesPrices as $filamentType)
            $priceValidator->validate($filamentType->price, $filamentType->inputName, $errors);

        // Validate colors prices
        foreach ($model->colorsPrices as $color)
            $priceValidator->validate($color->price, $color->inputName, $errors);

        // Validate model's sizes prices
        foreach ($model->modelSizesPrices as $modelSize)
            $priceValidator->validate($modelSize->price, $modelSize->inputName, $errors);

        // Validate additional services prices
        foreach ($model->additionalServicesPrices as $additionalService)
            $priceValidator->validate($additionalService->price, $additionalService->inputName, $errors);

        // Validate prices for various model's types
        $priceValidator->validate($model->priceForSolidType, $model->priceForSolidTypeInputName, $errors);
        $priceValidator->validate($model->priceForHoledType, $model->priceForHoledTypeInputName, $errors);
        $priceValidator->validate($model->priceForPartedType, $model->priceForPartedTypeInputName, $errors);
        $priceValidator->validate($model->priceForNotPartedType, $model->priceForNotPartedTypeInputName, $errors);
    }

    /**
     * Tries to update a base model printing price from user's input.
     *
     * @param BaseModelPricesUpdateViewModel $model User's input
     * @param UserInputErrors $errors
     * User's inputs errors that prevented successful execution of the action.
     */
    public function update(BaseModelPricesUpdateViewModel $model,
                           UserInputErrors $errors) : void
    {
        // 1. validate user's input
        $this->validateUserInput($model, $errors);

        if ($errors->hasAny())
            return;

        // 2. update information about the base model's printing price
        $models = new BaseModelPriceRepository();
        $models->update($model);
    }
}
