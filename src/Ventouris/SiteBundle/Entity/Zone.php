<?php
namespace Cuaround\SiteBundle\Entity;

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
class Zone {
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
     * @Assert\MaxLength(limit="50", message="The name is too long.")
     * @Expose
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Cuaround\SiteBundle\Entity\Zone", mappedBy="destination", cascade={"persist"})
     */
    protected $tables;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Destination", inversedBy="zones", cascade={"persist"})
     * @ORM\JoinColumn(name="destination_id", referencedColumnName="id")
     * @Expose
     */
    protected $destination;

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

    public function getTables() {
        return $this->tables;
    }

    public function setTables($tables) {
        $this->tables = $tables;
    }

    public function getDestination() {
        return $this->destination;
    }

    public function setDestination($destination) {
        $this->destination = $destination;
    }

    public function __toString() {
        return $this->getName().' - '.$this->getDestination()->getName();
    }
}