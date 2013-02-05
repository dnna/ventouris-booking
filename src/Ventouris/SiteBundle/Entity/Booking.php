<?php
namespace Ventouris\SiteBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OrderBy;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\SerializerBundle\Annotation\ExclusionPolicy;
use JMS\SerializerBundle\Annotation\Expose;
use JMS\SerializerBundle\Annotation\Accessor;

/**
 * @ORM\Entity
 * @ORM\Table()
 * @ExclusionPolicy("all")
 */
class Booking {
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     */
    protected $id;

    /**
     * @ORM\Column(name="booking_date", type="date")
     * @Expose
     */
    protected $date;
    /**
     * @ORM\Column(name="venue_name", type="string")
     * @Expose
     */
    protected $venueName;
    /**
     * @ORM\Column(name="booker_name", type="string")
     * @Expose
     */
    protected $bookerName;
    /**
     * @ORM\Column(name="pr_name", type="string")
     * @Expose
     */
    protected $prName;
    /**
     * @ORM\Column(name="maitre_name", type="string")
     * @Expose
     */
    protected $maitreName;
    /**
     * @ORM\Column(name="price", type="float")
     * @Expose
     */
    protected $price;
    /**
     * @ORM\Column(name="paid", type="boolean")
     * @Expose
     */
    protected $paid;

    public function __construct() {
        $this->destinations = new ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getVenueName() {
        return $this->venueName;
    }

    public function setVenueName($venueName) {
        $this->venueName = $venueName;
    }

    public function getBookerName() {
        return $this->bookerName;
    }

    public function setBookerName($bookerName) {
        $this->bookerName = $bookerName;
    }

    public function getPrName() {
        return $this->prName;
    }

    public function setPrName($prName) {
        $this->prName = $prName;
    }

    public function getMaitreName() {
        return $this->maitreName;
    }

    public function setMaitreName($maitreName) {
        $this->maitreName = $maitreName;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getPaid() {
        return $this->paid;
    }

    public function setPaid($paid) {
        $this->paid = $paid;
    }

    public function __toString() {
        return $this->getName();
    }
}