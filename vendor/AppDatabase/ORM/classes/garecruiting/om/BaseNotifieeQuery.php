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
use GARecruitingORM\NotifeeNotificationGroup;
use GARecruitingORM\Notifiee;
use GARecruitingORM\NotifieePeer;
use GARecruitingORM\NotifieeQuery;

/**
 * Base class that represents a query for the 'notifiee' table.
 *
 *
 *
 * @method NotifieeQuery orderByNotifieeId($order = Criteria::ASC) Order by the notifiee_id column
 * @method NotifieeQuery orderByNotifieeName($order = Criteria::ASC) Order by the notifiee_name column
 * @method NotifieeQuery orderByNotifieeEmailAddress($order = Criteria::ASC) Order by the notifiee_email_address column
 *
 * @method NotifieeQuery groupByNotifieeId() Group by the notifiee_id column
 * @method NotifieeQuery groupByNotifieeName() Group by the notifiee_name column
 * @method NotifieeQuery groupByNotifieeEmailAddress() Group by the notifiee_email_address column
 *
 * @method NotifieeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method NotifieeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method NotifieeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method NotifieeQuery leftJoinNotifeeNotificationGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the NotifeeNotificationGroup relation
 * @method NotifieeQuery rightJoinNotifeeNotificationGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NotifeeNotificationGroup relation
 * @method NotifieeQuery innerJoinNotifeeNotificationGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the NotifeeNotificationGroup relation
 *
 * @method Notifiee findOne(PropelPDO $con = null) Return the first Notifiee matching the query
 * @method Notifiee findOneOrCreate(PropelPDO $con = null) Return the first Notifiee matching the query, or a new Notifiee object populated from the query conditions when no match is found
 *
 * @method Notifiee findOneByNotifieeId(int $notifiee_id) Return the first Notifiee filtered by the notifiee_id column
 * @method Notifiee findOneByNotifieeName(string $notifiee_name) Return the first Notifiee filtered by the notifiee_name column
 * @method Notifiee findOneByNotifieeEmailAddress(string $notifiee_email_address) Return the first Notifiee filtered by the notifiee_email_address column
 *
 * @method array findByNotifieeId(int $notifiee_id) Return Notifiee objects filtered by the notifiee_id column
 * @method array findByNotifieeName(string $notifiee_name) Return Notifiee objects filtered by the notifiee_name column
 * @method array findByNotifieeEmailAddress(string $notifiee_email_address) Return Notifiee objects filtered by the notifiee_email_address column
 *
 * @package    propel.generator.garecruiting.om
 */
abstract class BaseNotifieeQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseNotifieeQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'ga_recruiting', $modelName = 'GARecruitingORM\\Notifiee', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new NotifieeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     NotifieeQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return NotifieeQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof NotifieeQuery) {
            return $criteria;
        }
        $query = new NotifieeQuery();
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
     * @return   Notifiee|Notifiee[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = NotifieePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(NotifieePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Notifiee A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `NOTIFIEE_ID`, `NOTIFIEE_NAME`, `NOTIFIEE_EMAIL_ADDRESS` FROM `notifiee` WHERE `NOTIFIEE_ID` = :p0';
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
            $obj = new Notifiee();
            $obj->hydrate($row);
            NotifieePeer::addInstanceToPool($obj, (string) $key);
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
     * @return Notifiee|Notifiee[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Notifiee[]|mixed the list of results, formatted by the current formatter
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
     * @return NotifieeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(NotifieePeer::NOTIFIEE_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return NotifieeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(NotifieePeer::NOTIFIEE_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the notifiee_id column
     *
     * Example usage:
     * <code>
     * $query->filterByNotifieeId(1234); // WHERE notifiee_id = 1234
     * $query->filterByNotifieeId(array(12, 34)); // WHERE notifiee_id IN (12, 34)
     * $query->filterByNotifieeId(array('min' => 12)); // WHERE notifiee_id > 12
     * </code>
     *
     * @param     mixed $notifieeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NotifieeQuery The current query, for fluid interface
     */
    public function filterByNotifieeId($notifieeId = null, $comparison = null)
    {
        if (is_array($notifieeId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(NotifieePeer::NOTIFIEE_ID, $notifieeId, $comparison);
    }

    /**
     * Filter the query on the notifiee_name column
     *
     * Example usage:
     * <code>
     * $query->filterByNotifieeName('fooValue');   // WHERE notifiee_name = 'fooValue'
     * $query->filterByNotifieeName('%fooValue%'); // WHERE notifiee_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $notifieeName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NotifieeQuery The current query, for fluid interface
     */
    public function filterByNotifieeName($notifieeName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($notifieeName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $notifieeName)) {
                $notifieeName = str_replace('*', '%', $notifieeName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NotifieePeer::NOTIFIEE_NAME, $notifieeName, $comparison);
    }

    /**
     * Filter the query on the notifiee_email_address column
     *
     * Example usage:
     * <code>
     * $query->filterByNotifieeEmailAddress('fooValue');   // WHERE notifiee_email_address = 'fooValue'
     * $query->filterByNotifieeEmailAddress('%fooValue%'); // WHERE notifiee_email_address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $notifieeEmailAddress The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NotifieeQuery The current query, for fluid interface
     */
    public function filterByNotifieeEmailAddress($notifieeEmailAddress = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($notifieeEmailAddress)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $notifieeEmailAddress)) {
                $notifieeEmailAddress = str_replace('*', '%', $notifieeEmailAddress);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NotifieePeer::NOTIFIEE_EMAIL_ADDRESS, $notifieeEmailAddress, $comparison);
    }

    /**
     * Filter the query by a related NotifeeNotificationGroup object
     *
     * @param   NotifeeNotificationGroup|PropelObjectCollection $notifeeNotificationGroup  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   NotifieeQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByNotifeeNotificationGroup($notifeeNotificationGroup, $comparison = null)
    {
        if ($notifeeNotificationGroup instanceof NotifeeNotificationGroup) {
            return $this
                ->addUsingAlias(NotifieePeer::NOTIFIEE_ID, $notifeeNotificationGroup->getNotifieeId(), $comparison);
        } elseif ($notifeeNotificationGroup instanceof PropelObjectCollection) {
            return $this
                ->useNotifeeNotificationGroupQuery()
                ->filterByPrimaryKeys($notifeeNotificationGroup->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByNotifeeNotificationGroup() only accepts arguments of type NotifeeNotificationGroup or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NotifeeNotificationGroup relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NotifieeQuery The current query, for fluid interface
     */
    public function joinNotifeeNotificationGroup($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('NotifeeNotificationGroup');

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
            $this->addJoinObject($join, 'NotifeeNotificationGroup');
        }

        return $this;
    }

    /**
     * Use the NotifeeNotificationGroup relation NotifeeNotificationGroup object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \GARecruitingORM\NotifeeNotificationGroupQuery A secondary query class using the current class as primary query
     */
    public function useNotifeeNotificationGroupQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinNotifeeNotificationGroup($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NotifeeNotificationGroup', '\GARecruitingORM\NotifeeNotificationGroupQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Notifiee $notifiee Object to remove from the list of results
     *
     * @return NotifieeQuery The current query, for fluid interface
     */
    public function prune($notifiee = null)
    {
        if ($notifiee) {
            $this->addUsingAlias(NotifieePeer::NOTIFIEE_ID, $notifiee->getNotifieeId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
