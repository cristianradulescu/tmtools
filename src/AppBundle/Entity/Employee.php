<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Employee
 *
 * @ORM\Table(name="employee", uniqueConstraints={@ORM\UniqueConstraint(name="username_UNIQUE", columns={"username"}), @ORM\UniqueConstraint(name="email_address_UNIQUE", columns={"email_address"}), @ORM\UniqueConstraint(name="personal_numeric_code_UNIQUE", columns={"personal_numeric_code"}), @ORM\UniqueConstraint(name="identity_card_number_UNIQUE", columns={"identity_card_number"})}, indexes={@ORM\Index(name="fk_employee_job_title_idx", columns={"job_title_id"}), @ORM\Index(name="fk_employee_employee_idx", columns={"direct_manager_id"}), @ORM\Index(name="fk_employee_team_idx", columns={"team_id"})})
 * @ORM\Entity
 */
class Employee
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=45, nullable=false)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=45, nullable=false)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email_address", type="string", length=255, nullable=false)
     */
    private $emailAddress;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="date", nullable=true)
     */
    private $birthday;

    /**
     * @var integer
     *
     * @ORM\Column(name="personal_numeric_code", type="bigint", nullable=true)
     */
    private $personalNumericCode;

    /**
     * @var string
     *
     * @ORM\Column(name="identity_card_number", type="string", length=45, nullable=true)
     */
    private $identityCardNumber;

    /**
     * @var \Employee
     *
     * @ORM\ManyToOne(targetEntity="Employee")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="direct_manager_id", referencedColumnName="id")
     * })
     */
    private $directManager;

    /**
     * @var \JobTitle
     *
     * @ORM\ManyToOne(targetEntity="JobTitle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="job_title_id", referencedColumnName="id")
     * })
     */
    private $jobTitle;

    /**
     * @var \Team
     *
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     * })
     */
    private $team;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Employee
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Employee
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Employee
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set emailAddress
     *
     * @param string $emailAddress
     *
     * @return Employee
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;

        return $this;
    }

    /**
     * Get emailAddress
     *
     * @return string
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     *
     * @return Employee
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set personalNumericCode
     *
     * @param integer $personalNumericCode
     *
     * @return Employee
     */
    public function setPersonalNumericCode($personalNumericCode)
    {
        $this->personalNumericCode = $personalNumericCode;

        return $this;
    }

    /**
     * Get personalNumericCode
     *
     * @return integer
     */
    public function getPersonalNumericCode()
    {
        return $this->personalNumericCode;
    }

    /**
     * Set identityCardNumber
     *
     * @param string $identityCardNumber
     *
     * @return Employee
     */
    public function setIdentityCardNumber($identityCardNumber)
    {
        $this->identityCardNumber = $identityCardNumber;

        return $this;
    }

    /**
     * Get identityCardNumber
     *
     * @return string
     */
    public function getIdentityCardNumber()
    {
        return $this->identityCardNumber;
    }

    /**
     * Set directManager
     *
     * @param \AppBundle\Entity\Employee $directManager
     *
     * @return Employee
     */
    public function setDirectManager(\AppBundle\Entity\Employee $directManager = null)
    {
        $this->directManager = $directManager;

        return $this;
    }

    /**
     * Get directManager
     *
     * @return \AppBundle\Entity\Employee
     */
    public function getDirectManager()
    {
        return $this->directManager;
    }

    /**
     * Set jobTitle
     *
     * @param \AppBundle\Entity\JobTitle $jobTitle
     *
     * @return Employee
     */
    public function setJobTitle(\AppBundle\Entity\JobTitle $jobTitle = null)
    {
        $this->jobTitle = $jobTitle;

        return $this;
    }

    /**
     * Get jobTitle
     *
     * @return \AppBundle\Entity\JobTitle
     */
    public function getJobTitle()
    {
        return $this->jobTitle;
    }

    /**
     * Set team
     *
     * @param \AppBundle\Entity\Team $team
     *
     * @return Employee
     */
    public function setTeam(\AppBundle\Entity\Team $team = null)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return \AppBundle\Entity\Team
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Get full employee name
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->lastName.' '.$this->firstName;
    }

    /**
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getFullName();
    }
}
