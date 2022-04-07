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
     * @return void
     */
    public function getAll()
    {
        $platsCommande = $this->model->findAll();
        $this->jsonResponse($platsCommande, 200);
    }

    /**
     * @param int $id
     * @return void
     */
    public function getOne(int $id)
    {
        $platCommande = $this->model->find($id);
        if ($plat) {
            $this->jsonResponse($platCommande, 200);
        } else {
            $this->jsonResponse("Cette commande n'existe pas", 404);
        }
    }

    /**
     * @param array $data
     * @return void
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
     */
    public function update(int $id, array $data) {
        $this->model->update($id, $data);
        (new JWTSecurity)->verifyToken();
        $this->jsonResponse("Commmande modifié", 201);
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id) {
        $platCommande = $this->model->find($id);
        if ($platCommande) {
            $this->model->delete($id);
            (new JWTSecurity)->verifyToken();
            $this->jsonResponse("Commande supprimé", 200);
        } else {
            $this->jsonResponse("Cette commande n'existe pas/plus", 200);
        }
    }
}
