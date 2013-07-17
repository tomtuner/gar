<?php

namespace ORMModel\om;

use \Criteria;
use \ModelCriteria;
use \ModelJoin;
use \PDO;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelPDO;
use ORMModel\ArtRequest;
use ORMModel\ArtRequestArtStatus;
use ORMModel\ArtRequestComment;
use ORMModel\ArtRequestDocument;
use ORMModel\ArtRequestPeer;
use ORMModel\ArtRequestQuery;
use ORMModel\ArtRequestType;
use ORMModel\ArtRequestor;
use ORMModel\BannerRequest;
use ORMModel\Event;
use ORMModel\FlyerArtRequest;
use ORMModel\LogoArtRequest;
use ORMModel\OtherArtRequest;

/**
 * Base class that represents a query for the 'art_request' table.
 *
 * 
 *
 * @method     ArtRequestQuery orderByArtRequestId($order = Criteria::ASC) Order by the art_request_id column
 * @method     ArtRequestQuery orderByIsStarted($order = Criteria::ASC) Order by the is_started column
 * @method     ArtRequestQuery orderByIsCompleted($order = Criteria::ASC) Order by the is_completed column
 * @method     ArtRequestQuery orderByIsArchived($order = Criteria::ASC) Order by the is_archived column
 * @method     ArtRequestQuery orderByIsRequestConfirmed($order = Criteria::ASC) Order by the is_request_confirmed column
 * @method     ArtRequestQuery orderByStartDate($order = Criteria::ASC) Order by the start_date column
 * @method     ArtRequestQuery orderByCompletionDate($order = Criteria::ASC) Order by the completion_date column
 * @method     ArtRequestQuery orderByDueDate($order = Criteria::ASC) Order by the due_date column
 * @method     ArtRequestQuery orderByArtRequestorId($order = Criteria::ASC) Order by the art_requestor_id column
 * @method     ArtRequestQuery orderByArtRequestTypeId($order = Criteria::ASC) Order by the art_request_type_id column
 * @method     ArtRequestQuery orderByEventId($order = Criteria::ASC) Order by the event_id column
 *
 * @method     ArtRequestQuery groupByArtRequestId() Group by the art_request_id column
 * @method     ArtRequestQuery groupByIsStarted() Group by the is_started column
 * @method     ArtRequestQuery groupByIsCompleted() Group by the is_completed column
 * @method     ArtRequestQuery groupByIsArchived() Group by the is_archived column
 * @method     ArtRequestQuery groupByIsRequestConfirmed() Group by the is_request_confirmed column
 * @method     ArtRequestQuery groupByStartDate() Group by the start_date column
 * @method     ArtRequestQuery groupByCompletionDate() Group by the completion_date column
 * @method     ArtRequestQuery groupByDueDate() Group by the due_date column
 * @method     ArtRequestQuery groupByArtRequestorId() Group by the art_requestor_id column
 * @method     ArtRequestQuery groupByArtRequestTypeId() Group by the art_request_type_id column
 * @method     ArtRequestQuery groupByEventId() Group by the event_id column
 *
 * @method     ArtRequestQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ArtRequestQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ArtRequestQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ArtRequestQuery leftJoinArtRequestor($relationAlias = null) Adds a LEFT JOIN clause to the query using the ArtRequestor relation
 * @method     ArtRequestQuery rightJoinArtRequestor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ArtRequestor relation
 * @method     ArtRequestQuery innerJoinArtRequestor($relationAlias = null) Adds a INNER JOIN clause to the query using the ArtRequestor relation
 *
 * @method     ArtRequestQuery leftJoinArtRequestType($relationAlias = null) Adds a LEFT JOIN clause to the query using the ArtRequestType relation
 * @method     ArtRequestQuery rightJoinArtRequestType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ArtRequestType relation
 * @method     ArtRequestQuery innerJoinArtRequestType($relationAlias = null) Adds a INNER JOIN clause to the query using the ArtRequestType relation
 *
 * @method     ArtRequestQuery leftJoinEvent($relationAlias = null) Adds a LEFT JOIN clause to the query using the Event relation
 * @method     ArtRequestQuery rightJoinEvent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Event relation
 * @method     ArtRequestQuery innerJoinEvent($relationAlias = null) Adds a INNER JOIN clause to the query using the Event relation
 *
 * @method     ArtRequestQuery leftJoinArtRequestArtStatus($relationAlias = null) Adds a LEFT JOIN clause to the query using the ArtRequestArtStatus relation
 * @method     ArtRequestQuery rightJoinArtRequestArtStatus($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ArtRequestArtStatus relation
 * @method     ArtRequestQuery innerJoinArtRequestArtStatus($relationAlias = null) Adds a INNER JOIN clause to the query using the ArtRequestArtStatus relation
 *
 * @method     ArtRequestQuery leftJoinArtRequestComment($relationAlias = null) Adds a LEFT JOIN clause to the query using the ArtRequestComment relation
 * @method     ArtRequestQuery rightJoinArtRequestComment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ArtRequestComment relation
 * @method     ArtRequestQuery innerJoinArtRequestComment($relationAlias = null) Adds a INNER JOIN clause to the query using the ArtRequestComment relation
 *
 * @method     ArtRequestQuery leftJoinArtRequestDocument($relationAlias = null) Adds a LEFT JOIN clause to the query using the ArtRequestDocument relation
 * @method     ArtRequestQuery rightJoinArtRequestDocument($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ArtRequestDocument relation
 * @method     ArtRequestQuery innerJoinArtRequestDocument($relationAlias = null) Adds a INNER JOIN clause to the query using the ArtRequestDocument relation
 *
 * @method     ArtRequestQuery leftJoinBannerRequest($relationAlias = null) Adds a LEFT JOIN clause to the query using the BannerRequest relation
 * @method     ArtRequestQuery rightJoinBannerRequest($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BannerRequest relation
 * @method     ArtRequestQuery innerJoinBannerRequest($relationAlias = null) Adds a INNER JOIN clause to the query using the BannerRequest relation
 *
 * @method     ArtRequestQuery leftJoinFlyerArtRequest($relationAlias = null) Adds a LEFT JOIN clause to the query using the FlyerArtRequest relation
 * @method     ArtRequestQuery rightJoinFlyerArtRequest($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FlyerArtRequest relation
 * @method     ArtRequestQuery innerJoinFlyerArtRequest($relationAlias = null) Adds a INNER JOIN clause to the query using the FlyerArtRequest relation
 *
 * @method     ArtRequestQuery leftJoinLogoArtRequest($relationAlias = null) Adds a LEFT JOIN clause to the query using the LogoArtRequest relation
 * @method     ArtRequestQuery rightJoinLogoArtRequest($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LogoArtRequest relation
 * @method     ArtRequestQuery innerJoinLogoArtRequest($relationAlias = null) Adds a INNER JOIN clause to the query using the LogoArtRequest relation
 *
 * @method     ArtRequestQuery leftJoinOtherArtRequest($relationAlias = null) Adds a LEFT JOIN clause to the query using the OtherArtRequest relation
 * @method     ArtRequestQuery rightJoinOtherArtRequest($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OtherArtRequest relation
 * @method     ArtRequestQuery innerJoinOtherArtRequest($relationAlias = null) Adds a INNER JOIN clause to the query using the OtherArtRequest relation
 *
 * @method     ArtRequest findOne(PropelPDO $con = null) Return the first ArtRequest matching the query
 * @method     ArtRequest findOneOrCreate(PropelPDO $con = null) Return the first ArtRequest matching the query, or a new ArtRequest object populated from the query conditions when no match is found
 *
 * @method     ArtRequest findOneByArtRequestId(int $art_request_id) Return the first ArtRequest filtered by the art_request_id column
 * @method     ArtRequest findOneByIsStarted(boolean $is_started) Return the first ArtRequest filtered by the is_started column
 * @method     ArtRequest findOneByIsCompleted(boolean $is_completed) Return the first ArtRequest filtered by the is_completed column
 * @method     ArtRequest findOneByIsArchived(boolean $is_archived) Return the first ArtRequest filtered by the is_archived column
 * @method     ArtRequest findOneByIsRequestConfirmed(boolean $is_request_confirmed) Return the first ArtRequest filtered by the is_request_confirmed column
 * @method     ArtRequest findOneByStartDate(string $start_date) Return the first ArtRequest filtered by the start_date column
 * @method     ArtRequest findOneByCompletionDate(string $completion_date) Return the first ArtRequest filtered by the completion_date column
 * @method     ArtRequest findOneByDueDate(string $due_date) Return the first ArtRequest filtered by the due_date column
 * @method     ArtRequest findOneByArtRequestorId(int $art_requestor_id) Return the first ArtRequest filtered by the art_requestor_id column
 * @method     ArtRequest findOneByArtRequestTypeId(int $art_request_type_id) Return the first ArtRequest filtered by the art_request_type_id column
 * @method     ArtRequest findOneByEventId(int $event_id) Return the first ArtRequest filtered by the event_id column
 *
 * @method     array findByArtRequestId(int $art_request_id) Return ArtRequest objects filtered by the art_request_id column
 * @method     array findByIsStarted(boolean $is_started) Return ArtRequest objects filtered by the is_started column
 * @method     array findByIsCompleted(boolean $is_completed) Return ArtRequest objects filtered by the is_completed column
 * @method     array findByIsArchived(boolean $is_archived) Return ArtRequest objects filtered by the is_archived column
 * @method     array findByIsRequestConfirmed(boolean $is_request_confirmed) Return ArtRequest objects filtered by the is_request_confirmed column
 * @method     array findByStartDate(string $start_date) Return ArtRequest objects filtered by the start_date column
 * @method     array findByCompletionDate(string $completion_date) Return ArtRequest objects filtered by the completion_date column
 * @method     array findByDueDate(string $due_date) Return ArtRequest objects filtered by the due_date column
 * @method     array findByArtRequestorId(int $art_requestor_id) Return ArtRequest objects filtered by the art_requestor_id column
 * @method     array findByArtRequestTypeId(int $art_request_type_id) Return ArtRequest objects filtered by the art_request_type_id column
 * @method     array findByEventId(int $event_id) Return ArtRequest objects filtered by the event_id column
 *
 * @package    propel.generator.orm.om
 */
abstract class BaseArtRequestQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseArtRequestQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'orm', $modelName = 'ORMModel\\ArtRequest', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new ArtRequestQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    ArtRequestQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof ArtRequestQuery) {
			return $criteria;
		}
		$query = new ArtRequestQuery();
		if (null !== $modelAlias) {
			$query->setModelAlias($modelAlias);
		}
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

	/**
	 * Find object by primary key.
	 * Propel uses the instance pool to skip the database if the object exists.
	 * Go fast if the query is untouched.
	 *
	 * <code>
	 * $obj  = $c->findPk(12, $con);
	 * </code>
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    ArtRequest|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = ArtRequestPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(ArtRequestPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$this->basePreSelect($con);
		if ($this->formatter || $this->modelAlias || $this->with || $this->select
		 || $this->selectColumns || $this->asColumns || $this->selectModifiers
		 || $this->map || $this->having || $this->joins) {
			return $this->findPkComplex($key, $con);
		} else {
			return $this->findPkSimple($key, $con);
		}
	}

	/**
	 * Find object by primary key using raw SQL to go fast.
	 * Bypass doSelect() and the object formatter by using generated code.
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con A connection object
	 *
	 * @return    ArtRequest A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ART_REQUEST_ID`, `IS_STARTED`, `IS_COMPLETED`, `IS_ARCHIVED`, `IS_REQUEST_CONFIRMED`, `START_DATE`, `COMPLETION_DATE`, `DUE_DATE`, `ART_REQUESTOR_ID`, `ART_REQUEST_TYPE_ID`, `EVENT_ID` FROM `art_request` WHERE `ART_REQUEST_ID` = :p0';
		try {
			$stmt = $con->prepare($sql);
			$stmt->bindValue(':p0', $key, PDO::PARAM_INT);
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
		}
		$obj = null;
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$obj = new ArtRequest();
			$obj->hydrate($row);
			ArtRequestPeer::addInstanceToPool($obj, (string) $key);
		}
		$stmt->closeCursor();

		return $obj;
	}

	/**
	 * Find object by primary key.
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con A connection object
	 *
	 * @return    ArtRequest|array|mixed the result, formatted by the current formatter
	 */
	protected function findPkComplex($key, $con)
	{
		// As the query uses a PK condition, no limit(1) is necessary.
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		$stmt = $criteria
			->filterByPrimaryKey($key)
			->doSelect($con);
		return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
	}

	/**
	 * Find objects by primary key
	 * <code>
	 * $objs = $c->findPks(array(12, 56, 832), $con);
	 * </code>
	 * @param     array $keys Primary keys to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    PropelObjectCollection|array|mixed the list of results, formatted by the current formatter
	 */
	public function findPks($keys, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
		}
		$this->basePreSelect($con);
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		$stmt = $criteria
			->filterByPrimaryKeys($keys)
			->doSelect($con);
		return $criteria->getFormatter()->init($criteria)->format($stmt);
	}

	/**
	 * Filter the query by primary key
	 *
	 * @param     mixed $key Primary key to use for the query
	 *
	 * @return    ArtRequestQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(ArtRequestPeer::ART_REQUEST_ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    ArtRequestQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(ArtRequestPeer::ART_REQUEST_ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the art_request_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByArtRequestId(1234); // WHERE art_request_id = 1234
	 * $query->filterByArtRequestId(array(12, 34)); // WHERE art_request_id IN (12, 34)
	 * $query->filterByArtRequestId(array('min' => 12)); // WHERE art_request_id > 12
	 * </code>
	 *
	 * @param     mixed $artRequestId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestQuery The current query, for fluid interface
	 */
	public function filterByArtRequestId($artRequestId = null, $comparison = null)
	{
		if (is_array($artRequestId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(ArtRequestPeer::ART_REQUEST_ID, $artRequestId, $comparison);
	}

	/**
	 * Filter the query on the is_started column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByIsStarted(true); // WHERE is_started = true
	 * $query->filterByIsStarted('yes'); // WHERE is_started = true
	 * </code>
	 *
	 * @param     boolean|string $isStarted The value to use as filter.
	 *              Non-boolean arguments are converted using the following rules:
	 *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestQuery The current query, for fluid interface
	 */
	public function filterByIsStarted($isStarted = null, $comparison = null)
	{
		if (is_string($isStarted)) {
			$is_started = in_array(strtolower($isStarted), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
		}
		return $this->addUsingAlias(ArtRequestPeer::IS_STARTED, $isStarted, $comparison);
	}

	/**
	 * Filter the query on the is_completed column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByIsCompleted(true); // WHERE is_completed = true
	 * $query->filterByIsCompleted('yes'); // WHERE is_completed = true
	 * </code>
	 *
	 * @param     boolean|string $isCompleted The value to use as filter.
	 *              Non-boolean arguments are converted using the following rules:
	 *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestQuery The current query, for fluid interface
	 */
	public function filterByIsCompleted($isCompleted = null, $comparison = null)
	{
		if (is_string($isCompleted)) {
			$is_completed = in_array(strtolower($isCompleted), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
		}
		return $this->addUsingAlias(ArtRequestPeer::IS_COMPLETED, $isCompleted, $comparison);
	}

	/**
	 * Filter the query on the is_archived column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByIsArchived(true); // WHERE is_archived = true
	 * $query->filterByIsArchived('yes'); // WHERE is_archived = true
	 * </code>
	 *
	 * @param     boolean|string $isArchived The value to use as filter.
	 *              Non-boolean arguments are converted using the following rules:
	 *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestQuery The current query, for fluid interface
	 */
	public function filterByIsArchived($isArchived = null, $comparison = null)
	{
		if (is_string($isArchived)) {
			$is_archived = in_array(strtolower($isArchived), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
		}
		return $this->addUsingAlias(ArtRequestPeer::IS_ARCHIVED, $isArchived, $comparison);
	}

	/**
	 * Filter the query on the is_request_confirmed column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByIsRequestConfirmed(true); // WHERE is_request_confirmed = true
	 * $query->filterByIsRequestConfirmed('yes'); // WHERE is_request_confirmed = true
	 * </code>
	 *
	 * @param     boolean|string $isRequestConfirmed The value to use as filter.
	 *              Non-boolean arguments are converted using the following rules:
	 *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestQuery The current query, for fluid interface
	 */
	public function filterByIsRequestConfirmed($isRequestConfirmed = null, $comparison = null)
	{
		if (is_string($isRequestConfirmed)) {
			$is_request_confirmed = in_array(strtolower($isRequestConfirmed), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
		}
		return $this->addUsingAlias(ArtRequestPeer::IS_REQUEST_CONFIRMED, $isRequestConfirmed, $comparison);
	}

	/**
	 * Filter the query on the start_date column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByStartDate('2011-03-14'); // WHERE start_date = '2011-03-14'
	 * $query->filterByStartDate('now'); // WHERE start_date = '2011-03-14'
	 * $query->filterByStartDate(array('max' => 'yesterday')); // WHERE start_date > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $startDate The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestQuery The current query, for fluid interface
	 */
	public function filterByStartDate($startDate = null, $comparison = null)
	{
		if (is_array($startDate)) {
			$useMinMax = false;
			if (isset($startDate['min'])) {
				$this->addUsingAlias(ArtRequestPeer::START_DATE, $startDate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($startDate['max'])) {
				$this->addUsingAlias(ArtRequestPeer::START_DATE, $startDate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ArtRequestPeer::START_DATE, $startDate, $comparison);
	}

	/**
	 * Filter the query on the completion_date column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCompletionDate('2011-03-14'); // WHERE completion_date = '2011-03-14'
	 * $query->filterByCompletionDate('now'); // WHERE completion_date = '2011-03-14'
	 * $query->filterByCompletionDate(array('max' => 'yesterday')); // WHERE completion_date > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $completionDate The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestQuery The current query, for fluid interface
	 */
	public function filterByCompletionDate($completionDate = null, $comparison = null)
	{
		if (is_array($completionDate)) {
			$useMinMax = false;
			if (isset($completionDate['min'])) {
				$this->addUsingAlias(ArtRequestPeer::COMPLETION_DATE, $completionDate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($completionDate['max'])) {
				$this->addUsingAlias(ArtRequestPeer::COMPLETION_DATE, $completionDate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ArtRequestPeer::COMPLETION_DATE, $completionDate, $comparison);
	}

	/**
	 * Filter the query on the due_date column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByDueDate('2011-03-14'); // WHERE due_date = '2011-03-14'
	 * $query->filterByDueDate('now'); // WHERE due_date = '2011-03-14'
	 * $query->filterByDueDate(array('max' => 'yesterday')); // WHERE due_date > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $dueDate The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestQuery The current query, for fluid interface
	 */
	public function filterByDueDate($dueDate = null, $comparison = null)
	{
		if (is_array($dueDate)) {
			$useMinMax = false;
			if (isset($dueDate['min'])) {
				$this->addUsingAlias(ArtRequestPeer::DUE_DATE, $dueDate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($dueDate['max'])) {
				$this->addUsingAlias(ArtRequestPeer::DUE_DATE, $dueDate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ArtRequestPeer::DUE_DATE, $dueDate, $comparison);
	}

	/**
	 * Filter the query on the art_requestor_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByArtRequestorId(1234); // WHERE art_requestor_id = 1234
	 * $query->filterByArtRequestorId(array(12, 34)); // WHERE art_requestor_id IN (12, 34)
	 * $query->filterByArtRequestorId(array('min' => 12)); // WHERE art_requestor_id > 12
	 * </code>
	 *
	 * @see       filterByArtRequestor()
	 *
	 * @param     mixed $artRequestorId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestQuery The current query, for fluid interface
	 */
	public function filterByArtRequestorId($artRequestorId = null, $comparison = null)
	{
		if (is_array($artRequestorId)) {
			$useMinMax = false;
			if (isset($artRequestorId['min'])) {
				$this->addUsingAlias(ArtRequestPeer::ART_REQUESTOR_ID, $artRequestorId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($artRequestorId['max'])) {
				$this->addUsingAlias(ArtRequestPeer::ART_REQUESTOR_ID, $artRequestorId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ArtRequestPeer::ART_REQUESTOR_ID, $artRequestorId, $comparison);
	}

	/**
	 * Filter the query on the art_request_type_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByArtRequestTypeId(1234); // WHERE art_request_type_id = 1234
	 * $query->filterByArtRequestTypeId(array(12, 34)); // WHERE art_request_type_id IN (12, 34)
	 * $query->filterByArtRequestTypeId(array('min' => 12)); // WHERE art_request_type_id > 12
	 * </code>
	 *
	 * @see       filterByArtRequestType()
	 *
	 * @param     mixed $artRequestTypeId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestQuery The current query, for fluid interface
	 */
	public function filterByArtRequestTypeId($artRequestTypeId = null, $comparison = null)
	{
		if (is_array($artRequestTypeId)) {
			$useMinMax = false;
			if (isset($artRequestTypeId['min'])) {
				$this->addUsingAlias(ArtRequestPeer::ART_REQUEST_TYPE_ID, $artRequestTypeId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($artRequestTypeId['max'])) {
				$this->addUsingAlias(ArtRequestPeer::ART_REQUEST_TYPE_ID, $artRequestTypeId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ArtRequestPeer::ART_REQUEST_TYPE_ID, $artRequestTypeId, $comparison);
	}

	/**
	 * Filter the query on the event_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEventId(1234); // WHERE event_id = 1234
	 * $query->filterByEventId(array(12, 34)); // WHERE event_id IN (12, 34)
	 * $query->filterByEventId(array('min' => 12)); // WHERE event_id > 12
	 * </code>
	 *
	 * @see       filterByEvent()
	 *
	 * @param     mixed $eventId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestQuery The current query, for fluid interface
	 */
	public function filterByEventId($eventId = null, $comparison = null)
	{
		if (is_array($eventId)) {
			$useMinMax = false;
			if (isset($eventId['min'])) {
				$this->addUsingAlias(ArtRequestPeer::EVENT_ID, $eventId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($eventId['max'])) {
				$this->addUsingAlias(ArtRequestPeer::EVENT_ID, $eventId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ArtRequestPeer::EVENT_ID, $eventId, $comparison);
	}

	/**
	 * Filter the query by a related ArtRequestor object
	 *
	 * @param     ArtRequestor|PropelCollection $artRequestor The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestQuery The current query, for fluid interface
	 */
	public function filterByArtRequestor($artRequestor, $comparison = null)
	{
		if ($artRequestor instanceof ArtRequestor) {
			return $this
				->addUsingAlias(ArtRequestPeer::ART_REQUESTOR_ID, $artRequestor->getArtRequestorId(), $comparison);
		} elseif ($artRequestor instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(ArtRequestPeer::ART_REQUESTOR_ID, $artRequestor->toKeyValue('PrimaryKey', 'ArtRequestorId'), $comparison);
		} else {
			throw new PropelException('filterByArtRequestor() only accepts arguments of type ArtRequestor or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the ArtRequestor relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ArtRequestQuery The current query, for fluid interface
	 */
	public function joinArtRequestor($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('ArtRequestor');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'ArtRequestor');
		}

		return $this;
	}

	/**
	 * Use the ArtRequestor relation ArtRequestor object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    \ORMModel\ArtRequestorQuery A secondary query class using the current class as primary query
	 */
	public function useArtRequestorQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinArtRequestor($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'ArtRequestor', '\ORMModel\ArtRequestorQuery');
	}

	/**
	 * Filter the query by a related ArtRequestType object
	 *
	 * @param     ArtRequestType|PropelCollection $artRequestType The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestQuery The current query, for fluid interface
	 */
	public function filterByArtRequestType($artRequestType, $comparison = null)
	{
		if ($artRequestType instanceof ArtRequestType) {
			return $this
				->addUsingAlias(ArtRequestPeer::ART_REQUEST_TYPE_ID, $artRequestType->getArtRequestTypeId(), $comparison);
		} elseif ($artRequestType instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(ArtRequestPeer::ART_REQUEST_TYPE_ID, $artRequestType->toKeyValue('PrimaryKey', 'ArtRequestTypeId'), $comparison);
		} else {
			throw new PropelException('filterByArtRequestType() only accepts arguments of type ArtRequestType or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the ArtRequestType relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ArtRequestQuery The current query, for fluid interface
	 */
	public function joinArtRequestType($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('ArtRequestType');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'ArtRequestType');
		}

		return $this;
	}

	/**
	 * Use the ArtRequestType relation ArtRequestType object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    \ORMModel\ArtRequestTypeQuery A secondary query class using the current class as primary query
	 */
	public function useArtRequestTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinArtRequestType($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'ArtRequestType', '\ORMModel\ArtRequestTypeQuery');
	}

	/**
	 * Filter the query by a related Event object
	 *
	 * @param     Event|PropelCollection $event The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestQuery The current query, for fluid interface
	 */
	public function filterByEvent($event, $comparison = null)
	{
		if ($event instanceof Event) {
			return $this
				->addUsingAlias(ArtRequestPeer::EVENT_ID, $event->getEventId(), $comparison);
		} elseif ($event instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(ArtRequestPeer::EVENT_ID, $event->toKeyValue('PrimaryKey', 'EventId'), $comparison);
		} else {
			throw new PropelException('filterByEvent() only accepts arguments of type Event or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Event relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ArtRequestQuery The current query, for fluid interface
	 */
	public function joinEvent($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Event');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'Event');
		}

		return $this;
	}

	/**
	 * Use the Event relation Event object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    \ORMModel\EventQuery A secondary query class using the current class as primary query
	 */
	public function useEventQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinEvent($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Event', '\ORMModel\EventQuery');
	}

	/**
	 * Filter the query by a related ArtRequestArtStatus object
	 *
	 * @param     ArtRequestArtStatus $artRequestArtStatus  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestQuery The current query, for fluid interface
	 */
	public function filterByArtRequestArtStatus($artRequestArtStatus, $comparison = null)
	{
		if ($artRequestArtStatus instanceof ArtRequestArtStatus) {
			return $this
				->addUsingAlias(ArtRequestPeer::ART_REQUEST_ID, $artRequestArtStatus->getArtRequestId(), $comparison);
		} elseif ($artRequestArtStatus instanceof PropelCollection) {
			return $this
				->useArtRequestArtStatusQuery()
				->filterByPrimaryKeys($artRequestArtStatus->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByArtRequestArtStatus() only accepts arguments of type ArtRequestArtStatus or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the ArtRequestArtStatus relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ArtRequestQuery The current query, for fluid interface
	 */
	public function joinArtRequestArtStatus($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('ArtRequestArtStatus');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'ArtRequestArtStatus');
		}

		return $this;
	}

	/**
	 * Use the ArtRequestArtStatus relation ArtRequestArtStatus object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    \ORMModel\ArtRequestArtStatusQuery A secondary query class using the current class as primary query
	 */
	public function useArtRequestArtStatusQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinArtRequestArtStatus($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'ArtRequestArtStatus', '\ORMModel\ArtRequestArtStatusQuery');
	}

	/**
	 * Filter the query by a related ArtRequestComment object
	 *
	 * @param     ArtRequestComment $artRequestComment  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestQuery The current query, for fluid interface
	 */
	public function filterByArtRequestComment($artRequestComment, $comparison = null)
	{
		if ($artRequestComment instanceof ArtRequestComment) {
			return $this
				->addUsingAlias(ArtRequestPeer::ART_REQUEST_ID, $artRequestComment->getArtRequestId(), $comparison);
		} elseif ($artRequestComment instanceof PropelCollection) {
			return $this
				->useArtRequestCommentQuery()
				->filterByPrimaryKeys($artRequestComment->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByArtRequestComment() only accepts arguments of type ArtRequestComment or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the ArtRequestComment relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ArtRequestQuery The current query, for fluid interface
	 */
	public function joinArtRequestComment($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('ArtRequestComment');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'ArtRequestComment');
		}

		return $this;
	}

	/**
	 * Use the ArtRequestComment relation ArtRequestComment object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    \ORMModel\ArtRequestCommentQuery A secondary query class using the current class as primary query
	 */
	public function useArtRequestCommentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinArtRequestComment($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'ArtRequestComment', '\ORMModel\ArtRequestCommentQuery');
	}

	/**
	 * Filter the query by a related ArtRequestDocument object
	 *
	 * @param     ArtRequestDocument $artRequestDocument  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestQuery The current query, for fluid interface
	 */
	public function filterByArtRequestDocument($artRequestDocument, $comparison = null)
	{
		if ($artRequestDocument instanceof ArtRequestDocument) {
			return $this
				->addUsingAlias(ArtRequestPeer::ART_REQUEST_ID, $artRequestDocument->getArtRequestId(), $comparison);
		} elseif ($artRequestDocument instanceof PropelCollection) {
			return $this
				->useArtRequestDocumentQuery()
				->filterByPrimaryKeys($artRequestDocument->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByArtRequestDocument() only accepts arguments of type ArtRequestDocument or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the ArtRequestDocument relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ArtRequestQuery The current query, for fluid interface
	 */
	public function joinArtRequestDocument($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('ArtRequestDocument');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'ArtRequestDocument');
		}

		return $this;
	}

	/**
	 * Use the ArtRequestDocument relation ArtRequestDocument object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    \ORMModel\ArtRequestDocumentQuery A secondary query class using the current class as primary query
	 */
	public function useArtRequestDocumentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinArtRequestDocument($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'ArtRequestDocument', '\ORMModel\ArtRequestDocumentQuery');
	}

	/**
	 * Filter the query by a related BannerRequest object
	 *
	 * @param     BannerRequest $bannerRequest  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestQuery The current query, for fluid interface
	 */
	public function filterByBannerRequest($bannerRequest, $comparison = null)
	{
		if ($bannerRequest instanceof BannerRequest) {
			return $this
				->addUsingAlias(ArtRequestPeer::ART_REQUEST_ID, $bannerRequest->getArtRequestId(), $comparison);
		} elseif ($bannerRequest instanceof PropelCollection) {
			return $this
				->useBannerRequestQuery()
				->filterByPrimaryKeys($bannerRequest->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByBannerRequest() only accepts arguments of type BannerRequest or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the BannerRequest relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ArtRequestQuery The current query, for fluid interface
	 */
	public function joinBannerRequest($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('BannerRequest');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'BannerRequest');
		}

		return $this;
	}

	/**
	 * Use the BannerRequest relation BannerRequest object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    \ORMModel\BannerRequestQuery A secondary query class using the current class as primary query
	 */
	public function useBannerRequestQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinBannerRequest($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'BannerRequest', '\ORMModel\BannerRequestQuery');
	}

	/**
	 * Filter the query by a related FlyerArtRequest object
	 *
	 * @param     FlyerArtRequest $flyerArtRequest  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestQuery The current query, for fluid interface
	 */
	public function filterByFlyerArtRequest($flyerArtRequest, $comparison = null)
	{
		if ($flyerArtRequest instanceof FlyerArtRequest) {
			return $this
				->addUsingAlias(ArtRequestPeer::ART_REQUEST_ID, $flyerArtRequest->getArtRequestId(), $comparison);
		} elseif ($flyerArtRequest instanceof PropelCollection) {
			return $this
				->useFlyerArtRequestQuery()
				->filterByPrimaryKeys($flyerArtRequest->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByFlyerArtRequest() only accepts arguments of type FlyerArtRequest or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the FlyerArtRequest relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ArtRequestQuery The current query, for fluid interface
	 */
	public function joinFlyerArtRequest($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('FlyerArtRequest');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'FlyerArtRequest');
		}

		return $this;
	}

	/**
	 * Use the FlyerArtRequest relation FlyerArtRequest object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    \ORMModel\FlyerArtRequestQuery A secondary query class using the current class as primary query
	 */
	public function useFlyerArtRequestQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinFlyerArtRequest($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'FlyerArtRequest', '\ORMModel\FlyerArtRequestQuery');
	}

	/**
	 * Filter the query by a related LogoArtRequest object
	 *
	 * @param     LogoArtRequest $logoArtRequest  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestQuery The current query, for fluid interface
	 */
	public function filterByLogoArtRequest($logoArtRequest, $comparison = null)
	{
		if ($logoArtRequest instanceof LogoArtRequest) {
			return $this
				->addUsingAlias(ArtRequestPeer::ART_REQUEST_ID, $logoArtRequest->getArtRequestId(), $comparison);
		} elseif ($logoArtRequest instanceof PropelCollection) {
			return $this
				->useLogoArtRequestQuery()
				->filterByPrimaryKeys($logoArtRequest->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByLogoArtRequest() only accepts arguments of type LogoArtRequest or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the LogoArtRequest relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ArtRequestQuery The current query, for fluid interface
	 */
	public function joinLogoArtRequest($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('LogoArtRequest');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'LogoArtRequest');
		}

		return $this;
	}

	/**
	 * Use the LogoArtRequest relation LogoArtRequest object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    \ORMModel\LogoArtRequestQuery A secondary query class using the current class as primary query
	 */
	public function useLogoArtRequestQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinLogoArtRequest($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'LogoArtRequest', '\ORMModel\LogoArtRequestQuery');
	}

	/**
	 * Filter the query by a related OtherArtRequest object
	 *
	 * @param     OtherArtRequest $otherArtRequest  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestQuery The current query, for fluid interface
	 */
	public function filterByOtherArtRequest($otherArtRequest, $comparison = null)
	{
		if ($otherArtRequest instanceof OtherArtRequest) {
			return $this
				->addUsingAlias(ArtRequestPeer::ART_REQUEST_ID, $otherArtRequest->getArtRequestId(), $comparison);
		} elseif ($otherArtRequest instanceof PropelCollection) {
			return $this
				->useOtherArtRequestQuery()
				->filterByPrimaryKeys($otherArtRequest->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByOtherArtRequest() only accepts arguments of type OtherArtRequest or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the OtherArtRequest relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ArtRequestQuery The current query, for fluid interface
	 */
	public function joinOtherArtRequest($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('OtherArtRequest');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'OtherArtRequest');
		}

		return $this;
	}

	/**
	 * Use the OtherArtRequest relation OtherArtRequest object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    \ORMModel\OtherArtRequestQuery A secondary query class using the current class as primary query
	 */
	public function useOtherArtRequestQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinOtherArtRequest($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'OtherArtRequest', '\ORMModel\OtherArtRequestQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     ArtRequest $artRequest Object to remove from the list of results
	 *
	 * @return    ArtRequestQuery The current query, for fluid interface
	 */
	public function prune($artRequest = null)
	{
		if ($artRequest) {
			$this->addUsingAlias(ArtRequestPeer::ART_REQUEST_ID, $artRequest->getArtRequestId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseArtRequestQuery