<?php
namespace Core\Trait;

trait JsonTrait {

    /**
     * Envoie les informations au format json
     *
     * @param mixed $data
     * @param integer $responseCode
     * @return void
     */
    public static function jsonResponse (mixed $data, int $responseCode)
    {
        header("Content-type: application/json");
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET POST PUT DELETE OPTIONS");
        header("Access-Control-Allow-Credentials: true");
        http_response_code($responseCode);

        echo json_encode($data);
    }
}
