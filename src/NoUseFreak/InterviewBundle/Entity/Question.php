<?php
/**
 * This file is part of the SagaSol package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NoUseFreak\InterviewBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Question
{
    const TYPE_TERM = 'term';
    const TYPE_PROBLEM = 'problem';
    const TYPE_MULTI = 'multiple choice';

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
     * @var string
     *
     * @ORM\Column(name="question", type="text")
     */
    private $question;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=100)
     */
    private $type;

    /**
     * @var QuestionDifficulty
     *
     * @ORM\ManyToOne(targetEntity="QuestionDifficulty")
     * @ORM\JoinColumn(name="difficulty_id", referencedColumnName="id")
     */
    private $difficulty;

    /**
     * @var QuestionCategory
     *
     * @ORM\ManyToOne(targetEntity="QuestionCategory")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity="QuestionGroup", inversedBy="questions")
     */
    private $groups;

    public function __construct() {
        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Question
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
        return sprintf('%s (%s %s, %s)', $this->getTitle(), $this->getCategory(), $this->getType(), $this->getDifficulty());
    }

    /**
     * Set question
     *
     * @param string $question
     * @return Question
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param mixed $groups
     */
    public function setGroups($groups)
    {
        $this->groups = $groups;
    }

    /**
     * @return mixed
     */
    public function getGroups()
    {
        return $this->groups;
    }

    public function addGroup($group)
    {
        $this->groups->add($group);
    }
    public function removeGroup($group)
    {
        $this->groups->removeElement($group);
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param \NoUseFreak\InterviewBundle\Entity\QuestionCategory $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return \NoUseFreak\InterviewBundle\Entity\QuestionCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param \NoUseFreak\InterviewBundle\Entity\QuestionDifficulty $difficulty
     */
    public function setDifficulty($difficulty)
    {
        $this->difficulty = $difficulty;
    }

    /**
     * @return \NoUseFreak\InterviewBundle\Entity\QuestionDifficulty
     */
    public function getDifficulty()
    {
        return $this->difficulty;
    }
}
