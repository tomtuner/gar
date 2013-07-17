<?php

namespace ORMModel\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'art_request_art_status' table.
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
class ArtRequestArtStatusTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'orm.map.ArtRequestArtStatusTableMap';

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
		$this->setName('art_request_art_status');
		$this->setPhpName('ArtRequestArtStatus');
		$this->setClassname('ORMModel\\ArtRequestArtStatus');
		$this->setPackage('orm');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('USER_ID', 'UserId', 'INTEGER' , 'user', 'USER_ID', true, null, null);
		$this->addForeignPrimaryKey('ART_REQUEST_ID', 'ArtRequestId', 'INTEGER' , 'art_request', 'ART_REQUEST_ID', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('ArtRequest', 'ORMModel\\ArtRequest', RelationMap::MANY_TO_ONE, array('art_request_id' => 'art_request_id', ), 'CASCADE', 'CASCADE');
		$this->addRelation('User', 'ORMModel\\User', RelationMap::MANY_TO_ONE, array('user_id' => 'user_id', ), 'CASCADE', 'CASCADE');
	} // buildRelations()

} // ArtRequestArtStatusTableMap
