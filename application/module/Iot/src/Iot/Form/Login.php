<?php
namespace Iot\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Login extends Form implements InputFilterAwareInterface
{
    protected $inputFilter;

    public function __construct($name = null)
    {
        parent::__construct('login-form');
        $this->add(
            array(
                'name'    => 'username',
                'type'    => 'Text',
                'options' => array(
                    'label'            => 'User Name',
                    'column-size'      => 'sm-10',
                    'label_attributes' => array('class' => 'col-sm-2')
                )
            )
        );
        $this->add(
            array(
                'name'    => 'password',
                'type'    => 'Password',
                'options' => array(
                    'label'            => 'Password',
                    'column-size'      => 'sm-10',
                    'label_attributes' => array('class' => 'col-sm-2')
                )
            )
        );
        $this->add(
            array(
                'name'       => 'send',
                'type'       => 'button',
                'attributes' => array('type' => 'submit', 'id'=>'btnSubmit'),
                'options'    => array('label'       => 'Login',
                                      'column-size' => 'sm-10 col-sm-offset-2')
            )
        );
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $inputFilter->add(
                array(
                    'name'       => 'username',
                    'required'   => true,
                    'filters'    => array(
                        array(
                            'name' => 'StripTags'
                        ),
                        array(
                            'name' => 'StringTrim'
                        )
                    ),
                    'validators' => array(
                        array(
                            'name'    => 'StringLength',
                            'options' => array(
                                'encoding' => 'UTF-8',
                                'min'      => 1,
                                'max'      => 100
                            )
                        )
                    )
                )
            );

            $inputFilter->add(
                array(
                    'name'       => 'password',
                    'required'   => true,
                    'filters'    => array(
                        array(
                            'name' => 'StripTags'
                        ),
                        array(
                            'name' => 'StringTrim'
                        )
                    ),
                    'validators' => array(
                        array(
                            'name'    => 'StringLength',
                            'options' => array(
                                'encoding' => 'UTF-8',
                                'min'      => 1,
                                'max'      => 100
                            )
                        )
                    )
                )
            );
            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }
}