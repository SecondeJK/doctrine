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
      $bug->setBugDescription('This is the inital bug to report from a controller');
      $bug->setBugGuid(uniqid());
      $bug->setBugDate(date('Y-m-d H:i:s'));

      return new Response (
        'SCRIPT TO CREATE BUG'
      );
    }
}
