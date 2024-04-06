<?php

namespace App\ViewModels\Admin\PrintingTechnology;

/**
 * class for transferring input
 * that was entered in an printing technology update form
 * from interfaces (views)
 * to the application (services and repositories).
 */
class PrintingTechnologyUpdateViewModel
{
    public int $id;
    public string $name;
    public string $description;
}
