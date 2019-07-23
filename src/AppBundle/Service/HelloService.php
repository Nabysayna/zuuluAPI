<?php

namespace AppBundle\Service;

use AppBundle\Service\BalanceService;
use AppBundle\Service\SDEGetterService;
use AppBundle\Service\SLCGetterService;


class HelloService
{

    private $blcServ;
    private $SDEServ;
    private $SLCServ;

    public function __construct(BalanceService $blcServ, SDEGetterService $SDEServ, SLCGetterService $SLCServ)
    {
        $this->blcServ = $blcServ ;
        $this->SDEServ = $SDEServ ;
        $this->SLCServ = $SLCServ ;
    }

    public function connection($name)
    {

        $credentiales = json_decode($name) ;

	$calculatedDigest = sha1('testUser'.sha1('passer').$credentiales->timestamp) ;

        if($credentiales->login == 'testUser' && $credentiales->digest == $calculatedDigest ){
            $baseDigest = base64_encode(sha1($credentiales->login."Da8H@dd_dh".$credentiales->digest)) ;
            return json_encode(array('codeRetour' => '1', 'baseDigest' => $baseDigest ));
        }
        else
            return json_encode(array('codeRetour' => '0', 'baseDigest' =>'fdfdf' ));

    }

    public function heartbeat($name)
    {
        $rti =  $this->blcServ->getBalance().$this->SDEServ->getBillSDE().$this->SLCServ->getBillSLC() ;

        return $rti ;

        // $rti="111" ==> 'Heart is beating ... Can you hear ?';
        // $rti="011" ==> 'Balance MicroService EndPoint is Off';
        // $rti="101" ==> 'SDE GetBill Microservice EndPoint is Off';
        // $rti="110" ==> 'SENELEC GetBill Microservice EndPoint is Off';
        // $rti="100" ==> 'SENELEC AND SDE GetBill Microservices EndPoints are Off';
        // $rti="010" ==> 'BALANCE AND SDE GetBill Microservices EndPoints are Off';
        // $rti="001" ==> 'SENELEC GetBill AND Balance Microservices EndPoints are Off';
        // $rti="000" ==> 'Web Service EndPoint is Temporarily Dead, try Later';


    }


}
