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
use ORMModel\ArtRequestArtStatus;
use ORMModel\ArtRequestArtStatusQuery;
use ORMModel\ArtRequestComment;
use ORMModel\ArtRequestCommentQuery;
use ORMModel\ArtRequestDocument;
use ORMModel\ArtRequestDocumentQuery;
use ORMModel\ArtRequestPeer;
use ORMModel\ArtRequestQuery;
use ORMModel\ArtRequestType;
use ORMModel\ArtRequestTypeQuery;
use ORMModel\ArtRequestor;
use ORMModel\ArtRequestorQuery;
use ORMModel\BannerRequest;
use ORMModel\BannerRequestQuery;
use ORMModel\Event;
use ORMModel\EventQuery;
use ORMModel\FlyerArtRequest;
use ORMModel\FlyerArtRequestQuery;
use ORMModel\LogoArtRequest;
use ORMModel\LogoArtRequestQuery;
use ORMModel\OtherArtRequest;
use ORMModel\OtherArtRequestQuery;

/**
 * Base class that represents a row from the 'art_request' table.
 *
 * 
 *
 * @package    propel.generator.orm.om
 */
abstract class BaseArtRequest extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'ORMModel\\ArtRequestPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ArtRequestPeer
	 */
	protected static $peer;

	/**
	 * The flag var to prevent infinit loop in deep copy
	 * @var       boolean
	 */
	protected $startCopy = false;

	/**
	 * The value for the art_request_id field.
	 * @var        int
	 */
	protected $art_request_id;

	/**
	 * The value for the is_started field.
	 * Note: this column has a database default value of: false
	 * @var        boolean
	 */
	protected $is_started;

	/**
	 * The value for the is_completed field.
	 * Note: this column has a database default value of: false
	 * @var        boolean
	 */
	protected $is_completed;

	/**
	 * The value for the is_archived field.
	 * Note: this column has a database default value of: false
	 * @var        boolean
	 */
	protected $is_archived;

	/**
	 * The value for the is_request_confirmed field.
	 * Note: this column has a database default value of: false
	 * @var        boolean
	 */
	protected $is_request_confirmed;

	/**
	 * The value for the start_date field.
	 * @var        string
	 */
	protected $start_date;

	/**
	 * The value for the completion_date field.
	 * @var        string
	 */
	protected $completion_date;

	/**
	 * The value for the due_date field.
	 * @var        string
	 */
	protected $due_date;

	/**
	 * The value for the art_requestor_id field.
	 * @var        int
	 */
	protected $art_requestor_id;

	/**
	 * The value for the art_request_type_id field.
	 * @var        int
	 */
	protected $art_request_type_id;

	/**
	 * The value for the event_id field.
	 * @var        int
	 */
	protected $event_id;

	/**
	 * @var        ArtRequestor
	 */
	protected $aArtRequestor;

	/**
	 * @var        ArtRequestType
	 */
	protected $aArtRequestType;

	/**
	 * @var        Event
	 */
	protected $aEvent;

	/**
	 * @var        array ArtRequestArtStatus[] Collection to store aggregation of ArtRequestArtStatus objects.
	 */
	protected $collArtRequestArtStatuss;

	/**
	 * @var        array ArtRequestComment[] Collection to store aggregation of ArtRequestComment objects.
	 */
	protected $collArtRequestComments;

	/**
	 * @var        array ArtRequestDocument[] Collection to store aggregation of ArtRequestDocument objects.
	 */
	protected $collArtRequestDocuments;

	/**
	 * @var        array BannerRequest[] Collection to store aggregation of BannerRequest objects.
	 */
	protected $collBannerRequests;

	/**
	 * @var        array FlyerArtRequest[] Collection to store aggregation of FlyerArtRequest objects.
	 */
	protected $collFlyerArtRequests;

	/**
	 * @var        array LogoArtRequest[] Collection to store aggregation of LogoArtRequest objects.
	 */
	protected $collLogoArtRequests;

	/**
	 * @var        array OtherArtRequest[] Collection to store aggregation of OtherArtRequest objects.
	 */
	protected $collOtherArtRequests;

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
	protected $artRequestArtStatussScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $artRequestCommentsScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $artRequestDocumentsScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $bannerRequestsScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $flyerArtRequestsScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $logoArtRequestsScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $otherArtRequestsScheduledForDeletion = null;

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->is_started = false;
		$this->is_completed = false;
		$this->is_archived = false;
		$this->is_request_confirmed = false;
	}

	/**
	 * Initializes internal state of BaseArtRequest object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
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
	 * Get the [is_started] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsStarted()
	{
		return $this->is_started;
	}

	/**
	 * Get the [is_completed] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsCompleted()
	{
		return $this->is_completed;
	}

	/**
	 * Get the [is_archived] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsArchived()
	{
		return $this->is_archived;
	}

	/**
	 * Get the [is_request_confirmed] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsRequestConfirmed()
	{
		return $this->is_request_confirmed;
	}

	/**
	 * Get the [optionally formatted] temporal [start_date] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getStartDate($format = 'Y-m-d H:i:s')
	{
		if ($this->start_date === null) {
			return null;
		}


		if ($this->start_date === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->start_date);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->start_date, true), $x);
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
	 * Get the [optionally formatted] temporal [completion_date] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCompletionDate($format = 'Y-m-d H:i:s')
	{
		if ($this->completion_date === null) {
			return null;
		}


		if ($this->completion_date === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->completion_date);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->completion_date, true), $x);
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
	 * Get the [optionally formatted] temporal [due_date] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getDueDate($format = 'Y-m-d H:i:s')
	{
		if ($this->due_date === null) {
			return null;
		}


		if ($this->due_date === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->due_date);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->due_date, true), $x);
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
	 * Get the [art_requestor_id] column value.
	 * 
	 * @return     int
	 */
	public function getArtRequestorId()
	{
		return $this->art_requestor_id;
	}

	/**
	 * Get the [art_request_type_id] column value.
	 * 
	 * @return     int
	 */
	public function getArtRequestTypeId()
	{
		return $this->art_request_type_id;
	}

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
	 * Set the value of [art_request_id] column.
	 * 
	 * @param      int $v new value
	 * @return     ArtRequest The current object (for fluent API support)
	 */
	public function setArtRequestId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->art_request_id !== $v) {
			$this->art_request_id = $v;
			$this->modifiedColumns[] = ArtRequestPeer::ART_REQUEST_ID;
		}

		return $this;
	} // setArtRequestId()

	/**
	 * Sets the value of the [is_started] column.
	 * Non-boolean arguments are converted using the following rules:
	 *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * 
	 * @param      boolean|integer|string $v The new value
	 * @return     ArtRequest The current object (for fluent API support)
	 */
	public function setIsStarted($v)
	{
		if ($v !== null) {
			if (is_string($v)) {
				$v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
			} else {
				$v = (boolean) $v;
			}
		}

		if ($this->is_started !== $v) {
			$this->is_started = $v;
			$this->modifiedColumns[] = ArtRequestPeer::IS_STARTED;
		}

		return $this;
	} // setIsStarted()

	/**
	 * Sets the value of the [is_completed] column.
	 * Non-boolean arguments are converted using the following rules:
	 *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * 
	 * @param      boolean|integer|string $v The new value
	 * @return     ArtRequest The current object (for fluent API support)
	 */
	public function setIsCompleted($v)
	{
		if ($v !== null) {
			if (is_string($v)) {
				$v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
			} else {
				$v = (boolean) $v;
			}
		}

		if ($this->is_completed !== $v) {
			$this->is_completed = $v;
			$this->modifiedColumns[] = ArtRequestPeer::IS_COMPLETED;
		}

		return $this;
	} // setIsCompleted()

	/**
	 * Sets the value of the [is_archived] column.
	 * Non-boolean arguments are converted using the following rules:
	 *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * 
	 * @param      boolean|integer|string $v The new value
	 * @return     ArtRequest The current object (for fluent API support)
	 */
	public function setIsArchived($v)
	{
		if ($v !== null) {
			if (is_string($v)) {
				$v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
			} else {
				$v = (boolean) $v;
			}
		}

		if ($this->is_archived !== $v) {
			$this->is_archived = $v;
			$this->modifiedColumns[] = ArtRequestPeer::IS_ARCHIVED;
		}

		return $this;
	} // setIsArchived()

	/**
	 * Sets the value of the [is_request_confirmed] column.
	 * Non-boolean arguments are converted using the following rules:
	 *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * 
	 * @param      boolean|integer|string $v The new value
	 * @return     ArtRequest The current object (for fluent API support)
	 */
	public function setIsRequestConfirmed($v)
	{
		if ($v !== null) {
			if (is_string($v)) {
				$v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
			} else {
				$v = (boolean) $v;
			}
		}

		if ($this->is_request_confirmed !== $v) {
			$this->is_request_confirmed = $v;
			$this->modifiedColumns[] = ArtRequestPeer::IS_REQUEST_CONFIRMED;
		}

		return $this;
	} // setIsRequestConfirmed()

	/**
	 * Sets the value of [start_date] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     ArtRequest The current object (for fluent API support)
	 */
	public function setStartDate($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->start_date !== null || $dt !== null) {
			$currentDateAsString = ($this->start_date !== null && $tmpDt = new DateTime($this->start_date)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->start_date = $newDateAsString;
				$this->modifiedColumns[] = ArtRequestPeer::START_DATE;
			}
		} // if either are not null

		return $this;
	} // setStartDate()

	/**
	 * Sets the value of [completion_date] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     ArtRequest The current object (for fluent API support)
	 */
	public function setCompletionDate($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->completion_date !== null || $dt !== null) {
			$currentDateAsString = ($this->completion_date !== null && $tmpDt = new DateTime($this->completion_date)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->completion_date = $newDateAsString;
				$this->modifiedColumns[] = ArtRequestPeer::COMPLETION_DATE;
			}
		} // if either are not null

		return $this;
	} // setCompletionDate()

	/**
	 * Sets the value of [due_date] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     ArtRequest The current object (for fluent API support)
	 */
	public function setDueDate($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->due_date !== null || $dt !== null) {
			$currentDateAsString = ($this->due_date !== null && $tmpDt = new DateTime($this->due_date)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->due_date = $newDateAsString;
				$this->modifiedColumns[] = ArtRequestPeer::DUE_DATE;
			}
		} // if either are not null

		return $this;
	} // setDueDate()

	/**
	 * Set the value of [art_requestor_id] column.
	 * 
	 * @param      int $v new value
	 * @return     ArtRequest The current object (for fluent API support)
	 */
	public function setArtRequestorId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->art_requestor_id !== $v) {
			$this->art_requestor_id = $v;
			$this->modifiedColumns[] = ArtRequestPeer::ART_REQUESTOR_ID;
		}

		if ($this->aArtRequestor !== null && $this->aArtRequestor->getArtRequestorId() !== $v) {
			$this->aArtRequestor = null;
		}

		return $this;
	} // setArtRequestorId()

	/**
	 * Set the value of [art_request_type_id] column.
	 * 
	 * @param      int $v new value
	 * @return     ArtRequest The current object (for fluent API support)
	 */
	public function setArtRequestTypeId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->art_request_type_id !== $v) {
			$this->art_request_type_id = $v;
			$this->modifiedColumns[] = ArtRequestPeer::ART_REQUEST_TYPE_ID;
		}

		if ($this->aArtRequestType !== null && $this->aArtRequestType->getArtRequestTypeId() !== $v) {
			$this->aArtRequestType = null;
		}

		return $this;
	} // setArtRequestTypeId()

	/**
	 * Set the value of [event_id] column.
	 * 
	 * @param      int $v new value
	 * @return     ArtRequest The current object (for fluent API support)
	 */
	public function setEventId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->event_id !== $v) {
			$this->event_id = $v;
			$this->modifiedColumns[] = ArtRequestPeer::EVENT_ID;
		}

		if ($this->aEvent !== null && $this->aEvent->getEventId() !== $v) {
			$this->aEvent = null;
		}

		return $this;
	} // setEventId()

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
			if ($this->is_started !== false) {
				return false;
			}

			if ($this->is_completed !== false) {
				return false;
			}

			if ($this->is_archived !== false) {
				return false;
			}

			if ($this->is_request_confirmed !== false) {
				return false;
			}

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

			$this->art_request_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->is_started = ($row[$startcol + 1] !== null) ? (boolean) $row[$startcol + 1] : null;
			$this->is_completed = ($row[$startcol + 2] !== null) ? (boolean) $row[$startcol + 2] : null;
			$this->is_archived = ($row[$startcol + 3] !== null) ? (boolean) $row[$startcol + 3] : null;
			$this->is_request_confirmed = ($row[$startcol + 4] !== null) ? (boolean) $row[$startcol + 4] : null;
			$this->start_date = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->completion_date = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->due_date = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->art_requestor_id = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->art_request_type_id = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->event_id = ($row[$startcol + 10] !== null) ? (int) $row[$startcol + 10] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 11; // 11 = ArtRequestPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating ArtRequest object", $e);
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

		if ($this->aArtRequestor !== null && $this->art_requestor_id !== $this->aArtRequestor->getArtRequestorId()) {
			$this->aArtRequestor = null;
		}
		if ($this->aArtRequestType !== null && $this->art_request_type_id !== $this->aArtRequestType->getArtRequestTypeId()) {
			$this->aArtRequestType = null;
		}
		if ($this->aEvent !== null && $this->event_id !== $this->aEvent->getEventId()) {
			$this->aEvent = null;
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
			$con = Propel::getConnection(ArtRequestPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = ArtRequestPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aArtRequestor = null;
			$this->aArtRequestType = null;
			$this->aEvent = null;
			$this->collArtRequestArtStatuss = null;

			$this->collArtRequestComments = null;

			$this->collArtRequestDocuments = null;

			$this->collBannerRequests = null;

			$this->collFlyerArtRequests = null;

			$this->collLogoArtRequests = null;

			$this->collOtherArtRequests = null;

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
			$con = Propel::getConnection(ArtRequestPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = ArtRequestQuery::create()
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
			$con = Propel::getConnection(ArtRequestPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				ArtRequestPeer::addInstanceToPool($this);
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

			if ($this->aArtRequestor !== null) {
				if ($this->aArtRequestor->isModified() || $this->aArtRequestor->isNew()) {
					$affectedRows += $this->aArtRequestor->save($con);
				}
				$this->setArtRequestor($this->aArtRequestor);
			}

			if ($this->aArtRequestType !== null) {
				if ($this->aArtRequestType->isModified() || $this->aArtRequestType->isNew()) {
					$affectedRows += $this->aArtRequestType->save($con);
				}
				$this->setArtRequestType($this->aArtRequestType);
			}

			if ($this->aEvent !== null) {
				if ($this->aEvent->isModified() || $this->aEvent->isNew()) {
					$affectedRows += $this->aEvent->save($con);
				}
				$this->setEvent($this->aEvent);
			}

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

			if ($this->artRequestArtStatussScheduledForDeletion !== null) {
				if (!$this->artRequestArtStatussScheduledForDeletion->isEmpty()) {
					ArtRequestArtStatusQuery::create()
						->filterByPrimaryKeys($this->artRequestArtStatussScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->artRequestArtStatussScheduledForDeletion = null;
				}
			}

			if ($this->collArtRequestArtStatuss !== null) {
				foreach ($this->collArtRequestArtStatuss as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->artRequestCommentsScheduledForDeletion !== null) {
				if (!$this->artRequestCommentsScheduledForDeletion->isEmpty()) {
					ArtRequestCommentQuery::create()
						->filterByPrimaryKeys($this->artRequestCommentsScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->artRequestCommentsScheduledForDeletion = null;
				}
			}

			if ($this->collArtRequestComments !== null) {
				foreach ($this->collArtRequestComments as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->artRequestDocumentsScheduledForDeletion !== null) {
				if (!$this->artRequestDocumentsScheduledForDeletion->isEmpty()) {
					ArtRequestDocumentQuery::create()
						->filterByPrimaryKeys($this->artRequestDocumentsScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->artRequestDocumentsScheduledForDeletion = null;
				}
			}

			if ($this->collArtRequestDocuments !== null) {
				foreach ($this->collArtRequestDocuments as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->bannerRequestsScheduledForDeletion !== null) {
				if (!$this->bannerRequestsScheduledForDeletion->isEmpty()) {
					BannerRequestQuery::create()
						->filterByPrimaryKeys($this->bannerRequestsScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->bannerRequestsScheduledForDeletion = null;
				}
			}

			if ($this->collBannerRequests !== null) {
				foreach ($this->collBannerRequests as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
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

			if ($this->logoArtRequestsScheduledForDeletion !== null) {
				if (!$this->logoArtRequestsScheduledForDeletion->isEmpty()) {
					LogoArtRequestQuery::create()
						->filterByPrimaryKeys($this->logoArtRequestsScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->logoArtRequestsScheduledForDeletion = null;
				}
			}

			if ($this->collLogoArtRequests !== null) {
				foreach ($this->collLogoArtRequests as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->otherArtRequestsScheduledForDeletion !== null) {
				if (!$this->otherArtRequestsScheduledForDeletion->isEmpty()) {
					OtherArtRequestQuery::create()
						->filterByPrimaryKeys($this->otherArtRequestsScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->otherArtRequestsScheduledForDeletion = null;
				}
			}

			if ($this->collOtherArtRequests !== null) {
				foreach ($this->collOtherArtRequests as $referrerFK) {
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

		$this->modifiedColumns[] = ArtRequestPeer::ART_REQUEST_ID;
		if (null !== $this->art_request_id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . ArtRequestPeer::ART_REQUEST_ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(ArtRequestPeer::ART_REQUEST_ID)) {
			$modifiedColumns[':p' . $index++]  = '`ART_REQUEST_ID`';
		}
		if ($this->isColumnModified(ArtRequestPeer::IS_STARTED)) {
			$modifiedColumns[':p' . $index++]  = '`IS_STARTED`';
		}
		if ($this->isColumnModified(ArtRequestPeer::IS_COMPLETED)) {
			$modifiedColumns[':p' . $index++]  = '`IS_COMPLETED`';
		}
		if ($this->isColumnModified(ArtRequestPeer::IS_ARCHIVED)) {
			$modifiedColumns[':p' . $index++]  = '`IS_ARCHIVED`';
		}
		if ($this->isColumnModified(ArtRequestPeer::IS_REQUEST_CONFIRMED)) {
			$modifiedColumns[':p' . $index++]  = '`IS_REQUEST_CONFIRMED`';
		}
		if ($this->isColumnModified(ArtRequestPeer::START_DATE)) {
			$modifiedColumns[':p' . $index++]  = '`START_DATE`';
		}
		if ($this->isColumnModified(ArtRequestPeer::COMPLETION_DATE)) {
			$modifiedColumns[':p' . $index++]  = '`COMPLETION_DATE`';
		}
		if ($this->isColumnModified(ArtRequestPeer::DUE_DATE)) {
			$modifiedColumns[':p' . $index++]  = '`DUE_DATE`';
		}
		if ($this->isColumnModified(ArtRequestPeer::ART_REQUESTOR_ID)) {
			$modifiedColumns[':p' . $index++]  = '`ART_REQUESTOR_ID`';
		}
		if ($this->isColumnModified(ArtRequestPeer::ART_REQUEST_TYPE_ID)) {
			$modifiedColumns[':p' . $index++]  = '`ART_REQUEST_TYPE_ID`';
		}
		if ($this->isColumnModified(ArtRequestPeer::EVENT_ID)) {
			$modifiedColumns[':p' . $index++]  = '`EVENT_ID`';
		}

		$sql = sprintf(
			'INSERT INTO `art_request` (%s) VALUES (%s)',
			implode(', ', $modifiedColumns),
			implode(', ', array_keys($modifiedColumns))
		);

		try {
			$stmt = $con->prepare($sql);
			foreach ($modifiedColumns as $identifier => $columnName) {
				switch ($columnName) {
					case '`ART_REQUEST_ID`':
						$stmt->bindValue($identifier, $this->art_request_id, PDO::PARAM_INT);
						break;
					case '`IS_STARTED`':
						$stmt->bindValue($identifier, (int) $this->is_started, PDO::PARAM_INT);
						break;
					case '`IS_COMPLETED`':
						$stmt->bindValue($identifier, (int) $this->is_completed, PDO::PARAM_INT);
						break;
					case '`IS_ARCHIVED`':
						$stmt->bindValue($identifier, (int) $this->is_archived, PDO::PARAM_INT);
						break;
					case '`IS_REQUEST_CONFIRMED`':
						$stmt->bindValue($identifier, (int) $this->is_request_confirmed, PDO::PARAM_INT);
						break;
					case '`START_DATE`':
						$stmt->bindValue($identifier, $this->start_date, PDO::PARAM_STR);
						break;
					case '`COMPLETION_DATE`':
						$stmt->bindValue($identifier, $this->completion_date, PDO::PARAM_STR);
						break;
					case '`DUE_DATE`':
						$stmt->bindValue($identifier, $this->due_date, PDO::PARAM_STR);
						break;
					case '`ART_REQUESTOR_ID`':
						$stmt->bindValue($identifier, $this->art_requestor_id, PDO::PARAM_INT);
						break;
					case '`ART_REQUEST_TYPE_ID`':
						$stmt->bindValue($identifier, $this->art_request_type_id, PDO::PARAM_INT);
						break;
					case '`EVENT_ID`':
						$stmt->bindValue($identifier, $this->event_id, PDO::PARAM_INT);
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
		$this->setArtRequestId($pk);

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

			if ($this->aArtRequestor !== null) {
				if (!$this->aArtRequestor->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aArtRequestor->getValidationFailures());
				}
			}

			if ($this->aArtRequestType !== null) {
				if (!$this->aArtRequestType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aArtRequestType->getValidationFailures());
				}
			}

			if ($this->aEvent !== null) {
				if (!$this->aEvent->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEvent->getValidationFailures());
				}
			}


			if (($retval = ArtRequestPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collArtRequestArtStatuss !== null) {
					foreach ($this->collArtRequestArtStatuss as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collArtRequestComments !== null) {
					foreach ($this->collArtRequestComments as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collArtRequestDocuments !== null) {
					foreach ($this->collArtRequestDocuments as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collBannerRequests !== null) {
					foreach ($this->collBannerRequests as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collFlyerArtRequests !== null) {
					foreach ($this->collFlyerArtRequests as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collLogoArtRequests !== null) {
					foreach ($this->collLogoArtRequests as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOtherArtRequests !== null) {
					foreach ($this->collOtherArtRequests as $referrerFK) {
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
		$pos = ArtRequestPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getArtRequestId();
				break;
			case 1:
				return $this->getIsStarted();
				break;
			case 2:
				return $this->getIsCompleted();
				break;
			case 3:
				return $this->getIsArchived();
				break;
			case 4:
				return $this->getIsRequestConfirmed();
				break;
			case 5:
				return $this->getStartDate();
				break;
			case 6:
				return $this->getCompletionDate();
				break;
			case 7:
				return $this->getDueDate();
				break;
			case 8:
				return $this->getArtRequestorId();
				break;
			case 9:
				return $this->getArtRequestTypeId();
				break;
			case 10:
				return $this->getEventId();
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
		if (isset($alreadyDumpedObjects['ArtRequest'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['ArtRequest'][$this->getPrimaryKey()] = true;
		$keys = ArtRequestPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getArtRequestId(),
			$keys[1] => $this->getIsStarted(),
			$keys[2] => $this->getIsCompleted(),
			$keys[3] => $this->getIsArchived(),
			$keys[4] => $this->getIsRequestConfirmed(),
			$keys[5] => $this->getStartDate(),
			$keys[6] => $this->getCompletionDate(),
			$keys[7] => $this->getDueDate(),
			$keys[8] => $this->getArtRequestorId(),
			$keys[9] => $this->getArtRequestTypeId(),
			$keys[10] => $this->getEventId(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aArtRequestor) {
				$result['ArtRequestor'] = $this->aArtRequestor->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->aArtRequestType) {
				$result['ArtRequestType'] = $this->aArtRequestType->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->aEvent) {
				$result['Event'] = $this->aEvent->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->collArtRequestArtStatuss) {
				$result['ArtRequestArtStatuss'] = $this->collArtRequestArtStatuss->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collArtRequestComments) {
				$result['ArtRequestComments'] = $this->collArtRequestComments->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collArtRequestDocuments) {
				$result['ArtRequestDocuments'] = $this->collArtRequestDocuments->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collBannerRequests) {
				$result['BannerRequests'] = $this->collBannerRequests->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collFlyerArtRequests) {
				$result['FlyerArtRequests'] = $this->collFlyerArtRequests->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collLogoArtRequests) {
				$result['LogoArtRequests'] = $this->collLogoArtRequests->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collOtherArtRequests) {
				$result['OtherArtRequests'] = $this->collOtherArtRequests->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
		$pos = ArtRequestPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setArtRequestId($value);
				break;
			case 1:
				$this->setIsStarted($value);
				break;
			case 2:
				$this->setIsCompleted($value);
				break;
			case 3:
				$this->setIsArchived($value);
				break;
			case 4:
				$this->setIsRequestConfirmed($value);
				break;
			case 5:
				$this->setStartDate($value);
				break;
			case 6:
				$this->setCompletionDate($value);
				break;
			case 7:
				$this->setDueDate($value);
				break;
			case 8:
				$this->setArtRequestorId($value);
				break;
			case 9:
				$this->setArtRequestTypeId($value);
				break;
			case 10:
				$this->setEventId($value);
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
		$keys = ArtRequestPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setArtRequestId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIsStarted($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIsCompleted($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIsArchived($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIsRequestConfirmed($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setStartDate($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCompletionDate($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setDueDate($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setArtRequestorId($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setArtRequestTypeId($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setEventId($arr[$keys[10]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ArtRequestPeer::DATABASE_NAME);

		if ($this->isColumnModified(ArtRequestPeer::ART_REQUEST_ID)) $criteria->add(ArtRequestPeer::ART_REQUEST_ID, $this->art_request_id);
		if ($this->isColumnModified(ArtRequestPeer::IS_STARTED)) $criteria->add(ArtRequestPeer::IS_STARTED, $this->is_started);
		if ($this->isColumnModified(ArtRequestPeer::IS_COMPLETED)) $criteria->add(ArtRequestPeer::IS_COMPLETED, $this->is_completed);
		if ($this->isColumnModified(ArtRequestPeer::IS_ARCHIVED)) $criteria->add(ArtRequestPeer::IS_ARCHIVED, $this->is_archived);
		if ($this->isColumnModified(ArtRequestPeer::IS_REQUEST_CONFIRMED)) $criteria->add(ArtRequestPeer::IS_REQUEST_CONFIRMED, $this->is_request_confirmed);
		if ($this->isColumnModified(ArtRequestPeer::START_DATE)) $criteria->add(ArtRequestPeer::START_DATE, $this->start_date);
		if ($this->isColumnModified(ArtRequestPeer::COMPLETION_DATE)) $criteria->add(ArtRequestPeer::COMPLETION_DATE, $this->completion_date);
		if ($this->isColumnModified(ArtRequestPeer::DUE_DATE)) $criteria->add(ArtRequestPeer::DUE_DATE, $this->due_date);
		if ($this->isColumnModified(ArtRequestPeer::ART_REQUESTOR_ID)) $criteria->add(ArtRequestPeer::ART_REQUESTOR_ID, $this->art_requestor_id);
		if ($this->isColumnModified(ArtRequestPeer::ART_REQUEST_TYPE_ID)) $criteria->add(ArtRequestPeer::ART_REQUEST_TYPE_ID, $this->art_request_type_id);
		if ($this->isColumnModified(ArtRequestPeer::EVENT_ID)) $criteria->add(ArtRequestPeer::EVENT_ID, $this->event_id);

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
		$criteria = new Criteria(ArtRequestPeer::DATABASE_NAME);
		$criteria->add(ArtRequestPeer::ART_REQUEST_ID, $this->art_request_id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getArtRequestId();
	}

	/**
	 * Generic method to set the primary key (art_request_id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setArtRequestId($key);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return null === $this->getArtRequestId();
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of ArtRequest (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setIsStarted($this->getIsStarted());
		$copyObj->setIsCompleted($this->getIsCompleted());
		$copyObj->setIsArchived($this->getIsArchived());
		$copyObj->setIsRequestConfirmed($this->getIsRequestConfirmed());
		$copyObj->setStartDate($this->getStartDate());
		$copyObj->setCompletionDate($this->getCompletionDate());
		$copyObj->setDueDate($this->getDueDate());
		$copyObj->setArtRequestorId($this->getArtRequestorId());
		$copyObj->setArtRequestTypeId($this->getArtRequestTypeId());
		$copyObj->setEventId($this->getEventId());

		if ($deepCopy && !$this->startCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);
			// store object hash to prevent cycle
			$this->startCopy = true;

			foreach ($this->getArtRequestArtStatuss() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addArtRequestArtStatus($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getArtRequestComments() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addArtRequestComment($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getArtRequestDocuments() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addArtRequestDocument($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getBannerRequests() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addBannerRequest($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getFlyerArtRequests() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addFlyerArtRequest($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getLogoArtRequests() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addLogoArtRequest($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getOtherArtRequests() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addOtherArtRequest($relObj->copy($deepCopy));
				}
			}

			//unflag object copy
			$this->startCopy = false;
		} // if ($deepCopy)

		if ($makeNew) {
			$copyObj->setNew(true);
			$copyObj->setArtRequestId(NULL); // this is a auto-increment column, so set to default value
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
	 * @return     ArtRequest Clone of current object.
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
	 * @return     ArtRequestPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ArtRequestPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a ArtRequestor object.
	 *
	 * @param      ArtRequestor $v
	 * @return     ArtRequest The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setArtRequestor(ArtRequestor $v = null)
	{
		if ($v === null) {
			$this->setArtRequestorId(NULL);
		} else {
			$this->setArtRequestorId($v->getArtRequestorId());
		}

		$this->aArtRequestor = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the ArtRequestor object, it will not be re-added.
		if ($v !== null) {
			$v->addArtRequest($this);
		}

		return $this;
	}


	/**
	 * Get the associated ArtRequestor object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     ArtRequestor The associated ArtRequestor object.
	 * @throws     PropelException
	 */
	public function getArtRequestor(PropelPDO $con = null)
	{
		if ($this->aArtRequestor === null && ($this->art_requestor_id !== null)) {
			$this->aArtRequestor = ArtRequestorQuery::create()->findPk($this->art_requestor_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aArtRequestor->addArtRequests($this);
			 */
		}
		return $this->aArtRequestor;
	}

	/**
	 * Declares an association between this object and a ArtRequestType object.
	 *
	 * @param      ArtRequestType $v
	 * @return     ArtRequest The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setArtRequestType(ArtRequestType $v = null)
	{
		if ($v === null) {
			$this->setArtRequestTypeId(NULL);
		} else {
			$this->setArtRequestTypeId($v->getArtRequestTypeId());
		}

		$this->aArtRequestType = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the ArtRequestType object, it will not be re-added.
		if ($v !== null) {
			$v->addArtRequest($this);
		}

		return $this;
	}


	/**
	 * Get the associated ArtRequestType object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     ArtRequestType The associated ArtRequestType object.
	 * @throws     PropelException
	 */
	public function getArtRequestType(PropelPDO $con = null)
	{
		if ($this->aArtRequestType === null && ($this->art_request_type_id !== null)) {
			$this->aArtRequestType = ArtRequestTypeQuery::create()->findPk($this->art_request_type_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aArtRequestType->addArtRequests($this);
			 */
		}
		return $this->aArtRequestType;
	}

	/**
	 * Declares an association between this object and a Event object.
	 *
	 * @param      Event $v
	 * @return     ArtRequest The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setEvent(Event $v = null)
	{
		if ($v === null) {
			$this->setEventId(NULL);
		} else {
			$this->setEventId($v->getEventId());
		}

		$this->aEvent = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Event object, it will not be re-added.
		if ($v !== null) {
			$v->addArtRequest($this);
		}

		return $this;
	}


	/**
	 * Get the associated Event object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Event The associated Event object.
	 * @throws     PropelException
	 */
	public function getEvent(PropelPDO $con = null)
	{
		if ($this->aEvent === null && ($this->event_id !== null)) {
			$this->aEvent = EventQuery::create()->findPk($this->event_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aEvent->addArtRequests($this);
			 */
		}
		return $this->aEvent;
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
		if ('ArtRequestArtStatus' == $relationName) {
			return $this->initArtRequestArtStatuss();
		}
		if ('ArtRequestComment' == $relationName) {
			return $this->initArtRequestComments();
		}
		if ('ArtRequestDocument' == $relationName) {
			return $this->initArtRequestDocuments();
		}
		if ('BannerRequest' == $relationName) {
			return $this->initBannerRequests();
		}
		if ('FlyerArtRequest' == $relationName) {
			return $this->initFlyerArtRequests();
		}
		if ('LogoArtRequest' == $relationName) {
			return $this->initLogoArtRequests();
		}
		if ('OtherArtRequest' == $relationName) {
			return $this->initOtherArtRequests();
		}
	}

	/**
	 * Clears out the collArtRequestArtStatuss collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addArtRequestArtStatuss()
	 */
	public function clearArtRequestArtStatuss()
	{
		$this->collArtRequestArtStatuss = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collArtRequestArtStatuss collection.
	 *
	 * By default this just sets the collArtRequestArtStatuss collection to an empty array (like clearcollArtRequestArtStatuss());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initArtRequestArtStatuss($overrideExisting = true)
	{
		if (null !== $this->collArtRequestArtStatuss && !$overrideExisting) {
			return;
		}
		$this->collArtRequestArtStatuss = new PropelObjectCollection();
		$this->collArtRequestArtStatuss->setModel('ArtRequestArtStatus');
	}

	/**
	 * Gets an array of ArtRequestArtStatus objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this ArtRequest is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array ArtRequestArtStatus[] List of ArtRequestArtStatus objects
	 * @throws     PropelException
	 */
	public function getArtRequestArtStatuss($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collArtRequestArtStatuss || null !== $criteria) {
			if ($this->isNew() && null === $this->collArtRequestArtStatuss) {
				// return empty collection
				$this->initArtRequestArtStatuss();
			} else {
				$collArtRequestArtStatuss = ArtRequestArtStatusQuery::create(null, $criteria)
					->filterByArtRequest($this)
					->find($con);
				if (null !== $criteria) {
					return $collArtRequestArtStatuss;
				}
				$this->collArtRequestArtStatuss = $collArtRequestArtStatuss;
			}
		}
		return $this->collArtRequestArtStatuss;
	}

	/**
	 * Sets a collection of ArtRequestArtStatus objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $artRequestArtStatuss A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setArtRequestArtStatuss(PropelCollection $artRequestArtStatuss, PropelPDO $con = null)
	{
		$this->artRequestArtStatussScheduledForDeletion = $this->getArtRequestArtStatuss(new Criteria(), $con)->diff($artRequestArtStatuss);

		foreach ($artRequestArtStatuss as $artRequestArtStatus) {
			// Fix issue with collection modified by reference
			if ($artRequestArtStatus->isNew()) {
				$artRequestArtStatus->setArtRequest($this);
			}
			$this->addArtRequestArtStatus($artRequestArtStatus);
		}

		$this->collArtRequestArtStatuss = $artRequestArtStatuss;
	}

	/**
	 * Returns the number of related ArtRequestArtStatus objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related ArtRequestArtStatus objects.
	 * @throws     PropelException
	 */
	public function countArtRequestArtStatuss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collArtRequestArtStatuss || null !== $criteria) {
			if ($this->isNew() && null === $this->collArtRequestArtStatuss) {
				return 0;
			} else {
				$query = ArtRequestArtStatusQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByArtRequest($this)
					->count($con);
			}
		} else {
			return count($this->collArtRequestArtStatuss);
		}
	}

	/**
	 * Method called to associate a ArtRequestArtStatus object to this object
	 * through the ArtRequestArtStatus foreign key attribute.
	 *
	 * @param      ArtRequestArtStatus $l ArtRequestArtStatus
	 * @return     ArtRequest The current object (for fluent API support)
	 */
	public function addArtRequestArtStatus(ArtRequestArtStatus $l)
	{
		if ($this->collArtRequestArtStatuss === null) {
			$this->initArtRequestArtStatuss();
		}
		if (!$this->collArtRequestArtStatuss->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddArtRequestArtStatus($l);
		}

		return $this;
	}

	/**
	 * @param	ArtRequestArtStatus $artRequestArtStatus The artRequestArtStatus object to add.
	 */
	protected function doAddArtRequestArtStatus($artRequestArtStatus)
	{
		$this->collArtRequestArtStatuss[]= $artRequestArtStatus;
		$artRequestArtStatus->setArtRequest($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ArtRequest is new, it will return
	 * an empty collection; or if this ArtRequest has previously
	 * been saved, it will retrieve related ArtRequestArtStatuss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ArtRequest.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array ArtRequestArtStatus[] List of ArtRequestArtStatus objects
	 */
	public function getArtRequestArtStatussJoinUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = ArtRequestArtStatusQuery::create(null, $criteria);
		$query->joinWith('User', $join_behavior);

		return $this->getArtRequestArtStatuss($query, $con);
	}

	/**
	 * Clears out the collArtRequestComments collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addArtRequestComments()
	 */
	public function clearArtRequestComments()
	{
		$this->collArtRequestComments = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collArtRequestComments collection.
	 *
	 * By default this just sets the collArtRequestComments collection to an empty array (like clearcollArtRequestComments());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initArtRequestComments($overrideExisting = true)
	{
		if (null !== $this->collArtRequestComments && !$overrideExisting) {
			return;
		}
		$this->collArtRequestComments = new PropelObjectCollection();
		$this->collArtRequestComments->setModel('ArtRequestComment');
	}

	/**
	 * Gets an array of ArtRequestComment objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this ArtRequest is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array ArtRequestComment[] List of ArtRequestComment objects
	 * @throws     PropelException
	 */
	public function getArtRequestComments($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collArtRequestComments || null !== $criteria) {
			if ($this->isNew() && null === $this->collArtRequestComments) {
				// return empty collection
				$this->initArtRequestComments();
			} else {
				$collArtRequestComments = ArtRequestCommentQuery::create(null, $criteria)
					->filterByArtRequest($this)
					->find($con);
				if (null !== $criteria) {
					return $collArtRequestComments;
				}
				$this->collArtRequestComments = $collArtRequestComments;
			}
		}
		return $this->collArtRequestComments;
	}

	/**
	 * Sets a collection of ArtRequestComment objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $artRequestComments A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setArtRequestComments(PropelCollection $artRequestComments, PropelPDO $con = null)
	{
		$this->artRequestCommentsScheduledForDeletion = $this->getArtRequestComments(new Criteria(), $con)->diff($artRequestComments);

		foreach ($artRequestComments as $artRequestComment) {
			// Fix issue with collection modified by reference
			if ($artRequestComment->isNew()) {
				$artRequestComment->setArtRequest($this);
			}
			$this->addArtRequestComment($artRequestComment);
		}

		$this->collArtRequestComments = $artRequestComments;
	}

	/**
	 * Returns the number of related ArtRequestComment objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related ArtRequestComment objects.
	 * @throws     PropelException
	 */
	public function countArtRequestComments(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collArtRequestComments || null !== $criteria) {
			if ($this->isNew() && null === $this->collArtRequestComments) {
				return 0;
			} else {
				$query = ArtRequestCommentQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByArtRequest($this)
					->count($con);
			}
		} else {
			return count($this->collArtRequestComments);
		}
	}

	/**
	 * Method called to associate a ArtRequestComment object to this object
	 * through the ArtRequestComment foreign key attribute.
	 *
	 * @param      ArtRequestComment $l ArtRequestComment
	 * @return     ArtRequest The current object (for fluent API support)
	 */
	public function addArtRequestComment(ArtRequestComment $l)
	{
		if ($this->collArtRequestComments === null) {
			$this->initArtRequestComments();
		}
		if (!$this->collArtRequestComments->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddArtRequestComment($l);
		}

		return $this;
	}

	/**
	 * @param	ArtRequestComment $artRequestComment The artRequestComment object to add.
	 */
	protected function doAddArtRequestComment($artRequestComment)
	{
		$this->collArtRequestComments[]= $artRequestComment;
		$artRequestComment->setArtRequest($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ArtRequest is new, it will return
	 * an empty collection; or if this ArtRequest has previously
	 * been saved, it will retrieve related ArtRequestComments from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ArtRequest.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array ArtRequestComment[] List of ArtRequestComment objects
	 */
	public function getArtRequestCommentsJoinUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = ArtRequestCommentQuery::create(null, $criteria);
		$query->joinWith('User', $join_behavior);

		return $this->getArtRequestComments($query, $con);
	}

	/**
	 * Clears out the collArtRequestDocuments collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addArtRequestDocuments()
	 */
	public function clearArtRequestDocuments()
	{
		$this->collArtRequestDocuments = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collArtRequestDocuments collection.
	 *
	 * By default this just sets the collArtRequestDocuments collection to an empty array (like clearcollArtRequestDocuments());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initArtRequestDocuments($overrideExisting = true)
	{
		if (null !== $this->collArtRequestDocuments && !$overrideExisting) {
			return;
		}
		$this->collArtRequestDocuments = new PropelObjectCollection();
		$this->collArtRequestDocuments->setModel('ArtRequestDocument');
	}

	/**
	 * Gets an array of ArtRequestDocument objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this ArtRequest is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array ArtRequestDocument[] List of ArtRequestDocument objects
	 * @throws     PropelException
	 */
	public function getArtRequestDocuments($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collArtRequestDocuments || null !== $criteria) {
			if ($this->isNew() && null === $this->collArtRequestDocuments) {
				// return empty collection
				$this->initArtRequestDocuments();
			} else {
				$collArtRequestDocuments = ArtRequestDocumentQuery::create(null, $criteria)
					->filterByArtRequest($this)
					->find($con);
				if (null !== $criteria) {
					return $collArtRequestDocuments;
				}
				$this->collArtRequestDocuments = $collArtRequestDocuments;
			}
		}
		return $this->collArtRequestDocuments;
	}

	/**
	 * Sets a collection of ArtRequestDocument objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $artRequestDocuments A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setArtRequestDocuments(PropelCollection $artRequestDocuments, PropelPDO $con = null)
	{
		$this->artRequestDocumentsScheduledForDeletion = $this->getArtRequestDocuments(new Criteria(), $con)->diff($artRequestDocuments);

		foreach ($artRequestDocuments as $artRequestDocument) {
			// Fix issue with collection modified by reference
			if ($artRequestDocument->isNew()) {
				$artRequestDocument->setArtRequest($this);
			}
			$this->addArtRequestDocument($artRequestDocument);
		}

		$this->collArtRequestDocuments = $artRequestDocuments;
	}

	/**
	 * Returns the number of related ArtRequestDocument objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related ArtRequestDocument objects.
	 * @throws     PropelException
	 */
	public function countArtRequestDocuments(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collArtRequestDocuments || null !== $criteria) {
			if ($this->isNew() && null === $this->collArtRequestDocuments) {
				return 0;
			} else {
				$query = ArtRequestDocumentQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByArtRequest($this)
					->count($con);
			}
		} else {
			return count($this->collArtRequestDocuments);
		}
	}

	/**
	 * Method called to associate a ArtRequestDocument object to this object
	 * through the ArtRequestDocument foreign key attribute.
	 *
	 * @param      ArtRequestDocument $l ArtRequestDocument
	 * @return     ArtRequest The current object (for fluent API support)
	 */
	public function addArtRequestDocument(ArtRequestDocument $l)
	{
		if ($this->collArtRequestDocuments === null) {
			$this->initArtRequestDocuments();
		}
		if (!$this->collArtRequestDocuments->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddArtRequestDocument($l);
		}

		return $this;
	}

	/**
	 * @param	ArtRequestDocument $artRequestDocument The artRequestDocument object to add.
	 */
	protected function doAddArtRequestDocument($artRequestDocument)
	{
		$this->collArtRequestDocuments[]= $artRequestDocument;
		$artRequestDocument->setArtRequest($this);
	}

	/**
	 * Clears out the collBannerRequests collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addBannerRequests()
	 */
	public function clearBannerRequests()
	{
		$this->collBannerRequests = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collBannerRequests collection.
	 *
	 * By default this just sets the collBannerRequests collection to an empty array (like clearcollBannerRequests());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initBannerRequests($overrideExisting = true)
	{
		if (null !== $this->collBannerRequests && !$overrideExisting) {
			return;
		}
		$this->collBannerRequests = new PropelObjectCollection();
		$this->collBannerRequests->setModel('BannerRequest');
	}

	/**
	 * Gets an array of BannerRequest objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this ArtRequest is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array BannerRequest[] List of BannerRequest objects
	 * @throws     PropelException
	 */
	public function getBannerRequests($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collBannerRequests || null !== $criteria) {
			if ($this->isNew() && null === $this->collBannerRequests) {
				// return empty collection
				$this->initBannerRequests();
			} else {
				$collBannerRequests = BannerRequestQuery::create(null, $criteria)
					->filterByArtRequest($this)
					->find($con);
				if (null !== $criteria) {
					return $collBannerRequests;
				}
				$this->collBannerRequests = $collBannerRequests;
			}
		}
		return $this->collBannerRequests;
	}

	/**
	 * Sets a collection of BannerRequest objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $bannerRequests A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setBannerRequests(PropelCollection $bannerRequests, PropelPDO $con = null)
	{
		$this->bannerRequestsScheduledForDeletion = $this->getBannerRequests(new Criteria(), $con)->diff($bannerRequests);

		foreach ($bannerRequests as $bannerRequest) {
			// Fix issue with collection modified by reference
			if ($bannerRequest->isNew()) {
				$bannerRequest->setArtRequest($this);
			}
			$this->addBannerRequest($bannerRequest);
		}

		$this->collBannerRequests = $bannerRequests;
	}

	/**
	 * Returns the number of related BannerRequest objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related BannerRequest objects.
	 * @throws     PropelException
	 */
	public function countBannerRequests(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collBannerRequests || null !== $criteria) {
			if ($this->isNew() && null === $this->collBannerRequests) {
				return 0;
			} else {
				$query = BannerRequestQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByArtRequest($this)
					->count($con);
			}
		} else {
			return count($this->collBannerRequests);
		}
	}

	/**
	 * Method called to associate a BannerRequest object to this object
	 * through the BannerRequest foreign key attribute.
	 *
	 * @param      BannerRequest $l BannerRequest
	 * @return     ArtRequest The current object (for fluent API support)
	 */
	public function addBannerRequest(BannerRequest $l)
	{
		if ($this->collBannerRequests === null) {
			$this->initBannerRequests();
		}
		if (!$this->collBannerRequests->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddBannerRequest($l);
		}

		return $this;
	}

	/**
	 * @param	BannerRequest $bannerRequest The bannerRequest object to add.
	 */
	protected function doAddBannerRequest($bannerRequest)
	{
		$this->collBannerRequests[]= $bannerRequest;
		$bannerRequest->setArtRequest($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ArtRequest is new, it will return
	 * an empty collection; or if this ArtRequest has previously
	 * been saved, it will retrieve related BannerRequests from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ArtRequest.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array BannerRequest[] List of BannerRequest objects
	 */
	public function getBannerRequestsJoinBannerLocation($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = BannerRequestQuery::create(null, $criteria);
		$query->joinWith('BannerLocation', $join_behavior);

		return $this->getBannerRequests($query, $con);
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
	 * If this ArtRequest is new, it will return
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
					->filterByArtRequest($this)
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
				$flyerArtRequest->setArtRequest($this);
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
					->filterByArtRequest($this)
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
	 * @return     ArtRequest The current object (for fluent API support)
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
		$flyerArtRequest->setArtRequest($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ArtRequest is new, it will return
	 * an empty collection; or if this ArtRequest has previously
	 * been saved, it will retrieve related FlyerArtRequests from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ArtRequest.
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
	 * Otherwise if this ArtRequest is new, it will return
	 * an empty collection; or if this ArtRequest has previously
	 * been saved, it will retrieve related FlyerArtRequests from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ArtRequest.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array FlyerArtRequest[] List of FlyerArtRequest objects
	 */
	public function getFlyerArtRequestsJoinFlyerFormat($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = FlyerArtRequestQuery::create(null, $criteria);
		$query->joinWith('FlyerFormat', $join_behavior);

		return $this->getFlyerArtRequests($query, $con);
	}

	/**
	 * Clears out the collLogoArtRequests collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addLogoArtRequests()
	 */
	public function clearLogoArtRequests()
	{
		$this->collLogoArtRequests = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collLogoArtRequests collection.
	 *
	 * By default this just sets the collLogoArtRequests collection to an empty array (like clearcollLogoArtRequests());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initLogoArtRequests($overrideExisting = true)
	{
		if (null !== $this->collLogoArtRequests && !$overrideExisting) {
			return;
		}
		$this->collLogoArtRequests = new PropelObjectCollection();
		$this->collLogoArtRequests->setModel('LogoArtRequest');
	}

	/**
	 * Gets an array of LogoArtRequest objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this ArtRequest is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array LogoArtRequest[] List of LogoArtRequest objects
	 * @throws     PropelException
	 */
	public function getLogoArtRequests($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collLogoArtRequests || null !== $criteria) {
			if ($this->isNew() && null === $this->collLogoArtRequests) {
				// return empty collection
				$this->initLogoArtRequests();
			} else {
				$collLogoArtRequests = LogoArtRequestQuery::create(null, $criteria)
					->filterByArtRequest($this)
					->find($con);
				if (null !== $criteria) {
					return $collLogoArtRequests;
				}
				$this->collLogoArtRequests = $collLogoArtRequests;
			}
		}
		return $this->collLogoArtRequests;
	}

	/**
	 * Sets a collection of LogoArtRequest objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $logoArtRequests A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setLogoArtRequests(PropelCollection $logoArtRequests, PropelPDO $con = null)
	{
		$this->logoArtRequestsScheduledForDeletion = $this->getLogoArtRequests(new Criteria(), $con)->diff($logoArtRequests);

		foreach ($logoArtRequests as $logoArtRequest) {
			// Fix issue with collection modified by reference
			if ($logoArtRequest->isNew()) {
				$logoArtRequest->setArtRequest($this);
			}
			$this->addLogoArtRequest($logoArtRequest);
		}

		$this->collLogoArtRequests = $logoArtRequests;
	}

	/**
	 * Returns the number of related LogoArtRequest objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related LogoArtRequest objects.
	 * @throws     PropelException
	 */
	public function countLogoArtRequests(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collLogoArtRequests || null !== $criteria) {
			if ($this->isNew() && null === $this->collLogoArtRequests) {
				return 0;
			} else {
				$query = LogoArtRequestQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByArtRequest($this)
					->count($con);
			}
		} else {
			return count($this->collLogoArtRequests);
		}
	}

	/**
	 * Method called to associate a LogoArtRequest object to this object
	 * through the LogoArtRequest foreign key attribute.
	 *
	 * @param      LogoArtRequest $l LogoArtRequest
	 * @return     ArtRequest The current object (for fluent API support)
	 */
	public function addLogoArtRequest(LogoArtRequest $l)
	{
		if ($this->collLogoArtRequests === null) {
			$this->initLogoArtRequests();
		}
		if (!$this->collLogoArtRequests->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddLogoArtRequest($l);
		}

		return $this;
	}

	/**
	 * @param	LogoArtRequest $logoArtRequest The logoArtRequest object to add.
	 */
	protected function doAddLogoArtRequest($logoArtRequest)
	{
		$this->collLogoArtRequests[]= $logoArtRequest;
		$logoArtRequest->setArtRequest($this);
	}

	/**
	 * Clears out the collOtherArtRequests collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addOtherArtRequests()
	 */
	public function clearOtherArtRequests()
	{
		$this->collOtherArtRequests = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collOtherArtRequests collection.
	 *
	 * By default this just sets the collOtherArtRequests collection to an empty array (like clearcollOtherArtRequests());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initOtherArtRequests($overrideExisting = true)
	{
		if (null !== $this->collOtherArtRequests && !$overrideExisting) {
			return;
		}
		$this->collOtherArtRequests = new PropelObjectCollection();
		$this->collOtherArtRequests->setModel('OtherArtRequest');
	}

	/**
	 * Gets an array of OtherArtRequest objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this ArtRequest is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array OtherArtRequest[] List of OtherArtRequest objects
	 * @throws     PropelException
	 */
	public function getOtherArtRequests($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collOtherArtRequests || null !== $criteria) {
			if ($this->isNew() && null === $this->collOtherArtRequests) {
				// return empty collection
				$this->initOtherArtRequests();
			} else {
				$collOtherArtRequests = OtherArtRequestQuery::create(null, $criteria)
					->filterByArtRequest($this)
					->find($con);
				if (null !== $criteria) {
					return $collOtherArtRequests;
				}
				$this->collOtherArtRequests = $collOtherArtRequests;
			}
		}
		return $this->collOtherArtRequests;
	}

	/**
	 * Sets a collection of OtherArtRequest objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $otherArtRequests A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setOtherArtRequests(PropelCollection $otherArtRequests, PropelPDO $con = null)
	{
		$this->otherArtRequestsScheduledForDeletion = $this->getOtherArtRequests(new Criteria(), $con)->diff($otherArtRequests);

		foreach ($otherArtRequests as $otherArtRequest) {
			// Fix issue with collection modified by reference
			if ($otherArtRequest->isNew()) {
				$otherArtRequest->setArtRequest($this);
			}
			$this->addOtherArtRequest($otherArtRequest);
		}

		$this->collOtherArtRequests = $otherArtRequests;
	}

	/**
	 * Returns the number of related OtherArtRequest objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related OtherArtRequest objects.
	 * @throws     PropelException
	 */
	public function countOtherArtRequests(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collOtherArtRequests || null !== $criteria) {
			if ($this->isNew() && null === $this->collOtherArtRequests) {
				return 0;
			} else {
				$query = OtherArtRequestQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByArtRequest($this)
					->count($con);
			}
		} else {
			return count($this->collOtherArtRequests);
		}
	}

	/**
	 * Method called to associate a OtherArtRequest object to this object
	 * through the OtherArtRequest foreign key attribute.
	 *
	 * @param      OtherArtRequest $l OtherArtRequest
	 * @return     ArtRequest The current object (for fluent API support)
	 */
	public function addOtherArtRequest(OtherArtRequest $l)
	{
		if ($this->collOtherArtRequests === null) {
			$this->initOtherArtRequests();
		}
		if (!$this->collOtherArtRequests->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddOtherArtRequest($l);
		}

		return $this;
	}

	/**
	 * @param	OtherArtRequest $otherArtRequest The otherArtRequest object to add.
	 */
	protected function doAddOtherArtRequest($otherArtRequest)
	{
		$this->collOtherArtRequests[]= $otherArtRequest;
		$otherArtRequest->setArtRequest($this);
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->art_request_id = null;
		$this->is_started = null;
		$this->is_completed = null;
		$this->is_archived = null;
		$this->is_request_confirmed = null;
		$this->start_date = null;
		$this->completion_date = null;
		$this->due_date = null;
		$this->art_requestor_id = null;
		$this->art_request_type_id = null;
		$this->event_id = null;
		$this->alreadyInSave = false;
		$this->alreadyInValidation = false;
		$this->clearAllReferences();
		$this->applyDefaultValues();
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
			if ($this->collArtRequestArtStatuss) {
				foreach ($this->collArtRequestArtStatuss as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collArtRequestComments) {
				foreach ($this->collArtRequestComments as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collArtRequestDocuments) {
				foreach ($this->collArtRequestDocuments as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collBannerRequests) {
				foreach ($this->collBannerRequests as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collFlyerArtRequests) {
				foreach ($this->collFlyerArtRequests as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collLogoArtRequests) {
				foreach ($this->collLogoArtRequests as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collOtherArtRequests) {
				foreach ($this->collOtherArtRequests as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		if ($this->collArtRequestArtStatuss instanceof PropelCollection) {
			$this->collArtRequestArtStatuss->clearIterator();
		}
		$this->collArtRequestArtStatuss = null;
		if ($this->collArtRequestComments instanceof PropelCollection) {
			$this->collArtRequestComments->clearIterator();
		}
		$this->collArtRequestComments = null;
		if ($this->collArtRequestDocuments instanceof PropelCollection) {
			$this->collArtRequestDocuments->clearIterator();
		}
		$this->collArtRequestDocuments = null;
		if ($this->collBannerRequests instanceof PropelCollection) {
			$this->collBannerRequests->clearIterator();
		}
		$this->collBannerRequests = null;
		if ($this->collFlyerArtRequests instanceof PropelCollection) {
			$this->collFlyerArtRequests->clearIterator();
		}
		$this->collFlyerArtRequests = null;
		if ($this->collLogoArtRequests instanceof PropelCollection) {
			$this->collLogoArtRequests->clearIterator();
		}
		$this->collLogoArtRequests = null;
		if ($this->collOtherArtRequests instanceof PropelCollection) {
			$this->collOtherArtRequests->clearIterator();
		}
		$this->collOtherArtRequests = null;
		$this->aArtRequestor = null;
		$this->aArtRequestType = null;
		$this->aEvent = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(ArtRequestPeer::DEFAULT_STRING_FORMAT);
	}

} // BaseArtRequest
