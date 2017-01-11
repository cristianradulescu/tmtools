<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReimbursementDocument
 *
 * @ORM\Table(name="reimbursement_document", indexes={@ORM\Index(name="fk_reimbursement_document_employee_idx", columns={"employee_id"}), @ORM\Index(name="fk_reimbursement_document_status_idx", columns={"status_id"})})
 * @ORM\Entity
 */
class ReimbursementDocument implements DocumentStatusInterface, EmployeeInterface
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
     * @var \Status
     *
     * @ORM\ManyToOne(targetEntity="Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     * })
     */
    private $status;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(
     *     targetEntity="Reimbursement",
     *     mappedBy="reimbursementDocument",
     *     cascade={"persist"}
     * )
     */
    private $reimbursements;

    /**
     * Constructor
     */
    public function __construct()
    {
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
     * @return ReimbursementDocument
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
     * @param \AppBundle\Entity\Status $status
     *
     * @return ReimbursementDocument
     */
    public function setStatus(\AppBundle\Entity\Status $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \AppBundle\Entity\Status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Add reimbursement
     *
     * @param \AppBundle\Entity\Reimbursement $reimbursement
     *
     * @return ReimbursementDocument
     */
    public function addReimbursements(\AppBundle\Entity\Reimbursement $reimbursement)
    {
        $reimbursement->setReimbursementDocument($this);
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
        $reimbursement->setReimbursementDocument(null);
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

    public function setReimbursements($reimbursements)
    {
        foreach ($reimbursements as $reimbursement) {
            $this->addReimbursement($reimbursement);
        }

        return $this;
    }

    /**
     * A string represenation of associated employee and reimbursements, truncated for optimized output.
     *
     * TODO: I don't like this :(
     *
     * @return string
     */
    public function getShortFormat()
    {
        $shortFormat = (string)$this->getEmployee().' - '.(string)$this->reimbursements->first();
        return $this->reimbursements->count() > 1
            ? $shortFormat.'... +'.(string)($this->reimbursements->count() - 1)
            : $shortFormat;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getShortFormat();
    }
}
