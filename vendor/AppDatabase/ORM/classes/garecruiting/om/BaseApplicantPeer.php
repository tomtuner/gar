<?php

namespace GARecruitingORM\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use GARecruitingORM\Applicant;
use GARecruitingORM\ApplicantPeer;
use GARecruitingORM\ApplicantPositionPeer;
use GARecruitingORM\UserPeer;
use GARecruitingORM\map\ApplicantTableMap;

/**
 * Base static class for performing query and update operations on the 'applicant' table.
 *
 *
 *
 * @package propel.generator.garecruiting.om
 */
abstract class BaseApplicantPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'ga_recruiting';

    /** the table name for this class */
    const TABLE_NAME = 'applicant';

    /** the related Propel class for this table */
    const OM_CLASS = 'GARecruitingORM\\Applicant';

    /** the related TableMap class for this table */
    const TM_CLASS = 'ApplicantTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 23;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 23;

    /** the column name for the APPLICANT_ID field */
    const APPLICANT_ID = 'applicant.APPLICANT_ID';

    /** the column name for the APPLICANT_FIRST_NAME field */
    const APPLICANT_FIRST_NAME = 'applicant.APPLICANT_FIRST_NAME';

    /** the column name for the APPLICANT_LAST_NAME field */
    const APPLICANT_LAST_NAME = 'applicant.APPLICANT_LAST_NAME';

    /** the column name for the APPLICANT_EMAIL_ADDRESS field */
    const APPLICANT_EMAIL_ADDRESS = 'applicant.APPLICANT_EMAIL_ADDRESS';

    /** the column name for the APPLICANT_TELEPHONE_NUMBER field */
    const APPLICANT_TELEPHONE_NUMBER = 'applicant.APPLICANT_TELEPHONE_NUMBER';

    /** the column name for the APPLICANT_ADDRESS_ONE field */
    const APPLICANT_ADDRESS_ONE = 'applicant.APPLICANT_ADDRESS_ONE';

    /** the column name for the APPLICANT_ADDRESS_TWO field */
    const APPLICANT_ADDRESS_TWO = 'applicant.APPLICANT_ADDRESS_TWO';

    /** the column name for the APPLICANT_CITY field */
    const APPLICANT_CITY = 'applicant.APPLICANT_CITY';

    /** the column name for the APPLICANT_STATE_PROVINCE_REGION field */
    const APPLICANT_STATE_PROVINCE_REGION = 'applicant.APPLICANT_STATE_PROVINCE_REGION';

    /** the column name for the APPLICANT_ZIP_POSTAL_CODE field */
    const APPLICANT_ZIP_POSTAL_CODE = 'applicant.APPLICANT_ZIP_POSTAL_CODE';

    /** the column name for the APPLICANT_COUNTRY field */
    const APPLICANT_COUNTRY = 'applicant.APPLICANT_COUNTRY';

    /** the column name for the APPLICANT_UNDERGRADUATE_INSTITUTION field */
    const APPLICANT_UNDERGRADUATE_INSTITUTION = 'applicant.APPLICANT_UNDERGRADUATE_INSTITUTION';

    /** the column name for the APPLICANT_GRADUATE_INSTITUTION field */
    const APPLICANT_GRADUATE_INSTITUTION = 'applicant.APPLICANT_GRADUATE_INSTITUTION';

    /** the column name for the APPLICANT_GRADUATE_PROGRAM field */
    const APPLICANT_GRADUATE_PROGRAM = 'applicant.APPLICANT_GRADUATE_PROGRAM';

    /** the column name for the APPLICANT_REFERENCE_ONE field */
    const APPLICANT_REFERENCE_ONE = 'applicant.APPLICANT_REFERENCE_ONE';

    /** the column name for the APPLICANT_REFERENCE_TWO field */
    const APPLICANT_REFERENCE_TWO = 'applicant.APPLICANT_REFERENCE_TWO';

    /** the column name for the APPLICANT_REFERENCE_THREE field */
    const APPLICANT_REFERENCE_THREE = 'applicant.APPLICANT_REFERENCE_THREE';

    /** the column name for the APPLICANT_ESSAY_PERSONAL_QUALITIES field */
    const APPLICANT_ESSAY_PERSONAL_QUALITIES = 'applicant.APPLICANT_ESSAY_PERSONAL_QUALITIES';

    /** the column name for the APPLICANT_ESSAY_PRIOR_EXPERIENCES field */
    const APPLICANT_ESSAY_PRIOR_EXPERIENCES = 'applicant.APPLICANT_ESSAY_PRIOR_EXPERIENCES';

    /** the column name for the APPLICANT_RESUME_COVER_LETTER_ATTACHMENT_FILE_NAME field */
    const APPLICANT_RESUME_COVER_LETTER_ATTACHMENT_FILE_NAME = 'applicant.APPLICANT_RESUME_COVER_LETTER_ATTACHMENT_FILE_NAME';

    /** the column name for the APPLICANT_SUBMISSION_DATE field */
    const APPLICANT_SUBMISSION_DATE = 'applicant.APPLICANT_SUBMISSION_DATE';

    /** the column name for the APPLICANT_SUBMISSION_LAST_UPDATE field */
    const APPLICANT_SUBMISSION_LAST_UPDATE = 'applicant.APPLICANT_SUBMISSION_LAST_UPDATE';

    /** the column name for the USER_ID field */
    const USER_ID = 'applicant.USER_ID';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of Applicant objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array Applicant[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. ApplicantPeer::$fieldNames[ApplicantPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('ApplicantId', 'ApplicantFirstName', 'ApplicantLastName', 'ApplicantEmailAddress', 'ApplicantTelephoneNumber', 'ApplicantAddressOne', 'ApplicantAddressTwo', 'ApplicantCity', 'ApplicantStateProvinceRegion', 'ApplicantZipPostalCode', 'ApplicantCountry', 'ApplicantUndergraduateInstitution', 'ApplicantGraduateInstitution', 'ApplicantGraduateProgram', 'ApplicantReferenceOne', 'ApplicantReferenceTwo', 'ApplicantReferenceThree', 'ApplicantEssayPersonalQualities', 'ApplicantEssayPriorExperiences', 'ApplicantResumeCoverLetterAttachmentFileName', 'ApplicantSubmissionDate', 'ApplicantSubmissionLastUpdate', 'UserId', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('applicantId', 'applicantFirstName', 'applicantLastName', 'applicantEmailAddress', 'applicantTelephoneNumber', 'applicantAddressOne', 'applicantAddressTwo', 'applicantCity', 'applicantStateProvinceRegion', 'applicantZipPostalCode', 'applicantCountry', 'applicantUndergraduateInstitution', 'applicantGraduateInstitution', 'applicantGraduateProgram', 'applicantReferenceOne', 'applicantReferenceTwo', 'applicantReferenceThree', 'applicantEssayPersonalQualities', 'applicantEssayPriorExperiences', 'applicantResumeCoverLetterAttachmentFileName', 'applicantSubmissionDate', 'applicantSubmissionLastUpdate', 'userId', ),
        BasePeer::TYPE_COLNAME => array (ApplicantPeer::APPLICANT_ID, ApplicantPeer::APPLICANT_FIRST_NAME, ApplicantPeer::APPLICANT_LAST_NAME, ApplicantPeer::APPLICANT_EMAIL_ADDRESS, ApplicantPeer::APPLICANT_TELEPHONE_NUMBER, ApplicantPeer::APPLICANT_ADDRESS_ONE, ApplicantPeer::APPLICANT_ADDRESS_TWO, ApplicantPeer::APPLICANT_CITY, ApplicantPeer::APPLICANT_STATE_PROVINCE_REGION, ApplicantPeer::APPLICANT_ZIP_POSTAL_CODE, ApplicantPeer::APPLICANT_COUNTRY, ApplicantPeer::APPLICANT_UNDERGRADUATE_INSTITUTION, ApplicantPeer::APPLICANT_GRADUATE_INSTITUTION, ApplicantPeer::APPLICANT_GRADUATE_PROGRAM, ApplicantPeer::APPLICANT_REFERENCE_ONE, ApplicantPeer::APPLICANT_REFERENCE_TWO, ApplicantPeer::APPLICANT_REFERENCE_THREE, ApplicantPeer::APPLICANT_ESSAY_PERSONAL_QUALITIES, ApplicantPeer::APPLICANT_ESSAY_PRIOR_EXPERIENCES, ApplicantPeer::APPLICANT_RESUME_COVER_LETTER_ATTACHMENT_FILE_NAME, ApplicantPeer::APPLICANT_SUBMISSION_DATE, ApplicantPeer::APPLICANT_SUBMISSION_LAST_UPDATE, ApplicantPeer::USER_ID, ),
        BasePeer::TYPE_RAW_COLNAME => array ('APPLICANT_ID', 'APPLICANT_FIRST_NAME', 'APPLICANT_LAST_NAME', 'APPLICANT_EMAIL_ADDRESS', 'APPLICANT_TELEPHONE_NUMBER', 'APPLICANT_ADDRESS_ONE', 'APPLICANT_ADDRESS_TWO', 'APPLICANT_CITY', 'APPLICANT_STATE_PROVINCE_REGION', 'APPLICANT_ZIP_POSTAL_CODE', 'APPLICANT_COUNTRY', 'APPLICANT_UNDERGRADUATE_INSTITUTION', 'APPLICANT_GRADUATE_INSTITUTION', 'APPLICANT_GRADUATE_PROGRAM', 'APPLICANT_REFERENCE_ONE', 'APPLICANT_REFERENCE_TWO', 'APPLICANT_REFERENCE_THREE', 'APPLICANT_ESSAY_PERSONAL_QUALITIES', 'APPLICANT_ESSAY_PRIOR_EXPERIENCES', 'APPLICANT_RESUME_COVER_LETTER_ATTACHMENT_FILE_NAME', 'APPLICANT_SUBMISSION_DATE', 'APPLICANT_SUBMISSION_LAST_UPDATE', 'USER_ID', ),
        BasePeer::TYPE_FIELDNAME => array ('applicant_id', 'applicant_first_name', 'applicant_last_name', 'applicant_email_address', 'applicant_telephone_number', 'applicant_address_one', 'applicant_address_two', 'applicant_city', 'applicant_state_province_region', 'applicant_zip_postal_code', 'applicant_country', 'applicant_undergraduate_institution', 'applicant_graduate_institution', 'applicant_graduate_program', 'applicant_reference_one', 'applicant_reference_two', 'applicant_reference_three', 'applicant_essay_personal_qualities', 'applicant_essay_prior_experiences', 'applicant_resume_cover_letter_attachment_file_name', 'applicant_submission_date', 'applicant_submission_last_update', 'user_id', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. ApplicantPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('ApplicantId' => 0, 'ApplicantFirstName' => 1, 'ApplicantLastName' => 2, 'ApplicantEmailAddress' => 3, 'ApplicantTelephoneNumber' => 4, 'ApplicantAddressOne' => 5, 'ApplicantAddressTwo' => 6, 'ApplicantCity' => 7, 'ApplicantStateProvinceRegion' => 8, 'ApplicantZipPostalCode' => 9, 'ApplicantCountry' => 10, 'ApplicantUndergraduateInstitution' => 11, 'ApplicantGraduateInstitution' => 12, 'ApplicantGraduateProgram' => 13, 'ApplicantReferenceOne' => 14, 'ApplicantReferenceTwo' => 15, 'ApplicantReferenceThree' => 16, 'ApplicantEssayPersonalQualities' => 17, 'ApplicantEssayPriorExperiences' => 18, 'ApplicantResumeCoverLetterAttachmentFileName' => 19, 'ApplicantSubmissionDate' => 20, 'ApplicantSubmissionLastUpdate' => 21, 'UserId' => 22, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('applicantId' => 0, 'applicantFirstName' => 1, 'applicantLastName' => 2, 'applicantEmailAddress' => 3, 'applicantTelephoneNumber' => 4, 'applicantAddressOne' => 5, 'applicantAddressTwo' => 6, 'applicantCity' => 7, 'applicantStateProvinceRegion' => 8, 'applicantZipPostalCode' => 9, 'applicantCountry' => 10, 'applicantUndergraduateInstitution' => 11, 'applicantGraduateInstitution' => 12, 'applicantGraduateProgram' => 13, 'applicantReferenceOne' => 14, 'applicantReferenceTwo' => 15, 'applicantReferenceThree' => 16, 'applicantEssayPersonalQualities' => 17, 'applicantEssayPriorExperiences' => 18, 'applicantResumeCoverLetterAttachmentFileName' => 19, 'applicantSubmissionDate' => 20, 'applicantSubmissionLastUpdate' => 21, 'userId' => 22, ),
        BasePeer::TYPE_COLNAME => array (ApplicantPeer::APPLICANT_ID => 0, ApplicantPeer::APPLICANT_FIRST_NAME => 1, ApplicantPeer::APPLICANT_LAST_NAME => 2, ApplicantPeer::APPLICANT_EMAIL_ADDRESS => 3, ApplicantPeer::APPLICANT_TELEPHONE_NUMBER => 4, ApplicantPeer::APPLICANT_ADDRESS_ONE => 5, ApplicantPeer::APPLICANT_ADDRESS_TWO => 6, ApplicantPeer::APPLICANT_CITY => 7, ApplicantPeer::APPLICANT_STATE_PROVINCE_REGION => 8, ApplicantPeer::APPLICANT_ZIP_POSTAL_CODE => 9, ApplicantPeer::APPLICANT_COUNTRY => 10, ApplicantPeer::APPLICANT_UNDERGRADUATE_INSTITUTION => 11, ApplicantPeer::APPLICANT_GRADUATE_INSTITUTION => 12, ApplicantPeer::APPLICANT_GRADUATE_PROGRAM => 13, ApplicantPeer::APPLICANT_REFERENCE_ONE => 14, ApplicantPeer::APPLICANT_REFERENCE_TWO => 15, ApplicantPeer::APPLICANT_REFERENCE_THREE => 16, ApplicantPeer::APPLICANT_ESSAY_PERSONAL_QUALITIES => 17, ApplicantPeer::APPLICANT_ESSAY_PRIOR_EXPERIENCES => 18, ApplicantPeer::APPLICANT_RESUME_COVER_LETTER_ATTACHMENT_FILE_NAME => 19, ApplicantPeer::APPLICANT_SUBMISSION_DATE => 20, ApplicantPeer::APPLICANT_SUBMISSION_LAST_UPDATE => 21, ApplicantPeer::USER_ID => 22, ),
        BasePeer::TYPE_RAW_COLNAME => array ('APPLICANT_ID' => 0, 'APPLICANT_FIRST_NAME' => 1, 'APPLICANT_LAST_NAME' => 2, 'APPLICANT_EMAIL_ADDRESS' => 3, 'APPLICANT_TELEPHONE_NUMBER' => 4, 'APPLICANT_ADDRESS_ONE' => 5, 'APPLICANT_ADDRESS_TWO' => 6, 'APPLICANT_CITY' => 7, 'APPLICANT_STATE_PROVINCE_REGION' => 8, 'APPLICANT_ZIP_POSTAL_CODE' => 9, 'APPLICANT_COUNTRY' => 10, 'APPLICANT_UNDERGRADUATE_INSTITUTION' => 11, 'APPLICANT_GRADUATE_INSTITUTION' => 12, 'APPLICANT_GRADUATE_PROGRAM' => 13, 'APPLICANT_REFERENCE_ONE' => 14, 'APPLICANT_REFERENCE_TWO' => 15, 'APPLICANT_REFERENCE_THREE' => 16, 'APPLICANT_ESSAY_PERSONAL_QUALITIES' => 17, 'APPLICANT_ESSAY_PRIOR_EXPERIENCES' => 18, 'APPLICANT_RESUME_COVER_LETTER_ATTACHMENT_FILE_NAME' => 19, 'APPLICANT_SUBMISSION_DATE' => 20, 'APPLICANT_SUBMISSION_LAST_UPDATE' => 21, 'USER_ID' => 22, ),
        BasePeer::TYPE_FIELDNAME => array ('applicant_id' => 0, 'applicant_first_name' => 1, 'applicant_last_name' => 2, 'applicant_email_address' => 3, 'applicant_telephone_number' => 4, 'applicant_address_one' => 5, 'applicant_address_two' => 6, 'applicant_city' => 7, 'applicant_state_province_region' => 8, 'applicant_zip_postal_code' => 9, 'applicant_country' => 10, 'applicant_undergraduate_institution' => 11, 'applicant_graduate_institution' => 12, 'applicant_graduate_program' => 13, 'applicant_reference_one' => 14, 'applicant_reference_two' => 15, 'applicant_reference_three' => 16, 'applicant_essay_personal_qualities' => 17, 'applicant_essay_prior_experiences' => 18, 'applicant_resume_cover_letter_attachment_file_name' => 19, 'applicant_submission_date' => 20, 'applicant_submission_last_update' => 21, 'user_id' => 22, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, )
    );

    /**
     * Translates a fieldname to another type
     *
     * @param      string $name field name
     * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @param      string $toType   One of the class type constants
     * @return string          translated name of the field.
     * @throws PropelException - if the specified name could not be found in the fieldname mappings.
     */
    public static function translateFieldName($name, $fromType, $toType)
    {
        $toNames = ApplicantPeer::getFieldNames($toType);
        $key = isset(ApplicantPeer::$fieldKeys[$fromType][$name]) ? ApplicantPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(ApplicantPeer::$fieldKeys[$fromType], true));
        }

        return $toNames[$key];
    }

    /**
     * Returns an array of field names.
     *
     * @param      string $type The type of fieldnames to return:
     *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @return array           A list of field names
     * @throws PropelException - if the type is not valid.
     */
    public static function getFieldNames($type = BasePeer::TYPE_PHPNAME)
    {
        if (!array_key_exists($type, ApplicantPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return ApplicantPeer::$fieldNames[$type];
    }

    /**
     * Convenience method which changes table.column to alias.column.
     *
     * Using this method you can maintain SQL abstraction while using column aliases.
     * <code>
     *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
     *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
     * </code>
     * @param      string $alias The alias for the current table.
     * @param      string $column The column name for current table. (i.e. ApplicantPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(ApplicantPeer::TABLE_NAME.'.', $alias.'.', $column);
    }

    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param      Criteria $criteria object containing the columns to add.
     * @param      string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(ApplicantPeer::APPLICANT_ID);
            $criteria->addSelectColumn(ApplicantPeer::APPLICANT_FIRST_NAME);
            $criteria->addSelectColumn(ApplicantPeer::APPLICANT_LAST_NAME);
            $criteria->addSelectColumn(ApplicantPeer::APPLICANT_EMAIL_ADDRESS);
            $criteria->addSelectColumn(ApplicantPeer::APPLICANT_TELEPHONE_NUMBER);
            $criteria->addSelectColumn(ApplicantPeer::APPLICANT_ADDRESS_ONE);
            $criteria->addSelectColumn(ApplicantPeer::APPLICANT_ADDRESS_TWO);
            $criteria->addSelectColumn(ApplicantPeer::APPLICANT_CITY);
            $criteria->addSelectColumn(ApplicantPeer::APPLICANT_STATE_PROVINCE_REGION);
            $criteria->addSelectColumn(ApplicantPeer::APPLICANT_ZIP_POSTAL_CODE);
            $criteria->addSelectColumn(ApplicantPeer::APPLICANT_COUNTRY);
            $criteria->addSelectColumn(ApplicantPeer::APPLICANT_UNDERGRADUATE_INSTITUTION);
            $criteria->addSelectColumn(ApplicantPeer::APPLICANT_GRADUATE_INSTITUTION);
            $criteria->addSelectColumn(ApplicantPeer::APPLICANT_GRADUATE_PROGRAM);
            $criteria->addSelectColumn(ApplicantPeer::APPLICANT_REFERENCE_ONE);
            $criteria->addSelectColumn(ApplicantPeer::APPLICANT_REFERENCE_TWO);
            $criteria->addSelectColumn(ApplicantPeer::APPLICANT_REFERENCE_THREE);
            $criteria->addSelectColumn(ApplicantPeer::APPLICANT_ESSAY_PERSONAL_QUALITIES);
            $criteria->addSelectColumn(ApplicantPeer::APPLICANT_ESSAY_PRIOR_EXPERIENCES);
            $criteria->addSelectColumn(ApplicantPeer::APPLICANT_RESUME_COVER_LETTER_ATTACHMENT_FILE_NAME);
            $criteria->addSelectColumn(ApplicantPeer::APPLICANT_SUBMISSION_DATE);
            $criteria->addSelectColumn(ApplicantPeer::APPLICANT_SUBMISSION_LAST_UPDATE);
            $criteria->addSelectColumn(ApplicantPeer::USER_ID);
        } else {
            $criteria->addSelectColumn($alias . '.APPLICANT_ID');
            $criteria->addSelectColumn($alias . '.APPLICANT_FIRST_NAME');
            $criteria->addSelectColumn($alias . '.APPLICANT_LAST_NAME');
            $criteria->addSelectColumn($alias . '.APPLICANT_EMAIL_ADDRESS');
            $criteria->addSelectColumn($alias . '.APPLICANT_TELEPHONE_NUMBER');
            $criteria->addSelectColumn($alias . '.APPLICANT_ADDRESS_ONE');
            $criteria->addSelectColumn($alias . '.APPLICANT_ADDRESS_TWO');
            $criteria->addSelectColumn($alias . '.APPLICANT_CITY');
            $criteria->addSelectColumn($alias . '.APPLICANT_STATE_PROVINCE_REGION');
            $criteria->addSelectColumn($alias . '.APPLICANT_ZIP_POSTAL_CODE');
            $criteria->addSelectColumn($alias . '.APPLICANT_COUNTRY');
            $criteria->addSelectColumn($alias . '.APPLICANT_UNDERGRADUATE_INSTITUTION');
            $criteria->addSelectColumn($alias . '.APPLICANT_GRADUATE_INSTITUTION');
            $criteria->addSelectColumn($alias . '.APPLICANT_GRADUATE_PROGRAM');
            $criteria->addSelectColumn($alias . '.APPLICANT_REFERENCE_ONE');
            $criteria->addSelectColumn($alias . '.APPLICANT_REFERENCE_TWO');
            $criteria->addSelectColumn($alias . '.APPLICANT_REFERENCE_THREE');
            $criteria->addSelectColumn($alias . '.APPLICANT_ESSAY_PERSONAL_QUALITIES');
            $criteria->addSelectColumn($alias . '.APPLICANT_ESSAY_PRIOR_EXPERIENCES');
            $criteria->addSelectColumn($alias . '.APPLICANT_RESUME_COVER_LETTER_ATTACHMENT_FILE_NAME');
            $criteria->addSelectColumn($alias . '.APPLICANT_SUBMISSION_DATE');
            $criteria->addSelectColumn($alias . '.APPLICANT_SUBMISSION_LAST_UPDATE');
            $criteria->addSelectColumn($alias . '.USER_ID');
        }
    }

    /**
     * Returns the number of rows matching criteria.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @return int Number of matching rows.
     */
    public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
    {
        // we may modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ApplicantPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ApplicantPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(ApplicantPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(ApplicantPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        // BasePeer returns a PDOStatement
        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }
    /**
     * Selects one object from the DB.
     *
     * @param      Criteria $criteria object used to create the SELECT statement.
     * @param      PropelPDO $con
     * @return                 Applicant
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = ApplicantPeer::doSelect($critcopy, $con);
        if ($objects) {
            return $objects[0];
        }

        return null;
    }
    /**
     * Selects several row from the DB.
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con
     * @return array           Array of selected Objects
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelect(Criteria $criteria, PropelPDO $con = null)
    {
        return ApplicantPeer::populateObjects(ApplicantPeer::doSelectStmt($criteria, $con));
    }
    /**
     * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
     *
     * Use this method directly if you want to work with an executed statement durirectly (for example
     * to perform your own object hydration).
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con The connection to use
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return PDOStatement The executed PDOStatement object.
     * @see        BasePeer::doSelect()
     */
    public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(ApplicantPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            ApplicantPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(ApplicantPeer::DATABASE_NAME);

        // BasePeer returns a PDOStatement
        return BasePeer::doSelect($criteria, $con);
    }
    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doSelect*()
     * methods in your stub classes -- you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by doSelect*()
     * and retrieveByPK*() calls.
     *
     * @param      Applicant $obj A Applicant object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getApplicantId();
            } // if key === null
            ApplicantPeer::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param      mixed $value A Applicant object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof Applicant) {
                $key = (string) $value->getApplicantId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Applicant object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(ApplicantPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   Applicant Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(ApplicantPeer::$instances[$key])) {
                return ApplicantPeer::$instances[$key];
            }
        }

        return null; // just to be explicit
    }

    /**
     * Clear the instance pool.
     *
     * @return void
     */
    public static function clearInstancePool()
    {
        ApplicantPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to applicant
     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in ApplicantPositionPeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        ApplicantPositionPeer::clearInstancePool();
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return string A string version of PK or null if the components of primary key in result array are all null.
     */
    public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
    {
        // If the PK cannot be derived from the row, return null.
        if ($row[$startcol] === null) {
            return null;
        }

        return (string) $row[$startcol];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $startcol = 0)
    {

        return (int) $row[$startcol];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function populateObjects(PDOStatement $stmt)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = ApplicantPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = ApplicantPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = ApplicantPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ApplicantPeer::addInstanceToPool($obj, $key);
            } // if key exists
        }
        $stmt->closeCursor();

        return $results;
    }
    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return array (Applicant object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = ApplicantPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = ApplicantPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + ApplicantPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ApplicantPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            ApplicantPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }


    /**
     * Returns the number of rows matching criteria, joining the related User table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinUser(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ApplicantPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ApplicantPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(ApplicantPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ApplicantPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ApplicantPeer::USER_ID, UserPeer::USER_ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Selects a collection of Applicant objects pre-filled with their User objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Applicant objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinUser(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ApplicantPeer::DATABASE_NAME);
        }

        ApplicantPeer::addSelectColumns($criteria);
        $startcol = ApplicantPeer::NUM_HYDRATE_COLUMNS;
        UserPeer::addSelectColumns($criteria);

        $criteria->addJoin(ApplicantPeer::USER_ID, UserPeer::USER_ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ApplicantPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ApplicantPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = ApplicantPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ApplicantPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = UserPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = UserPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = UserPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    UserPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (Applicant) to $obj2 (User)
                $obj2->addApplicant($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining all related tables
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ApplicantPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ApplicantPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(ApplicantPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ApplicantPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ApplicantPeer::USER_ID, UserPeer::USER_ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }

    /**
     * Selects a collection of Applicant objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Applicant objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ApplicantPeer::DATABASE_NAME);
        }

        ApplicantPeer::addSelectColumns($criteria);
        $startcol2 = ApplicantPeer::NUM_HYDRATE_COLUMNS;

        UserPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + UserPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(ApplicantPeer::USER_ID, UserPeer::USER_ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ApplicantPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ApplicantPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = ApplicantPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ApplicantPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined User rows

            $key2 = UserPeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = UserPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = UserPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    UserPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (Applicant) to the collection in $obj2 (User)
                $obj2->addApplicant($obj1);
            } // if joined row not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }

    /**
     * Returns the TableMap related to this peer.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getDatabaseMap(ApplicantPeer::DATABASE_NAME)->getTable(ApplicantPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseApplicantPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseApplicantPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new ApplicantTableMap());
      }
    }

    /**
     * The class that the Peer will make instances of.
     *
     *
     * @return string ClassName
     */
    public static function getOMClass()
    {
        return ApplicantPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a Applicant or Criteria object.
     *
     * @param      mixed $values Criteria or Applicant object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(ApplicantPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from Applicant object
        }

        if ($criteria->containsKey(ApplicantPeer::APPLICANT_ID) && $criteria->keyContainsValue(ApplicantPeer::APPLICANT_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ApplicantPeer::APPLICANT_ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(ApplicantPeer::DATABASE_NAME);

        try {
            // use transaction because $criteria could contain info
            // for more than one table (I guess, conceivably)
            $con->beginTransaction();
            $pk = BasePeer::doInsert($criteria, $con);
            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $pk;
    }

    /**
     * Performs an UPDATE on the database, given a Applicant or Criteria object.
     *
     * @param      mixed $values Criteria or Applicant object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(ApplicantPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(ApplicantPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(ApplicantPeer::APPLICANT_ID);
            $value = $criteria->remove(ApplicantPeer::APPLICANT_ID);
            if ($value) {
                $selectCriteria->add(ApplicantPeer::APPLICANT_ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(ApplicantPeer::TABLE_NAME);
            }

        } else { // $values is Applicant object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(ApplicantPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the applicant table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(ApplicantPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += ApplicantPeer::doOnDeleteCascade(new Criteria(ApplicantPeer::DATABASE_NAME), $con);
            $affectedRows += BasePeer::doDeleteAll(ApplicantPeer::TABLE_NAME, $con, ApplicantPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ApplicantPeer::clearInstancePool();
            ApplicantPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a Applicant or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or Applicant object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param      PropelPDO $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *				if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, PropelPDO $con = null)
     {
        if ($con === null) {
            $con = Propel::getConnection(ApplicantPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof Applicant) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ApplicantPeer::DATABASE_NAME);
            $criteria->add(ApplicantPeer::APPLICANT_ID, (array) $values, Criteria::IN);
        }

        // Set the correct dbName
        $criteria->setDbName(ApplicantPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            // cloning the Criteria in case it's modified by doSelect() or doSelectStmt()
            $c = clone $criteria;
            $affectedRows += ApplicantPeer::doOnDeleteCascade($c, $con);

            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            if ($values instanceof Criteria) {
                ApplicantPeer::clearInstancePool();
            } elseif ($values instanceof Applicant) { // it's a model object
                ApplicantPeer::removeInstanceFromPool($values);
            } else { // it's a primary key, or an array of pks
                foreach ((array) $values as $singleval) {
                    ApplicantPeer::removeInstanceFromPool($singleval);
                }
            }

            $affectedRows += BasePeer::doDelete($criteria, $con);
            ApplicantPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * This is a method for emulating ON DELETE CASCADE for DBs that don't support this
     * feature (like MySQL or SQLite).
     *
     * This method is not very speedy because it must perform a query first to get
     * the implicated records and then perform the deletes by calling those Peer classes.
     *
     * This method should be used within a transaction if possible.
     *
     * @param      Criteria $criteria
     * @param      PropelPDO $con
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    protected static function doOnDeleteCascade(Criteria $criteria, PropelPDO $con)
    {
        // initialize var to track total num of affected rows
        $affectedRows = 0;

        // first find the objects that are implicated by the $criteria
        $objects = ApplicantPeer::doSelect($criteria, $con);
        foreach ($objects as $obj) {


            // delete related ApplicantPosition objects
            $criteria = new Criteria(ApplicantPositionPeer::DATABASE_NAME);

            $criteria->add(ApplicantPositionPeer::APPLICANT_ID, $obj->getApplicantId());
            $affectedRows += ApplicantPositionPeer::doDelete($criteria, $con);
        }

        return $affectedRows;
    }

    /**
     * Validates all modified columns of given Applicant object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      Applicant $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(ApplicantPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(ApplicantPeer::TABLE_NAME);

            if (! is_array($cols)) {
                $cols = array($cols);
            }

            foreach ($cols as $colName) {
                if ($tableMap->hasColumn($colName)) {
                    $get = 'get' . $tableMap->getColumn($colName)->getPhpName();
                    $columns[$colName] = $obj->$get();
                }
            }
        } else {

        }

        return BasePeer::doValidate(ApplicantPeer::DATABASE_NAME, ApplicantPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param      int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return Applicant
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = ApplicantPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(ApplicantPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(ApplicantPeer::DATABASE_NAME);
        $criteria->add(ApplicantPeer::APPLICANT_ID, $pk);

        $v = ApplicantPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return Applicant[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(ApplicantPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(ApplicantPeer::DATABASE_NAME);
            $criteria->add(ApplicantPeer::APPLICANT_ID, $pks, Criteria::IN);
            $objs = ApplicantPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseApplicantPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseApplicantPeer::buildTableMap();

