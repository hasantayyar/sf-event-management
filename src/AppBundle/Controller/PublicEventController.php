<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Event;
use AppBundle\Form\EventType;

/**
 * Event controller.
 *
 * @Route("/event")
 */
class PublicEventController extends Controller {

    /**
     * Lists all Event entities.
     *
     * @Route("/{path}", name="public_event")
     * @Method("GET")
     * @Template()
     */
    public function publicIndexAction($path)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:Event')->findOneBy(['path' => $path]);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }
        return array(
            'entity' => $entity,
        );
    }

}
