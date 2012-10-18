<?php

namespace DC\TenisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use DC\TenisBundle\Entity\Match;
use DC\TenisBundle\Entity\Game;

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
    	return $this->redirect($this->generateUrl('view_match', array('id' => $match->getId())));
    }

    /**
     * @Route("/tenis/{id}", name="view_match")
     * @Template()
     */
    public function viewAction($id) {
    	$match = $this->getDoctrine()->getRepository('DCTenisBundle:Match')->find($id);
    	return array('match' => $match);
    }

    /**
     * @Route("/tenis/{id}/create-game", name="create_game")
     */
    public function createGameAction($id) {
    	$match = $this->getDoctrine()->getRepository('DCTenisBundle:Match')->find($id);
    	$game = new Game();
    	$match->addGame($game);
    	$em = $this->getDoctrine()->getEntityManager();
    	$em->persist($game);
    	$em->flush();
    	$this->get('session')->setFlash('notice', 'A new game has been created');
    	return $this->redirect($this->generateUrl('view_match', array('id' => $id)));
    }
}
