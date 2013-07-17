<?php

namespace GARecruitingORM\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \DateTime;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelCollection;
use \PropelDateTime;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use GARecruitingORM\Applicant;
use GARecruitingORM\ApplicantPeer;
use GARecruitingORM\ApplicantPosition;
use GARecruitingORM\ApplicantPositionQuery;
use GARecruitingORM\ApplicantQuery;
use GARecruitingORM\User;
use GARecruitingORM\UserQuery;

/**
 * Base class that represents a row from the 'applicant' table.
 *
 *
 *
 * @package    propel.generator.garecruiting.om
 */
abstract class BaseApplicant extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'GARecruitingORM\\ApplicantPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        ApplicantPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the applicant_id field.
     * @var        int
     */
    protected $applicant_id;

    /**
     * The value for the applicant_first_name field.
     * @var        string
     */
    protected $applicant_first_name;

    /**
     * The value for the applicant_last_name field.
     * @var        string
     */
    protected $applicant_last_name;

    /**
     * The value for the applicant_email_address field.
     * @var        string
     */
    protected $applicant_email_address;

    /**
     * The value for the applicant_telephone_number field.
     * @var        string
     */
    protected $applicant_telephone_number;

    /**
     * The value for the applicant_address_one field.
     * @var        string
     */
    protected $applicant_address_one;

    /**
     * The value for the applicant_address_two field.
     * @var        string
     */
    protected $applicant_address_two;

    /**
     * The value for the applicant_city field.
     * @var        string
     */
    protected $applicant_city;

    /**
     * The value for the applicant_state_province_region field.
     * @var        string
     */
    protected $applicant_state_province_region;

    /**
     * The value for the applicant_zip_postal_code field.
     * @var        string
     */
    protected $applicant_zip_postal_code;

    /**
     * The value for the applicant_country field.
     * @var        string
     */
    protected $applicant_country;

    /**
     * The value for the applicant_undergraduate_institution field.
     * @var        string
     */
    protected $applicant_undergraduate_institution;

    /**
     * The value for the applicant_graduate_institution field.
     * @var        string
     */
    protected $applicant_graduate_institution;

    /**
     * The value for the applicant_graduate_program field.
     * @var        string
     */
    protected $applicant_graduate_program;

    /**
     * The value for the applicant_reference_one field.
     * @var        string
     */
    protected $applicant_reference_one;

    /**
     * The value for the applicant_reference_two field.
     * @var        string
     */
    protected $applicant_reference_two;

    /**
     * The value for the applicant_reference_three field.
     * @var        string
     */
    protected $applicant_reference_three;

    /**
     * The value for the applicant_essay_personal_qualities field.
     * @var        string
     */
    protected $applicant_essay_personal_qualities;

    /**
     * The value for the applicant_essay_prior_experiences field.
     * @var        string
     */
    protected $applicant_essay_prior_experiences;

    /**
     * The value for the applicant_resume_cover_letter_attachment_file_name field.
     * @var        string
     */
    protected $applicant_resume_cover_letter_attachment_file_name;

    /**
     * The value for the applicant_submission_date field.
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        string
     */
    protected $applicant_submission_date;

    /**
     * The value for the applicant_submission_last_update field.
     * Note: this column has a database default value of: NULL
     * @var        string
     */
    protected $applicant_submission_last_update;

    /**
     * The value for the user_id field.
     * @var        int
     */
    protected $user_id;

    /**
     * @var        User
     */
    protected $aUser;

    /**
     * @var        PropelObjectCollection|ApplicantPosition[] Collection to store aggregation of ApplicantPosition objects.
     */
    protected $collApplicantPositions;
    protected $collApplicantPositionsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $applicantPositionsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
        $this->applicant_submission_last_update = NULL;
    }

    /**
     * Initializes internal state of BaseApplicant object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [applicant_id] column value.
     *
     * @return int
     */
    public function getApplicantId()
    {
        return $this->applicant_id;
    }

    /**
     * Get the [applicant_first_name] column value.
     *
     * @return string
     */
    public function getApplicantFirstName()
    {
        return $this->applicant_first_name;
    }

    /**
     * Get the [applicant_last_name] column value.
     *
     * @return string
     */
    public function getApplicantLastName()
    {
        return $this->applicant_last_name;
    }

    /**
     * Get the [applicant_email_address] column value.
     *
     * @return string
     */
    public function getApplicantEmailAddress()
    {
        return $this->applicant_email_address;
    }

    /**
     * Get the [applicant_telephone_number] column value.
     *
     * @return string
     */
    public function getApplicantTelephoneNumber()
    {
        return $this->applicant_telephone_number;
    }

    /**
     * Get the [applicant_address_one] column value.
     *
     * @return string
     */
    public function getApplicantAddressOne()
    {
        return $this->applicant_address_one;
    }

    /**
     * Get the [applicant_address_two] column value.
     *
     * @return string
     */
    public function getApplicantAddressTwo()
    {
        return $this->applicant_address_two;
    }

    /**
     * Get the [applicant_city] column value.
     *
     * @return string
     */
    public function getApplicantCity()
    {
        return $this->applicant_city;
    }

    /**
     * Get the [applicant_state_province_region] column value.
     *
     * @return string
     */
    public function getApplicantStateProvinceRegion()
    {
        return $this->applicant_state_province_region;
    }

    /**
     * Get the [applicant_zip_postal_code] column value.
     *
     * @return string
     */
    public function getApplicantZipPostalCode()
    {
        return $this->applicant_zip_postal_code;
    }

    /**
     * Get the [applicant_country] column value.
     *
     * @return string
     */
    public function getApplicantCountry()
    {
        return $this->applicant_country;
    }

    /**
     * Get the [applicant_undergraduate_institution] column value.
     *
     * @return string
     */
    public function getApplicantUndergraduateInstitution()
    {
        return $this->applicant_undergraduate_institution;
    }

    /**
     * Get the [applicant_graduate_institution] column value.
     *
     * @return string
     */
    public function getApplicantGraduateInstitution()
    {
        return $this->applicant_graduate_institution;
    }

    /**
     * Get the [applicant_graduate_program] column value.
     *
     * @return string
     */
    public function getApplicantGraduateProgram()
    {
        return $this->applicant_graduate_program;
    }

    /**
     * Get the [applicant_reference_one] column value.
     *
     * @return string
     */
    public function getApplicantReferenceOne()
    {
        return $this->applicant_reference_one;
    }

    /**
     * Get the [applicant_reference_two] column value.
     *
     * @return string
     */
    public function getApplicantReferenceTwo()
    {
        return $this->applicant_reference_two;
    }

    /**
     * Get the [applicant_reference_three] column value.
     *
     * @return string
     */
    public function getApplicantReferenceThree()
    {
        return $this->applicant_reference_three;
    }

    /**
     * Get the [applicant_essay_personal_qualities] column value.
     *
     * @return string
     */
    public function getApplicantEssayPersonalQualities()
    {
        return $this->applicant_essay_personal_qualities;
    }

    /**
     * Get the [applicant_essay_prior_experiences] column value.
     *
     * @return string
     */
    public function getApplicantEssayPriorExperiences()
    {
        return $this->applicant_essay_prior_experiences;
    }

    /**
     * Get the [applicant_resume_cover_letter_attachment_file_name] column value.
     *
     * @return string
     */
    public function getApplicantResumeCoverLetterAttachmentFileName()
    {
        return $this->applicant_resume_cover_letter_attachment_file_name;
    }

    /**
     * Get the [optionally formatted] temporal [applicant_submission_date] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getApplicantSubmissionDate($format = 'Y-m-d H:i:s')
    {
        if ($this->applicant_submission_date === null) {
            return null;
        }

        if ($this->applicant_submission_date === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->applicant_submission_date);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->applicant_submission_date, true), $x);
            }
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        } elseif (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        } else {
            return $dt->format($format);
        }
    }

    /**
     * Get the [optionally formatted] temporal [applicant_submission_last_update] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getApplicantSubmissionLastUpdate($format = 'Y-m-d H:i:s')
    {
        if ($this->applicant_submission_last_update === null) {
            return null;
        }

        if ($this->applicant_submission_last_update === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->applicant_submission_last_update);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->applicant_submission_last_update, true), $x);
            }
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        } elseif (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        } else {
            return $dt->format($format);
        }
    }

    /**
     * Get the [user_id] column value.
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set the value of [applicant_id] column.
     *
     * @param int $v new value
     * @return Applicant The current object (for fluent API support)
     */
    public function setApplicantId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->applicant_id !== $v) {
            $this->applicant_id = $v;
            $this->modifiedColumns[] = ApplicantPeer::APPLICANT_ID;
        }


        return $this;
    } // setApplicantId()

    /**
     * Set the value of [applicant_first_name] column.
     *
     * @param string $v new value
     * @return Applicant The current object (for fluent API support)
     */
    public function setApplicantFirstName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->applicant_first_name !== $v) {
            $this->applicant_first_name = $v;
            $this->modifiedColumns[] = ApplicantPeer::APPLICANT_FIRST_NAME;
        }


        return $this;
    } // setApplicantFirstName()

    /**
     * Set the value of [applicant_last_name] column.
     *
     * @param string $v new value
     * @return Applicant The current object (for fluent API support)
     */
    public function setApplicantLastName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->applicant_last_name !== $v) {
            $this->applicant_last_name = $v;
            $this->modifiedColumns[] = ApplicantPeer::APPLICANT_LAST_NAME;
        }


        return $this;
    } // setApplicantLastName()

    /**
     * Set the value of [applicant_email_address] column.
     *
     * @param string $v new value
     * @return Applicant The current object (for fluent API support)
     */
    public function setApplicantEmailAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->applicant_email_address !== $v) {
            $this->applicant_email_address = $v;
            $this->modifiedColumns[] = ApplicantPeer::APPLICANT_EMAIL_ADDRESS;
        }


        return $this;
    } // setApplicantEmailAddress()

    /**
     * Set the value of [applicant_telephone_number] column.
     *
     * @param string $v new value
     * @return Applicant The current object (for fluent API support)
     */
    public function setApplicantTelephoneNumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->applicant_telephone_number !== $v) {
            $this->applicant_telephone_number = $v;
            $this->modifiedColumns[] = ApplicantPeer::APPLICANT_TELEPHONE_NUMBER;
        }


        return $this;
    } // setApplicantTelephoneNumber()

    /**
     * Set the value of [applicant_address_one] column.
     *
     * @param string $v new value
     * @return Applicant The current object (for fluent API support)
     */
    public function setApplicantAddressOne($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->applicant_address_one !== $v) {
            $this->applicant_address_one = $v;
            $this->modifiedColumns[] = ApplicantPeer::APPLICANT_ADDRESS_ONE;
        }


        return $this;
    } // setApplicantAddressOne()

    /**
     * Set the value of [applicant_address_two] column.
     *
     * @param string $v new value
     * @return Applicant The current object (for fluent API support)
     */
    public function setApplicantAddressTwo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->applicant_address_two !== $v) {
            $this->applicant_address_two = $v;
            $this->modifiedColumns[] = ApplicantPeer::APPLICANT_ADDRESS_TWO;
        }


        return $this;
    } // setApplicantAddressTwo()

    /**
     * Set the value of [applicant_city] column.
     *
     * @param string $v new value
     * @return Applicant The current object (for fluent API support)
     */
    public function setApplicantCity($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->applicant_city !== $v) {
            $this->applicant_city = $v;
            $this->modifiedColumns[] = ApplicantPeer::APPLICANT_CITY;
        }


        return $this;
    } // setApplicantCity()

    /**
     * Set the value of [applicant_state_province_region] column.
     *
     * @param string $v new value
     * @return Applicant The current object (for fluent API support)
     */
    public function setApplicantStateProvinceRegion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->applicant_state_province_region !== $v) {
            $this->applicant_state_province_region = $v;
            $this->modifiedColumns[] = ApplicantPeer::APPLICANT_STATE_PROVINCE_REGION;
        }


        return $this;
    } // setApplicantStateProvinceRegion()

    /**
     * Set the value of [applicant_zip_postal_code] column.
     *
     * @param string $v new value
     * @return Applicant The current object (for fluent API support)
     */
    public function setApplicantZipPostalCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->applicant_zip_postal_code !== $v) {
            $this->applicant_zip_postal_code = $v;
            $this->modifiedColumns[] = ApplicantPeer::APPLICANT_ZIP_POSTAL_CODE;
        }


        return $this;
    } // setApplicantZipPostalCode()

    /**
     * Set the value of [applicant_country] column.
     *
     * @param string $v new value
     * @return Applicant The current object (for fluent API support)
     */
    public function setApplicantCountry($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->applicant_country !== $v) {
            $this->applicant_country = $v;
            $this->modifiedColumns[] = ApplicantPeer::APPLICANT_COUNTRY;
        }


        return $this;
    } // setApplicantCountry()

    /**
     * Set the value of [applicant_undergraduate_institution] column.
     *
     * @param string $v new value
     * @return Applicant The current object (for fluent API support)
     */
    public function setApplicantUndergraduateInstitution($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->applicant_undergraduate_institution !== $v) {
            $this->applicant_undergraduate_institution = $v;
            $this->modifiedColumns[] = ApplicantPeer::APPLICANT_UNDERGRADUATE_INSTITUTION;
        }


        return $this;
    } // setApplicantUndergraduateInstitution()

    /**
     * Set the value of [applicant_graduate_institution] column.
     *
     * @param string $v new value
     * @return Applicant The current object (for fluent API support)
     */
    public function setApplicantGraduateInstitution($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->applicant_graduate_institution !== $v) {
            $this->applicant_graduate_institution = $v;
            $this->modifiedColumns[] = ApplicantPeer::APPLICANT_GRADUATE_INSTITUTION;
        }


        return $this;
    } // setApplicantGraduateInstitution()

    /**
     * Set the value of [applicant_graduate_program] column.
     *
     * @param string $v new value
     * @return Applicant The current object (for fluent API support)
     */
    public function setApplicantGraduateProgram($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->applicant_graduate_program !== $v) {
            $this->applicant_graduate_program = $v;
            $this->modifiedColumns[] = ApplicantPeer::APPLICANT_GRADUATE_PROGRAM;
        }


        return $this;
    } // setApplicantGraduateProgram()

    /**
     * Set the value of [applicant_reference_one] column.
     *
     * @param string $v new value
     * @return Applicant The current object (for fluent API support)
     */
    public function setApplicantReferenceOne($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->applicant_reference_one !== $v) {
            $this->applicant_reference_one = $v;
            $this->modifiedColumns[] = ApplicantPeer::APPLICANT_REFERENCE_ONE;
        }


        return $this;
    } // setApplicantReferenceOne()

    /**
     * Set the value of [applicant_reference_two] column.
     *
     * @param string $v new value
     * @return Applicant The current object (for fluent API support)
     */
    public function setApplicantReferenceTwo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->applicant_reference_two !== $v) {
            $this->applicant_reference_two = $v;
            $this->modifiedColumns[] = ApplicantPeer::APPLICANT_REFERENCE_TWO;
        }


        return $this;
    } // setApplicantReferenceTwo()

    /**
     * Set the value of [applicant_reference_three] column.
     *
     * @param string $v new value
     * @return Applicant The current object (for fluent API support)
     */
    public function setApplicantReferenceThree($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->applicant_reference_three !== $v) {
            $this->applicant_reference_three = $v;
            $this->modifiedColumns[] = ApplicantPeer::APPLICANT_REFERENCE_THREE;
        }


        return $this;
    } // setApplicantReferenceThree()

    /**
     * Set the value of [applicant_essay_personal_qualities] column.
     *
     * @param string $v new value
     * @return Applicant The current object (for fluent API support)
     */
    public function setApplicantEssayPersonalQualities($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->applicant_essay_personal_qualities !== $v) {
            $this->applicant_essay_personal_qualities = $v;
            $this->modifiedColumns[] = ApplicantPeer::APPLICANT_ESSAY_PERSONAL_QUALITIES;
        }


        return $this;
    } // setApplicantEssayPersonalQualities()

    /**
     * Set the value of [applicant_essay_prior_experiences] column.
     *
     * @param string $v new value
     * @return Applicant The current object (for fluent API support)
     */
    public function setApplicantEssayPriorExperiences($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->applicant_essay_prior_experiences !== $v) {
            $this->applicant_essay_prior_experiences = $v;
            $this->modifiedColumns[] = ApplicantPeer::APPLICANT_ESSAY_PRIOR_EXPERIENCES;
        }


        return $this;
    } // setApplicantEssayPriorExperiences()

    /**
     * Set the value of [applicant_resume_cover_letter_attachment_file_name] column.
     *
     * @param string $v new value
     * @return Applicant The current object (for fluent API support)
     */
    public function setApplicantResumeCoverLetterAttachmentFileName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->applicant_resume_cover_letter_attachment_file_name !== $v) {
            $this->applicant_resume_cover_letter_attachment_file_name = $v;
            $this->modifiedColumns[] = ApplicantPeer::APPLICANT_RESUME_COVER_LETTER_ATTACHMENT_FILE_NAME;
        }


        return $this;
    } // setApplicantResumeCoverLetterAttachmentFileName()

    /**
     * Sets the value of [applicant_submission_date] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Applicant The current object (for fluent API support)
     */
    public function setApplicantSubmissionDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->applicant_submission_date !== null || $dt !== null) {
            $currentDateAsString = ($this->applicant_submission_date !== null && $tmpDt = new DateTime($this->applicant_submission_date)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->applicant_submission_date = $newDateAsString;
                $this->modifiedColumns[] = ApplicantPeer::APPLICANT_SUBMISSION_DATE;
            }
        } // if either are not null


        return $this;
    } // setApplicantSubmissionDate()

    /**
     * Sets the value of [applicant_submission_last_update] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Applicant The current object (for fluent API support)
     */
    public function setApplicantSubmissionLastUpdate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->applicant_submission_last_update !== null || $dt !== null) {
            $currentDateAsString = ($this->applicant_submission_last_update !== null && $tmpDt = new DateTime($this->applicant_submission_last_update)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ( ($currentDateAsString !== $newDateAsString) // normalized values don't match
                || ($dt->format('Y-m-d H:i:s') === NULL) // or the entered value matches the default
                 ) {
                $this->applicant_submission_last_update = $newDateAsString;
                $this->modifiedColumns[] = ApplicantPeer::APPLICANT_SUBMISSION_LAST_UPDATE;
            }
        } // if either are not null


        return $this;
    } // setApplicantSubmissionLastUpdate()

    /**
     * Set the value of [user_id] column.
     *
     * @param int $v new value
     * @return Applicant The current object (for fluent API support)
     */
    public function setUserId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->user_id !== $v) {
            $this->user_id = $v;
            $this->modifiedColumns[] = ApplicantPeer::USER_ID;
        }

        if ($this->aUser !== null && $this->aUser->getUserId() !== $v) {
            $this->aUser = null;
        }


        return $this;
    } // setUserId()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
            if ($this->applicant_submission_last_update !== NULL) {
                return false;
            }

        // otherwise, everything was equal, so return true
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->applicant_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->applicant_first_name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->applicant_last_name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->applicant_email_address = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->applicant_telephone_number = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->applicant_address_one = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->applicant_address_two = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->applicant_city = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->applicant_state_province_region = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->applicant_zip_postal_code = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->applicant_country = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->applicant_undergraduate_institution = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
            $this->applicant_graduate_institution = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
            $this->applicant_graduate_program = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
            $this->applicant_reference_one = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
            $this->applicant_reference_two = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
            $this->applicant_reference_three = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
            $this->applicant_essay_personal_qualities = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
            $this->applicant_essay_prior_experiences = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
            $this->applicant_resume_cover_letter_attachment_file_name = ($row[$startcol + 19] !== null) ? (string) $row[$startcol + 19] : null;
            $this->applicant_submission_date = ($row[$startcol + 20] !== null) ? (string) $row[$startcol + 20] : null;
            $this->applicant_submission_last_update = ($row[$startcol + 21] !== null) ? (string) $row[$startcol + 21] : null;
            $this->user_id = ($row[$startcol + 22] !== null) ? (int) $row[$startcol + 22] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 23; // 23 = ApplicantPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Applicant object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

        if ($this->aUser !== null && $this->user_id !== $this->aUser->getUserId()) {
            $this->aUser = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(ApplicantPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = ApplicantPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aUser = null;
            $this->collApplicantPositions = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(ApplicantPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = ApplicantQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(ApplicantPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                ApplicantPeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their coresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aUser !== null) {
                if ($this->aUser->isModified() || $this->aUser->isNew()) {
                    $affectedRows += $this->aUser->save($con);
                }
                $this->setUser($this->aUser);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->applicantPositionsScheduledForDeletion !== null) {
                if (!$this->applicantPositionsScheduledForDeletion->isEmpty()) {
                    ApplicantPositionQuery::create()
                        ->filterByPrimaryKeys($this->applicantPositionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->applicantPositionsScheduledForDeletion = null;
                }
            }

            if ($this->collApplicantPositions !== null) {
                foreach ($this->collApplicantPositions as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = ApplicantPeer::APPLICANT_ID;
        if (null !== $this->applicant_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ApplicantPeer::APPLICANT_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`APPLICANT_ID`';
        }
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_FIRST_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`APPLICANT_FIRST_NAME`';
        }
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_LAST_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`APPLICANT_LAST_NAME`';
        }
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_EMAIL_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = '`APPLICANT_EMAIL_ADDRESS`';
        }
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_TELEPHONE_NUMBER)) {
            $modifiedColumns[':p' . $index++]  = '`APPLICANT_TELEPHONE_NUMBER`';
        }
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_ADDRESS_ONE)) {
            $modifiedColumns[':p' . $index++]  = '`APPLICANT_ADDRESS_ONE`';
        }
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_ADDRESS_TWO)) {
            $modifiedColumns[':p' . $index++]  = '`APPLICANT_ADDRESS_TWO`';
        }
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_CITY)) {
            $modifiedColumns[':p' . $index++]  = '`APPLICANT_CITY`';
        }
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_STATE_PROVINCE_REGION)) {
            $modifiedColumns[':p' . $index++]  = '`APPLICANT_STATE_PROVINCE_REGION`';
        }
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_ZIP_POSTAL_CODE)) {
            $modifiedColumns[':p' . $index++]  = '`APPLICANT_ZIP_POSTAL_CODE`';
        }
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_COUNTRY)) {
            $modifiedColumns[':p' . $index++]  = '`APPLICANT_COUNTRY`';
        }
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_UNDERGRADUATE_INSTITUTION)) {
            $modifiedColumns[':p' . $index++]  = '`APPLICANT_UNDERGRADUATE_INSTITUTION`';
        }
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_GRADUATE_INSTITUTION)) {
            $modifiedColumns[':p' . $index++]  = '`APPLICANT_GRADUATE_INSTITUTION`';
        }
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_GRADUATE_PROGRAM)) {
            $modifiedColumns[':p' . $index++]  = '`APPLICANT_GRADUATE_PROGRAM`';
        }
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_REFERENCE_ONE)) {
            $modifiedColumns[':p' . $index++]  = '`APPLICANT_REFERENCE_ONE`';
        }
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_REFERENCE_TWO)) {
            $modifiedColumns[':p' . $index++]  = '`APPLICANT_REFERENCE_TWO`';
        }
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_REFERENCE_THREE)) {
            $modifiedColumns[':p' . $index++]  = '`APPLICANT_REFERENCE_THREE`';
        }
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_ESSAY_PERSONAL_QUALITIES)) {
            $modifiedColumns[':p' . $index++]  = '`APPLICANT_ESSAY_PERSONAL_QUALITIES`';
        }
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_ESSAY_PRIOR_EXPERIENCES)) {
            $modifiedColumns[':p' . $index++]  = '`APPLICANT_ESSAY_PRIOR_EXPERIENCES`';
        }
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_RESUME_COVER_LETTER_ATTACHMENT_FILE_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`APPLICANT_RESUME_COVER_LETTER_ATTACHMENT_FILE_NAME`';
        }
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_SUBMISSION_DATE)) {
            $modifiedColumns[':p' . $index++]  = '`APPLICANT_SUBMISSION_DATE`';
        }
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_SUBMISSION_LAST_UPDATE)) {
            $modifiedColumns[':p' . $index++]  = '`APPLICANT_SUBMISSION_LAST_UPDATE`';
        }
        if ($this->isColumnModified(ApplicantPeer::USER_ID)) {
            $modifiedColumns[':p' . $index++]  = '`USER_ID`';
        }

        $sql = sprintf(
            'INSERT INTO `applicant` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`APPLICANT_ID`':
                        $stmt->bindValue($identifier, $this->applicant_id, PDO::PARAM_INT);
                        break;
                    case '`APPLICANT_FIRST_NAME`':
                        $stmt->bindValue($identifier, $this->applicant_first_name, PDO::PARAM_STR);
                        break;
                    case '`APPLICANT_LAST_NAME`':
                        $stmt->bindValue($identifier, $this->applicant_last_name, PDO::PARAM_STR);
                        break;
                    case '`APPLICANT_EMAIL_ADDRESS`':
                        $stmt->bindValue($identifier, $this->applicant_email_address, PDO::PARAM_STR);
                        break;
                    case '`APPLICANT_TELEPHONE_NUMBER`':
                        $stmt->bindValue($identifier, $this->applicant_telephone_number, PDO::PARAM_STR);
                        break;
                    case '`APPLICANT_ADDRESS_ONE`':
                        $stmt->bindValue($identifier, $this->applicant_address_one, PDO::PARAM_STR);
                        break;
                    case '`APPLICANT_ADDRESS_TWO`':
                        $stmt->bindValue($identifier, $this->applicant_address_two, PDO::PARAM_STR);
                        break;
                    case '`APPLICANT_CITY`':
                        $stmt->bindValue($identifier, $this->applicant_city, PDO::PARAM_STR);
                        break;
                    case '`APPLICANT_STATE_PROVINCE_REGION`':
                        $stmt->bindValue($identifier, $this->applicant_state_province_region, PDO::PARAM_STR);
                        break;
                    case '`APPLICANT_ZIP_POSTAL_CODE`':
                        $stmt->bindValue($identifier, $this->applicant_zip_postal_code, PDO::PARAM_STR);
                        break;
                    case '`APPLICANT_COUNTRY`':
                        $stmt->bindValue($identifier, $this->applicant_country, PDO::PARAM_STR);
                        break;
                    case '`APPLICANT_UNDERGRADUATE_INSTITUTION`':
                        $stmt->bindValue($identifier, $this->applicant_undergraduate_institution, PDO::PARAM_STR);
                        break;
                    case '`APPLICANT_GRADUATE_INSTITUTION`':
                        $stmt->bindValue($identifier, $this->applicant_graduate_institution, PDO::PARAM_STR);
                        break;
                    case '`APPLICANT_GRADUATE_PROGRAM`':
                        $stmt->bindValue($identifier, $this->applicant_graduate_program, PDO::PARAM_STR);
                        break;
                    case '`APPLICANT_REFERENCE_ONE`':
                        $stmt->bindValue($identifier, $this->applicant_reference_one, PDO::PARAM_STR);
                        break;
                    case '`APPLICANT_REFERENCE_TWO`':
                        $stmt->bindValue($identifier, $this->applicant_reference_two, PDO::PARAM_STR);
                        break;
                    case '`APPLICANT_REFERENCE_THREE`':
                        $stmt->bindValue($identifier, $this->applicant_reference_three, PDO::PARAM_STR);
                        break;
                    case '`APPLICANT_ESSAY_PERSONAL_QUALITIES`':
                        $stmt->bindValue($identifier, $this->applicant_essay_personal_qualities, PDO::PARAM_STR);
                        break;
                    case '`APPLICANT_ESSAY_PRIOR_EXPERIENCES`':
                        $stmt->bindValue($identifier, $this->applicant_essay_prior_experiences, PDO::PARAM_STR);
                        break;
                    case '`APPLICANT_RESUME_COVER_LETTER_ATTACHMENT_FILE_NAME`':
                        $stmt->bindValue($identifier, $this->applicant_resume_cover_letter_attachment_file_name, PDO::PARAM_STR);
                        break;
                    case '`APPLICANT_SUBMISSION_DATE`':
                        $stmt->bindValue($identifier, $this->applicant_submission_date, PDO::PARAM_STR);
                        break;
                    case '`APPLICANT_SUBMISSION_LAST_UPDATE`':
                        $stmt->bindValue($identifier, $this->applicant_submission_last_update, PDO::PARAM_STR);
                        break;
                    case '`USER_ID`':
                        $stmt->bindValue($identifier, $this->user_id, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setApplicantId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        } else {
            $this->validationFailures = $res;

            return false;
        }
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggreagated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            // We call the validate method on the following object(s) if they
            // were passed to this object by their coresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aUser !== null) {
                if (!$this->aUser->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aUser->getValidationFailures());
                }
            }


            if (($retval = ApplicantPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collApplicantPositions !== null) {
                    foreach ($this->collApplicantPositions as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }


            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = ApplicantPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getApplicantId();
                break;
            case 1:
                return $this->getApplicantFirstName();
                break;
            case 2:
                return $this->getApplicantLastName();
                break;
            case 3:
                return $this->getApplicantEmailAddress();
                break;
            case 4:
                return $this->getApplicantTelephoneNumber();
                break;
            case 5:
                return $this->getApplicantAddressOne();
                break;
            case 6:
                return $this->getApplicantAddressTwo();
                break;
            case 7:
                return $this->getApplicantCity();
                break;
            case 8:
                return $this->getApplicantStateProvinceRegion();
                break;
            case 9:
                return $this->getApplicantZipPostalCode();
                break;
            case 10:
                return $this->getApplicantCountry();
                break;
            case 11:
                return $this->getApplicantUndergraduateInstitution();
                break;
            case 12:
                return $this->getApplicantGraduateInstitution();
                break;
            case 13:
                return $this->getApplicantGraduateProgram();
                break;
            case 14:
                return $this->getApplicantReferenceOne();
                break;
            case 15:
                return $this->getApplicantReferenceTwo();
                break;
            case 16:
                return $this->getApplicantReferenceThree();
                break;
            case 17:
                return $this->getApplicantEssayPersonalQualities();
                break;
            case 18:
                return $this->getApplicantEssayPriorExperiences();
                break;
            case 19:
                return $this->getApplicantResumeCoverLetterAttachmentFileName();
                break;
            case 20:
                return $this->getApplicantSubmissionDate();
                break;
            case 21:
                return $this->getApplicantSubmissionLastUpdate();
                break;
            case 22:
                return $this->getUserId();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['Applicant'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Applicant'][$this->getPrimaryKey()] = true;
        $keys = ApplicantPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getApplicantId(),
            $keys[1] => $this->getApplicantFirstName(),
            $keys[2] => $this->getApplicantLastName(),
            $keys[3] => $this->getApplicantEmailAddress(),
            $keys[4] => $this->getApplicantTelephoneNumber(),
            $keys[5] => $this->getApplicantAddressOne(),
            $keys[6] => $this->getApplicantAddressTwo(),
            $keys[7] => $this->getApplicantCity(),
            $keys[8] => $this->getApplicantStateProvinceRegion(),
            $keys[9] => $this->getApplicantZipPostalCode(),
            $keys[10] => $this->getApplicantCountry(),
            $keys[11] => $this->getApplicantUndergraduateInstitution(),
            $keys[12] => $this->getApplicantGraduateInstitution(),
            $keys[13] => $this->getApplicantGraduateProgram(),
            $keys[14] => $this->getApplicantReferenceOne(),
            $keys[15] => $this->getApplicantReferenceTwo(),
            $keys[16] => $this->getApplicantReferenceThree(),
            $keys[17] => $this->getApplicantEssayPersonalQualities(),
            $keys[18] => $this->getApplicantEssayPriorExperiences(),
            $keys[19] => $this->getApplicantResumeCoverLetterAttachmentFileName(),
            $keys[20] => $this->getApplicantSubmissionDate(),
            $keys[21] => $this->getApplicantSubmissionLastUpdate(),
            $keys[22] => $this->getUserId(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aUser) {
                $result['User'] = $this->aUser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collApplicantPositions) {
                $result['ApplicantPositions'] = $this->collApplicantPositions->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = ApplicantPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setApplicantId($value);
                break;
            case 1:
                $this->setApplicantFirstName($value);
                break;
            case 2:
                $this->setApplicantLastName($value);
                break;
            case 3:
                $this->setApplicantEmailAddress($value);
                break;
            case 4:
                $this->setApplicantTelephoneNumber($value);
                break;
            case 5:
                $this->setApplicantAddressOne($value);
                break;
            case 6:
                $this->setApplicantAddressTwo($value);
                break;
            case 7:
                $this->setApplicantCity($value);
                break;
            case 8:
                $this->setApplicantStateProvinceRegion($value);
                break;
            case 9:
                $this->setApplicantZipPostalCode($value);
                break;
            case 10:
                $this->setApplicantCountry($value);
                break;
            case 11:
                $this->setApplicantUndergraduateInstitution($value);
                break;
            case 12:
                $this->setApplicantGraduateInstitution($value);
                break;
            case 13:
                $this->setApplicantGraduateProgram($value);
                break;
            case 14:
                $this->setApplicantReferenceOne($value);
                break;
            case 15:
                $this->setApplicantReferenceTwo($value);
                break;
            case 16:
                $this->setApplicantReferenceThree($value);
                break;
            case 17:
                $this->setApplicantEssayPersonalQualities($value);
                break;
            case 18:
                $this->setApplicantEssayPriorExperiences($value);
                break;
            case 19:
                $this->setApplicantResumeCoverLetterAttachmentFileName($value);
                break;
            case 20:
                $this->setApplicantSubmissionDate($value);
                break;
            case 21:
                $this->setApplicantSubmissionLastUpdate($value);
                break;
            case 22:
                $this->setUserId($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = ApplicantPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setApplicantId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setApplicantFirstName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setApplicantLastName($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setApplicantEmailAddress($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setApplicantTelephoneNumber($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setApplicantAddressOne($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setApplicantAddressTwo($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setApplicantCity($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setApplicantStateProvinceRegion($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setApplicantZipPostalCode($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setApplicantCountry($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setApplicantUndergraduateInstitution($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setApplicantGraduateInstitution($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setApplicantGraduateProgram($arr[$keys[13]]);
        if (array_key_exists($keys[14], $arr)) $this->setApplicantReferenceOne($arr[$keys[14]]);
        if (array_key_exists($keys[15], $arr)) $this->setApplicantReferenceTwo($arr[$keys[15]]);
        if (array_key_exists($keys[16], $arr)) $this->setApplicantReferenceThree($arr[$keys[16]]);
        if (array_key_exists($keys[17], $arr)) $this->setApplicantEssayPersonalQualities($arr[$keys[17]]);
        if (array_key_exists($keys[18], $arr)) $this->setApplicantEssayPriorExperiences($arr[$keys[18]]);
        if (array_key_exists($keys[19], $arr)) $this->setApplicantResumeCoverLetterAttachmentFileName($arr[$keys[19]]);
        if (array_key_exists($keys[20], $arr)) $this->setApplicantSubmissionDate($arr[$keys[20]]);
        if (array_key_exists($keys[21], $arr)) $this->setApplicantSubmissionLastUpdate($arr[$keys[21]]);
        if (array_key_exists($keys[22], $arr)) $this->setUserId($arr[$keys[22]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(ApplicantPeer::DATABASE_NAME);

        if ($this->isColumnModified(ApplicantPeer::APPLICANT_ID)) $criteria->add(ApplicantPeer::APPLICANT_ID, $this->applicant_id);
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_FIRST_NAME)) $criteria->add(ApplicantPeer::APPLICANT_FIRST_NAME, $this->applicant_first_name);
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_LAST_NAME)) $criteria->add(ApplicantPeer::APPLICANT_LAST_NAME, $this->applicant_last_name);
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_EMAIL_ADDRESS)) $criteria->add(ApplicantPeer::APPLICANT_EMAIL_ADDRESS, $this->applicant_email_address);
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_TELEPHONE_NUMBER)) $criteria->add(ApplicantPeer::APPLICANT_TELEPHONE_NUMBER, $this->applicant_telephone_number);
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_ADDRESS_ONE)) $criteria->add(ApplicantPeer::APPLICANT_ADDRESS_ONE, $this->applicant_address_one);
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_ADDRESS_TWO)) $criteria->add(ApplicantPeer::APPLICANT_ADDRESS_TWO, $this->applicant_address_two);
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_CITY)) $criteria->add(ApplicantPeer::APPLICANT_CITY, $this->applicant_city);
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_STATE_PROVINCE_REGION)) $criteria->add(ApplicantPeer::APPLICANT_STATE_PROVINCE_REGION, $this->applicant_state_province_region);
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_ZIP_POSTAL_CODE)) $criteria->add(ApplicantPeer::APPLICANT_ZIP_POSTAL_CODE, $this->applicant_zip_postal_code);
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_COUNTRY)) $criteria->add(ApplicantPeer::APPLICANT_COUNTRY, $this->applicant_country);
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_UNDERGRADUATE_INSTITUTION)) $criteria->add(ApplicantPeer::APPLICANT_UNDERGRADUATE_INSTITUTION, $this->applicant_undergraduate_institution);
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_GRADUATE_INSTITUTION)) $criteria->add(ApplicantPeer::APPLICANT_GRADUATE_INSTITUTION, $this->applicant_graduate_institution);
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_GRADUATE_PROGRAM)) $criteria->add(ApplicantPeer::APPLICANT_GRADUATE_PROGRAM, $this->applicant_graduate_program);
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_REFERENCE_ONE)) $criteria->add(ApplicantPeer::APPLICANT_REFERENCE_ONE, $this->applicant_reference_one);
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_REFERENCE_TWO)) $criteria->add(ApplicantPeer::APPLICANT_REFERENCE_TWO, $this->applicant_reference_two);
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_REFERENCE_THREE)) $criteria->add(ApplicantPeer::APPLICANT_REFERENCE_THREE, $this->applicant_reference_three);
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_ESSAY_PERSONAL_QUALITIES)) $criteria->add(ApplicantPeer::APPLICANT_ESSAY_PERSONAL_QUALITIES, $this->applicant_essay_personal_qualities);
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_ESSAY_PRIOR_EXPERIENCES)) $criteria->add(ApplicantPeer::APPLICANT_ESSAY_PRIOR_EXPERIENCES, $this->applicant_essay_prior_experiences);
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_RESUME_COVER_LETTER_ATTACHMENT_FILE_NAME)) $criteria->add(ApplicantPeer::APPLICANT_RESUME_COVER_LETTER_ATTACHMENT_FILE_NAME, $this->applicant_resume_cover_letter_attachment_file_name);
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_SUBMISSION_DATE)) $criteria->add(ApplicantPeer::APPLICANT_SUBMISSION_DATE, $this->applicant_submission_date);
        if ($this->isColumnModified(ApplicantPeer::APPLICANT_SUBMISSION_LAST_UPDATE)) $criteria->add(ApplicantPeer::APPLICANT_SUBMISSION_LAST_UPDATE, $this->applicant_submission_last_update);
        if ($this->isColumnModified(ApplicantPeer::USER_ID)) $criteria->add(ApplicantPeer::USER_ID, $this->user_id);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(ApplicantPeer::DATABASE_NAME);
        $criteria->add(ApplicantPeer::APPLICANT_ID, $this->applicant_id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getApplicantId();
    }

    /**
     * Generic method to set the primary key (applicant_id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setApplicantId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getApplicantId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Applicant (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setApplicantFirstName($this->getApplicantFirstName());
        $copyObj->setApplicantLastName($this->getApplicantLastName());
        $copyObj->setApplicantEmailAddress($this->getApplicantEmailAddress());
        $copyObj->setApplicantTelephoneNumber($this->getApplicantTelephoneNumber());
        $copyObj->setApplicantAddressOne($this->getApplicantAddressOne());
        $copyObj->setApplicantAddressTwo($this->getApplicantAddressTwo());
        $copyObj->setApplicantCity($this->getApplicantCity());
        $copyObj->setApplicantStateProvinceRegion($this->getApplicantStateProvinceRegion());
        $copyObj->setApplicantZipPostalCode($this->getApplicantZipPostalCode());
        $copyObj->setApplicantCountry($this->getApplicantCountry());
        $copyObj->setApplicantUndergraduateInstitution($this->getApplicantUndergraduateInstitution());
        $copyObj->setApplicantGraduateInstitution($this->getApplicantGraduateInstitution());
        $copyObj->setApplicantGraduateProgram($this->getApplicantGraduateProgram());
        $copyObj->setApplicantReferenceOne($this->getApplicantReferenceOne());
        $copyObj->setApplicantReferenceTwo($this->getApplicantReferenceTwo());
        $copyObj->setApplicantReferenceThree($this->getApplicantReferenceThree());
        $copyObj->setApplicantEssayPersonalQualities($this->getApplicantEssayPersonalQualities());
        $copyObj->setApplicantEssayPriorExperiences($this->getApplicantEssayPriorExperiences());
        $copyObj->setApplicantResumeCoverLetterAttachmentFileName($this->getApplicantResumeCoverLetterAttachmentFileName());
        $copyObj->setApplicantSubmissionDate($this->getApplicantSubmissionDate());
        $copyObj->setApplicantSubmissionLastUpdate($this->getApplicantSubmissionLastUpdate());
        $copyObj->setUserId($this->getUserId());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getApplicantPositions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addApplicantPosition($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setApplicantId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return Applicant Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return ApplicantPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new ApplicantPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a User object.
     *
     * @param             User $v
     * @return Applicant The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUser(User $v = null)
    {
        if ($v === null) {
            $this->setUserId(NULL);
        } else {
            $this->setUserId($v->getUserId());
        }

        $this->aUser = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the User object, it will not be re-added.
        if ($v !== null) {
            $v->addApplicant($this);
        }


        return $this;
    }


    /**
     * Get the associated User object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return User The associated User object.
     * @throws PropelException
     */
    public function getUser(PropelPDO $con = null)
    {
        if ($this->aUser === null && ($this->user_id !== null)) {
            $this->aUser = UserQuery::create()->findPk($this->user_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUser->addApplicants($this);
             */
        }

        return $this->aUser;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('ApplicantPosition' == $relationName) {
            $this->initApplicantPositions();
        }
    }

    /**
     * Clears out the collApplicantPositions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addApplicantPositions()
     */
    public function clearApplicantPositions()
    {
        $this->collApplicantPositions = null; // important to set this to null since that means it is uninitialized
        $this->collApplicantPositionsPartial = null;
    }

    /**
     * reset is the collApplicantPositions collection loaded partially
     *
     * @return void
     */
    public function resetPartialApplicantPositions($v = true)
    {
        $this->collApplicantPositionsPartial = $v;
    }

    /**
     * Initializes the collApplicantPositions collection.
     *
     * By default this just sets the collApplicantPositions collection to an empty array (like clearcollApplicantPositions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initApplicantPositions($overrideExisting = true)
    {
        if (null !== $this->collApplicantPositions && !$overrideExisting) {
            return;
        }
        $this->collApplicantPositions = new PropelObjectCollection();
        $this->collApplicantPositions->setModel('ApplicantPosition');
    }

    /**
     * Gets an array of ApplicantPosition objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Applicant is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|ApplicantPosition[] List of ApplicantPosition objects
     * @throws PropelException
     */
    public function getApplicantPositions($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collApplicantPositionsPartial && !$this->isNew();
        if (null === $this->collApplicantPositions || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collApplicantPositions) {
                // return empty collection
                $this->initApplicantPositions();
            } else {
                $collApplicantPositions = ApplicantPositionQuery::create(null, $criteria)
                    ->filterByApplicant($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collApplicantPositionsPartial && count($collApplicantPositions)) {
                      $this->initApplicantPositions(false);

                      foreach($collApplicantPositions as $obj) {
                        if (false == $this->collApplicantPositions->contains($obj)) {
                          $this->collApplicantPositions->append($obj);
                        }
                      }

                      $this->collApplicantPositionsPartial = true;
                    }

                    return $collApplicantPositions;
                }

                if($partial && $this->collApplicantPositions) {
                    foreach($this->collApplicantPositions as $obj) {
                        if($obj->isNew()) {
                            $collApplicantPositions[] = $obj;
                        }
                    }
                }

                $this->collApplicantPositions = $collApplicantPositions;
                $this->collApplicantPositionsPartial = false;
            }
        }

        return $this->collApplicantPositions;
    }

    /**
     * Sets a collection of ApplicantPosition objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $applicantPositions A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setApplicantPositions(PropelCollection $applicantPositions, PropelPDO $con = null)
    {
        $this->applicantPositionsScheduledForDeletion = $this->getApplicantPositions(new Criteria(), $con)->diff($applicantPositions);

        foreach ($this->applicantPositionsScheduledForDeletion as $applicantPositionRemoved) {
            $applicantPositionRemoved->setApplicant(null);
        }

        $this->collApplicantPositions = null;
        foreach ($applicantPositions as $applicantPosition) {
            $this->addApplicantPosition($applicantPosition);
        }

        $this->collApplicantPositions = $applicantPositions;
        $this->collApplicantPositionsPartial = false;
    }

    /**
     * Returns the number of related ApplicantPosition objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related ApplicantPosition objects.
     * @throws PropelException
     */
    public function countApplicantPositions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collApplicantPositionsPartial && !$this->isNew();
        if (null === $this->collApplicantPositions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collApplicantPositions) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getApplicantPositions());
                }
                $query = ApplicantPositionQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByApplicant($this)
                    ->count($con);
            }
        } else {
            return count($this->collApplicantPositions);
        }
    }

    /**
     * Method called to associate a ApplicantPosition object to this object
     * through the ApplicantPosition foreign key attribute.
     *
     * @param    ApplicantPosition $l ApplicantPosition
     * @return Applicant The current object (for fluent API support)
     */
    public function addApplicantPosition(ApplicantPosition $l)
    {
        if ($this->collApplicantPositions === null) {
            $this->initApplicantPositions();
            $this->collApplicantPositionsPartial = true;
        }
        if (!$this->collApplicantPositions->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddApplicantPosition($l);
        }

        return $this;
    }

    /**
     * @param	ApplicantPosition $applicantPosition The applicantPosition object to add.
     */
    protected function doAddApplicantPosition($applicantPosition)
    {
        $this->collApplicantPositions[]= $applicantPosition;
        $applicantPosition->setApplicant($this);
    }

    /**
     * @param	ApplicantPosition $applicantPosition The applicantPosition object to remove.
     */
    public function removeApplicantPosition($applicantPosition)
    {
        if ($this->getApplicantPositions()->contains($applicantPosition)) {
            $this->collApplicantPositions->remove($this->collApplicantPositions->search($applicantPosition));
            if (null === $this->applicantPositionsScheduledForDeletion) {
                $this->applicantPositionsScheduledForDeletion = clone $this->collApplicantPositions;
                $this->applicantPositionsScheduledForDeletion->clear();
            }
            $this->applicantPositionsScheduledForDeletion[]= $applicantPosition;
            $applicantPosition->setApplicant(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Applicant is new, it will return
     * an empty collection; or if this Applicant has previously
     * been saved, it will retrieve related ApplicantPositions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Applicant.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ApplicantPosition[] List of ApplicantPosition objects
     */
    public function getApplicantPositionsJoinPosition($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ApplicantPositionQuery::create(null, $criteria);
        $query->joinWith('Position', $join_behavior);

        return $this->getApplicantPositions($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->applicant_id = null;
        $this->applicant_first_name = null;
        $this->applicant_last_name = null;
        $this->applicant_email_address = null;
        $this->applicant_telephone_number = null;
        $this->applicant_address_one = null;
        $this->applicant_address_two = null;
        $this->applicant_city = null;
        $this->applicant_state_province_region = null;
        $this->applicant_zip_postal_code = null;
        $this->applicant_country = null;
        $this->applicant_undergraduate_institution = null;
        $this->applicant_graduate_institution = null;
        $this->applicant_graduate_program = null;
        $this->applicant_reference_one = null;
        $this->applicant_reference_two = null;
        $this->applicant_reference_three = null;
        $this->applicant_essay_personal_qualities = null;
        $this->applicant_essay_prior_experiences = null;
        $this->applicant_resume_cover_letter_attachment_file_name = null;
        $this->applicant_submission_date = null;
        $this->applicant_submission_last_update = null;
        $this->user_id = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volumne/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collApplicantPositions) {
                foreach ($this->collApplicantPositions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collApplicantPositions instanceof PropelCollection) {
            $this->collApplicantPositions->clearIterator();
        }
        $this->collApplicantPositions = null;
        $this->aUser = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ApplicantPeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

}
