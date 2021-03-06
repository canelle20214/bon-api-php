<?php
namespace App\Controller;

use App\Model\PlatModel;
use App\Security\JWTSecurity;
use Core\Controller\DefaultController;
use Exception;

/**
 * @OA\Info(title="Bon-API", version="v0")
 * @OA\Server(url="http://localhost:8000/api/v0")
 * @OA\Tag(
 *  name="Plat",
 *  description="Routes liées aux plats"
 * )
 * @OA\SecurityScheme(
 *   securityScheme="Authorization",
 *   type="http",
 *   scheme="bearer",
 *   bearerFormat = "JWT"
 * )
 */

final class PlatController extends DefaultController{

    private PlatModel $model;

    public function __construct()
    {
        $this->model = new PlatModel;
    }

    /**
     * @OA\Get(
     *  path="/plat",
     *  tags={"Plat"},
     *  @OA\Response(
     *      response=200,
     *      description="Retourne l ensemble des plats",
     *      @OA\JsonContent(
     *          description="Contenu de notre menu",
     *          type="array",
     *          @OA\Items(
     *              ref="#/components/schemas/Plat"
     *          )
     *      )
     *  )
     * )
     */
    public function getAll()
    {
        $plats = $this->model->findAll();
        $this->jsonResponse($plats, 200);
    }

    /**
     * @param int $id
     * @return void
     *
     * @OA\Get(
     *  path="/plat/{id}",
     *  tags={"Plat"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="ID du plat",
     *      required=true,
     *      @OA\Schema(
     *          type="integer"
     *      )
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="Retourne un plat en fonction de son ID",
     *      @OA\JsonContent(
     *          type="Plat",
     *          ref="#/components/schemas/Plat"
     *      )
     *  )
     * )
     */
    public function getOne(int $id)
    {
        $plat = $this->model->find($id);
        if ($plat) {
            $this->jsonResponse($plat, 200);
        } else {
            $this->jsonResponse("Ce plat n'existe pas", 404);
        }
    }

    /**
     * @param array $data
     * @return void
     *
     * @OA\Post(
     *  path="/plat",
     *  tags={"Plat"},
     *  @OA\RequestBody(
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              required={"name", "prix", "image", "description"},
     *              @OA\Property(
     *                  property="name",
     *                  type="string",
     *              ),
     *              @OA\Property(
     *                  property="prix",
     *                  type="float"
     *              ),
     *              @OA\Property(
     *                  property="image",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="description",
     *                  type="string"
     *              ),
     *              example={"name": "Nom du plat", "prix": 26.2, "image": "Image d un plat", "description": "Descripion du plat"}
     *          )
     *      ),
     *  ),
     *  security={{"Authorization": {}}},
     *  @OA\Response(
     *      response=201,
     *      description="Retourne le plat nouvellement crée",
     *      @OA\JsonContent(
     *          type="Plat",
     *          ref="#/components/schemas/Plat"
     *      )
     *  )
     * )
     * @throws Exception
     */
    public function save(array $data) {
        (new JWTSecurity)->verifyToken();
        $lastId = $this->model->save($data);
        $plat = $this->model->find($lastId);
        $this->jsonResponse($plat, 201);
    }

    /**
     * @param int $id
     * @param array $data
     * @return void
     *
     * @OA\Put(
     *  path="/plat/{id}",
     *  tags={"Plat"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="ID du plat à modifier",
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
     *              required={"name", "prix", "image", "description"},
     *              @OA\Property(
     *                  property="name",
     *                  type="string",
     *              ),
     *              @OA\Property(
     *                  property="prix",
     *                  type="float"
     *              ),
     *              @OA\Property(
     *                  property="image",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="description",
     *                  type="string"
     *              ),
     *              example={"name": "Nom du plat", "prix": 26.2, "image": "Image d un plat", "description": "Descripion du plat"}
     *          )
     *      ),
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="Plat modifié",
     *      @OA\JsonContent(
     *          type="string"
     *      )
     *  )
     * )
     */

    public function update(int $id, array $data) {
        $this->model->update($id, $data);
        (new JWTSecurity)->verifyToken();
        $this->jsonResponse("Plat modifié", 200);
    }

    /**
     * @param int $id
     * @return void
     *
     * @OA\Delete(
     *  path="/plat/{id}",
     *  tags={"Plat"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="ID du plat",
     *      required=true,
     *      @OA\Schema(
     *          type="integer"
     *      )
     *  ),
     *  security={{"Authorization": {}}},
     *  @OA\Response(
     *      response=204,
     *      description="Plat supprimé",
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
     *          example="Ce plat n'existe pas/plus"
     *      )
     *  )
     * )
     */
    public function delete(int $id) {
        $plat = $this->model->find($id);
        if ($plat) {
            $this->model->delete($id);
            (new JWTSecurity)->verifyToken();
            $this->jsonResponse("Plat supprimé", 204);
        } else {
            $this->jsonResponse("Ce plat n'existe pas/plus", 404);
        }
    }
}
