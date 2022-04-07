<?php
namespace App\Controller;

use App\Model\PlatModel;
use App\Security\JWTSecurity;
use Core\Controller\DefaultController;

final class PlatController extends DefaultController{

    private PlatModel $model;

    private array $security;

    public function __construct()
    {
        $this->model = new PlatModel;
        // (new JWTSecurity)->verifyToken();
    }

    /**
     * @return void
     */
    public function getAll()
    {
        $plats = $this->model->findAll();
        $this->jsonResponse($plats, 200);
    }

    /**
     * @param int $id
     * @return void
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
     */
    public function save(array $data)
    {
        if ($this->security['role'] == "admin") {
            $lastId = $this->model->save($data);
            $plat = $this->model->find($lastId);
            (new JWTSecurity)->verifyToken();
            $this->jsonResponse($plat, 201);
        } else {
            throw new \Exception("Vous n'avez pas les droits", 403);
        }
    }

    /**
     * @param int $id
     * @param array $data
     * @return void
     */
    public function update(int $id, array $data) {
        $this->model->update($id, $data);
        (new JWTSecurity)->verifyToken();
        $this->jsonResponse("Plat modifié", 201);
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id) {
        $plat = $this->model->find($id);
        if ($plat) {
            $this->model->delete($id);
            (new JWTSecurity)->verifyToken();
            $this->jsonResponse("Plat supprimé", 200);
        } else {
            $this->jsonResponse("Ce plat n'existe pas/plus", 200);
        }
    }
}
