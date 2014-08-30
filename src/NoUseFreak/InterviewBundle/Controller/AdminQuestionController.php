<?php

namespace NoUseFreak\InterviewBundle\Controller;

use NoUseFreak\InterviewBundle\Entity\Question;
use NoUseFreak\InterviewBundle\Form\QuestionType;

class AdminQuestionController extends AbstractAdminEntityController
{
    protected $config = array(
        'identifier_label' => 'Question',
        'routes' => array(
            'new'  => 'nousefreak_interview_admin_questions_new',
            'edit' => 'nousefreak_interview_admin_questions_edit',
            'list' => 'nousefreak_interview_admin_questions',
        ),
        'entity' => 'NoUseFreakInterviewBundle:Question',

    );

    protected function getData($id = null)
    {
        if (is_null($id)) {
            return new Question();
        }

        return $this->getDoctrine()
            ->getRepository($this->config['entity'])
            ->find($id);
    }

    protected function getForm()
    {
        return new QuestionType();
    }
}
