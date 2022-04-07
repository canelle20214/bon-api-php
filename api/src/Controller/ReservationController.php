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

    /**
     * @OA\Get(
     *  path="/reservation",
     *  tags={"Reservation"},
     *  @OA\Response(
     *      response=200,
     *      description="Retourne l ensemble des reservations",
     *      @OA\JsonContent(
     *          description="Toutes les reservations",
     *          type="array",
     *          @OA\Items(
     *              ref="#/components/schemas/Reservation"
     *          )
     *      )
     *  )
     * )
     */

    public function getAll(): void
    {
        $reservations = $this->model->findAll();
        $this->jsonResponse($reservations, 200);
    }

    /**
     * @param int $id
     * @return void
     *
     * @OA\Get(
     *  path="/reservation/{id}",
     *  tags={"Reservation"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="ID de la reservation",
     *      required=true,
     *      @OA\Schema(
     *          type="integer"
     *      )
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="Retourne une reservation en fonction de son ID",
     *      @OA\JsonContent(
     *          type="Reservation",
     *          ref="#/components/schemas/Reservation"
     *      )
     *  )
     * )
     */

    public function getOne(int $id): void
    {
        $reservation = $this->model->find($id);
        $this->jsonResponse($reservation, 200);
    }

    /**
     * @param array $data
     * @return void
     *
     * @OA\Post(
     *  path="/reservation",
     *  tags={"Reservation"},
     *  security={{"Authentication": {}}},
     *  @OA\RequestBody(
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              required={"nom", "nombre", "creneaux"},
     *              @OA\Property(
     *                  property="nom",
     *                  type="string",
     *              ),
     *              @OA\Property(
     *                  property="nombre",
     *                  type="integer"
     *              ),
     *              @OA\Property(
     *                  property="creneaux",
     *                  type="string"
     *              ),
     *              example={"nom": "John Doe", "creneaux": "2022-03-04 19:45", "nombre": 5}
     *          )
     *      ),
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="Réservation créée",
     *      @OA\JsonContent(
     *          type="string"
     *      )
     *  )
     * )
     */

    public function save(array $data): void
    {
        $lastId = $this->model->save($data);
        $reservation = $this->model->find($lastId);
        (new JWTSecurity)->verifyToken();
        $this->jsonResponse($reservation, 201);
    }

    /**
     * @param int $id
     * @param array $data
     * @return void
     *
     * @OA\Put(
     *  path="/reservation/{id}",
     *  tags={"Reservation"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="ID de la reservation à modifier",
     *      required=true,
     *      @OA\Schema(
     *          type="integer"
     *      )
     *  ),
     *  security={{"Authentication": {}}},
     *  @OA\RequestBody(
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              required={"nom", "nombre", "creneaux"},
     *              @OA\Property(
     *                  property="nom",
     *                  type="string",
     *              ),
     *              @OA\Property(
     *                  property="nombre",
     *                  type="integer"
     *              ),
     *              @OA\Property(
     *                  property="creneaux",
     *                  type="string"
     *              ),
     *              example={"nom": "John Doe", "creneaux": "2022-03-04 19:45", "nombre": 5}
     *          )
     *      ),
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="Réservation modifiée",
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
        $this->jsonResponse("Réservation modifiée", 200);
    }

    /**
     * @param int $id
     * @return void
     *
     * @OA\Delete(
     *  path="/reservation/{id}",
     *  tags={"Reservation"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="ID de la reservation",
     *      required=true,
     *      @OA\Schema(
     *          type="integer"
     *      )
     *  ),
     *  security={{"Authentication": {}}},
     *  @OA\Response(
     *      response=204,
     *      description="Réservation supprimée",
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
        $this->jsonResponse("Réservation supprimée", 204);
    }
}
