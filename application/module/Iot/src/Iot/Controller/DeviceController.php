<?php
namespace Iot\Controller;

use Zend\View\Model\ViewModel;

use Iot\Form\Device as DeviceFrom;
use Iot\Model\Device as DeviceEntity;

/**
 * Class DeviceController
 *
 * @package Iot\Controller
 */
class DeviceController extends AbstractController
{
    public function viewAction()
    {
        $id = (int)$this->params('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('home');
        }
        $device = $this->getModel()->get($id);
      return new ViewModel(array(
          'device'  => $device
      ));
    }

    public function addAction()
    {
        $form = new DeviceFrom();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $entity = new DeviceEntity();
            $form->setInputFilter($entity->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $entity->exchangeArray($form->getData());
                $this->getModel()->save($entity);
                return $this->redirect()->toRoute('home');
            }
        }
        return new ViewModel(
            array(
                'form' => $form
            )
        );
    }

    public function editAction()
    {
        $id = (int)$this->params('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute(
                'device',
                array(
                    'action' => 'add'
                )
            );
        }

        /* @var $model \Iot\Model\DeviceModel */
        $model = $this->getModel();
        try {
            /* @var $device \Iot\Model\Device */
            $device = $model->get($id);
        } catch (\Exception $ex) {
            return $this->redirect()->toRoute('profile');
        }

        $form = new DeviceFrom();
        $form->bind($device);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($device->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $model->save($device);
                return $this->redirect()->toRoute('home');
            }
        }

        return new ViewModel(
            array(
                'id'   => $id,
                'form' => $form
            )
        );
    }

    public function deleteAction()
    {
        $id = (int)$this->params('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('home');
        }

        $table = $this->getModel();
        $device = $table->get($id);

        $request = $this->getRequest();
        if ($request->isPost()) {
            if ('Yes' == $request->getPost('confirm', 'No')) {
                $id = (int)$request->getPost('id');
                $table->delete($id);
            }
            return $this->redirect()->toRoute('home');
        }

        return new ViewModel(
            array(
                'device' => $device
            )
        );
    }

    /**
     *
     * @return \Iot\Model\DeviceModel
     */
    public function getModel()
    {
        return $this->getModelManager()->get('Iot\Model\DeviceModel');
    }

    /**
     * @return \Iot\Model\DataModel
     */
    public function getDataModel()
    {
        return $this->getModelManager()->get('\Iot\Model\DataModel');
    }
}