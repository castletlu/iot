<?php
namespace Iot\Db;

class DeviceTableGateway extends AbstractTableGateway
{
    protected $table = 'device';
    protected $entity = 'Iot\Model\Device';
}