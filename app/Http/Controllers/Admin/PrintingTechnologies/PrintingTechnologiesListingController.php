<?php

namespace App\Http\Controllers\Admin\PrintingTechnologies;

use Illuminate\View\View;
use App\DTOs\Admin\PrintingTechnologyDTO;

class PrintingTechnologiesListingController
{
    private function getTestData(int $amount) : array
    {
        $result = [];

        for ($i = 0; $i < $amount; $i++)
            $result []= new PrintingTechnologyDTO($i, "test{$i}", 'Практический опыт показывает, что дальнейшее развитие различных форм деятельности способствует подготовке и реализации новых предложений');

        return $result;
    }

    public function showPrintingTechnologies() : View
    {
        // ...
        return view('admin.printing-technologies.list', ['printingTechnologies' => $this->getTestData(20)]);
    }
}
