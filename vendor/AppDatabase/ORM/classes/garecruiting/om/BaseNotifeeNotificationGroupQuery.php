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
use GARecruitingORM\NotifeeNotificationGroupPeer;
use GARecruitingORM\NotifeeNotificationGroupQuery;
use GARecruitingORM\NotificationGroup;
use GARecruitingORM\Notifiee;

/**
 * Base class that represents a query for the 'notifee_notification_group' table.
 *
 *
 *
 * @method NotifeeNotificationGroupQuery orderByNotifieeId($order = Criteria::ASC) Order by the notifiee_id column
 * @method NotifeeNotificationGroupQuery orderByNotificationGroupId($order = Criteria::ASC) Order by the notification_group_id column
 *
 * @method NotifeeNotificationGroupQuery groupByNotifieeId() Group by the notifiee_id column
 * @method NotifeeNotificationGroupQuery groupByNotificationGroupId() Group by the notification_group_id column
 *
 * @method NotifeeNotificationGroupQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method NotifeeNotificationGroupQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method NotifeeNotificationGroupQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method NotifeeNotificationGroupQuery leftJoinNotifiee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Notifiee relation
 * @method NotifeeNotificationGroupQuery rightJoinNotifiee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Notifiee relation
 * @method NotifeeNotificationGroupQuery innerJoinNotifiee($relationAlias = null) Adds a INNER JOIN clause to the query using the Notifiee relation
 *
 * @method NotifeeNotificationGroupQuery leftJoinNotificationGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the NotificationGroup relation
 * @method NotifeeNotificationGroupQuery rightJoinNotificationGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NotificationGroup relation
 * @method NotifeeNotificationGroupQuery innerJoinNotificationGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the NotificationGroup relation
 *
 * @method NotifeeNotificationGroup findOne(PropelPDO $con = null) Return the first NotifeeNotificationGroup matching the query
 * @method NotifeeNotificationGroup findOneOrCreate(PropelPDO $con = null) Return the first NotifeeNotificationGroup matching the query, or a new NotifeeNotificationGroup object populated from the query conditions when no match is found
 *
 * @method NotifeeNotificationGroup findOneByNotifieeId(int $notifiee_id) Return the first NotifeeNotificationGroup filtered by the notifiee_id column
 * @method NotifeeNotificationGroup findOneByNotificationGroupId(int $notification_group_id) Return the first NotifeeNotificationGroup filtered by the notification_group_id column
 *
 * @method array findByNotifieeId(int $notifiee_id) Return NotifeeNotificationGroup objects filtered by the notifiee_id column
 * @method array findByNotificationGroupId(int $notification_group_id) Return NotifeeNotificationGroup objects filtered by the notification_group_id column
 *
 * @package    propel.generator.garecruiting.om
 */
abstract class BaseNotifeeNotificationGroupQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseNotifeeNotificationGroupQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'ga_recruiting', $modelName = 'GARecruitingORM\\NotifeeNotificationGroup', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new NotifeeNotificationGroupQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     NotifeeNotificationGroupQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return NotifeeNotificationGroupQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof NotifeeNotificationGroupQuery) {
            return $criteria;
        }
        $query = new NotifeeNotificationGroupQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array $key Primary key to use for the query
                         A Primary key composition: [$notifiee_id, $notification_group_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   NotifeeNotificationGroup|NotifeeNotificationGroup[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = NotifeeNotificationGroupPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(NotifeeNotificationGroupPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   NotifeeNotificationGroup A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `NOTIFIEE_ID`, `NOTIFICATION_GROUP_ID` FROM `notifee_notification_group` WHERE `NOTIFIEE_ID` = :p0 AND `NOTIFICATION_GROUP_ID` = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new NotifeeNotificationGroup();
            $obj->hydrate($row);
            NotifeeNotificationGroupPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return NotifeeNotificationGroup|NotifeeNotificationGroup[]|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|NotifeeNotificationGroup[]|mixed the list of results, formatted by the current formatter
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
     * @return NotifeeNotificationGroupQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(NotifeeNotificationGroupPeer::NOTIFIEE_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(NotifeeNotificationGroupPeer::NOTIFICATION_GROUP_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return NotifeeNotificationGroupQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(NotifeeNotificationGroupPeer::NOTIFIEE_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(NotifeeNotificationGroupPeer::NOTIFICATION_GROUP_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @see       filterByNotifiee()
     *
     * @param     mixed $notifieeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NotifeeNotificationGroupQuery The current query, for fluid interface
     */
    public function filterByNotifieeId($notifieeId = null, $comparison = null)
    {
        if (is_array($notifieeId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(NotifeeNotificationGroupPeer::NOTIFIEE_ID, $notifieeId, $comparison);
    }

    /**
     * Filter the query on the notification_group_id column
     *
     * Example usage:
     * <code>
     * $query->filterByNotificationGroupId(1234); // WHERE notification_group_id = 1234
     * $query->filterByNotificationGroupId(array(12, 34)); // WHERE notification_group_id IN (12, 34)
     * $query->filterByNotificationGroupId(array('min' => 12)); // WHERE notification_group_id > 12
     * </code>
     *
     * @see       filterByNotificationGroup()
     *
     * @param     mixed $notificationGroupId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NotifeeNotificationGroupQuery The current query, for fluid interface
     */
    public function filterByNotificationGroupId($notificationGroupId = null, $comparison = null)
    {
        if (is_array($notificationGroupId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(NotifeeNotificationGroupPeer::NOTIFICATION_GROUP_ID, $notificationGroupId, $comparison);
    }

    /**
     * Filter the query by a related Notifiee object
     *
     * @param   Notifiee|PropelObjectCollection $notifiee The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   NotifeeNotificationGroupQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByNotifiee($notifiee, $comparison = null)
    {
        if ($notifiee instanceof Notifiee) {
            return $this
                ->addUsingAlias(NotifeeNotificationGroupPeer::NOTIFIEE_ID, $notifiee->getNotifieeId(), $comparison);
        } elseif ($notifiee instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NotifeeNotificationGroupPeer::NOTIFIEE_ID, $notifiee->toKeyValue('PrimaryKey', 'NotifieeId'), $comparison);
        } else {
            throw new PropelException('filterByNotifiee() only accepts arguments of type Notifiee or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Notifiee relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NotifeeNotificationGroupQuery The current query, for fluid interface
     */
    public function joinNotifiee($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Notifiee');

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
            $this->addJoinObject($join, 'Notifiee');
        }

        return $this;
    }

    /**
     * Use the Notifiee relation Notifiee object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \GARecruitingORM\NotifieeQuery A secondary query class using the current class as primary query
     */
    public function useNotifieeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinNotifiee($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Notifiee', '\GARecruitingORM\NotifieeQuery');
    }

    /**
     * Filter the query by a related NotificationGroup object
     *
     * @param   NotificationGroup|PropelObjectCollection $notificationGroup The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   NotifeeNotificationGroupQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByNotificationGroup($notificationGroup, $comparison = null)
    {
        if ($notificationGroup instanceof NotificationGroup) {
            return $this
                ->addUsingAlias(NotifeeNotificationGroupPeer::NOTIFICATION_GROUP_ID, $notificationGroup->getNotificationGroupId(), $comparison);
        } elseif ($notificationGroup instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NotifeeNotificationGroupPeer::NOTIFICATION_GROUP_ID, $notificationGroup->toKeyValue('PrimaryKey', 'NotificationGroupId'), $comparison);
        } else {
            throw new PropelException('filterByNotificationGroup() only accepts arguments of type NotificationGroup or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NotificationGroup relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NotifeeNotificationGroupQuery The current query, for fluid interface
     */
    public function joinNotificationGroup($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('NotificationGroup');

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
            $this->addJoinObject($join, 'NotificationGroup');
        }

        return $this;
    }

    /**
     * Use the NotificationGroup relation NotificationGroup object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \GARecruitingORM\NotificationGroupQuery A secondary query class using the current class as primary query
     */
    public function useNotificationGroupQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinNotificationGroup($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NotificationGroup', '\GARecruitingORM\NotificationGroupQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   NotifeeNotificationGroup $notifeeNotificationGroup Object to remove from the list of results
     *
     * @return NotifeeNotificationGroupQuery The current query, for fluid interface
     */
    public function prune($notifeeNotificationGroup = null)
    {
        if ($notifeeNotificationGroup) {
            $this->addCond('pruneCond0', $this->getAliasedColName(NotifeeNotificationGroupPeer::NOTIFIEE_ID), $notifeeNotificationGroup->getNotifieeId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(NotifeeNotificationGroupPeer::NOTIFICATION_GROUP_ID), $notifeeNotificationGroup->getNotificationGroupId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
