<?php
    function formatedShipping($shipping, $counter, $renewBaseUrl)
    {
        echo $counter.")\r\n Trade Name: ".$shipping['Trade']['name']."\r\n";
        echo "Shipping Date: ".date("j m Y", strtotime($shipping['Shipping']['shipping_date']))."\r\n";
        echo "Expected Arrival Date: ".date("j m Y", strtotime($shipping['Shipping']['expected_arrival_date']))."\r\n";
        echo "Link: ".$renewBaseUrl."/".$shipping['Shipping']['id']."\r\n";
    }    
    
?>
Hello,

Your following Shippings will be commencing soon.

<?php 
    if(count($shippings['month']))
    {
        echo "Shipping in a months time\r\n";
        $counter = 1;
        foreach($shippings['month'] as $formM)
        {
            formatedShipping($formM, $counter, $renewBaseUrl);
            $counter++;
        }
        echo "\r\n";
    }
    if(count($shippings['threeWeeks']))
    {
        echo "Shipping in three weeks time\r\n";
        $counter = 1;
        foreach($shippings['threeWeeks'] as $formM)
        {
            formatedShipping($formM, $counter, $renewBaseUrl);
            $counter++;
        }
        echo "\r\n";
    }
    if(count($shippings['twoWeeks']))
    {
        echo "Shipping in two weeks time\r\n";
        $counter = 1;
        foreach($shippings['twoWeeks'] as $formM)
        {
            formatedShipping($formM, $counter, $renewBaseUrl);
            $counter++;
        }
        echo "\r\n";
    }
    
    if(count($shippings['oneWeek']))
    {
        echo "Shipping within a week\r\n";
        $counter = 1;
        foreach($shippings['oneWeek'] as $formM)
        {
            formatedShipping($formM, $counter, $renewBaseUrl);
            $counter++;
        }
        echo "\r\n";
    }
    
?>

Regards,
Trade Workflow Team