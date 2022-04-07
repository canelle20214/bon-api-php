<?php

namespace App\Entity;

use Core\Entity\DefaultEntity;
use JsonSerializable;

/**
 * @OA\Schema()
 */
final class Reservation extends DefaultEntity implements JsonSerializable
{
    /**
     * @var int
     * @OA\Property(type="integer", property="id", nullable=false)
     */
    private int $id;

    /**
     * @var string
     * @OA\Property(type="string", property="nom", nullable=false)
     */
    private string $nom;
    
    /**
     * @var int
     * @OA\Property(type="integer", property="nombre", nullable=false)
     */
    private int $nombre;

    /**
     * @var string
     * @OA\Property(type="string", property="creneaux", nullable=false)
     */
    private string $creneaux;

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            "nombre" => $this->nombre,
            "creneaux" => $this->creneaux,
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
     * Get the value of nom
     *
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }
    
    /**
     * Set the value of nom
     *
     * @param string $nom
     *
     * @return self
     */
    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of nombre
     * 
     * @return int
     */
    public function getNombre(): int
    {
        return $this->nombreReservation;
    }

    /**
     * Set the value of nombre
     * 
     * @param int $nombre
     * 
     * @return self
     */
    public function setNombre(int $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of creneaux
     * 
     * @return string
     */
    public function getCreneaux(): string
    {
        return $this->creneaux;
    }

    /**
     * Set the value of creneaux
     * 
     * @param string $creneaux
     * 
     * @return self
     */
    public function setCreneaux(string $creneaux): self
    {
        $this->creneaux = $creneaux;

        return $this;
    }
}