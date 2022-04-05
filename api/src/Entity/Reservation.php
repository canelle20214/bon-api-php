<?php

namespace App\Entity;

use Core\Entity\DefaultEntity;
use DateTime;

class Reservation extends DefaultEntity
{
    private int $id;

    private string $name;
    private string $number;

    private DateTime $dateReservation;

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
     * @param DateTime $dataReservation
     * 
     * @return self
     */
    public function setDateReservation(DateTime $dateReservation): self
    {
        $this->dateReservation = $dateReservation;

        return $this;
    }
    
}