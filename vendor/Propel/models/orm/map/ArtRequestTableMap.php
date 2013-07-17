<?php

namespace ORMModel\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'art_request' table.
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
class ArtRequestTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'orm.map.ArtRequestTableMap';

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
		$this->setName('art_request');
		$this->setPhpName('ArtRequest');
		$this->setClassname('ORMModel\\ArtRequest');
		$this->setPackage('orm');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ART_REQUEST_ID', 'ArtRequestId', 'INTEGER', true, null, null);
		$this->addColumn('IS_STARTED', 'IsStarted', 'BOOLEAN', true, 1, false);
		$this->addColumn('IS_COMPLETED', 'IsCompleted', 'BOOLEAN', true, 1, false);
		$this->addColumn('IS_ARCHIVED', 'IsArchived', 'BOOLEAN', true, 1, false);
		$this->addColumn('IS_REQUEST_CONFIRMED', 'IsRequestConfirmed', 'BOOLEAN', true, 1, false);
		$this->addColumn('START_DATE', 'StartDate', 'TIMESTAMP', false, null, null);
		$this->addColumn('COMPLETION_DATE', 'CompletionDate', 'TIMESTAMP', false, null, null);
		$this->addColumn('DUE_DATE', 'DueDate', 'TIMESTAMP', true, null, null);
		$this->addForeignKey('ART_REQUESTOR_ID', 'ArtRequestorId', 'INTEGER', 'art_requestor', 'ART_REQUESTOR_ID', true, null, null);
		$this->addForeignKey('ART_REQUEST_TYPE_ID', 'ArtRequestTypeId', 'INTEGER', 'art_request_type', 'ART_REQUEST_TYPE_ID', true, null, null);
		$this->addForeignKey('EVENT_ID', 'EventId', 'INTEGER', 'event', 'EVENT_ID', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('ArtRequestor', 'ORMModel\\ArtRequestor', RelationMap::MANY_TO_ONE, array('art_requestor_id' => 'art_requestor_id', ), 'CASCADE', 'CASCADE');
		$this->addRelation('ArtRequestType', 'ORMModel\\ArtRequestType', RelationMap::MANY_TO_ONE, array('art_request_type_id' => 'art_request_type_id', ), 'CASCADE', 'CASCADE');
		$this->addRelation('Event', 'ORMModel\\Event', RelationMap::MANY_TO_ONE, array('event_id' => 'event_id', ), 'CASCADE', 'CASCADE');
		$this->addRelation('ArtRequestArtStatus', 'ORMModel\\ArtRequestArtStatus', RelationMap::ONE_TO_MANY, array('art_request_id' => 'art_request_id', ), 'CASCADE', 'CASCADE', 'ArtRequestArtStatuss');
		$this->addRelation('ArtRequestComment', 'ORMModel\\ArtRequestComment', RelationMap::ONE_TO_MANY, array('art_request_id' => 'art_request_id', ), 'CASCADE', 'CASCADE', 'ArtRequestComments');
		$this->addRelation('ArtRequestDocument', 'ORMModel\\ArtRequestDocument', RelationMap::ONE_TO_MANY, array('art_request_id' => 'art_request_id', ), 'CASCADE', 'CASCADE', 'ArtRequestDocuments');
		$this->addRelation('BannerRequest', 'ORMModel\\BannerRequest', RelationMap::ONE_TO_MANY, array('art_request_id' => 'art_request_id', ), 'CASCADE', 'CASCADE', 'BannerRequests');
		$this->addRelation('FlyerArtRequest', 'ORMModel\\FlyerArtRequest', RelationMap::ONE_TO_MANY, array('art_request_id' => 'art_request_id', ), 'CASCADE', 'CASCADE', 'FlyerArtRequests');
		$this->addRelation('LogoArtRequest', 'ORMModel\\LogoArtRequest', RelationMap::ONE_TO_MANY, array('art_request_id' => 'art_request_id', ), 'CASCADE', 'CASCADE', 'LogoArtRequests');
		$this->addRelation('OtherArtRequest', 'ORMModel\\OtherArtRequest', RelationMap::ONE_TO_MANY, array('art_request_id' => 'art_request_id', ), 'CASCADE', 'CASCADE', 'OtherArtRequests');
	} // buildRelations()

} // ArtRequestTableMap
