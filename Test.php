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
 
require_once "Captcha.php";
require_once "functions.php";

try
{
    echo("<br/><br/> Example One Results : <br/><br/>");
    $CaptchaObject  = new Captcha();
    //For example:
    
    // 1122 produces a sum of 3 (1 + 2) because the first digit (1) matches 
    // the second digit and the third digit (2) matches the fourth digit.
    $CaptchaObject->generateCaptchaCode(1122, 3);
    $isCheckedCaptcha = $CaptchaObject->isValidCaptchaSum(
        "NextFirstAndThirdMatch"
    );
    if ($isCheckedCaptcha === true) {
        echo($CaptchaObject);
    } else {
        echo($CaptchaObject);
    }
    
    //1111 produces 4 because each digit (all 1) matches the next.
    $CaptchaObject->generateCaptchaCode(1111, 4);
    $isCheckedCaptcha = $CaptchaObject->isValidCaptchaSum(
        "AllMatch"
    );
    if ($isCheckedCaptcha === true) {
        echo($CaptchaObject);
    } else {
        echo("Restricted Area - Strictly No Digitized Users Allowed.<br/>");
    }
    
    // 1234 produces 0 because no digit matches the next.
    $CaptchaObject->generateCaptchaCode(1234, 0);
    $isCheckedCaptcha = $CaptchaObject->isValidCaptchaSum(
        "AllMatch"
    );
    if ($isCheckedCaptcha === true) {
        echo($CaptchaObject);
    } else {
        echo("Restricted Area - Strictly No Digitized Users Allowed.<br/>");
    }
    
    // 91212129 produces 9 because the only digit that matches the next one 
    // is the last digit, 9.
    $CaptchaObject->generateCaptchaCode(91212129, 9);
    $isCheckedCaptcha = $CaptchaObject->isValidCaptchaSum("NextFirstTLast");
    if ($isCheckedCaptcha === true) {
        echo($CaptchaObject);
    } else {
        echo("Restricted Area - Strictly No Digitized Users Allowed.<br/>");
    }
    
    /**
    * As you walk through the door, a glowing humanoid shape yells in your 
    * direction. "You there! Your state appears to be idle. Come help us 
    * repair the corruption in this spreadsheet - if we take another 
    * millisecond, we'll have to display an hourglass cursor!"
    * The spreadsheet consists of rows of apparently-random numbers. 
    * To make sure the recovery process is on the right track, 
    * they need you to calculate the spreadsheet's checksum. 
    * For each row, determine the difference between the largest 
    * value and the smallest value; the checksum is the sum of all 
    * of these differences.
    *
    * For example, given the following spreadsheet:
    * 5 1 9 5 
    * 7 5 3 
    * 2 4 6 8
    * The first row's largest and smallest values are 9 and 1, and 
    * their difference is 8.
    * The second row's largest and smallest values are 7 and 3, and 
    * their difference is 4.
    * The third row's difference is 6.
    * In this example, the spreadsheet's checksum 
    * would be 8 + 4 + 6 = 18.
    * What is the checksum for the spreadsheet in your puzzle input?
    * To play, please identify yourself via one of these services:
    */
    
    $rSpreadsheet = [
        [5,1,9,5],
        [7,5,3],
        [2,4,6,8],
    ];
   
    $rtestchecker = [];
    foreach ($rSpreadsheet as $key =>$row) {
        arsort($row);
        $rtestchecker[$key]["smallest"]   = getSmallest($row); 
        $rtestchecker[$key]["largest"]    = getLargest($row);
        $rtestchecker[$key]["difference"] = calcDifference(
            $rtestchecker[$key]["largest"],
            $rtestchecker[$key]["smallest"]
        );
    }
    echo("<br/><br/> Example TWO Results : <br/><br/>");
    checksum($rtestchecker);
    
} catch (Exception $ex) {
    die($ex->getMessage());
}
?>