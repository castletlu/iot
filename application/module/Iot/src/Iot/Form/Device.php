<?php
namespace Iot\Form;

use Zend\Form\Form;

class Device extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('login-form');
        $this->add(
            array(
                'name' => 'id',
                'type' => 'Hidden',
            )
        );
        $this->add(
            array(
                'name'    => 'name',
                'type'    => 'Text',
                'options' => array(
                    'twb-layout'       => \TwbBundle\Form\View\Helper\TwbBundleForm::LAYOUT_HORIZONTAL,
                    'label'            => 'Device Name',
                    'column-size'      => 'sm-10',
                    'label_attributes' => array('class' => 'col-sm-2')
                )
            )
        );
        $this->add(
            array(
                'name'    => 'description',
                'type'    => 'Text',
                'options' => array(
                    'twb-layout'       => \TwbBundle\Form\View\Helper\TwbBundleForm::LAYOUT_HORIZONTAL,
                    'label'            => 'Device Description',
                    'column-size'      => 'sm-10',
                    'label_attributes' => array('class' => 'col-sm-2')
                )
            )
        );
        $this->add(
            array(
                'name'    => 'lat',
                'type'    => 'Text',
                'options' => array(
                    'twb-layout'       => \TwbBundle\Form\View\Helper\TwbBundleForm::LAYOUT_HORIZONTAL,
                    'label'            => 'Latitude',
                    'column-size'      => 'sm-10',
                    'label_attributes' => array('class' => 'col-sm-2')
                ),
                'attributes'    => array('id' => 'lat_placeholder')
            )
        );
        $this->add(
            array(
                'name'    => 'lng',
                'type'    => 'Text',
                'options' => array(
                    'twb-layout'       => \TwbBundle\Form\View\Helper\TwbBundleForm::LAYOUT_HORIZONTAL,
                    'label'            => 'Longitude',
                    'column-size'      => 'sm-10',
                    'label_attributes' => array('class' => 'col-sm-2')
                ),
                'attributes'    => array('id' => 'lng_placeholder')
            )
        );
        $this->add(
            array(
                'name'       => 'send',
                'type'       => 'button',
                'attributes' => array('type' => 'submit'),
                'options'    => array(
                    'twb-layout'  => \TwbBundle\Form\View\Helper\TwbBundleForm::LAYOUT_HORIZONTAL,
                    'label'       => 'Send',
                    'column-size' => 'sm-10 col-sm-offset-2')
            )
        );
    }
}