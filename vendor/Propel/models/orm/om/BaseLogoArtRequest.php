<?php

namespace ORMModel\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use ORMModel\ArtRequest;
use ORMModel\ArtRequestQuery;
use ORMModel\LogoArtRequestPeer;
use ORMModel\LogoArtRequestQuery;

/**
 * Base class that represents a row from the 'logo_art_request' table.
 *
 * 
 *
 * @package    propel.generator.orm.om
 */
abstract class BaseLogoArtRequest extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'ORMModel\\LogoArtRequestPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        LogoArtRequestPeer
	 */
	protected static $peer;

	/**
	 * The flag var to prevent infinit loop in deep copy
	 * @var       boolean
	 */
	protected $startCopy = false;

	/**
	 * The value for the logo_art_request_id field.
	 * @var        int
	 */
	protected $logo_art_request_id;

	/**
	 * The value for the description_text field.
	 * @var        resource
	 */
	protected $description_text;

	/**
	 * The value for the art_request_id field.
	 * @var        int
	 */
	protected $art_request_id;

	/**
	 * @var        ArtRequest
	 */
	protected $aArtRequest;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	/**
	 * Get the [logo_art_request_id] column value.
	 * 
	 * @return     int
	 */
	public function getLogoArtRequestId()
	{
		return $this->logo_art_request_id;
	}

	/**
	 * Get the [description_text] column value.
	 * 
	 * @return     resource
	 */
	public function getDescriptionText()
	{
		return $this->description_text;
	}

	/**
	 * Get the [art_request_id] column value.
	 * 
	 * @return     int
	 */
	public function getArtRequestId()
	{
		return $this->art_request_id;
	}

	/**
	 * Set the value of [logo_art_request_id] column.
	 * 
	 * @param      int $v new value
	 * @return     LogoArtRequest The current object (for fluent API support)
	 */
	public function setLogoArtRequestId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->logo_art_request_id !== $v) {
			$this->logo_art_request_id = $v;
			$this->modifiedColumns[] = LogoArtRequestPeer::LOGO_ART_REQUEST_ID;
		}

		return $this;
	} // setLogoArtRequestId()

	/**
	 * Set the value of [description_text] column.
	 * 
	 * @param      resource $v new value
	 * @return     LogoArtRequest The current object (for fluent API support)
	 */
	public function setDescriptionText($v)
	{
		// Because BLOB columns are streams in PDO we have to assume that they are
		// always modified when a new value is passed in.  For example, the contents
		// of the stream itself may have changed externally.
		if (!is_resource($v) && $v !== null) {
			$this->description_text = fopen('php://memory', 'r+');
			fwrite($this->description_text, $v);
			rewind($this->description_text);
		} else { // it's already a stream
			$this->description_text = $v;
		}
		$this->modifiedColumns[] = LogoArtRequestPeer::DESCRIPTION_TEXT;

		return $this;
	} // setDescriptionText()

	/**
	 * Set the value of [art_request_id] column.
	 * 
	 * @param      int $v new value
	 * @return     LogoArtRequest The current object (for fluent API support)
	 */
	public function setArtRequestId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->art_request_id !== $v) {
			$this->art_request_id = $v;
			$this->modifiedColumns[] = LogoArtRequestPeer::ART_REQUEST_ID;
		}

		if ($this->aArtRequest !== null && $this->aArtRequest->getArtRequestId() !== $v) {
			$this->aArtRequest = null;
		}

		return $this;
	} // setArtRequestId()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->logo_art_request_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			if ($row[$startcol + 1] !== null) {
				$this->description_text = fopen('php://memory', 'r+');
				fwrite($this->description_text, $row[$startcol + 1]);
				rewind($this->description_text);
			} else {
				$this->description_text = null;
			}
			$this->art_request_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 3; // 3 = LogoArtRequestPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating LogoArtRequest object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

		if ($this->aArtRequest !== null && $this->art_request_id !== $this->aArtRequest->getArtRequestId()) {
			$this->aArtRequest = null;
		}
	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(LogoArtRequestPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = LogoArtRequestPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aArtRequest = null;
		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(LogoArtRequestPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = LogoArtRequestQuery::create()
				->filterByPrimaryKey($this->getPrimaryKey());
			$ret = $this->preDelete($con);
			if ($ret) {
				$deleteQuery->delete($con);
				$this->postDelete($con);
				$con->commit();
				$this->setDeleted(true);
			} else {
				$con->commit();
			}
		} catch (Exception $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(LogoArtRequestPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
			} else {
				$ret = $ret && $this->preUpdate($con);
			}
			if ($ret) {
				$affectedRows = $this->doSave($con);
				if ($isInsert) {
					$this->postInsert($con);
				} else {
					$this->postUpdate($con);
				}
				$this->postSave($con);
				LogoArtRequestPeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
			return $affectedRows;
		} catch (Exception $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aArtRequest !== null) {
				if ($this->aArtRequest->isModified() || $this->aArtRequest->isNew()) {
					$affectedRows += $this->aArtRequest->save($con);
				}
				$this->setArtRequest($this->aArtRequest);
			}

			if ($this->isNew() || $this->isModified()) {
				// persist changes
				if ($this->isNew()) {
					$this->doInsert($con);
				} else {
					$this->doUpdate($con);
				}
				$affectedRows += 1;
				// Rewind the description_text LOB column, since PDO does not rewind after inserting value.
				if ($this->description_text !== null && is_resource($this->description_text)) {
					rewind($this->description_text);
				}

				$this->resetModified();
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Insert the row in the database.
	 *
	 * @param      PropelPDO $con
	 *
	 * @throws     PropelException
	 * @see        doSave()
	 */
	protected function doInsert(PropelPDO $con)
	{
		$modifiedColumns = array();
		$index = 0;

		$this->modifiedColumns[] = LogoArtRequestPeer::LOGO_ART_REQUEST_ID;
		if (null !== $this->logo_art_request_id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . LogoArtRequestPeer::LOGO_ART_REQUEST_ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(LogoArtRequestPeer::LOGO_ART_REQUEST_ID)) {
			$modifiedColumns[':p' . $index++]  = '`LOGO_ART_REQUEST_ID`';
		}
		if ($this->isColumnModified(LogoArtRequestPeer::DESCRIPTION_TEXT)) {
			$modifiedColumns[':p' . $index++]  = '`DESCRIPTION_TEXT`';
		}
		if ($this->isColumnModified(LogoArtRequestPeer::ART_REQUEST_ID)) {
			$modifiedColumns[':p' . $index++]  = '`ART_REQUEST_ID`';
		}

		$sql = sprintf(
			'INSERT INTO `logo_art_request` (%s) VALUES (%s)',
			implode(', ', $modifiedColumns),
			implode(', ', array_keys($modifiedColumns))
		);

		try {
			$stmt = $con->prepare($sql);
			foreach ($modifiedColumns as $identifier => $columnName) {
				switch ($columnName) {
					case '`LOGO_ART_REQUEST_ID`':
						$stmt->bindValue($identifier, $this->logo_art_request_id, PDO::PARAM_INT);
						break;
					case '`DESCRIPTION_TEXT`':
						if (is_resource($this->description_text)) {
							rewind($this->description_text);
						}
						$stmt->bindValue($identifier, $this->description_text, PDO::PARAM_LOB);
						break;
					case '`ART_REQUEST_ID`':
						$stmt->bindValue($identifier, $this->art_request_id, PDO::PARAM_INT);
						break;
				}
			}
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
		}

		try {
			$pk = $con->lastInsertId();
		} catch (Exception $e) {
			throw new PropelException('Unable to get autoincrement id.', $e);
		}
		$this->setLogoArtRequestId($pk);

		$this->setNew(false);
	}

	/**
	 * Update the row in the database.
	 *
	 * @param      PropelPDO $con
	 *
	 * @see        doSave()
	 */
	protected function doUpdate(PropelPDO $con)
	{
		$selectCriteria = $this->buildPkeyCriteria();
		$valuesCriteria = $this->buildCriteria();
		BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
	}

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aArtRequest !== null) {
				if (!$this->aArtRequest->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aArtRequest->getValidationFailures());
				}
			}


			if (($retval = LogoArtRequestPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = LogoArtRequestPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getLogoArtRequestId();
				break;
			case 1:
				return $this->getDescriptionText();
				break;
			case 2:
				return $this->getArtRequestId();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 *                    Defaults to BasePeer::TYPE_PHPNAME.
	 * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
	 * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
	 * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
	 *
	 * @return    array an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
	{
		if (isset($alreadyDumpedObjects['LogoArtRequest'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['LogoArtRequest'][$this->getPrimaryKey()] = true;
		$keys = LogoArtRequestPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getLogoArtRequestId(),
			$keys[1] => $this->getDescriptionText(),
			$keys[2] => $this->getArtRequestId(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aArtRequest) {
				$result['ArtRequest'] = $this->aArtRequest->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
		}
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = LogoArtRequestPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setLogoArtRequestId($value);
				break;
			case 1:
				$this->setDescriptionText($value);
				break;
			case 2:
				$this->setArtRequestId($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = LogoArtRequestPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setLogoArtRequestId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDescriptionText($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setArtRequestId($arr[$keys[2]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(LogoArtRequestPeer::DATABASE_NAME);

		if ($this->isColumnModified(LogoArtRequestPeer::LOGO_ART_REQUEST_ID)) $criteria->add(LogoArtRequestPeer::LOGO_ART_REQUEST_ID, $this->logo_art_request_id);
		if ($this->isColumnModified(LogoArtRequestPeer::DESCRIPTION_TEXT)) $criteria->add(LogoArtRequestPeer::DESCRIPTION_TEXT, $this->description_text);
		if ($this->isColumnModified(LogoArtRequestPeer::ART_REQUEST_ID)) $criteria->add(LogoArtRequestPeer::ART_REQUEST_ID, $this->art_request_id);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(LogoArtRequestPeer::DATABASE_NAME);
		$criteria->add(LogoArtRequestPeer::LOGO_ART_REQUEST_ID, $this->logo_art_request_id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getLogoArtRequestId();
	}

	/**
	 * Generic method to set the primary key (logo_art_request_id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setLogoArtRequestId($key);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return null === $this->getLogoArtRequestId();
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of LogoArtRequest (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setDescriptionText($this->getDescriptionText());
		$copyObj->setArtRequestId($this->getArtRequestId());

		if ($deepCopy && !$this->startCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);
			// store object hash to prevent cycle
			$this->startCopy = true;

			//unflag object copy
			$this->startCopy = false;
		} // if ($deepCopy)

		if ($makeNew) {
			$copyObj->setNew(true);
			$copyObj->setLogoArtRequestId(NULL); // this is a auto-increment column, so set to default value
		}
	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     LogoArtRequest Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     LogoArtRequestPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new LogoArtRequestPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a ArtRequest object.
	 *
	 * @param      ArtRequest $v
	 * @return     LogoArtRequest The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setArtRequest(ArtRequest $v = null)
	{
		if ($v === null) {
			$this->setArtRequestId(NULL);
		} else {
			$this->setArtRequestId($v->getArtRequestId());
		}

		$this->aArtRequest = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the ArtRequest object, it will not be re-added.
		if ($v !== null) {
			$v->addLogoArtRequest($this);
		}

		return $this;
	}


	/**
	 * Get the associated ArtRequest object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     ArtRequest The associated ArtRequest object.
	 * @throws     PropelException
	 */
	public function getArtRequest(PropelPDO $con = null)
	{
		if ($this->aArtRequest === null && ($this->art_request_id !== null)) {
			$this->aArtRequest = ArtRequestQuery::create()->findPk($this->art_request_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aArtRequest->addLogoArtRequests($this);
			 */
		}
		return $this->aArtRequest;
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->logo_art_request_id = null;
		$this->description_text = null;
		$this->art_request_id = null;
		$this->alreadyInSave = false;
		$this->alreadyInValidation = false;
		$this->clearAllReferences();
		$this->resetModified();
		$this->setNew(true);
		$this->setDeleted(false);
	}

	/**
	 * Resets all references to other model objects or collections of model objects.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect
	 * objects with circular references (even in PHP 5.3). This is currently necessary
	 * when using Propel in certain daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all referrer objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} // if ($deep)

		$this->aArtRequest = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(LogoArtRequestPeer::DEFAULT_STRING_FORMAT);
	}

} // BaseLogoArtRequest
