<?php

namespace NoUseFreak\InterviewBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StaticController extends Controller
{
    public function indexAction()
    {
        return $this->render('NoUseFreakInterviewBundle:Static:index.html.twig');
    }

    public function introAction()
    {
        return $this->render('NoUseFreakInterviewBundle:Static:intro.html.twig');
    }
}
