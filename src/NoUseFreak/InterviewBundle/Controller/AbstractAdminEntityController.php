<?php
/**
 * This file is part of the SagaSol package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace NoUseFreak\InterviewBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
abstract class AbstractAdminEntityController extends Controller
{
    protected $config = array(
        'identifier_label' => null,
        'routes' => array(
            'new'  => null,
            'edit' => null,
            'list' => null,
        ),
        'entity' => null,

    );

    public function listAction()
    {
        return $this->render('NoUseFreakInterviewBundle:Admin:list.html.twig', array(
                'items' => $this->getItems($this->config['entity']),
                'identifier_label' => $this->config['identifier_label'],
                'routes' => $this->config['routes'],
            ));
    }

    public function newAction(Request $request)
    {
        return $this->handleForm($this->getData(), $request);
    }

    public function editAction($id, Request $request)
    {
        return $this->handleForm($this->getData($id), $request);
    }

    protected function handleForm($data, Request $request)
    {
        $form = $this->createForm($this->getForm(), $data);

        $extra = array();
        $this->preHandle($data, $extra);

        $form->handleRequest($request);


        if ($form->isValid()) {
            $this->saveData($data, $extra);
            return $this->redirect($this->generateUrl($this->config['routes']['list']));
        }

        return $this->render('NoUseFreakInterviewBundle:Admin:form.html.twig', array(
                'form' => $form->createView(),
                'routes' => $this->config['routes'],
            ));
    }

    protected function getItems($entity)
    {
        return $this->get('doctrine')
            ->getRepository($entity)
            ->findAll();
    }

    protected function preHandle($data, &$extra)
    {
        //
    }

    abstract protected function getData($id = null);

    protected function saveData($data, &$extra)
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
    }

    abstract protected function getForm();

}
