<?php

/**
 * Description of UserModel
 *
 * @author Nikesh Hajari
 */

namespace Applicant\Model;

use Applicant\Service\Entity\UserServiceEntity;
use AppCore\Exception\ModelException;

class UserModel
{

    /**
     * Create User
     * 
     * @param \Applicant\Service\Entity\UserServiceEntity $e
     * @return integer User Id
     */
    public function create(UserServiceEntity $e)
    {
        $c = \Propel::getConnection('ga_recruiting');
        $c->beginTransaction();
        
        try
        {
            $u = new \GARecruitingORM\User();
            $b = new \AppSecurity\Bcrypt();
            $u->setEmailAddress($e->getRegistrationEmailAddress());
            $u->setPassword($b->hash($e->getRegistrationPassword()));
            $u->setAuthenticationToken(null);
            $u->setExpirationTime(null);
            $u->save($c);
            
            $c->commit();
            
            return $u->getUserId();
        } catch(\Exception $e)
        {
            $c->rollBack();
            throw new ModelException('Error Creating User', $e);
        }
    }

    /**
     * Authenticate
     * 
     * Authenticate User Credentials
     * 
     * @param \Applicant\Service\Entity\UserServiceEntity $e
     * @return boolean|string Returns false if incorrect credentials else authentication token
     * @throws ModelException
     */
    public function authenticate(UserServiceEntity $e)
    {
        $c = \Propel::getConnection('ga_recruiting');
        $c->beginTransaction();
        
        try
        {
            $u = \GARecruitingORM\UserQuery::create()
                    ->filterByEmailAddress($e->getLoginEmailAddress())
                    ->findOne($c);
            
            if(!$u)
            {
                return false;
            }

            $b = new \AppSecurity\Bcrypt();
            $isValidPassword = $b->verify($e->getLoginPassword(), $u->getPassword());

            if($isValidPassword == true)
            {
                $t = new \AppSecurity\AuthenticationToken();
                $authenticationToken = $t->getToken(512);

                $u->setExpirationTime(strtotime('+2 hours'));
                $u->setAuthenticationToken($authenticationToken);
                $u->save($c);
                
                $c->commit();

                return $authenticationToken;
            }

            return false;
        } catch(\Exception $e)
        {
            $c->rollBack();
            throw new ModelException('Error Authenticating User', $e);
        }
    }

    public function destroyAuthenticationToken(UserServiceEntity $e)
    {
        try
        {
            $u = \GARecruitingORM\UserQuery::create()
                    ->filterByAuthenticationToken($e->getAuthenticationToken())
                    ->findOne();
            
            if(!$u)
            {
                return true; //FIX ME
            }
            
            $u->setExpirationTime(null);
            $u->setAuthenticationToken(null);
            $u->save();
            
            return true;
        }
        catch(\Exception $e)
        {
            throw new ModelException('Error Destroying Authenticating User', $e);
        }
    }

}

?>