<?php
namespace Iot\Controller;

use Zend\Db\ResultSet\ResultSet;
use Zend\View\Model\ViewModel;

class HomeController extends AbstractController
{

    public function indexAction()
    {
        $model = $this->getModelManager()->get('Iot\Model\DeviceModel');
        $results    = $model->fetchAll();
        $resultSet = new ResultSet($results); // Zend\Db\ResultSet
        $resultSet->initialize($results);
        return new ViewModel(
            array(
                'devices' => $model->fetchAll()->buffer()
            )
        );
    }
}