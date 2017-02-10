<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Document
 *
 * @ORM\Table(
 *     name="document",
 *     indexes={
 *         @ORM\Index(
 *             name="document_document_status_id_fk",
 *             columns={"status_id"}
 *         ),
 *         @ORM\Index(
 *             name="document_document_type_id_fk",
 *             columns={"type_id"}
 *         ),
 *         @ORM\Index(
 *             name="document_demployee_id_fk",
 *             columns={"employee_id"}
 *         )}
 * )
 * @ORM\Entity
 */
class Document
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="document_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

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
     * @var \DocumentStatus
     *
     * @ORM\ManyToOne(targetEntity="DocumentStatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     * })
     */
    private $status;

    /**
     * @var \DocumentType
     *
     * @ORM\ManyToOne(targetEntity="DocumentType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     * })
     */
    private $type;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(
     *     targetEntity="Travel",
     *     mappedBy="document",
     *     cascade={"persist"}
     * )
     */
    private $travels;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(
     *     targetEntity="Reimbursement",
     *     mappedBy="document",
     *     cascade={"persist"}
     * )
     */
    private $reimbursements;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->travels = new \Doctrine\Common\Collections\ArrayCollection();
        $this->reimbursements = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set employee
     *
     * @param \AppBundle\Entity\Employee $employee
     *
     * @return Document
     */
    public function setEmployee($employee)
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
     * Set status
     *
     * @param \AppBundle\Entity\DocumentStatus $status
     *
     * @return Document
     */
    public function setStatus(\AppBundle\Entity\DocumentStatus $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \AppBundle\Entity\DocumentStatus
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set type
     *
     * @param \AppBundle\Entity\DocumentType $type
     *
     * @return Document
     */
    public function setType(\AppBundle\Entity\DocumentType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \AppBundle\Entity\DocumentType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add travels
     *
     * @param \AppBundle\Entity\Travel $travel
     *
     * @return Document
     */
    public function addTravel(\AppBundle\Entity\Travel $travel)
    {
        $travel->setDocument($this);
        $this->travels[] = $travel;

        return $this;
    }

    /**
     * Remove travels
     *
     * @param \AppBundle\Entity\Travel $travel
     */
    public function removeTravel(\AppBundle\Entity\Travel $travel)
    {
        $travel->setDocument(null);
        $this->travels->removeElement($travel);

    }

    /**
     * Get travel
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTravels()
    {
        return $this->travels;
    }

    /**
     * @param $travels
     * @return $this
     */
    public function setTravels($travels)
    {
        foreach ($travels as $travel) {
            $this->addTravel($travel);
        }

        return $this;
    }

    /**
     * Add reimbursement
     *
     * @param \AppBundle\Entity\Reimbursement $reimbursement
     *
     * @return Document
     */
    public function addReimbursement(\AppBundle\Entity\Reimbursement $reimbursement)
    {
        $reimbursement->setDocument($this);
        $this->reimbursements[] = $reimbursement;

        return $this;
    }

    /**
     * Remove reimbursement
     *
     * @param \AppBundle\Entity\Reimbursement $reimbursement
     */
    public function removeReimbursement(\AppBundle\Entity\Reimbursement $reimbursement)
    {
        $reimbursement->setDocument(null);
        $this->reimbursements->removeElement($reimbursement);

    }

    /**
     * Get reimbursement
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReimbursements()
    {
        return $this->reimbursements;
    }

    /**
     * @param $reimbursements
     * @return $this
     */
    public function setReimbursements($reimbursements)
    {
        foreach ($reimbursements as $reimbursement) {
            $this->addReimbursement($reimbursement);
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function isTravelDocument()
    {
        return DocumentType::TYPE_TRAVEL === $this->getType()->getId();
    }

    /**
     * @return bool
     */
    public function isReimbursementDocument()
    {
        return DocumentType::TYPE_REIMBURSEMENT === $this->getType()->getId();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getType().' - '.$this->getEmployee();
    }
}
