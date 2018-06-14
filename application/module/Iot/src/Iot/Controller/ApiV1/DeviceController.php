<?php
/**
 * Created by PhpStorm.
 * User: yoshii
 * Date: 2015/05/20
 * Time: 18:52
 */

namespace Iot\Controller\ApiV1;

use Iot\Model\Data;
use Zend\View\Model\JsonModel;
use Zend\Json\Json as Json;

class DeviceController extends AbstractApiController
{
    public function indexAction()
    {
        return $this->uploadAction();
    }


    public function uploadAction()
    {
//		date_default_timezone_set('Asia/Ho_Chi_Minh');
        $json = $this->getRequest()->getContent();
        $uploaded = Json::decode($json);

        $now = date("Y-m-d H:i:s");
        $data = new Data();
        $data->created_at = $now;
        $data->observed_at = $now;
        $data->device = $uploaded->id;
        $data->temperature = round($uploaded->temp, 3);
        $data->humidity = round($uploaded->moist, 3);
        $this->getDataModel()->save($data);

                
       
        $jsonArray =  array(
                'result' => 1,
                'feedFood' => 0,
                'feedWater' => 0
            )
      
        if (round($uploaded->temp, 3) < 50){
            $jsonArray[feedFood] => 1;
        }
        
        if (round($uploaded->moist, 3) > 50){
            $jsonArray[feedWater] => 1;
        }
        
         $json = new JsonModel($jsonArray);
        

        return $json;
    }
}
