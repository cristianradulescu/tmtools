<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Travel
 *
 * @ORM\Table(
 *     name="travel",
 *     indexes={
 *         @ORM\Index(
 *             name="travel_porpose_id_fk",
 *             columns={"purpose_id"}
 *         ),
 *         @ORM\Index(
 *             name="travel_destination_id_fk",
 *             columns={"destination_id"}
 *         ),
 *         @ORM\Index(
 *             name="travel_employee_id_fk",
 *             columns={"employee_id"}
 *         ),
 *         @ORM\Index(
 *             name="travel_document_id_fk",
 *             columns={"document_id"}
 *         )
 *     }
 * )
 * @ORM\Entity
 */
class Travel
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="travel_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_start", type="date", nullable=false)
     */
    private $dateStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_end", type="date", nullable=false)
     */
    private $dateEnd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="departure_leave_time", type="datetime", nullable=false)
     */
    private $departureLeaveTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="destination_arrival_time", type="datetime", nullable=false)
     */
    private $destinationArrivalTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="destination_leave_time", type="datetime", nullable=false)
     */
    private $destinationLeaveTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="departure_arrival_time", type="datetime", nullable=false)
     */
    private $departureArrivalTime;

    /**
     * @var \TravelPurpose
     *
     * @ORM\ManyToOne(targetEntity="TravelPurpose")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="purpose_id", referencedColumnName="id")
     * })
     */
    private $purpose;

    /**
     * @var \TravelDestination
     *
     * @ORM\ManyToOne(targetEntity="TravelDestination")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="destination_id", referencedColumnName="id")
     * })
     */
    private $destination;

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
     * @var \Document
     *
     * @ORM\ManyToOne(
     *     targetEntity="Document",
     *     inversedBy="travels"
     * )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="document_id", referencedColumnName="id")
     * })
     */
    private $document;

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
     * Set dateStart
     *
     * @param \DateTime $dateStart
     *
     * @return Travel
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * Get dateStart
     *
     * @return \DateTime
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * Set dateEnd
     *
     * @param \DateTime $dateEnd
     *
     * @return Travel
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return \DateTime
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Set departureLeaveTime
     *
     * @param \DateTime $departureLeaveTime
     *
     * @return Travel
     */
    public function setDepartureLeaveTime($departureLeaveTime)
    {
        $this->departureLeaveTime = $departureLeaveTime;

        return $this;
    }

    /**
     * Get departureLeaveTime
     *
     * @return \DateTime
     */
    public function getDepartureLeaveTime()
    {
        return $this->departureLeaveTime;
    }

    /**
     * Set destinationArrivalTime
     *
     * @param \DateTime $destinationArrivalTime
     *
     * @return Travel
     */
    public function setDestinationArrivalTime($destinationArrivalTime)
    {
        $this->destinationArrivalTime = $destinationArrivalTime;

        return $this;
    }

    /**
     * Get destinationArrivalTime
     *
     * @return \DateTime
     */
    public function getDestinationArrivalTime()
    {
        return $this->destinationArrivalTime;
    }

    /**
     * Set destinationLeaveTime
     *
     * @param \DateTime $destinationLeaveTime
     *
     * @return Travel
     */
    public function setDestinationLeaveTime($destinationLeaveTime)
    {
        $this->destinationLeaveTime = $destinationLeaveTime;

        return $this;
    }

    /**
     * Get destinationLeaveTime
     *
     * @return \DateTime
     */
    public function getDestinationLeaveTime()
    {
        return $this->destinationLeaveTime;
    }

    /**
     * Set departureArrivalTime
     *
     * @param \DateTime $departureArrivalTime
     *
     * @return Travel
     */
    public function setDepartureArrivalTime($departureArrivalTime)
    {
        $this->departureArrivalTime = $departureArrivalTime;

        return $this;
    }

    /**
     * Get departureArrivalTime
     *
     * @return \DateTime
     */
    public function getDepartureArrivalTime()
    {
        return $this->departureArrivalTime;
    }

    /**
     * Set purpose
     *
     * @param \AppBundle\Entity\TravelPurpose $purpose
     *
     * @return Travel
     */
    public function setPurpose(\AppBundle\Entity\TravelPurpose $purpose = null)
    {
        $this->purpose = $purpose;

        return $this;
    }

    /**
     * Get purpose
     *
     * @return \AppBundle\Entity\TravelPurpose
     */
    public function getPurpose()
    {
        return $this->purpose;
    }

    /**
     * Set destination
     *
     * @param \AppBundle\Entity\TravelDestination $destination
     *
     * @return Travel
     */
    public function setDestination(\AppBundle\Entity\TravelDestination $destination = null)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * Get destination
     *
     * @return \AppBundle\Entity\TravelDestination
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * Set employee
     *
     * @param \AppBundle\Entity\Employee $employee
     *
     * @return Travel
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
     * Set document
     *
     * @param \AppBundle\Entity\Document $document
     *
     * @return Travel
     */
    public function setDocument(\AppBundle\Entity\Document $document = null)
    {
        $this->document = $document;

        return $this;
    }

    /**
     * Get document
     *
     * @return \AppBundle\Entity\Document
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getEmployee()->getFullName().' / '.$this->getPurpose().'@'.$this->getDestination();
    }
}
