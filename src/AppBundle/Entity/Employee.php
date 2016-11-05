<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Employee
 *
 * @ORM\Table(name="employee")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EmployeeRepository")
 */
class Employee
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email_address", type="string", length=255, unique=true)
     */
    private $emailAddress;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="date")
     */
    private $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="personal_numeric_code", type="bigint", length=20, unique=true, options={"unsigned"=true})
     */
    private $personalNumericCode;

    /**
     * @var string
     *
     * @ORM\Column(name="identity_card_number", type="string", length=255, unique=true)
     */
    private $identityCardNumber;


    /**
     * Get id
     *
     * @return int
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
     * @param string $personalNumericCode
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
     * @return string
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
     * Get full name.
     *
     * Concatenate last name with first name.
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->lastName.' '.$this->firstName;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getFullName();
    }
}
