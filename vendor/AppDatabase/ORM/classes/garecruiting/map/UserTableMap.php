<?php

namespace GARecruitingORM\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'user' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.garecruiting.map
 */
class UserTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'garecruiting.map.UserTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('user');
        $this->setPhpName('User');
        $this->setClassname('GARecruitingORM\\User');
        $this->setPackage('garecruiting');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('USER_ID', 'UserId', 'INTEGER', true, null, null);
        $this->addColumn('EMAIL_ADDRESS', 'EmailAddress', 'VARCHAR', true, 100, null);
        $this->addColumn('PASSWORD', 'Password', 'VARCHAR', true, 700, null);
        $this->addColumn('AUTHENTICATION_TOKEN', 'AuthenticationToken', 'VARCHAR', false, 700, null);
        $this->addColumn('EXPIRATION_TIME', 'ExpirationTime', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Applicant', 'GARecruitingORM\\Applicant', RelationMap::ONE_TO_MANY, array('user_id' => 'user_id', ), 'CASCADE', 'CASCADE', 'Applicants');
    } // buildRelations()

} // UserTableMap
