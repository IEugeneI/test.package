<?php

namespace Eugene\ValidateVatNumberEu\Http\Helpers;
use Eugene\ValidateVatNumberEu\Http\Requests\ChangeProjectStatusRequest;
use Illuminate\Http\Request;

class VATvalidatorHelper
{
  public static function validate(ChangeProjectStatusRequest $request)
  {
        dd('123');
        //$vatNumber,$validateCompany=false,$validateAddress=false,$includeRawResponse=false
  }
}
