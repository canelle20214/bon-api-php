<?php

namespace App\Entity;

use Core\Entity\DefaultEntity;
use JsonSerializable;

final class TableReservation extends DefaultEntity implements JsonSerializable
{
    private int $id;
    private Reservation $reservation_id;
    private NumeroTable $numero_de_table_id;

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'reservation_id' => $this->reservation_id,
            "numero_de_table_id" => $this->numero_de_table_id
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

    public function getReservation(): Reservation
    {
        return $this->reservation_id;
    }

    public function setReservation(Reservation $reservation_id): self
    {
        $this->reservation_id = $reservation_id;

        return $this;
    }

    public function getTables(): NumeroTable
    {
        return $this->numero_de_table_id;
    }

    public function setTables(NumeroTable $numero_de_table_id): self
    {
        $this->numero_de_table_id = $numero_de_table_id;

        return $this;
    }
}