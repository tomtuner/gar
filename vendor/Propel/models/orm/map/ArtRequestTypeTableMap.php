<?php

namespace ORMModel\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'art_request_type' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.orm.map
 */
class ArtRequestTypeTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'orm.map.ArtRequestTypeTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
		// attributes
		$this->setName('art_request_type');
		$this->setPhpName('ArtRequestType');
		$this->setClassname('ORMModel\\ArtRequestType');
		$this->setPackage('orm');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ART_REQUEST_TYPE_ID', 'ArtRequestTypeId', 'INTEGER', true, null, null);
		$this->addColumn('ART_REQUEST_TYPE_NAME', 'ArtRequestTypeName', 'VARCHAR', true, 50, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('ArtRequest', 'ORMModel\\ArtRequest', RelationMap::ONE_TO_MANY, array('art_request_type_id' => 'art_request_type_id', ), 'CASCADE', 'CASCADE', 'ArtRequests');
	} // buildRelations()

} // ArtRequestTypeTableMap
