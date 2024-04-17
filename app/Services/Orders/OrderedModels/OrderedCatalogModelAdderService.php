<?php

namespace App\Services\Orders\OrderedModels;

use App\Errors\UserInputErrors;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Orders\OrderRepository;
use App\Errors\Orders\OrderModelAdditionErrors;
use App\Repositories\Orders\OrderedModelRepository;
use App\ViewModels\Orders\OrderedCatalogModelViewModel;
use App\Services\Orders\UserInputValidation\OrderedModelAmountValidationService;

/**
 * Subsystem for adding a catalog model to the user's current order.
 */
class OrderedCatalogModelAdderService
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

    private function addModelToUserOrder(OrderedCatalogModelViewModel $model,
                                         int $orderId,
                                         UserInputErrors $errors) : void
    {
        $models = new OrderedModelRepository();
        $storingErrors = new OrderModelAdditionErrors();

        $models->add($model, $orderId, $storingErrors);

        if (! $storingErrors->hasAny())
            return;

        if ($storingErrors->isAlreadyExist())
        {
            $errMessage = 'Модель с такой же конфигурацией уже существует в заказе';
            $errors->add($model->generalErrorsName, $errMessage);
        }
    }

    /**
     * Tries to add a new model to the user's current order.
     *
     * @param OrderedCatalogModelViewModel $model
     * User's input about a new model for the user's current order.
     * @param UserInputErrors $errors
     * User's inputs errors that prevented successful execution of the action.
     */
    public function add(OrderedCatalogModelViewModel $model,
                        UserInputErrors $errors) : void
    {
        $this->validateUserInput($model, $errors);

        // 2 Check if user already ordered model with exact same configuration
        $userId = Auth::user()->id;
        $orderId = $this->getUserCurrentOrderId($userId);

        $models = new OrderedModelRepository();
        $models->exists($model, $userId, $orderId);

        // 3 Add model to the user's current order
        $this->addModelToUserOrder($model, $orderId, $errors);
    }
}
