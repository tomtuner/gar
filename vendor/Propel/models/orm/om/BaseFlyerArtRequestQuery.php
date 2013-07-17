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
use ORMModel\FlyerArtRequest;
use ORMModel\FlyerArtRequestPeer;
use ORMModel\FlyerArtRequestQuery;
use ORMModel\FlyerFormat;
use ORMModel\FlyerSize;

/**
 * Base class that represents a query for the 'flyer_art_request' table.
 *
 * 
 *
 * @method     FlyerArtRequestQuery orderByFlyerArtRequestId($order = Criteria::ASC) Order by the flyer_art_request_id column
 * @method     FlyerArtRequestQuery orderByFlyerSizeId($order = Criteria::ASC) Order by the flyer_size_id column
 * @method     FlyerArtRequestQuery orderByFlyerFormatId($order = Criteria::ASC) Order by the flyer_format_id column
 * @method     FlyerArtRequestQuery orderByArtRequestId($order = Criteria::ASC) Order by the art_request_id column
 *
 * @method     FlyerArtRequestQuery groupByFlyerArtRequestId() Group by the flyer_art_request_id column
 * @method     FlyerArtRequestQuery groupByFlyerSizeId() Group by the flyer_size_id column
 * @method     FlyerArtRequestQuery groupByFlyerFormatId() Group by the flyer_format_id column
 * @method     FlyerArtRequestQuery groupByArtRequestId() Group by the art_request_id column
 *
 * @method     FlyerArtRequestQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     FlyerArtRequestQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     FlyerArtRequestQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     FlyerArtRequestQuery leftJoinFlyerSize($relationAlias = null) Adds a LEFT JOIN clause to the query using the FlyerSize relation
 * @method     FlyerArtRequestQuery rightJoinFlyerSize($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FlyerSize relation
 * @method     FlyerArtRequestQuery innerJoinFlyerSize($relationAlias = null) Adds a INNER JOIN clause to the query using the FlyerSize relation
 *
 * @method     FlyerArtRequestQuery leftJoinArtRequest($relationAlias = null) Adds a LEFT JOIN clause to the query using the ArtRequest relation
 * @method     FlyerArtRequestQuery rightJoinArtRequest($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ArtRequest relation
 * @method     FlyerArtRequestQuery innerJoinArtRequest($relationAlias = null) Adds a INNER JOIN clause to the query using the ArtRequest relation
 *
 * @method     FlyerArtRequestQuery leftJoinFlyerFormat($relationAlias = null) Adds a LEFT JOIN clause to the query using the FlyerFormat relation
 * @method     FlyerArtRequestQuery rightJoinFlyerFormat($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FlyerFormat relation
 * @method     FlyerArtRequestQuery innerJoinFlyerFormat($relationAlias = null) Adds a INNER JOIN clause to the query using the FlyerFormat relation
 *
 * @method     FlyerArtRequest findOne(PropelPDO $con = null) Return the first FlyerArtRequest matching the query
 * @method     FlyerArtRequest findOneOrCreate(PropelPDO $con = null) Return the first FlyerArtRequest matching the query, or a new FlyerArtRequest object populated from the query conditions when no match is found
 *
 * @method     FlyerArtRequest findOneByFlyerArtRequestId(int $flyer_art_request_id) Return the first FlyerArtRequest filtered by the flyer_art_request_id column
 * @method     FlyerArtRequest findOneByFlyerSizeId(int $flyer_size_id) Return the first FlyerArtRequest filtered by the flyer_size_id column
 * @method     FlyerArtRequest findOneByFlyerFormatId(int $flyer_format_id) Return the first FlyerArtRequest filtered by the flyer_format_id column
 * @method     FlyerArtRequest findOneByArtRequestId(int $art_request_id) Return the first FlyerArtRequest filtered by the art_request_id column
 *
 * @method     array findByFlyerArtRequestId(int $flyer_art_request_id) Return FlyerArtRequest objects filtered by the flyer_art_request_id column
 * @method     array findByFlyerSizeId(int $flyer_size_id) Return FlyerArtRequest objects filtered by the flyer_size_id column
 * @method     array findByFlyerFormatId(int $flyer_format_id) Return FlyerArtRequest objects filtered by the flyer_format_id column
 * @method     array findByArtRequestId(int $art_request_id) Return FlyerArtRequest objects filtered by the art_request_id column
 *
 * @package    propel.generator.orm.om
 */
abstract class BaseFlyerArtRequestQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseFlyerArtRequestQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'orm', $modelName = 'ORMModel\\FlyerArtRequest', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new FlyerArtRequestQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    FlyerArtRequestQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof FlyerArtRequestQuery) {
			return $criteria;
		}
		$query = new FlyerArtRequestQuery();
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
	 * @return    FlyerArtRequest|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = FlyerArtRequestPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(FlyerArtRequestPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    FlyerArtRequest A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `FLYER_ART_REQUEST_ID`, `FLYER_SIZE_ID`, `FLYER_FORMAT_ID`, `ART_REQUEST_ID` FROM `flyer_art_request` WHERE `FLYER_ART_REQUEST_ID` = :p0';
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
			$obj = new FlyerArtRequest();
			$obj->hydrate($row);
			FlyerArtRequestPeer::addInstanceToPool($obj, (string) $key);
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
	 * @return    FlyerArtRequest|array|mixed the result, formatted by the current formatter
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
	 * @return    FlyerArtRequestQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(FlyerArtRequestPeer::FLYER_ART_REQUEST_ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    FlyerArtRequestQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(FlyerArtRequestPeer::FLYER_ART_REQUEST_ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the flyer_art_request_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByFlyerArtRequestId(1234); // WHERE flyer_art_request_id = 1234
	 * $query->filterByFlyerArtRequestId(array(12, 34)); // WHERE flyer_art_request_id IN (12, 34)
	 * $query->filterByFlyerArtRequestId(array('min' => 12)); // WHERE flyer_art_request_id > 12
	 * </code>
	 *
	 * @param     mixed $flyerArtRequestId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FlyerArtRequestQuery The current query, for fluid interface
	 */
	public function filterByFlyerArtRequestId($flyerArtRequestId = null, $comparison = null)
	{
		if (is_array($flyerArtRequestId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(FlyerArtRequestPeer::FLYER_ART_REQUEST_ID, $flyerArtRequestId, $comparison);
	}

	/**
	 * Filter the query on the flyer_size_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByFlyerSizeId(1234); // WHERE flyer_size_id = 1234
	 * $query->filterByFlyerSizeId(array(12, 34)); // WHERE flyer_size_id IN (12, 34)
	 * $query->filterByFlyerSizeId(array('min' => 12)); // WHERE flyer_size_id > 12
	 * </code>
	 *
	 * @see       filterByFlyerSize()
	 *
	 * @param     mixed $flyerSizeId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FlyerArtRequestQuery The current query, for fluid interface
	 */
	public function filterByFlyerSizeId($flyerSizeId = null, $comparison = null)
	{
		if (is_array($flyerSizeId)) {
			$useMinMax = false;
			if (isset($flyerSizeId['min'])) {
				$this->addUsingAlias(FlyerArtRequestPeer::FLYER_SIZE_ID, $flyerSizeId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($flyerSizeId['max'])) {
				$this->addUsingAlias(FlyerArtRequestPeer::FLYER_SIZE_ID, $flyerSizeId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(FlyerArtRequestPeer::FLYER_SIZE_ID, $flyerSizeId, $comparison);
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
	 * @see       filterByFlyerFormat()
	 *
	 * @param     mixed $flyerFormatId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FlyerArtRequestQuery The current query, for fluid interface
	 */
	public function filterByFlyerFormatId($flyerFormatId = null, $comparison = null)
	{
		if (is_array($flyerFormatId)) {
			$useMinMax = false;
			if (isset($flyerFormatId['min'])) {
				$this->addUsingAlias(FlyerArtRequestPeer::FLYER_FORMAT_ID, $flyerFormatId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($flyerFormatId['max'])) {
				$this->addUsingAlias(FlyerArtRequestPeer::FLYER_FORMAT_ID, $flyerFormatId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(FlyerArtRequestPeer::FLYER_FORMAT_ID, $flyerFormatId, $comparison);
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
	 * @return    FlyerArtRequestQuery The current query, for fluid interface
	 */
	public function filterByArtRequestId($artRequestId = null, $comparison = null)
	{
		if (is_array($artRequestId)) {
			$useMinMax = false;
			if (isset($artRequestId['min'])) {
				$this->addUsingAlias(FlyerArtRequestPeer::ART_REQUEST_ID, $artRequestId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($artRequestId['max'])) {
				$this->addUsingAlias(FlyerArtRequestPeer::ART_REQUEST_ID, $artRequestId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(FlyerArtRequestPeer::ART_REQUEST_ID, $artRequestId, $comparison);
	}

	/**
	 * Filter the query by a related FlyerSize object
	 *
	 * @param     FlyerSize|PropelCollection $flyerSize The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FlyerArtRequestQuery The current query, for fluid interface
	 */
	public function filterByFlyerSize($flyerSize, $comparison = null)
	{
		if ($flyerSize instanceof FlyerSize) {
			return $this
				->addUsingAlias(FlyerArtRequestPeer::FLYER_SIZE_ID, $flyerSize->getFlyerSizeId(), $comparison);
		} elseif ($flyerSize instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(FlyerArtRequestPeer::FLYER_SIZE_ID, $flyerSize->toKeyValue('PrimaryKey', 'FlyerSizeId'), $comparison);
		} else {
			throw new PropelException('filterByFlyerSize() only accepts arguments of type FlyerSize or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the FlyerSize relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    FlyerArtRequestQuery The current query, for fluid interface
	 */
	public function joinFlyerSize($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('FlyerSize');

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
			$this->addJoinObject($join, 'FlyerSize');
		}

		return $this;
	}

	/**
	 * Use the FlyerSize relation FlyerSize object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    \ORMModel\FlyerSizeQuery A secondary query class using the current class as primary query
	 */
	public function useFlyerSizeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinFlyerSize($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'FlyerSize', '\ORMModel\FlyerSizeQuery');
	}

	/**
	 * Filter the query by a related ArtRequest object
	 *
	 * @param     ArtRequest|PropelCollection $artRequest The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FlyerArtRequestQuery The current query, for fluid interface
	 */
	public function filterByArtRequest($artRequest, $comparison = null)
	{
		if ($artRequest instanceof ArtRequest) {
			return $this
				->addUsingAlias(FlyerArtRequestPeer::ART_REQUEST_ID, $artRequest->getArtRequestId(), $comparison);
		} elseif ($artRequest instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(FlyerArtRequestPeer::ART_REQUEST_ID, $artRequest->toKeyValue('PrimaryKey', 'ArtRequestId'), $comparison);
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
	 * @return    FlyerArtRequestQuery The current query, for fluid interface
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
	 * Filter the query by a related FlyerFormat object
	 *
	 * @param     FlyerFormat|PropelCollection $flyerFormat The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FlyerArtRequestQuery The current query, for fluid interface
	 */
	public function filterByFlyerFormat($flyerFormat, $comparison = null)
	{
		if ($flyerFormat instanceof FlyerFormat) {
			return $this
				->addUsingAlias(FlyerArtRequestPeer::FLYER_FORMAT_ID, $flyerFormat->getFlyerFormatId(), $comparison);
		} elseif ($flyerFormat instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(FlyerArtRequestPeer::FLYER_FORMAT_ID, $flyerFormat->toKeyValue('PrimaryKey', 'FlyerFormatId'), $comparison);
		} else {
			throw new PropelException('filterByFlyerFormat() only accepts arguments of type FlyerFormat or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the FlyerFormat relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    FlyerArtRequestQuery The current query, for fluid interface
	 */
	public function joinFlyerFormat($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('FlyerFormat');

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
			$this->addJoinObject($join, 'FlyerFormat');
		}

		return $this;
	}

	/**
	 * Use the FlyerFormat relation FlyerFormat object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    \ORMModel\FlyerFormatQuery A secondary query class using the current class as primary query
	 */
	public function useFlyerFormatQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinFlyerFormat($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'FlyerFormat', '\ORMModel\FlyerFormatQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     FlyerArtRequest $flyerArtRequest Object to remove from the list of results
	 *
	 * @return    FlyerArtRequestQuery The current query, for fluid interface
	 */
	public function prune($flyerArtRequest = null)
	{
		if ($flyerArtRequest) {
			$this->addUsingAlias(FlyerArtRequestPeer::FLYER_ART_REQUEST_ID, $flyerArtRequest->getFlyerArtRequestId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseFlyerArtRequestQuery