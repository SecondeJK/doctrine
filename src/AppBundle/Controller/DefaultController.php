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
        'UPDATED FOLLOWING RECORD: <pre>' . print_r($updateBug) . '</pre>'
      );
    }

    /**
     * @Route("/delete/{id}", name="deleteBug")
     */
    public function deleteAction($id)
    {
      //update
      $doctrine_manager = $this->getDoctrine()->getManager();
      $updateBug = $this->getDoctrine()->getRepository('AppBundle:userBug')->findOneBybug_id($id);
      $doctrine_manager->remove($updateBug);
      $doctrine_manager->flush();

      return new Response (
        'DELETED FOLLOWING RECORD: <pre>' . print_r($updateBug) . '</pre>'
      );
    }

    /**
     * @Route("/fetchdql", name="fetchByDQL")
     */
    public function dqlFetchAction()
    {
      //update
      $doctrine_manager = $this->getDoctrine()->getManager();
      $query = $doctrine_manager->createQuery(
      'SELECT ub
      FROM AppBundle:userBug ub
      WHERE ub.bugId > :setmin
      ORDER BY ub.bugId DESC'
      )->setParameter('setmin', 5);

      $results = $query->getResult();

      $repository = $doctrine_manager->getRepository('AppBundle:userBug');

      // createQueryBuilder automatically selects FROM AppBundle:userBug
      // and aliases it to "p"
      $query2 = $repository->createQueryBuilder('ub')
          ->where('ub.bugId <= :minno')
          ->setParameter('minno', '2')
          ->orderBy('ub.bugId', 'DESC')
          ->getQuery();

      $results2 = $query2->getResult();

      return new Response (
        'RETRIEVED FOLLOWING RECORD(s): <pre>' . print_r($results2) . '</pre>'
      );
    }
}
