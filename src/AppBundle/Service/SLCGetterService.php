<?php
namespace AppBundle\Service;

class SLCGetterService
{
    public function getBillSLC()
    {
      $requeteParams = '<?xml version="1.0" encoding="UTF-8" ?><Request FN="GEPPOI" fromCustmer="221766459226" PIN="040186" custmerReference="8691301356" deviceModel="Android SDK built for x86_64" devicePlatform="Android" deviceVersion="6.0" deviceManufacturer="unknown" packageName="com.zuulu.zuulu" versionNumber="1.0.3" isVirtualDevice="true" geoLatitude="" geoLongitude="" appClientName="Samba Diallo" appType="development" deviceIP="125.63.92.170" uniqueDeviceKey="1496133345569" LN="FR"></Request>' ;

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

      $resXML = new \SimpleXMLElement($responseCurl) ;

      foreach ($resXML->ResponseMessage->invoices->invoice as $invoice) {
         echo $invoice["custmerReference"];
         echo "<br>"; 
         echo $invoice["cashPaymentFee"];
         echo "<br>"; 
         echo $invoice["amount"];
         echo "<br>"; 
         echo $invoice["dueDate"];
         echo "<br>"; 
      }



      if ($err) {
        return "0" ;
      } else {
        return "1" ;
      }

    }

    public function hello($name)
    {
        return 'Hello, '.$name;
    }

}