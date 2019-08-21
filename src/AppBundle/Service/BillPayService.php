<?php

namespace AppBundle\Service;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Service\GetFees;


class BillPayService
{


   private $em ;

   private $fromCustomer ;

   private $pin ;

   private  $feeServ ;


   public function __construct(GetFees $feeServ){
      $this->feeServ = $feeServ ;
   }



    public function payBillSDE($reference, $invoiceNumber, $credZuulu)
    {

//      $fromCustomer = explode("#", $credZuulu)[0] ;
//      $pin = explode("#", $credZuulu)[1] ;

      $requeteParams = '<?xml version="1.0" encoding="UTF-8" ?><Request fromCustmer="221766459226" isLocal="true" addBeneficiary="false" nickName="" ttType="PostW" amount="0" transferTypeId="139" reverse="false" FN="WP" invoiceNumber="10000428002782801081801" waterCustmerReference="428002782810" postpaidInvoiceId="2089480" PIN="040186" deviceModel="SM-E7000" devicePlatform="Android" deviceVersion="4.4.2" deviceManufacturer="samsung" packageName="com.zuulu.zuulu" versionNumber="1.0.11" isVirtualDevice="false" geoLatitude="" geoLongitude="" appClientName="Samba Diallo" appType="production" deviceIP="154.124.56.110" ipLocationCode="SN" uniqueDeviceKey="1564545261403" LN="FR"></Request>' ;

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
        return "0";
      } else {

       try{
           $resXML = new \SimpleXMLElement($responseCurl) ;

           if (isset($resXML->ResponseMessage)){
              if (isset($resXML->TransactionId) )
		if ( ((array)$resXML->TransactionId)["0"]=="-1" )
                 return json_encode(array("codeRetour" => "-1", "message" => ((array)$resXML->ResponseMessage)["0"] ) ) ;
		else
                 return json_encode(array("codeRetour" => "1", "message" => ((array)$resXML->ResponseMessage)["0"], "idTransaction" => ((array)$resXML->TransactionId)["0"] ) ) ;
           }

           return json_encode(array("codeRetour" => "0", "message" => "Payment Request  Failed") ) ;

        }catch(Exception $e){
	   return json_encode(array("codeRetour" => "0", "message" => "Payment Request  Failed") ) ;
         }

      }

    }




}
