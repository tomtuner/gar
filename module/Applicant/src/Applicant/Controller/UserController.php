<?php

namespace Applicant\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\ServiceManager\ServiceLocatorInterface;
use AppCore\Exception\ControllerException;

class UserController extends AbstractActionController
{

    protected $services;

    /**
     * Set Service Locator
     * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->services = $serviceLocator;
    }

    /**
     * Create Action
     * 
     * Create User and Automatically Login
     * 
     * @return void
     * @throws ControllerException
     */
    public function createAction()
    {
        try
        {
            $this->services->get('DatabaseConnection')->getConnection('ga_recruiting');

            $s = new \Applicant\Service\UserService();
            $sE = new \Applicant\Service\Entity\UserServiceEntity($this->getRequest()->getPost());
            $s->addDataEntity($sE);
            $s->addModel(new \Applicant\Model\UserModel());

            $s->add();
            $s->login();

            return $this->redirect()->toRoute('Applicant-application',
                        array(
                    'action' => 'index'
                ));
          
        } catch(\Exception $e)
        {
            throw new ControllerException('Error Processing User Registration', $e);
        }
    }

}

?>
