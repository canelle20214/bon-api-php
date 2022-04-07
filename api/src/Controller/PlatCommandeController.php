<?php
namespace App\Controller;

use App\Model\PlatCommandeModel;
use Core\Controller\DefaultController;

use App\Security\JWTSecurity;

final class PlatCommandeController extends DefaultController{

    private $model;

    public function __construct()
    {
        $this->model = new PlatCommandeModel;
    }

    /**
     * @OA\Get(
     *  path="/platCommande",
     *  tags={"Plat Commande"},
     *  @OA\Response(
     *      response=200,
     *      description="Retourne l ensemble des plats commandés",
     *      @OA\JsonContent(
     *          description="Tous les plats commandés",
     *          type="array",
     *          @OA\Items(
     *              ref="#/components/schemas/PlatCommande"
     *          )
     *      )
     *  )
     * )
     */
    public function getAll()
    {
        $platsCommande = $this->model->findAll();
        $this->jsonResponse($platsCommande, 200);
    }

    /**
     * @param int $id
     * @return void
     *
     * @OA\Get(
     *  path="/platCommande/{id}",
     *  tags={"Plat Commande"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="ID du plat de la commande",
     *      required=true,
     *      @OA\Schema(
     *          type="integer"
     *      )
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="Retourne un plat d\'une commande en fonction de son ID",
     *      @OA\JsonContent(
     *          type="PlatCommande",
     *          ref="#/components/schemas/PlatCommande"
     *      )
     *  )
     * )
     */

    public function getOne(int $id)
    {
        $platCommande = $this->model->find($id);
        if ($platCommande) {
            $this->jsonResponse($platCommande, 200);
        } else {
            $this->jsonResponse("Cette commande n'existe pas", 404);
        }
    }

    /**
     * @param array $data
     * @return void
     *
     * @OA\Post(
     *  path="/platCommande",
     *  tags={"Plat Commande"},
     *  security={{"Authorization": {}}},
     *  @OA\RequestBody(
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              required={"plat_id", "commande_id"},
     *              @OA\Property(
     *                  property="plat_id",
     *                  type="integer",
     *              ),
     *              @OA\Property(
     *                  property="commande_id",
     *                  type="integer"
     *              ),
     *              example={"plat_id": 18, "commande_id": 3}
     *          )
     *      ),
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="Plat de la commande créé",
     *      @OA\JsonContent(
     *          type="string"
     *      )
     *  )
     * )
     */

    public function save(array $data)
    {
        $lastId = $this->model->save($data);
        $platCommande = $this->model->find($lastId);
        (new JWTSecurity)->verifyToken();
        $this->jsonResponse($platCommande, 201);
    }

    /**
     * @param int $id
     * @param array $data
     * @return void
     *
     * @OA\Put(
     *  path="/platCommande/{id}",
     *  tags={"Plat Commande"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="ID du plat de la commande à modifier",
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
     *              required={"plat_id", "commande_id"},
     *              @OA\Property(
     *                  property="plat_id",
     *                  type="integer",
     *              ),
     *              @OA\Property(
     *                  property="commande_id",
     *                  type="integer"
     *              ),
     *              example={"plat_id": 18, "commande_id": 3}
     *          )
     *      ),
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="Plat de la commande modifié",
     *      @OA\JsonContent(
     *          type="string"
     *      )
     *  )
     * )
     */

    public function update(int $id, array $data) {
        $this->model->update($id, $data);
        (new JWTSecurity)->verifyToken();
        $this->jsonResponse("Plat de la ommmande modifié", 200);
    }

    /**
     * @param int $id
     * @return void
     *
     * @OA\Delete(
     *  path="/platCommande/{id}",
     *  tags={"Plat Commande"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="ID du plat dans la commande",
     *      required=true,
     *      @OA\Schema(
     *          type="integer"
     *      )
     *  ),
     *  security={{"Authorization": {}}},
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
     *          example="Ce plat de la commande n'existe pas/plus"
     *      )
     *  )
     * )
     */
    public function delete(int $id) {
        $platCommande = $this->model->find($id);
        if ($platCommande) {
            $this->model->delete($id);
            (new JWTSecurity)->verifyToken();
            $this->jsonResponse("Commande supprimé", 204);
        } else {
            $this->jsonResponse("Ce plat de la commande n'existe pas/plus", 404);
        }
    }
}
