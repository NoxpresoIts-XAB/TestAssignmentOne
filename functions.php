<?php
/**
 * PHP version 5
 *
 * @category ISCon
 * @package  PKG
 * @author   Xabiso Noguba <Xabiso.Noguba@is.co.za>
 * @license  http://SITE/LICENCE PROPRIETARY
 * @link     http://SITE/
 */  

/**
 * Check sum
 *
 * @param array $rSpreadsheet -rSpreadsheet
 *
 * @return integer|mixed
 */
function checksum($rSpreadsheet=[])
{
    $intSum = 0;
    $rSum = [];
    foreach ($rSpreadsheet as $key =>$val) {
        
        $smallest   = isset($val["smallest"])?$val["smallest"]:0;
        $largest    = isset($val["largest"])?$val["largest"]:0;
        $difference = isset($val["difference"])?$val["difference"]:0;
        
        $intSum     = $intSum + $difference;
        $rSum[]     = $difference;
        $rowsCount  = ((integer) $key + 1);
        
        if ($rowsCount = 1) {
            echo "The first row's largest and "
            ."smallest values are $largest and $smallest, "
            ."and their difference is $difference. <br>";
        } elseif ($rowsCount = 2) { 
            echo "The second row's largest and "
            ."smallest values are {$largest} and {$smallest}, "
            ."and their difference is {$difference}.";
        } elseif ($rowsCount = 3) {
            echo "The third row's largest and "
            ."smallest values are {$largest} and {$smallest}, "
            ."and their difference is {$difference}. <br>";
        } else {
            $rtestchecker[$key]["Message"] ="The {$rowsCount} "
            ."row's largest and "
            ."smallest values are {$largest} and {$smallest}, "
            ."and their difference is {$difference}. <br>";
        }
    }
    
    echo "The function checksum  would be " 
    . implode(" + ", $rSum) 
    . " = {$intSum}. <br/>";
    return $intSmallest;
}

/**
 * Get Smallest Array Value 
 *
 * @param array $rSpreadsheet -rSpreadsheet
 *
 * @return integer|mixed
 */
function getSmallest($rSpreadsheet=[])
{
    $intSmallest = isset($rSpreadsheet[0])?$rSpreadsheet[0]:0;
    foreach ($rSpreadsheet as $key =>$val) {
        if ($intSmallest >= $val) {
            $intSmallest = $val;
        }
    }
    return $intSmallest;
}

/**
 * Calc Difference  
 *
 * @param integer $intFirstValue  - intFirstValue 
 * @param integer $intSecondValue - intSecondValue
 *
 * @return integer|mixed
 */
function calcDifference($intFirstValue=0, $intSecondValue=0)
{
    return ($intFirstValue - $intSecondValue);
}

/**
 * Get Largest Array Value 
 *
 * @param array $rSpreadsheet -rSpreadsheet
 *
 * @return integer|mixed
 */
function getLargest($rSpreadsheet=[])
{
    $intLargest = isset($rSpreadsheet[0])?$rSpreadsheet[0]:0;
    foreach ($rSpreadsheet as $key =>$val) {
        if ($intLargest <= $val) {
            $intLargest = $val;
        }
    }
    return $intLargest;
}
?>