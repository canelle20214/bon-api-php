<?php
namespace App\Entity;

use Core\Entity\DefaultEntity;
use JsonSerializable;

/**
 * @OA\Schema()
 */
final class PlatCommande extends DefaultEntity implements JsonSerializable {

    // php@8.1
    /**
     * @var int
     */
    //private readonly int $id;

    // php@8.0
    /**
     * @var int
     * @OA\Property(type="integer", property="id", nullable=false)
     */
    private int $id;

    /**
     * @var int
     * @OA\Property(type="integer", property="plat_id", nullable=false)
     */
    private int $plat_id;

    /**
     * @var int
     * @OA\Property(type="integer", property="commande_id", nullable=false)
     */
    private int $commande_id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getPlatId(): int
    {
        return $this->plat_id;
    }

    /**
     * @param int $command_id
     */
    public function setPlatId(string $plat_id): void
    {
        $this->plat_id = $plat_id;
    }

    /**
     * @return int
     */
    public function getCommandeId(): int
    {
        return $this->commande_id;
    }

    /**
     * @param int $commande_id
     */
    public function setCommandeId(string $commande_id): void
    {
        $this->commande_id = $commande_id;
    }

    /**
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        return [
            'id' => $this->id,
            'plat_id' => $this->plat_id,
            'commande_id' => $this->commande_id,
        ];
    }
}
