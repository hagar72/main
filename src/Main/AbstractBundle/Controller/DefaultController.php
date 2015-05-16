<?php

namespace Main\AbstractBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('MainArticleBundle:Article')->findAll();

        return array(
            'articles' => $articles,
        );
    }
    
    /**
     * @Route("/about", name="about")
     * @Template()
     */
    public function aboutAction() {
        return array();
    }
    
    /**
     * @Route("/certificates", name="certificates")
     * @Template()
     */
    public function certificatesAction() {
        return array();
    }
    
    /**
     * @Route("/projects", name="projects")
     * @Template()
     */
    public function projectsAction() {
        return array();
    }
    
    
    /**
     * @Route("/switch-language/{locale}", name="language_switch")
     * @Template()
     */
    public function switchLangAction($locale)
    {
        $request = $this->container->get('request');
        $referer = $request->headers->get('referer');
        $this->get('session')->set('_locale', $locale);
        return $this->redirect($referer);
    }
}
