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
      //create
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

    /**
     * @Route("/fetch/{id}", name="fetchBug")
     */
    public function fetchAction(Request $request, $id)
    {
      //read
      $doctrine_manager = $this->getDoctrine()->getManager();
      $fetchBug = $this->getDoctrine()->getRepository('AppBundle:userBug')->find($id);
      $result1 = $fetchBug->getBugGuid();

      $fetchBug2 = $this->getDoctrine()->getRepository('AppBundle:userBug')->findOneBybug_guid('57d4066891a14');

      return new Response (
        'RETRIEVED OBJECT FOUND BY ID: ' . $result1 . '</br>' .
        'FETCHED OBJECT BY GUID, ID = ' . $fetchBug2->getBugId()
      );
    }

    /**
     * @Route("/update/{id}", name="updateBug")
     */
    public function updateAction($id)
    {
      //update
      $doctrine_manager = $this->getDoctrine()->getManager();
      $updateBug = $this->getDoctrine()->getRepository('AppBundle:userBug')->find($id);
      $updateBug->setBugGuid(uniqid());
      $doctrine_manager->flush();

      return new Response (
        'UPDATED FOLLOWING RECORD: ' . print_r($updateBug)
      );
    }
}
