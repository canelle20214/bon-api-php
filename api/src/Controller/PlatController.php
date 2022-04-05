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

    public function getAll()
    {
        $plats = $this->model->findAll();
        $this->jsonResponse($plats, 200);
    }

    public function getOne(int $id)
    {
        $plat = $this->model->find($id);
        $this->jsonResponse($plat, 200);

    }

    public function save()
    {
        $lastId = $this->model->save($_POST);
        $plat = $this->model->find($lastId);
        $this->jsonResponse($plat, 201);
    }

    public function update() {
        $this->model->update($_GET['id'], $_POST);
        $this->jsonResponse("Plat modifié", 201);
    }

    public function delete() {
        $this->model->delete($_GET['id']);
        $this->jsonResponse("Plat supprimé", 200);
    }
}
