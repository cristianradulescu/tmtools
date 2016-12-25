<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReinbursementDocument
 *
 * @ORM\Table(name="reinbursement_document", indexes={@ORM\Index(name="fk_reinbursement_document_employee_idx", columns={"employee_id"})})
 * @ORM\Entity
 */
class ReinbursementDocument implements EmployeeInterface
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
     * @ORM\ManyToMany(targetEntity="Reinbursement", inversedBy="reinbursementDocument")
     * @ORM\JoinTable(name="reinbursement_document_reinbursements",
     *   joinColumns={
     *     @ORM\JoinColumn(name="reinbursement_document_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="reinbursement_id", referencedColumnName="id")
     *   }
     * )
     */
    private $reinbursement;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reinbursement = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return ReinbursementDocument
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
     * Add reinbursement
     *
     * @param \AppBundle\Entity\Reinbursement $reinbursement
     *
     * @return ReinbursementDocument
     */
    public function addReinbursement(\AppBundle\Entity\Reinbursement $reinbursement)
    {
        $this->reinbursement[] = $reinbursement;

        return $this;
    }

    /**
     * Remove reinbursement
     *
     * @param \AppBundle\Entity\Reinbursement $reinbursement
     */
    public function removeReinbursement(\AppBundle\Entity\Reinbursement $reinbursement)
    {
        $this->reinbursement->removeElement($reinbursement);
    }

    /**
     * Get reinbursement
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReinbursement()
    {
        return $this->reinbursement;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $stringRepresentation = (string)$this->getEmployee().' - '.(string)$this->getReinbursement()->first();
        return $this->getReinbursement()->count() > 1
                ? $stringRepresentation.'... +'.(string)($this->getReinbursement()->count() - 1)
                : $stringRepresentation;
    }
}

