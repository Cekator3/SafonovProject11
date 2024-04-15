<?php

namespace App\DTOs\Orders\History;

use DateTime;

/**
 * A subsystem for reading application data about order from user's orders history.
 */
class OrderDTO
{
    private string $status;
    private DateTime|null $completed_at = null;
    /**
     * @var ModelDTO[]
     */
    private array $models;

    /**
     * @param ModelDTO[] $models
     */
    public function __construct(string $status, string $completedAt, array $models)
    {
        $this->status = $status;
        $this->models = $models;
        if ($completedAt !== '')
            $this->completed_at = new DateTime($completedAt);
    }

    /**
     * Returns the order's status
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

    /**
     * Returns the order's models.
     *
     * @return ModelDTO[]
     */
    public function getModels() : array
    {
        return $this->models;
    }
}
