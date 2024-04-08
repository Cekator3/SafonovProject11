<?php

namespace App\DTOs\Admin\FilamentTypes;

use App\DTOs\Admin\PrintingTechnologies\PrintingTechnologyNameOnlyDTO;

/**
 * A subsystem for reading application data specifically
 * to display a list of filament types.
 */
class FilamentTypeItemListDTO
{
    private int $id = -1;
    private string $name = '';
    /**
     * @var PrintingTechnologyNameOnlyDTO[]
     */
    private array $printingTechnologies;


    /**
     * @param PrintingTechnologyNameOnlyDTO[] $printingTechnologies
     */
    public function __construct(int $id,
                                string $name,
                                array $printingTechnologies)
    {
        $this->id = $id;
        $this->name = $name;
        $this->printingTechnologies = $printingTechnologies;
    }

    /**
     * Returns the id of the additional service
     */
    public function getId() : int
    {
        assert($this->id !== -1, 'accessing not initialized property: $id');
        return $this->id;
    }

    /**
     * Returns the name of the additional service
     */
    public function getName() : string
    {
        assert($this->name !== '', 'accessing not initialized property: $name');
        return $this->name;
    }

    /**
     * Returns the printing technologies in which that filament type is used
     *
     * @return PrintingTechnologyNameOnlyDTO[]
     */
    public function getPrintingTechnologies() : array
    {
        return $this->printingTechnologies;
    }
}
