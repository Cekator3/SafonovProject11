<?php

namespace App\DTOs\Orders\History;

use DateTime;

/**
 * A subsystem for reading application data specifically
 * to display a history of user's orders.
 */
final class OrderItemListDTO
{
    private string $status;
    private DateTime|null $completed_at = null;

    public function __construct(string $status, string $completedAt = '')
    {
        $this->status = $status;
        if ($completedAt !== '')
            $this->completed_at = new DateTime($completedAt);
    }

    /**
     * Returns the order's completion status
     */
    public function getStatus() : string
    {
        return $this->status;
    }

    /**
     * Returns the order's completion date.
     */
    public function getCompletionDate() : DateTime|null
    {
        return $this->completed_at;
    }
}
