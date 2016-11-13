<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AquisitionSupplierAccount
 *
 * @ORM\Table(name="aquisition_supplier_account", indexes={@ORM\Index(name="fk_aquisition_supplier_account_aquisition_supplier_idx", columns={"aquisition_supplier_id"})})
 * @ORM\Entity
 */
class AquisitionSupplierAccount
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
     * @ORM\Column(name="bank_account_number", type="string", length=45, nullable=true)
     */
    private $bankAccountNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="bank_name", type="string", length=45, nullable=true)
     */
    private $bankName;

    /**
     * @var \AquisitionSupplier
     *
     * @ORM\ManyToOne(targetEntity="AquisitionSupplier")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="aquisition_supplier_id", referencedColumnName="id")
     * })
     */
    private $aquisitionSupplier;



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
     * Set bankAccountNumber
     *
     * @param string $bankAccountNumber
     *
     * @return AquisitionSupplierAccount
     */
    public function setBankAccountNumber($bankAccountNumber)
    {
        $this->bankAccountNumber = $bankAccountNumber;

        return $this;
    }

    /**
     * Get bankAccountNumber
     *
     * @return string
     */
    public function getBankAccountNumber()
    {
        return $this->bankAccountNumber;
    }

    /**
     * Set bankName
     *
     * @param string $bankName
     *
     * @return AquisitionSupplierAccount
     */
    public function setBankName($bankName)
    {
        $this->bankName = $bankName;

        return $this;
    }

    /**
     * Get bankName
     *
     * @return string
     */
    public function getBankName()
    {
        return $this->bankName;
    }

    /**
     * Set aquisitionSupplier
     *
     * @param \AppBundle\Entity\AquisitionSupplier $aquisitionSupplier
     *
     * @return AquisitionSupplierAccount
     */
    public function setAquisitionSupplier(\AppBundle\Entity\AquisitionSupplier $aquisitionSupplier = null)
    {
        $this->aquisitionSupplier = $aquisitionSupplier;

        return $this;
    }

    /**
     * Get aquisitionSupplier
     *
     * @return \AppBundle\Entity\AquisitionSupplier
     */
    public function getAquisitionSupplier()
    {
        return $this->aquisitionSupplier;
    }
}
