<?php
namespace Iot\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Device extends AbstractEntity implements InputFilterAwareInterface
{

    protected $inputFilter;

    public $id;

    public $name;

    public $description;

    public $lat;

    public $lng;


    /**
     * @param $data array property values
     *
     * @return void
     */
    public function exchangeArray($data)
    {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->name = (!empty($data['name'])) ? $data['name'] : null;
        $this->description = (!empty($data['description']))
            ? $data['description'] : null;
        $this->lat = (!empty($data['lat'])) ? $data['lat'] : null;
        $this->lng = (!empty($data['lng'])) ? $data['lng'] : null;
    }

    /**
     * @return array property values
     */
    public function getArrayCopy()
    {
        $array = get_object_vars($this);
        unset($array['inputFilter']);
        return $array;
    }

    /*
     * (non-PHPdoc)
     * @see \Zend\InputFilter\InputFilterAwareInterface::setInputFilter()
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }


    /* (non-PHPdoc)
     * @see \Zend\InputFilter\InputFilterAwareInterface::getInputFilter()
     */
    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $inputFilter->add(
                array(
                    'name'     => 'id',
                    'required' => true,
                    'filters'  => array(
                        array(
                            'name' => 'Int'
                        )
                    )
                )
            );

            $inputFilter->add(
                array(
                    'name'       => 'name',
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
                    'name'       => 'description',
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
                    'name'       => 'lat',
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
                    'name'       => 'lng',
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