<?php

namespace ORMModel\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'event_price_type' table.
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
class EventPriceTypeTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'orm.map.EventPriceTypeTableMap';

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
		$this->setName('event_price_type');
		$this->setPhpName('EventPriceType');
		$this->setClassname('ORMModel\\EventPriceType');
		$this->setPackage('orm');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('EVENT_PRICE_TYPE_ID', 'EventPriceTypeId', 'INTEGER', true, null, null);
		$this->addColumn('EVENT_PRICE_TYPE_NAME', 'EventPriceTypeName', 'VARCHAR', true, 50, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('EventPrice', 'ORMModel\\EventPrice', RelationMap::ONE_TO_MANY, array('event_price_type_id' => 'event_price_type_id', ), 'CASCADE', 'CASCADE', 'EventPrices');
	} // buildRelations()

} // EventPriceTypeTableMap
