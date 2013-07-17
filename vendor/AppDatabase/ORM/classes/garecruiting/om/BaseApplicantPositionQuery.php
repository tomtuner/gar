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
use GARecruitingORM\ApplicantPosition;
use GARecruitingORM\ApplicantPositionPeer;
use GARecruitingORM\ApplicantPositionQuery;
use GARecruitingORM\Position;

/**
 * Base class that represents a query for the 'applicant_position' table.
 *
 *
 *
 * @method ApplicantPositionQuery orderByApplicantId($order = Criteria::ASC) Order by the applicant_id column
 * @method ApplicantPositionQuery orderByPositionId($order = Criteria::ASC) Order by the position_id column
 *
 * @method ApplicantPositionQuery groupByApplicantId() Group by the applicant_id column
 * @method ApplicantPositionQuery groupByPositionId() Group by the position_id column
 *
 * @method ApplicantPositionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method ApplicantPositionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method ApplicantPositionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method ApplicantPositionQuery leftJoinApplicant($relationAlias = null) Adds a LEFT JOIN clause to the query using the Applicant relation
 * @method ApplicantPositionQuery rightJoinApplicant($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Applicant relation
 * @method ApplicantPositionQuery innerJoinApplicant($relationAlias = null) Adds a INNER JOIN clause to the query using the Applicant relation
 *
 * @method ApplicantPositionQuery leftJoinPosition($relationAlias = null) Adds a LEFT JOIN clause to the query using the Position relation
 * @method ApplicantPositionQuery rightJoinPosition($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Position relation
 * @method ApplicantPositionQuery innerJoinPosition($relationAlias = null) Adds a INNER JOIN clause to the query using the Position relation
 *
 * @method ApplicantPosition findOne(PropelPDO $con = null) Return the first ApplicantPosition matching the query
 * @method ApplicantPosition findOneOrCreate(PropelPDO $con = null) Return the first ApplicantPosition matching the query, or a new ApplicantPosition object populated from the query conditions when no match is found
 *
 * @method ApplicantPosition findOneByApplicantId(int $applicant_id) Return the first ApplicantPosition filtered by the applicant_id column
 * @method ApplicantPosition findOneByPositionId(int $position_id) Return the first ApplicantPosition filtered by the position_id column
 *
 * @method array findByApplicantId(int $applicant_id) Return ApplicantPosition objects filtered by the applicant_id column
 * @method array findByPositionId(int $position_id) Return ApplicantPosition objects filtered by the position_id column
 *
 * @package    propel.generator.garecruiting.om
 */
abstract class BaseApplicantPositionQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseApplicantPositionQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'ga_recruiting', $modelName = 'GARecruitingORM\\ApplicantPosition', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ApplicantPositionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     ApplicantPositionQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return ApplicantPositionQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ApplicantPositionQuery) {
            return $criteria;
        }
        $query = new ApplicantPositionQuery();
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
                         A Primary key composition: [$applicant_id, $position_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   ApplicantPosition|ApplicantPosition[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ApplicantPositionPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(ApplicantPositionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   ApplicantPosition A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `APPLICANT_ID`, `POSITION_ID` FROM `applicant_position` WHERE `APPLICANT_ID` = :p0 AND `POSITION_ID` = :p1';
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
            $obj = new ApplicantPosition();
            $obj->hydrate($row);
            ApplicantPositionPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ApplicantPosition|ApplicantPosition[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|ApplicantPosition[]|mixed the list of results, formatted by the current formatter
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
     * @return ApplicantPositionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(ApplicantPositionPeer::APPLICANT_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(ApplicantPositionPeer::POSITION_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ApplicantPositionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(ApplicantPositionPeer::APPLICANT_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(ApplicantPositionPeer::POSITION_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the applicant_id column
     *
     * Example usage:
     * <code>
     * $query->filterByApplicantId(1234); // WHERE applicant_id = 1234
     * $query->filterByApplicantId(array(12, 34)); // WHERE applicant_id IN (12, 34)
     * $query->filterByApplicantId(array('min' => 12)); // WHERE applicant_id > 12
     * </code>
     *
     * @see       filterByApplicant()
     *
     * @param     mixed $applicantId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ApplicantPositionQuery The current query, for fluid interface
     */
    public function filterByApplicantId($applicantId = null, $comparison = null)
    {
        if (is_array($applicantId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(ApplicantPositionPeer::APPLICANT_ID, $applicantId, $comparison);
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
     * @return ApplicantPositionQuery The current query, for fluid interface
     */
    public function filterByPositionId($positionId = null, $comparison = null)
    {
        if (is_array($positionId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(ApplicantPositionPeer::POSITION_ID, $positionId, $comparison);
    }

    /**
     * Filter the query by a related Applicant object
     *
     * @param   Applicant|PropelObjectCollection $applicant The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ApplicantPositionQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByApplicant($applicant, $comparison = null)
    {
        if ($applicant instanceof Applicant) {
            return $this
                ->addUsingAlias(ApplicantPositionPeer::APPLICANT_ID, $applicant->getApplicantId(), $comparison);
        } elseif ($applicant instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ApplicantPositionPeer::APPLICANT_ID, $applicant->toKeyValue('PrimaryKey', 'ApplicantId'), $comparison);
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
     * @return ApplicantPositionQuery The current query, for fluid interface
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
     * Filter the query by a related Position object
     *
     * @param   Position|PropelObjectCollection $position The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ApplicantPositionQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPosition($position, $comparison = null)
    {
        if ($position instanceof Position) {
            return $this
                ->addUsingAlias(ApplicantPositionPeer::POSITION_ID, $position->getPositionId(), $comparison);
        } elseif ($position instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ApplicantPositionPeer::POSITION_ID, $position->toKeyValue('PrimaryKey', 'PositionId'), $comparison);
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
     * @return ApplicantPositionQuery The current query, for fluid interface
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
     * @param   ApplicantPosition $applicantPosition Object to remove from the list of results
     *
     * @return ApplicantPositionQuery The current query, for fluid interface
     */
    public function prune($applicantPosition = null)
    {
        if ($applicantPosition) {
            $this->addCond('pruneCond0', $this->getAliasedColName(ApplicantPositionPeer::APPLICANT_ID), $applicantPosition->getApplicantId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(ApplicantPositionPeer::POSITION_ID), $applicantPosition->getPositionId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
