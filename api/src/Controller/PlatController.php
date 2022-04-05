<?php
namespace App\Controller;

use App\Model\PlatModel;
use Core\Controller\DefaultController;

final class PlatController extends DefaultController{

    private $model;

    public function __construct()
    {
        $this->model = new PlatModel;
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
        $lastId = $this->model->save($data);
        $plat = $this->model->find($lastId);
        $this->jsonResponse($plat, 201);
    }

    /**
     * @param int $id
     * @param array $data
     * @return void
     */
    public function update(int $id, array $data) {
        $this->model->update($id, $data);
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
            $this->jsonResponse("Plat supprimé", 200);
        } else {
            $this->jsonResponse("Ce plat n'existe pas/plus", 200);
        }
    }
}
