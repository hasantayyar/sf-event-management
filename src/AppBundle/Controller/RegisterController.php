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
 * @Route("/user/register")
 */
class RegisterController extends Controller {

    /**
     * Lists all Event entities.
     *
     * @Route("/{path}", name="event_register")
     * @Method("GET")
     * @Template()
     */
    public function indexAction($path)
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('AppBundle:Event')->findOneBy(['path' => $path]);

        return array(
            'entity' => $event,
        );
    }

}
