<?php

namespace App\ViewModels\Admin\BaseModel;

/**
 * class for transferring input
 * that was entered in an filament type update form
 * from interfaces (views)
 * to the application (services and repositories).
 */
class BaseModelUpdateViewModel
{
    public string $name;
    public string $description;
    /**
     * @var BaseModelSize[]
     */
    public array $modelSizes;
}
