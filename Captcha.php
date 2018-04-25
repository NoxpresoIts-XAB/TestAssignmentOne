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
 * You're standing in a room with "digitization quarantine" written in 
 * LEDs along one wall. The only door is locked, but it includes a 
 * small interface. "Restricted Area - Strictly No Digitized Users Allowed."
 * 
 * It goes on to explain that you may only leave by solving a captcha 
 * to prove you're not a human. Apparently, you only get one millisecond to 
 * solve the captcha: too fast for a normal human, but it feels 
 * like hours to you.
 * 
 * The captcha requires you to review a sequence of digits (your puzzle input) 
 * and find the sum of all digits that match the next digit in the list. 
 * The list is circular, so the digit after the last digit is the 
 * first digit in the list.
 * 
 * For example:
 * 1122 produces a sum of 3 (1 + 2) because the first digit (1) 
 * matches the second digit and the third digit (2) matches the fourth digit.
 * 1111 produces 4 because each digit (all 1) matches the next. 
 * 1234 produces 0 because no digit matches the next. 
 * 91212129 produces 9 because the only digit that matches the 
 * next one is the last digit, 9.
 * 
 * What is the solution to your captcha?
 *
 *
 * PHP version 5
 *
 * @category ISCon
 * @package  PKG
 * @author   Xabiso Noguba <Xabiso.Noguba@is.co.za>
 * @license  http://SITE/LICENCE PROPRIETARY
 * @link     http://SITE/
 */ 
class Captcha
{
    /**
     * Variable intCaptchaCode 
     *
     * @var    intCaptchaCode
     * @access protected
     * @see    string
     * @static none
     */
    protected $intCaptchaCode =0;
    
    /**
     * Variable intCaptchaCodeOuput 
     *
     * @var    intCaptchaCodeOuput
     * @access protected
     * @see    string
     * @static none
     */
    protected $intCaptchaCodeOuput =0;
    
    
    /**
     * Variable intCaptchaCodeUserInput 
     *
     * @var    intCaptchaCodeUserInput
     * @access protected
     * @see    string
     * @static none
     */
    protected $intCaptchaCodeUserInput =0;
    
    /**
     * Default Constructor 
     *
     * @return void
     */
    public function __construct()
    {
    }
    
    /**
     * Generate Captcha Code
     *
     * @param integer $intCaptchaCode          - intCaptchaCode
     * @param integer $intCaptchaCodeUserInput - intCaptchaCodeUserInput
     *
     * @return object captcha
     */
    public function generateCaptchaCode(
        $intCaptchaCode = 0 ,
        $intCaptchaCodeUserInput = 0
    ) {
        if (is_numeric($intCaptchaCode) 
            && $intCaptchaCode >=0 
            && strlen((string) $intCaptchaCode) >=4
        ) {
            $this->intCaptchaCode = $intCaptchaCode;
            $this->intCaptchaCodeUserInput = $intCaptchaCodeUserInput;
        } else {
            throw Exception(
                "Wrong sumbit catach Code. Only requre numeric inputs and "
                ."You catcha must be more than 4 degits long"
            );
        }
    }
    
    /**
     * Set User Captcha Sum
     *
     * @param integer $intCaptchaCodeUserInput - intCaptchaCodeUserInput
     *
     * @return object captcha
     */
    public function setUserCaptchaSumSS($intCaptchaCodeUserInput = 0)
    {
        $this->intCaptchaCodeUserInput = $intCaptchaCodeUserInput;
    }
    
    /**
     * Valid Captcha Sum
     *
     * @param integer $checkType - checkType
     *
     * @return false
     */
    public function isValidCaptchaSum($checkType='AllMatch')
    { 
            $iCount    = strlen($this->intCaptchaCode);
            $rTempKey  = array(); 
            $rTempKeys = array(); 
            $intSum    = 0;
            $NextFirstTLastKey ="";
            $NextFirstTLast = true;
        for ($i=0; $i < $iCount; $i++) {  
            $Count = ($iCount-$i);
            $intTempKey = (integer) substr(
                (string) $this->intCaptchaCode, -$Count, 1
            );
                
            $PosNum = substr_count(
                (string) $this->intCaptchaCode,
                (string) $intTempKey
            );
            
            switch($checkType) {
            case "NextFirstAndThirdMatch":
                if (in_array($i, [0,1,2,3]) && $PosNum >=2) {
                    if ($PosNum ===2) {
                        $Sum = isset($rTempKey[$intTempKey]["SUM"])?
                        $rTempKey[$intTempKey]["SUM"]:0;
                        $rTempKey[$intTempKey]["POS"] = $PosNum;
                        $rTempKey[$intTempKey]["SUM"] = $intTempKey;
                    } elseif ($PosNum > 2) {
                        $Sum = isset($rTempKey[$intTempKey]["SUM"])?
                        $rTempKey[$intTempKey]["SUM"]:0;
                        $rTempKey[$intTempKey]["POS"] = $PosNum;
                        $rTempKey[$intTempKey]["SUM"] = ($Sum + $intTempKey);
                    }
                }
                break;
            case "AllMatch":
                if ($PosNum === 2) {
                    $Sum = isset($rTempKey[$intTempKey]["SUM"])?
                    $rTempKey[$intTempKey]["SUM"]:0;
                    $rTempKey[$intTempKey]["POS"] = $PosNum;
                    $rTempKey[$intTempKey]["SUM"] = $intTempKey;
                } else if ($PosNum > 2) {
                    $Sum = isset($rTempKey[$intTempKey]["SUM"])?
                    $rTempKey[$intTempKey]["SUM"]:0;
                    $rTempKey[$intTempKey]["POS"] = $PosNum;
                    $rTempKey[$intTempKey]["SUM"] = ($Sum + $intTempKey);
                }
                break;
            case "NextFirstTLast":
                if ($NextFirstTLast === true && $PosNum >=2) {
                    if ($PosNum ===2) {
                        $Sum = isset($rTempKey[$intTempKey]["SUM"])?
                        $rTempKey[$intTempKey]["SUM"]:0;
                        $rTempKey[$intTempKey]["POS"] = $PosNum;
                        $rTempKey[$intTempKey]["SUM"] = $intTempKey;
                        $NextFirstTLast    = false;
                        $NextFirstTLastKey = $intTempKey;
                    } elseif ($PosNum > 2) {
                        if ($NextFirstTLastKey != $intTempKey 
                            || $NextFirstTLastKey == $intTempKey
                        ) {
                            $NextFirstTLastKey = $intTempKey;
                            $Sum = isset($rTempKey[$intTempKey]["SUM"])?
                            $rTempKey[$intTempKey]["SUM"]:0;
                            $rTempKey[$intTempKey]["POS"] = $PosNum;
                            $rTempKey[$intTempKey]["SUM"] = ($Sum + $intTempKey);
                        } 
                    }
                }
            }
        }
            
        foreach ($rTempKey as $Key =>$val) {
            $KeyNumber = isset($val['SUM'])? $val['SUM']:0;
            $KeyPos    = isset($val['POS'])? $val['POS']:0;
            $intSum    = ($intSum + $KeyNumber);
        }
            
            $this->intCaptchaCodeOuput = $intSum; 
        if ($this->intCaptchaCodeOuput === $this->intCaptchaCodeUserInput) {
            return true;
        }
            return false;
    }
    
    /**
     * Default toString 
     *
     * @return string
     */
    public function __toString()
    {
        return "{$this->intCaptchaCode} produces a sum "
        ."of {$this->intCaptchaCodeOuput} user entered "
        ."sum {$this->intCaptchaCodeUserInput} <br/>";      
    }
    
    /**
     * Default destruct 
     *
     * @return void
     */
    public function __destruct()
    {
        $this->intCaptchaCode           = 0;
        $this->intCaptchaCodeOuput      = 0;
        $this->intCaptchaCodeUserInput  = 0;
    }
}