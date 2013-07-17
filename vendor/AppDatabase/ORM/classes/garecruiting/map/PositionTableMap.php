<?php

namespace GARecruitingORM\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'position' table.
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
class PositionTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'garecruiting.map.PositionTableMap';

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
        $this->setName('position');
        $this->setPhpName('Position');
        $this->setClassname('GARecruitingORM\\Position');
        $this->setPackage('garecruiting');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('POSITION_ID', 'PositionId', 'INTEGER', true, null, null);
        $this->addColumn('POSITION_NAME', 'PositionName', 'VARCHAR', true, 250, null);
        $this->addColumn('DEPARTMENT_NAME', 'DepartmentName', 'VARCHAR', true, 250, null);
        $this->addColumn('IS_ACTIVE', 'IsActive', 'INTEGER', true, 1, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('ApplicantPosition', 'GARecruitingORM\\ApplicantPosition', RelationMap::ONE_TO_MANY, array('position_id' => 'position_id', ), 'CASCADE', 'CASCADE', 'ApplicantPositions');
        $this->addRelation('PositionNotificationGroup', 'GARecruitingORM\\PositionNotificationGroup', RelationMap::ONE_TO_MANY, array('position_id' => 'position_id', ), 'CASCADE', 'CASCADE', 'PositionNotificationGroups');
    } // buildRelations()

} // PositionTableMap
