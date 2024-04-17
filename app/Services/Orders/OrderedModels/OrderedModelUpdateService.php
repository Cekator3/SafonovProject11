<?php

namespace App\Services\Orders\OrderedModels;

use App\Errors\Orders\OrderedModelUpdateErrors;
use App\Errors\UserInputErrors;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Orders\OrderedModelRepository;
use App\ViewModels\Orders\OrderedCatalogModelViewModel;
use App\Services\Orders\UserInputValidation\OrderedModelAmountValidationService;

/**
 * Subsystem for updating stored information about ordered models
 * from the user's current order.
 */
class OrderedModelUpdateService
{
    private function validateUserInput(OrderedCatalogModelViewModel $model,
                                       UserInputErrors $errors) : void
    {
        $amountValidator = new OrderedModelAmountValidationService();
        $amountValidator->validate($model->amount, $model->amountInputName, $errors);
    }

    /**
     * Returns user's current order if exists.
     */
    private function getUserCurrentOrderId(int $userId) : int|null
    {
        $orders = new OrderRepository();
        return $orders->getCurrentOrderId($userId);
    }

    private function updateModelInUserOrder(OrderedCatalogModelViewModel $model,
                                            int $orderId,
                                            UserInputErrors $errors) : void
    {
        $models = new OrderedModelRepository();
        $updateErrors = new OrderedModelUpdateErrors();

        $models->update($model, $orderId, $updateErrors);

        if (! $updateErrors->hasAny())
            return;

        if ($updateErrors->isAlreadyExist())
        {
            $errMessage = 'Модель с такой же конфигурацией уже существует в заказе';
            $errors->add($model->generalErrorsName, $errMessage);
        }
    }


    /**
     * Tries to update an ordered model from the user's current order
     *
     * @param OrderedCatalogModelViewModel $model
     * User's input about a new ordered model's details.
     * @param UserInputErrors $errors
     * User's inputs errors that prevented successful execution of the action.
     */
    public function update(OrderedCatalogModelViewModel $model,
                           UserInputErrors $errors) : void
    {
        // 1 Validate user's input
        $this->validateUserInput($model, $errors);

        // 2 Update ordered model
        $userId = Auth::user()->id;
        $orderId = $this->getUserCurrentOrderId($userId);
        $this->updateModelInUserOrder($model, $orderId, $errors);
    }
}
