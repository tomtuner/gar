<?php

namespace GARecruitingORM\om;

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
use GARecruitingORM\ApplicantPosition;
use GARecruitingORM\ApplicantPositionQuery;
use GARecruitingORM\Position;
use GARecruitingORM\PositionNotificationGroup;
use GARecruitingORM\PositionNotificationGroupQuery;
use GARecruitingORM\PositionPeer;
use GARecruitingORM\PositionQuery;

/**
 * Base class that represents a row from the 'position' table.
 *
 *
 *
 * @package    propel.generator.garecruiting.om
 */
abstract class BasePosition extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'GARecruitingORM\\PositionPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        PositionPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the position_id field.
     * @var        int
     */
    protected $position_id;

    /**
     * The value for the position_name field.
     * @var        string
     */
    protected $position_name;

    /**
     * The value for the department_name field.
     * @var        string
     */
    protected $department_name;

    /**
     * The value for the is_active field.
     * @var        int
     */
    protected $is_active;

    /**
     * @var        PropelObjectCollection|ApplicantPosition[] Collection to store aggregation of ApplicantPosition objects.
     */
    protected $collApplicantPositions;
    protected $collApplicantPositionsPartial;

    /**
     * @var        PropelObjectCollection|PositionNotificationGroup[] Collection to store aggregation of PositionNotificationGroup objects.
     */
    protected $collPositionNotificationGroups;
    protected $collPositionNotificationGroupsPartial;

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
     * @var		PropelObjectCollection
     */
    protected $applicantPositionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $positionNotificationGroupsScheduledForDeletion = null;

    /**
     * Get the [position_id] column value.
     *
     * @return int
     */
    public function getPositionId()
    {
        return $this->position_id;
    }

    /**
     * Get the [position_name] column value.
     *
     * @return string
     */
    public function getPositionName()
    {
        return $this->position_name;
    }

    /**
     * Get the [department_name] column value.
     *
     * @return string
     */
    public function getDepartmentName()
    {
        return $this->department_name;
    }

    /**
     * Get the [is_active] column value.
     *
     * @return int
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * Set the value of [position_id] column.
     *
     * @param int $v new value
     * @return Position The current object (for fluent API support)
     */
    public function setPositionId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->position_id !== $v) {
            $this->position_id = $v;
            $this->modifiedColumns[] = PositionPeer::POSITION_ID;
        }


        return $this;
    } // setPositionId()

    /**
     * Set the value of [position_name] column.
     *
     * @param string $v new value
     * @return Position The current object (for fluent API support)
     */
    public function setPositionName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->position_name !== $v) {
            $this->position_name = $v;
            $this->modifiedColumns[] = PositionPeer::POSITION_NAME;
        }


        return $this;
    } // setPositionName()

    /**
     * Set the value of [department_name] column.
     *
     * @param string $v new value
     * @return Position The current object (for fluent API support)
     */
    public function setDepartmentName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->department_name !== $v) {
            $this->department_name = $v;
            $this->modifiedColumns[] = PositionPeer::DEPARTMENT_NAME;
        }


        return $this;
    } // setDepartmentName()

    /**
     * Set the value of [is_active] column.
     *
     * @param int $v new value
     * @return Position The current object (for fluent API support)
     */
    public function setIsActive($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->is_active !== $v) {
            $this->is_active = $v;
            $this->modifiedColumns[] = PositionPeer::IS_ACTIVE;
        }


        return $this;
    } // setIsActive()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return true
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
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->position_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->position_name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->department_name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->is_active = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 4; // 4 = PositionPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Position object", $e);
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
     * @throws PropelException
     */
    public function ensureConsistency()
    {

    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
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
            $con = Propel::getConnection(PositionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = PositionPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collApplicantPositions = null;

            $this->collPositionNotificationGroups = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(PositionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = PositionQuery::create()
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
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(PositionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                PositionPeer::addInstanceToPool($this);
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
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
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

            if ($this->applicantPositionsScheduledForDeletion !== null) {
                if (!$this->applicantPositionsScheduledForDeletion->isEmpty()) {
                    ApplicantPositionQuery::create()
                        ->filterByPrimaryKeys($this->applicantPositionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->applicantPositionsScheduledForDeletion = null;
                }
            }

            if ($this->collApplicantPositions !== null) {
                foreach ($this->collApplicantPositions as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->positionNotificationGroupsScheduledForDeletion !== null) {
                if (!$this->positionNotificationGroupsScheduledForDeletion->isEmpty()) {
                    PositionNotificationGroupQuery::create()
                        ->filterByPrimaryKeys($this->positionNotificationGroupsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->positionNotificationGroupsScheduledForDeletion = null;
                }
            }

            if ($this->collPositionNotificationGroups !== null) {
                foreach ($this->collPositionNotificationGroups as $referrerFK) {
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
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = PositionPeer::POSITION_ID;
        if (null !== $this->position_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PositionPeer::POSITION_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PositionPeer::POSITION_ID)) {
            $modifiedColumns[':p' . $index++]  = '`POSITION_ID`';
        }
        if ($this->isColumnModified(PositionPeer::POSITION_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`POSITION_NAME`';
        }
        if ($this->isColumnModified(PositionPeer::DEPARTMENT_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`DEPARTMENT_NAME`';
        }
        if ($this->isColumnModified(PositionPeer::IS_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`IS_ACTIVE`';
        }

        $sql = sprintf(
            'INSERT INTO `position` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`POSITION_ID`':
                        $stmt->bindValue($identifier, $this->position_id, PDO::PARAM_INT);
                        break;
                    case '`POSITION_NAME`':
                        $stmt->bindValue($identifier, $this->position_name, PDO::PARAM_STR);
                        break;
                    case '`DEPARTMENT_NAME`':
                        $stmt->bindValue($identifier, $this->department_name, PDO::PARAM_STR);
                        break;
                    case '`IS_ACTIVE`':
                        $stmt->bindValue($identifier, $this->is_active, PDO::PARAM_INT);
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
        $this->setPositionId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
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
     * @return array ValidationFailed[]
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
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
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
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            if (($retval = PositionPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collApplicantPositions !== null) {
                    foreach ($this->collApplicantPositions as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collPositionNotificationGroups !== null) {
                    foreach ($this->collPositionNotificationGroups as $referrerFK) {
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
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = PositionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getPositionId();
                break;
            case 1:
                return $this->getPositionName();
                break;
            case 2:
                return $this->getDepartmentName();
                break;
            case 3:
                return $this->getIsActive();
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
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['Position'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Position'][$this->getPrimaryKey()] = true;
        $keys = PositionPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getPositionId(),
            $keys[1] => $this->getPositionName(),
            $keys[2] => $this->getDepartmentName(),
            $keys[3] => $this->getIsActive(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collApplicantPositions) {
                $result['ApplicantPositions'] = $this->collApplicantPositions->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPositionNotificationGroups) {
                $result['PositionNotificationGroups'] = $this->collPositionNotificationGroups->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = PositionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setPositionId($value);
                break;
            case 1:
                $this->setPositionName($value);
                break;
            case 2:
                $this->setDepartmentName($value);
                break;
            case 3:
                $this->setIsActive($value);
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
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = PositionPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setPositionId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setPositionName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setDepartmentName($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setIsActive($arr[$keys[3]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(PositionPeer::DATABASE_NAME);

        if ($this->isColumnModified(PositionPeer::POSITION_ID)) $criteria->add(PositionPeer::POSITION_ID, $this->position_id);
        if ($this->isColumnModified(PositionPeer::POSITION_NAME)) $criteria->add(PositionPeer::POSITION_NAME, $this->position_name);
        if ($this->isColumnModified(PositionPeer::DEPARTMENT_NAME)) $criteria->add(PositionPeer::DEPARTMENT_NAME, $this->department_name);
        if ($this->isColumnModified(PositionPeer::IS_ACTIVE)) $criteria->add(PositionPeer::IS_ACTIVE, $this->is_active);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(PositionPeer::DATABASE_NAME);
        $criteria->add(PositionPeer::POSITION_ID, $this->position_id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getPositionId();
    }

    /**
     * Generic method to set the primary key (position_id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setPositionId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getPositionId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Position (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setPositionName($this->getPositionName());
        $copyObj->setDepartmentName($this->getDepartmentName());
        $copyObj->setIsActive($this->getIsActive());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getApplicantPositions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addApplicantPosition($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPositionNotificationGroups() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPositionNotificationGroup($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setPositionId(NULL); // this is a auto-increment column, so set to default value
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
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return Position Clone of current object.
     * @throws PropelException
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
     * @return PositionPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new PositionPeer();
        }

        return self::$peer;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('ApplicantPosition' == $relationName) {
            $this->initApplicantPositions();
        }
        if ('PositionNotificationGroup' == $relationName) {
            $this->initPositionNotificationGroups();
        }
    }

    /**
     * Clears out the collApplicantPositions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addApplicantPositions()
     */
    public function clearApplicantPositions()
    {
        $this->collApplicantPositions = null; // important to set this to null since that means it is uninitialized
        $this->collApplicantPositionsPartial = null;
    }

    /**
     * reset is the collApplicantPositions collection loaded partially
     *
     * @return void
     */
    public function resetPartialApplicantPositions($v = true)
    {
        $this->collApplicantPositionsPartial = $v;
    }

    /**
     * Initializes the collApplicantPositions collection.
     *
     * By default this just sets the collApplicantPositions collection to an empty array (like clearcollApplicantPositions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initApplicantPositions($overrideExisting = true)
    {
        if (null !== $this->collApplicantPositions && !$overrideExisting) {
            return;
        }
        $this->collApplicantPositions = new PropelObjectCollection();
        $this->collApplicantPositions->setModel('ApplicantPosition');
    }

    /**
     * Gets an array of ApplicantPosition objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Position is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|ApplicantPosition[] List of ApplicantPosition objects
     * @throws PropelException
     */
    public function getApplicantPositions($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collApplicantPositionsPartial && !$this->isNew();
        if (null === $this->collApplicantPositions || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collApplicantPositions) {
                // return empty collection
                $this->initApplicantPositions();
            } else {
                $collApplicantPositions = ApplicantPositionQuery::create(null, $criteria)
                    ->filterByPosition($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collApplicantPositionsPartial && count($collApplicantPositions)) {
                      $this->initApplicantPositions(false);

                      foreach($collApplicantPositions as $obj) {
                        if (false == $this->collApplicantPositions->contains($obj)) {
                          $this->collApplicantPositions->append($obj);
                        }
                      }

                      $this->collApplicantPositionsPartial = true;
                    }

                    return $collApplicantPositions;
                }

                if($partial && $this->collApplicantPositions) {
                    foreach($this->collApplicantPositions as $obj) {
                        if($obj->isNew()) {
                            $collApplicantPositions[] = $obj;
                        }
                    }
                }

                $this->collApplicantPositions = $collApplicantPositions;
                $this->collApplicantPositionsPartial = false;
            }
        }

        return $this->collApplicantPositions;
    }

    /**
     * Sets a collection of ApplicantPosition objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $applicantPositions A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setApplicantPositions(PropelCollection $applicantPositions, PropelPDO $con = null)
    {
        $this->applicantPositionsScheduledForDeletion = $this->getApplicantPositions(new Criteria(), $con)->diff($applicantPositions);

        foreach ($this->applicantPositionsScheduledForDeletion as $applicantPositionRemoved) {
            $applicantPositionRemoved->setPosition(null);
        }

        $this->collApplicantPositions = null;
        foreach ($applicantPositions as $applicantPosition) {
            $this->addApplicantPosition($applicantPosition);
        }

        $this->collApplicantPositions = $applicantPositions;
        $this->collApplicantPositionsPartial = false;
    }

    /**
     * Returns the number of related ApplicantPosition objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related ApplicantPosition objects.
     * @throws PropelException
     */
    public function countApplicantPositions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collApplicantPositionsPartial && !$this->isNew();
        if (null === $this->collApplicantPositions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collApplicantPositions) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getApplicantPositions());
                }
                $query = ApplicantPositionQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByPosition($this)
                    ->count($con);
            }
        } else {
            return count($this->collApplicantPositions);
        }
    }

    /**
     * Method called to associate a ApplicantPosition object to this object
     * through the ApplicantPosition foreign key attribute.
     *
     * @param    ApplicantPosition $l ApplicantPosition
     * @return Position The current object (for fluent API support)
     */
    public function addApplicantPosition(ApplicantPosition $l)
    {
        if ($this->collApplicantPositions === null) {
            $this->initApplicantPositions();
            $this->collApplicantPositionsPartial = true;
        }
        if (!$this->collApplicantPositions->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddApplicantPosition($l);
        }

        return $this;
    }

    /**
     * @param	ApplicantPosition $applicantPosition The applicantPosition object to add.
     */
    protected function doAddApplicantPosition($applicantPosition)
    {
        $this->collApplicantPositions[]= $applicantPosition;
        $applicantPosition->setPosition($this);
    }

    /**
     * @param	ApplicantPosition $applicantPosition The applicantPosition object to remove.
     */
    public function removeApplicantPosition($applicantPosition)
    {
        if ($this->getApplicantPositions()->contains($applicantPosition)) {
            $this->collApplicantPositions->remove($this->collApplicantPositions->search($applicantPosition));
            if (null === $this->applicantPositionsScheduledForDeletion) {
                $this->applicantPositionsScheduledForDeletion = clone $this->collApplicantPositions;
                $this->applicantPositionsScheduledForDeletion->clear();
            }
            $this->applicantPositionsScheduledForDeletion[]= $applicantPosition;
            $applicantPosition->setPosition(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Position is new, it will return
     * an empty collection; or if this Position has previously
     * been saved, it will retrieve related ApplicantPositions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Position.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ApplicantPosition[] List of ApplicantPosition objects
     */
    public function getApplicantPositionsJoinApplicant($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ApplicantPositionQuery::create(null, $criteria);
        $query->joinWith('Applicant', $join_behavior);

        return $this->getApplicantPositions($query, $con);
    }

    /**
     * Clears out the collPositionNotificationGroups collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPositionNotificationGroups()
     */
    public function clearPositionNotificationGroups()
    {
        $this->collPositionNotificationGroups = null; // important to set this to null since that means it is uninitialized
        $this->collPositionNotificationGroupsPartial = null;
    }

    /**
     * reset is the collPositionNotificationGroups collection loaded partially
     *
     * @return void
     */
    public function resetPartialPositionNotificationGroups($v = true)
    {
        $this->collPositionNotificationGroupsPartial = $v;
    }

    /**
     * Initializes the collPositionNotificationGroups collection.
     *
     * By default this just sets the collPositionNotificationGroups collection to an empty array (like clearcollPositionNotificationGroups());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPositionNotificationGroups($overrideExisting = true)
    {
        if (null !== $this->collPositionNotificationGroups && !$overrideExisting) {
            return;
        }
        $this->collPositionNotificationGroups = new PropelObjectCollection();
        $this->collPositionNotificationGroups->setModel('PositionNotificationGroup');
    }

    /**
     * Gets an array of PositionNotificationGroup objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Position is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|PositionNotificationGroup[] List of PositionNotificationGroup objects
     * @throws PropelException
     */
    public function getPositionNotificationGroups($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collPositionNotificationGroupsPartial && !$this->isNew();
        if (null === $this->collPositionNotificationGroups || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPositionNotificationGroups) {
                // return empty collection
                $this->initPositionNotificationGroups();
            } else {
                $collPositionNotificationGroups = PositionNotificationGroupQuery::create(null, $criteria)
                    ->filterByPosition($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collPositionNotificationGroupsPartial && count($collPositionNotificationGroups)) {
                      $this->initPositionNotificationGroups(false);

                      foreach($collPositionNotificationGroups as $obj) {
                        if (false == $this->collPositionNotificationGroups->contains($obj)) {
                          $this->collPositionNotificationGroups->append($obj);
                        }
                      }

                      $this->collPositionNotificationGroupsPartial = true;
                    }

                    return $collPositionNotificationGroups;
                }

                if($partial && $this->collPositionNotificationGroups) {
                    foreach($this->collPositionNotificationGroups as $obj) {
                        if($obj->isNew()) {
                            $collPositionNotificationGroups[] = $obj;
                        }
                    }
                }

                $this->collPositionNotificationGroups = $collPositionNotificationGroups;
                $this->collPositionNotificationGroupsPartial = false;
            }
        }

        return $this->collPositionNotificationGroups;
    }

    /**
     * Sets a collection of PositionNotificationGroup objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $positionNotificationGroups A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setPositionNotificationGroups(PropelCollection $positionNotificationGroups, PropelPDO $con = null)
    {
        $this->positionNotificationGroupsScheduledForDeletion = $this->getPositionNotificationGroups(new Criteria(), $con)->diff($positionNotificationGroups);

        foreach ($this->positionNotificationGroupsScheduledForDeletion as $positionNotificationGroupRemoved) {
            $positionNotificationGroupRemoved->setPosition(null);
        }

        $this->collPositionNotificationGroups = null;
        foreach ($positionNotificationGroups as $positionNotificationGroup) {
            $this->addPositionNotificationGroup($positionNotificationGroup);
        }

        $this->collPositionNotificationGroups = $positionNotificationGroups;
        $this->collPositionNotificationGroupsPartial = false;
    }

    /**
     * Returns the number of related PositionNotificationGroup objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related PositionNotificationGroup objects.
     * @throws PropelException
     */
    public function countPositionNotificationGroups(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collPositionNotificationGroupsPartial && !$this->isNew();
        if (null === $this->collPositionNotificationGroups || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPositionNotificationGroups) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getPositionNotificationGroups());
                }
                $query = PositionNotificationGroupQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByPosition($this)
                    ->count($con);
            }
        } else {
            return count($this->collPositionNotificationGroups);
        }
    }

    /**
     * Method called to associate a PositionNotificationGroup object to this object
     * through the PositionNotificationGroup foreign key attribute.
     *
     * @param    PositionNotificationGroup $l PositionNotificationGroup
     * @return Position The current object (for fluent API support)
     */
    public function addPositionNotificationGroup(PositionNotificationGroup $l)
    {
        if ($this->collPositionNotificationGroups === null) {
            $this->initPositionNotificationGroups();
            $this->collPositionNotificationGroupsPartial = true;
        }
        if (!$this->collPositionNotificationGroups->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddPositionNotificationGroup($l);
        }

        return $this;
    }

    /**
     * @param	PositionNotificationGroup $positionNotificationGroup The positionNotificationGroup object to add.
     */
    protected function doAddPositionNotificationGroup($positionNotificationGroup)
    {
        $this->collPositionNotificationGroups[]= $positionNotificationGroup;
        $positionNotificationGroup->setPosition($this);
    }

    /**
     * @param	PositionNotificationGroup $positionNotificationGroup The positionNotificationGroup object to remove.
     */
    public function removePositionNotificationGroup($positionNotificationGroup)
    {
        if ($this->getPositionNotificationGroups()->contains($positionNotificationGroup)) {
            $this->collPositionNotificationGroups->remove($this->collPositionNotificationGroups->search($positionNotificationGroup));
            if (null === $this->positionNotificationGroupsScheduledForDeletion) {
                $this->positionNotificationGroupsScheduledForDeletion = clone $this->collPositionNotificationGroups;
                $this->positionNotificationGroupsScheduledForDeletion->clear();
            }
            $this->positionNotificationGroupsScheduledForDeletion[]= $positionNotificationGroup;
            $positionNotificationGroup->setPosition(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Position is new, it will return
     * an empty collection; or if this Position has previously
     * been saved, it will retrieve related PositionNotificationGroups from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Position.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|PositionNotificationGroup[] List of PositionNotificationGroup objects
     */
    public function getPositionNotificationGroupsJoinNotificationGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PositionNotificationGroupQuery::create(null, $criteria);
        $query->joinWith('NotificationGroup', $join_behavior);

        return $this->getPositionNotificationGroups($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->position_id = null;
        $this->position_name = null;
        $this->department_name = null;
        $this->is_active = null;
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
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collApplicantPositions) {
                foreach ($this->collApplicantPositions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPositionNotificationGroups) {
                foreach ($this->collPositionNotificationGroups as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collApplicantPositions instanceof PropelCollection) {
            $this->collApplicantPositions->clearIterator();
        }
        $this->collApplicantPositions = null;
        if ($this->collPositionNotificationGroups instanceof PropelCollection) {
            $this->collPositionNotificationGroups->clearIterator();
        }
        $this->collPositionNotificationGroups = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PositionPeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

}
