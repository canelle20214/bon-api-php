<?php
namespace App\Model;

use Core\Model\DefaultModel;

/**
 * @method array<PlatCommande> findAll()
 * @method Plat find(int $id)
 * @method int save(array $data)
 * @method int update(int $id, array $data)
 * @method int delete (int $id)
 */
class PlatCommandeModel extends DefaultModel {

    protected string $table = 'plat_commande';
    protected string $entity = 'PlatCommande';
}
