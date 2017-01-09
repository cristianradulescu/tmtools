<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reimbursement
 *
 * @ORM\Table(name="reimbursement", indexes={@ORM\Index(name="fk_reimbursement_reimbursement_type_idx", columns={"type_id"}), @ORM\Index(name="fk_reimbursement_employee_idx", columns={"employee_id"})})
 * @ORM\Entity
 */
class Reimbursement
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
     * @var \ReimbursementType
     *
     * @ORM\ManyToOne(targetEntity="ReimbursementType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     * })
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=45, nullable=false)
     */
    private $number;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $value;

    /**
     * @var \Employee
     *
     * @ORM\ManyToOne(targetEntity="Employee")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="employee_id", referencedColumnName="id")
     * })
     */
    private $employee;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ReimbursementDocument", mappedBy="reimbursement")
     */
    private $reimbursementDocument;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reimbursementDocument = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set type
     *
     * @param \AppBundle\Entity\ReimbursementType $type
     *
     * @return Reimbursement
     */
    public function setType(\AppBundle\Entity\ReimbursementType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \AppBundle\Entity\ReimbursementType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set number
     *
     * @param string $number
     *
     * @return Reimbursement
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Reimbursement
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return Reimbursement
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set employee
     *
     * @param \AppBundle\Entity\Employee $employee
     *
     * @return Reimbursement
     */
    public function setEmployee(\AppBundle\Entity\Employee $employee = null)
    {
        $this->employee = $employee;

        return $this;
    }

    /**
     * Get employee
     *
     * @return \AppBundle\Entity\Employee
     */
    public function getEmployee()
    {
        return $this->employee;
    }

    /**
     * Add reimbursementDocument
     *
     * @param \AppBundle\Entity\ReimbursementDocument $reimbursementDocument
     *
     * @return Reimbursement
     */
    public function addReimbursementDocument(\AppBundle\Entity\ReimbursementDocument $reimbursementDocument)
    {
        $this->reimbursementDocument[] = $reimbursementDocument;

        return $this;
    }

    /**
     * Remove reimbursementDocument
     *
     * @param \AppBundle\Entity\ReimbursementDocument $reimbursementDocument
     */
    public function removeReimbursementDocument(\AppBundle\Entity\ReimbursementDocument $reimbursementDocument)
    {
        $this->reimbursementDocument->removeElement($reimbursementDocument);
    }

    /**
     * Get reimbursementDocument
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReimbursementDocument()
    {
        return $this->reimbursementDocument;
    }

    public function __toString()
    {
        return (string)$this->type.' '.$this->number.' / '.$this->date->format('d-M-Y');
    }
}
