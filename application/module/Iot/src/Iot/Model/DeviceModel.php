<?php
namespace Iot\Model;

class DeviceModel extends AbstractModel
{

    /**
     *
     * @var string The name of TableGateway class
     */
    protected $tableGatewayClass = '\Iot\Db\DeviceTableGateway';

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