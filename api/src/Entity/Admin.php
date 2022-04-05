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
    
    private string $password;

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
     * @return string
     */
    public function getMail(): string
    {
        return $this->mail;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $nom
     * @return $this
     */
    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @param string $mail
     * @return $this
     */
    public function setMail(string $mail): self
    {
        $this->mail = $mail;
        return $this;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }
}
