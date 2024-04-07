<?php

namespace App\Http\Controllers\Admin\FilamentTypes;

use Illuminate\Http\RedirectResponse;
use App\Services\Admin\FilamentTypes\FilamentTypesDeletionService;

class FilamentTypeDeletionController
{
    /**
     * Tries to delete a filament type
     */
    public function deleteFilamentType(int $filamentTypeId) : RedirectResponse
    {
        $filamentTypes = new FilamentTypesDeletionService();
        $filamentTypes->remove($filamentTypeId);

        return redirect()->route('filament-types');
    }
}
