<?php

namespace Applicant\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

/**
 * Description of SessionValidator
 *
 * @author Nikesh Hajari
 */
class SessionValidator extends AbstractPlugin
{
   
    public function validate()
    {
       
        $s = \Zend\Session\Container::getDefaultManager();
                
        if(!$s->getStorage()->offsetExists('authentication_token'))
        {
            $this->getController()->plugin('flashMessenger')->addMessage('You must be logged in to submit application');

            return $this->getController()->plugin('redirect')->toRoute('Applicant-root',
                        array(
                    'action' => 'index'
                ));
        }
        
        if($s->getStorage()->offsetExists('authentication_token'))
        {
            $isValidTime = $s->getStorage()->offsetGet('expiration_time') > date('Y-m-d H:i:s', time());
            
            if($isValidTime === false)
            {
                return $this->getController()->plugin('redirect')->toRoute('Applicant-authentication',
                        array(
                    'action' => 'expired-session'
                ));
            }
        }
        
    }
    
    public function isValid()
    {
        $s = \Zend\Session\Container::getDefaultManager();

        if($s->getStorage()->offsetExists('authentication_token'))
        {
              $isValidTime = $s->getStorage()->offsetGet('expiration_time') > date('Y-m-d H:i:s', time());
              
              return $isValidTime;
        }
    }
    
}

?>
