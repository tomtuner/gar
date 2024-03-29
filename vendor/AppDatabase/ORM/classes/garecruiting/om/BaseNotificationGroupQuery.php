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
use GARecruitingORM\NotificationGroup;
use GARecruitingORM\NotificationGroupPeer;
use GARecruitingORM\NotificationGroupQuery;
use GARecruitingORM\PositionNotificationGroup;

/**
 * Base class that represents a query for the 'notification_group' table.
 *
 *
 *
 * @method NotificationGroupQuery orderByNotificationGroupId($order = Criteria::ASC) Order by the notification_group_id column
 * @method NotificationGroupQuery orderByNotificationGroupName($order = Criteria::ASC) Order by the notification_group_name column
 *
 * @method NotificationGroupQuery groupByNotificationGroupId() Group by the notification_group_id column
 * @method NotificationGroupQuery groupByNotificationGroupName() Group by the notification_group_name column
 *
 * @method NotificationGroupQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method NotificationGroupQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method NotificationGroupQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method NotificationGroupQuery leftJoinNotifeeNotificationGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the NotifeeNotificationGroup relation
 * @method NotificationGroupQuery rightJoinNotifeeNotificationGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NotifeeNotificationGroup relation
 * @method NotificationGroupQuery innerJoinNotifeeNotificationGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the NotifeeNotificationGroup relation
 *
 * @method NotificationGroupQuery leftJoinPositionNotificationGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the PositionNotificationGroup relation
 * @method NotificationGroupQuery rightJoinPositionNotificationGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PositionNotificationGroup relation
 * @method NotificationGroupQuery innerJoinPositionNotificationGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the PositionNotificationGroup relation
 *
 * @method NotificationGroup findOne(PropelPDO $con = null) Return the first NotificationGroup matching the query
 * @method NotificationGroup findOneOrCreate(PropelPDO $con = null) Return the first NotificationGroup matching the query, or a new NotificationGroup object populated from the query conditions when no match is found
 *
 * @method NotificationGroup findOneByNotificationGroupId(int $notification_group_id) Return the first NotificationGroup filtered by the notification_group_id column
 * @method NotificationGroup findOneByNotificationGroupName(string $notification_group_name) Return the first NotificationGroup filtered by the notification_group_name column
 *
 * @method array findByNotificationGroupId(int $notification_group_id) Return NotificationGroup objects filtered by the notification_group_id column
 * @method array findByNotificationGroupName(string $notification_group_name) Return NotificationGroup objects filtered by the notification_group_name column
 *
 * @package    propel.generator.garecruiting.om
 */
abstract class BaseNotificationGroupQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseNotificationGroupQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'ga_recruiting', $modelName = 'GARecruitingORM\\NotificationGroup', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new NotificationGroupQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     NotificationGroupQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return NotificationGroupQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof NotificationGroupQuery) {
            return $criteria;
        }
        $query = new NotificationGroupQuery();
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
     * @return   NotificationGroup|NotificationGroup[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = NotificationGroupPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(NotificationGroupPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   NotificationGroup A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `NOTIFICATION_GROUP_ID`, `NOTIFICATION_GROUP_NAME` FROM `notification_group` WHERE `NOTIFICATION_GROUP_ID` = :p0';
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
            $obj = new NotificationGroup();
            $obj->hydrate($row);
            NotificationGroupPeer::addInstanceToPool($obj, (string) $key);
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
     * @return NotificationGroup|NotificationGroup[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|NotificationGroup[]|mixed the list of results, formatted by the current formatter
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
     * @return NotificationGroupQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(NotificationGroupPeer::NOTIFICATION_GROUP_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return NotificationGroupQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(NotificationGroupPeer::NOTIFICATION_GROUP_ID, $keys, Criteria::IN);
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
     * @param     mixed $notificationGroupId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NotificationGroupQuery The current query, for fluid interface
     */
    public function filterByNotificationGroupId($notificationGroupId = null, $comparison = null)
    {
        if (is_array($notificationGroupId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(NotificationGroupPeer::NOTIFICATION_GROUP_ID, $notificationGroupId, $comparison);
    }

    /**
     * Filter the query on the notification_group_name column
     *
     * Example usage:
     * <code>
     * $query->filterByNotificationGroupName('fooValue');   // WHERE notification_group_name = 'fooValue'
     * $query->filterByNotificationGroupName('%fooValue%'); // WHERE notification_group_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $notificationGroupName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NotificationGroupQuery The current query, for fluid interface
     */
    public function filterByNotificationGroupName($notificationGroupName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($notificationGroupName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $notificationGroupName)) {
                $notificationGroupName = str_replace('*', '%', $notificationGroupName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NotificationGroupPeer::NOTIFICATION_GROUP_NAME, $notificationGroupName, $comparison);
    }

    /**
     * Filter the query by a related NotifeeNotificationGroup object
     *
     * @param   NotifeeNotificationGroup|PropelObjectCollection $notifeeNotificationGroup  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   NotificationGroupQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByNotifeeNotificationGroup($notifeeNotificationGroup, $comparison = null)
    {
        if ($notifeeNotificationGroup instanceof NotifeeNotificationGroup) {
            return $this
                ->addUsingAlias(NotificationGroupPeer::NOTIFICATION_GROUP_ID, $notifeeNotificationGroup->getNotificationGroupId(), $comparison);
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
     * @return NotificationGroupQuery The current query, for fluid interface
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
     * Filter the query by a related PositionNotificationGroup object
     *
     * @param   PositionNotificationGroup|PropelObjectCollection $positionNotificationGroup  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   NotificationGroupQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPositionNotificationGroup($positionNotificationGroup, $comparison = null)
    {
        if ($positionNotificationGroup instanceof PositionNotificationGroup) {
            return $this
                ->addUsingAlias(NotificationGroupPeer::NOTIFICATION_GROUP_ID, $positionNotificationGroup->getNotificationGroupId(), $comparison);
        } elseif ($positionNotificationGroup instanceof PropelObjectCollection) {
            return $this
                ->usePositionNotificationGroupQuery()
                ->filterByPrimaryKeys($positionNotificationGroup->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPositionNotificationGroup() only accepts arguments of type PositionNotificationGroup or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PositionNotificationGroup relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NotificationGroupQuery The current query, for fluid interface
     */
    public function joinPositionNotificationGroup($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PositionNotificationGroup');

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
            $this->addJoinObject($join, 'PositionNotificationGroup');
        }

        return $this;
    }

    /**
     * Use the PositionNotificationGroup relation PositionNotificationGroup object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \GARecruitingORM\PositionNotificationGroupQuery A secondary query class using the current class as primary query
     */
    public function usePositionNotificationGroupQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPositionNotificationGroup($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PositionNotificationGroup', '\GARecruitingORM\PositionNotificationGroupQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   NotificationGroup $notificationGroup Object to remove from the list of results
     *
     * @return NotificationGroupQuery The current query, for fluid interface
     */
    public function prune($notificationGroup = null)
    {
        if ($notificationGroup) {
            $this->addUsingAlias(NotificationGroupPeer::NOTIFICATION_GROUP_ID, $notificationGroup->getNotificationGroupId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
