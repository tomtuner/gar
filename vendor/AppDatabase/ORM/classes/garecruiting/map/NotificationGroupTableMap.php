<?php

namespace GARecruitingORM\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'notification_group' table.
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
class NotificationGroupTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'garecruiting.map.NotificationGroupTableMap';

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
        $this->setName('notification_group');
        $this->setPhpName('NotificationGroup');
        $this->setClassname('GARecruitingORM\\NotificationGroup');
        $this->setPackage('garecruiting');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('NOTIFICATION_GROUP_ID', 'NotificationGroupId', 'INTEGER', true, null, null);
        $this->addColumn('NOTIFICATION_GROUP_NAME', 'NotificationGroupName', 'VARCHAR', true, 100, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('NotifeeNotificationGroup', 'GARecruitingORM\\NotifeeNotificationGroup', RelationMap::ONE_TO_MANY, array('notification_group_id' => 'notification_group_id', ), 'CASCADE', 'CASCADE', 'NotifeeNotificationGroups');
        $this->addRelation('PositionNotificationGroup', 'GARecruitingORM\\PositionNotificationGroup', RelationMap::ONE_TO_MANY, array('notification_group_id' => 'notification_group_id', ), 'CASCADE', 'CASCADE', 'PositionNotificationGroups');
    } // buildRelations()

} // NotificationGroupTableMap
