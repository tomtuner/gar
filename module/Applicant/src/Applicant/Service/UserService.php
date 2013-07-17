<?php

/**
 * Description of UserService
 *
 * @author Nikesh Hajari
 */

namespace Applicant\Service;

use AppCore\Exception\ServiceException;
use AppCore\Service\EventHookType;

class UserService extends \AppCore\Service\AbstractService
{

    /**
     * Add New User
     * 
     * @return string User Id
     * @throws ServiceException 
     */
    public function add()
    {
        try
        {
            //user service entity
            $userServiceEntity = $this->getDataEntity('Applicant\Service\Entity\UserServiceEntity');

            //pre-method hook
            $this->getEventManager()->trigger(__FUNCTION__ . EventHookType::PRE,
                    $this, array('serviceEntity' => $userServiceEntity));

            //create user
            $userId = $this->getModel('Applicant\Model\UserModel')->create($userServiceEntity);

            //post-method hook
            $this->getEventManager()->trigger(__FUNCTION__ . EventHookType::POST,
                    $this,
                    array('serviceEntity' => $userServiceEntity, 'result' => $userId));

            //user id
            return $userId;
        } catch(\Exception $e)
        {
            throw new ServiceException('Error Adding User', $e);
        }
    }

    public function login()
    {
        try
        {
            //user service entity
            $userServiceEntity = $this->getDataEntity('Applicant\Service\Entity\UserServiceEntity');

            //pre-method hook
            $this->getEventManager()->trigger(__FUNCTION__ . EventHookType::PRE,
                    $this, array('serviceEntity' => $userServiceEntity));

            //get authentication token if credentials are valid
            $authenticationToken = $this->getModel('Applicant\Model\UserModel')->authenticate($userServiceEntity);
            
            if($authenticationToken == false)
            {
                return false;
            }
            
            //re-generate session id to protect against session fixation
            $s = \Zend\Session\Container::getDefaultManager();
            $s->regenerateId(true);
            $s->getStorage()->offsetSet('authentication_token',
                    $authenticationToken);
            $s->getStorage()->offsetSet('expiration_time', date('Y-m-d H:i:s', strtotime('+2 hours')));
            $s->getStorage()->lock('authentication_token');

            //post-method hook
            $this->getEventManager()->trigger(__FUNCTION__ . EventHookType::POST,
                    $this,
                    array('serviceEntity' => $userServiceEntity, 'result' => $authenticationToken));

            return $authenticationToken;
        } catch(\Exception $e)
        {
            throw new ServiceException('Error Logging In', $e);
        }
    }

    public function logoff()
    {
        try
        {
            //user service entity
            $userServiceEntity = $this->getDataEntity('Applicant\Service\Entity\UserServiceEntity');

            //pre-method hook
            $this->getEventManager()->trigger(__FUNCTION__ . EventHookType::PRE,
                    $this, array('serviceEntity' => $userServiceEntity));
            
            //create user
            $isTokenDestroyed = $this->getModel('Applicant\Model\UserModel')->destroyAuthenticationToken($userServiceEntity);
            
            //destroy session
            $s = \Zend\Session\Container::getDefaultManager();
            
            if(!$s->getStorage()->offsetExists('authentication_token'))
            {
                return true;
            }
                
            $s->forgetMe();
            $s->destroy();
            
            //post-method hook
            $this->getEventManager()->trigger(__FUNCTION__ . EventHookType::POST,
                    $this,
                    array('serviceEntity' => $userServiceEntity, 'result' => $isTokenDestroyed));

            return $isTokenDestroyed;            
        }catch(\Exception $e)
        {
            throw new ServiceException('Error Logging Off', $e);
        }
    }
   
}

?>