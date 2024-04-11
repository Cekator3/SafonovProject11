<?php

namespace App\ViewModels\Admin\BaseModel;

/**
 * class for transferring input
 * that was entered in an filament type creation form
 * from interfaces (views)
 * to the application (services and repositories).
 */
class BaseModelCreationViewModel
{
    public string $name;
    public string $description;
    /**
     * @var BaseModelSize[]
     */
    public array $modelSizes;
}
