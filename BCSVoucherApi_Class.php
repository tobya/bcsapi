<?php

require_once('BCSBaseApi_Class.php');

class BCSVoucherAPI extends BCSAPIClass
{
  public function ByCode($VoucherCode, $SecurityCode = null){
     $apipath =   '/{apikey}/vouchers/bycode/{vouchercode}';
      $APIFields = ['{vouchercode}' => $VoucherCode];

     if (!is_null($SecurityCode)){
      $apipath .= '/{securitycode}';
      $APIFields['{securitycode}'] = $SecurityCode; 
     }
    $all = $this->CallAPI($apipath, $APIFields);

    return $all;
}
}