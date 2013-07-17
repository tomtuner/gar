<?php

namespace ORMModel\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'art_request_comment' table.
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
class ArtRequestCommentTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'orm.map.ArtRequestCommentTableMap';

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
		$this->setName('art_request_comment');
		$this->setPhpName('ArtRequestComment');
		$this->setClassname('ORMModel\\ArtRequestComment');
		$this->setPackage('orm');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ART_REQUEST_COMMENT_ID', 'ArtRequestCommentId', 'INTEGER', true, null, null);
		$this->addForeignKey('ART_REQUEST_ID', 'ArtRequestId', 'INTEGER', 'art_request', 'ART_REQUEST_ID', true, null, null);
		$this->addColumn('COMMENT_TEXT', 'CommentText', 'BLOB', true, null, null);
		$this->addColumn('COMMENT_DATE', 'CommentDate', 'TIMESTAMP', true, null, null);
		$this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'user', 'USER_ID', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('User', 'ORMModel\\User', RelationMap::MANY_TO_ONE, array('user_id' => 'user_id', ), 'CASCADE', 'CASCADE');
		$this->addRelation('ArtRequest', 'ORMModel\\ArtRequest', RelationMap::MANY_TO_ONE, array('art_request_id' => 'art_request_id', ), 'CASCADE', 'CASCADE');
	} // buildRelations()

} // ArtRequestCommentTableMap
