<?php

namespace NoUseFreak\InterviewBundle\Controller;

use NoUseFreak\InterviewBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Request;

class AdminUserController extends AbstractAdminEntityController
{
    protected $config = array(
        'identifier_label' => 'Username',
        'routes' => array(
            'new'  => 'nousefreak_interview_admin_users_new',
            'edit' => 'nousefreak_interview_admin_users_edit',
            'list' => 'nousefreak_interview_admin_users',
        ),
        'entity' => 'NoUseFreakInterviewBundle:User',

    );

    protected function getItems($entity)
    {
        return $this->get('doctrine')
            ->getRepository($entity)
            ->findAll();
    }

    protected function getData($id = null)
    {
        if (is_null($id)) {
            return $this->get('fos_user.user_manager')
                ->createUser();
        }
        return $this->getDoctrine()
            ->getRepository($this->config['entity'])
            ->find($id);
    }

    protected function saveData($data, &$extra)
    {
        $data->setEnabled(true);
        $this->get('fos_user.user_manager')->updateUser($data);
    }

    protected function getForm()
    {
        return new UserType();
    }
}
