<?php
namespace Cuaround\SiteBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OrderBy;
use Symfony\Component\Validator\Constraints as Assert;
use Oh\GoogleMapFormTypeBundle\Validator\Constraints as OhAssert;
use JMS\SerializerBundle\Annotation\ExclusionPolicy;
use JMS\SerializerBundle\Annotation\Expose;
use JMS\SerializerBundle\Annotation\Accessor;

/**
 * @ORM\Entity
 * @ORM\Table()
 * @ExclusionPolicy("all")
 */
class Destination
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="string")
     *
     * @Assert\MinLength(limit="3", message="The name is too short.")
     * @Assert\MaxLength(limit="50", message="The name is too long.")
     * @Expose
     */
    protected $name;

    /**
     * @ORM\Column(name="tel", type="string", nullable=true)
     */
    protected $tel;

    /**
     * @ORM\Column(name="dateCreated", type="datetime", nullable=true)
     */
    protected $dateCreated;

    /**
     * @ORM\Column(name="address", type="string", nullable=true)
     */
    protected $address;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Municipality", inversedBy="destinations", cascade={"persist"})
     * @ORM\JoinColumn(name="municipality_id", referencedColumnName="id")
     * @Expose
     */
    protected $municipality;

    /**
     * @var integer $latitude
     */
    protected $latitude;

    /**
     * @var integer $longitude
     */
    protected $longitude;

    /**
     * @var point $point
     *
     * @ORM\Column(name="point", type="point", nullable=true)
     * @Expose
     */
    protected $point;

    /**
     * @var point $point
     *
     * @ORM\Column(name="lastpointupdate", type="datetime")
     */
    protected $lastpointupdate;

    /**
     * @ORM\Column(name="fromprice", type="string", nullable=true)
     */
    protected $fromprice;

    /**
     * @ORM\Column(name="toprice", type="string", nullable=true)
     */
    protected $toprice;

    /**
     * @ORM\ManyToMany(targetEntity="MusicType", inversedBy="destinations")
     * @ORM\JoinTable(name="destinations_musictypes")
     */
    protected $musictypes;

    /**
     * @ORM\OneToMany(targetEntity="Zone", mappedBy="destination", cascade={"persist"})
     */
    protected $zones;

    /**
     * @ORM\Column(name="openfrom", type="string", nullable=true)
     */
    protected $openfrom;

    /**
     * @ORM\Column(name="openuntil", type="string", nullable=true)
     */
    protected $openuntil;

    /**
     * @ORM\ManyToMany(targetEntity="Purpose", inversedBy="destinations")
     * @ORM\JoinTable(name="destinations_purposes")
     */
    protected $purposes;

    /**
     * @ORM\Column(name="famous", type="boolean")
     */
    protected $famous;

    public function __construct() {
        $this->dateCreated = new \DateTime('now');
        $this->lastpointupdate = new \DateTime('now');
        $this->point = new \Cuaround\UserBundle\Wantlet\ORM\Point();
        $this->musictypes = new ArrayCollection();
        $this->zones = new ArrayCollection();
        $this->purposes = new ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getTel() {
        return $this->tel;
    }

    public function setTel($tel) {
        $this->tel = $tel;
    }

    public function getDateCreated() {
        return $this->dateCreated;
    }

    public function setDateCreated($dateCreated) {
        $this->dateCreated = $dateCreated;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function getMunicipality() {
        return $this->municipality;
    }

    public function setMunicipality($municipality) {
        $this->municipality = $municipality;
    }

    public function getLatitude() {
        return $this->point->getLatitude();
    }

    public function setLatitude($latitude) {
        $this->point->setLatitude($latitude);
        $this->lastpointupdate = new \DateTime('now');
    }

    public function getLongitude() {
        return $this->point->getLongitude();
    }

    public function setLongitude($longitude) {
        $this->point->setLongitude($longitude);
        $this->lastpointupdate = new \DateTime('now');
    }

    public function getPoint() {
        return $this->point;
    }

    public function setPoint($point) {
        $this->point = $point;
        $this->lastpointupdate = new \DateTime('now');
    }

    public function getLastpointupdate() {
        return $this->lastpointupdate;
    }

    public function setLastpointupdate($lastpointupdate) {
        $this->lastpointupdate = $lastpointupdate;
    }

    public function setLatLngFromMapForm($latlng) {
        $this->setLatitude($latlng['lat']);
        $this->setLongitude($latlng['lng']);
    }

    /**
     * @Assert\NotBlank()
     * @OhAssert\LatLng()
     */
    public function getLatLngFromMapForm()
    {
        return array('lat'=>$this->getLatitude(),'lng'=>$this->getLongitude());
    }

    public function getFromprice() {
        return $this->fromprice;
    }

    public function setFromprice($fromprice) {
        $this->fromprice = $fromprice;
    }

    public function getToprice() {
        return $this->toprice;
    }

    public function setToprice($toprice) {
        $this->toprice = $toprice;
    }

    public function getMusictypes() {
        return $this->musictypes;
    }

    public function setMusictypes($musictypes) {
        $this->musictypes = $musictypes;
    }

    public function getZones() {
        return $this->zones;
    }

    public function setZones($zones) {
        $this->zones = $zones;
    }

    public function getOpenfrom() {
        return $this->openfrom;
    }

    public function setOpenfrom($openfrom) {
        $this->openfrom = $openfrom;
    }

    public function getOpenuntil() {
        return $this->openuntil;
    }

    public function setOpenuntil($openuntil) {
        $this->openuntil = $openuntil;
    }

    public function getPurposes() {
        return $this->purposes;
    }

    public function setPurposes($purposes) {
        $this->purposes = $purposes;
    }

    public function getFamous() {
        return $this->famous;
    }

    public function setFamous($famous) {
        $this->famous = $famous;
    }

    public function __toString() {
        return $this->getName();
    }
}