<?php

namespace App\Http\Controllers\Admin\BaseModels;

use App\Services\Admin\BaseModels\BaseModelsDeletionService;
use Illuminate\Http\RedirectResponse;

class BaseModelsDeletionController
{
    /**
     * Tries to delete a base model
     */
    public function deleteBaseModel(int $baseModelId) : RedirectResponse
    {
        $models = new BaseModelsDeletionService();
        $models->remove($baseModelId);
        return redirect()->route('base-models');
    }
}
