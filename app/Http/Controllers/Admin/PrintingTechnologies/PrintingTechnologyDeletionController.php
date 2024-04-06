<?php

namespace App\Http\Controllers\Admin\PrintingTechnologies;

use App\Services\Admin\PrintingTechnologies\PrintingTechnologiesDeletionService;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PrintingTechnologyDeletionController
{
    /**
     * Tries to delete a printing technology
     */
    public function deletePrintingTechnology(int $printingTechnologyId) : RedirectResponse
    {
        $printingTechnologies = new PrintingTechnologiesDeletionService();
        $printingTechnologies->remove($printingTechnologyId);

        return redirect()->route('printing-technologies');
    }
}
