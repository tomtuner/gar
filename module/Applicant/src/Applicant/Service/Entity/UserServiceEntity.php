<?php

/**
 * Description of UserServiceEntity
 *
 * @author Nikesh Hajari
 */

namespace Applicant\Service\Entity;

class UserServiceEntity extends \AppCore\Service\Entity\AbstractServiceEntity
{

    /**
     * Get Registration E-mail Address
     * 
     * @return string|null
     */
    public function getRegistrationEmailAddress()
    {
        return $this->getProperty('registration_email_address');
    }
    
    /**
     * Get Registration Password
     * 
     * @return string|null
     */
    public function getRegistrationPassword()
    {
        return $this->getProperty('registration_password');
    }
    
    /**
     * Get Login E-mail Address
     * 
     * @return string|null
     */
    public function getLoginEmailAddress()
    {
        if(is_null($this->getProperty('login_email_address')))
        {
            return $this->getProperty('registration_email_address');
        }
        
        return $this->getProperty('login_email_address');
    }
    
    /**
     * Get Login Password
     * 
     * @return string|null
     */
    public function getLoginPassword()
    {
        if(is_null($this->getProperty('login_password')))
        {
            return $this->getProperty('registration_password');
        }
        
        return $this->getProperty('login_password');
    }
    
    /**
     * Get Authentication Token
     * 
     * @return string|null
     */
    public function getAuthenticationToken()
    {
        $s = new \Zend\Session\SessionManager();
        
        if($s->getStorage()->offsetExists('authentication_token') == true)
        {
            return $s->getStorage()->offsetGet('authentication_token');
        }
        
        return null;
    }
    
}

?>