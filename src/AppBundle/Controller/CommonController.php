<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Common controller.
 * @Route("/")
 */
class CommonController extends Controller {

    /**
     *  Change current locale
     *
     * @Route("/change_locale/{code}", name="change_locale")
     * @Method("GET")
     * @Template()
     */
    public function changeLocaleAction($code, Request $request)
    {
        $request->setLocale($code);
        $this->get('session')->set('_locale', $code);
        $referer = $request->headers->get('referer');
        return $this->redirect(empty($referer) ? "/" : $referer);
    }

}
