<?php

namespace Eugene\ValidateVatNumberEu\Http\Helpers;

use Illuminate\Support\Facades\Validator;
class VATvalidatorHelper
{
  public static function validate($vatNumber,$validateCompany=false,$validateAddress=false,$includeRawResponse=false)
  {
      $ISO=substr($vatNumber, 0, 2);
      $vat=substr($vatNumber,2);
      $url='https://ec.europa.eu/taxation_customs/vies/rest-api/ms/'.$ISO.'/vat/'.$vat;
      $ch = curl_init();

      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");


      $headers = array();
      $headers[] = "Accept: application/json";
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

      $result = curl_exec($ch);
      if (curl_errno($ch)) {
          echo 'Error:' . curl_error($ch);
      }
      curl_close ($ch);
      return $result;
//      $validator = Validator::make([
//          'VAT'=>$vatNumber,
//          'companyName'=>$validateCompany,
//          'address'=>$validateAddress,
//          'includeRawResponse'=>$includeRawResponse
//      ], [
//          'VAT' => 'required|string',
//          'companyName' => 'string',
//          'address' => 'string',
//          'includeRawResponse' => 'string',
//      ]);
//      if ($validator->fails()){
//
//      }
        //$vatNumber,$validateCompany=false,$validateAddress=false,$includeRawResponse=false
  }
}
