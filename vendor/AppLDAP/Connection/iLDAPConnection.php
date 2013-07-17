<?php

/**
 * Description of iLDAPConnection
 *
 * @author Nikesh Hajari
 */

namespace AppLDAP\Connection;

interface iLDAPConnection
{

    /**
     * Get Connection
     * 
     * Returns initialized LDAP Connection to ldap.rit.edu
     * 
     * @return \AppLdap\Connection\Zend\Ldap\Ldap
     */
    public function getConnection();
}

?>
