<?php
namespace App\Entity;

use OpenApi\Attributes as OA;
use Core\Entity\DefaultEntity;
use JsonSerializable;

#[OA\Schema()]
final class Plat extends DefaultEntity implements JsonSerializable {

    /**
     * @var int
     */
    #[OA\Property(type:"int", property:"id", nullable:false)]
    private int $id;

    /**
     * @var string
     */
    #[OA\Property(property:"nom", type:"string", nullable:false, maximum:100, example:"Nom du plat")]
    private string $nom;

    /**
     * @var float
     */
    #[OA\Property(property:"prix", type:"float", nullable:false, maximum:100, example:"Prix du plat")]
    private float $prix;

    /**
     * @var string
     */
    #[OA\Property(property:"image", type:"string", nullable:false, maximum:100, example:"Image du plat")]
    private string $image;

    /**
     * @var string
     */
    #[OA\Property(property:"description", type:"string", nullable:false, maximum:100, example:"Description du plat")]
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
