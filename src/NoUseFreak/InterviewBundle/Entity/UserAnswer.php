<?php

namespace NoUseFreak\InterviewBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Answer
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class UserAnswer
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime", type="datetime")
     */
    private $datetime;

    /**
     * @var array
     *
     * @ORM\Column(name="data", type="array")
     */
    private $data;


    public function __construct()
    {
        $this->datetime = new \DateTime();
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
     * Set datetime
     *
     * @param \DateTime $datetime
     * @return UserAnswer
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * Get datetime
     *
     * @return \DateTime 
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Set data
     *
     * @param array $data
     * @return UserAnswer
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return array 
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param \NoUseFreak\InterviewBundle\Entity\User $user
     * @return UserAnswer
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return \NoUseFreak\InterviewBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
