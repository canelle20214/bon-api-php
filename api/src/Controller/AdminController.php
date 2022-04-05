<?php
namespace App\Controller;

use App\Model\AdminModel;
use Core\Controller\DefaultController;

final class AdminController extends DefaultController{

    private $model;

    public function __construct()
    {
        $this->model = new AdminModel;
    }

    public function getAll()
    {
        $data = $this->model->findAll();
        $this->jsonResponse($data, 200);
    }

    public function getOne(int $id)
    {
        $data = $this->model->find($id);
        $this->jsonResponse($data, 200);

    }

    public function save (array $params)
    {
        $lastId = $this->model->save($params);
        $data = $this->model->find($lastId);
        $this->jsonResponse($data, 201);
    }

    public function update(int $id, array $params){
        $lastId = $this->model->update($id, $params);
        $data = $this->model->find($lastId);
        $this->jsonResponse($data, 200);
    }

    public function delete(int $id){
        $this->model->delete($id);
        $this->jsonResponse("Administrateur supprimé.", 204);
    }
}
