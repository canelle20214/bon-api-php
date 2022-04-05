<?

namespace App\Controller;

use App\Model\ReservationModel;
use Core\Controller\DefaultController;

final class ReservationController extends DefaultController
{
    private $model;

    public function __construct()
    {
        $this->model = new ReservationModel;
    }

    public function getAll(): void
    {
        $reservations = $this->model->findAll();
        $this->jsonResponse($reservations, 200);
    }

    public function getOne(int $id): void
    {
        $reservation = $this->model->find($id);
        $this->jsonResponse($reservation, 200);
    }

    public function save(array $data): void
    {
        $lastId = $this->model->save($data);
        $reservation = $this->model->find($lastId);
        $this->jsonResponse($reservation, 201);
    }

    public function update(int $id, array $data): void
    {
        $this->model->update($id, $data);
        $this->jsonResponse("Réservation modifiée", 201);
    }

    public function delete(int $id): void
    {
        $this->model->delete($id);
        $this->jsonResponse("Réservation supprimée", 200);
    }
}
