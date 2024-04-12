<?php

namespace App\ViewModels\Admin\BaseModel;


/**
 * Class for transferring base model's size
 * input from interfaces (views)
 * to the application (services and repositories).
 */
class BaseModelSize
{
    public int $multiplier;
    public int $length;
    public int $height;
    public int $width;

    /**
     * @var string $multiplierInputName the name of the input.
     * It will be used to add errors to the input.
     */
    public string $multiplierInputName;
    public string $lengthInputName;
    public string $heightInputName;
    public string $widthInputName;
}
