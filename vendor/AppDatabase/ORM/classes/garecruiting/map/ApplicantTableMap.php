<?php

namespace GARecruitingORM\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'applicant' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.garecruiting.map
 */
class ApplicantTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'garecruiting.map.ApplicantTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('applicant');
        $this->setPhpName('Applicant');
        $this->setClassname('GARecruitingORM\\Applicant');
        $this->setPackage('garecruiting');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('APPLICANT_ID', 'ApplicantId', 'INTEGER', true, null, null);
        $this->addColumn('APPLICANT_FIRST_NAME', 'ApplicantFirstName', 'VARCHAR', true, 150, null);
        $this->addColumn('APPLICANT_LAST_NAME', 'ApplicantLastName', 'VARCHAR', true, 150, null);
        $this->addColumn('APPLICANT_EMAIL_ADDRESS', 'ApplicantEmailAddress', 'VARCHAR', true, 150, null);
        $this->addColumn('APPLICANT_TELEPHONE_NUMBER', 'ApplicantTelephoneNumber', 'VARCHAR', true, 20, null);
        $this->addColumn('APPLICANT_ADDRESS_ONE', 'ApplicantAddressOne', 'VARCHAR', true, 150, null);
        $this->addColumn('APPLICANT_ADDRESS_TWO', 'ApplicantAddressTwo', 'VARCHAR', true, 150, null);
        $this->addColumn('APPLICANT_CITY', 'ApplicantCity', 'VARCHAR', true, 100, null);
        $this->addColumn('APPLICANT_STATE_PROVINCE_REGION', 'ApplicantStateProvinceRegion', 'VARCHAR', true, 100, null);
        $this->addColumn('APPLICANT_ZIP_POSTAL_CODE', 'ApplicantZipPostalCode', 'VARCHAR', true, 25, null);
        $this->addColumn('APPLICANT_COUNTRY', 'ApplicantCountry', 'VARCHAR', true, 100, null);
        $this->addColumn('APPLICANT_UNDERGRADUATE_INSTITUTION', 'ApplicantUndergraduateInstitution', 'VARCHAR', true, 100, null);
        $this->addColumn('APPLICANT_GRADUATE_INSTITUTION', 'ApplicantGraduateInstitution', 'VARCHAR', true, 100, null);
        $this->addColumn('APPLICANT_GRADUATE_PROGRAM', 'ApplicantGraduateProgram', 'VARCHAR', true, 100, null);
        $this->addColumn('APPLICANT_REFERENCE_ONE', 'ApplicantReferenceOne', 'LONGVARCHAR', true, null, null);
        $this->addColumn('APPLICANT_REFERENCE_TWO', 'ApplicantReferenceTwo', 'LONGVARCHAR', true, null, null);
        $this->addColumn('APPLICANT_REFERENCE_THREE', 'ApplicantReferenceThree', 'LONGVARCHAR', true, null, null);
        $this->addColumn('APPLICANT_ESSAY_PERSONAL_QUALITIES', 'ApplicantEssayPersonalQualities', 'LONGVARCHAR', true, null, null);
        $this->addColumn('APPLICANT_ESSAY_PRIOR_EXPERIENCES', 'ApplicantEssayPriorExperiences', 'LONGVARCHAR', true, null, null);
        $this->addColumn('APPLICANT_RESUME_COVER_LETTER_ATTACHMENT_FILE_NAME', 'ApplicantResumeCoverLetterAttachmentFileName', 'VARCHAR', true, 150, null);
        $this->addColumn('APPLICANT_SUBMISSION_DATE', 'ApplicantSubmissionDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('APPLICANT_SUBMISSION_LAST_UPDATE', 'ApplicantSubmissionLastUpdate', 'TIMESTAMP', true, null, '0000-00-00 00:00:00');
        $this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'user', 'USER_ID', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('User', 'GARecruitingORM\\User', RelationMap::MANY_TO_ONE, array('user_id' => 'user_id', ), 'CASCADE', 'CASCADE');
        $this->addRelation('ApplicantPosition', 'GARecruitingORM\\ApplicantPosition', RelationMap::ONE_TO_MANY, array('applicant_id' => 'applicant_id', ), 'CASCADE', 'CASCADE', 'ApplicantPositions');
    } // buildRelations()

} // ApplicantTableMap
