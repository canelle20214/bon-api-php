<?php
namespace App\Controller;

use App\Model\AdminModel;
use App\Security\JWTSecurity;
use Core\Controller\DefaultController;

/**
 * @OA\Tag(
 *  name="Admin",
 *  description="Routes liées aux admins"
 * )
 */
final class AdminController extends DefaultController{

    private AdminModel $model;

    public function __construct()
    {
        $this->model = new AdminModel;
    }

    /**
     * @OA\Post(
     *  path="/admin/login",
     *  tags={"Admin"},
     *  @OA\RequestBody(
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              required={"mail", "password"},
     *              @OA\Property(
     *                  property="mail",
     *                  type="string",
     *              ),
     *              @OA\Property(
     *                  property="password",
     *                  type="string"
     *              ),
     *              example={"mail": "monmail@gmail.com", "password": "123456789"}
     *          )
     *      ),
     *  ),
     *  @OA\Response(
     *      response=201,
     *      description="Retourne l\'admin connecté.",
     *      @OA\JsonContent(
     *          type="Admin",
     *          ref="#/components/schemas/Admin"
     *      )
     *  ),
     *  @OA\Response(
     *      response=404,
     *      description="Erreur de récupération",
     *      @OA\JsonContent(
     *          description="Message d erreur",
     *          type="string",
     *          example="Invalid request method"
     *      )
     *  )
     * ),
     *  @OA\Response(
     *      response=404,
     *      description="Erreur de récupération",
     *      @OA\JsonContent(
     *          description="Message d erreur",
     *          type="string",
     *          example="Unauthorized"
     *      )
     *  )
     */

    public function login (array $data)
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $admin = $this->model->findOneBy(["mail" => $data['mail']]);
            if ($admin && password_verify($data['password'], $admin->getPassword())) {
                $token = (new JWTSecurity)->sendToken($admin);
                self::jsonResponse($token, 200);
            }else{
                self::jsonResponse("Unauthorized", 403);
            }

        } else {
            throw new \Exception("Invalid request method", 404);
            
        }
    }

    /**
     * @OA\Get(
     *  path="/admin",
     *  tags={"Admin"},
     *  @OA\Response(
     *      response=200,
     *      description="Retourne l ensemble des admins",
     *      @OA\JsonContent(
     *          description="Liste des admins",
     *          type="array",
     *          @OA\Items(
     *              ref="#/components/schemas/Admin"
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
     *  path="/admin/{id}",
     *  tags={"Admin"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="ID de l\'admin",
     *      required=true,
     *      @OA\Schema(
     *          type="integer"
     *      )
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="Retourne un admin en fonction de son ID",
     *      @OA\JsonContent(
     *          type="Admin",
     *          ref="#/components/schemas/Admin"
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
     * @OA\Post(
     *  path="/admin",
     *  tags={"Admin"},
     *  @OA\RequestBody(
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              required={"mail", "password", "nom"},
     *              @OA\Property(
     *                  property="mail",
     *                  type="string",
     *              ),
     *              @OA\Property(
     *                  property="password",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="nom",
     *                  type="string"
     *              ),
     *              example={"mail": "monmail@gmail.com", "password": "123456789", "nom": "John Doe"}
     *          )
     *      ),
     *  ),
     *  @OA\Response(
     *      response=201,
     *      description="Retourne l\'admin créé.",
     *      @OA\JsonContent(
     *          type="Admin",
     *          ref="#/components/schemas/Admin"
     *      )
     *  )
     * )
     */

    public function save (array $params)
    {
        $params['password'] = password_hash($params["password"], PASSWORD_DEFAULT);
        $this->model->save($params);
        self::jsonResponse("Admin crée", 201);
    }

    /**
     * @param int $id
     * @param array $data
     * @return void
     *
     * @OA\Put(
     *  path="/admin/{id}",
     *  tags={"Admin"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="ID de l\'admin à modifier",
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
     *              example={"name": "Nom du plat", "prix": "Prix du plat", "image": "Image d un plat", "description": "Descripion du plat"}
     *          )
     *      ),
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="Admin modifié",
     *      @OA\JsonContent(
     *          type="string"
     *      )
     *  )
     * )
     */

    public function update(int $id, array $params){
        $lastId = $this->model->update($id, $params);
        $data = $this->model->find($lastId);
        $this->jsonResponse($data, 200);
    }

    /**
     * @param int $id
     * @return void
     *
     * @OA\Delete(
     *  path="/admin/{id}",
     *  tags={"Admin"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="ID de l\'admin",
     *      required=true,
     *      @OA\Schema(
     *          type="integer"
     *      )
     *  ),
     *  security={{"Authentication": {}}},
     *  @OA\Response(
     *      response=204,
     *      description="Administrateur supprimé.",
     *      @OA\JsonContent(
     *          type="string"
     *      )
     *  )
     * )
     */

    public function delete(int $id){
        $this->model->delete($id);
        $this->jsonResponse("Administrateur supprimé.", 204);
    }
}
