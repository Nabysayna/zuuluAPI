<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Service\ServiceTester;
use AppBundle\Service\HelloService;

class DefaultController extends Controller
{


    public function __construct() {
      ;
    }


    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(HelloService $tester)
    {

        $soapServer = new \SoapServer('wsdls/BaseWS.wsdl',array('cache_wsdl' => WSDL_CACHE_NONE));
        $soapServer->setObject($tester);

        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml; charset=ISO-8859-1');

        ob_start();
        $soapServer->handle();
        $response->setContent(ob_get_clean());

        return $response;

    }

}
