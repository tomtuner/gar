<?php

namespace Applicant\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\ServiceManager\ServiceLocatorInterface;
use AppCore\Exception\ControllerException;

class AuthenticationController extends AbstractActionController
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
     * Login Action
     */
    public function loginAction()
    {

        try
        {
            $this->services->get('DatabaseConnection')->getConnection('ga_recruiting');

            $u = new \Applicant\Service\UserService();
            $u->addDataEntity(new \Applicant\Service\Entity\UserServiceEntity($this->getRequest()->getPost()));
            $u->addModel(new \Applicant\Model\UserModel());
            $hasAuthenticationToken = $u->login();

            if($hasAuthenticationToken == false)
            {
                $this->flashMessenger()->addMessage('Invalid Login/Password');
                return $this->redirect()->toRoute('Applicant-root',
                                array('action' => 'index'));
            }

            return $this->redirect()->toRoute('Applicant-application',
                            array(
                        'action' => 'index'
                    ));
        } catch(\Exception $e)
        {
            throw new ControllerException('Error Processing Login', $e);
        }
    }

    /**
     * Logoff Action
     */
    public function logoffAction()
    {
        try
        {

            $this->services->get('DatabaseConnection')->getConnection('ga_recruiting');

            $u = new \Applicant\Service\UserService();
            //FIXME: nothing is actually posted. The entity object needs to be changed so it does not
            //always require a parameter in the constructor
            $u->addDataEntity(new \Applicant\Service\Entity\UserServiceEntity($this->getRequest()->getPost()));
            $u->addModel(new \Applicant\Model\UserModel());
            $u->logoff();

            return $this->redirect()->toRoute('Applicant-root',
                            array(
                        'action' => 'index'
                    ));
        } catch(\Exception $e)
        {
            throw new ControllerException('Error Processing Logoff', $e);
        }
    }

    public function expiredSessionAction()
    {
        try
        {
            $this->flashMessenger()->addMessage('Your Session Has Expired! Please Login Again.');

            return $this->redirect()->toRoute('Applicant-root',
                            array(
                        'action' => 'index'
                    ));
        } catch(\Exception $e)
        {
            throw new ControllerException('Error Expiring Session', $e);
        }
    }

}

?>
