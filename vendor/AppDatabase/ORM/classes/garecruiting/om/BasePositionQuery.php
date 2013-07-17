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
use GARecruitingORM\ApplicantPosition;
use GARecruitingORM\Position;
use GARecruitingORM\PositionNotificationGroup;
use GARecruitingORM\PositionPeer;
use GARecruitingORM\PositionQuery;

/**
 * Base class that represents a query for the 'position' table.
 *
 *
 *
 * @method PositionQuery orderByPositionId($order = Criteria::ASC) Order by the position_id column
 * @method PositionQuery orderByPositionName($order = Criteria::ASC) Order by the position_name column
 * @method PositionQuery orderByDepartmentName($order = Criteria::ASC) Order by the department_name column
 * @method PositionQuery orderByIsActive($order = Criteria::ASC) Order by the is_active column
 *
 * @method PositionQuery groupByPositionId() Group by the position_id column
 * @method PositionQuery groupByPositionName() Group by the position_name column
 * @method PositionQuery groupByDepartmentName() Group by the department_name column
 * @method PositionQuery groupByIsActive() Group by the is_active column
 *
 * @method PositionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method PositionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method PositionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method PositionQuery leftJoinApplicantPosition($relationAlias = null) Adds a LEFT JOIN clause to the query using the ApplicantPosition relation
 * @method PositionQuery rightJoinApplicantPosition($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ApplicantPosition relation
 * @method PositionQuery innerJoinApplicantPosition($relationAlias = null) Adds a INNER JOIN clause to the query using the ApplicantPosition relation
 *
 * @method PositionQuery leftJoinPositionNotificationGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the PositionNotificationGroup relation
 * @method PositionQuery rightJoinPositionNotificationGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PositionNotificationGroup relation
 * @method PositionQuery innerJoinPositionNotificationGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the PositionNotificationGroup relation
 *
 * @method Position findOne(PropelPDO $con = null) Return the first Position matching the query
 * @method Position findOneOrCreate(PropelPDO $con = null) Return the first Position matching the query, or a new Position object populated from the query conditions when no match is found
 *
 * @method Position findOneByPositionId(int $position_id) Return the first Position filtered by the position_id column
 * @method Position findOneByPositionName(string $position_name) Return the first Position filtered by the position_name column
 * @method Position findOneByDepartmentName(string $department_name) Return the first Position filtered by the department_name column
 * @method Position findOneByIsActive(int $is_active) Return the first Position filtered by the is_active column
 *
 * @method array findByPositionId(int $position_id) Return Position objects filtered by the position_id column
 * @method array findByPositionName(string $position_name) Return Position objects filtered by the position_name column
 * @method array findByDepartmentName(string $department_name) Return Position objects filtered by the department_name column
 * @method array findByIsActive(int $is_active) Return Position objects filtered by the is_active column
 *
 * @package    propel.generator.garecruiting.om
 */
abstract class BasePositionQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasePositionQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'ga_recruiting', $modelName = 'GARecruitingORM\\Position', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PositionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     PositionQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return PositionQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PositionQuery) {
            return $criteria;
        }
        $query = new PositionQuery();
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
     * @return   Position|Position[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PositionPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PositionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Position A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `POSITION_ID`, `POSITION_NAME`, `DEPARTMENT_NAME`, `IS_ACTIVE` FROM `position` WHERE `POSITION_ID` = :p0';
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
            $obj = new Position();
            $obj->hydrate($row);
            PositionPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Position|Position[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Position[]|mixed the list of results, formatted by the current formatter
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
     * @return PositionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PositionPeer::POSITION_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PositionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PositionPeer::POSITION_ID, $keys, Criteria::IN);
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
     * @param     mixed $positionId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PositionQuery The current query, for fluid interface
     */
    public function filterByPositionId($positionId = null, $comparison = null)
    {
        if (is_array($positionId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(PositionPeer::POSITION_ID, $positionId, $comparison);
    }

    /**
     * Filter the query on the position_name column
     *
     * Example usage:
     * <code>
     * $query->filterByPositionName('fooValue');   // WHERE position_name = 'fooValue'
     * $query->filterByPositionName('%fooValue%'); // WHERE position_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $positionName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PositionQuery The current query, for fluid interface
     */
    public function filterByPositionName($positionName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($positionName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $positionName)) {
                $positionName = str_replace('*', '%', $positionName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PositionPeer::POSITION_NAME, $positionName, $comparison);
    }

    /**
     * Filter the query on the department_name column
     *
     * Example usage:
     * <code>
     * $query->filterByDepartmentName('fooValue');   // WHERE department_name = 'fooValue'
     * $query->filterByDepartmentName('%fooValue%'); // WHERE department_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $departmentName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PositionQuery The current query, for fluid interface
     */
    public function filterByDepartmentName($departmentName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($departmentName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $departmentName)) {
                $departmentName = str_replace('*', '%', $departmentName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PositionPeer::DEPARTMENT_NAME, $departmentName, $comparison);
    }

    /**
     * Filter the query on the is_active column
     *
     * Example usage:
     * <code>
     * $query->filterByIsActive(1234); // WHERE is_active = 1234
     * $query->filterByIsActive(array(12, 34)); // WHERE is_active IN (12, 34)
     * $query->filterByIsActive(array('min' => 12)); // WHERE is_active > 12
     * </code>
     *
     * @param     mixed $isActive The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PositionQuery The current query, for fluid interface
     */
    public function filterByIsActive($isActive = null, $comparison = null)
    {
        if (is_array($isActive)) {
            $useMinMax = false;
            if (isset($isActive['min'])) {
                $this->addUsingAlias(PositionPeer::IS_ACTIVE, $isActive['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($isActive['max'])) {
                $this->addUsingAlias(PositionPeer::IS_ACTIVE, $isActive['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PositionPeer::IS_ACTIVE, $isActive, $comparison);
    }

    /**
     * Filter the query by a related ApplicantPosition object
     *
     * @param   ApplicantPosition|PropelObjectCollection $applicantPosition  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PositionQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByApplicantPosition($applicantPosition, $comparison = null)
    {
        if ($applicantPosition instanceof ApplicantPosition) {
            return $this
                ->addUsingAlias(PositionPeer::POSITION_ID, $applicantPosition->getPositionId(), $comparison);
        } elseif ($applicantPosition instanceof PropelObjectCollection) {
            return $this
                ->useApplicantPositionQuery()
                ->filterByPrimaryKeys($applicantPosition->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByApplicantPosition() only accepts arguments of type ApplicantPosition or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ApplicantPosition relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PositionQuery The current query, for fluid interface
     */
    public function joinApplicantPosition($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ApplicantPosition');

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
            $this->addJoinObject($join, 'ApplicantPosition');
        }

        return $this;
    }

    /**
     * Use the ApplicantPosition relation ApplicantPosition object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \GARecruitingORM\ApplicantPositionQuery A secondary query class using the current class as primary query
     */
    public function useApplicantPositionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinApplicantPosition($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ApplicantPosition', '\GARecruitingORM\ApplicantPositionQuery');
    }

    /**
     * Filter the query by a related PositionNotificationGroup object
     *
     * @param   PositionNotificationGroup|PropelObjectCollection $positionNotificationGroup  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PositionQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPositionNotificationGroup($positionNotificationGroup, $comparison = null)
    {
        if ($positionNotificationGroup instanceof PositionNotificationGroup) {
            return $this
                ->addUsingAlias(PositionPeer::POSITION_ID, $positionNotificationGroup->getPositionId(), $comparison);
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
     * @return PositionQuery The current query, for fluid interface
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
     * @param   Position $position Object to remove from the list of results
     *
     * @return PositionQuery The current query, for fluid interface
     */
    public function prune($position = null)
    {
        if ($position) {
            $this->addUsingAlias(PositionPeer::POSITION_ID, $position->getPositionId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
