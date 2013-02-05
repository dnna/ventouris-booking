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
}