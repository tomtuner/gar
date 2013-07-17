<?php

namespace GARecruitingORM\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'notifiee' table.
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
class NotifieeTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'garecruiting.map.NotifieeTableMap';

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
        $this->setName('notifiee');
        $this->setPhpName('Notifiee');
        $this->setClassname('GARecruitingORM\\Notifiee');
        $this->setPackage('garecruiting');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('NOTIFIEE_ID', 'NotifieeId', 'INTEGER', true, null, null);
        $this->addColumn('NOTIFIEE_NAME', 'NotifieeName', 'VARCHAR', true, 100, null);
        $this->addColumn('NOTIFIEE_EMAIL_ADDRESS', 'NotifieeEmailAddress', 'VARCHAR', true, 100, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('NotifeeNotificationGroup', 'GARecruitingORM\\NotifeeNotificationGroup', RelationMap::ONE_TO_MANY, array('notifiee_id' => 'notifiee_id', ), 'CASCADE', 'CASCADE', 'NotifeeNotificationGroups');
    } // buildRelations()

} // NotifieeTableMap
