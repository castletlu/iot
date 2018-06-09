<?php
/**
 * Created by PhpStorm.
 * User: yoshii
 * Date: 2015/03/09
 * Time: 18:36
 */

namespace Iot\Controller\ApiV1;


use Iot\Controller\AbstractController;

class AbstractApiController extends AbstractController{
    /**
     *
     * @return \Iot\Model\DataModel
     */
    public function getDataModel()
    {
        return $this->getModelManager()->get('Iot\Model\DataModel');
    }

    /**
     *
     * @return \Iot\Model\DeviceModel
     */
    public function getDeviceModel()
    {
        return $this->getModelManager()->get('Iot\Model\DeviceModel');
    }
}