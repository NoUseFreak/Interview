<?php

namespace NoUseFreak\InterviewBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Questionnaire
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Questionnaire
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var QuestionDifficulty
     *
     * @ORM\ManyToOne(targetEntity="QuestionDifficulty")
     * @ORM\JoinColumn(name="difficulty_id", referencedColumnName="id")
     */
    private $difficulty;

    /**
     * @ORM\ManyToMany(targetEntity="QuestionGroup", cascade={"persist"})
     */
    private $questionGroups;

    public function __construct() {
        $this->questionGroups = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return Questionnaire
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    public function __toString()
    {
        return sprintf('%s %s', $this->getTitle(), $this->getDifficulty());
    }

    /**
     * Set difficulty
     *
     * @param string $difficulty
     * @return Questionnaire
     */
    public function setDifficulty($difficulty)
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    /**
     * Get difficulty
     *
     * @return string 
     */
    public function getDifficulty()
    {
        return $this->difficulty;
    }

    /**
     * @param mixed $questions
     */
    public function setQuestionGroups($questions)
    {
        $this->questionGroups = $questions;
    }

    /**
     * @return mixed
     */
    public function getQuestionGroups()
    {
        return $this->questionGroups;
    }
}
