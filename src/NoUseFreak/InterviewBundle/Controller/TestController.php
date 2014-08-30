<?php

namespace NoUseFreak\InterviewBundle\Controller;

use NoUseFreak\InterviewBundle\Entity\UserAnswer;
use NoUseFreak\InterviewBundle\Form\Type\InlineQuestionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TestController extends Controller
{
    public function introAction()
    {
        return $this->render('NoUseFreakInterviewBundle:Test:intro.html.twig', array(
                'step_info' => $this->getStepInfo(),
            ));
    }

    public function formAction(Request $request, $step)
    {
        $form = $this->getForm($step);
        $form->setData($this->getData($step));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->saveData($form->getData(), $step);

            if ($step + 1 > $this->getQuestionnaire()->getQuestionGroups()->count()) {
                return $this->redirect($this->generateUrl('nousefreak_test_confirm'));
            }

            return $this->redirect($this->generateUrl('nousefreak_test_form', array(
                'step' => $request->request->has('next') ? $step + 1 : $step - 1,
            )));
        }

        return $this->render('NoUseFreakInterviewBundle:Test:form.html.twig', array(
            'step_info' => $this->getStepInfo($step),
            'form' => $form->createView(),
            'group' => $group = $this->getQuestionnaire()->getQuestionGroups()->get($step - 1),
        ));
    }

    public function confirmAction()
    {
        $groups = $this->getQuestionnaire()->getQuestionGroups();
        $answer = $this->getAnswer();

        return $this->render('NoUseFreakInterviewBundle:Test:confirm.html.twig', array(
            'groups' => $groups,
            'answer' => $answer,
        ));
    }

    protected function getStepInfo($step = 0)
    {
        return array(
            'current' => $step,
            'total'   => $this->getQuestionnaire()->getQuestionGroups()->count(),
        );
    }

    /**
     * @return UserAnswer
     */
    protected function getAnswer()
    {
        $user = $this->get('security.context')->getToken()->getUser();

        $answer = $this->getDoctrine()->getRepository('NoUseFreakInterviewBundle:UserAnswer')
            ->findOneBy(array(
                    'user' => $user,
                ));

        if (!$answer) {
            $answer = new UserAnswer();
            $answer->setUser($user);
        }

        return $answer;
    }

    protected function getData($step)
    {
        $answer = $this->getAnswer();
        $data = $answer->getData() ?: array();

        return isset($data[$step]) ? $data[$step] : array();
    }

    protected function saveData($data, $step)
    {
        $answer = $this->getAnswer();

        $dbData = $answer->getData() ?: array();
        $dbData[$step] = $data;

        $answer->setData($dbData);
        $em = $this->getDoctrine()->getManager();
        $em->persist($answer);
        $em->flush();
    }

    protected function getForm($step)
    {
        $questionnaire = $this->getQuestionnaire();
        $form = $this->createFormBuilder();
        $group = $questionnaire->getQuestionGroups()->get($step - 1);

        foreach ($group->getQuestions() as $question) {
            if ($questionnaire->getDifficulty() == $question->getDifficulty()) {
                $form->add('q_' . $question->getId(), new InlineQuestionType($question));
            }
        }

        return $form->getForm();
    }

    protected function getGroup($step)
    {

    }

    protected function getQuestionnaire()
    {
        return $this->getDoctrine()
            ->getRepository('NoUseFreakInterviewBundle:Questionnaire')
            ->find(1);
    }
}
