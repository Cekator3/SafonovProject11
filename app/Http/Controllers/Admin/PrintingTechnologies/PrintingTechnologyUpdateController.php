<?php

namespace App\Http\Controllers\Admin\PrintingTechnologies;

use App\DTOs\Admin\PrintingTechnologyDTO;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PrintingTechnologyUpdateController
{
    private function getTestData() : PrintingTechnologyDTO
    {
        return new PrintingTechnologyDTO(1, "test", 'Практический опыт показывает, что дальнейшее развитие различных форм деятельности способствует подготовке и реализации новых предложений');
    }

    public function showUpdatingForm(int $additionalServiceId) : View
    {
        // ...
        return view('admin.printing-technologies.update', ['printingTechnology' => $this->getTestData()]);
    }

    /**
     * Tries to update a printing technology
     */
    public function updatePrintingTechnology(Request $request, int $printingTechnologyId) : RedirectResponse
    {
        // ...
    }
}
