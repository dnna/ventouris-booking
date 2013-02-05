<?php
namespace Cuaround\SiteBundle\Entity\Event;

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
class Event {
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
     * @Assert\MaxLength(limit="255", message="The name is too long.")
     * @Expose
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Cuaround\SiteBundle\Entity\Event\Participant", mappedBy="event")
     */
    protected $participants;

    public function __construct() {
        $this->tables = new ArrayCollection();
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

    public function getParticipants() {
        return $this->participants;
    }

    public function setParticipants($participants) {
        $this->participants = $participants;
    }

    public function __toString() {
        return $this->getName();
    }
}