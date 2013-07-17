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
use ORMModel\ArtRequestComment;
use ORMModel\ArtRequestCommentPeer;
use ORMModel\ArtRequestCommentQuery;
use ORMModel\User;

/**
 * Base class that represents a query for the 'art_request_comment' table.
 *
 * 
 *
 * @method     ArtRequestCommentQuery orderByArtRequestCommentId($order = Criteria::ASC) Order by the art_request_comment_id column
 * @method     ArtRequestCommentQuery orderByArtRequestId($order = Criteria::ASC) Order by the art_request_id column
 * @method     ArtRequestCommentQuery orderByCommentText($order = Criteria::ASC) Order by the comment_text column
 * @method     ArtRequestCommentQuery orderByCommentDate($order = Criteria::ASC) Order by the comment_date column
 * @method     ArtRequestCommentQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 *
 * @method     ArtRequestCommentQuery groupByArtRequestCommentId() Group by the art_request_comment_id column
 * @method     ArtRequestCommentQuery groupByArtRequestId() Group by the art_request_id column
 * @method     ArtRequestCommentQuery groupByCommentText() Group by the comment_text column
 * @method     ArtRequestCommentQuery groupByCommentDate() Group by the comment_date column
 * @method     ArtRequestCommentQuery groupByUserId() Group by the user_id column
 *
 * @method     ArtRequestCommentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ArtRequestCommentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ArtRequestCommentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ArtRequestCommentQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ArtRequestCommentQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ArtRequestCommentQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ArtRequestCommentQuery leftJoinArtRequest($relationAlias = null) Adds a LEFT JOIN clause to the query using the ArtRequest relation
 * @method     ArtRequestCommentQuery rightJoinArtRequest($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ArtRequest relation
 * @method     ArtRequestCommentQuery innerJoinArtRequest($relationAlias = null) Adds a INNER JOIN clause to the query using the ArtRequest relation
 *
 * @method     ArtRequestComment findOne(PropelPDO $con = null) Return the first ArtRequestComment matching the query
 * @method     ArtRequestComment findOneOrCreate(PropelPDO $con = null) Return the first ArtRequestComment matching the query, or a new ArtRequestComment object populated from the query conditions when no match is found
 *
 * @method     ArtRequestComment findOneByArtRequestCommentId(int $art_request_comment_id) Return the first ArtRequestComment filtered by the art_request_comment_id column
 * @method     ArtRequestComment findOneByArtRequestId(int $art_request_id) Return the first ArtRequestComment filtered by the art_request_id column
 * @method     ArtRequestComment findOneByCommentText(resource $comment_text) Return the first ArtRequestComment filtered by the comment_text column
 * @method     ArtRequestComment findOneByCommentDate(string $comment_date) Return the first ArtRequestComment filtered by the comment_date column
 * @method     ArtRequestComment findOneByUserId(int $user_id) Return the first ArtRequestComment filtered by the user_id column
 *
 * @method     array findByArtRequestCommentId(int $art_request_comment_id) Return ArtRequestComment objects filtered by the art_request_comment_id column
 * @method     array findByArtRequestId(int $art_request_id) Return ArtRequestComment objects filtered by the art_request_id column
 * @method     array findByCommentText(resource $comment_text) Return ArtRequestComment objects filtered by the comment_text column
 * @method     array findByCommentDate(string $comment_date) Return ArtRequestComment objects filtered by the comment_date column
 * @method     array findByUserId(int $user_id) Return ArtRequestComment objects filtered by the user_id column
 *
 * @package    propel.generator.orm.om
 */
abstract class BaseArtRequestCommentQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseArtRequestCommentQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'orm', $modelName = 'ORMModel\\ArtRequestComment', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new ArtRequestCommentQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    ArtRequestCommentQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof ArtRequestCommentQuery) {
			return $criteria;
		}
		$query = new ArtRequestCommentQuery();
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
	 * @return    ArtRequestComment|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = ArtRequestCommentPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(ArtRequestCommentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    ArtRequestComment A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ART_REQUEST_COMMENT_ID`, `ART_REQUEST_ID`, `COMMENT_TEXT`, `COMMENT_DATE`, `USER_ID` FROM `art_request_comment` WHERE `ART_REQUEST_COMMENT_ID` = :p0';
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
			$obj = new ArtRequestComment();
			$obj->hydrate($row);
			ArtRequestCommentPeer::addInstanceToPool($obj, (string) $key);
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
	 * @return    ArtRequestComment|array|mixed the result, formatted by the current formatter
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
	 * @return    ArtRequestCommentQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(ArtRequestCommentPeer::ART_REQUEST_COMMENT_ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    ArtRequestCommentQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(ArtRequestCommentPeer::ART_REQUEST_COMMENT_ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the art_request_comment_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByArtRequestCommentId(1234); // WHERE art_request_comment_id = 1234
	 * $query->filterByArtRequestCommentId(array(12, 34)); // WHERE art_request_comment_id IN (12, 34)
	 * $query->filterByArtRequestCommentId(array('min' => 12)); // WHERE art_request_comment_id > 12
	 * </code>
	 *
	 * @param     mixed $artRequestCommentId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestCommentQuery The current query, for fluid interface
	 */
	public function filterByArtRequestCommentId($artRequestCommentId = null, $comparison = null)
	{
		if (is_array($artRequestCommentId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(ArtRequestCommentPeer::ART_REQUEST_COMMENT_ID, $artRequestCommentId, $comparison);
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
	 * @return    ArtRequestCommentQuery The current query, for fluid interface
	 */
	public function filterByArtRequestId($artRequestId = null, $comparison = null)
	{
		if (is_array($artRequestId)) {
			$useMinMax = false;
			if (isset($artRequestId['min'])) {
				$this->addUsingAlias(ArtRequestCommentPeer::ART_REQUEST_ID, $artRequestId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($artRequestId['max'])) {
				$this->addUsingAlias(ArtRequestCommentPeer::ART_REQUEST_ID, $artRequestId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ArtRequestCommentPeer::ART_REQUEST_ID, $artRequestId, $comparison);
	}

	/**
	 * Filter the query on the comment_text column
	 *
	 * @param     mixed $commentText The value to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestCommentQuery The current query, for fluid interface
	 */
	public function filterByCommentText($commentText = null, $comparison = null)
	{
		return $this->addUsingAlias(ArtRequestCommentPeer::COMMENT_TEXT, $commentText, $comparison);
	}

	/**
	 * Filter the query on the comment_date column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCommentDate('2011-03-14'); // WHERE comment_date = '2011-03-14'
	 * $query->filterByCommentDate('now'); // WHERE comment_date = '2011-03-14'
	 * $query->filterByCommentDate(array('max' => 'yesterday')); // WHERE comment_date > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $commentDate The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestCommentQuery The current query, for fluid interface
	 */
	public function filterByCommentDate($commentDate = null, $comparison = null)
	{
		if (is_array($commentDate)) {
			$useMinMax = false;
			if (isset($commentDate['min'])) {
				$this->addUsingAlias(ArtRequestCommentPeer::COMMENT_DATE, $commentDate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($commentDate['max'])) {
				$this->addUsingAlias(ArtRequestCommentPeer::COMMENT_DATE, $commentDate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ArtRequestCommentPeer::COMMENT_DATE, $commentDate, $comparison);
	}

	/**
	 * Filter the query on the user_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByUserId(1234); // WHERE user_id = 1234
	 * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
	 * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
	 * </code>
	 *
	 * @see       filterByUser()
	 *
	 * @param     mixed $userId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestCommentQuery The current query, for fluid interface
	 */
	public function filterByUserId($userId = null, $comparison = null)
	{
		if (is_array($userId)) {
			$useMinMax = false;
			if (isset($userId['min'])) {
				$this->addUsingAlias(ArtRequestCommentPeer::USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($userId['max'])) {
				$this->addUsingAlias(ArtRequestCommentPeer::USER_ID, $userId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ArtRequestCommentPeer::USER_ID, $userId, $comparison);
	}

	/**
	 * Filter the query by a related User object
	 *
	 * @param     User|PropelCollection $user The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestCommentQuery The current query, for fluid interface
	 */
	public function filterByUser($user, $comparison = null)
	{
		if ($user instanceof User) {
			return $this
				->addUsingAlias(ArtRequestCommentPeer::USER_ID, $user->getUserId(), $comparison);
		} elseif ($user instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(ArtRequestCommentPeer::USER_ID, $user->toKeyValue('PrimaryKey', 'UserId'), $comparison);
		} else {
			throw new PropelException('filterByUser() only accepts arguments of type User or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the User relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ArtRequestCommentQuery The current query, for fluid interface
	 */
	public function joinUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('User');

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
			$this->addJoinObject($join, 'User');
		}

		return $this;
	}

	/**
	 * Use the User relation User object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    \ORMModel\UserQuery A secondary query class using the current class as primary query
	 */
	public function useUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinUser($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'User', '\ORMModel\UserQuery');
	}

	/**
	 * Filter the query by a related ArtRequest object
	 *
	 * @param     ArtRequest|PropelCollection $artRequest The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestCommentQuery The current query, for fluid interface
	 */
	public function filterByArtRequest($artRequest, $comparison = null)
	{
		if ($artRequest instanceof ArtRequest) {
			return $this
				->addUsingAlias(ArtRequestCommentPeer::ART_REQUEST_ID, $artRequest->getArtRequestId(), $comparison);
		} elseif ($artRequest instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(ArtRequestCommentPeer::ART_REQUEST_ID, $artRequest->toKeyValue('PrimaryKey', 'ArtRequestId'), $comparison);
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
	 * @return    ArtRequestCommentQuery The current query, for fluid interface
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
	 * @param     ArtRequestComment $artRequestComment Object to remove from the list of results
	 *
	 * @return    ArtRequestCommentQuery The current query, for fluid interface
	 */
	public function prune($artRequestComment = null)
	{
		if ($artRequestComment) {
			$this->addUsingAlias(ArtRequestCommentPeer::ART_REQUEST_COMMENT_ID, $artRequestComment->getArtRequestCommentId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseArtRequestCommentQuery