<?php
/**
 * Created by PhpStorm.
 * User: Dev_Victor
 * Date: 11/13/2019
 * Time: 1:23 PM
 */

$companyClass = require('Company.php');
//use Interview\Company;

/**
 * A default array of companies and their requirements will be defined here and passed to the constructor for test
 * The array can be modified as required following specified pattern below
 * The personal qualifications will also be defined and passed to a method that checks if you are qualified
 */

/* All company names should be strings and all strings should be joined with underscore for easy readability
* and consistency
 * COMPANIES THAT REQUIRE NOTHING SHOULD HAVE THEIR REQUIREMENTS SPECIFIED AS "nothing"
 *
 * YOU CAN ADD MORE OR REMOVE FROM THE ARRAY FOLLOWING THE CONVENSION
 */
$companyRequirementsArray = [
    ['company_A', ['apartment', 'property_insurance']],
    ['company_B', ['5_door_car', 'drivers_licence','car_insurance']],
    ['company_B', ['4_door_car', 'drivers_licence','car_insurance']],
    ['company_C', ['social_security_number', 'work_permit']],
    ['company_D', ['apartment']],
    ['company_D', ['flat']],
    ['company_D', ['house']],
    ['company_E', ['drivers_license', '2_door_car']],
    ['company_E', ['drivers_license', '3_door_car']],
    ['company_E', ['drivers_license', '4_door_car']],
    ['company_E', ['drivers_license', '5_door_car']],
    ['company_F', ['scooter', 'drivers_license', 'motorcycle_insurance']],
    ['company_F', ['bike', 'drivers_license', 'motorcycle_insurance']],
    ['company_F', ['motorcycle', 'drivers_license', 'motorcycle_insurance']],
    ['company_G', ['massage_qualification_certificate', 'liability_insurance']],
    ['company_H', ['storage_place']],
    ['company_H', ['garage']],
    ['company_J', ['nothing']],
    ['company_K', ['paypal_account']]
];



$myQualificationsArray = ['bike', 'drivers_license']; //modify as desired to see results


$companies = new \Interview\Company($companyRequirementsArray);
$companiesYouCanWorkFor = $companies->checkRequirements($myQualificationsArray);

if(($companiesYouCanWorkFor != null || empty($companiesYouCanWorkFor)) && count($companiesYouCanWorkFor) > 0){
    //manipulate and show user
    echo "You can work for:";
     echo"<br>";
    foreach($companiesYouCanWorkFor as $company){

        echo $company; echo"<br>";
    }
}else{
    echo "There are no companies available";
}