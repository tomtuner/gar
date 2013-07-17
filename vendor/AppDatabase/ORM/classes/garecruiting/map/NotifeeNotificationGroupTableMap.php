<?php

namespace GARecruitingORM\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'notifee_notification_group' table.
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
class NotifeeNotificationGroupTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'garecruiting.map.NotifeeNotificationGroupTableMap';

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
        $this->setName('notifee_notification_group');
        $this->setPhpName('NotifeeNotificationGroup');
        $this->setClassname('GARecruitingORM\\NotifeeNotificationGroup');
        $this->setPackage('garecruiting');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('NOTIFIEE_ID', 'NotifieeId', 'INTEGER' , 'notifiee', 'NOTIFIEE_ID', true, null, null);
        $this->addForeignPrimaryKey('NOTIFICATION_GROUP_ID', 'NotificationGroupId', 'INTEGER' , 'notification_group', 'NOTIFICATION_GROUP_ID', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Notifiee', 'GARecruitingORM\\Notifiee', RelationMap::MANY_TO_ONE, array('notifiee_id' => 'notifiee_id', ), 'CASCADE', 'CASCADE');
        $this->addRelation('NotificationGroup', 'GARecruitingORM\\NotificationGroup', RelationMap::MANY_TO_ONE, array('notification_group_id' => 'notification_group_id', ), 'CASCADE', 'CASCADE');
    } // buildRelations()

} // NotifeeNotificationGroupTableMap
