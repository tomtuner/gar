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
use ORMModel\BannerLocation;
use ORMModel\BannerLocationPeer;
use ORMModel\BannerLocationQuery;
use ORMModel\BannerRequest;

/**
 * Base class that represents a query for the 'banner_location' table.
 *
 * 
 *
 * @method     BannerLocationQuery orderByBannerLocationId($order = Criteria::ASC) Order by the banner_location_id column
 * @method     BannerLocationQuery orderByBannerLocationName($order = Criteria::ASC) Order by the banner_location_name column
 *
 * @method     BannerLocationQuery groupByBannerLocationId() Group by the banner_location_id column
 * @method     BannerLocationQuery groupByBannerLocationName() Group by the banner_location_name column
 *
 * @method     BannerLocationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     BannerLocationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     BannerLocationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     BannerLocationQuery leftJoinBannerRequest($relationAlias = null) Adds a LEFT JOIN clause to the query using the BannerRequest relation
 * @method     BannerLocationQuery rightJoinBannerRequest($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BannerRequest relation
 * @method     BannerLocationQuery innerJoinBannerRequest($relationAlias = null) Adds a INNER JOIN clause to the query using the BannerRequest relation
 *
 * @method     BannerLocation findOne(PropelPDO $con = null) Return the first BannerLocation matching the query
 * @method     BannerLocation findOneOrCreate(PropelPDO $con = null) Return the first BannerLocation matching the query, or a new BannerLocation object populated from the query conditions when no match is found
 *
 * @method     BannerLocation findOneByBannerLocationId(int $banner_location_id) Return the first BannerLocation filtered by the banner_location_id column
 * @method     BannerLocation findOneByBannerLocationName(string $banner_location_name) Return the first BannerLocation filtered by the banner_location_name column
 *
 * @method     array findByBannerLocationId(int $banner_location_id) Return BannerLocation objects filtered by the banner_location_id column
 * @method     array findByBannerLocationName(string $banner_location_name) Return BannerLocation objects filtered by the banner_location_name column
 *
 * @package    propel.generator.orm.om
 */
abstract class BaseBannerLocationQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseBannerLocationQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'orm', $modelName = 'ORMModel\\BannerLocation', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new BannerLocationQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    BannerLocationQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof BannerLocationQuery) {
			return $criteria;
		}
		$query = new BannerLocationQuery();
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
	 * @return    BannerLocation|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = BannerLocationPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(BannerLocationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    BannerLocation A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `BANNER_LOCATION_ID`, `BANNER_LOCATION_NAME` FROM `banner_location` WHERE `BANNER_LOCATION_ID` = :p0';
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
			$obj = new BannerLocation();
			$obj->hydrate($row);
			BannerLocationPeer::addInstanceToPool($obj, (string) $key);
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
	 * @return    BannerLocation|array|mixed the result, formatted by the current formatter
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
	 * @return    BannerLocationQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(BannerLocationPeer::BANNER_LOCATION_ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    BannerLocationQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(BannerLocationPeer::BANNER_LOCATION_ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the banner_location_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByBannerLocationId(1234); // WHERE banner_location_id = 1234
	 * $query->filterByBannerLocationId(array(12, 34)); // WHERE banner_location_id IN (12, 34)
	 * $query->filterByBannerLocationId(array('min' => 12)); // WHERE banner_location_id > 12
	 * </code>
	 *
	 * @param     mixed $bannerLocationId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BannerLocationQuery The current query, for fluid interface
	 */
	public function filterByBannerLocationId($bannerLocationId = null, $comparison = null)
	{
		if (is_array($bannerLocationId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(BannerLocationPeer::BANNER_LOCATION_ID, $bannerLocationId, $comparison);
	}

	/**
	 * Filter the query on the banner_location_name column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByBannerLocationName('fooValue');   // WHERE banner_location_name = 'fooValue'
	 * $query->filterByBannerLocationName('%fooValue%'); // WHERE banner_location_name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $bannerLocationName The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BannerLocationQuery The current query, for fluid interface
	 */
	public function filterByBannerLocationName($bannerLocationName = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($bannerLocationName)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $bannerLocationName)) {
				$bannerLocationName = str_replace('*', '%', $bannerLocationName);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(BannerLocationPeer::BANNER_LOCATION_NAME, $bannerLocationName, $comparison);
	}

	/**
	 * Filter the query by a related BannerRequest object
	 *
	 * @param     BannerRequest $bannerRequest  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BannerLocationQuery The current query, for fluid interface
	 */
	public function filterByBannerRequest($bannerRequest, $comparison = null)
	{
		if ($bannerRequest instanceof BannerRequest) {
			return $this
				->addUsingAlias(BannerLocationPeer::BANNER_LOCATION_ID, $bannerRequest->getBannerLocationId(), $comparison);
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
	 * @return    BannerLocationQuery The current query, for fluid interface
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
	 * Exclude object from result
	 *
	 * @param     BannerLocation $bannerLocation Object to remove from the list of results
	 *
	 * @return    BannerLocationQuery The current query, for fluid interface
	 */
	public function prune($bannerLocation = null)
	{
		if ($bannerLocation) {
			$this->addUsingAlias(BannerLocationPeer::BANNER_LOCATION_ID, $bannerLocation->getBannerLocationId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseBannerLocationQuery