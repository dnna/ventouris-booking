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
class MusicType {
    /**
     * @ORM\Id
     * @ORM\Column(type="string",length=50)
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
     * @ORM\ManyToMany(targetEntity="Destination", mappedBy="musictypes", cascade={"persist"})
     */
    protected $destinations;

    public function __construct() {
        $this->destinations = new ArrayCollection();
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

    public function getDestinations() {
        return $this->destinations;
    }

    public function setDestinations($destinations) {
        $this->destinations = $destinations;
    }

    public function __toString() {
        return $this->getName();
    }
}