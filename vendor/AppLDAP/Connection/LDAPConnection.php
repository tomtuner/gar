<?php

/**
 * Description of LDAPConnection
 *
 * @author Nikesh Hajari
 */

namespace AppLDAP\Connection;

use \AppLDAP\Exception\LDAPException;

class LDAPConnection implements \AppLDAP\Connection\iLDAPConnection
{
    
    /**
     * @see AppLdap\Connection\iLdapConnection
     */
    public function getConnection()
    {
        try
        {
            $options = array(
                'host' => 'ldap.rit.edu',
                'useStartTls' => false,
                'username' => 'uid=cclwww,ou=People,dc=rit,dc=edu',
                'password' => 'zJ8x2e9XPtp8t978rk3b9KJ6b',
                'baseDn' => 'uid=cclwww,ou=People,dc=rit,dc=edu',
            );

            $ldap = new \Zend\Ldap\Ldap($options);
            $ldap->bind();

            return $ldap;
        }
        catch(\Exception $e)
        {
            throw new LDAPException('Error Initializing LDAP Connection');
        }
    }
    
}

?>
