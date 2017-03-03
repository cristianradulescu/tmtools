<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Document
 *
 * @ORM\Table(name="document", indexes={@ORM\Index(name="fk_document_employee_id", columns={"employee_id"}), @ORM\Index(name="fk_document_status_id", columns={"status_id"}), @ORM\Index(name="fk_document_type_id", columns={"type_id"})})
 * @ORM\Entity
 */
class Document
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
     * @var \Travel
     *
     * @ORM\OneToOne(
     *     targetEntity="Travel",
     *     mappedBy="document",
     *     cascade={"persist"}
     * )
     */
    private $travel;

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
     * @var \Acquisition
     *
     * @ORM\OneToOne(
     *     targetEntity="Acquisition",
     *     mappedBy="document",
     *     cascade={"persist"}
     * )
     */
    private $acquisition;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;

    /**
     * Document constructor.
     */
    public function __construct()
    {
        $this->reimbursements = new ArrayCollection();
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
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
     * Get reimbursement
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReimbursements()
    {
        return $this->reimbursements;
    }

    /**
     * Get travel
     *
     * @return Travel
     */
    public function getTravel()
    {
        return $this->travel;
    }

    /**
     * Get acquisition
     *
     * @return Acquisition
     */
    public function getAcquisition()
    {
        return $this->acquisition;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Document
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Document
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
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
     * @return bool
     */
    public function isAcquisitionDocument()
    {
        return DocumentType::TYPE_ACQUISITION === $this->getType()->getId();
    }

    /**
     * @return bool
     */
    public function hasTravel()
    {
        return null !== $this->getTravel();
    }

    /**
     * @return bool
     */
    public function hasAcquisition()
    {
        return null !== $this->getAcquisition();
    }

    /**
     * @return float
     */
    public function getTotalAmount()
    {
        $total = 0;
        if ($this->isReimbursementDocument()) {
            foreach ($this->getReimbursements() as $reimbursement) {
                $total += $reimbursement->getValue();
            }

            return round($total, 2);
        }

        if ($this->isTravelDocument() && $this->hasTravel()) {
            return round($this->getTravel()->getNumberOfDaysOnTravel() * Travel::TRAVEL_ALLOWANCE, 2);
        }

        if ($this->isAcquisitionDocument() && $this->hasAcquisition()) {
            /** @var Bill $bill */
            foreach($this->getAcquisition()->getBills() as $bill) {
                $total += $bill->getValue();
            }

            return round($total, 2);
        }

        return $total;
    }

    /**
     * Generate an unique identifier based on the document's type.
     *
     * Formula: the document's type name, lowercased, sufixed with '_document'.
     *
     * @return string
     */
    public function getTypeUniqueId()
    {
        return strtolower($this->getType()->getName()).'_document';
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $representation = $this->getType().' - '.$this->getEmployee();
        if ($this->isTravelDocument() && $this->hasTravel()) {
            return  $representation.', '.$this->getTravel()->getDateStart()->format('d M Y');
        }

        return $representation;
    }
}
