<?php

namespace App\Http\Controllers\Admin\AdditionalServices;

use Illuminate\View\View;
use App\DTOs\Admin\AdditionalServiceDTO;

class ListAdditionalServicesController
{
    private function getTestData() : array
    {
        $arr = [];

        $service = new AdditionalServiceDTO(0, "test0", 'asdf', '');
        $service->setPreviewImageUrl('/assets/images/test.gif');
        $arr []= $service;

        $service = new AdditionalServiceDTO(0, "test0", 'Aliquip dolor qui id qui adipisicing incididunt nulla fugiat in elit proident dolor mollit.Nisi quis exercitation deserunt laboris laborum deserunt occaecat reprehenderit pariatur nostrud commodo eiusmod qui reprehenderit.Non excepteur magna ullamco magna mollit amet.Aliqua minim non magna et ex reprehenderit nulla excepteur commodo qui voluptate cupidatat elit. Sunt enim deserunt amet ipsum enim eiusmod ex culpa cillum esse duis.', '');
        $service->setPreviewImageUrl('/assets/images/test.gif');
        $arr []= $service;

        for ($i=1; $i < 15; $i++)
        {
            $service = new AdditionalServiceDTO($i, "ЫВЛАОВДЫЛАОВЫЛДАОЫДЛВ АОЛДЫВОАЛ ДЫВОАДЫЛВОАЛДЫВОАЛД ВЫОАЛД{$i}", 'Практический опыт показывает, что дальнейшее развитие различных форм деятельности способствует подготовке и реализации новых предложений Федя Федя Федя pФедя Федя', '');
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
