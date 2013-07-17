<?php

namespace ORMModel\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'flyer_size' table.
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
class FlyerSizeTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'orm.map.FlyerSizeTableMap';

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
		$this->setName('flyer_size');
		$this->setPhpName('FlyerSize');
		$this->setClassname('ORMModel\\FlyerSize');
		$this->setPackage('orm');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('FLYER_SIZE_ID', 'FlyerSizeId', 'INTEGER', true, null, null);
		$this->addColumn('FLYER_SIZE_TYPE', 'FlyerSizeType', 'VARCHAR', true, 10, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('FlyerArtRequest', 'ORMModel\\FlyerArtRequest', RelationMap::ONE_TO_MANY, array('flyer_size_id' => 'flyer_size_id', ), 'CASCADE', 'CASCADE', 'FlyerArtRequests');
	} // buildRelations()

} // FlyerSizeTableMap
