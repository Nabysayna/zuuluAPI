<?php

namespace AppBundle\Service;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Service\GetFees;


class SDEGetterService
{


   private $em ;

   private $fromCustomer ;

   private $pin ;

   private  $feeServ ;


   public function __construct(GetFees $feeServ){
      $this->feeServ = $feeServ ;
   }



    public function getBillSDE($reference, $credZuulu)
    {

      $fromCustomer = explode("#", $credZuulu)[0] ;
      $pin = explode("#", $credZuulu)[1] ;

      $requeteParams = '<?xml version="1.0" encoding="UTF-8" ?><Request FN="WEPPOI" fromCustmer="'.$this->fromCustomer.'" PIN="'.$this->pin.'" waterCustmerReference="'.$reference.'" deviceModel="SM-E7000" devicePlatform="Android" deviceVersion="4.4.2" deviceManufacturer="samsung" packageName="com.zuulu.zuulu" versionNumber="1.0.11" isVirtualDevice="false" geoLatitude="" geoLongitude="" appClientName="Samba Diallo" appType="production" deviceIP="154.124.220.12" ipLocationCode="SN" uniqueDeviceKey="1563208909945" LN="FR"></Request>' ;

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
        $allBills = array() ;

        if (isset($resXML->ResponseMessage->invoices)){
          foreach ($resXML->ResponseMessage->invoices->invoice as $invoice) {
             $feeAmount = $this->feeServ->getSDEFee($credZuulu, ((array)$invoice["invoiceNumber"])["0"], ((array)$invoice["custmerReference"])["0"] )    ;
            $billInfo = array('name' => ((array)$invoice["lastName"])["0"]." ".((array)$invoice["firstName"])["0"],
                           'amount' => ((array)$invoice["totalAmount"])["0"],
                           'customerReference' => ((array)$invoice["custmerReference"])["0"],
                           'invoiceNumber' => ((array)$invoice["invoiceNumber"])["0"],
                           'dueDate' => ((array)$invoice["dueDate"])["0"],
                           'postpaidInvoiceId' => ((array)$invoice["id"])["0"],
                           'feeAmount' => $feeAmount,
                           'totalAmount' => strval(intval(((array)$invoice["totalAmount"])["0"])+intval($feeAmount) ),
                           'currency' => "FCFA"  ) ;

            array_push($allBills, $billInfo) ;
        }


        }
        return array("provider" => "SDE", "description" => "Postpaid Water Bill","bills" => $allBills )  ;

        }catch(Exception $e){
                return array("provider" => "SDE", "description" => "Postpaid Water Bill", "bills" => "Service is Not responding" )  ;

        }

      }

    }

}
