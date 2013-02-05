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
 * @ORM\Table("Tables")
 * @ExclusionPolicy("all")
 */
class Table {
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
     *
     * @ORM\ManyToOne(targetEntity="Zone", inversedBy="tables", cascade={"persist"})
     * @ORM\JoinColumn(name="zone_id", referencedColumnName="id")
     * @Expose
     */
    protected $zone;

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

    public function getZone() {
        return $this->zone;
    }

    public function setZone($zone) {
        $this->zone = $zone;
    }

    public function __toString() {
        return $this->getName();
    }
}