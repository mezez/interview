<?php

/**
 * Created by PhpStorm.
 * User: Dev_Victor
 * Date: 11/13/2019
 * Time: 11:41 AM
 */

namespace Interview;

class Company
{

    public $companyRequirements = [];

    public function __construct($companyRequirementsArray)
    {
        $this->setRequirements($companyRequirementsArray);
    }


    public function setRequirements($companyRequirementsArray)
    {

        array_push($this->companyRequirements, $companyRequirementsArray);
    }

    public function checkRequirements($myQualificationsArray)
    {
        //create an array to contain companiesYouAreEligible
        $companiesYouCanWorkFor = [];
        $companyRequirements = $this->companyRequirements[0];

        //if qualifications array is empty or null, find all companies where the requirement length is 1 and the requirement is "nothing"
        if ($myQualificationsArray == null or empty($myQualificationsArray)) {
            for ($i = 0; $i < count($companyRequirements); $i++) {
                if ((count($companyRequirements[$i][1]) == 1) && (strtolower($companyRequirements[$i][1][0]) == "nothing")) {
                    array_push($companiesYouCanWorkFor, $companyRequirements[$i][0]); //ie the company name
                }
            }

        } else {

            //loop through the requirements array, typically [company, [requiremts1, requiremt2, ...]]
            for ($i = 0; $i < count($companyRequirements); $i++) {

                //in each company,
                //if the requirement array length is 1 and the requirement == 'nothing', add it to the eligible array

                if ((count($companyRequirements[$i][1]) == 1) && strtolower($companyRequirements[$i][1][0]) == "nothing") {
                    array_push($companiesYouCanWorkFor, $companyRequirements[$i][0]);
                } elseif (count($companyRequirements[$i][1]) < count($myQualificationsArray)) {
                    //else if the requirement array length is less than your qualification length

                    //check if you have enough qualifications that match the number they have. If so, add the company name
                    $matchedQualificationCount = $this->doComparison($myQualificationsArray,$companyRequirements, $i);

                    if ($matchedQualificationCount >= count($companyRequirements[$i][1]) ){
                        array_push($companiesYouCanWorkFor, $companyRequirements[$i][0]);
                    }

                }
                //else if the requirement array length is equal to yours and all your qualifications are in the array, then add the company name
                elseif(count($companyRequirements[$i][1]) == count($myQualificationsArray)){
                    $matchedQualificationCount = $this->doComparison($myQualificationsArray,$companyRequirements, $i);
                    if ($matchedQualificationCount >= count($companyRequirements[$i][1]) ){
                        array_push($companiesYouCanWorkFor, $companyRequirements[$i][0]);
                    }
                }
                //else do nothing, the count of requirements is greater than your qualifications, so you are not qualified
            }
        }

        //now filter companies you can work for from the companyRequirementsArray to get companies you cannot work for
        $companiesYouCannotWorkFor = $this-> getCompaniesYouCannotWorkFor($companiesYouCanWorkFor, $companyRequirements);

        return ['companies_you_can_work_for' => $companiesYouCanWorkFor, 'companies_you_cannot_work_for' => $companiesYouCannotWorkFor ];
    }

    private  function doComparison($myQualificationsArray,$companyRequirements, $rootIndex){
        $matchedQualificationCount = 0;

        //check if you have enough qualifications that match the number they have, if so, add the company name
        foreach ($myQualificationsArray as $qualification) {
            if (in_array($qualification, $companyRequirements[$rootIndex][1])) {
                $matchedQualificationCount++;
            }
        }
        return $matchedQualificationCount;
    }

    private function getCompaniesYouCannotWorkFor($companiesYoucanWorkForArray, $companyRequirementsArray){
        $companiesYouCannotWorkFor = [];
        $companiesYouCannotWorkForFiltered = [];
        foreach($companyRequirementsArray as $companyRequirement){
            if(!in_array($companyRequirement[0],$companiesYoucanWorkForArray)){
                //you cannot work here
                array_push($companiesYouCannotWorkFor, $companyRequirement[0]);
            }
        }
        for($i = 0; $i < count($companiesYouCannotWorkFor); $i++){
            if($i == 0) {
                array_push($companiesYouCannotWorkForFiltered, $companiesYouCannotWorkFor[$i]);
            }elseif( $companiesYouCannotWorkFor[$i] != $companiesYouCannotWorkFor[$i -1]){
                array_push($companiesYouCannotWorkForFiltered, $companiesYouCannotWorkFor[$i]);
            }
        }
        return $companiesYouCannotWorkForFiltered;
    }

}
