<?php
/**
 * Created by PhpStorm.
 * User: yoshii
 * Date: 2015/03/08
 * Time: 18:41
 */

namespace Iot\Model;


class Data extends AbstractEntity
{
    public $id;

    public $device;

    public $humidity;

    public $temperature;

    public $created_at;

    public $observed_at;

    /**
     * @param $data array property values
     *
     * @return void
     */
    public function exchangeArray($data)
    {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->device = (!empty($data['device'])) ? $data['device'] : null;
        $this->temperature = (!empty($data['temperature']))
            ? $data['temperature'] : null;
        $this->humidity = (!empty($data['humidity']))
            ? $data['humidity'] : null;
        $this->created_at = (!empty($data['created_at']))
            ? $data['created_at'] : null;
        $this->observed_at = (!empty($data['observed_at']))
            ? $data['observed_at'] : null;
    }

    /**
     * @return array property values
     */
    public function getArrayCopy()
    {
        $array = get_object_vars($this);
//        unset($array['inputFilter']);
        return $array;
    }
}