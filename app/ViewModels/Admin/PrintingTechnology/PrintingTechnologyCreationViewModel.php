<?php

namespace App\ViewModels\Admin\PrintingTechnology;

/**
 * class for transferring input
 * that was entered in an printing technology creation form
 * from interfaces (views)
 * to the application (services and repositories).
 */
class PrintingTechnologyCreationViewModel
{
    public string $name;
    public string $description;
}
