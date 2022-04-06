<?php
namespace App\Security;

use App\Entity\Admin;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTSecurity {

    private string $key = "fourmi";

    private string $algo = 'HS256';

    private array $payload;

    public function sendToken (Admin $admin): string
    {
        $this->payload = [
            "iss" => "bonApi",
            "role" => "admin"
        ];

        return JWT::encode($this->payload, $this->key, $this->algo);
    }

    public function verifyToken(): bool {
        if (isset($_COOKIE['token']) && !empty($_COOKIE['token'])) {
            $token = $_COOKIE['token'];
            JWT::$leeway = 60;
            $decode = JWT::decode($token, new Key($this->key, $this->algo));
            if ($decode) {
                return (array) $decode;
            }
        } else {
            throw new \Exception("Vous n'avez pas la permission pour acceder à cette page", 403);
        }
        return true;
    }

}
