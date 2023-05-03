# Package that help validate EU VAT number
### Installation
    Add the code bellow to your composer.json file:

        "repositories": [
            {
                "type": "vcs",
                "url": "git@github.com:IEugeneI/test.package.git"
            }
        ],

    Than run command:

    composer require eugene/validate_vat_number_eu

### Usage
    Simply write in your namespace:
    use Eugene\ValidateVatNumberEu\Http\Helpers\VATvalidatorHelper;
    
    And then use helper function:
    VATvalidatorHelper::validate(VATnumber,Validate_company,Validate_address,Include_raw_response)
    VATnumber=>required
    Validate_company=>company address or false(default false)
    Validate_address=> address or false(default false)
    Include_raw_response=>true or false (default false)