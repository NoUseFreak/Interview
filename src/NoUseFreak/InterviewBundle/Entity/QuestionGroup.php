<?php

namespace NoUseFreak\InterviewBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuestionGroup
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class QuestionGroup
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
     * @ORM\ManyToMany(targetEntity="Question", mappedBy="groups", cascade={"persist"})
     */
    private $questions;

    public function __construct() {
        $this->questions = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return QuestionGroup
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
        return $this->getTitle();
    }

    /**
     * @param mixed $questions
     */
    public function setQuestions($questions)
    {
        $this->questions = $questions;
    }

    /**
     * @return mixed
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    public function addQuestion(Question $question)
    {
        $this->questions->add($question);
        $question->addGroup($this);
    }
    public function removeQuestion(Question $question)
    {
        $this->questions->removeElement($question);
        $question->removeGroup($this);
    }

}
