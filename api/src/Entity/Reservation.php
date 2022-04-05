<?php

namespace App\Entity;

use Core\Entity\DefaultEntity;
use DateTime;
use JsonSerializable;

final class Reservation extends DefaultEntity implements JsonSerializable
{
    private int $id;

    private string $name;
    private string $number;

    private DateTime $dateReservation;

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            "number" => $this->number,
            "dateReservation" => $this->dateReservation,
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

    /**
     * Get the value of name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    
    /**
     * Set the value of name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of number
     * 
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * Set the value of number
     * 
     * @param int $number
     * 
     * @return self
     */
    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get the value of dateReservation
     * 
     * @return DateTime
     */
    public function getDateReservation(): DateTime
    {
        return $this->dateReservation;
    }

    /**
     * Set the value of date reservation
     * 
     * @param DateTime $dateReservation
     * 
     * @return self
     */
    public function setDateReservation(DateTime $dateReservation): self
    {
        $this->dateReservation = $dateReservation;

        return $this;
    }
    
}