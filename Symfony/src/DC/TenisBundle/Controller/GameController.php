<?php

namespace DC\TenisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use DC\TenisBundle\Entity\Match;

class GameController extends Controller
{
    /**
     * @Route("/tenis", name="index")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/tenis/create", name="create_match")
     */
    public function createMatchAction() {
    	$match = new Match();
    	$em = $this->getDoctrine()->getEntityManager();
    	$em->persist($match);
    	$em->flush();
    	$this->get('session')->setFlash('notice', 'A new match has been started');
    	return $this->redirect($this->generateUrl('index'));
    }

    /**
     * @Route("/tenis/{id}", name="view_match")
     * @Template()
     */
    public function viewAction($id) {
    	$match = $this->getDoctrine()->getRepository('DCTenisBundle:Match')->find($id);
    	return array('match' => $match);
    }
}
