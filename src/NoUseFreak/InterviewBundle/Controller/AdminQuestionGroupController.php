<?php

namespace NoUseFreak\InterviewBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use NoUseFreak\InterviewBundle\Entity\Question;
use NoUseFreak\InterviewBundle\Entity\QuestionGroup;
use NoUseFreak\InterviewBundle\Form\QuestionGroupType;
use NoUseFreak\InterviewBundle\Form\QuestionType;

class AdminQuestionGroupController extends AbstractAdminEntityController
{
    protected $config = array(
        'identifier_label' => 'Question Group',
        'routes' => array(
            'new'  => 'nousefreak_interview_admin_question_groups_new',
            'edit' => 'nousefreak_interview_admin_question_groups_edit',
            'list' => 'nousefreak_interview_admin_question_groups',
        ),
        'entity' => 'NoUseFreakInterviewBundle:QuestionGroup',

    );

    protected function saveData($data, &$extra)
    {
        $em = $this->getDoctrine()->getManager();

        $em->persist($data);
        $em->flush();
    }


    protected function getData($id = null)
    {
        if (is_null($id)) {
            return new QuestionGroup();
        }

        return $this->getDoctrine()
            ->getRepository($this->config['entity'])
            ->find($id);
    }

    protected function getForm()
    {
        return new QuestionGroupType();
    }
}
