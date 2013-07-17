<?php

namespace ORMModel\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'banner_request' table.
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
class BannerRequestTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'orm.map.BannerRequestTableMap';

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
		$this->setName('banner_request');
		$this->setPhpName('BannerRequest');
		$this->setClassname('ORMModel\\BannerRequest');
		$this->setPackage('orm');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('BANNER_REQUEST_ID', 'BannerRequestId', 'INTEGER', true, null, null);
		$this->addForeignKey('ART_REQUEST_ID', 'ArtRequestId', 'INTEGER', 'art_request', 'ART_REQUEST_ID', true, null, null);
		$this->addColumn('BANNER_WIDTH', 'BannerWidth', 'INTEGER', true, null, null);
		$this->addColumn('BANNER_LENGTH', 'BannerLength', 'INTEGER', true, null, null);
		$this->addForeignKey('BANNER_LOCATION_ID', 'BannerLocationId', 'INTEGER', 'banner_location', 'BANNER_LOCATION_ID', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('BannerLocation', 'ORMModel\\BannerLocation', RelationMap::MANY_TO_ONE, array('banner_location_id' => 'banner_location_id', ), 'CASCADE', 'CASCADE');
		$this->addRelation('ArtRequest', 'ORMModel\\ArtRequest', RelationMap::MANY_TO_ONE, array('art_request_id' => 'art_request_id', ), 'CASCADE', 'CASCADE');
	} // buildRelations()

} // BannerRequestTableMap
