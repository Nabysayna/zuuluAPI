<?php

namespace AppBundle\Service;


class GetFees
{


    public function getSDEFee($credZuulu, $invoiceNumber, $waterCustomerReference)
    {

      $fromCustomer = explode("#", $credZuulu)[0] ; 
      $pin = explode("#", $credZuulu)[1] ;

      $requeteParams = '<?xml version="1.0" encoding="UTF-8" ?><Request fromCustmer="'.$fromCustomer.'" isLocal="true" addBeneficiary="false" nickName="" ttType="PostW" amount="18884" transferTypeId="139" reverse="false" FN="GPD" invoiceNumber="'.$invoiceNumber.'" waterCustmerReference="'.$waterCustomerReference.'" postpaidInvoiceId="2089480" PIN="'.$pin.'" deviceModel="SM-E7000" devicePlatform="Android" deviceVersion="4.4.2" deviceManufacturer="samsung" packageName="com.zuulu.zuulu" versionNumber="1.0.11" isVirtualDevice="false" geoLatitude="" geoLongitude="" appClientName="Samba Diallo" appType="production" deviceIP="154.124.56.110" ipLocationCode="SN" uniqueDeviceKey="1564545261403" LN="FR"></Request>' ;

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

        $resXML = new \SimpleXMLElement($responseCurl) ;
        return explode(" ", ((array)$resXML->ResponseMessage->TransactionCharges->Charge->feeAmount)["0"])[0]  ;

      }

    }


}
