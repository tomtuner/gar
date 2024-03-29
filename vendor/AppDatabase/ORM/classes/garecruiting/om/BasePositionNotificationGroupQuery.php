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
use GARecruitingORM\NotificationGroup;
use GARecruitingORM\Position;
use GARecruitingORM\PositionNotificationGroup;
use GARecruitingORM\PositionNotificationGroupPeer;
use GARecruitingORM\PositionNotificationGroupQuery;

/**
 * Base class that represents a query for the 'position_notification_group' table.
 *
 *
 *
 * @method PositionNotificationGroupQuery orderByNotificationGroupId($order = Criteria::ASC) Order by the notification_group_id column
 * @method PositionNotificationGroupQuery orderByPositionId($order = Criteria::ASC) Order by the position_id column
 *
 * @method PositionNotificationGroupQuery groupByNotificationGroupId() Group by the notification_group_id column
 * @method PositionNotificationGroupQuery groupByPositionId() Group by the position_id column
 *
 * @method PositionNotificationGroupQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method PositionNotificationGroupQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method PositionNotificationGroupQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method PositionNotificationGroupQuery leftJoinNotificationGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the NotificationGroup relation
 * @method PositionNotificationGroupQuery rightJoinNotificationGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NotificationGroup relation
 * @method PositionNotificationGroupQuery innerJoinNotificationGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the NotificationGroup relation
 *
 * @method PositionNotificationGroupQuery leftJoinPosition($relationAlias = null) Adds a LEFT JOIN clause to the query using the Position relation
 * @method PositionNotificationGroupQuery rightJoinPosition($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Position relation
 * @method PositionNotificationGroupQuery innerJoinPosition($relationAlias = null) Adds a INNER JOIN clause to the query using the Position relation
 *
 * @method PositionNotificationGroup findOne(PropelPDO $con = null) Return the first PositionNotificationGroup matching the query
 * @method PositionNotificationGroup findOneOrCreate(PropelPDO $con = null) Return the first PositionNotificationGroup matching the query, or a new PositionNotificationGroup object populated from the query conditions when no match is found
 *
 * @method PositionNotificationGroup findOneByNotificationGroupId(int $notification_group_id) Return the first PositionNotificationGroup filtered by the notification_group_id column
 * @method PositionNotificationGroup findOneByPositionId(int $position_id) Return the first PositionNotificationGroup filtered by the position_id column
 *
 * @method array findByNotificationGroupId(int $notification_group_id) Return PositionNotificationGroup objects filtered by the notification_group_id column
 * @method array findByPositionId(int $position_id) Return PositionNotificationGroup objects filtered by the position_id column
 *
 * @package    propel.generator.garecruiting.om
 */
abstract class BasePositionNotificationGroupQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasePositionNotificationGroupQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'ga_recruiting', $modelName = 'GARecruitingORM\\PositionNotificationGroup', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PositionNotificationGroupQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     PositionNotificationGroupQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return PositionNotificationGroupQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PositionNotificationGroupQuery) {
            return $criteria;
        }
        $query = new PositionNotificationGroupQuery();
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
                         A Primary key composition: [$notification_group_id, $position_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   PositionNotificationGroup|PositionNotificationGroup[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PositionNotificationGroupPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PositionNotificationGroupPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   PositionNotificationGroup A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `NOTIFICATION_GROUP_ID`, `POSITION_ID` FROM `position_notification_group` WHERE `NOTIFICATION_GROUP_ID` = :p0 AND `POSITION_ID` = :p1';
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
            $obj = new PositionNotificationGroup();
            $obj->hydrate($row);
            PositionNotificationGroupPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return PositionNotificationGroup|PositionNotificationGroup[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|PositionNotificationGroup[]|mixed the list of results, formatted by the current formatter
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
     * @return PositionNotificationGroupQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(PositionNotificationGroupPeer::NOTIFICATION_GROUP_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(PositionNotificationGroupPeer::POSITION_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PositionNotificationGroupQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(PositionNotificationGroupPeer::NOTIFICATION_GROUP_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(PositionNotificationGroupPeer::POSITION_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return PositionNotificationGroupQuery The current query, for fluid interface
     */
    public function filterByNotificationGroupId($notificationGroupId = null, $comparison = null)
    {
        if (is_array($notificationGroupId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(PositionNotificationGroupPeer::NOTIFICATION_GROUP_ID, $notificationGroupId, $comparison);
    }

    /**
     * Filter the query on the position_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPositionId(1234); // WHERE position_id = 1234
     * $query->filterByPositionId(array(12, 34)); // WHERE position_id IN (12, 34)
     * $query->filterByPositionId(array('min' => 12)); // WHERE position_id > 12
     * </code>
     *
     * @see       filterByPosition()
     *
     * @param     mixed $positionId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PositionNotificationGroupQuery The current query, for fluid interface
     */
    public function filterByPositionId($positionId = null, $comparison = null)
    {
        if (is_array($positionId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(PositionNotificationGroupPeer::POSITION_ID, $positionId, $comparison);
    }

    /**
     * Filter the query by a related NotificationGroup object
     *
     * @param   NotificationGroup|PropelObjectCollection $notificationGroup The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PositionNotificationGroupQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByNotificationGroup($notificationGroup, $comparison = null)
    {
        if ($notificationGroup instanceof NotificationGroup) {
            return $this
                ->addUsingAlias(PositionNotificationGroupPeer::NOTIFICATION_GROUP_ID, $notificationGroup->getNotificationGroupId(), $comparison);
        } elseif ($notificationGroup instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PositionNotificationGroupPeer::NOTIFICATION_GROUP_ID, $notificationGroup->toKeyValue('PrimaryKey', 'NotificationGroupId'), $comparison);
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
     * @return PositionNotificationGroupQuery The current query, for fluid interface
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
     * Filter the query by a related Position object
     *
     * @param   Position|PropelObjectCollection $position The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PositionNotificationGroupQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPosition($position, $comparison = null)
    {
        if ($position instanceof Position) {
            return $this
                ->addUsingAlias(PositionNotificationGroupPeer::POSITION_ID, $position->getPositionId(), $comparison);
        } elseif ($position instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PositionNotificationGroupPeer::POSITION_ID, $position->toKeyValue('PrimaryKey', 'PositionId'), $comparison);
        } else {
            throw new PropelException('filterByPosition() only accepts arguments of type Position or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Position relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PositionNotificationGroupQuery The current query, for fluid interface
     */
    public function joinPosition($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Position');

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
            $this->addJoinObject($join, 'Position');
        }

        return $this;
    }

    /**
     * Use the Position relation Position object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \GARecruitingORM\PositionQuery A secondary query class using the current class as primary query
     */
    public function usePositionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPosition($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Position', '\GARecruitingORM\PositionQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   PositionNotificationGroup $positionNotificationGroup Object to remove from the list of results
     *
     * @return PositionNotificationGroupQuery The current query, for fluid interface
     */
    public function prune($positionNotificationGroup = null)
    {
        if ($positionNotificationGroup) {
            $this->addCond('pruneCond0', $this->getAliasedColName(PositionNotificationGroupPeer::NOTIFICATION_GROUP_ID), $positionNotificationGroup->getNotificationGroupId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(PositionNotificationGroupPeer::POSITION_ID), $positionNotificationGroup->getPositionId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
