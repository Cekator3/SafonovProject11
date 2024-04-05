<?php

namespace App\Http\Controllers\Admin\AdditionalServices;

use Illuminate\View\View;
use App\DTOs\Admin\AdditionalServiceDTO;

class ListAdditionalServicesController
{
    private function getTestData() : array
    {
        $arr = [];

        for ($i=0; $i < 15; $i++)
        {
            $service = new AdditionalServiceDTO($i, "test{$i}", 'Практический опыт показывает, что дальнейшее развитие различных форм деятельности способствует подготовке и реализации новых предложений', '');
            $service->setPreviewImageUrl('/assets/images/test.gif');
            $arr []= $service;
        }

        return $arr;
    }

    public function showAdditionalServices() : View
    {
        // ...
        return view('admin.additional-services.list',
                    ['additionalServices' => $this->getTestData()]);
    }
}
