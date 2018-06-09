<?php
/**
 * Created by PhpStorm.
 * User: yoshii
 * Date: 2015/03/08
 * Time: 18:47
 */

namespace Iot\Model;


use Zend\Db\Sql\Select;

class DataModel extends AbstractModel
{
    /**
     * @var string The name of TableGateway class
     */
    protected $tableGatewayClass = '\Iot\Db\DataTableGateway';

    public function fetchLast($limit = 10, $device=null)
    {
        $resultSet = $this->tableGateway->select(
            function (Select $select) use ($limit, $device) {
                $select = $select->limit($limit)
                    ->order("id DESC");
                if (null !== $device)
                {
                    $select->where(array('device'=>$device));
                }
            }
        );
        return $resultSet;
    }

    /**
     * "upsert" operation depending on $entity status
     *
     * @param \Iot\Model\AbstractEntity $entity
     *
     * @throws \Exception
     */
    public function save(AbstractEntity $entity)
    {
        $data = $entity->getArrayCopy();
        $id = (int)$data['id'];
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->get($id)) {
                $this->tableGateway->update(
                    $data,
                    array(
                        'id' => $id
                    )
                );
            } else {
                throw new \Exception('Entity with a given id does not exist');
            }
        }
    }
}