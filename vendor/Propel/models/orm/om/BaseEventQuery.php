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
use ORMModel\Event;
use ORMModel\EventPeer;
use ORMModel\EventPrice;
use ORMModel\EventQuery;

/**
 * Base class that represents a query for the 'event' table.
 *
 * 
 *
 * @method     EventQuery orderByEventId($order = Criteria::ASC) Order by the event_id column
 * @method     EventQuery orderByEventName($order = Criteria::ASC) Order by the event_name column
 * @method     EventQuery orderByEventDescription($order = Criteria::ASC) Order by the event_description column
 * @method     EventQuery orderByEventLocation($order = Criteria::ASC) Order by the event_location column
 * @method     EventQuery orderByEventSponsorName($order = Criteria::ASC) Order by the event_sponsor_name column
 * @method     EventQuery orderByEventStartTime($order = Criteria::ASC) Order by the event_start_time column
 * @method     EventQuery orderByEventEndTime($order = Criteria::ASC) Order by the event_end_time column
 *
 * @method     EventQuery groupByEventId() Group by the event_id column
 * @method     EventQuery groupByEventName() Group by the event_name column
 * @method     EventQuery groupByEventDescription() Group by the event_description column
 * @method     EventQuery groupByEventLocation() Group by the event_location column
 * @method     EventQuery groupByEventSponsorName() Group by the event_sponsor_name column
 * @method     EventQuery groupByEventStartTime() Group by the event_start_time column
 * @method     EventQuery groupByEventEndTime() Group by the event_end_time column
 *
 * @method     EventQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     EventQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     EventQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     EventQuery leftJoinArtRequest($relationAlias = null) Adds a LEFT JOIN clause to the query using the ArtRequest relation
 * @method     EventQuery rightJoinArtRequest($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ArtRequest relation
 * @method     EventQuery innerJoinArtRequest($relationAlias = null) Adds a INNER JOIN clause to the query using the ArtRequest relation
 *
 * @method     EventQuery leftJoinEventPrice($relationAlias = null) Adds a LEFT JOIN clause to the query using the EventPrice relation
 * @method     EventQuery rightJoinEventPrice($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EventPrice relation
 * @method     EventQuery innerJoinEventPrice($relationAlias = null) Adds a INNER JOIN clause to the query using the EventPrice relation
 *
 * @method     Event findOne(PropelPDO $con = null) Return the first Event matching the query
 * @method     Event findOneOrCreate(PropelPDO $con = null) Return the first Event matching the query, or a new Event object populated from the query conditions when no match is found
 *
 * @method     Event findOneByEventId(int $event_id) Return the first Event filtered by the event_id column
 * @method     Event findOneByEventName(string $event_name) Return the first Event filtered by the event_name column
 * @method     Event findOneByEventDescription(resource $event_description) Return the first Event filtered by the event_description column
 * @method     Event findOneByEventLocation(string $event_location) Return the first Event filtered by the event_location column
 * @method     Event findOneByEventSponsorName(string $event_sponsor_name) Return the first Event filtered by the event_sponsor_name column
 * @method     Event findOneByEventStartTime(string $event_start_time) Return the first Event filtered by the event_start_time column
 * @method     Event findOneByEventEndTime(string $event_end_time) Return the first Event filtered by the event_end_time column
 *
 * @method     array findByEventId(int $event_id) Return Event objects filtered by the event_id column
 * @method     array findByEventName(string $event_name) Return Event objects filtered by the event_name column
 * @method     array findByEventDescription(resource $event_description) Return Event objects filtered by the event_description column
 * @method     array findByEventLocation(string $event_location) Return Event objects filtered by the event_location column
 * @method     array findByEventSponsorName(string $event_sponsor_name) Return Event objects filtered by the event_sponsor_name column
 * @method     array findByEventStartTime(string $event_start_time) Return Event objects filtered by the event_start_time column
 * @method     array findByEventEndTime(string $event_end_time) Return Event objects filtered by the event_end_time column
 *
 * @package    propel.generator.orm.om
 */
abstract class BaseEventQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseEventQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'orm', $modelName = 'ORMModel\\Event', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new EventQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    EventQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof EventQuery) {
			return $criteria;
		}
		$query = new EventQuery();
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
	 * @return    Event|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = EventPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(EventPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Event A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `EVENT_ID`, `EVENT_NAME`, `EVENT_DESCRIPTION`, `EVENT_LOCATION`, `EVENT_SPONSOR_NAME`, `EVENT_START_TIME`, `EVENT_END_TIME` FROM `event` WHERE `EVENT_ID` = :p0';
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
			$obj = new Event();
			$obj->hydrate($row);
			EventPeer::addInstanceToPool($obj, (string) $key);
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
	 * @return    Event|array|mixed the result, formatted by the current formatter
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
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(EventPeer::EVENT_ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(EventPeer::EVENT_ID, $keys, Criteria::IN);
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
	 * @param     mixed $eventId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByEventId($eventId = null, $comparison = null)
	{
		if (is_array($eventId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(EventPeer::EVENT_ID, $eventId, $comparison);
	}

	/**
	 * Filter the query on the event_name column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEventName('fooValue');   // WHERE event_name = 'fooValue'
	 * $query->filterByEventName('%fooValue%'); // WHERE event_name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $eventName The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByEventName($eventName = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($eventName)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $eventName)) {
				$eventName = str_replace('*', '%', $eventName);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(EventPeer::EVENT_NAME, $eventName, $comparison);
	}

	/**
	 * Filter the query on the event_description column
	 *
	 * @param     mixed $eventDescription The value to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByEventDescription($eventDescription = null, $comparison = null)
	{
		return $this->addUsingAlias(EventPeer::EVENT_DESCRIPTION, $eventDescription, $comparison);
	}

	/**
	 * Filter the query on the event_location column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEventLocation('fooValue');   // WHERE event_location = 'fooValue'
	 * $query->filterByEventLocation('%fooValue%'); // WHERE event_location LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $eventLocation The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByEventLocation($eventLocation = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($eventLocation)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $eventLocation)) {
				$eventLocation = str_replace('*', '%', $eventLocation);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(EventPeer::EVENT_LOCATION, $eventLocation, $comparison);
	}

	/**
	 * Filter the query on the event_sponsor_name column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEventSponsorName('fooValue');   // WHERE event_sponsor_name = 'fooValue'
	 * $query->filterByEventSponsorName('%fooValue%'); // WHERE event_sponsor_name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $eventSponsorName The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByEventSponsorName($eventSponsorName = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($eventSponsorName)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $eventSponsorName)) {
				$eventSponsorName = str_replace('*', '%', $eventSponsorName);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(EventPeer::EVENT_SPONSOR_NAME, $eventSponsorName, $comparison);
	}

	/**
	 * Filter the query on the event_start_time column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEventStartTime('2011-03-14'); // WHERE event_start_time = '2011-03-14'
	 * $query->filterByEventStartTime('now'); // WHERE event_start_time = '2011-03-14'
	 * $query->filterByEventStartTime(array('max' => 'yesterday')); // WHERE event_start_time > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $eventStartTime The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByEventStartTime($eventStartTime = null, $comparison = null)
	{
		if (is_array($eventStartTime)) {
			$useMinMax = false;
			if (isset($eventStartTime['min'])) {
				$this->addUsingAlias(EventPeer::EVENT_START_TIME, $eventStartTime['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($eventStartTime['max'])) {
				$this->addUsingAlias(EventPeer::EVENT_START_TIME, $eventStartTime['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(EventPeer::EVENT_START_TIME, $eventStartTime, $comparison);
	}

	/**
	 * Filter the query on the event_end_time column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEventEndTime('2011-03-14'); // WHERE event_end_time = '2011-03-14'
	 * $query->filterByEventEndTime('now'); // WHERE event_end_time = '2011-03-14'
	 * $query->filterByEventEndTime(array('max' => 'yesterday')); // WHERE event_end_time > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $eventEndTime The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByEventEndTime($eventEndTime = null, $comparison = null)
	{
		if (is_array($eventEndTime)) {
			$useMinMax = false;
			if (isset($eventEndTime['min'])) {
				$this->addUsingAlias(EventPeer::EVENT_END_TIME, $eventEndTime['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($eventEndTime['max'])) {
				$this->addUsingAlias(EventPeer::EVENT_END_TIME, $eventEndTime['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(EventPeer::EVENT_END_TIME, $eventEndTime, $comparison);
	}

	/**
	 * Filter the query by a related ArtRequest object
	 *
	 * @param     ArtRequest $artRequest  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByArtRequest($artRequest, $comparison = null)
	{
		if ($artRequest instanceof ArtRequest) {
			return $this
				->addUsingAlias(EventPeer::EVENT_ID, $artRequest->getEventId(), $comparison);
		} elseif ($artRequest instanceof PropelCollection) {
			return $this
				->useArtRequestQuery()
				->filterByPrimaryKeys($artRequest->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByArtRequest() only accepts arguments of type ArtRequest or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the ArtRequest relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function joinArtRequest($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('ArtRequest');

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
			$this->addJoinObject($join, 'ArtRequest');
		}

		return $this;
	}

	/**
	 * Use the ArtRequest relation ArtRequest object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    \ORMModel\ArtRequestQuery A secondary query class using the current class as primary query
	 */
	public function useArtRequestQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinArtRequest($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'ArtRequest', '\ORMModel\ArtRequestQuery');
	}

	/**
	 * Filter the query by a related EventPrice object
	 *
	 * @param     EventPrice $eventPrice  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByEventPrice($eventPrice, $comparison = null)
	{
		if ($eventPrice instanceof EventPrice) {
			return $this
				->addUsingAlias(EventPeer::EVENT_ID, $eventPrice->getEventId(), $comparison);
		} elseif ($eventPrice instanceof PropelCollection) {
			return $this
				->useEventPriceQuery()
				->filterByPrimaryKeys($eventPrice->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByEventPrice() only accepts arguments of type EventPrice or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the EventPrice relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function joinEventPrice($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('EventPrice');

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
			$this->addJoinObject($join, 'EventPrice');
		}

		return $this;
	}

	/**
	 * Use the EventPrice relation EventPrice object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    \ORMModel\EventPriceQuery A secondary query class using the current class as primary query
	 */
	public function useEventPriceQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinEventPrice($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'EventPrice', '\ORMModel\EventPriceQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Event $event Object to remove from the list of results
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function prune($event = null)
	{
		if ($event) {
			$this->addUsingAlias(EventPeer::EVENT_ID, $event->getEventId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseEventQuery