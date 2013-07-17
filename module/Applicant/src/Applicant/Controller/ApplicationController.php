<?php

namespace Applicant\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\ServiceManager\ServiceLocatorInterface;
use AppCore\Exception\ControllerException;
use Zend\EventManager\Event;

class ApplicationController extends AbstractActionController
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
     * Index Action
     * 
     * Application Form
     */
    public function indexAction()
    {
        try
        {
            $this->SessionValidator()->validate();
            
            $this->services->get('DatabaseConnection')->getConnection('ga_recruiting');
                        
            $s = new \Applicant\Service\ApplicantService();
            $s->addDataEntity(new \Applicant\Service\Entity\ApplicantServiceEntity($this->getRequest()->getPost()));
            $s->addModel(new \Applicant\Model\ApplicantModel());
            if($s->getApplicationStatus() == true)
            {
                return $this->redirect()->toRoute('Applicant-application',
                            array(
                        'action' => 'success'
                    ));
            }
            
            $p = new \Applicant\Model\PositionModel();
            
            $layout = $this->layout();
            $layout->setTemplate('layout/applicant');

            return new ViewModel(array( 'positions' => $p->findAll()));
        } catch(\Exception $e)
        {
            throw new ControllerException('Error Loading Application', $e);
        }
    }

    /**
     * Create Action
     * 
     * Processes Application
     * 
     * @return \Zend\View\Model\ViewModel
     * @throws ControllerException
     */
    public function createAction()
    {
        try
        {
            $this->SessionValidator()->validate();
            
            $this->services->get('DatabaseConnection')->getConnection('ga_recruiting');
            
            $s = new \Applicant\Service\ApplicantService();
            $s->addDataEntity(new \Applicant\Service\Entity\ApplicantServiceEntity($this->getRequest()->getPost()));
            $s->addModel(new \Applicant\Model\ApplicantModel());
            
            //add post-service event
            $s->getEventManager()->attach('add.post', function(Event $e) {
              //initialize mailer
              $mailer = new \Zend\Mail\Transport\Sendmail();

              //send and prepare applicant confirmation e-mail
              $userEmail = new \Applicant\Email\ApplicantConfirmationEmail($e->getParam(serviceEntity));
              $mailer->send($userEmail->getMessage());
              
              //send and prepare position owner confirmation e-mail
              $positionOwnerEmail = new \Applicant\Email\PositionOwnerNotificationEmail($e->getParam('serviceEntity'));
              $mailer->send($positionOwnerEmail->getMessage());
            });
            
			$s->add();

            return $this->redirect()->toRoute('Applicant-application',
                            array(
                        'action' => 'success'
                    ));
             
            return new ViewModel();
        } catch(\Exception $e)
        {
            throw new ControllerException('Error Processing Application', $e);
        }
    }
    
    public function successAction()
    {
        try
        {
            $this->SessionValidator()->validate();
            return new ViewModel();
        } catch(\Exception $e)
        {
            throw new ControllerException('Error Loading Success Message', $e);
        }
    }

}

?>
