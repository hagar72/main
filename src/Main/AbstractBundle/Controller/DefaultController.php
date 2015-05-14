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
        return array();
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
}
