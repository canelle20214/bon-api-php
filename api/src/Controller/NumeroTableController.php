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

        (new JWTSecurity)->verifyToken();
    }

    /**
     * @return void
     */
    public function getAll()
    {
        $numeroTable = $this->model->findAll();
        $this->jsonResponse($numeroTable, 200);
    }

    /**
     * @param int $id
     * @return void
     */
    public function getOne(int $id)
    {
        $numeroTable = $this->model->find($id);
        $this->jsonResponse($numeroTable, 200);
    }

    /**
     * @param array $data
     * @return void
     */
    public function save(array $data)
    {
        $lastId = $this->model->save($data);
        $numeroTable = $this->model->find($lastId);
        $this->jsonResponse($numeroTable, 201);
    }

    /**
     * @param int $id
     * @param array $data
     * @return void
     */
    public function update(int $id, array $data) {
        $this->model->update($id, $data);
        $this->jsonResponse("Table modifiée", 201);
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id) {
        $numeroTable = $this->model->find($id);
        if ($numeroTable) {
            $this->model->delete($id);
            $this->jsonResponse("Table supprimé", 200);
        } else {
            $this->jsonResponse("Cette table n'existe pas/plus", 200);
        }
    }
}
