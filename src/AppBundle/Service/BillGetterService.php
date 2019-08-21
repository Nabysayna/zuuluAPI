<?php

namespace AppBundle\Service;

use AppBundle\Service\SDEGetterService;
use AppBundle\Service\SLCGetterService;


class BillGetterService
{

    private  $SDEServ ;
    private  $SLCServ ;

    public function __construct(SDEGetterService $SDEServ, SLCGetterService $SLCServ){

      $this->SDEServ = $SDEServ ;
      $this->SLCServ = $SLCServ ;

    }



    public function getBill($reference, $credZuulu, $serviceName, $serviceDesignation)
    {

      $sd = $serviceDesignation ; 

      $fromCustomer = explode("#", $credZuulu)[0] ; 
      $pin = explode("#", $credZuulu)[1] ;

      if (strcmp($sd, "GEPPOI")==0)
	return $this->SLCServ->getBillSLC($reference, $credZuulu) ;


      if (strcmp($sd, "WEPPOI")==0)
	return $this->SDEServ->getBillSDE($reference, $credZuulu) ;

      else
	return "0" ;

    }

    public function hello($name)
    {
        return 'Hello, '.$name;
    }

}
