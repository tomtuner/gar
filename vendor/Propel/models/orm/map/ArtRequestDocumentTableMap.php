<?php

namespace ORMModel\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'art_request_document' table.
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
class ArtRequestDocumentTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'orm.map.ArtRequestDocumentTableMap';

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
		$this->setName('art_request_document');
		$this->setPhpName('ArtRequestDocument');
		$this->setClassname('ORMModel\\ArtRequestDocument');
		$this->setPackage('orm');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ART_REQUEST_DOCUMENT_ID', 'ArtRequestDocumentId', 'INTEGER', true, null, null);
		$this->addForeignKey('ART_REQUEST_ID', 'ArtRequestId', 'INTEGER', 'art_request', 'ART_REQUEST_ID', true, null, null);
		$this->addColumn('FILE_NAME', 'FileName', 'VARCHAR', true, 100, null);
		$this->addColumn('FILE_DESCRIPTION', 'FileDescription', 'VARCHAR', true, 500, null);
		$this->addColumn('EXTENSION_TYPE', 'ExtensionType', 'VARCHAR', true, 3, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('ArtRequest', 'ORMModel\\ArtRequest', RelationMap::MANY_TO_ONE, array('art_request_id' => 'art_request_id', ), 'CASCADE', 'CASCADE');
	} // buildRelations()

} // ArtRequestDocumentTableMap
