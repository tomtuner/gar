<?php

namespace ORMModel\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'flyer_format' table.
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
class FlyerFormatTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'orm.map.FlyerFormatTableMap';

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
		$this->setName('flyer_format');
		$this->setPhpName('FlyerFormat');
		$this->setClassname('ORMModel\\FlyerFormat');
		$this->setPackage('orm');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('FLYER_FORMAT_ID', 'FlyerFormatId', 'INTEGER', true, null, null);
		$this->addColumn('FLYER_FORMAT_TYPE', 'FlyerFormatType', 'VARCHAR', true, 20, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('FlyerArtRequest', 'ORMModel\\FlyerArtRequest', RelationMap::ONE_TO_MANY, array('flyer_format_id' => 'flyer_format_id', ), 'CASCADE', 'CASCADE', 'FlyerArtRequests');
	} // buildRelations()

} // FlyerFormatTableMap
