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
        //print_r(count($companyRequirements)); die();

        //if qualifications array is empty or null, find all companies where the requirement length is 1 and the requirement is "nothing"
        if ($myQualificationsArray == null or empty($myQualificationsArray)) {
            for ($i = 0; $i < count($companyRequirements); $i++) {
                if ((count($companyRequirements[$i][1]) == 1) && (strtolower($companyRequirements[$i][1][0]) == "nothing")) {
                    array_push($companiesYouCanWorkFor, $companyRequirements[$i][0]); //ie the company name
                }
            }

        } else {

            //loop through the requirements array, typically [company, [requiremts1, requiremt2, ...]
            for ($i = 0; $i < count($companyRequirements); $i++) {

                //in each company,
                //if the requirement array length is 1 and the requirement == 'nothing', add it to the eligible array

                if ((count($companyRequirements[$i][1]) == 1) && strtolower($companyRequirements[$i][1][0]) == "nothing") {
                    array_push($companiesYouCanWorkFor, $companyRequirements[$i][0]);
                } elseif (count($companyRequirements[$i][1]) < count($myQualificationsArray)) {
                    //else if the requirement array length is less than you qualification length
                    //create a qualification length count

                    //check if you have enough qualifications that match the number they have, if so add the company name
                    $matchedQualificationCount = $this->doComparison($myQualificationsArray,$companyRequirements, $i);

//                    foreach ($myQualificationsArray as $qualification) {
//                        if (in_array($qualification, $companyRequirements[$i][1])) {
//                            $matchedQualificationCount++;
//                        }
//                    }

                    if ($matchedQualificationCount >= count($companyRequirements[$i][1]) ){
                        array_push($companiesYouCanWorkFor, $companyRequirements[$i][0]);
                    }

                }
                //else if the requirment array length is equal to yours and all your qualifications are in the array, then add the company name
                elseif(count($companyRequirements[$i][1]) == count($myQualificationsArray)){
                    $matchedQualificationCount = $this->doComparison($myQualificationsArray,$companyRequirements, $i);
                    if ($matchedQualificationCount >= count($companyRequirements[$i][1]) ){
                        array_push($companiesYouCanWorkFor, $companyRequirements[$i][0]);
                    }
                }
                //else do nothing, the count of requirements is greater than your qualifications for you are not qualified
            }
        }

        //sweep the array for duplicate entries
        return $companiesYouCanWorkFor;
    }

    private  function doComparison($myQualificationsArray,$companyRequirements, $rootIndex){
        $matchedQualificationCount = 0;

        //check if you have enough qualifications that match the number they have, if so add the company name
        foreach ($myQualificationsArray as $qualification) {
            if (in_array($qualification, $companyRequirements[$rootIndex][1])) {
                $matchedQualificationCount++;
            }
        }
        return $matchedQualificationCount;
    }


}