<?php

namespace NoUseFreak\InterviewBundle\Controller;

use NoUseFreak\InterviewBundle\Entity\QuestionCategory;
use NoUseFreak\InterviewBundle\Form\QuestionCategoryType;

class AdminQuestionCategoryController extends AbstractAdminEntityController
{
    protected $config = array(
        'identifier_label' => 'Question Category',
        'routes' => array(
            'new'  => 'nousefreak_interview_admin_question_category_new',
            'edit' => 'nousefreak_interview_admin_question_category_edit',
            'list' => 'nousefreak_interview_admin_question_category',
        ),
        'entity' => 'NoUseFreakInterviewBundle:QuestionCategory',

    );

    protected function getData($id = null)
    {
        if (is_null($id)) {
            return new QuestionCategory();
        }

        return $this->getDoctrine()
            ->getRepository($this->config['entity'])
            ->find($id);
    }

    protected function getForm()
    {
        return new QuestionCategoryType();
    }
}
