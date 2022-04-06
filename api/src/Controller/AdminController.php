<?php
namespace App\Controller;

use App\Model\AdminModel;
use App\Security\JWTSecurity;
use Core\Controller\DefaultController;

final class AdminController extends DefaultController{

    private $model;

    public function __construct()
    {
        $this->model = new AdminModel;
    }

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
        $params['password'] = password_hash($params["password"], PASSWORD_DEFAULT);
        $this->model->save($params);
        self::jsonResponse("Admin crée", 201);
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
