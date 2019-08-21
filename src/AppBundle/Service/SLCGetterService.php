<?php

namespace AppBundle\Service;

use AppBundle\Service\GetFees;



class SLCGetterService
{


   private  $feeServ ;


   public function __construct(GetFees $feeServ){
      $this->feeServ = $feeServ ;
   }


    public function getBillSLC($reference, $credZuulu)
    {

      $fromCustomer = explode("#", $credZuulu)[0] ; 
      $pin = explode("#", $credZuulu)[1] ;

      $requeteParams = '<?xml version="1.0" encoding="UTF-8" ?><Request FN="GEPPOI" fromCustmer="'.$fromCustomer.'" PIN="'.$pin.'" custmerReference="'.$reference.'" deviceModel="Android SDK built for x86_64" devicePlatform="Android" deviceVersion="6.0" deviceManufacturer="unknown" packageName="com.zuulu.zuulu" versionNumber="1.0.3" isVirtualDevice="true" geoLatitude="" geoLongitude="" appClientName="Samba Diallo" appType="development" deviceIP="125.63.92.170" uniqueDeviceKey="1496133345569" LN="FR"></Request>' ;

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
          "content-type: text/xml",
      ), ));

      $responseCurl = curl_exec($curl);
      $err = curl_error($curl);
      curl_close($curl);


      if ($err) {
        return "0" ;
      } else {

       try{
        $resXML = new \SimpleXMLElement($responseCurl) ;

        $allBills = array() ;

	if (isset($resXML->ResponseMessage->invoices)){
          foreach ($resXML->ResponseMessage->invoices->invoice as $invoice) {
             $feeAmount = $this->feeServ->getSDEFee($credZuulu, ((array)$invoice["invoiceNumber"])["0"], ((array)$invoice["custmerReference"])["0"] ) ;
             $billInfo = array('customerReference' =>  ((array)$invoice["custmerReference"])["0"] ,
                           'invoiceNumber' => ((array)$invoice["invoiceNumber"])["0"],
 			   'cashPaymentFee' => ((array)$invoice["cashPaymentFee"])["0"],
		           'amount' => ((array)$invoice["amount"])["0"],
		           'dueDate' => ((array)$invoice["dueDate"])["0"],
			   'postpaidInvoiceId' => ((array)$invoice["id"])["0"],
			   'name' => ((array)$invoice["name"])["0"],
                           'feeAmount' => $feeAmount,
                           'totalAmount' => strval(intval(((array)$invoice["amount"])["0"])+intval($feeAmount) ),
                           'currency' => "FCFA"  ) ;


             array_push($allBills, $billInfo) ;
          }
        }
        return array("provider" => "SENELEC", "description" => "Postpaid Electricity Bill", "bills" => $allBills )  ;

	}catch(Exception $e){
	        return array("provider" => "SENELEC", "description" => "Postpaid Electricity Bill", "bills" => "Service is Not responding" ) ;
	}


      }

    }

    public function hello($name)
    {
        return 'Hello, '.$name;
    }

}
