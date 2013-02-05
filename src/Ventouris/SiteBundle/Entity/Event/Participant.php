<?php
namespace Cuaround\SiteBundle\Entity\Event;

use Cuaround\UserBundle\Entity\User;

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
class Participant {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Cuaround\SiteBundle\Entity\Event\Event", inversedBy="participants")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     */
    protected $event;

    /**
     * @ORM\ManyToOne(targetEntity="Cuaround\UserBundle\Entity\User", inversedBy="participatedIn")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Cuaround\SiteBundle\Entity\Purpose")
     * @ORM\JoinColumn(name="purpose_id", referencedColumnName="id")
     */
    protected $purpose;

    /**
     * @ORM\Column(name="fromprice", type="string", nullable=true)
     */
    protected $fromprice;

    /**
     * @ORM\Column(name="toprice", type="string", nullable=true)
     */
    protected $toprice;

    /**
     * @ORM\ManyToMany(targetEntity="Cuaround\SiteBundle\Entity\MusicType")
     * @ORM\JoinTable(name="participants_musictypes",
     *      joinColumns={@ORM\JoinColumn(name="participant_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="musictype_id", referencedColumnName="id")}
     *      )
     */
    protected $preferredMusic;

    /**
     * @ORM\ManyToMany(targetEntity="Cuaround\SiteBundle\Entity\TransportType")
     * @ORM\JoinTable(name="participants_transports",
     *      joinColumns={@ORM\JoinColumn(name="participant_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="transporttype_id", referencedColumnName="id")}
     *      )
     */
    protected $preferredTransport;

    /**
     * @ORM\Column(name="preferfamous", type="boolean", nullable=true)
     */
    protected $preferfamous;

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

    public function __construct(User $user) {
        $this->user = $user;
        $this->setPreferredMusic($user->getPreferredMusic());
        $this->setPreferredTransport($user->getPreferredTransport());
        $this->setPoint($user->getPoint());
        $this->setPreferfamous($user->getPreferfamous());
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getEvent() {
        return $this->event;
    }

    public function setEvent($event) {
        $this->event = $event;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function getPurpose() {
        return $this->purpose;
    }

    public function setPurpose($purpose) {
        $this->purpose = $purpose;
    }

    public function getLocation() {
        return $this->location;
    }

    public function setLocation($location) {
        $this->location = $location;
    }

    public function setFromprice($fromprice) {
        $this->fromprice = $fromprice;
    }

    public function setToprice($toprice) {
        $this->toprice = $toprice;
    }

    public function getPreferredMusic() {
        return $this->preferredMusic;
    }

    public function setPreferredMusic($preferredMusic) {
        $this->preferredMusic = $preferredMusic;
    }

    public function getPreferredTransport() {
        return $this->preferredTransport;
    }

    public function setPreferredTransport($preferredTransport) {
        $this->preferredTransport = $preferredTransport;
    }

    public function getPreferfamous() {
        return $this->preferfamous;
    }

    public function setPreferfamous($preferfamous) {
        $this->preferfamous = $preferfamous;
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

    public function __toString() {
        return $this->getUser()->__toString();
    }
}