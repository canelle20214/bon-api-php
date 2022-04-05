<?php
namespace App\Entity;

use Core\Entity\DefaultEntity;
use JsonSerializable;

final class Plat extends DefaultEntity implements JsonSerializable {

    // php@8.1
    /**
     * @var int
     */
    //private readonly int $id;

    // php@8.0
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $nom;

    /**
     * @var float
     */
    private float $prix;

    /**
     * @var string
     */
    private string $image;

    /**
     * @var string
     */
    private string $description;

    /**
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'prix' => $this->prix,
            'image' => $this->image,
            'description' => $this->description
        ];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return float
     */
    public function getPrix(): float
    {
        return $this->prix;
    }

    /**
     * @param float $prix
     */
    public function setPrix(float $prix): void
    {
        $this->prix = $prix;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}
