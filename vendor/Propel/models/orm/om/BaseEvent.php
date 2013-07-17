<?php

namespace ORMModel\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \DateTime;
use \DateTimeZone;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelCollection;
use \PropelDateTime;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use ORMModel\ArtRequest;
use ORMModel\ArtRequestQuery;
use ORMModel\EventPeer;
use ORMModel\EventPrice;
use ORMModel\EventPriceQuery;
use ORMModel\EventQuery;

/**
 * Base class that represents a row from the 'event' table.
 *
 * 
 *
 * @package    propel.generator.orm.om
 */
abstract class BaseEvent extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'ORMModel\\EventPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        EventPeer
	 */
	protected static $peer;

	/**
	 * The flag var to prevent infinit loop in deep copy
	 * @var       boolean
	 */
	protected $startCopy = false;

	/**
	 * The value for the event_id field.
	 * @var        int
	 */
	protected $event_id;

	/**
	 * The value for the event_name field.
	 * @var        string
	 */
	protected $event_name;

	/**
	 * The value for the event_description field.
	 * @var        resource
	 */
	protected $event_description;

	/**
	 * The value for the event_location field.
	 * @var        string
	 */
	protected $event_location;

	/**
	 * The value for the event_sponsor_name field.
	 * @var        string
	 */
	protected $event_sponsor_name;

	/**
	 * The value for the event_start_time field.
	 * @var        string
	 */
	protected $event_start_time;

	/**
	 * The value for the event_end_time field.
	 * @var        string
	 */
	protected $event_end_time;

	/**
	 * @var        array ArtRequest[] Collection to store aggregation of ArtRequest objects.
	 */
	protected $collArtRequests;

	/**
	 * @var        array EventPrice[] Collection to store aggregation of EventPrice objects.
	 */
	protected $collEventPrices;

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
	protected $artRequestsScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $eventPricesScheduledForDeletion = null;

	/**
	 * Get the [event_id] column value.
	 * 
	 * @return     int
	 */
	public function getEventId()
	{
		return $this->event_id;
	}

	/**
	 * Get the [event_name] column value.
	 * 
	 * @return     string
	 */
	public function getEventName()
	{
		return $this->event_name;
	}

	/**
	 * Get the [event_description] column value.
	 * 
	 * @return     resource
	 */
	public function getEventDescription()
	{
		return $this->event_description;
	}

	/**
	 * Get the [event_location] column value.
	 * 
	 * @return     string
	 */
	public function getEventLocation()
	{
		return $this->event_location;
	}

	/**
	 * Get the [event_sponsor_name] column value.
	 * 
	 * @return     string
	 */
	public function getEventSponsorName()
	{
		return $this->event_sponsor_name;
	}

	/**
	 * Get the [optionally formatted] temporal [event_start_time] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getEventStartTime($format = 'Y-m-d H:i:s')
	{
		if ($this->event_start_time === null) {
			return null;
		}


		if ($this->event_start_time === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->event_start_time);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->event_start_time, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [optionally formatted] temporal [event_end_time] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getEventEndTime($format = 'Y-m-d H:i:s')
	{
		if ($this->event_end_time === null) {
			return null;
		}


		if ($this->event_end_time === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->event_end_time);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->event_end_time, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Set the value of [event_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Event The current object (for fluent API support)
	 */
	public function setEventId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->event_id !== $v) {
			$this->event_id = $v;
			$this->modifiedColumns[] = EventPeer::EVENT_ID;
		}

		return $this;
	} // setEventId()

	/**
	 * Set the value of [event_name] column.
	 * 
	 * @param      string $v new value
	 * @return     Event The current object (for fluent API support)
	 */
	public function setEventName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->event_name !== $v) {
			$this->event_name = $v;
			$this->modifiedColumns[] = EventPeer::EVENT_NAME;
		}

		return $this;
	} // setEventName()

	/**
	 * Set the value of [event_description] column.
	 * 
	 * @param      resource $v new value
	 * @return     Event The current object (for fluent API support)
	 */
	public function setEventDescription($v)
	{
		// Because BLOB columns are streams in PDO we have to assume that they are
		// always modified when a new value is passed in.  For example, the contents
		// of the stream itself may have changed externally.
		if (!is_resource($v) && $v !== null) {
			$this->event_description = fopen('php://memory', 'r+');
			fwrite($this->event_description, $v);
			rewind($this->event_description);
		} else { // it's already a stream
			$this->event_description = $v;
		}
		$this->modifiedColumns[] = EventPeer::EVENT_DESCRIPTION;

		return $this;
	} // setEventDescription()

	/**
	 * Set the value of [event_location] column.
	 * 
	 * @param      string $v new value
	 * @return     Event The current object (for fluent API support)
	 */
	public function setEventLocation($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->event_location !== $v) {
			$this->event_location = $v;
			$this->modifiedColumns[] = EventPeer::EVENT_LOCATION;
		}

		return $this;
	} // setEventLocation()

	/**
	 * Set the value of [event_sponsor_name] column.
	 * 
	 * @param      string $v new value
	 * @return     Event The current object (for fluent API support)
	 */
	public function setEventSponsorName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->event_sponsor_name !== $v) {
			$this->event_sponsor_name = $v;
			$this->modifiedColumns[] = EventPeer::EVENT_SPONSOR_NAME;
		}

		return $this;
	} // setEventSponsorName()

	/**
	 * Sets the value of [event_start_time] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     Event The current object (for fluent API support)
	 */
	public function setEventStartTime($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->event_start_time !== null || $dt !== null) {
			$currentDateAsString = ($this->event_start_time !== null && $tmpDt = new DateTime($this->event_start_time)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->event_start_time = $newDateAsString;
				$this->modifiedColumns[] = EventPeer::EVENT_START_TIME;
			}
		} // if either are not null

		return $this;
	} // setEventStartTime()

	/**
	 * Sets the value of [event_end_time] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     Event The current object (for fluent API support)
	 */
	public function setEventEndTime($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->event_end_time !== null || $dt !== null) {
			$currentDateAsString = ($this->event_end_time !== null && $tmpDt = new DateTime($this->event_end_time)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->event_end_time = $newDateAsString;
				$this->modifiedColumns[] = EventPeer::EVENT_END_TIME;
			}
		} // if either are not null

		return $this;
	} // setEventEndTime()

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

			$this->event_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->event_name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			if ($row[$startcol + 2] !== null) {
				$this->event_description = fopen('php://memory', 'r+');
				fwrite($this->event_description, $row[$startcol + 2]);
				rewind($this->event_description);
			} else {
				$this->event_description = null;
			}
			$this->event_location = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->event_sponsor_name = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->event_start_time = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->event_end_time = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 7; // 7 = EventPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Event object", $e);
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
			$con = Propel::getConnection(EventPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = EventPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collArtRequests = null;

			$this->collEventPrices = null;

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
			$con = Propel::getConnection(EventPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = EventQuery::create()
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
			$con = Propel::getConnection(EventPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				EventPeer::addInstanceToPool($this);
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
				// Rewind the event_description LOB column, since PDO does not rewind after inserting value.
				if ($this->event_description !== null && is_resource($this->event_description)) {
					rewind($this->event_description);
				}

				$this->resetModified();
			}

			if ($this->artRequestsScheduledForDeletion !== null) {
				if (!$this->artRequestsScheduledForDeletion->isEmpty()) {
					ArtRequestQuery::create()
						->filterByPrimaryKeys($this->artRequestsScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->artRequestsScheduledForDeletion = null;
				}
			}

			if ($this->collArtRequests !== null) {
				foreach ($this->collArtRequests as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->eventPricesScheduledForDeletion !== null) {
				if (!$this->eventPricesScheduledForDeletion->isEmpty()) {
					EventPriceQuery::create()
						->filterByPrimaryKeys($this->eventPricesScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->eventPricesScheduledForDeletion = null;
				}
			}

			if ($this->collEventPrices !== null) {
				foreach ($this->collEventPrices as $referrerFK) {
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

		$this->modifiedColumns[] = EventPeer::EVENT_ID;
		if (null !== $this->event_id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . EventPeer::EVENT_ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(EventPeer::EVENT_ID)) {
			$modifiedColumns[':p' . $index++]  = '`EVENT_ID`';
		}
		if ($this->isColumnModified(EventPeer::EVENT_NAME)) {
			$modifiedColumns[':p' . $index++]  = '`EVENT_NAME`';
		}
		if ($this->isColumnModified(EventPeer::EVENT_DESCRIPTION)) {
			$modifiedColumns[':p' . $index++]  = '`EVENT_DESCRIPTION`';
		}
		if ($this->isColumnModified(EventPeer::EVENT_LOCATION)) {
			$modifiedColumns[':p' . $index++]  = '`EVENT_LOCATION`';
		}
		if ($this->isColumnModified(EventPeer::EVENT_SPONSOR_NAME)) {
			$modifiedColumns[':p' . $index++]  = '`EVENT_SPONSOR_NAME`';
		}
		if ($this->isColumnModified(EventPeer::EVENT_START_TIME)) {
			$modifiedColumns[':p' . $index++]  = '`EVENT_START_TIME`';
		}
		if ($this->isColumnModified(EventPeer::EVENT_END_TIME)) {
			$modifiedColumns[':p' . $index++]  = '`EVENT_END_TIME`';
		}

		$sql = sprintf(
			'INSERT INTO `event` (%s) VALUES (%s)',
			implode(', ', $modifiedColumns),
			implode(', ', array_keys($modifiedColumns))
		);

		try {
			$stmt = $con->prepare($sql);
			foreach ($modifiedColumns as $identifier => $columnName) {
				switch ($columnName) {
					case '`EVENT_ID`':
						$stmt->bindValue($identifier, $this->event_id, PDO::PARAM_INT);
						break;
					case '`EVENT_NAME`':
						$stmt->bindValue($identifier, $this->event_name, PDO::PARAM_STR);
						break;
					case '`EVENT_DESCRIPTION`':
						if (is_resource($this->event_description)) {
							rewind($this->event_description);
						}
						$stmt->bindValue($identifier, $this->event_description, PDO::PARAM_LOB);
						break;
					case '`EVENT_LOCATION`':
						$stmt->bindValue($identifier, $this->event_location, PDO::PARAM_STR);
						break;
					case '`EVENT_SPONSOR_NAME`':
						$stmt->bindValue($identifier, $this->event_sponsor_name, PDO::PARAM_STR);
						break;
					case '`EVENT_START_TIME`':
						$stmt->bindValue($identifier, $this->event_start_time, PDO::PARAM_STR);
						break;
					case '`EVENT_END_TIME`':
						$stmt->bindValue($identifier, $this->event_end_time, PDO::PARAM_STR);
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
		$this->setEventId($pk);

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


			if (($retval = EventPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collArtRequests !== null) {
					foreach ($this->collArtRequests as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEventPrices !== null) {
					foreach ($this->collEventPrices as $referrerFK) {
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
		$pos = EventPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getEventId();
				break;
			case 1:
				return $this->getEventName();
				break;
			case 2:
				return $this->getEventDescription();
				break;
			case 3:
				return $this->getEventLocation();
				break;
			case 4:
				return $this->getEventSponsorName();
				break;
			case 5:
				return $this->getEventStartTime();
				break;
			case 6:
				return $this->getEventEndTime();
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
		if (isset($alreadyDumpedObjects['Event'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Event'][$this->getPrimaryKey()] = true;
		$keys = EventPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getEventId(),
			$keys[1] => $this->getEventName(),
			$keys[2] => $this->getEventDescription(),
			$keys[3] => $this->getEventLocation(),
			$keys[4] => $this->getEventSponsorName(),
			$keys[5] => $this->getEventStartTime(),
			$keys[6] => $this->getEventEndTime(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->collArtRequests) {
				$result['ArtRequests'] = $this->collArtRequests->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collEventPrices) {
				$result['EventPrices'] = $this->collEventPrices->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
		$pos = EventPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setEventId($value);
				break;
			case 1:
				$this->setEventName($value);
				break;
			case 2:
				$this->setEventDescription($value);
				break;
			case 3:
				$this->setEventLocation($value);
				break;
			case 4:
				$this->setEventSponsorName($value);
				break;
			case 5:
				$this->setEventStartTime($value);
				break;
			case 6:
				$this->setEventEndTime($value);
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
		$keys = EventPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setEventId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setEventName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setEventDescription($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setEventLocation($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setEventSponsorName($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setEventStartTime($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setEventEndTime($arr[$keys[6]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(EventPeer::DATABASE_NAME);

		if ($this->isColumnModified(EventPeer::EVENT_ID)) $criteria->add(EventPeer::EVENT_ID, $this->event_id);
		if ($this->isColumnModified(EventPeer::EVENT_NAME)) $criteria->add(EventPeer::EVENT_NAME, $this->event_name);
		if ($this->isColumnModified(EventPeer::EVENT_DESCRIPTION)) $criteria->add(EventPeer::EVENT_DESCRIPTION, $this->event_description);
		if ($this->isColumnModified(EventPeer::EVENT_LOCATION)) $criteria->add(EventPeer::EVENT_LOCATION, $this->event_location);
		if ($this->isColumnModified(EventPeer::EVENT_SPONSOR_NAME)) $criteria->add(EventPeer::EVENT_SPONSOR_NAME, $this->event_sponsor_name);
		if ($this->isColumnModified(EventPeer::EVENT_START_TIME)) $criteria->add(EventPeer::EVENT_START_TIME, $this->event_start_time);
		if ($this->isColumnModified(EventPeer::EVENT_END_TIME)) $criteria->add(EventPeer::EVENT_END_TIME, $this->event_end_time);

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
		$criteria = new Criteria(EventPeer::DATABASE_NAME);
		$criteria->add(EventPeer::EVENT_ID, $this->event_id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getEventId();
	}

	/**
	 * Generic method to set the primary key (event_id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setEventId($key);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return null === $this->getEventId();
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Event (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setEventName($this->getEventName());
		$copyObj->setEventDescription($this->getEventDescription());
		$copyObj->setEventLocation($this->getEventLocation());
		$copyObj->setEventSponsorName($this->getEventSponsorName());
		$copyObj->setEventStartTime($this->getEventStartTime());
		$copyObj->setEventEndTime($this->getEventEndTime());

		if ($deepCopy && !$this->startCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);
			// store object hash to prevent cycle
			$this->startCopy = true;

			foreach ($this->getArtRequests() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addArtRequest($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getEventPrices() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addEventPrice($relObj->copy($deepCopy));
				}
			}

			//unflag object copy
			$this->startCopy = false;
		} // if ($deepCopy)

		if ($makeNew) {
			$copyObj->setNew(true);
			$copyObj->setEventId(NULL); // this is a auto-increment column, so set to default value
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
	 * @return     Event Clone of current object.
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
	 * @return     EventPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new EventPeer();
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
		if ('ArtRequest' == $relationName) {
			return $this->initArtRequests();
		}
		if ('EventPrice' == $relationName) {
			return $this->initEventPrices();
		}
	}

	/**
	 * Clears out the collArtRequests collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addArtRequests()
	 */
	public function clearArtRequests()
	{
		$this->collArtRequests = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collArtRequests collection.
	 *
	 * By default this just sets the collArtRequests collection to an empty array (like clearcollArtRequests());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initArtRequests($overrideExisting = true)
	{
		if (null !== $this->collArtRequests && !$overrideExisting) {
			return;
		}
		$this->collArtRequests = new PropelObjectCollection();
		$this->collArtRequests->setModel('ArtRequest');
	}

	/**
	 * Gets an array of ArtRequest objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Event is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array ArtRequest[] List of ArtRequest objects
	 * @throws     PropelException
	 */
	public function getArtRequests($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collArtRequests || null !== $criteria) {
			if ($this->isNew() && null === $this->collArtRequests) {
				// return empty collection
				$this->initArtRequests();
			} else {
				$collArtRequests = ArtRequestQuery::create(null, $criteria)
					->filterByEvent($this)
					->find($con);
				if (null !== $criteria) {
					return $collArtRequests;
				}
				$this->collArtRequests = $collArtRequests;
			}
		}
		return $this->collArtRequests;
	}

	/**
	 * Sets a collection of ArtRequest objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $artRequests A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setArtRequests(PropelCollection $artRequests, PropelPDO $con = null)
	{
		$this->artRequestsScheduledForDeletion = $this->getArtRequests(new Criteria(), $con)->diff($artRequests);

		foreach ($artRequests as $artRequest) {
			// Fix issue with collection modified by reference
			if ($artRequest->isNew()) {
				$artRequest->setEvent($this);
			}
			$this->addArtRequest($artRequest);
		}

		$this->collArtRequests = $artRequests;
	}

	/**
	 * Returns the number of related ArtRequest objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related ArtRequest objects.
	 * @throws     PropelException
	 */
	public function countArtRequests(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collArtRequests || null !== $criteria) {
			if ($this->isNew() && null === $this->collArtRequests) {
				return 0;
			} else {
				$query = ArtRequestQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByEvent($this)
					->count($con);
			}
		} else {
			return count($this->collArtRequests);
		}
	}

	/**
	 * Method called to associate a ArtRequest object to this object
	 * through the ArtRequest foreign key attribute.
	 *
	 * @param      ArtRequest $l ArtRequest
	 * @return     Event The current object (for fluent API support)
	 */
	public function addArtRequest(ArtRequest $l)
	{
		if ($this->collArtRequests === null) {
			$this->initArtRequests();
		}
		if (!$this->collArtRequests->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddArtRequest($l);
		}

		return $this;
	}

	/**
	 * @param	ArtRequest $artRequest The artRequest object to add.
	 */
	protected function doAddArtRequest($artRequest)
	{
		$this->collArtRequests[]= $artRequest;
		$artRequest->setEvent($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Event is new, it will return
	 * an empty collection; or if this Event has previously
	 * been saved, it will retrieve related ArtRequests from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Event.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array ArtRequest[] List of ArtRequest objects
	 */
	public function getArtRequestsJoinArtRequestor($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = ArtRequestQuery::create(null, $criteria);
		$query->joinWith('ArtRequestor', $join_behavior);

		return $this->getArtRequests($query, $con);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Event is new, it will return
	 * an empty collection; or if this Event has previously
	 * been saved, it will retrieve related ArtRequests from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Event.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array ArtRequest[] List of ArtRequest objects
	 */
	public function getArtRequestsJoinArtRequestType($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = ArtRequestQuery::create(null, $criteria);
		$query->joinWith('ArtRequestType', $join_behavior);

		return $this->getArtRequests($query, $con);
	}

	/**
	 * Clears out the collEventPrices collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addEventPrices()
	 */
	public function clearEventPrices()
	{
		$this->collEventPrices = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collEventPrices collection.
	 *
	 * By default this just sets the collEventPrices collection to an empty array (like clearcollEventPrices());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initEventPrices($overrideExisting = true)
	{
		if (null !== $this->collEventPrices && !$overrideExisting) {
			return;
		}
		$this->collEventPrices = new PropelObjectCollection();
		$this->collEventPrices->setModel('EventPrice');
	}

	/**
	 * Gets an array of EventPrice objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Event is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array EventPrice[] List of EventPrice objects
	 * @throws     PropelException
	 */
	public function getEventPrices($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collEventPrices || null !== $criteria) {
			if ($this->isNew() && null === $this->collEventPrices) {
				// return empty collection
				$this->initEventPrices();
			} else {
				$collEventPrices = EventPriceQuery::create(null, $criteria)
					->filterByEvent($this)
					->find($con);
				if (null !== $criteria) {
					return $collEventPrices;
				}
				$this->collEventPrices = $collEventPrices;
			}
		}
		return $this->collEventPrices;
	}

	/**
	 * Sets a collection of EventPrice objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $eventPrices A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setEventPrices(PropelCollection $eventPrices, PropelPDO $con = null)
	{
		$this->eventPricesScheduledForDeletion = $this->getEventPrices(new Criteria(), $con)->diff($eventPrices);

		foreach ($eventPrices as $eventPrice) {
			// Fix issue with collection modified by reference
			if ($eventPrice->isNew()) {
				$eventPrice->setEvent($this);
			}
			$this->addEventPrice($eventPrice);
		}

		$this->collEventPrices = $eventPrices;
	}

	/**
	 * Returns the number of related EventPrice objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related EventPrice objects.
	 * @throws     PropelException
	 */
	public function countEventPrices(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collEventPrices || null !== $criteria) {
			if ($this->isNew() && null === $this->collEventPrices) {
				return 0;
			} else {
				$query = EventPriceQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByEvent($this)
					->count($con);
			}
		} else {
			return count($this->collEventPrices);
		}
	}

	/**
	 * Method called to associate a EventPrice object to this object
	 * through the EventPrice foreign key attribute.
	 *
	 * @param      EventPrice $l EventPrice
	 * @return     Event The current object (for fluent API support)
	 */
	public function addEventPrice(EventPrice $l)
	{
		if ($this->collEventPrices === null) {
			$this->initEventPrices();
		}
		if (!$this->collEventPrices->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddEventPrice($l);
		}

		return $this;
	}

	/**
	 * @param	EventPrice $eventPrice The eventPrice object to add.
	 */
	protected function doAddEventPrice($eventPrice)
	{
		$this->collEventPrices[]= $eventPrice;
		$eventPrice->setEvent($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Event is new, it will return
	 * an empty collection; or if this Event has previously
	 * been saved, it will retrieve related EventPrices from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Event.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array EventPrice[] List of EventPrice objects
	 */
	public function getEventPricesJoinEventPriceType($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = EventPriceQuery::create(null, $criteria);
		$query->joinWith('EventPriceType', $join_behavior);

		return $this->getEventPrices($query, $con);
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->event_id = null;
		$this->event_name = null;
		$this->event_description = null;
		$this->event_location = null;
		$this->event_sponsor_name = null;
		$this->event_start_time = null;
		$this->event_end_time = null;
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
			if ($this->collArtRequests) {
				foreach ($this->collArtRequests as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collEventPrices) {
				foreach ($this->collEventPrices as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		if ($this->collArtRequests instanceof PropelCollection) {
			$this->collArtRequests->clearIterator();
		}
		$this->collArtRequests = null;
		if ($this->collEventPrices instanceof PropelCollection) {
			$this->collEventPrices->clearIterator();
		}
		$this->collEventPrices = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(EventPeer::DEFAULT_STRING_FORMAT);
	}

} // BaseEvent
