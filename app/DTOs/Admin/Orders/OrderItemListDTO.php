<?php

namespace App\DTOs\Admin\Orders;

use DateTime;
use App\Enums\OrderStatus;

/**
 * A subsystem for reading application data specifically
 * to display a list of orders (administrator).
 */
class OrderItemListDTO
{
    // User's info
    private string $userEmail;
    // Order's info
    private OrderStatus $status;
    private DateTime $payedAt;
    private DateTime $completedAt;

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
