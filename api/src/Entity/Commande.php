<?php
namespace App\Entity;

use Core\Entity\DefaultEntity;
use JsonSerializable;

final class Commande extends DefaultEntity implements JsonSerializable{

    // php@8.1
    // private readonly int $id;

    // php@8.0
    private int $id;

    private string $nom;

    private string $reference;
    
    private float $prix;
    
    private string $status;
    
    private string $insertion;

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            "reference" => $this->reference,
            "prix" => $this->prix,
            "status" => $this->status,
            "insertion" => $this->insertion
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
     * Get the value of reference
     *
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * Get the value of prix
     *
     * @return float
     */
    public function getPrix(): float
    {
        return $this->prix;
    }

    /**
     * Get the value of status
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Get the value of insertion
     *
     * @return string
     */
    public function getInsertion(): string
    {
        return $this->insertion;
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
     * Get the value of reference
     *
     * @return self
     */
    public function setReference(string $reference): self
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * Get the value of prix
     *
     * @return self
     */
    public function setPrix(float $prix): self
    {
        $this->prix = $prix;
        return $this;
    }

    /**
     * Get the value of status
     *
     * @return self
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get the value of insertion
     *
     * @return self
     */
    public function setInsertion(string $insertion): self
    {   $this->insertion = $insertion;
        return $this;
    }


}
