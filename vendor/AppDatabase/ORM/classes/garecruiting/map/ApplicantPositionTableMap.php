<?php

namespace GARecruitingORM\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'applicant_position' table.
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
class ApplicantPositionTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'garecruiting.map.ApplicantPositionTableMap';

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
        $this->setName('applicant_position');
        $this->setPhpName('ApplicantPosition');
        $this->setClassname('GARecruitingORM\\ApplicantPosition');
        $this->setPackage('garecruiting');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('APPLICANT_ID', 'ApplicantId', 'INTEGER' , 'applicant', 'APPLICANT_ID', true, null, null);
        $this->addForeignPrimaryKey('POSITION_ID', 'PositionId', 'INTEGER' , 'position', 'POSITION_ID', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Applicant', 'GARecruitingORM\\Applicant', RelationMap::MANY_TO_ONE, array('applicant_id' => 'applicant_id', ), 'CASCADE', 'CASCADE');
        $this->addRelation('Position', 'GARecruitingORM\\Position', RelationMap::MANY_TO_ONE, array('position_id' => 'position_id', ), 'CASCADE', 'CASCADE');
    } // buildRelations()

} // ApplicantPositionTableMap
