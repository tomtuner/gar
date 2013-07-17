<?php

namespace Applicant\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use AppCore\Exception\ControllerException;

class IndexController extends AbstractActionController
{

    /**
     * GAR Index
     */
    public function indexAction()
    {
        try
        {   
            if($this->SessionValidator()->isValid())
            {
                return $this->redirect()->toRoute('Applicant-application',
                            array(
                        'action' => 'index'
                    ));
            }
            
            return new ViewModel(
                            array(
                                'flashMessages' => $this->flashMessenger()->getMessages()
                            )
            );
        } catch(\Exception $e)
        {
            throw new ControllerException('Error Loading Homepage', $e);
        }
    }

}

?>
