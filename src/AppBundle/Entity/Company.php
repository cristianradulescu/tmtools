<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Company
 *
 * @ORM\Table(
 *     name="company",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(
 *             name="company_cost_center_uindex",
 *             columns={"cost_center"}
 *        )
 *     },
 *     indexes={
 *         @ORM\Index(
 *             name="company_division_manager_id_fk",
 *             columns={"division_manager_id"}
 *         )
 *     }
 * )
 * @ORM\Entity
 */
class Company
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="company_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="cost_center", type="string", length=45, nullable=false)
     */
    private $costCenter;

    /**
     * @var \Employee
     *
     * @ORM\ManyToOne(targetEntity="Employee")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="division_manager_id", referencedColumnName="id")
     * })
     */
    private $divisionManager;

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
     * Set name
     *
     * @param string $name
     *
     * @return Company
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set costCenter
     *
     * @param string $costCenter
     *
     * @return Company
     */
    public function setCostCenter($costCenter)
    {
        $this->costCenter = $costCenter;

        return $this;
    }

    /**
     * Get costCenter
     *
     * @return string
     */
    public function getCostCenter()
    {
        return $this->costCenter;
    }

    /**
     * Set divisionManager
     *
     * @param \AppBundle\Entity\Employee $divisionManager
     *
     * @return Company
     */
    public function setDivisionManager(\AppBundle\Entity\Employee $divisionManager = null)
    {
        $this->divisionManager = $divisionManager;

        return $this;
    }

    /**
     * Get divisionManager
     *
     * @return \AppBundle\Entity\Employee
     */
    public function getDivisionManager()
    {
        return $this->divisionManager;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}
