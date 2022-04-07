<?php
namespace App\Controller;

use App\Model\NumeroTableModel;

use App\Security\JWTSecurity;

use Core\Controller\DefaultController;

final class NumeroTableController extends DefaultController{

    private $model;

    public function __construct()
    {
        $this->model = new NumeroTableModel;

        // (new JWTSecurity)->verifyToken();
    }

    /**
     * @OA\Get(
     *  path="/numeroTable",
     *  tags={"Table"},
     *  @OA\Response(
     *      response=200,
     *      description="Retourne l ensemble des tables",
     *      @OA\JsonContent(
     *          description="Tables du restaurant",
     *          type="array",
     *          @OA\Items(
     *              ref="#/components/schemas/NumeroTable"
     *          )
     *      )
     *  )
     * )
     */
    public function getAll()
    {
        $numeroTable = $this->model->findAll();
        $this->jsonResponse($numeroTable, 200);
    }

    /**
     * @param int $id
     * @return void
     *
     * @OA\Get(
     *  path="/numeroTable/{id}",
     *  tags={"Table"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="ID de la table",
     *      required=true,
     *      @OA\Schema(
     *          type="integer"
     *      )
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="Retourne une table en fonction de son ID",
     *      @OA\JsonContent(
     *          type="NumeroTable",
     *          ref="#/components/schemas/NumeroTable"
     *      )
     *  )
     * )
     */
    public function getOne(int $id)
    {
        $numeroTable = $this->model->find($id);
        $this->jsonResponse($numeroTable, 200);
    }

    /**
     * @param array $data
     * @return void
     *
     * @OA\Post(
     *  path="/numeroTable",
     *  tags={"Table"},
     *  security={{"Authentication": {}}},
     *  @OA\RequestBody(
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              required={"nombre_de_personnes"},
     *              @OA\Property(
     *                  property="nombre_de_personnes",
     *                  type="integer",
     *              ),
     *              example={"nombre_de_personnes": 3}
     *          )
     *      ),
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="Table créée",
     *      @OA\JsonContent(
     *          type="string"
     *      )
     *  )
     * )
     */

    public function save(array $data)
    {
        $lastId = $this->model->save($data);
        $numeroTable = $this->model->find($lastId);
        (new JWTSecurity)->verifyToken();
        $this->jsonResponse($numeroTable, 201);
    }

    /**
     * @param int $id
     * @param array $data
     * @return void
     *
     * @OA\Put(
     *  path="/numeroTable/{id}",
     *  tags={"Table"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="ID de la table à modifier",
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
     *              required={"nombre_de_personnes"},
     *              @OA\Property(
     *                  property="nombre_de_personnes",
     *                  type="integer",
     *              ),
     *              example={"nombre_de_personnes": 3}
     *          )
     *      ),
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="Table modifiée",
     *      @OA\JsonContent(
     *          type="string"
     *      )
     *  )
     * )
     */

    public function update(int $id, array $data) {
        $this->model->update($id, $data);
        (new JWTSecurity)->verifyToken();
        $this->jsonResponse("Table modifiée", 200);
    }

    /**
     * @param int $id
     * @return void
     *
     * @OA\Delete(
     *  path="/numeroTable/{id}",
     *  tags={"Table"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="ID de la table",
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
     *  ),
     *  @OA\Response(
     *      response=404,
     *      description="Erreur de récupération",
     *      @OA\JsonContent(
     *          description="Message d erreur",
     *          type="string",
     *          example="Cette table n'existe pas/plus"
     *      )
     *  )
     * )
     */
    public function delete(int $id) {
        $numeroTable = $this->model->find($id);
        if ($numeroTable) {
            $this->model->delete($id);
            (new JWTSecurity)->verifyToken();
            $this->jsonResponse("Table supprimé", 204);
        } else {
            $this->jsonResponse("Cette table n'existe pas/plus", 404);
        }
    }
}
