<?php

namespace DC\TenisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
     * @Route("/tenis/create", name="create_game")
     */
    public function createAction() {
    	$game = new Game();
    	$em = $this->getDoctrine()->getEntityManager();
    	$em->persist($game);
    	$em->flush();
    	$this->get('session')->setFlash('notice', 'A new game has been started');
    	return $this->redirect($this->generateUrl('index'));
    }
}
