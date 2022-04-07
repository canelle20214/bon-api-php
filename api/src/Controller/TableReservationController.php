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

    /**
     * @OA\Get(
     *  path="/tableReservation",
     *  tags={"Table Reservation"},
     *  @OA\Response(
     *      response=200,
     *      description="Retourne l\' ensemble des tables réservées",
     *      @OA\JsonContent(
     *          description="Toutes les tables réservées",
     *          type="array",
     *          @OA\Items(
     *              ref="#/components/schemas/TableReservation"
     *          )
     *      )
     *  )
     * )
     */

    public function getAll(): void
    {
        $table_reservations = $this->model->findAll();
        $this->jsonResponse($table_reservations, 200);
    }

    /**
     * @param int $id
     * @return void
     *
     * @OA\Get(
     *  path="/tableReservation/{id}",
     *  tags={"Table Reservation"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="ID du table liée à une reservation",
     *      required=true,
     *      @OA\Schema(
     *          type="integer"
     *      )
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="Retourne une table liée à une réservation en fonction de son ID",
     *      @OA\JsonContent(
     *          type="TableReservation",
     *          ref="#/components/schemas/TableReservation"
     *      )
     *  )
     * )
     */


    public function getOne(int $id): void
    {
        $table_reservations = $this->model->find($id);
        $this->jsonResponse($table_reservations, 200);
    }

    /**
     * @param array $data
     * @return void
     *
     * @OA\Post(
     *  path="/tableReservation",
     *  tags={"Table Reservation"},
     *  security={{"Authorization": {}}},
     *  @OA\RequestBody(
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              required={"table_id", "reservation_id"},
     *              @OA\Property(
     *                  property="table_id",
     *                  type="intgeger",
     *              ),
     *              @OA\Property(
     *                  property="reservation_id",
     *                  type="integer"
     *              ),
     *              example={"table_id": 3, "reservation_id": 2}
     *          )
     *      ),
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="Table réservée créée",
     *      @OA\JsonContent(
     *          type="string"
     *      )
     *  )
     * )
     */

    public function save(array $data): void
    {
        $lastId = $this->model->save($data);
        $table_reservations = $this->model->find($lastId);
        (new JWTSecurity)->verifyToken();
        $this->jsonResponse($table_reservations, 201);
    }

    /**
     * @param int $id
     * @param array $data
     * @return void
     *
     * @OA\Put(
     *  path="/tableReservation/{id}",
     *  tags={"Table Reservation"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="ID du la reservation liée à la table à modifier",
     *      required=true,
     *      @OA\Schema(
     *          type="integer"
     *      )
     *  ),
     *  security={{"Authorization": {}}},
     *  @OA\RequestBody(
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              required={"table_id", "reservation_id"},
     *              @OA\Property(
     *                  property="table_id",
     *                  type="intgeger",
     *              ),
     *              @OA\Property(
     *                  property="reservation_id",
     *                  type="integer"
     *              ),
     *              example={"table_id": 3, "reservation_id": 2}
     *          )
     *      ),
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="Table réservée modifiée",
     *      @OA\JsonContent(
     *          type="string"
     *      )
     *  )
     * )
     */

    public function update(int $id, array $data): void
    {
        $this->model->update($id, $data);
        (new JWTSecurity)->verifyToken();
        $this->jsonResponse("Table réservée modifiée", 200);
    }

    /**
     * @param int $id
     * @return void
     *
     * @OA\Delete(
     *  path="/tableReservation/{id}",
     *  tags={"Table Reservation"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="ID de la réservation liée à la table",
     *      required=true,
     *      @OA\Schema(
     *          type="integer"
     *      )
     *  ),
     *  security={{"Authorization": {}}},
     *  @OA\Response(
     *      response=204,
     *      description="Table réservée supprimée",
     *      @OA\JsonContent(
     *          type="string"
     *      )
     *  )
     * )
     */

    public function delete(int $id): void
    {
        $this->model->delete($id);
        (new JWTSecurity)->verifyToken();
        $this->jsonResponse("Table réservée supprimée", 204);
    }
}