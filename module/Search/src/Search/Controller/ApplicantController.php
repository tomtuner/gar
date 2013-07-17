<?php

namespace Search\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\ServiceManager\ServiceLocatorInterface;
use AppCore\Exception\ControllerException;

class ApplicantController extends AbstractActionController
{

    /**
     * Services Container
     * 
     * @var \Zend\ServiceManager\ServiceLocatorInterface
     */
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
     * Index Action
     */
    public function indexAction()
    {
        try
        {
            $this->services->get('DatabaseConnection')->getConnection('ga_recruiting');

            //FIXME: Change to Search One
            $sE = new \Search\Service\Entity\ApplicantServiceEntity($this->getRequest()->getQuery());
            
            $m = new \Search\Model\ApplicantModel();

            return new ViewModel(
                            array(
                                'applicant' => $m->findOne($sE)
                            )
            );
        } catch(\Exception $e)
        {
            throw new ControllerException('Error Loading Applicant Profile', $e);
        }
    }

}

?>