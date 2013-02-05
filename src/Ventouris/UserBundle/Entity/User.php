<?php
namespace Ventouris\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OrderBy;
use FOS\UserBundle\Entity\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use Oh\GoogleMapFormTypeBundle\Validator\Constraints as OhAssert;
use JMS\SerializerBundle\Annotation\ExclusionPolicy;
use JMS\SerializerBundle\Annotation\Expose;
use JMS\SerializerBundle\Annotation\Accessor;

/**
 * @ORM\Entity
 * @ORM\Table(name="Users")
 * @ORM\Entity(repositoryClass="Ventouris\UserBundle\Entity\Repositories\UserRepository")
 * @ExclusionPolicy("all")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     */
    protected $id;
    
    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", nullable=true)
     *
     * @Assert\MinLength(limit="3", message="The name is too short.")
     * @Assert\MaxLength(limit="50", message="The name is too long.")
     * @Expose
     */
    protected $name;

    /**
     * @var string $surname
     *
     * @ORM\Column(name="surname", type="string", nullable=true)
     *
     * @Assert\MinLength(limit="3", message="The surname is too short.")
     * @Assert\MaxLength(limit="50", message="The surname is too long.")
     * @Accessor(getter="getSurnameInitial")
     * @Expose
     */
    protected $surname;
    
    /**
     * @var string $fbEmail
     *
     * @ORM\Column(name="fb_email", type="string", nullable=true)
     */
    protected $fbEmail;
    
    /**
     * @var string $fbId
     *
     * @ORM\Column(name="fb_id", type="string", nullable=true)
     */
    protected $fbId;
    
    /**
     * @var integer $fbConnected
     *
     * @ORM\Column(name="fb_connected", type="boolean", nullable=false)
     */
    protected $fbConnected = 0;
    
    /**
     * @var bigint $tel
     *
     * @ORM\Column(name="tel", type="bigint", nullable=true)
     */
    protected $tel;

    /**
     * @var datetime $dateRegistered
     *
     * @ORM\Column(name="dateRegistered", type="datetime", nullable=true)
     */
    protected $dateRegistered;
    
    /**
     * @var string $address
     *
     * @ORM\Column(name="address", type="string", nullable=true)
     */
    protected $address;

    /**
     * @ORM\Column(name="birthday", type="datetime")
     */
    protected $birthday;

    /**
     * @ORM\ManyToMany(targetEntity="Ventouris\SiteBundle\Entity\MusicType")
     * @ORM\JoinTable(name="users_musictypes",
     *      joinColumns={@ORM\JoinColumn(name="participant_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="musictype_id", referencedColumnName="id")}
     *      )
     */
    protected $preferredMusic;

    /**
     * @ORM\ManyToMany(targetEntity="Ventouris\SiteBundle\Entity\TransportType")
     * @ORM\JoinTable(name="users_transports",
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

    /**
     * @ORM\OneToMany(targetEntity="Ventouris\SiteBundle\Entity\Event\Participant", mappedBy="user")
     */
    protected $participatedIn;
    	
    public function __construct() {
    	parent::__construct();
        $this->dateRegistered = new \DateTime('now');
        $this->point = new \Ventouris\UserBundle\Wantlet\ORM\Point();
        $this->lastpointupdate = new \DateTime('now');
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

    public function getSurname() {
        return $this->surname;
    }

    public function setSurname($surname) {
        $this->surname = $surname;
    }

    public function getFbEmail() {
        return $this->fbEmail;
    }

    public function setFbEmail($fbEmail) {
        $this->fbEmail = $fbEmail;
    }

    public function getFbId() {
        return $this->fbId;
    }

    public function setFbId($fbId) {
        $this->fbId = $fbId;
    }

    public function getFbConnected() {
        return $this->fbConnected;
    }

    public function setFbConnected($fbConnected) {
        $this->fbConnected = $fbConnected;
    }

    public function getTel() {
        return $this->tel;
    }

    public function setTel($tel) {
        $this->tel = $tel;
    }

    public function getDateRegistered() {
        return $this->dateRegistered;
    }

    public function setDateRegistered($dateRegistered) {
        $this->dateRegistered = $dateRegistered;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function getBirthday() {
        return $this->birthday;
    }

    public function setBirthday($birthday) {
        $this->birthday = $birthday;
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

    public function getParticipatedIn() {
        return $this->participatedIn;
    }

    public function setParticipatedIn($participatedIn) {
        $this->participatedIn = $participatedIn;
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
}