<?php
namespace UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Information", mappedBy="user")
     */
    private $information;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

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
     * Set information
     *
     * @param \AppBundle\Entity\Information $information
     * @return User
     */
    public function setInformation(\AppBundle\Entity\Information $information = null)
    {
        $this->information = $information;

        return $this;
    }

    /**
     * Get information
     *
     * @return \AppBundle\Entity\Information 
     */
    public function getInformation()
    {
        return $this->information;
    }
}
