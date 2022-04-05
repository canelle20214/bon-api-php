<?php
namespace App\Model;

use Core\Model\DefaultModel;

/**
 * @method array<NumeroTable> findAll()
 * @method NumeroTable find(int $id)
 * @method int save(array $data)
 * @method int update(int $id, array $data)
 * @method int delete (int $id)
 */
class NumeroTableModel extends DefaultModel {

    protected string $table = 'numero_de_table';
    protected string $entity = 'NumeroTable';
}
