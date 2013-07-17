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
use ORMModel\Event;
use ORMModel\EventPrice;
use ORMModel\EventPricePeer;
use ORMModel\EventPriceQuery;
use ORMModel\EventPriceType;

/**
 * Base class that represents a query for the 'event_price' table.
 *
 * 
 *
 * @method     EventPriceQuery orderByEventPriceTypeId($order = Criteria::ASC) Order by the event_price_type_id column
 * @method     EventPriceQuery orderByEventId($order = Criteria::ASC) Order by the event_id column
 *
 * @method     EventPriceQuery groupByEventPriceTypeId() Group by the event_price_type_id column
 * @method     EventPriceQuery groupByEventId() Group by the event_id column
 *
 * @method     EventPriceQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     EventPriceQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     EventPriceQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     EventPriceQuery leftJoinEvent($relationAlias = null) Adds a LEFT JOIN clause to the query using the Event relation
 * @method     EventPriceQuery rightJoinEvent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Event relation
 * @method     EventPriceQuery innerJoinEvent($relationAlias = null) Adds a INNER JOIN clause to the query using the Event relation
 *
 * @method     EventPriceQuery leftJoinEventPriceType($relationAlias = null) Adds a LEFT JOIN clause to the query using the EventPriceType relation
 * @method     EventPriceQuery rightJoinEventPriceType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EventPriceType relation
 * @method     EventPriceQuery innerJoinEventPriceType($relationAlias = null) Adds a INNER JOIN clause to the query using the EventPriceType relation
 *
 * @method     EventPrice findOne(PropelPDO $con = null) Return the first EventPrice matching the query
 * @method     EventPrice findOneOrCreate(PropelPDO $con = null) Return the first EventPrice matching the query, or a new EventPrice object populated from the query conditions when no match is found
 *
 * @method     EventPrice findOneByEventPriceTypeId(int $event_price_type_id) Return the first EventPrice filtered by the event_price_type_id column
 * @method     EventPrice findOneByEventId(int $event_id) Return the first EventPrice filtered by the event_id column
 *
 * @method     array findByEventPriceTypeId(int $event_price_type_id) Return EventPrice objects filtered by the event_price_type_id column
 * @method     array findByEventId(int $event_id) Return EventPrice objects filtered by the event_id column
 *
 * @package    propel.generator.orm.om
 */
abstract class BaseEventPriceQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseEventPriceQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'orm', $modelName = 'ORMModel\\EventPrice', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new EventPriceQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    EventPriceQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof EventPriceQuery) {
			return $criteria;
		}
		$query = new EventPriceQuery();
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
	 * $obj = $c->findPk(array(12, 34), $con);
	 * </code>
	 *
	 * @param     array[$event_price_type_id, $event_id] $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    EventPrice|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = EventPricePeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(EventPricePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    EventPrice A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `EVENT_PRICE_TYPE_ID`, `EVENT_ID` FROM `event_price` WHERE `EVENT_PRICE_TYPE_ID` = :p0 AND `EVENT_ID` = :p1';
		try {
			$stmt = $con->prepare($sql);
			$stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
			$stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
		}
		$obj = null;
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$obj = new EventPrice();
			$obj->hydrate($row);
			EventPricePeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
	 * @return    EventPrice|array|mixed the result, formatted by the current formatter
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
	 * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
	 * @return    EventPriceQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		$this->addUsingAlias(EventPricePeer::EVENT_PRICE_TYPE_ID, $key[0], Criteria::EQUAL);
		$this->addUsingAlias(EventPricePeer::EVENT_ID, $key[1], Criteria::EQUAL);

		return $this;
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    EventPriceQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		if (empty($keys)) {
			return $this->add(null, '1<>1', Criteria::CUSTOM);
		}
		foreach ($keys as $key) {
			$cton0 = $this->getNewCriterion(EventPricePeer::EVENT_PRICE_TYPE_ID, $key[0], Criteria::EQUAL);
			$cton1 = $this->getNewCriterion(EventPricePeer::EVENT_ID, $key[1], Criteria::EQUAL);
			$cton0->addAnd($cton1);
			$this->addOr($cton0);
		}

		return $this;
	}

	/**
	 * Filter the query on the event_price_type_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEventPriceTypeId(1234); // WHERE event_price_type_id = 1234
	 * $query->filterByEventPriceTypeId(array(12, 34)); // WHERE event_price_type_id IN (12, 34)
	 * $query->filterByEventPriceTypeId(array('min' => 12)); // WHERE event_price_type_id > 12
	 * </code>
	 *
	 * @see       filterByEventPriceType()
	 *
	 * @param     mixed $eventPriceTypeId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventPriceQuery The current query, for fluid interface
	 */
	public function filterByEventPriceTypeId($eventPriceTypeId = null, $comparison = null)
	{
		if (is_array($eventPriceTypeId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(EventPricePeer::EVENT_PRICE_TYPE_ID, $eventPriceTypeId, $comparison);
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
	 * @return    EventPriceQuery The current query, for fluid interface
	 */
	public function filterByEventId($eventId = null, $comparison = null)
	{
		if (is_array($eventId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(EventPricePeer::EVENT_ID, $eventId, $comparison);
	}

	/**
	 * Filter the query by a related Event object
	 *
	 * @param     Event|PropelCollection $event The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventPriceQuery The current query, for fluid interface
	 */
	public function filterByEvent($event, $comparison = null)
	{
		if ($event instanceof Event) {
			return $this
				->addUsingAlias(EventPricePeer::EVENT_ID, $event->getEventId(), $comparison);
		} elseif ($event instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(EventPricePeer::EVENT_ID, $event->toKeyValue('PrimaryKey', 'EventId'), $comparison);
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
	 * @return    EventPriceQuery The current query, for fluid interface
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
	 * Filter the query by a related EventPriceType object
	 *
	 * @param     EventPriceType|PropelCollection $eventPriceType The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventPriceQuery The current query, for fluid interface
	 */
	public function filterByEventPriceType($eventPriceType, $comparison = null)
	{
		if ($eventPriceType instanceof EventPriceType) {
			return $this
				->addUsingAlias(EventPricePeer::EVENT_PRICE_TYPE_ID, $eventPriceType->getEventPriceTypeId(), $comparison);
		} elseif ($eventPriceType instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(EventPricePeer::EVENT_PRICE_TYPE_ID, $eventPriceType->toKeyValue('PrimaryKey', 'EventPriceTypeId'), $comparison);
		} else {
			throw new PropelException('filterByEventPriceType() only accepts arguments of type EventPriceType or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the EventPriceType relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    EventPriceQuery The current query, for fluid interface
	 */
	public function joinEventPriceType($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('EventPriceType');

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
			$this->addJoinObject($join, 'EventPriceType');
		}

		return $this;
	}

	/**
	 * Use the EventPriceType relation EventPriceType object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    \ORMModel\EventPriceTypeQuery A secondary query class using the current class as primary query
	 */
	public function useEventPriceTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinEventPriceType($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'EventPriceType', '\ORMModel\EventPriceTypeQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     EventPrice $eventPrice Object to remove from the list of results
	 *
	 * @return    EventPriceQuery The current query, for fluid interface
	 */
	public function prune($eventPrice = null)
	{
		if ($eventPrice) {
			$this->addCond('pruneCond0', $this->getAliasedColName(EventPricePeer::EVENT_PRICE_TYPE_ID), $eventPrice->getEventPriceTypeId(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond1', $this->getAliasedColName(EventPricePeer::EVENT_ID), $eventPrice->getEventId(), Criteria::NOT_EQUAL);
			$this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
		}

		return $this;
	}

} // BaseEventPriceQuery