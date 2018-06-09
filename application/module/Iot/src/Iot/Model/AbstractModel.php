<?php
namespace Iot\Model;

abstract class AbstractModel
{
    protected $tableGateway;
    protected $tableGatewayClass = null;

    public function __construct($tableGateway = null)
    {
        if (null === $tableGateway) {
            if (!isset($this->tableGatewayClass)
                || null === $this->tableGatewayClass
            ) {
                throw new \Exception(
                    'You have to set $tableGatewayClass property in your ModelTable'
                );
            }
            $tableGatewayClass = $this->tableGatewayClass;
            $tableGateway = new $tableGatewayClass();
        }
        $this->tableGateway = $tableGateway;
    }

    /**
     * Returns all records
     *
     * @return \Zend\Db\ResultSet\
     */
    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    /**
     * A single record retrieval with primary key
     *
     * @param int $id
     *
     * @throws \Exception
     * @return Application\Model\AbstractEntity
     */
    public function get($id)
    {
        $id = (int)$id;
        $rowset = $this->tableGateway->select(
            array(
                'id' => $id
            )
        );
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    /**
     *
     * @param int $id
     */
    public function delete($id)
    {
        $this->tableGateway->delete(
            array(
                'id' => (int)$id
            )
        );
    }
}