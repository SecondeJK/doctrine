<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\userBug;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
      return new Response (
        'JIM SECONDE\'S DOCTRINE SANDBOX'
      );
    }

    /**
     * @Route("/create", name="createBug")
     */
    public function createAction(Request $request)
    {
      $bug = new userBug;
      $bug->setBugDescription('More data please');
      $bug->setBugGuid(uniqid());
      $bug->setBugDate(new \DateTime('now'));

      $doctrine_manager = $this->getDoctrine()->getManager();
      $doctrine_manager->persist($bug);
      $doctrine_manager->flush();

      return new Response (
        'SCRIPT TO CREATE BUG'
      );
    }
}
