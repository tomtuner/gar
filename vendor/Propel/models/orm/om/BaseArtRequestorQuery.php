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
use ORMModel\ArtRequestor;
use ORMModel\ArtRequestorPeer;
use ORMModel\ArtRequestorQuery;

/**
 * Base class that represents a query for the 'art_requestor' table.
 *
 * 
 *
 * @method     ArtRequestorQuery orderByArtRequestorId($order = Criteria::ASC) Order by the art_requestor_id column
 * @method     ArtRequestorQuery orderByDceName($order = Criteria::ASC) Order by the dce_name column
 * @method     ArtRequestorQuery orderByFirstName($order = Criteria::ASC) Order by the first_name column
 * @method     ArtRequestorQuery orderByLastName($order = Criteria::ASC) Order by the last_name column
 * @method     ArtRequestorQuery orderByEmailAddress($order = Criteria::ASC) Order by the email_address column
 * @method     ArtRequestorQuery orderByPhoneNumber($order = Criteria::ASC) Order by the phone_number column
 *
 * @method     ArtRequestorQuery groupByArtRequestorId() Group by the art_requestor_id column
 * @method     ArtRequestorQuery groupByDceName() Group by the dce_name column
 * @method     ArtRequestorQuery groupByFirstName() Group by the first_name column
 * @method     ArtRequestorQuery groupByLastName() Group by the last_name column
 * @method     ArtRequestorQuery groupByEmailAddress() Group by the email_address column
 * @method     ArtRequestorQuery groupByPhoneNumber() Group by the phone_number column
 *
 * @method     ArtRequestorQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ArtRequestorQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ArtRequestorQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ArtRequestorQuery leftJoinArtRequest($relationAlias = null) Adds a LEFT JOIN clause to the query using the ArtRequest relation
 * @method     ArtRequestorQuery rightJoinArtRequest($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ArtRequest relation
 * @method     ArtRequestorQuery innerJoinArtRequest($relationAlias = null) Adds a INNER JOIN clause to the query using the ArtRequest relation
 *
 * @method     ArtRequestor findOne(PropelPDO $con = null) Return the first ArtRequestor matching the query
 * @method     ArtRequestor findOneOrCreate(PropelPDO $con = null) Return the first ArtRequestor matching the query, or a new ArtRequestor object populated from the query conditions when no match is found
 *
 * @method     ArtRequestor findOneByArtRequestorId(int $art_requestor_id) Return the first ArtRequestor filtered by the art_requestor_id column
 * @method     ArtRequestor findOneByDceName(string $dce_name) Return the first ArtRequestor filtered by the dce_name column
 * @method     ArtRequestor findOneByFirstName(string $first_name) Return the first ArtRequestor filtered by the first_name column
 * @method     ArtRequestor findOneByLastName(string $last_name) Return the first ArtRequestor filtered by the last_name column
 * @method     ArtRequestor findOneByEmailAddress(string $email_address) Return the first ArtRequestor filtered by the email_address column
 * @method     ArtRequestor findOneByPhoneNumber(string $phone_number) Return the first ArtRequestor filtered by the phone_number column
 *
 * @method     array findByArtRequestorId(int $art_requestor_id) Return ArtRequestor objects filtered by the art_requestor_id column
 * @method     array findByDceName(string $dce_name) Return ArtRequestor objects filtered by the dce_name column
 * @method     array findByFirstName(string $first_name) Return ArtRequestor objects filtered by the first_name column
 * @method     array findByLastName(string $last_name) Return ArtRequestor objects filtered by the last_name column
 * @method     array findByEmailAddress(string $email_address) Return ArtRequestor objects filtered by the email_address column
 * @method     array findByPhoneNumber(string $phone_number) Return ArtRequestor objects filtered by the phone_number column
 *
 * @package    propel.generator.orm.om
 */
abstract class BaseArtRequestorQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseArtRequestorQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'orm', $modelName = 'ORMModel\\ArtRequestor', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new ArtRequestorQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    ArtRequestorQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof ArtRequestorQuery) {
			return $criteria;
		}
		$query = new ArtRequestorQuery();
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
	 * @return    ArtRequestor|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = ArtRequestorPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(ArtRequestorPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    ArtRequestor A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ART_REQUESTOR_ID`, `DCE_NAME`, `FIRST_NAME`, `LAST_NAME`, `EMAIL_ADDRESS`, `PHONE_NUMBER` FROM `art_requestor` WHERE `ART_REQUESTOR_ID` = :p0';
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
			$obj = new ArtRequestor();
			$obj->hydrate($row);
			ArtRequestorPeer::addInstanceToPool($obj, (string) $key);
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
	 * @return    ArtRequestor|array|mixed the result, formatted by the current formatter
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
	 * @return    ArtRequestorQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(ArtRequestorPeer::ART_REQUESTOR_ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    ArtRequestorQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(ArtRequestorPeer::ART_REQUESTOR_ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the art_requestor_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByArtRequestorId(1234); // WHERE art_requestor_id = 1234
	 * $query->filterByArtRequestorId(array(12, 34)); // WHERE art_requestor_id IN (12, 34)
	 * $query->filterByArtRequestorId(array('min' => 12)); // WHERE art_requestor_id > 12
	 * </code>
	 *
	 * @param     mixed $artRequestorId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestorQuery The current query, for fluid interface
	 */
	public function filterByArtRequestorId($artRequestorId = null, $comparison = null)
	{
		if (is_array($artRequestorId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(ArtRequestorPeer::ART_REQUESTOR_ID, $artRequestorId, $comparison);
	}

	/**
	 * Filter the query on the dce_name column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByDceName('fooValue');   // WHERE dce_name = 'fooValue'
	 * $query->filterByDceName('%fooValue%'); // WHERE dce_name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $dceName The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestorQuery The current query, for fluid interface
	 */
	public function filterByDceName($dceName = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($dceName)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $dceName)) {
				$dceName = str_replace('*', '%', $dceName);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ArtRequestorPeer::DCE_NAME, $dceName, $comparison);
	}

	/**
	 * Filter the query on the first_name column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByFirstName('fooValue');   // WHERE first_name = 'fooValue'
	 * $query->filterByFirstName('%fooValue%'); // WHERE first_name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $firstName The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestorQuery The current query, for fluid interface
	 */
	public function filterByFirstName($firstName = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($firstName)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $firstName)) {
				$firstName = str_replace('*', '%', $firstName);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ArtRequestorPeer::FIRST_NAME, $firstName, $comparison);
	}

	/**
	 * Filter the query on the last_name column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByLastName('fooValue');   // WHERE last_name = 'fooValue'
	 * $query->filterByLastName('%fooValue%'); // WHERE last_name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $lastName The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestorQuery The current query, for fluid interface
	 */
	public function filterByLastName($lastName = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($lastName)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $lastName)) {
				$lastName = str_replace('*', '%', $lastName);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ArtRequestorPeer::LAST_NAME, $lastName, $comparison);
	}

	/**
	 * Filter the query on the email_address column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEmailAddress('fooValue');   // WHERE email_address = 'fooValue'
	 * $query->filterByEmailAddress('%fooValue%'); // WHERE email_address LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $emailAddress The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestorQuery The current query, for fluid interface
	 */
	public function filterByEmailAddress($emailAddress = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($emailAddress)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $emailAddress)) {
				$emailAddress = str_replace('*', '%', $emailAddress);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ArtRequestorPeer::EMAIL_ADDRESS, $emailAddress, $comparison);
	}

	/**
	 * Filter the query on the phone_number column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPhoneNumber('fooValue');   // WHERE phone_number = 'fooValue'
	 * $query->filterByPhoneNumber('%fooValue%'); // WHERE phone_number LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $phoneNumber The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestorQuery The current query, for fluid interface
	 */
	public function filterByPhoneNumber($phoneNumber = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($phoneNumber)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $phoneNumber)) {
				$phoneNumber = str_replace('*', '%', $phoneNumber);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ArtRequestorPeer::PHONE_NUMBER, $phoneNumber, $comparison);
	}

	/**
	 * Filter the query by a related ArtRequest object
	 *
	 * @param     ArtRequest $artRequest  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestorQuery The current query, for fluid interface
	 */
	public function filterByArtRequest($artRequest, $comparison = null)
	{
		if ($artRequest instanceof ArtRequest) {
			return $this
				->addUsingAlias(ArtRequestorPeer::ART_REQUESTOR_ID, $artRequest->getArtRequestorId(), $comparison);
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
	 * @return    ArtRequestorQuery The current query, for fluid interface
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
	 * @param     ArtRequestor $artRequestor Object to remove from the list of results
	 *
	 * @return    ArtRequestorQuery The current query, for fluid interface
	 */
	public function prune($artRequestor = null)
	{
		if ($artRequestor) {
			$this->addUsingAlias(ArtRequestorPeer::ART_REQUESTOR_ID, $artRequestor->getArtRequestorId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseArtRequestorQuery