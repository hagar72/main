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
        
    }
    
    /**
     * @Route("/certificates", name="certificates")
     * @Template()
     */
    public function certificatesAction() {
        
    }
    
    /**
     * @Route("/projects", name="projects")
     * @Template()
     */
    public function projectsAction() {
        
    }
    
    /**
     * @Route("/conact-us", name="contact_us")
     * @Template()
     */
    public function contactUsAction() {
        
    }
}
