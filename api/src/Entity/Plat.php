<?php
namespace App\Entity;

use Core\Entity\DefaultEntity;

final class Plat extends DefaultEntity{

    // php@8.1
    /**
     * @var int
     */
    private readonly int $id;

    // php@8.0
    //private int $id;

    /**
     * @var string
     */
    private string $nom;

    /**
     * @var int
     */
    private int $prix;

    /**
     * @var string
     */
    private string $image;

    /**
     * @var string
     */
    private string $description;

    /**
     * @return array
     */
    public function __invoke() {
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
     * @return int
     */
    public function getPrix(): int
    {
        return $this->prix;
    }

    /**
     * @param int $prix
     */
    public function setPrix(int $prix): void
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
