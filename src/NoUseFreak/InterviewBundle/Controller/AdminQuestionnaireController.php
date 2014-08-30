<?php

namespace NoUseFreak\InterviewBundle\Controller;

use NoUseFreak\InterviewBundle\Entity\Questionnaire;
use NoUseFreak\InterviewBundle\Form\QuestionnaireType;

class AdminQuestionnaireController extends AbstractAdminEntityController
{
    protected $config = array(
        'identifier_label' => 'Questionnaire',
        'routes' => array(
            'new'  => 'nousefreak_interview_admin_question_questionnaire_new',
            'edit' => 'nousefreak_interview_admin_question_questionnaire_edit',
            'list' => 'nousefreak_interview_admin_question_questionnaire',
        ),
        'entity' => 'NoUseFreakInterviewBundle:Questionnaire',
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
            return new Questionnaire();
        }

        return $this->getDoctrine()
            ->getRepository($this->config['entity'])
            ->find($id);
    }

    protected function getForm()
    {
        return new QuestionnaireType();
    }
}
