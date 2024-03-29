<?php

namespace ORMModel\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'user' table.
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
class UserTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'orm.map.UserTableMap';

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
		$this->setName('user');
		$this->setPhpName('User');
		$this->setClassname('ORMModel\\User');
		$this->setPackage('orm');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('USER_ID', 'UserId', 'INTEGER', true, null, null);
		$this->addColumn('USER_FIRST_NAME', 'UserFirstName', 'VARCHAR', true, 50, null);
		$this->addColumn('USER_LAST_NAME', 'UserLastName', 'VARCHAR', true, 50, null);
		$this->addColumn('USER_DCE_NAME', 'UserDceName', 'VARCHAR', true, 10, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('ArtRequestArtStatus', 'ORMModel\\ArtRequestArtStatus', RelationMap::ONE_TO_MANY, array('user_id' => 'user_id', ), 'CASCADE', 'CASCADE', 'ArtRequestArtStatuss');
		$this->addRelation('ArtRequestComment', 'ORMModel\\ArtRequestComment', RelationMap::ONE_TO_MANY, array('user_id' => 'user_id', ), 'CASCADE', 'CASCADE', 'ArtRequestComments');
	} // buildRelations()

} // UserTableMap
