<?php
/**
 * Created by PhpStorm.
 * User: yoshii
 * Date: 2015/03/08
 * Time: 18:29
 */

namespace Iot\Controller\ApiV1;


use Zend\View\Model\JsonModel;

class WebController extends AbstractApiController
{
    public function dataAction()
    {
        $device = $this->params('id');
        $rowset = $this->getDataModel()->fetchLast(10, $device);

        $labels = array();
        $temps = array();
        $humids = array();
        foreach ($rowset as $row) {
            /* @var $row \Iot\Model\Data */
            $labels[] = $row->observed_at;
            $temps[] = $row->temperature;
            $humids[] = $row->humidity;
        }
        $result = [
            'labels'   => $labels,
            'datasets' => [
                [
                    'label'                => 'Light',
                    'fillColor'            => "rgba(220,220,220,0.2)",
                    'strokeColor'          => "rgba(220,220,220,1)",
                    'pointColor'           => "rgba(220,220,220,1)",
                    'pointStrokeColor'     => "#fff",
                    'pointHighlightFill'   => "#fff",
                    'pointHighlightStroke' => "rgba(220,220,220,1)",
                    'data'                 => $temps
                ],
                [
                    'label' 			   => 'Humidity',
                    'fillColor'            => "rgba(151,187,205,0.2)",
                    'strokeColor'          => "rgba(151,187,205,1)",
                    'pointColor'           => "rgba(151,187,205,1)",
                    'pointStrokeColor'     => "#fff",
                    'pointHighlightFill'   => "#fff",
                    'pointHighlightStroke' => "rgba(151,187,205,1)",
                    'data'  => $humids
                ],
            ]
        ];


        $json = new JsonModel(
            $result
        );
        return $json;
    }
}