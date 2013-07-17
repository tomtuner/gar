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
use ORMModel\EventPrice;
use ORMModel\EventPriceType;
use ORMModel\EventPriceTypePeer;
use ORMModel\EventPriceTypeQuery;

/**
 * Base class that represents a query for the 'event_price_type' table.
 *
 * 
 *
 * @method     EventPriceTypeQuery orderByEventPriceTypeId($order = Criteria::ASC) Order by the event_price_type_id column
 * @method     EventPriceTypeQuery orderByEventPriceTypeName($order = Criteria::ASC) Order by the event_price_type_name column
 *
 * @method     EventPriceTypeQuery groupByEventPriceTypeId() Group by the event_price_type_id column
 * @method     EventPriceTypeQuery groupByEventPriceTypeName() Group by the event_price_type_name column
 *
 * @method     EventPriceTypeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     EventPriceTypeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     EventPriceTypeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     EventPriceTypeQuery leftJoinEventPrice($relationAlias = null) Adds a LEFT JOIN clause to the query using the EventPrice relation
 * @method     EventPriceTypeQuery rightJoinEventPrice($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EventPrice relation
 * @method     EventPriceTypeQuery innerJoinEventPrice($relationAlias = null) Adds a INNER JOIN clause to the query using the EventPrice relation
 *
 * @method     EventPriceType findOne(PropelPDO $con = null) Return the first EventPriceType matching the query
 * @method     EventPriceType findOneOrCreate(PropelPDO $con = null) Return the first EventPriceType matching the query, or a new EventPriceType object populated from the query conditions when no match is found
 *
 * @method     EventPriceType findOneByEventPriceTypeId(int $event_price_type_id) Return the first EventPriceType filtered by the event_price_type_id column
 * @method     EventPriceType findOneByEventPriceTypeName(string $event_price_type_name) Return the first EventPriceType filtered by the event_price_type_name column
 *
 * @method     array findByEventPriceTypeId(int $event_price_type_id) Return EventPriceType objects filtered by the event_price_type_id column
 * @method     array findByEventPriceTypeName(string $event_price_type_name) Return EventPriceType objects filtered by the event_price_type_name column
 *
 * @package    propel.generator.orm.om
 */
abstract class BaseEventPriceTypeQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseEventPriceTypeQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'orm', $modelName = 'ORMModel\\EventPriceType', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new EventPriceTypeQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    EventPriceTypeQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof EventPriceTypeQuery) {
			return $criteria;
		}
		$query = new EventPriceTypeQuery();
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
	 * @return    EventPriceType|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = EventPriceTypePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(EventPriceTypePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    EventPriceType A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `EVENT_PRICE_TYPE_ID`, `EVENT_PRICE_TYPE_NAME` FROM `event_price_type` WHERE `EVENT_PRICE_TYPE_ID` = :p0';
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
			$obj = new EventPriceType();
			$obj->hydrate($row);
			EventPriceTypePeer::addInstanceToPool($obj, (string) $key);
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
	 * @return    EventPriceType|array|mixed the result, formatted by the current formatter
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
	 * @return    EventPriceTypeQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(EventPriceTypePeer::EVENT_PRICE_TYPE_ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    EventPriceTypeQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(EventPriceTypePeer::EVENT_PRICE_TYPE_ID, $keys, Criteria::IN);
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
	 * @param     mixed $eventPriceTypeId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventPriceTypeQuery The current query, for fluid interface
	 */
	public function filterByEventPriceTypeId($eventPriceTypeId = null, $comparison = null)
	{
		if (is_array($eventPriceTypeId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(EventPriceTypePeer::EVENT_PRICE_TYPE_ID, $eventPriceTypeId, $comparison);
	}

	/**
	 * Filter the query on the event_price_type_name column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEventPriceTypeName('fooValue');   // WHERE event_price_type_name = 'fooValue'
	 * $query->filterByEventPriceTypeName('%fooValue%'); // WHERE event_price_type_name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $eventPriceTypeName The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventPriceTypeQuery The current query, for fluid interface
	 */
	public function filterByEventPriceTypeName($eventPriceTypeName = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($eventPriceTypeName)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $eventPriceTypeName)) {
				$eventPriceTypeName = str_replace('*', '%', $eventPriceTypeName);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(EventPriceTypePeer::EVENT_PRICE_TYPE_NAME, $eventPriceTypeName, $comparison);
	}

	/**
	 * Filter the query by a related EventPrice object
	 *
	 * @param     EventPrice $eventPrice  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventPriceTypeQuery The current query, for fluid interface
	 */
	public function filterByEventPrice($eventPrice, $comparison = null)
	{
		if ($eventPrice instanceof EventPrice) {
			return $this
				->addUsingAlias(EventPriceTypePeer::EVENT_PRICE_TYPE_ID, $eventPrice->getEventPriceTypeId(), $comparison);
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
	 * @return    EventPriceTypeQuery The current query, for fluid interface
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
	 * @param     EventPriceType $eventPriceType Object to remove from the list of results
	 *
	 * @return    EventPriceTypeQuery The current query, for fluid interface
	 */
	public function prune($eventPriceType = null)
	{
		if ($eventPriceType) {
			$this->addUsingAlias(EventPriceTypePeer::EVENT_PRICE_TYPE_ID, $eventPriceType->getEventPriceTypeId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseEventPriceTypeQuery