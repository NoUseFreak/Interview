<?php

namespace NoUseFreak\InterviewBundle\Controller;

use NoUseFreak\InterviewBundle\Entity\QuestionDifficulty;
use NoUseFreak\InterviewBundle\Form\QuestionDifficultyType;

class AdminQuestionDifficultyController extends AbstractAdminEntityController
{
    protected $config = array(
        'identifier_label' => 'Question Difficulty',
        'routes' => array(
            'new'  => 'nousefreak_interview_admin_question_difficulty_new',
            'edit' => 'nousefreak_interview_admin_question_difficulty_edit',
            'list' => 'nousefreak_interview_admin_question_difficulty',
        ),
        'entity' => 'NoUseFreakInterviewBundle:QuestionDifficulty',

    );

    protected function getData($id = null)
    {
        if (is_null($id)) {
            return new QuestionDifficulty();
        }

        return $this->getDoctrine()
            ->getRepository($this->config['entity'])
            ->find($id);
    }

    protected function getForm()
    {
        return new QuestionDifficultyType();
    }
}
