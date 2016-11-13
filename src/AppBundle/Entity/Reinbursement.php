<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reinbursement
 *
 * @ORM\Table(name="reinbursement", indexes={@ORM\Index(name="fk_reinbursement_reinbursement_type_idx", columns={"type_id"})})
 * @ORM\Entity
 */
class Reinbursement
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
     * @var float
     *
     * @ORM\Column(name="value", type="float", precision=10, scale=0, nullable=false)
     */
    private $value = '0';

    /**
     * @var \ReinbursementType
     *
     * @ORM\ManyToOne(targetEntity="ReinbursementType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     * })
     */
    private $type;



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
     * Set value
     *
     * @param float $value
     *
     * @return Reinbursement
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set type
     *
     * @param \AppBundle\Entity\ReinbursementType $type
     *
     * @return Reinbursement
     */
    public function setType(\AppBundle\Entity\ReinbursementType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \AppBundle\Entity\ReinbursementType
     */
    public function getType()
    {
        return $this->type;
    }
}
