<?php

namespace ORMModel\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'art_requestor' table.
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
class ArtRequestorTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'orm.map.ArtRequestorTableMap';

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
		$this->setName('art_requestor');
		$this->setPhpName('ArtRequestor');
		$this->setClassname('ORMModel\\ArtRequestor');
		$this->setPackage('orm');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ART_REQUESTOR_ID', 'ArtRequestorId', 'INTEGER', true, null, null);
		$this->addColumn('DCE_NAME', 'DceName', 'VARCHAR', true, 50, null);
		$this->addColumn('FIRST_NAME', 'FirstName', 'VARCHAR', true, 50, null);
		$this->addColumn('LAST_NAME', 'LastName', 'VARCHAR', true, 50, null);
		$this->addColumn('EMAIL_ADDRESS', 'EmailAddress', 'VARCHAR', true, 50, null);
		$this->addColumn('PHONE_NUMBER', 'PhoneNumber', 'VARCHAR', true, 12, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('ArtRequest', 'ORMModel\\ArtRequest', RelationMap::ONE_TO_MANY, array('art_requestor_id' => 'art_requestor_id', ), 'CASCADE', 'CASCADE', 'ArtRequests');
	} // buildRelations()

} // ArtRequestorTableMap
