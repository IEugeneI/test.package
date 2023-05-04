<?php

namespace Abss\Validate_vat_number_eu\Http\Helpers;

class VATvalidatorHelper
{
    const VAT_URL = 'https://ec.europa.eu/taxation_customs/vies/rest-api/ms/';

    /**
     * @param $vatNumber
     * @param $validateCompany
     * @param $validateAddress
     * @param $includeRawResponse
     * @return array
     */
    public static function validate($vatNumber, $validateCompany = false, $validateAddress = false,
                                    $includeRawResponse = false): array
    {
        if (strlen($vatNumber) < 7) {
            return self::response(false, false, 'Wrong VAT number', false);
        }
        $ISO = substr($vatNumber, 0, 2);
        $vat = substr($vatNumber, 2);
        $url = self::VAT_URL . $ISO . '/vat/' . $vat;
        $check = self::check($url);
        if ($check == 'Error') {
            return self::response(false, false, "Can't connect to service", false);
        }
        $check = json_decode($check);
        if ($check->isValid) {
            if ($validateCompany) {
                if ($check->name != $validateCompany) {
                    return self::response(false, $ISO, "Wrong company name", $check, $includeRawResponse);
                }
            }
            if ($validateAddress) {
                $address=str_replace("\n"," ",$check->address);
                if ($address != $validateAddress) {
                    return self::response(false, $ISO, "Wrong address", $check, $includeRawResponse);
                }
            }
            return self::response(true, $ISO, false, $check, $includeRawResponse);
        }
        return self::response(false, false, $check->userError, $check, $includeRawResponse);
    }

    /**
     * @param $url
     * @return bool|string
     */
    private static function check($url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");


        $headers = array();
        $headers[] = "Accept: application/json";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            return 'Error';
        }
        curl_close($ch);
        return $result;
    }

    /**
     * @param $valid
     * @param $country
     * @param $error
     * @param $rawResponse
     * @param $includeRawResponse
     * @return array
     */
    protected static function response($valid, $country, $error, $rawResponse, $includeRawResponse = false): array
    {
        $response = [
            'valid' => $valid,
            'country' => $country,
            'error' => $error,
        ];
        if ($includeRawResponse) {
            $response['rawResponse'] = $rawResponse;
        } else {
            $response['rawResponse'] = false;
        }
        return $response;
    }
}
