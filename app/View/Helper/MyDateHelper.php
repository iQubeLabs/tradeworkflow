<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses("AppHelper", "View/Helper");
/**
 * Description of DateHelper
 *
 * @author perfectmak
 */
class MyDateHelper extends AppHelper{
    
    public function dayAgo($timestamp)
    {       
        $today = time();    
        $createdday= $timestamp;
        $datediff = $today - $createdday;
        
        if($datediff > 0)
            $final = "ago";
        else
            $final = "left";
        
        $datediff = abs($datediff);
        $difftext="";  
        $years = floor($datediff / (365*60*60*24));  
        $months = floor(($datediff - $years * 365*60*60*24) / (30*60*60*24));  
        $days = floor(($datediff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));  
        $hours= floor($datediff/3600);  
        $minutes= floor($datediff/60);  
        $seconds= floor($datediff);  
        //year checker  
        if($difftext=="")  
        {  
          if($years>1)  
           $difftext=$years." years $final";  
          elseif($years==1)  
           $difftext=$years." year $final";  
        }  
        //month checker  
        if($difftext=="")  
        {  
           if($months>1)  
           $difftext=$months." months $final";  
           elseif($months==1)  
           $difftext=$months." month $final";  
        }  
        //month checker  
        if($difftext=="")  
        {  
           if($days>1)  
           $difftext=$days." days $final";  
           elseif($days==1)  
           $difftext=$days." day $final";  
        }  
        //hour checker  
        if($difftext=="")  
        {  
           if($hours>1)  
           $difftext=$hours." hours $final";  
           elseif($hours==1)  
           $difftext=$hours." hour $final";  
        }  
        //minutes checker  
        if($difftext=="")  
        {  
           if($minutes>1)  
           $difftext=$minutes." minutes $final";  
           elseif($minutes==1)  
           $difftext=$minutes." minute $final";  
        }  
        //seconds checker  
        if($difftext=="")  
        {  
           if($seconds>1)  
           $difftext=$seconds." seconds $final";  
           elseif($seconds==1)  
           $difftext=$seconds." second $final";  
        }  
        return $difftext;  
    }
    
    public function dateTimeToDate($datetime, $format = "Y-m-d")
    {
        return date($format, strtotime($datetime));
    }
}

?>