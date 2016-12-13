<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reinbursement
 *
 * @ORM\Table(name="reinbursement")
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var integer
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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ReinbursementDocument", mappedBy="reinbursement")
     */
    private $reinbursementDocument;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reinbursementDocument = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Reinbursement
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
     * Set number
     *
     * @param integer $number
     *
     * @return Reinbursement
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Reinbursement
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
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Add reinbursementDocument
     *
     * @param \AppBundle\Entity\ReinbursementDocument $reinbursementDocument
     *
     * @return Reinbursement
     */
    public function addReinbursementDocument(\AppBundle\Entity\ReinbursementDocument $reinbursementDocument)
    {
        $this->reinbursementDocument[] = $reinbursementDocument;

        return $this;
    }

    /**
     * Remove reinbursementDocument
     *
     * @param \AppBundle\Entity\ReinbursementDocument $reinbursementDocument
     */
    public function removeReinbursementDocument(\AppBundle\Entity\ReinbursementDocument $reinbursementDocument)
    {
        $this->reinbursementDocument->removeElement($reinbursementDocument);
    }

    /**
     * Get reinbursementDocument
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReinbursementDocument()
    {
        return $this->reinbursementDocument;
    }
}
