<?php

namespace Cuaround\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller {
    /**
     * @Route("/", name="main")
     * @Template
     */
    public function indexAction() {
        // Prefered type
        // Prefered purpose (snacks, drink etc)
        // Prefered geographical area (Gkazi, Kolonaki etc)
        // Prefered transportation means (car, bus, metro etc)
        // Arrival time
        return $this->render('CuaroundSiteBundle:Default:index.html.twig', array());
    }

    /**
     * @Route("/add_municipalities", name="add_municipalities")
     * @Template
     */
    /*public function add_municipalitiesAction() {
        foreach(\Cuaround\SiteBundle\Entity\Municipality::getMunicipalities() as $curMunicipality) {
            $municipality = new \Cuaround\SiteBundle\Entity\Municipality();
            $municipality->setName($curMunicipality);
            $this->get('doctrine')->getEntityManager()->persist($municipality);
            $this->get('doctrine')->getEntityManager()->flush();
        }
        return $this->render('CuaroundSiteBundle:Default:index.html.twig', array());
    }*/

}
