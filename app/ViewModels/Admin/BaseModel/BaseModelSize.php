<?php

namespace App\ViewModels\Admin\BaseModel;


/**
 * Class for transferring base model's size
 * input from interfaces (views)
 * to the application (services and repositories).
 */
class BaseModelSize
{
    public float $multiplier;
    public int $length;
    public int $height;
    public int $width;
}
