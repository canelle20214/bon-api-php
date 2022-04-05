<?php
namespace App\Security;

use App\Entity\Admin;
use DateInterval;
use DateTime;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTSecurity {

    private string $key = "fourmi";

    private array $payload;

    public function sendToken (Admin $admin): string
    {
        $date = new DateTime();

        // PT3H = 3h
        $exp = $date->add(new DateInterval("PT3H"));
        $this->payload = [
            "iss" => "bonApi",
            "exp" => $exp,
            "role" => "admin"
        ];

        return JWT::encode($this->payload, $this->key, 'HS256');
    }

    public function verifyToken(string $token): bool
    {
        $decode = JWT::decode($token, new Key($this->key, 'HS256'));
        //var_dump($decode);
        //die();
    }

}
