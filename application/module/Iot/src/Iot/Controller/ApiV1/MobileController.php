<?php
/**
 * Created by PhpStorm.
 * User: yoshii
 * Date: 2015/03/08
 * Time: 18:29
 */

namespace Iot\Controller\ApiV1;


use Zend\View\Model\JsonModel;

class MobileController extends AbstractApiController {
	public function indexAction() {
		$devices = $this->getDeviceModel()->fetchAll();
		$result  = array();
		foreach ( $devices as $device ) {
			$a                = array();
			$a['id']          = $device->id;
			$a['name']        = $device->name;
			$a['description'] = $device->description;
			$result[]         = $a;
		}

		$json = new JsonModel(
			array(
				'devices' => $result
			)
		);

		return $json;
	}

	public function dataAction() {
		$device = $this->params( 'id' );
		$rowset = $this->getDataModel()->fetchLast( 10, $device );

		$temps  = array();
		$humids = array();
		foreach ( $rowset as $row ) {
			/* @var $row \Iot\Model\Data */
			$temps[ $row->observed_at ]  = $row->temperature;
			$humids[ $row->observed_at ] = $row->humidity;
		}
		$result = array(
			'temperature' => $temps,
			'humidity'    => $humids
		);
		$json   = new JsonModel(
			array(
				'data' => $result
			)
		);

		return $json;
	}

	public function deviceInfoAction() {
		$device = $this->params( 'id' );
		/* @var $entity \Iot\Model\Device */
		$entity = $this->getDeviceModel()->get( $device );
		$result = array(
			'id'=> $entity->id,
			'name'=> $entity->name,
			'description'   => $entity->description,
		   	'lat' => $entity->lat,
			'lng' => $entity->lng
		);
		$json   = new JsonModel(
			array(
				'device-info' => $result
			)
		);

		return $json;
	}
}