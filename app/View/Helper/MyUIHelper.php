<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MyUIHelper
 *
 * @author perfectmak
 */
class MyUIHelper extends AppHelper 
{
    public function getCountry($id, $countries)
    {
        foreach($countries as $country)
        {
            if($country['Country']['id'] == $id)
                return $country;
        }
    }
    
    public function returnEmptyIfEmpty($item, $tag = "em")
    {
        $return = "<".$tag.">(empty)</".$tag.">";
        
        if(!is_string($item) ||  is_null($item))
            return $return;;
        
        return (strlen($item) == 0) ? $return : $item;
    }
}

?>