<?php

namespace AppBundle\Service;

use AppBundle\Service\BalanceService;
use AppBundle\Service\SDEGetterService;
use AppBundle\Service\SLCGetterService;

use Doctrine\ORM\EntityManagerInterface;


class HelloService
{

    private $blcServ;
    private $SDEServ;
    private $SLCServ;

    private $em ;

    public function __construct(EntityManagerInterface $em, BalanceService $blcServ, SDEGetterService $SDEServ, SLCGetterService $SLCServ){

      $this->em = $em ;

      $this->blcServ = $blcServ ;
      $this->SDEServ = $SDEServ ;
      $this->SLCServ = $SLCServ ;

    }



    public function connection($name)
    {


       $credentiales = json_decode($name) ;

       $dbuser = $this->em->getRepository('AppBundle:Users')->findOneBy(array('iduser' => $credentiales->login )) ;

       if (empty($dbuser) )
            return json_encode(array('codeRetour' => '0', 'baseDigest' => '___' ));


       $userId = $credentiales->login ;
       $userPwd = $dbuser->getPassword() ;


	$calculatedDigest = sha1($userId."".$userPwd."".$credentiales->timestamp) ;

        if($credentiales->digest == $calculatedDigest ){

            $baseDigest = base64_encode(sha1($credentiales->login."Da8H@dd_dh".$credentiales->digest)) ;
            return json_encode(array('codeRetour' => '1', 'baseDigest' => $baseDigest ));
        }
        else
            return json_encode(array('codeRetour' => '0', 'baseDigest' =>  '___' ));

    }


    public function heartbeat($name)
    {
	$rti = "" ;

        if (strcmp($this->blcServ->getBalance(), "0")==0)
		$rti = $rti."0";
	else
		$rti = $rti."1" ;

	if (strcmp($this->SDEServ->getBillSDE(), "0")==0)
		$rti = $rti."0";
	else
		$rti = $rti."1" ;

	if (strcmp($this->SLCServ->getBillSLC(), "0")==0)
		$rti = $rti."0";
	else
		$rti = $rti."1" ;

        return $rti ;

    }


    public function getBalance($param1, $param2)
    {
        return  $this->blcServ->getBalance()  ;
    }



}

