<?php
namespace Iot;

use Iot\Service\ModelManager;
use Zend\Authentication\Adapter\DbTable\CredentialTreatmentAdapter;
use Zend\Authentication\AuthenticationService;
use Zend\Db\TableGateway\Feature\GlobalAdapterFeature;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;


class Module {
	public function onBootstrap( MvcEvent $e ) {
		$eventManager        = $e->getApplication()->getEventManager();
		$moduleRouteListener = new ModuleRouteListener();
		$moduleRouteListener->attach( $eventManager );

		// setting DB adator globally
		GlobalAdapterFeature::setStaticAdapter(
			$e->getApplication()
			  ->getServiceManager()
			  ->get( 'Zend\Db\Adapter \Adapter' )
		);
	}

	public function getConfig() {
		return include __DIR__ . '/config/module.config.php';
	}

	public function getAutoloaderConfig() {
		return array(
			'Zend\Loader\StandardAutoloader' => array(
				'namespaces' => array(
					__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
				),
			),
		);
	}

	public function getServiceConfig() {
		return array(
			'factories' => array(
				'modelManager'                              => function ( $sm ) {
					return new ModelManager();
				},
				'Zend\Authentication\AuthenticationService' => function (
					$sm
				) {
					$dbAdapter   = $sm->get( 'Zend\Db\Adapter\Adapter' );
					$authAdapter = new CredentialTreatmentAdapter(
						$dbAdapter, 'admin', 'username', 'password',
						'MD5(?)'
					);

					$authService = new AuthenticationService();
					$authService->setAdapter( $authAdapter );

					return $authService;
				}
			)
		);
	}
}
