<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentType
 *
 * @ORM\Table(
 *     name="document_type",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(
 *             name="document_type_name_uindex",
 *             columns={"name"}
 *         )
 *     }
 * )
 * @ORM\Entity
 */
class DocumentType
{
    const TYPE_TRAVEL = 1;
    const TYPE_REIMBURSEMENT = 2;
    const TYPE_SERVICE_AQUISITION = 3;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="document_type_id_seq", allocationSize=1, initialValue=1)
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
     * @ORM\Column(name="template", type="string", length=200, nullable=true)
     */
    private $template;

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
     * @return DocumentType
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
     * Set template
     *
     * @param string $template
     *
     * @return DocumentType
     */
    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Get template
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}
