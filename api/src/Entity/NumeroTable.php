<?php
namespace App\Entity;

use Core\Entity\DefaultEntity;
use JsonSerializable;

/**
 * @OA\Schema()
 */
final class NumeroTable extends DefaultEntity implements JsonSerializable{

    /**
     * @var int
     * @OA\Property(type="integer", property="id", nullable=false)
     */
    private int $id;

    /**
     * @var int
     * @OA\Property(type="integer", property="nombre_de_personnes", nullable=false)
     */
    private string $nombre_de_personnes;
    
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
     * Get the value of int
     *
     * @return int
     */
    public function getNombrePersonnes(): int
    {
        return $this->nombre_de_personnes;
    }

    /**
     * Set the value of name
     *
     * @param int $nombre_de_personnes
     *
     * @return self
     */
    public function setNombrePersonnes(int $nombre_de_personnes): self
    {
        $this->nombre_de_personnes = $nombre_de_personnes;

        return $this;
    }
    
    
    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'nombre_de_personnes' => $this->nombre_de_personnes
        ];
    }


}