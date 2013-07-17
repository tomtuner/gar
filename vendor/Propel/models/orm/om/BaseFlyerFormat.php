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
use ORMModel\FlyerArtRequest;
use ORMModel\FlyerArtRequestQuery;
use ORMModel\FlyerFormatPeer;
use ORMModel\FlyerFormatQuery;

/**
 * Base class that represents a row from the 'flyer_format' table.
 *
 * 
 *
 * @package    propel.generator.orm.om
 */
abstract class BaseFlyerFormat extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'ORMModel\\FlyerFormatPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        FlyerFormatPeer
	 */
	protected static $peer;

	/**
	 * The flag var to prevent infinit loop in deep copy
	 * @var       boolean
	 */
	protected $startCopy = false;

	/**
	 * The value for the flyer_format_id field.
	 * @var        int
	 */
	protected $flyer_format_id;

	/**
	 * The value for the flyer_format_type field.
	 * @var        string
	 */
	protected $flyer_format_type;

	/**
	 * @var        array FlyerArtRequest[] Collection to store aggregation of FlyerArtRequest objects.
	 */
	protected $collFlyerArtRequests;

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
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $flyerArtRequestsScheduledForDeletion = null;

	/**
	 * Get the [flyer_format_id] column value.
	 * 
	 * @return     int
	 */
	public function getFlyerFormatId()
	{
		return $this->flyer_format_id;
	}

	/**
	 * Get the [flyer_format_type] column value.
	 * 
	 * @return     string
	 */
	public function getFlyerFormatType()
	{
		return $this->flyer_format_type;
	}

	/**
	 * Set the value of [flyer_format_id] column.
	 * 
	 * @param      int $v new value
	 * @return     FlyerFormat The current object (for fluent API support)
	 */
	public function setFlyerFormatId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->flyer_format_id !== $v) {
			$this->flyer_format_id = $v;
			$this->modifiedColumns[] = FlyerFormatPeer::FLYER_FORMAT_ID;
		}

		return $this;
	} // setFlyerFormatId()

	/**
	 * Set the value of [flyer_format_type] column.
	 * 
	 * @param      string $v new value
	 * @return     FlyerFormat The current object (for fluent API support)
	 */
	public function setFlyerFormatType($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->flyer_format_type !== $v) {
			$this->flyer_format_type = $v;
			$this->modifiedColumns[] = FlyerFormatPeer::FLYER_FORMAT_TYPE;
		}

		return $this;
	} // setFlyerFormatType()

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

			$this->flyer_format_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->flyer_format_type = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 2; // 2 = FlyerFormatPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating FlyerFormat object", $e);
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
			$con = Propel::getConnection(FlyerFormatPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = FlyerFormatPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collFlyerArtRequests = null;

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
			$con = Propel::getConnection(FlyerFormatPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = FlyerFormatQuery::create()
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
			$con = Propel::getConnection(FlyerFormatPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				FlyerFormatPeer::addInstanceToPool($this);
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

			if ($this->isNew() || $this->isModified()) {
				// persist changes
				if ($this->isNew()) {
					$this->doInsert($con);
				} else {
					$this->doUpdate($con);
				}
				$affectedRows += 1;
				$this->resetModified();
			}

			if ($this->flyerArtRequestsScheduledForDeletion !== null) {
				if (!$this->flyerArtRequestsScheduledForDeletion->isEmpty()) {
					FlyerArtRequestQuery::create()
						->filterByPrimaryKeys($this->flyerArtRequestsScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->flyerArtRequestsScheduledForDeletion = null;
				}
			}

			if ($this->collFlyerArtRequests !== null) {
				foreach ($this->collFlyerArtRequests as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
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

		$this->modifiedColumns[] = FlyerFormatPeer::FLYER_FORMAT_ID;
		if (null !== $this->flyer_format_id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . FlyerFormatPeer::FLYER_FORMAT_ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(FlyerFormatPeer::FLYER_FORMAT_ID)) {
			$modifiedColumns[':p' . $index++]  = '`FLYER_FORMAT_ID`';
		}
		if ($this->isColumnModified(FlyerFormatPeer::FLYER_FORMAT_TYPE)) {
			$modifiedColumns[':p' . $index++]  = '`FLYER_FORMAT_TYPE`';
		}

		$sql = sprintf(
			'INSERT INTO `flyer_format` (%s) VALUES (%s)',
			implode(', ', $modifiedColumns),
			implode(', ', array_keys($modifiedColumns))
		);

		try {
			$stmt = $con->prepare($sql);
			foreach ($modifiedColumns as $identifier => $columnName) {
				switch ($columnName) {
					case '`FLYER_FORMAT_ID`':
						$stmt->bindValue($identifier, $this->flyer_format_id, PDO::PARAM_INT);
						break;
					case '`FLYER_FORMAT_TYPE`':
						$stmt->bindValue($identifier, $this->flyer_format_type, PDO::PARAM_STR);
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
		$this->setFlyerFormatId($pk);

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


			if (($retval = FlyerFormatPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collFlyerArtRequests !== null) {
					foreach ($this->collFlyerArtRequests as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
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
		$pos = FlyerFormatPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getFlyerFormatId();
				break;
			case 1:
				return $this->getFlyerFormatType();
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
		if (isset($alreadyDumpedObjects['FlyerFormat'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['FlyerFormat'][$this->getPrimaryKey()] = true;
		$keys = FlyerFormatPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getFlyerFormatId(),
			$keys[1] => $this->getFlyerFormatType(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->collFlyerArtRequests) {
				$result['FlyerArtRequests'] = $this->collFlyerArtRequests->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
		$pos = FlyerFormatPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setFlyerFormatId($value);
				break;
			case 1:
				$this->setFlyerFormatType($value);
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
		$keys = FlyerFormatPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setFlyerFormatId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setFlyerFormatType($arr[$keys[1]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(FlyerFormatPeer::DATABASE_NAME);

		if ($this->isColumnModified(FlyerFormatPeer::FLYER_FORMAT_ID)) $criteria->add(FlyerFormatPeer::FLYER_FORMAT_ID, $this->flyer_format_id);
		if ($this->isColumnModified(FlyerFormatPeer::FLYER_FORMAT_TYPE)) $criteria->add(FlyerFormatPeer::FLYER_FORMAT_TYPE, $this->flyer_format_type);

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
		$criteria = new Criteria(FlyerFormatPeer::DATABASE_NAME);
		$criteria->add(FlyerFormatPeer::FLYER_FORMAT_ID, $this->flyer_format_id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getFlyerFormatId();
	}

	/**
	 * Generic method to set the primary key (flyer_format_id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setFlyerFormatId($key);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return null === $this->getFlyerFormatId();
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of FlyerFormat (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setFlyerFormatType($this->getFlyerFormatType());

		if ($deepCopy && !$this->startCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);
			// store object hash to prevent cycle
			$this->startCopy = true;

			foreach ($this->getFlyerArtRequests() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addFlyerArtRequest($relObj->copy($deepCopy));
				}
			}

			//unflag object copy
			$this->startCopy = false;
		} // if ($deepCopy)

		if ($makeNew) {
			$copyObj->setNew(true);
			$copyObj->setFlyerFormatId(NULL); // this is a auto-increment column, so set to default value
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
	 * @return     FlyerFormat Clone of current object.
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
	 * @return     FlyerFormatPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new FlyerFormatPeer();
		}
		return self::$peer;
	}


	/**
	 * Initializes a collection based on the name of a relation.
	 * Avoids crafting an 'init[$relationName]s' method name
	 * that wouldn't work when StandardEnglishPluralizer is used.
	 *
	 * @param      string $relationName The name of the relation to initialize
	 * @return     void
	 */
	public function initRelation($relationName)
	{
		if ('FlyerArtRequest' == $relationName) {
			return $this->initFlyerArtRequests();
		}
	}

	/**
	 * Clears out the collFlyerArtRequests collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addFlyerArtRequests()
	 */
	public function clearFlyerArtRequests()
	{
		$this->collFlyerArtRequests = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collFlyerArtRequests collection.
	 *
	 * By default this just sets the collFlyerArtRequests collection to an empty array (like clearcollFlyerArtRequests());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initFlyerArtRequests($overrideExisting = true)
	{
		if (null !== $this->collFlyerArtRequests && !$overrideExisting) {
			return;
		}
		$this->collFlyerArtRequests = new PropelObjectCollection();
		$this->collFlyerArtRequests->setModel('FlyerArtRequest');
	}

	/**
	 * Gets an array of FlyerArtRequest objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this FlyerFormat is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array FlyerArtRequest[] List of FlyerArtRequest objects
	 * @throws     PropelException
	 */
	public function getFlyerArtRequests($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collFlyerArtRequests || null !== $criteria) {
			if ($this->isNew() && null === $this->collFlyerArtRequests) {
				// return empty collection
				$this->initFlyerArtRequests();
			} else {
				$collFlyerArtRequests = FlyerArtRequestQuery::create(null, $criteria)
					->filterByFlyerFormat($this)
					->find($con);
				if (null !== $criteria) {
					return $collFlyerArtRequests;
				}
				$this->collFlyerArtRequests = $collFlyerArtRequests;
			}
		}
		return $this->collFlyerArtRequests;
	}

	/**
	 * Sets a collection of FlyerArtRequest objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $flyerArtRequests A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setFlyerArtRequests(PropelCollection $flyerArtRequests, PropelPDO $con = null)
	{
		$this->flyerArtRequestsScheduledForDeletion = $this->getFlyerArtRequests(new Criteria(), $con)->diff($flyerArtRequests);

		foreach ($flyerArtRequests as $flyerArtRequest) {
			// Fix issue with collection modified by reference
			if ($flyerArtRequest->isNew()) {
				$flyerArtRequest->setFlyerFormat($this);
			}
			$this->addFlyerArtRequest($flyerArtRequest);
		}

		$this->collFlyerArtRequests = $flyerArtRequests;
	}

	/**
	 * Returns the number of related FlyerArtRequest objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related FlyerArtRequest objects.
	 * @throws     PropelException
	 */
	public function countFlyerArtRequests(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collFlyerArtRequests || null !== $criteria) {
			if ($this->isNew() && null === $this->collFlyerArtRequests) {
				return 0;
			} else {
				$query = FlyerArtRequestQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByFlyerFormat($this)
					->count($con);
			}
		} else {
			return count($this->collFlyerArtRequests);
		}
	}

	/**
	 * Method called to associate a FlyerArtRequest object to this object
	 * through the FlyerArtRequest foreign key attribute.
	 *
	 * @param      FlyerArtRequest $l FlyerArtRequest
	 * @return     FlyerFormat The current object (for fluent API support)
	 */
	public function addFlyerArtRequest(FlyerArtRequest $l)
	{
		if ($this->collFlyerArtRequests === null) {
			$this->initFlyerArtRequests();
		}
		if (!$this->collFlyerArtRequests->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddFlyerArtRequest($l);
		}

		return $this;
	}

	/**
	 * @param	FlyerArtRequest $flyerArtRequest The flyerArtRequest object to add.
	 */
	protected function doAddFlyerArtRequest($flyerArtRequest)
	{
		$this->collFlyerArtRequests[]= $flyerArtRequest;
		$flyerArtRequest->setFlyerFormat($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this FlyerFormat is new, it will return
	 * an empty collection; or if this FlyerFormat has previously
	 * been saved, it will retrieve related FlyerArtRequests from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in FlyerFormat.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array FlyerArtRequest[] List of FlyerArtRequest objects
	 */
	public function getFlyerArtRequestsJoinFlyerSize($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = FlyerArtRequestQuery::create(null, $criteria);
		$query->joinWith('FlyerSize', $join_behavior);

		return $this->getFlyerArtRequests($query, $con);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this FlyerFormat is new, it will return
	 * an empty collection; or if this FlyerFormat has previously
	 * been saved, it will retrieve related FlyerArtRequests from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in FlyerFormat.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array FlyerArtRequest[] List of FlyerArtRequest objects
	 */
	public function getFlyerArtRequestsJoinArtRequest($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = FlyerArtRequestQuery::create(null, $criteria);
		$query->joinWith('ArtRequest', $join_behavior);

		return $this->getFlyerArtRequests($query, $con);
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->flyer_format_id = null;
		$this->flyer_format_type = null;
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
			if ($this->collFlyerArtRequests) {
				foreach ($this->collFlyerArtRequests as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		if ($this->collFlyerArtRequests instanceof PropelCollection) {
			$this->collFlyerArtRequests->clearIterator();
		}
		$this->collFlyerArtRequests = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(FlyerFormatPeer::DEFAULT_STRING_FORMAT);
	}

} // BaseFlyerFormat
