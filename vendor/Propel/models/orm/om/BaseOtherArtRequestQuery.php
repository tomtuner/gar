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
use ORMModel\OtherArtRequest;
use ORMModel\OtherArtRequestPeer;
use ORMModel\OtherArtRequestQuery;

/**
 * Base class that represents a query for the 'other_art_request' table.
 *
 * 
 *
 * @method     OtherArtRequestQuery orderByOtherArtRequestId($order = Criteria::ASC) Order by the other_art_request_id column
 * @method     OtherArtRequestQuery orderByDescriptionText($order = Criteria::ASC) Order by the description_text column
 * @method     OtherArtRequestQuery orderByArtRequestId($order = Criteria::ASC) Order by the art_request_id column
 *
 * @method     OtherArtRequestQuery groupByOtherArtRequestId() Group by the other_art_request_id column
 * @method     OtherArtRequestQuery groupByDescriptionText() Group by the description_text column
 * @method     OtherArtRequestQuery groupByArtRequestId() Group by the art_request_id column
 *
 * @method     OtherArtRequestQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     OtherArtRequestQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     OtherArtRequestQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     OtherArtRequestQuery leftJoinArtRequest($relationAlias = null) Adds a LEFT JOIN clause to the query using the ArtRequest relation
 * @method     OtherArtRequestQuery rightJoinArtRequest($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ArtRequest relation
 * @method     OtherArtRequestQuery innerJoinArtRequest($relationAlias = null) Adds a INNER JOIN clause to the query using the ArtRequest relation
 *
 * @method     OtherArtRequest findOne(PropelPDO $con = null) Return the first OtherArtRequest matching the query
 * @method     OtherArtRequest findOneOrCreate(PropelPDO $con = null) Return the first OtherArtRequest matching the query, or a new OtherArtRequest object populated from the query conditions when no match is found
 *
 * @method     OtherArtRequest findOneByOtherArtRequestId(int $other_art_request_id) Return the first OtherArtRequest filtered by the other_art_request_id column
 * @method     OtherArtRequest findOneByDescriptionText(resource $description_text) Return the first OtherArtRequest filtered by the description_text column
 * @method     OtherArtRequest findOneByArtRequestId(int $art_request_id) Return the first OtherArtRequest filtered by the art_request_id column
 *
 * @method     array findByOtherArtRequestId(int $other_art_request_id) Return OtherArtRequest objects filtered by the other_art_request_id column
 * @method     array findByDescriptionText(resource $description_text) Return OtherArtRequest objects filtered by the description_text column
 * @method     array findByArtRequestId(int $art_request_id) Return OtherArtRequest objects filtered by the art_request_id column
 *
 * @package    propel.generator.orm.om
 */
abstract class BaseOtherArtRequestQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseOtherArtRequestQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'orm', $modelName = 'ORMModel\\OtherArtRequest', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new OtherArtRequestQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    OtherArtRequestQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof OtherArtRequestQuery) {
			return $criteria;
		}
		$query = new OtherArtRequestQuery();
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
	 * @return    OtherArtRequest|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = OtherArtRequestPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(OtherArtRequestPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    OtherArtRequest A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `OTHER_ART_REQUEST_ID`, `DESCRIPTION_TEXT`, `ART_REQUEST_ID` FROM `other_art_request` WHERE `OTHER_ART_REQUEST_ID` = :p0';
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
			$obj = new OtherArtRequest();
			$obj->hydrate($row);
			OtherArtRequestPeer::addInstanceToPool($obj, (string) $key);
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
	 * @return    OtherArtRequest|array|mixed the result, formatted by the current formatter
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
	 * @return    OtherArtRequestQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(OtherArtRequestPeer::OTHER_ART_REQUEST_ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    OtherArtRequestQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(OtherArtRequestPeer::OTHER_ART_REQUEST_ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the other_art_request_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByOtherArtRequestId(1234); // WHERE other_art_request_id = 1234
	 * $query->filterByOtherArtRequestId(array(12, 34)); // WHERE other_art_request_id IN (12, 34)
	 * $query->filterByOtherArtRequestId(array('min' => 12)); // WHERE other_art_request_id > 12
	 * </code>
	 *
	 * @param     mixed $otherArtRequestId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    OtherArtRequestQuery The current query, for fluid interface
	 */
	public function filterByOtherArtRequestId($otherArtRequestId = null, $comparison = null)
	{
		if (is_array($otherArtRequestId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(OtherArtRequestPeer::OTHER_ART_REQUEST_ID, $otherArtRequestId, $comparison);
	}

	/**
	 * Filter the query on the description_text column
	 *
	 * @param     mixed $descriptionText The value to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    OtherArtRequestQuery The current query, for fluid interface
	 */
	public function filterByDescriptionText($descriptionText = null, $comparison = null)
	{
		return $this->addUsingAlias(OtherArtRequestPeer::DESCRIPTION_TEXT, $descriptionText, $comparison);
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
	 * @return    OtherArtRequestQuery The current query, for fluid interface
	 */
	public function filterByArtRequestId($artRequestId = null, $comparison = null)
	{
		if (is_array($artRequestId)) {
			$useMinMax = false;
			if (isset($artRequestId['min'])) {
				$this->addUsingAlias(OtherArtRequestPeer::ART_REQUEST_ID, $artRequestId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($artRequestId['max'])) {
				$this->addUsingAlias(OtherArtRequestPeer::ART_REQUEST_ID, $artRequestId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(OtherArtRequestPeer::ART_REQUEST_ID, $artRequestId, $comparison);
	}

	/**
	 * Filter the query by a related ArtRequest object
	 *
	 * @param     ArtRequest|PropelCollection $artRequest The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    OtherArtRequestQuery The current query, for fluid interface
	 */
	public function filterByArtRequest($artRequest, $comparison = null)
	{
		if ($artRequest instanceof ArtRequest) {
			return $this
				->addUsingAlias(OtherArtRequestPeer::ART_REQUEST_ID, $artRequest->getArtRequestId(), $comparison);
		} elseif ($artRequest instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(OtherArtRequestPeer::ART_REQUEST_ID, $artRequest->toKeyValue('PrimaryKey', 'ArtRequestId'), $comparison);
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
	 * @return    OtherArtRequestQuery The current query, for fluid interface
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
	 * @param     OtherArtRequest $otherArtRequest Object to remove from the list of results
	 *
	 * @return    OtherArtRequestQuery The current query, for fluid interface
	 */
	public function prune($otherArtRequest = null)
	{
		if ($otherArtRequest) {
			$this->addUsingAlias(OtherArtRequestPeer::OTHER_ART_REQUEST_ID, $otherArtRequest->getOtherArtRequestId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseOtherArtRequestQuery