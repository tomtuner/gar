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
use ORMModel\FlyerArtRequest;
use ORMModel\FlyerFormat;
use ORMModel\FlyerFormatPeer;
use ORMModel\FlyerFormatQuery;

/**
 * Base class that represents a query for the 'flyer_format' table.
 *
 * 
 *
 * @method     FlyerFormatQuery orderByFlyerFormatId($order = Criteria::ASC) Order by the flyer_format_id column
 * @method     FlyerFormatQuery orderByFlyerFormatType($order = Criteria::ASC) Order by the flyer_format_type column
 *
 * @method     FlyerFormatQuery groupByFlyerFormatId() Group by the flyer_format_id column
 * @method     FlyerFormatQuery groupByFlyerFormatType() Group by the flyer_format_type column
 *
 * @method     FlyerFormatQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     FlyerFormatQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     FlyerFormatQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     FlyerFormatQuery leftJoinFlyerArtRequest($relationAlias = null) Adds a LEFT JOIN clause to the query using the FlyerArtRequest relation
 * @method     FlyerFormatQuery rightJoinFlyerArtRequest($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FlyerArtRequest relation
 * @method     FlyerFormatQuery innerJoinFlyerArtRequest($relationAlias = null) Adds a INNER JOIN clause to the query using the FlyerArtRequest relation
 *
 * @method     FlyerFormat findOne(PropelPDO $con = null) Return the first FlyerFormat matching the query
 * @method     FlyerFormat findOneOrCreate(PropelPDO $con = null) Return the first FlyerFormat matching the query, or a new FlyerFormat object populated from the query conditions when no match is found
 *
 * @method     FlyerFormat findOneByFlyerFormatId(int $flyer_format_id) Return the first FlyerFormat filtered by the flyer_format_id column
 * @method     FlyerFormat findOneByFlyerFormatType(string $flyer_format_type) Return the first FlyerFormat filtered by the flyer_format_type column
 *
 * @method     array findByFlyerFormatId(int $flyer_format_id) Return FlyerFormat objects filtered by the flyer_format_id column
 * @method     array findByFlyerFormatType(string $flyer_format_type) Return FlyerFormat objects filtered by the flyer_format_type column
 *
 * @package    propel.generator.orm.om
 */
abstract class BaseFlyerFormatQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseFlyerFormatQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'orm', $modelName = 'ORMModel\\FlyerFormat', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new FlyerFormatQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    FlyerFormatQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof FlyerFormatQuery) {
			return $criteria;
		}
		$query = new FlyerFormatQuery();
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
	 * @return    FlyerFormat|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = FlyerFormatPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(FlyerFormatPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    FlyerFormat A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `FLYER_FORMAT_ID`, `FLYER_FORMAT_TYPE` FROM `flyer_format` WHERE `FLYER_FORMAT_ID` = :p0';
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
			$obj = new FlyerFormat();
			$obj->hydrate($row);
			FlyerFormatPeer::addInstanceToPool($obj, (string) $key);
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
	 * @return    FlyerFormat|array|mixed the result, formatted by the current formatter
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
	 * @return    FlyerFormatQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(FlyerFormatPeer::FLYER_FORMAT_ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    FlyerFormatQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(FlyerFormatPeer::FLYER_FORMAT_ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the flyer_format_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByFlyerFormatId(1234); // WHERE flyer_format_id = 1234
	 * $query->filterByFlyerFormatId(array(12, 34)); // WHERE flyer_format_id IN (12, 34)
	 * $query->filterByFlyerFormatId(array('min' => 12)); // WHERE flyer_format_id > 12
	 * </code>
	 *
	 * @param     mixed $flyerFormatId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FlyerFormatQuery The current query, for fluid interface
	 */
	public function filterByFlyerFormatId($flyerFormatId = null, $comparison = null)
	{
		if (is_array($flyerFormatId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(FlyerFormatPeer::FLYER_FORMAT_ID, $flyerFormatId, $comparison);
	}

	/**
	 * Filter the query on the flyer_format_type column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByFlyerFormatType('fooValue');   // WHERE flyer_format_type = 'fooValue'
	 * $query->filterByFlyerFormatType('%fooValue%'); // WHERE flyer_format_type LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $flyerFormatType The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FlyerFormatQuery The current query, for fluid interface
	 */
	public function filterByFlyerFormatType($flyerFormatType = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($flyerFormatType)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $flyerFormatType)) {
				$flyerFormatType = str_replace('*', '%', $flyerFormatType);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(FlyerFormatPeer::FLYER_FORMAT_TYPE, $flyerFormatType, $comparison);
	}

	/**
	 * Filter the query by a related FlyerArtRequest object
	 *
	 * @param     FlyerArtRequest $flyerArtRequest  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FlyerFormatQuery The current query, for fluid interface
	 */
	public function filterByFlyerArtRequest($flyerArtRequest, $comparison = null)
	{
		if ($flyerArtRequest instanceof FlyerArtRequest) {
			return $this
				->addUsingAlias(FlyerFormatPeer::FLYER_FORMAT_ID, $flyerArtRequest->getFlyerFormatId(), $comparison);
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
	 * @return    FlyerFormatQuery The current query, for fluid interface
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
	 * Exclude object from result
	 *
	 * @param     FlyerFormat $flyerFormat Object to remove from the list of results
	 *
	 * @return    FlyerFormatQuery The current query, for fluid interface
	 */
	public function prune($flyerFormat = null)
	{
		if ($flyerFormat) {
			$this->addUsingAlias(FlyerFormatPeer::FLYER_FORMAT_ID, $flyerFormat->getFlyerFormatId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseFlyerFormatQuery