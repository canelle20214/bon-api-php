<?php

namespace App\Entity;

use Core\Entity\DefaultEntity;
use JsonSerializable;

final class TableReservation extends DefaultEntity implements JsonSerializable
{
    private int $id;
    private int $reservation_id;
    private int $tables_id;

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'reservation_id' => $this->reservation_id,
            "tables_id" => $this->tables_id
        ];
    }

   /**
     * Get the value of id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function getReservation(): int
    {
        return $this->reservation_id;
    }

    public function setReservation(int $reservation_id): self
    {
        $this->reservation_id = $reservation_id;

        return $this;
    }

    public function getTables(): int
    {
        return $this->tables_id;
    }

    public function setTables(int $tables_id): self
    {
        $this->tables_id = $tables_id;

        return $this;
    }
}