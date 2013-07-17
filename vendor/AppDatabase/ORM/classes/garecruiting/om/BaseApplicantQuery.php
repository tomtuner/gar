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
use GARecruitingORM\ApplicantPeer;
use GARecruitingORM\ApplicantPosition;
use GARecruitingORM\ApplicantQuery;
use GARecruitingORM\User;

/**
 * Base class that represents a query for the 'applicant' table.
 *
 *
 *
 * @method ApplicantQuery orderByApplicantId($order = Criteria::ASC) Order by the applicant_id column
 * @method ApplicantQuery orderByApplicantFirstName($order = Criteria::ASC) Order by the applicant_first_name column
 * @method ApplicantQuery orderByApplicantLastName($order = Criteria::ASC) Order by the applicant_last_name column
 * @method ApplicantQuery orderByApplicantEmailAddress($order = Criteria::ASC) Order by the applicant_email_address column
 * @method ApplicantQuery orderByApplicantTelephoneNumber($order = Criteria::ASC) Order by the applicant_telephone_number column
 * @method ApplicantQuery orderByApplicantAddressOne($order = Criteria::ASC) Order by the applicant_address_one column
 * @method ApplicantQuery orderByApplicantAddressTwo($order = Criteria::ASC) Order by the applicant_address_two column
 * @method ApplicantQuery orderByApplicantCity($order = Criteria::ASC) Order by the applicant_city column
 * @method ApplicantQuery orderByApplicantStateProvinceRegion($order = Criteria::ASC) Order by the applicant_state_province_region column
 * @method ApplicantQuery orderByApplicantZipPostalCode($order = Criteria::ASC) Order by the applicant_zip_postal_code column
 * @method ApplicantQuery orderByApplicantCountry($order = Criteria::ASC) Order by the applicant_country column
 * @method ApplicantQuery orderByApplicantUndergraduateInstitution($order = Criteria::ASC) Order by the applicant_undergraduate_institution column
 * @method ApplicantQuery orderByApplicantGraduateInstitution($order = Criteria::ASC) Order by the applicant_graduate_institution column
 * @method ApplicantQuery orderByApplicantGraduateProgram($order = Criteria::ASC) Order by the applicant_graduate_program column
 * @method ApplicantQuery orderByApplicantReferenceOne($order = Criteria::ASC) Order by the applicant_reference_one column
 * @method ApplicantQuery orderByApplicantReferenceTwo($order = Criteria::ASC) Order by the applicant_reference_two column
 * @method ApplicantQuery orderByApplicantReferenceThree($order = Criteria::ASC) Order by the applicant_reference_three column
 * @method ApplicantQuery orderByApplicantEssayPersonalQualities($order = Criteria::ASC) Order by the applicant_essay_personal_qualities column
 * @method ApplicantQuery orderByApplicantEssayPriorExperiences($order = Criteria::ASC) Order by the applicant_essay_prior_experiences column
 * @method ApplicantQuery orderByApplicantResumeCoverLetterAttachmentFileName($order = Criteria::ASC) Order by the applicant_resume_cover_letter_attachment_file_name column
 * @method ApplicantQuery orderByApplicantSubmissionDate($order = Criteria::ASC) Order by the applicant_submission_date column
 * @method ApplicantQuery orderByApplicantSubmissionLastUpdate($order = Criteria::ASC) Order by the applicant_submission_last_update column
 * @method ApplicantQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 *
 * @method ApplicantQuery groupByApplicantId() Group by the applicant_id column
 * @method ApplicantQuery groupByApplicantFirstName() Group by the applicant_first_name column
 * @method ApplicantQuery groupByApplicantLastName() Group by the applicant_last_name column
 * @method ApplicantQuery groupByApplicantEmailAddress() Group by the applicant_email_address column
 * @method ApplicantQuery groupByApplicantTelephoneNumber() Group by the applicant_telephone_number column
 * @method ApplicantQuery groupByApplicantAddressOne() Group by the applicant_address_one column
 * @method ApplicantQuery groupByApplicantAddressTwo() Group by the applicant_address_two column
 * @method ApplicantQuery groupByApplicantCity() Group by the applicant_city column
 * @method ApplicantQuery groupByApplicantStateProvinceRegion() Group by the applicant_state_province_region column
 * @method ApplicantQuery groupByApplicantZipPostalCode() Group by the applicant_zip_postal_code column
 * @method ApplicantQuery groupByApplicantCountry() Group by the applicant_country column
 * @method ApplicantQuery groupByApplicantUndergraduateInstitution() Group by the applicant_undergraduate_institution column
 * @method ApplicantQuery groupByApplicantGraduateInstitution() Group by the applicant_graduate_institution column
 * @method ApplicantQuery groupByApplicantGraduateProgram() Group by the applicant_graduate_program column
 * @method ApplicantQuery groupByApplicantReferenceOne() Group by the applicant_reference_one column
 * @method ApplicantQuery groupByApplicantReferenceTwo() Group by the applicant_reference_two column
 * @method ApplicantQuery groupByApplicantReferenceThree() Group by the applicant_reference_three column
 * @method ApplicantQuery groupByApplicantEssayPersonalQualities() Group by the applicant_essay_personal_qualities column
 * @method ApplicantQuery groupByApplicantEssayPriorExperiences() Group by the applicant_essay_prior_experiences column
 * @method ApplicantQuery groupByApplicantResumeCoverLetterAttachmentFileName() Group by the applicant_resume_cover_letter_attachment_file_name column
 * @method ApplicantQuery groupByApplicantSubmissionDate() Group by the applicant_submission_date column
 * @method ApplicantQuery groupByApplicantSubmissionLastUpdate() Group by the applicant_submission_last_update column
 * @method ApplicantQuery groupByUserId() Group by the user_id column
 *
 * @method ApplicantQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method ApplicantQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method ApplicantQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method ApplicantQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method ApplicantQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method ApplicantQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method ApplicantQuery leftJoinApplicantPosition($relationAlias = null) Adds a LEFT JOIN clause to the query using the ApplicantPosition relation
 * @method ApplicantQuery rightJoinApplicantPosition($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ApplicantPosition relation
 * @method ApplicantQuery innerJoinApplicantPosition($relationAlias = null) Adds a INNER JOIN clause to the query using the ApplicantPosition relation
 *
 * @method Applicant findOne(PropelPDO $con = null) Return the first Applicant matching the query
 * @method Applicant findOneOrCreate(PropelPDO $con = null) Return the first Applicant matching the query, or a new Applicant object populated from the query conditions when no match is found
 *
 * @method Applicant findOneByApplicantId(int $applicant_id) Return the first Applicant filtered by the applicant_id column
 * @method Applicant findOneByApplicantFirstName(string $applicant_first_name) Return the first Applicant filtered by the applicant_first_name column
 * @method Applicant findOneByApplicantLastName(string $applicant_last_name) Return the first Applicant filtered by the applicant_last_name column
 * @method Applicant findOneByApplicantEmailAddress(string $applicant_email_address) Return the first Applicant filtered by the applicant_email_address column
 * @method Applicant findOneByApplicantTelephoneNumber(string $applicant_telephone_number) Return the first Applicant filtered by the applicant_telephone_number column
 * @method Applicant findOneByApplicantAddressOne(string $applicant_address_one) Return the first Applicant filtered by the applicant_address_one column
 * @method Applicant findOneByApplicantAddressTwo(string $applicant_address_two) Return the first Applicant filtered by the applicant_address_two column
 * @method Applicant findOneByApplicantCity(string $applicant_city) Return the first Applicant filtered by the applicant_city column
 * @method Applicant findOneByApplicantStateProvinceRegion(string $applicant_state_province_region) Return the first Applicant filtered by the applicant_state_province_region column
 * @method Applicant findOneByApplicantZipPostalCode(string $applicant_zip_postal_code) Return the first Applicant filtered by the applicant_zip_postal_code column
 * @method Applicant findOneByApplicantCountry(string $applicant_country) Return the first Applicant filtered by the applicant_country column
 * @method Applicant findOneByApplicantUndergraduateInstitution(string $applicant_undergraduate_institution) Return the first Applicant filtered by the applicant_undergraduate_institution column
 * @method Applicant findOneByApplicantGraduateInstitution(string $applicant_graduate_institution) Return the first Applicant filtered by the applicant_graduate_institution column
 * @method Applicant findOneByApplicantGraduateProgram(string $applicant_graduate_program) Return the first Applicant filtered by the applicant_graduate_program column
 * @method Applicant findOneByApplicantReferenceOne(string $applicant_reference_one) Return the first Applicant filtered by the applicant_reference_one column
 * @method Applicant findOneByApplicantReferenceTwo(string $applicant_reference_two) Return the first Applicant filtered by the applicant_reference_two column
 * @method Applicant findOneByApplicantReferenceThree(string $applicant_reference_three) Return the first Applicant filtered by the applicant_reference_three column
 * @method Applicant findOneByApplicantEssayPersonalQualities(string $applicant_essay_personal_qualities) Return the first Applicant filtered by the applicant_essay_personal_qualities column
 * @method Applicant findOneByApplicantEssayPriorExperiences(string $applicant_essay_prior_experiences) Return the first Applicant filtered by the applicant_essay_prior_experiences column
 * @method Applicant findOneByApplicantResumeCoverLetterAttachmentFileName(string $applicant_resume_cover_letter_attachment_file_name) Return the first Applicant filtered by the applicant_resume_cover_letter_attachment_file_name column
 * @method Applicant findOneByApplicantSubmissionDate(string $applicant_submission_date) Return the first Applicant filtered by the applicant_submission_date column
 * @method Applicant findOneByApplicantSubmissionLastUpdate(string $applicant_submission_last_update) Return the first Applicant filtered by the applicant_submission_last_update column
 * @method Applicant findOneByUserId(int $user_id) Return the first Applicant filtered by the user_id column
 *
 * @method array findByApplicantId(int $applicant_id) Return Applicant objects filtered by the applicant_id column
 * @method array findByApplicantFirstName(string $applicant_first_name) Return Applicant objects filtered by the applicant_first_name column
 * @method array findByApplicantLastName(string $applicant_last_name) Return Applicant objects filtered by the applicant_last_name column
 * @method array findByApplicantEmailAddress(string $applicant_email_address) Return Applicant objects filtered by the applicant_email_address column
 * @method array findByApplicantTelephoneNumber(string $applicant_telephone_number) Return Applicant objects filtered by the applicant_telephone_number column
 * @method array findByApplicantAddressOne(string $applicant_address_one) Return Applicant objects filtered by the applicant_address_one column
 * @method array findByApplicantAddressTwo(string $applicant_address_two) Return Applicant objects filtered by the applicant_address_two column
 * @method array findByApplicantCity(string $applicant_city) Return Applicant objects filtered by the applicant_city column
 * @method array findByApplicantStateProvinceRegion(string $applicant_state_province_region) Return Applicant objects filtered by the applicant_state_province_region column
 * @method array findByApplicantZipPostalCode(string $applicant_zip_postal_code) Return Applicant objects filtered by the applicant_zip_postal_code column
 * @method array findByApplicantCountry(string $applicant_country) Return Applicant objects filtered by the applicant_country column
 * @method array findByApplicantUndergraduateInstitution(string $applicant_undergraduate_institution) Return Applicant objects filtered by the applicant_undergraduate_institution column
 * @method array findByApplicantGraduateInstitution(string $applicant_graduate_institution) Return Applicant objects filtered by the applicant_graduate_institution column
 * @method array findByApplicantGraduateProgram(string $applicant_graduate_program) Return Applicant objects filtered by the applicant_graduate_program column
 * @method array findByApplicantReferenceOne(string $applicant_reference_one) Return Applicant objects filtered by the applicant_reference_one column
 * @method array findByApplicantReferenceTwo(string $applicant_reference_two) Return Applicant objects filtered by the applicant_reference_two column
 * @method array findByApplicantReferenceThree(string $applicant_reference_three) Return Applicant objects filtered by the applicant_reference_three column
 * @method array findByApplicantEssayPersonalQualities(string $applicant_essay_personal_qualities) Return Applicant objects filtered by the applicant_essay_personal_qualities column
 * @method array findByApplicantEssayPriorExperiences(string $applicant_essay_prior_experiences) Return Applicant objects filtered by the applicant_essay_prior_experiences column
 * @method array findByApplicantResumeCoverLetterAttachmentFileName(string $applicant_resume_cover_letter_attachment_file_name) Return Applicant objects filtered by the applicant_resume_cover_letter_attachment_file_name column
 * @method array findByApplicantSubmissionDate(string $applicant_submission_date) Return Applicant objects filtered by the applicant_submission_date column
 * @method array findByApplicantSubmissionLastUpdate(string $applicant_submission_last_update) Return Applicant objects filtered by the applicant_submission_last_update column
 * @method array findByUserId(int $user_id) Return Applicant objects filtered by the user_id column
 *
 * @package    propel.generator.garecruiting.om
 */
abstract class BaseApplicantQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseApplicantQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'ga_recruiting', $modelName = 'GARecruitingORM\\Applicant', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ApplicantQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     ApplicantQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return ApplicantQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ApplicantQuery) {
            return $criteria;
        }
        $query = new ApplicantQuery();
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
     * @return   Applicant|Applicant[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ApplicantPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(ApplicantPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Applicant A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `APPLICANT_ID`, `APPLICANT_FIRST_NAME`, `APPLICANT_LAST_NAME`, `APPLICANT_EMAIL_ADDRESS`, `APPLICANT_TELEPHONE_NUMBER`, `APPLICANT_ADDRESS_ONE`, `APPLICANT_ADDRESS_TWO`, `APPLICANT_CITY`, `APPLICANT_STATE_PROVINCE_REGION`, `APPLICANT_ZIP_POSTAL_CODE`, `APPLICANT_COUNTRY`, `APPLICANT_UNDERGRADUATE_INSTITUTION`, `APPLICANT_GRADUATE_INSTITUTION`, `APPLICANT_GRADUATE_PROGRAM`, `APPLICANT_REFERENCE_ONE`, `APPLICANT_REFERENCE_TWO`, `APPLICANT_REFERENCE_THREE`, `APPLICANT_ESSAY_PERSONAL_QUALITIES`, `APPLICANT_ESSAY_PRIOR_EXPERIENCES`, `APPLICANT_RESUME_COVER_LETTER_ATTACHMENT_FILE_NAME`, `APPLICANT_SUBMISSION_DATE`, `APPLICANT_SUBMISSION_LAST_UPDATE`, `USER_ID` FROM `applicant` WHERE `APPLICANT_ID` = :p0';
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
            $obj = new Applicant();
            $obj->hydrate($row);
            ApplicantPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Applicant|Applicant[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Applicant[]|mixed the list of results, formatted by the current formatter
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
     * @return ApplicantQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ApplicantPeer::APPLICANT_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ApplicantQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ApplicantPeer::APPLICANT_ID, $keys, Criteria::IN);
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
     * @param     mixed $applicantId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ApplicantQuery The current query, for fluid interface
     */
    public function filterByApplicantId($applicantId = null, $comparison = null)
    {
        if (is_array($applicantId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(ApplicantPeer::APPLICANT_ID, $applicantId, $comparison);
    }

    /**
     * Filter the query on the applicant_first_name column
     *
     * Example usage:
     * <code>
     * $query->filterByApplicantFirstName('fooValue');   // WHERE applicant_first_name = 'fooValue'
     * $query->filterByApplicantFirstName('%fooValue%'); // WHERE applicant_first_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $applicantFirstName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ApplicantQuery The current query, for fluid interface
     */
    public function filterByApplicantFirstName($applicantFirstName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($applicantFirstName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $applicantFirstName)) {
                $applicantFirstName = str_replace('*', '%', $applicantFirstName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ApplicantPeer::APPLICANT_FIRST_NAME, $applicantFirstName, $comparison);
    }

    /**
     * Filter the query on the applicant_last_name column
     *
     * Example usage:
     * <code>
     * $query->filterByApplicantLastName('fooValue');   // WHERE applicant_last_name = 'fooValue'
     * $query->filterByApplicantLastName('%fooValue%'); // WHERE applicant_last_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $applicantLastName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ApplicantQuery The current query, for fluid interface
     */
    public function filterByApplicantLastName($applicantLastName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($applicantLastName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $applicantLastName)) {
                $applicantLastName = str_replace('*', '%', $applicantLastName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ApplicantPeer::APPLICANT_LAST_NAME, $applicantLastName, $comparison);
    }

    /**
     * Filter the query on the applicant_email_address column
     *
     * Example usage:
     * <code>
     * $query->filterByApplicantEmailAddress('fooValue');   // WHERE applicant_email_address = 'fooValue'
     * $query->filterByApplicantEmailAddress('%fooValue%'); // WHERE applicant_email_address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $applicantEmailAddress The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ApplicantQuery The current query, for fluid interface
     */
    public function filterByApplicantEmailAddress($applicantEmailAddress = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($applicantEmailAddress)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $applicantEmailAddress)) {
                $applicantEmailAddress = str_replace('*', '%', $applicantEmailAddress);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ApplicantPeer::APPLICANT_EMAIL_ADDRESS, $applicantEmailAddress, $comparison);
    }

    /**
     * Filter the query on the applicant_telephone_number column
     *
     * Example usage:
     * <code>
     * $query->filterByApplicantTelephoneNumber('fooValue');   // WHERE applicant_telephone_number = 'fooValue'
     * $query->filterByApplicantTelephoneNumber('%fooValue%'); // WHERE applicant_telephone_number LIKE '%fooValue%'
     * </code>
     *
     * @param     string $applicantTelephoneNumber The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ApplicantQuery The current query, for fluid interface
     */
    public function filterByApplicantTelephoneNumber($applicantTelephoneNumber = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($applicantTelephoneNumber)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $applicantTelephoneNumber)) {
                $applicantTelephoneNumber = str_replace('*', '%', $applicantTelephoneNumber);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ApplicantPeer::APPLICANT_TELEPHONE_NUMBER, $applicantTelephoneNumber, $comparison);
    }

    /**
     * Filter the query on the applicant_address_one column
     *
     * Example usage:
     * <code>
     * $query->filterByApplicantAddressOne('fooValue');   // WHERE applicant_address_one = 'fooValue'
     * $query->filterByApplicantAddressOne('%fooValue%'); // WHERE applicant_address_one LIKE '%fooValue%'
     * </code>
     *
     * @param     string $applicantAddressOne The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ApplicantQuery The current query, for fluid interface
     */
    public function filterByApplicantAddressOne($applicantAddressOne = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($applicantAddressOne)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $applicantAddressOne)) {
                $applicantAddressOne = str_replace('*', '%', $applicantAddressOne);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ApplicantPeer::APPLICANT_ADDRESS_ONE, $applicantAddressOne, $comparison);
    }

    /**
     * Filter the query on the applicant_address_two column
     *
     * Example usage:
     * <code>
     * $query->filterByApplicantAddressTwo('fooValue');   // WHERE applicant_address_two = 'fooValue'
     * $query->filterByApplicantAddressTwo('%fooValue%'); // WHERE applicant_address_two LIKE '%fooValue%'
     * </code>
     *
     * @param     string $applicantAddressTwo The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ApplicantQuery The current query, for fluid interface
     */
    public function filterByApplicantAddressTwo($applicantAddressTwo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($applicantAddressTwo)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $applicantAddressTwo)) {
                $applicantAddressTwo = str_replace('*', '%', $applicantAddressTwo);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ApplicantPeer::APPLICANT_ADDRESS_TWO, $applicantAddressTwo, $comparison);
    }

    /**
     * Filter the query on the applicant_city column
     *
     * Example usage:
     * <code>
     * $query->filterByApplicantCity('fooValue');   // WHERE applicant_city = 'fooValue'
     * $query->filterByApplicantCity('%fooValue%'); // WHERE applicant_city LIKE '%fooValue%'
     * </code>
     *
     * @param     string $applicantCity The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ApplicantQuery The current query, for fluid interface
     */
    public function filterByApplicantCity($applicantCity = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($applicantCity)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $applicantCity)) {
                $applicantCity = str_replace('*', '%', $applicantCity);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ApplicantPeer::APPLICANT_CITY, $applicantCity, $comparison);
    }

    /**
     * Filter the query on the applicant_state_province_region column
     *
     * Example usage:
     * <code>
     * $query->filterByApplicantStateProvinceRegion('fooValue');   // WHERE applicant_state_province_region = 'fooValue'
     * $query->filterByApplicantStateProvinceRegion('%fooValue%'); // WHERE applicant_state_province_region LIKE '%fooValue%'
     * </code>
     *
     * @param     string $applicantStateProvinceRegion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ApplicantQuery The current query, for fluid interface
     */
    public function filterByApplicantStateProvinceRegion($applicantStateProvinceRegion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($applicantStateProvinceRegion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $applicantStateProvinceRegion)) {
                $applicantStateProvinceRegion = str_replace('*', '%', $applicantStateProvinceRegion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ApplicantPeer::APPLICANT_STATE_PROVINCE_REGION, $applicantStateProvinceRegion, $comparison);
    }

    /**
     * Filter the query on the applicant_zip_postal_code column
     *
     * Example usage:
     * <code>
     * $query->filterByApplicantZipPostalCode('fooValue');   // WHERE applicant_zip_postal_code = 'fooValue'
     * $query->filterByApplicantZipPostalCode('%fooValue%'); // WHERE applicant_zip_postal_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $applicantZipPostalCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ApplicantQuery The current query, for fluid interface
     */
    public function filterByApplicantZipPostalCode($applicantZipPostalCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($applicantZipPostalCode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $applicantZipPostalCode)) {
                $applicantZipPostalCode = str_replace('*', '%', $applicantZipPostalCode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ApplicantPeer::APPLICANT_ZIP_POSTAL_CODE, $applicantZipPostalCode, $comparison);
    }

    /**
     * Filter the query on the applicant_country column
     *
     * Example usage:
     * <code>
     * $query->filterByApplicantCountry('fooValue');   // WHERE applicant_country = 'fooValue'
     * $query->filterByApplicantCountry('%fooValue%'); // WHERE applicant_country LIKE '%fooValue%'
     * </code>
     *
     * @param     string $applicantCountry The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ApplicantQuery The current query, for fluid interface
     */
    public function filterByApplicantCountry($applicantCountry = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($applicantCountry)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $applicantCountry)) {
                $applicantCountry = str_replace('*', '%', $applicantCountry);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ApplicantPeer::APPLICANT_COUNTRY, $applicantCountry, $comparison);
    }

    /**
     * Filter the query on the applicant_undergraduate_institution column
     *
     * Example usage:
     * <code>
     * $query->filterByApplicantUndergraduateInstitution('fooValue');   // WHERE applicant_undergraduate_institution = 'fooValue'
     * $query->filterByApplicantUndergraduateInstitution('%fooValue%'); // WHERE applicant_undergraduate_institution LIKE '%fooValue%'
     * </code>
     *
     * @param     string $applicantUndergraduateInstitution The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ApplicantQuery The current query, for fluid interface
     */
    public function filterByApplicantUndergraduateInstitution($applicantUndergraduateInstitution = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($applicantUndergraduateInstitution)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $applicantUndergraduateInstitution)) {
                $applicantUndergraduateInstitution = str_replace('*', '%', $applicantUndergraduateInstitution);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ApplicantPeer::APPLICANT_UNDERGRADUATE_INSTITUTION, $applicantUndergraduateInstitution, $comparison);
    }

    /**
     * Filter the query on the applicant_graduate_institution column
     *
     * Example usage:
     * <code>
     * $query->filterByApplicantGraduateInstitution('fooValue');   // WHERE applicant_graduate_institution = 'fooValue'
     * $query->filterByApplicantGraduateInstitution('%fooValue%'); // WHERE applicant_graduate_institution LIKE '%fooValue%'
     * </code>
     *
     * @param     string $applicantGraduateInstitution The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ApplicantQuery The current query, for fluid interface
     */
    public function filterByApplicantGraduateInstitution($applicantGraduateInstitution = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($applicantGraduateInstitution)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $applicantGraduateInstitution)) {
                $applicantGraduateInstitution = str_replace('*', '%', $applicantGraduateInstitution);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ApplicantPeer::APPLICANT_GRADUATE_INSTITUTION, $applicantGraduateInstitution, $comparison);
    }

    /**
     * Filter the query on the applicant_graduate_program column
     *
     * Example usage:
     * <code>
     * $query->filterByApplicantGraduateProgram('fooValue');   // WHERE applicant_graduate_program = 'fooValue'
     * $query->filterByApplicantGraduateProgram('%fooValue%'); // WHERE applicant_graduate_program LIKE '%fooValue%'
     * </code>
     *
     * @param     string $applicantGraduateProgram The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ApplicantQuery The current query, for fluid interface
     */
    public function filterByApplicantGraduateProgram($applicantGraduateProgram = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($applicantGraduateProgram)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $applicantGraduateProgram)) {
                $applicantGraduateProgram = str_replace('*', '%', $applicantGraduateProgram);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ApplicantPeer::APPLICANT_GRADUATE_PROGRAM, $applicantGraduateProgram, $comparison);
    }

    /**
     * Filter the query on the applicant_reference_one column
     *
     * Example usage:
     * <code>
     * $query->filterByApplicantReferenceOne('fooValue');   // WHERE applicant_reference_one = 'fooValue'
     * $query->filterByApplicantReferenceOne('%fooValue%'); // WHERE applicant_reference_one LIKE '%fooValue%'
     * </code>
     *
     * @param     string $applicantReferenceOne The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ApplicantQuery The current query, for fluid interface
     */
    public function filterByApplicantReferenceOne($applicantReferenceOne = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($applicantReferenceOne)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $applicantReferenceOne)) {
                $applicantReferenceOne = str_replace('*', '%', $applicantReferenceOne);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ApplicantPeer::APPLICANT_REFERENCE_ONE, $applicantReferenceOne, $comparison);
    }

    /**
     * Filter the query on the applicant_reference_two column
     *
     * Example usage:
     * <code>
     * $query->filterByApplicantReferenceTwo('fooValue');   // WHERE applicant_reference_two = 'fooValue'
     * $query->filterByApplicantReferenceTwo('%fooValue%'); // WHERE applicant_reference_two LIKE '%fooValue%'
     * </code>
     *
     * @param     string $applicantReferenceTwo The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ApplicantQuery The current query, for fluid interface
     */
    public function filterByApplicantReferenceTwo($applicantReferenceTwo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($applicantReferenceTwo)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $applicantReferenceTwo)) {
                $applicantReferenceTwo = str_replace('*', '%', $applicantReferenceTwo);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ApplicantPeer::APPLICANT_REFERENCE_TWO, $applicantReferenceTwo, $comparison);
    }

    /**
     * Filter the query on the applicant_reference_three column
     *
     * Example usage:
     * <code>
     * $query->filterByApplicantReferenceThree('fooValue');   // WHERE applicant_reference_three = 'fooValue'
     * $query->filterByApplicantReferenceThree('%fooValue%'); // WHERE applicant_reference_three LIKE '%fooValue%'
     * </code>
     *
     * @param     string $applicantReferenceThree The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ApplicantQuery The current query, for fluid interface
     */
    public function filterByApplicantReferenceThree($applicantReferenceThree = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($applicantReferenceThree)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $applicantReferenceThree)) {
                $applicantReferenceThree = str_replace('*', '%', $applicantReferenceThree);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ApplicantPeer::APPLICANT_REFERENCE_THREE, $applicantReferenceThree, $comparison);
    }

    /**
     * Filter the query on the applicant_essay_personal_qualities column
     *
     * Example usage:
     * <code>
     * $query->filterByApplicantEssayPersonalQualities('fooValue');   // WHERE applicant_essay_personal_qualities = 'fooValue'
     * $query->filterByApplicantEssayPersonalQualities('%fooValue%'); // WHERE applicant_essay_personal_qualities LIKE '%fooValue%'
     * </code>
     *
     * @param     string $applicantEssayPersonalQualities The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ApplicantQuery The current query, for fluid interface
     */
    public function filterByApplicantEssayPersonalQualities($applicantEssayPersonalQualities = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($applicantEssayPersonalQualities)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $applicantEssayPersonalQualities)) {
                $applicantEssayPersonalQualities = str_replace('*', '%', $applicantEssayPersonalQualities);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ApplicantPeer::APPLICANT_ESSAY_PERSONAL_QUALITIES, $applicantEssayPersonalQualities, $comparison);
    }

    /**
     * Filter the query on the applicant_essay_prior_experiences column
     *
     * Example usage:
     * <code>
     * $query->filterByApplicantEssayPriorExperiences('fooValue');   // WHERE applicant_essay_prior_experiences = 'fooValue'
     * $query->filterByApplicantEssayPriorExperiences('%fooValue%'); // WHERE applicant_essay_prior_experiences LIKE '%fooValue%'
     * </code>
     *
     * @param     string $applicantEssayPriorExperiences The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ApplicantQuery The current query, for fluid interface
     */
    public function filterByApplicantEssayPriorExperiences($applicantEssayPriorExperiences = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($applicantEssayPriorExperiences)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $applicantEssayPriorExperiences)) {
                $applicantEssayPriorExperiences = str_replace('*', '%', $applicantEssayPriorExperiences);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ApplicantPeer::APPLICANT_ESSAY_PRIOR_EXPERIENCES, $applicantEssayPriorExperiences, $comparison);
    }

    /**
     * Filter the query on the applicant_resume_cover_letter_attachment_file_name column
     *
     * Example usage:
     * <code>
     * $query->filterByApplicantResumeCoverLetterAttachmentFileName('fooValue');   // WHERE applicant_resume_cover_letter_attachment_file_name = 'fooValue'
     * $query->filterByApplicantResumeCoverLetterAttachmentFileName('%fooValue%'); // WHERE applicant_resume_cover_letter_attachment_file_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $applicantResumeCoverLetterAttachmentFileName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ApplicantQuery The current query, for fluid interface
     */
    public function filterByApplicantResumeCoverLetterAttachmentFileName($applicantResumeCoverLetterAttachmentFileName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($applicantResumeCoverLetterAttachmentFileName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $applicantResumeCoverLetterAttachmentFileName)) {
                $applicantResumeCoverLetterAttachmentFileName = str_replace('*', '%', $applicantResumeCoverLetterAttachmentFileName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ApplicantPeer::APPLICANT_RESUME_COVER_LETTER_ATTACHMENT_FILE_NAME, $applicantResumeCoverLetterAttachmentFileName, $comparison);
    }

    /**
     * Filter the query on the applicant_submission_date column
     *
     * Example usage:
     * <code>
     * $query->filterByApplicantSubmissionDate('2011-03-14'); // WHERE applicant_submission_date = '2011-03-14'
     * $query->filterByApplicantSubmissionDate('now'); // WHERE applicant_submission_date = '2011-03-14'
     * $query->filterByApplicantSubmissionDate(array('max' => 'yesterday')); // WHERE applicant_submission_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $applicantSubmissionDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ApplicantQuery The current query, for fluid interface
     */
    public function filterByApplicantSubmissionDate($applicantSubmissionDate = null, $comparison = null)
    {
        if (is_array($applicantSubmissionDate)) {
            $useMinMax = false;
            if (isset($applicantSubmissionDate['min'])) {
                $this->addUsingAlias(ApplicantPeer::APPLICANT_SUBMISSION_DATE, $applicantSubmissionDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($applicantSubmissionDate['max'])) {
                $this->addUsingAlias(ApplicantPeer::APPLICANT_SUBMISSION_DATE, $applicantSubmissionDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ApplicantPeer::APPLICANT_SUBMISSION_DATE, $applicantSubmissionDate, $comparison);
    }

    /**
     * Filter the query on the applicant_submission_last_update column
     *
     * Example usage:
     * <code>
     * $query->filterByApplicantSubmissionLastUpdate('2011-03-14'); // WHERE applicant_submission_last_update = '2011-03-14'
     * $query->filterByApplicantSubmissionLastUpdate('now'); // WHERE applicant_submission_last_update = '2011-03-14'
     * $query->filterByApplicantSubmissionLastUpdate(array('max' => 'yesterday')); // WHERE applicant_submission_last_update > '2011-03-13'
     * </code>
     *
     * @param     mixed $applicantSubmissionLastUpdate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ApplicantQuery The current query, for fluid interface
     */
    public function filterByApplicantSubmissionLastUpdate($applicantSubmissionLastUpdate = null, $comparison = null)
    {
        if (is_array($applicantSubmissionLastUpdate)) {
            $useMinMax = false;
            if (isset($applicantSubmissionLastUpdate['min'])) {
                $this->addUsingAlias(ApplicantPeer::APPLICANT_SUBMISSION_LAST_UPDATE, $applicantSubmissionLastUpdate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($applicantSubmissionLastUpdate['max'])) {
                $this->addUsingAlias(ApplicantPeer::APPLICANT_SUBMISSION_LAST_UPDATE, $applicantSubmissionLastUpdate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ApplicantPeer::APPLICANT_SUBMISSION_LAST_UPDATE, $applicantSubmissionLastUpdate, $comparison);
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
     * @return ApplicantQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(ApplicantPeer::USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(ApplicantPeer::USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ApplicantPeer::USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query by a related User object
     *
     * @param   User|PropelObjectCollection $user The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ApplicantQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(ApplicantPeer::USER_ID, $user->getUserId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ApplicantPeer::USER_ID, $user->toKeyValue('PrimaryKey', 'UserId'), $comparison);
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
     * @return ApplicantQuery The current query, for fluid interface
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
        if ($relationAlias) {
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
     * @return   \GARecruitingORM\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'User', '\GARecruitingORM\UserQuery');
    }

    /**
     * Filter the query by a related ApplicantPosition object
     *
     * @param   ApplicantPosition|PropelObjectCollection $applicantPosition  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ApplicantQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByApplicantPosition($applicantPosition, $comparison = null)
    {
        if ($applicantPosition instanceof ApplicantPosition) {
            return $this
                ->addUsingAlias(ApplicantPeer::APPLICANT_ID, $applicantPosition->getApplicantId(), $comparison);
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
     * @return ApplicantQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   Applicant $applicant Object to remove from the list of results
     *
     * @return ApplicantQuery The current query, for fluid interface
     */
    public function prune($applicant = null)
    {
        if ($applicant) {
            $this->addUsingAlias(ApplicantPeer::APPLICANT_ID, $applicant->getApplicantId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
