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
use ORMModel\ArtRequestDocument;
use ORMModel\ArtRequestDocumentPeer;
use ORMModel\ArtRequestDocumentQuery;

/**
 * Base class that represents a query for the 'art_request_document' table.
 *
 * 
 *
 * @method     ArtRequestDocumentQuery orderByArtRequestDocumentId($order = Criteria::ASC) Order by the art_request_document_id column
 * @method     ArtRequestDocumentQuery orderByArtRequestId($order = Criteria::ASC) Order by the art_request_id column
 * @method     ArtRequestDocumentQuery orderByFileName($order = Criteria::ASC) Order by the file_name column
 * @method     ArtRequestDocumentQuery orderByFileDescription($order = Criteria::ASC) Order by the file_description column
 * @method     ArtRequestDocumentQuery orderByExtensionType($order = Criteria::ASC) Order by the extension_type column
 *
 * @method     ArtRequestDocumentQuery groupByArtRequestDocumentId() Group by the art_request_document_id column
 * @method     ArtRequestDocumentQuery groupByArtRequestId() Group by the art_request_id column
 * @method     ArtRequestDocumentQuery groupByFileName() Group by the file_name column
 * @method     ArtRequestDocumentQuery groupByFileDescription() Group by the file_description column
 * @method     ArtRequestDocumentQuery groupByExtensionType() Group by the extension_type column
 *
 * @method     ArtRequestDocumentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ArtRequestDocumentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ArtRequestDocumentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ArtRequestDocumentQuery leftJoinArtRequest($relationAlias = null) Adds a LEFT JOIN clause to the query using the ArtRequest relation
 * @method     ArtRequestDocumentQuery rightJoinArtRequest($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ArtRequest relation
 * @method     ArtRequestDocumentQuery innerJoinArtRequest($relationAlias = null) Adds a INNER JOIN clause to the query using the ArtRequest relation
 *
 * @method     ArtRequestDocument findOne(PropelPDO $con = null) Return the first ArtRequestDocument matching the query
 * @method     ArtRequestDocument findOneOrCreate(PropelPDO $con = null) Return the first ArtRequestDocument matching the query, or a new ArtRequestDocument object populated from the query conditions when no match is found
 *
 * @method     ArtRequestDocument findOneByArtRequestDocumentId(int $art_request_document_id) Return the first ArtRequestDocument filtered by the art_request_document_id column
 * @method     ArtRequestDocument findOneByArtRequestId(int $art_request_id) Return the first ArtRequestDocument filtered by the art_request_id column
 * @method     ArtRequestDocument findOneByFileName(string $file_name) Return the first ArtRequestDocument filtered by the file_name column
 * @method     ArtRequestDocument findOneByFileDescription(string $file_description) Return the first ArtRequestDocument filtered by the file_description column
 * @method     ArtRequestDocument findOneByExtensionType(string $extension_type) Return the first ArtRequestDocument filtered by the extension_type column
 *
 * @method     array findByArtRequestDocumentId(int $art_request_document_id) Return ArtRequestDocument objects filtered by the art_request_document_id column
 * @method     array findByArtRequestId(int $art_request_id) Return ArtRequestDocument objects filtered by the art_request_id column
 * @method     array findByFileName(string $file_name) Return ArtRequestDocument objects filtered by the file_name column
 * @method     array findByFileDescription(string $file_description) Return ArtRequestDocument objects filtered by the file_description column
 * @method     array findByExtensionType(string $extension_type) Return ArtRequestDocument objects filtered by the extension_type column
 *
 * @package    propel.generator.orm.om
 */
abstract class BaseArtRequestDocumentQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseArtRequestDocumentQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'orm', $modelName = 'ORMModel\\ArtRequestDocument', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new ArtRequestDocumentQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    ArtRequestDocumentQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof ArtRequestDocumentQuery) {
			return $criteria;
		}
		$query = new ArtRequestDocumentQuery();
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
	 * @return    ArtRequestDocument|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = ArtRequestDocumentPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(ArtRequestDocumentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    ArtRequestDocument A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ART_REQUEST_DOCUMENT_ID`, `ART_REQUEST_ID`, `FILE_NAME`, `FILE_DESCRIPTION`, `EXTENSION_TYPE` FROM `art_request_document` WHERE `ART_REQUEST_DOCUMENT_ID` = :p0';
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
			$obj = new ArtRequestDocument();
			$obj->hydrate($row);
			ArtRequestDocumentPeer::addInstanceToPool($obj, (string) $key);
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
	 * @return    ArtRequestDocument|array|mixed the result, formatted by the current formatter
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
	 * @return    ArtRequestDocumentQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(ArtRequestDocumentPeer::ART_REQUEST_DOCUMENT_ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    ArtRequestDocumentQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(ArtRequestDocumentPeer::ART_REQUEST_DOCUMENT_ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the art_request_document_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByArtRequestDocumentId(1234); // WHERE art_request_document_id = 1234
	 * $query->filterByArtRequestDocumentId(array(12, 34)); // WHERE art_request_document_id IN (12, 34)
	 * $query->filterByArtRequestDocumentId(array('min' => 12)); // WHERE art_request_document_id > 12
	 * </code>
	 *
	 * @param     mixed $artRequestDocumentId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestDocumentQuery The current query, for fluid interface
	 */
	public function filterByArtRequestDocumentId($artRequestDocumentId = null, $comparison = null)
	{
		if (is_array($artRequestDocumentId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(ArtRequestDocumentPeer::ART_REQUEST_DOCUMENT_ID, $artRequestDocumentId, $comparison);
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
	 * @return    ArtRequestDocumentQuery The current query, for fluid interface
	 */
	public function filterByArtRequestId($artRequestId = null, $comparison = null)
	{
		if (is_array($artRequestId)) {
			$useMinMax = false;
			if (isset($artRequestId['min'])) {
				$this->addUsingAlias(ArtRequestDocumentPeer::ART_REQUEST_ID, $artRequestId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($artRequestId['max'])) {
				$this->addUsingAlias(ArtRequestDocumentPeer::ART_REQUEST_ID, $artRequestId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ArtRequestDocumentPeer::ART_REQUEST_ID, $artRequestId, $comparison);
	}

	/**
	 * Filter the query on the file_name column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByFileName('fooValue');   // WHERE file_name = 'fooValue'
	 * $query->filterByFileName('%fooValue%'); // WHERE file_name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $fileName The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestDocumentQuery The current query, for fluid interface
	 */
	public function filterByFileName($fileName = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($fileName)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $fileName)) {
				$fileName = str_replace('*', '%', $fileName);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ArtRequestDocumentPeer::FILE_NAME, $fileName, $comparison);
	}

	/**
	 * Filter the query on the file_description column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByFileDescription('fooValue');   // WHERE file_description = 'fooValue'
	 * $query->filterByFileDescription('%fooValue%'); // WHERE file_description LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $fileDescription The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestDocumentQuery The current query, for fluid interface
	 */
	public function filterByFileDescription($fileDescription = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($fileDescription)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $fileDescription)) {
				$fileDescription = str_replace('*', '%', $fileDescription);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ArtRequestDocumentPeer::FILE_DESCRIPTION, $fileDescription, $comparison);
	}

	/**
	 * Filter the query on the extension_type column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByExtensionType('fooValue');   // WHERE extension_type = 'fooValue'
	 * $query->filterByExtensionType('%fooValue%'); // WHERE extension_type LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $extensionType The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestDocumentQuery The current query, for fluid interface
	 */
	public function filterByExtensionType($extensionType = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($extensionType)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $extensionType)) {
				$extensionType = str_replace('*', '%', $extensionType);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ArtRequestDocumentPeer::EXTENSION_TYPE, $extensionType, $comparison);
	}

	/**
	 * Filter the query by a related ArtRequest object
	 *
	 * @param     ArtRequest|PropelCollection $artRequest The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArtRequestDocumentQuery The current query, for fluid interface
	 */
	public function filterByArtRequest($artRequest, $comparison = null)
	{
		if ($artRequest instanceof ArtRequest) {
			return $this
				->addUsingAlias(ArtRequestDocumentPeer::ART_REQUEST_ID, $artRequest->getArtRequestId(), $comparison);
		} elseif ($artRequest instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(ArtRequestDocumentPeer::ART_REQUEST_ID, $artRequest->toKeyValue('PrimaryKey', 'ArtRequestId'), $comparison);
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
	 * @return    ArtRequestDocumentQuery The current query, for fluid interface
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
	 * @param     ArtRequestDocument $artRequestDocument Object to remove from the list of results
	 *
	 * @return    ArtRequestDocumentQuery The current query, for fluid interface
	 */
	public function prune($artRequestDocument = null)
	{
		if ($artRequestDocument) {
			$this->addUsingAlias(ArtRequestDocumentPeer::ART_REQUEST_DOCUMENT_ID, $artRequestDocument->getArtRequestDocumentId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseArtRequestDocumentQuery