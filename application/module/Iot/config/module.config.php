<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
return array(
    'router'          => array(
        'routes' => array(
            'login'      => array(
                'type'    => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/login',
                    'defaults' => array(
                        'controller' => 'Iot\Controller\Index',
                        'action'     => 'login'
                    )
                )
            ),
            'logout'     => array(
                'type'    => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/logout',
                    'defaults' => array(
                        'controller' => 'Iot\Controller\Index',
                        'action'     => 'logout'
                    )
                )
            ),
            'home'       => array(
                'type'    => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Iot\Controller\Home',
                        'action'     => 'index'
                    )
                )
            ),

            // using the path /device/:action/:id
            'device'     => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'       => '/device[/:action[/:id]]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]*'
                    ),
                    'defaults'    => array(
                        'controller' => 'Iot\Controller\Device',
                        'action'     => 'index'
                    )
                )
            ),

            /*
             * For API version 1
             */
            'web_api' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'       => '/api/v1/web[/:action[/:id]]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]*'
                    ),
                    'defaults'    => array(
                        'controller' => 'Iot\Controller\ApiV1\Web',
                        'action'     => 'index'
                    )
                )
            ),
            // using the path /api/v1/mobile/:action/:id
            'mobile_api' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'       => '/api/v1/mobile[/:action[/:id]]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]*'
                    ),
                    'defaults'    => array(
                        'controller' => 'Iot\Controller\ApiV1\Mobile',
                        'action'     => 'index'
                    )
                )
            ),
            // using the path /api/v1/device/:action/:id
            'device_api' => array(
	            'type'    => 'Segment',
	            'options' => array(
		            'route'       => '/api/v1/device[/:action[/:id]]',
		            'constraints' => array(
			            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
			            'id'     => '[0-9]*'
		            ),
		            'defaults'    => array(
			            'controller' => 'Iot\Controller\ApiV1\Device',
			            'action'     => 'index'
		            )
	            )
            ),
        )
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory'
        ),
        'aliases'            => array(
            'translator' => 'MvcTranslator'
        )
    ),
    'controllers'     => array(
        'invokables' => array(
            'Iot\Controller\Index'     => 'Iot\Controller\IndexController',
            'Iot\Controller\Home'      => 'Iot\Controller\HomeController',
            'Iot\Controller\Device'    => 'Iot\Controller\DeviceController',
            'Iot\Controller\ApiV1\Mobile' => 'Iot\Controller\ApiV1\MobileController',
            'Iot\Controller\ApiV1\Web' => 'Iot\Controller\ApiV1\WebController',
            'Iot\Controller\ApiV1\Device' => 'Iot\Controller\ApiV1\DeviceController',
        )
    ),
    'view_manager'    => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map'             => array(
            'layout/layout'           => __DIR__ .
                '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ .
                '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ .
                '/../view/error/404.phtml',
            'error/index'             => __DIR__ .
                '/../view/error/index.phtml'
        ),
        'template_path_stack'      => array(
            __DIR__ . '/../view'
        ),
        'strategies'               => array(
            'ViewJsonStrategy',
        ),
    ),

    // Placeholder for console routes
    'console'         => array(
        'router' => array(
            'routes' => array()
        )
    )
);
