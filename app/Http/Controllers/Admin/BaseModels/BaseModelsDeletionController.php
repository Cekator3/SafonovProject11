<?php

namespace App\Http\Controllers\Admin\BaseModels;

use Illuminate\Http\RedirectResponse;

class BaseModelsDeletionController
{
    /**
     * Tries to delete a base model
     */
    public function deleteBaseModel(int $baseModelId) : RedirectResponse
    {
        // ...
        return redirect()->route('base-models');
    }
}
