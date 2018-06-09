<?php
/**
 * Created by PhpStorm.
 * User: yoshii
 * Date: 2015/03/08
 * Time: 18:48
 */

namespace Iot\Db;


class DataTableGateway extends AbstractTableGateway{
    protected $table = 'data';
    protected $entity = 'Iot\Model\Data';
}