<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentStatus
 *
 * @ORM\Table(
 *     name="document_status",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(
 *             name="document_status_name_uindex",
 *             columns={"name"}
 *         )
 *     }
 * )
 * @ORM\Entity
 */
class DocumentStatus
{
    /**
     * Constants for type ids
     */
    const STATUS_NEW = 1;
    const STATUS_PENDING = 2;
    const STATUS_COMPLETED = 3;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="document_status_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

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
     * @return DocumentStatus
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
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}
