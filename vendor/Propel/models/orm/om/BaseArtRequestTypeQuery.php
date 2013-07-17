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
use ORMModel\ArtRequestType;
use ORMModel\ArtRequestTypePeer;
use ORMModel\ArtRequestTypeQuery;

/**
 * Base class that represents a query for the 'art_request_type' table.
 *
 * 
 *
 * @method     ArtRequestTypeQuery orderByArtRequestTypeId($order = Criteria::ASC) Order by the art_request_type_id column
 * @method     ArtRequestTypeQuery orderByArtRequestTypeName($order = Criteria::ASC) Order by the art_request_type_name column
 *
 * @method     ArtRequestTypeQuery groupByArtRequestTypeId() Group by the art_request_type_id column
 * @method     ArtRequestTypeQuery groupByArtRequestTypeName() Group by the art_request_type_name column
 *
 * @method     ArtRequestTypeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ArtRequestTypeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ArtRequestTypeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ArtRequestTypeQuery leftJoinArtRequest($relationAlias = null) Adds a LEFT JOIN clause to the query using the ArtRequest relation
 * @method     ArtRequestTypeQuery rightJoinArtRequest($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ArtRequest relation
 * @method     ArtRequestTypeQuery innerJoinArtRequest($relationAlias = null) Adds a INNER JOIN clause to the query using the ArtRequest relation
 *
 * @method     ArtRequestType findOne(PropelPDO $con = null) Return the first ArtRequestType matching the query
 * @method     ArtRequestType findOneOrCreate(PropelPDO $con = null) Return the first ArtRequestType matching the query, or a new ArtRequestType object populated from the query conditions when no match is found
 *
 * @method     ArtRequestType findOneByArtRequestTypeId(int $art_request_type_id) Return the first ArtRequestType filtered by the art_request_type_id column
 * @method     ArtRequestType findOneByArtRequestTypeName(string $art_request_type_name) Return the first ArtRequestType filtered by the art_request_type_name column
 *
 * @method     array findByArtRequestTypeId(int $art_request_type_id) Return ArtRequestType objects filtered by the art_request_type_id column
 * @method     array findByArtRequestTypeName(string $art_request_type_name) Return ArtRequestType objects filtered by the art_request_type_name column
 *
 * @package    propel.generator.orm.om
 */
abstract class BaseArtRequestTypeQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseArtRequestTypeQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'orm', $modelName = 'ORMModel\\ArtRequestType', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new ArtRequestTypeQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    ArtRequestTypeQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof ArtRequestTypeQuery) {
			return $criteria;
		}
		$query = new ArtRequestTypeQuery();
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
	 * @return    ArtRequestType|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = ArtRequestTypePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(ArtRequestTypePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    ArtRequestType A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ART_REQUEST_TYPE_ID`, `ART_REQUEST_TYPE_NAME` FROM `art_request_type` WHERE `ART_REQUEST_TYPE_ID` = :p0';
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
			$obj = new ArtRequestType();
			$obj->hydrate($row);
			ArtRequestTypePeer::addInstanceToPool($obj, (string) $key);
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
	 * @return    ArtRequestType|array|mixed the result, formatted by the current formatter
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
	 * @return    ArtRequestTypeQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(ArtRequestTypePeer::ART_REQUEST_TYPE_ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    ArtRequestTypeQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(ArtRequestTypePeer::ART_REQUEST_TYPE_ID, $keys, Criteria::IN);
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
	 * @param     mixed $artRequestTypeId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestTypeQuery The current query, for fluid interface
	 */
	public function filterByArtRequestTypeId($artRequestTypeId = null, $comparison = null)
	{
		if (is_array($artRequestTypeId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(ArtRequestTypePeer::ART_REQUEST_TYPE_ID, $artRequestTypeId, $comparison);
	}

	/**
	 * Filter the query on the art_request_type_name column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByArtRequestTypeName('fooValue');   // WHERE art_request_type_name = 'fooValue'
	 * $query->filterByArtRequestTypeName('%fooValue%'); // WHERE art_request_type_name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $artRequestTypeName The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestTypeQuery The current query, for fluid interface
	 */
	public function filterByArtRequestTypeName($artRequestTypeName = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($artRequestTypeName)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $artRequestTypeName)) {
				$artRequestTypeName = str_replace('*', '%', $artRequestTypeName);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ArtRequestTypePeer::ART_REQUEST_TYPE_NAME, $artRequestTypeName, $comparison);
	}

	/**
	 * Filter the query by a related ArtRequest object
	 *
	 * @param     ArtRequest $artRequest  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestTypeQuery The current query, for fluid interface
	 */
	public function filterByArtRequest($artRequest, $comparison = null)
	{
		if ($artRequest instanceof ArtRequest) {
			return $this
				->addUsingAlias(ArtRequestTypePeer::ART_REQUEST_TYPE_ID, $artRequest->getArtRequestTypeId(), $comparison);
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
	 * @return    ArtRequestTypeQuery The current query, for fluid interface
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
	 * @param     ArtRequestType $artRequestType Object to remove from the list of results
	 *
	 * @return    ArtRequestTypeQuery The current query, for fluid interface
	 */
	public function prune($artRequestType = null)
	{
		if ($artRequestType) {
			$this->addUsingAlias(ArtRequestTypePeer::ART_REQUEST_TYPE_ID, $artRequestType->getArtRequestTypeId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseArtRequestTypeQuery