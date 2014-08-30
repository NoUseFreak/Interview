<?php

namespace NoUseFreak\InterviewBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('NoUseFreakInterviewBundle:Admin:index.html.twig');
    }

}
