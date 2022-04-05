<?php
namespace App\Model;

use Core\Model\DefaultModel;

/**
 * @method array<Commande> findAll()
 * @method Commande find(int $id)
 * @method int save(array $data)
 * @method int update(int $id, array $data)
 * @method int delete (int $id)
 */
class CommandeModel extends DefaultModel {

    protected string $table = 'commande';
    protected string $entity = 'Commande';
}