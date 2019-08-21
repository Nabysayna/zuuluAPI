<?php
namespace AppBundle\Service;

use AppBundle\Entity\Users ;
use Doctrine\ORM\EntityManagerInterface;


class BalanceService
{

   private $em ;

   private $fromCustomer ;

   private $pin ;


    public function __construct(EntityManagerInterface $em){
       $this->em = $em ;

      $dbuser = $this->em->getRepository('AppBundle:Users')->findOneBy(array('iduser' => 'testUser' )) ;

      if (!empty($dbuser) ) {
        $this->fromCustomer = explode('#', $dbuser->getCredzuulu() )[0] ;
        $this->pin = explode('#', $dbuser->getCredzuulu() )[1] ;
      }
      else{
        $this->fromCustomer = "0" ;
        $this->pin = "0" ;
      }

    }


    public function getBalance()
    {

      if(strcmp($this->pin, "0")==0)
	      return  json_encode( array("codeRetour"=>"0","message"=> "Erreur Serveur" )) ;
      
      $requeteParams = '<?xml version="1.0" encoding="UTF-8" ?><Request FN="BALC" fromCustmer="'.$this->fromCustomer.'" PIN="'.$this->pin.'" deviceModel="SM-E7000" devicePlatform="Android" deviceVersion="4.4.2" deviceManufacturer="samsung" packageName="com.zuulu.zuulu" versionNumber="1.0.11" isVirtualDevice="false" geoLatitude="" geoLongitude="" appClientName="Samba Diallo" appType="production" deviceIP="154.124.94.88" ipLocationCode="SN" uniqueDeviceKey="1562157795903" LN="FR"></Request>' ;
      $curl = curl_init();
      curl_setopt_array($curl, array(
      CURLOPT_URL => "http://194.187.94.199:5053/zuulu",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_POST => true,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => $requeteParams,
      CURLOPT_HTTPHEADER => array(
          "cache-control: no-cache",
          "content-type: application/xml",
      ), ));

      $responseCurl = curl_exec($curl);
      $err = curl_error($curl);
      curl_close($curl);

      if ($err) {
	      return  json_encode( array("codeRetour"=>"0","message"=> "Erreur Serveur" )) ;
      } else {

	      $resXML = new \SimpleXMLElement($responseCurl) ;
	      return  json_encode( array("codeRetour"=>"1", "solde"=> ((array)$resXML->ResponseMessage)["0"] )) ;

      }

    }

}
