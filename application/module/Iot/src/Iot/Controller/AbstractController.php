<?php
namespace Iot\Controller;

use Zend\Mvc\Controller\AbstractActionController;

abstract class AbstractController extends AbstractActionController
{

    /**
     * @return \Iot\Service\ModelManager
     */
    protected function getModelManager()
    {
        return $this->getServiceLocator()->get('modelManager');
    }
}