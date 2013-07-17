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
use ORMModel\BannerLocation;
use ORMModel\BannerRequest;
use ORMModel\BannerRequestPeer;
use ORMModel\BannerRequestQuery;

/**
 * Base class that represents a query for the 'banner_request' table.
 *
 * 
 *
 * @method     BannerRequestQuery orderByBannerRequestId($order = Criteria::ASC) Order by the banner_request_id column
 * @method     BannerRequestQuery orderByArtRequestId($order = Criteria::ASC) Order by the art_request_id column
 * @method     BannerRequestQuery orderByBannerWidth($order = Criteria::ASC) Order by the banner_width column
 * @method     BannerRequestQuery orderByBannerLength($order = Criteria::ASC) Order by the banner_length column
 * @method     BannerRequestQuery orderByBannerLocationId($order = Criteria::ASC) Order by the banner_location_id column
 *
 * @method     BannerRequestQuery groupByBannerRequestId() Group by the banner_request_id column
 * @method     BannerRequestQuery groupByArtRequestId() Group by the art_request_id column
 * @method     BannerRequestQuery groupByBannerWidth() Group by the banner_width column
 * @method     BannerRequestQuery groupByBannerLength() Group by the banner_length column
 * @method     BannerRequestQuery groupByBannerLocationId() Group by the banner_location_id column
 *
 * @method     BannerRequestQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     BannerRequestQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     BannerRequestQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     BannerRequestQuery leftJoinBannerLocation($relationAlias = null) Adds a LEFT JOIN clause to the query using the BannerLocation relation
 * @method     BannerRequestQuery rightJoinBannerLocation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BannerLocation relation
 * @method     BannerRequestQuery innerJoinBannerLocation($relationAlias = null) Adds a INNER JOIN clause to the query using the BannerLocation relation
 *
 * @method     BannerRequestQuery leftJoinArtRequest($relationAlias = null) Adds a LEFT JOIN clause to the query using the ArtRequest relation
 * @method     BannerRequestQuery rightJoinArtRequest($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ArtRequest relation
 * @method     BannerRequestQuery innerJoinArtRequest($relationAlias = null) Adds a INNER JOIN clause to the query using the ArtRequest relation
 *
 * @method     BannerRequest findOne(PropelPDO $con = null) Return the first BannerRequest matching the query
 * @method     BannerRequest findOneOrCreate(PropelPDO $con = null) Return the first BannerRequest matching the query, or a new BannerRequest object populated from the query conditions when no match is found
 *
 * @method     BannerRequest findOneByBannerRequestId(int $banner_request_id) Return the first BannerRequest filtered by the banner_request_id column
 * @method     BannerRequest findOneByArtRequestId(int $art_request_id) Return the first BannerRequest filtered by the art_request_id column
 * @method     BannerRequest findOneByBannerWidth(int $banner_width) Return the first BannerRequest filtered by the banner_width column
 * @method     BannerRequest findOneByBannerLength(int $banner_length) Return the first BannerRequest filtered by the banner_length column
 * @method     BannerRequest findOneByBannerLocationId(int $banner_location_id) Return the first BannerRequest filtered by the banner_location_id column
 *
 * @method     array findByBannerRequestId(int $banner_request_id) Return BannerRequest objects filtered by the banner_request_id column
 * @method     array findByArtRequestId(int $art_request_id) Return BannerRequest objects filtered by the art_request_id column
 * @method     array findByBannerWidth(int $banner_width) Return BannerRequest objects filtered by the banner_width column
 * @method     array findByBannerLength(int $banner_length) Return BannerRequest objects filtered by the banner_length column
 * @method     array findByBannerLocationId(int $banner_location_id) Return BannerRequest objects filtered by the banner_location_id column
 *
 * @package    propel.generator.orm.om
 */
abstract class BaseBannerRequestQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseBannerRequestQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'orm', $modelName = 'ORMModel\\BannerRequest', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new BannerRequestQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    BannerRequestQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof BannerRequestQuery) {
			return $criteria;
		}
		$query = new BannerRequestQuery();
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
	 * @return    BannerRequest|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = BannerRequestPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(BannerRequestPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    BannerRequest A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `BANNER_REQUEST_ID`, `ART_REQUEST_ID`, `BANNER_WIDTH`, `BANNER_LENGTH`, `BANNER_LOCATION_ID` FROM `banner_request` WHERE `BANNER_REQUEST_ID` = :p0';
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
			$obj = new BannerRequest();
			$obj->hydrate($row);
			BannerRequestPeer::addInstanceToPool($obj, (string) $key);
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
	 * @return    BannerRequest|array|mixed the result, formatted by the current formatter
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
	 * @return    BannerRequestQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(BannerRequestPeer::BANNER_REQUEST_ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    BannerRequestQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(BannerRequestPeer::BANNER_REQUEST_ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the banner_request_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByBannerRequestId(1234); // WHERE banner_request_id = 1234
	 * $query->filterByBannerRequestId(array(12, 34)); // WHERE banner_request_id IN (12, 34)
	 * $query->filterByBannerRequestId(array('min' => 12)); // WHERE banner_request_id > 12
	 * </code>
	 *
	 * @param     mixed $bannerRequestId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BannerRequestQuery The current query, for fluid interface
	 */
	public function filterByBannerRequestId($bannerRequestId = null, $comparison = null)
	{
		if (is_array($bannerRequestId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(BannerRequestPeer::BANNER_REQUEST_ID, $bannerRequestId, $comparison);
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
	 * @see       filterByArtRequest()
	 *
	 * @param     mixed $artRequestId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BannerRequestQuery The current query, for fluid interface
	 */
	public function filterByArtRequestId($artRequestId = null, $comparison = null)
	{
		if (is_array($artRequestId)) {
			$useMinMax = false;
			if (isset($artRequestId['min'])) {
				$this->addUsingAlias(BannerRequestPeer::ART_REQUEST_ID, $artRequestId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($artRequestId['max'])) {
				$this->addUsingAlias(BannerRequestPeer::ART_REQUEST_ID, $artRequestId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(BannerRequestPeer::ART_REQUEST_ID, $artRequestId, $comparison);
	}

	/**
	 * Filter the query on the banner_width column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByBannerWidth(1234); // WHERE banner_width = 1234
	 * $query->filterByBannerWidth(array(12, 34)); // WHERE banner_width IN (12, 34)
	 * $query->filterByBannerWidth(array('min' => 12)); // WHERE banner_width > 12
	 * </code>
	 *
	 * @param     mixed $bannerWidth The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BannerRequestQuery The current query, for fluid interface
	 */
	public function filterByBannerWidth($bannerWidth = null, $comparison = null)
	{
		if (is_array($bannerWidth)) {
			$useMinMax = false;
			if (isset($bannerWidth['min'])) {
				$this->addUsingAlias(BannerRequestPeer::BANNER_WIDTH, $bannerWidth['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($bannerWidth['max'])) {
				$this->addUsingAlias(BannerRequestPeer::BANNER_WIDTH, $bannerWidth['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(BannerRequestPeer::BANNER_WIDTH, $bannerWidth, $comparison);
	}

	/**
	 * Filter the query on the banner_length column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByBannerLength(1234); // WHERE banner_length = 1234
	 * $query->filterByBannerLength(array(12, 34)); // WHERE banner_length IN (12, 34)
	 * $query->filterByBannerLength(array('min' => 12)); // WHERE banner_length > 12
	 * </code>
	 *
	 * @param     mixed $bannerLength The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BannerRequestQuery The current query, for fluid interface
	 */
	public function filterByBannerLength($bannerLength = null, $comparison = null)
	{
		if (is_array($bannerLength)) {
			$useMinMax = false;
			if (isset($bannerLength['min'])) {
				$this->addUsingAlias(BannerRequestPeer::BANNER_LENGTH, $bannerLength['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($bannerLength['max'])) {
				$this->addUsingAlias(BannerRequestPeer::BANNER_LENGTH, $bannerLength['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(BannerRequestPeer::BANNER_LENGTH, $bannerLength, $comparison);
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
	 * @see       filterByBannerLocation()
	 *
	 * @param     mixed $bannerLocationId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BannerRequestQuery The current query, for fluid interface
	 */
	public function filterByBannerLocationId($bannerLocationId = null, $comparison = null)
	{
		if (is_array($bannerLocationId)) {
			$useMinMax = false;
			if (isset($bannerLocationId['min'])) {
				$this->addUsingAlias(BannerRequestPeer::BANNER_LOCATION_ID, $bannerLocationId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($bannerLocationId['max'])) {
				$this->addUsingAlias(BannerRequestPeer::BANNER_LOCATION_ID, $bannerLocationId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(BannerRequestPeer::BANNER_LOCATION_ID, $bannerLocationId, $comparison);
	}

	/**
	 * Filter the query by a related BannerLocation object
	 *
	 * @param     BannerLocation|PropelCollection $bannerLocation The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BannerRequestQuery The current query, for fluid interface
	 */
	public function filterByBannerLocation($bannerLocation, $comparison = null)
	{
		if ($bannerLocation instanceof BannerLocation) {
			return $this
				->addUsingAlias(BannerRequestPeer::BANNER_LOCATION_ID, $bannerLocation->getBannerLocationId(), $comparison);
		} elseif ($bannerLocation instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(BannerRequestPeer::BANNER_LOCATION_ID, $bannerLocation->toKeyValue('PrimaryKey', 'BannerLocationId'), $comparison);
		} else {
			throw new PropelException('filterByBannerLocation() only accepts arguments of type BannerLocation or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the BannerLocation relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    BannerRequestQuery The current query, for fluid interface
	 */
	public function joinBannerLocation($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('BannerLocation');

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
			$this->addJoinObject($join, 'BannerLocation');
		}

		return $this;
	}

	/**
	 * Use the BannerLocation relation BannerLocation object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    \ORMModel\BannerLocationQuery A secondary query class using the current class as primary query
	 */
	public function useBannerLocationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinBannerLocation($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'BannerLocation', '\ORMModel\BannerLocationQuery');
	}

	/**
	 * Filter the query by a related ArtRequest object
	 *
	 * @param     ArtRequest|PropelCollection $artRequest The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BannerRequestQuery The current query, for fluid interface
	 */
	public function filterByArtRequest($artRequest, $comparison = null)
	{
		if ($artRequest instanceof ArtRequest) {
			return $this
				->addUsingAlias(BannerRequestPeer::ART_REQUEST_ID, $artRequest->getArtRequestId(), $comparison);
		} elseif ($artRequest instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(BannerRequestPeer::ART_REQUEST_ID, $artRequest->toKeyValue('PrimaryKey', 'ArtRequestId'), $comparison);
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
	 * @return    BannerRequestQuery The current query, for fluid interface
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
	 * Exclude object from result
	 *
	 * @param     BannerRequest $bannerRequest Object to remove from the list of results
	 *
	 * @return    BannerRequestQuery The current query, for fluid interface
	 */
	public function prune($bannerRequest = null)
	{
		if ($bannerRequest) {
			$this->addUsingAlias(BannerRequestPeer::BANNER_REQUEST_ID, $bannerRequest->getBannerRequestId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseBannerRequestQuery