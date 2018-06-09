<?php
namespace Iot\Service;

use Iot\Model\AbstractModel;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;

class ModelManager implements ServiceManagerAwareInterface
{

    /**
     *
     * @var \Zend\ServiceManager\ServiceManager
     */
    protected $serviceManager;

    /**
     * @var array Model object container
     */
    protected $container = array();

    /**
     * @return \Zend\ServiceManager\ServiceManager
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    /*
     * (non-PHPdoc)
     * @see
     * \Zend\ServiceManager\ServiceManagerAwareInterface::setServiceManager()
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }

    /**
     * Getter for Model
     *
     * @param string $modelClass
     * @param TableGatewayInterface  $tableGateway
     *
     * @return \Iot\Model\AbstractModel
     */
    public function get($modelClass, TableGatewayInterface $tableGateway = null)
    {
        if (!isset($this->container[$modelClass])) {
            $this->set($modelClass, new $modelClass($tableGateway));
        }
        return $this->container[$modelClass];
    }

    /**
     * Setter for Model Container
     *
     * @param string                   $key
     * @param \Iot\Model\AbstractModel $model
     */
    public function set($key, AbstractModel $model)
    {
        $this->container[$key] = $model;
    }
}