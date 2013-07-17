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
use ORMModel\LogoArtRequest;
use ORMModel\LogoArtRequestPeer;
use ORMModel\LogoArtRequestQuery;

/**
 * Base class that represents a query for the 'logo_art_request' table.
 *
 * 
 *
 * @method     LogoArtRequestQuery orderByLogoArtRequestId($order = Criteria::ASC) Order by the logo_art_request_id column
 * @method     LogoArtRequestQuery orderByDescriptionText($order = Criteria::ASC) Order by the description_text column
 * @method     LogoArtRequestQuery orderByArtRequestId($order = Criteria::ASC) Order by the art_request_id column
 *
 * @method     LogoArtRequestQuery groupByLogoArtRequestId() Group by the logo_art_request_id column
 * @method     LogoArtRequestQuery groupByDescriptionText() Group by the description_text column
 * @method     LogoArtRequestQuery groupByArtRequestId() Group by the art_request_id column
 *
 * @method     LogoArtRequestQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     LogoArtRequestQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     LogoArtRequestQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     LogoArtRequestQuery leftJoinArtRequest($relationAlias = null) Adds a LEFT JOIN clause to the query using the ArtRequest relation
 * @method     LogoArtRequestQuery rightJoinArtRequest($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ArtRequest relation
 * @method     LogoArtRequestQuery innerJoinArtRequest($relationAlias = null) Adds a INNER JOIN clause to the query using the ArtRequest relation
 *
 * @method     LogoArtRequest findOne(PropelPDO $con = null) Return the first LogoArtRequest matching the query
 * @method     LogoArtRequest findOneOrCreate(PropelPDO $con = null) Return the first LogoArtRequest matching the query, or a new LogoArtRequest object populated from the query conditions when no match is found
 *
 * @method     LogoArtRequest findOneByLogoArtRequestId(int $logo_art_request_id) Return the first LogoArtRequest filtered by the logo_art_request_id column
 * @method     LogoArtRequest findOneByDescriptionText(resource $description_text) Return the first LogoArtRequest filtered by the description_text column
 * @method     LogoArtRequest findOneByArtRequestId(int $art_request_id) Return the first LogoArtRequest filtered by the art_request_id column
 *
 * @method     array findByLogoArtRequestId(int $logo_art_request_id) Return LogoArtRequest objects filtered by the logo_art_request_id column
 * @method     array findByDescriptionText(resource $description_text) Return LogoArtRequest objects filtered by the description_text column
 * @method     array findByArtRequestId(int $art_request_id) Return LogoArtRequest objects filtered by the art_request_id column
 *
 * @package    propel.generator.orm.om
 */
abstract class BaseLogoArtRequestQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseLogoArtRequestQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'orm', $modelName = 'ORMModel\\LogoArtRequest', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new LogoArtRequestQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    LogoArtRequestQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof LogoArtRequestQuery) {
			return $criteria;
		}
		$query = new LogoArtRequestQuery();
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
	 * @return    LogoArtRequest|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = LogoArtRequestPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(LogoArtRequestPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    LogoArtRequest A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `LOGO_ART_REQUEST_ID`, `DESCRIPTION_TEXT`, `ART_REQUEST_ID` FROM `logo_art_request` WHERE `LOGO_ART_REQUEST_ID` = :p0';
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
			$obj = new LogoArtRequest();
			$obj->hydrate($row);
			LogoArtRequestPeer::addInstanceToPool($obj, (string) $key);
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
	 * @return    LogoArtRequest|array|mixed the result, formatted by the current formatter
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
	 * @return    LogoArtRequestQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(LogoArtRequestPeer::LOGO_ART_REQUEST_ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    LogoArtRequestQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(LogoArtRequestPeer::LOGO_ART_REQUEST_ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the logo_art_request_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByLogoArtRequestId(1234); // WHERE logo_art_request_id = 1234
	 * $query->filterByLogoArtRequestId(array(12, 34)); // WHERE logo_art_request_id IN (12, 34)
	 * $query->filterByLogoArtRequestId(array('min' => 12)); // WHERE logo_art_request_id > 12
	 * </code>
	 *
	 * @param     mixed $logoArtRequestId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    LogoArtRequestQuery The current query, for fluid interface
	 */
	public function filterByLogoArtRequestId($logoArtRequestId = null, $comparison = null)
	{
		if (is_array($logoArtRequestId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(LogoArtRequestPeer::LOGO_ART_REQUEST_ID, $logoArtRequestId, $comparison);
	}

	/**
	 * Filter the query on the description_text column
	 *
	 * @param     mixed $descriptionText The value to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    LogoArtRequestQuery The current query, for fluid interface
	 */
	public function filterByDescriptionText($descriptionText = null, $comparison = null)
	{
		return $this->addUsingAlias(LogoArtRequestPeer::DESCRIPTION_TEXT, $descriptionText, $comparison);
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
	 * @return    LogoArtRequestQuery The current query, for fluid interface
	 */
	public function filterByArtRequestId($artRequestId = null, $comparison = null)
	{
		if (is_array($artRequestId)) {
			$useMinMax = false;
			if (isset($artRequestId['min'])) {
				$this->addUsingAlias(LogoArtRequestPeer::ART_REQUEST_ID, $artRequestId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($artRequestId['max'])) {
				$this->addUsingAlias(LogoArtRequestPeer::ART_REQUEST_ID, $artRequestId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(LogoArtRequestPeer::ART_REQUEST_ID, $artRequestId, $comparison);
	}

	/**
	 * Filter the query by a related ArtRequest object
	 *
	 * @param     ArtRequest|PropelCollection $artRequest The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    LogoArtRequestQuery The current query, for fluid interface
	 */
	public function filterByArtRequest($artRequest, $comparison = null)
	{
		if ($artRequest instanceof ArtRequest) {
			return $this
				->addUsingAlias(LogoArtRequestPeer::ART_REQUEST_ID, $artRequest->getArtRequestId(), $comparison);
		} elseif ($artRequest instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(LogoArtRequestPeer::ART_REQUEST_ID, $artRequest->toKeyValue('PrimaryKey', 'ArtRequestId'), $comparison);
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
	 * @return    LogoArtRequestQuery The current query, for fluid interface
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
	 * @param     LogoArtRequest $logoArtRequest Object to remove from the list of results
	 *
	 * @return    LogoArtRequestQuery The current query, for fluid interface
	 */
	public function prune($logoArtRequest = null)
	{
		if ($logoArtRequest) {
			$this->addUsingAlias(LogoArtRequestPeer::LOGO_ART_REQUEST_ID, $logoArtRequest->getLogoArtRequestId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseLogoArtRequestQuery