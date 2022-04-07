<?php

namespace App\Controller;

use App\Model\ReservationModel;

use App\Security\JWTSecurity;

use Core\Controller\DefaultController;

final class ReservationController extends DefaultController
{
    private $model;

    public function __construct()
    {
        $this->model = new ReservationModel;

        // (new JWTSecurity)->verifyToken();

    }

    public function getAll(): void
    {
        $reservations = $this->model->findAll();
        $this->jsonResponse($reservations, 200);
    }

    public function getOne(int $id): void
    {
        $reservation = $this->model->find($id);
        $this->jsonResponse($reservation, 200);
    }

    public function save(array $data): void
    {
        $lastId = $this->model->save($data);
        $reservation = $this->model->find($lastId);
        (new JWTSecurity)->verifyToken();
        $this->jsonResponse($reservation, 201);
    }

    public function update(int $id, array $data): void
    {
        $this->model->update($id, $data);
        (new JWTSecurity)->verifyToken();
        $this->jsonResponse("Réservation modifiée", 201);
    }

    public function delete(int $id): void
    {
        $this->model->delete($id);
        (new JWTSecurity)->verifyToken();
        $this->jsonResponse("Réservation supprimée", 200);
    }
}
