<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bill
 *
 * @ORM\Table(name="bill", indexes={@ORM\Index(name="fk_bill_squisition_id", columns={"aquisition_id"})})
 * @ORM\Entity
 */
class Bill
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
     * @var integer
     *
     * @ORM\Column(name="number", type="integer", nullable=false)
     */
    private $number;

    /**
     * @var integer
     *
     * @ORM\Column(name="value", type="integer", nullable=false)
     */
    private $value;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt = 'CURRENT_TIMESTAMP';

    /**
     * @var \Aquisition
     *
     * @ORM\ManyToOne(targetEntity="Aquisition")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="aquisition_id", referencedColumnName="id")
     * })
     */
    private $aquisition;

    /**
     * Document constructor.
     */
    public function __construct()
    {
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
     * Set number
     *
     * @param integer $number
     *
     * @return Bill
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set value
     *
     * @param integer $value
     *
     * @return Bill
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return integer
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Bill
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
     * @return Bill
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
     * Set aquisition
     *
     * @param \AppBundle\Entity\Aquisition $aquisition
     *
     * @return Bill
     */
    public function setAquisition(\AppBundle\Entity\Aquisition $aquisition = null)
    {
        $this->aquisition = $aquisition;

        return $this;
    }

    /**
     * Get aquisition
     *
     * @return \AppBundle\Entity\Aquisition
     */
    public function getAquisition()
    {
        return $this->aquisition;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getNumber().' ('.$this->getValue().')';
    }
}
