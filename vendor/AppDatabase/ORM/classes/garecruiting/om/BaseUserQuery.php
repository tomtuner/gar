<?php

namespace GARecruitingORM\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \ModelJoin;
use \PDO;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use GARecruitingORM\Applicant;
use GARecruitingORM\User;
use GARecruitingORM\UserPeer;
use GARecruitingORM\UserQuery;

/**
 * Base class that represents a query for the 'user' table.
 *
 *
 *
 * @method UserQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method UserQuery orderByEmailAddress($order = Criteria::ASC) Order by the email_address column
 * @method UserQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method UserQuery orderByAuthenticationToken($order = Criteria::ASC) Order by the authentication_token column
 * @method UserQuery orderByExpirationTime($order = Criteria::ASC) Order by the expiration_time column
 *
 * @method UserQuery groupByUserId() Group by the user_id column
 * @method UserQuery groupByEmailAddress() Group by the email_address column
 * @method UserQuery groupByPassword() Group by the password column
 * @method UserQuery groupByAuthenticationToken() Group by the authentication_token column
 * @method UserQuery groupByExpirationTime() Group by the expiration_time column
 *
 * @method UserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method UserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method UserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method UserQuery leftJoinApplicant($relationAlias = null) Adds a LEFT JOIN clause to the query using the Applicant relation
 * @method UserQuery rightJoinApplicant($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Applicant relation
 * @method UserQuery innerJoinApplicant($relationAlias = null) Adds a INNER JOIN clause to the query using the Applicant relation
 *
 * @method User findOne(PropelPDO $con = null) Return the first User matching the query
 * @method User findOneOrCreate(PropelPDO $con = null) Return the first User matching the query, or a new User object populated from the query conditions when no match is found
 *
 * @method User findOneByUserId(int $user_id) Return the first User filtered by the user_id column
 * @method User findOneByEmailAddress(string $email_address) Return the first User filtered by the email_address column
 * @method User findOneByPassword(string $password) Return the first User filtered by the password column
 * @method User findOneByAuthenticationToken(string $authentication_token) Return the first User filtered by the authentication_token column
 * @method User findOneByExpirationTime(string $expiration_time) Return the first User filtered by the expiration_time column
 *
 * @method array findByUserId(int $user_id) Return User objects filtered by the user_id column
 * @method array findByEmailAddress(string $email_address) Return User objects filtered by the email_address column
 * @method array findByPassword(string $password) Return User objects filtered by the password column
 * @method array findByAuthenticationToken(string $authentication_token) Return User objects filtered by the authentication_token column
 * @method array findByExpirationTime(string $expiration_time) Return User objects filtered by the expiration_time column
 *
 * @package    propel.generator.garecruiting.om
 */
abstract class BaseUserQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseUserQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'ga_recruiting', $modelName = 'GARecruitingORM\\User', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new UserQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     UserQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return UserQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof UserQuery) {
            return $criteria;
        }
        $query = new UserQuery();
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
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   User|User[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UserPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   User A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `USER_ID`, `EMAIL_ADDRESS`, `PASSWORD`, `AUTHENTICATION_TOKEN`, `EXPIRATION_TIME` FROM `user` WHERE `USER_ID` = :p0';
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
            $obj = new User();
            $obj->hydrate($row);
            UserPeer::addInstanceToPool($obj, (string) $key);
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
     * @return User|User[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|User[]|mixed the list of results, formatted by the current formatter
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
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UserPeer::USER_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UserPeer::USER_ID, $keys, Criteria::IN);
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
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(UserPeer::USER_ID, $userId, $comparison);
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
     * @return UserQuery The current query, for fluid interface
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

        return $this->addUsingAlias(UserPeer::EMAIL_ADDRESS, $emailAddress, $comparison);
    }

    /**
     * Filter the query on the password column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE password = 'fooValue'
     * $query->filterByPassword('%fooValue%'); // WHERE password LIKE '%fooValue%'
     * </code>
     *
     * @param     string $password The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByPassword($password = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $password)) {
                $password = str_replace('*', '%', $password);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::PASSWORD, $password, $comparison);
    }

    /**
     * Filter the query on the authentication_token column
     *
     * Example usage:
     * <code>
     * $query->filterByAuthenticationToken('fooValue');   // WHERE authentication_token = 'fooValue'
     * $query->filterByAuthenticationToken('%fooValue%'); // WHERE authentication_token LIKE '%fooValue%'
     * </code>
     *
     * @param     string $authenticationToken The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByAuthenticationToken($authenticationToken = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($authenticationToken)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $authenticationToken)) {
                $authenticationToken = str_replace('*', '%', $authenticationToken);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::AUTHENTICATION_TOKEN, $authenticationToken, $comparison);
    }

    /**
     * Filter the query on the expiration_time column
     *
     * Example usage:
     * <code>
     * $query->filterByExpirationTime('2011-03-14'); // WHERE expiration_time = '2011-03-14'
     * $query->filterByExpirationTime('now'); // WHERE expiration_time = '2011-03-14'
     * $query->filterByExpirationTime(array('max' => 'yesterday')); // WHERE expiration_time > '2011-03-13'
     * </code>
     *
     * @param     mixed $expirationTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByExpirationTime($expirationTime = null, $comparison = null)
    {
        if (is_array($expirationTime)) {
            $useMinMax = false;
            if (isset($expirationTime['min'])) {
                $this->addUsingAlias(UserPeer::EXPIRATION_TIME, $expirationTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expirationTime['max'])) {
                $this->addUsingAlias(UserPeer::EXPIRATION_TIME, $expirationTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::EXPIRATION_TIME, $expirationTime, $comparison);
    }

    /**
     * Filter the query by a related Applicant object
     *
     * @param   Applicant|PropelObjectCollection $applicant  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   UserQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByApplicant($applicant, $comparison = null)
    {
        if ($applicant instanceof Applicant) {
            return $this
                ->addUsingAlias(UserPeer::USER_ID, $applicant->getUserId(), $comparison);
        } elseif ($applicant instanceof PropelObjectCollection) {
            return $this
                ->useApplicantQuery()
                ->filterByPrimaryKeys($applicant->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByApplicant() only accepts arguments of type Applicant or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Applicant relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinApplicant($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Applicant');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Applicant');
        }

        return $this;
    }

    /**
     * Use the Applicant relation Applicant object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \GARecruitingORM\ApplicantQuery A secondary query class using the current class as primary query
     */
    public function useApplicantQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinApplicant($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Applicant', '\GARecruitingORM\ApplicantQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   User $user Object to remove from the list of results
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function prune($user = null)
    {
        if ($user) {
            $this->addUsingAlias(UserPeer::USER_ID, $user->getUserId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
