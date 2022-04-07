<?php
namespace App\Controller;

use App\Model\CommandeModel;
use App\Security\JWTSecurity;
use Core\Controller\DefaultController;

final class CommandeController extends DefaultController{

    private $model;

    public function __construct()
    {
        $this->model = new CommandeModel;
        // (new JWTSecurity)->verifyToken();
    }

    /**
     * @OA\Get(
     *  path="/commande",
     *  tags={"Commande"},
     *  @OA\Response(
     *      response=200,
     *      description="Retourne l ensemble des commandes",
     *      @OA\JsonContent(
     *          description="Toutes les commandes",
     *          type="array",
     *          @OA\Items(
     *              ref="#/components/schemas/Commande"
     *          )
     *      )
     *  )
     * )
     */

    public function getAll()
    {
        $data = $this->model->findAll();
        $this->jsonResponse($data, 200);
    }

    /**
     * @param int $id
     * @return void
     *
     * @OA\Get(
     *  path="/commande/{id}",
     *  tags={"Commande"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="ID de la commande",
     *      required=true,
     *      @OA\Schema(
     *          type="integer"
     *      )
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="Retourne une commande en fonction de son ID",
     *      @OA\JsonContent(
     *          type="Commande",
     *          ref="#/components/schemas/Commande"
     *      )
     *  )
     * )
     */

    public function getOne(int $id)
    {
        $data = $this->model->find($id);
        $this->jsonResponse($data, 200);

    }

    /**
     * @param array $data
     * @return void
     *
     * @OA\Post(
     *  path="/commande",
     *  tags={"Commande"},
     *  @OA\RequestBody(
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              required={"nom", "reference", "prix", "status"},
     *              @OA\Property(
     *                  property="nom",
     *                  type="string",
     *              ),
     *              @OA\Property(
     *                  property="reference",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="prix",
     *                  type="float"
     *              ),
     *              @OA\Property(
     *                  property="status",
     *                  type="string"
     *              ),
     *              example={"nom": "John Doe", "status": "en cours de préparation", "reference": "RA34FS3UTS", "prix": 62.10}
     *          )
     *      ),
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="Commande crée",
     *      @OA\JsonContent(
     *          type="string"
     *      )
     *  )
     * )
     */

    public function save (array $params)
    {
        $lastId = $this->model->save($params);
        $data = $this->model->find($lastId);
        (new JWTSecurity)->verifyToken();
        $this->jsonResponse($data, 201);
    }

    /**
     * @param int $id
     * @param array $data
     * @return void
     *
     * @OA\Put(
     *  path="/commande/{id}",
     *  tags={"Commande"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="ID de la commande à modifier",
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
     *              required={"nom", "reference", "prix", "status"},
     *              @OA\Property(
     *                  property="nom",
     *                  type="string",
     *              ),
     *              @OA\Property(
     *                  property="reference",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="prix",
     *                  type="float"
     *              ),
     *              @OA\Property(
     *                  property="status",
     *                  type="string"
     *              ),
     *              example={"nom": "John Doe", "status": "en cours de préparation", "reference": "RA34FS3UTS", "prix": 62.10}
     *          )
     *      ),
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="Commande modifiée",
     *      @OA\JsonContent(
     *          type="string"
     *      )
     *  )
     * )
     */

    public function update(int $id, array $params){
        $lastId = $this->model->update($id, $params);
        $data = $this->model->find($lastId);
        (new JWTSecurity)->verifyToken();
        $this->jsonResponse($data, 200);
    }

    /**
     * @param int $id
     * @return void
     *
     * @OA\Delete(
     *  path="/commande/{id}",
     *  tags={"Commande"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="ID de la commande",
     *      required=true,
     *      @OA\Schema(
     *          type="integer"
     *      )
     *  ),
     *  security={{"Authentication": {}}},
     *  @OA\Response(
     *      response=204,
     *      description="Suppression réussie",
     *      @OA\JsonContent(
     *          type="string"
     *      )
     *  )
     * )
     */

    public function delete(int $id){
        $this->model->delete($id);
        (new JWTSecurity)->verifyToken();
        $this->jsonResponse("Commande supprimée.", 204);
    }
}
