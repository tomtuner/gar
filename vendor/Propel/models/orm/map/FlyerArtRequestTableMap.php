<?php

namespace ORMModel\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'flyer_art_request' table.
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
class FlyerArtRequestTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'orm.map.FlyerArtRequestTableMap';

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
		$this->setName('flyer_art_request');
		$this->setPhpName('FlyerArtRequest');
		$this->setClassname('ORMModel\\FlyerArtRequest');
		$this->setPackage('orm');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('FLYER_ART_REQUEST_ID', 'FlyerArtRequestId', 'INTEGER', true, null, null);
		$this->addForeignKey('FLYER_SIZE_ID', 'FlyerSizeId', 'INTEGER', 'flyer_size', 'FLYER_SIZE_ID', true, null, null);
		$this->addForeignKey('FLYER_FORMAT_ID', 'FlyerFormatId', 'INTEGER', 'flyer_format', 'FLYER_FORMAT_ID', true, 10, null);
		$this->addForeignKey('ART_REQUEST_ID', 'ArtRequestId', 'INTEGER', 'art_request', 'ART_REQUEST_ID', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('FlyerSize', 'ORMModel\\FlyerSize', RelationMap::MANY_TO_ONE, array('flyer_size_id' => 'flyer_size_id', ), 'CASCADE', 'CASCADE');
		$this->addRelation('ArtRequest', 'ORMModel\\ArtRequest', RelationMap::MANY_TO_ONE, array('art_request_id' => 'art_request_id', ), 'CASCADE', 'CASCADE');
		$this->addRelation('FlyerFormat', 'ORMModel\\FlyerFormat', RelationMap::MANY_TO_ONE, array('flyer_format_id' => 'flyer_format_id', ), 'CASCADE', 'CASCADE');
	} // buildRelations()

} // FlyerArtRequestTableMap
