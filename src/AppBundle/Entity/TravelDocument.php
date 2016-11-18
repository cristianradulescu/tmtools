<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TravelDocument
 *
 * @ORM\Table(name="travel_document", indexes={@ORM\Index(name="fk_travel_document_employee_idx", columns={"employee_id"}), @ORM\Index(name="fk_travel_document_travel_purpose_idx", columns={"purpose_id"}), @ORM\Index(name="fk_travel_document_travel_destination_idx", columns={"destination_id"})})
 * @ORM\Entity
 */
class TravelDocument
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
     * @ORM\Column(name="departure_arrival_time", type="datetime", nullable=false)
     */
    private $departureArrivalTime;

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
     * @var \Employee
     *
     * @ORM\ManyToOne(targetEntity="Employee")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="employee_id", referencedColumnName="id")
     * })
     */
    private $employee;

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
     * @var \TravelPurpose
     *
     * @ORM\ManyToOne(targetEntity="TravelPurpose")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="purpose_id", referencedColumnName="id")
     * })
     */
    private $purpose;



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
     * @return TravelDocument
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
     * @return TravelDocument
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
     * @return TravelDocument
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
     * Set departureArrivalTime
     *
     * @param \DateTime $departureArrivalTime
     *
     * @return TravelDocument
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
     * Set destinationArrivalTime
     *
     * @param \DateTime $destinationArrivalTime
     *
     * @return TravelDocument
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
     * @return TravelDocument
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
     * Set employee
     *
     * @param \AppBundle\Entity\Employee $employee
     *
     * @return TravelDocument
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
     * Set destination
     *
     * @param \AppBundle\Entity\TravelDestination $destination
     *
     * @return TravelDocument
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
     * Set purpose
     *
     * @param \AppBundle\Entity\TravelPurpose $purpose
     *
     * @return TravelDocument
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
}
