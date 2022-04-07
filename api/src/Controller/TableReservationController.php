<?php

namespace App\Controller;

use App\Model\TableReservationModel;
use Core\Controller\DefaultController;
use App\Security\JWTSecurity;

final class TableReservationController extends DefaultController
{
    private $model;

    public function __construct()
    {
        $this->model = new TableReservationModel;
    }

    public function getAll(): void
    {
        $table_reservations = $this->model->findAll();
        $this->jsonResponse($table_reservations, 200);
    }


    public function getOne(int $id): void
    {
        $table_reservations = $this->model->find($id);
        $this->jsonResponse($table_reservations, 200);
    }

    public function save(array $data): void
    {
        $lastId = $this->model->save($data);
        $table_reservations = $this->model->find($lastId);
        (new JWTSecurity)->verifyToken();
        $this->jsonResponse($table_reservations, 201);
    }

    public function update(int $id, array $data): void
    {
        $this->model->update($id, $data);
        (new JWTSecurity)->verifyToken();
        $this->jsonResponse("Table réservée modifiée", 201);
    }

    public function delete(int $id): void
    {
        $this->model->delete($id);
        (new JWTSecurity)->verifyToken();
        $this->jsonResponse("Table réservée supprimée", 200);
    }
}