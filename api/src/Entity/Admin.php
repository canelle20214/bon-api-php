<?php
namespace App\Entity;

use Core\Entity\DefaultEntity;
use JsonSerializable;

final class Admin extends DefaultEntity implements JsonSerializable{

    // php@8.1
    // private readonly int $id;

    // php@8.0
    private int $id;

    private string $nom;

    private string $mail;
    
    private float $password;

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            "mail" => $this->mail,
            "password" => $this->password
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
     * Get the value of mail
     *
     * @return string
     */
    public function getMail(): string
    {
        return $this->mail;
    }

    /**
     * Get the value of password
     *
     * @return float
     */
    public function getPassword(): float
    {
        return $this->password;
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
     * Get the value of mail
     *
     * @return self
     */
    public function setMail(string $mail): self
    {
        $this->mail = $mail;
        return $this;
    }

    /**
     * Get the value of password
     *
     * @return self
     */
    public function setPassword(float $password): self
    {
        $this->password = $password;
        return $this;
    }
}
