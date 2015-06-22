<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Page controller.
 *
 * @Route("/barcode")
 */
class BarcodeController extends Controller {

    /**
     *   barcode 
     *
     * @Route("/{code}", name="barcode")
     * @Method("GET") 
     */
    public function indexAction($code)
    {
        $options = array(
            'code' => $code,
            'type' => 'c128',
            'format' => 'png',
        );

        $barcode = $this->get('sgk_barcode.generator')->generate($options);
        return new \Symfony\Component\HttpFoundation\Response($barcode);
    }

}
