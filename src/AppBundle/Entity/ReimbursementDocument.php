<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReimbursementDocument
 *
 * @ORM\Table(name="reimbursement_document", indexes={@ORM\Index(name="fk_reimbursement_document_employee_idx", columns={"employee_id"})})
 * @ORM\Entity
 */
class ReimbursementDocument implements EmployeeInterface
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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Reimbursement", inversedBy="reimbursementDocument")
     * @ORM\JoinTable(name="reimbursement_document_reimbursements",
     *   joinColumns={
     *     @ORM\JoinColumn(name="reimbursement_document_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="reimbursement_id", referencedColumnName="id")
     *   }
     * )
     */
    private $reimbursement;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reimbursement = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add reimbursement
     *
     * @param \AppBundle\Entity\Reimbursement $reimbursement
     *
     * @return ReimbursementDocument
     */
    public function addReimbursement(\AppBundle\Entity\Reimbursement $reimbursement)
    {
        $this->reimbursement[] = $reimbursement;

        return $this;
    }

    /**
     * Remove reimbursement
     *
     * @param \AppBundle\Entity\Reimbursement $reimbursement
     */
    public function removeReimbursement(\AppBundle\Entity\Reimbursement $reimbursement)
    {
        $this->reimbursement->removeElement($reimbursement);
    }

    /**
     * Get reimbursement
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReimbursement()
    {
        return $this->reimbursement;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $stringRepresentation = (string)$this->getEmployee().' - '.(string)$this->getReimbursement()->first();
        return $this->getReimbursement()->count() > 1
                ? $stringRepresentation.'... +'.(string)($this->getReimbursement()->count() - 1)
                : $stringRepresentation;
    }
}

