<?php namespace DigitreadMedia\FacebookPagePlugin\Classes;

use Exception;

/**
 * Custom Error Class
 * Author: Amanda Benade
 * Company: Digitread Media
 * E-Mail: info@digitread.co.za
 * Last Edited: 17 April 2019
 * Licence: MIT
 */
class FacebookContainerError extends \Exception 
{

    /**
     * @var string $var The variable name
     * @var string $error The error message if available
     * @var boolean $noValue The variable contains no data
     * @var boolean $wrongValue The variable contains the wrong data
     * @return error message
     */
	public static function ValueError($var,$error='',$noValue=true,$wrongValue=false) 
	{
	    if($noValue) {
	        tracelog('[FBPP][No Value Error]: '.$error);
		    return new self($var.': Missing parameter. Please enter a valid value.');
	    }
	    elseif($wrongValue) {
	        tracelog('[FBPP][Wrong Value Error]: '.$error);
		    return new self($var.': Wrong parameter value. Please enter a valid value.');
	    }
	    else {
	        tracelog('[FBPP][Unspecified Error]: '.$error);
		    return new self($var.': An error occured:'.$error);
	    }
	}
	
	/**
	 * @var string $url The URL checked
	 * @var string $error The error (options: invalid / notexist)
	 * @var string $apex The domain to verify eg. facebook.com
	 * @return error message
	 */
	public static function invalidUrl($url,$error,$apex='') 
	{
	    switch($error) 
	    {
	        case 'invalid':
	            if($apex) {
	                tracelog('[FBPP][Invalid Apex]: '.$url);
	                return 'The URL '.$url.' is not a valid (properly formed) '.$apex.' address';
	            }
	            else {
	                tracelog('[FBPP][Invalid URL]: '.$url);
	                return 'The URL '.$url.' is not a valid (properly formed) website address';
	            }
	            break;
	        case 'notexist':
	            tracelog('[FBPP][URL doesn`t exist]: '.$url);
	            return 'The URL '.$url.' does not exist';
	            break;	            
	    }
	}	
	
}