<?php
    function formatedFormM($formM, $counter, $renewBaseUrl)
    {
        echo $counter.")\r\n Form M Name: ".$formM['FormM']['name']."\r\n";
        echo "Expiry Date: ".date("j m Y", strtotime($formM['FormM']['expiration_date']))."\r\n";
        echo "Link to renew: ".$renewBaseUrl."/".$formM['FormM']['id']."\r\n";
    }    
    
?>
Hello,

The following Form M'(s) will be expiring soon.
You are required to renew them if they are still on.

<?php 
    if(count($expiringFormMs['month'])) {
        echo "Expiring in a months time\r\n";
        $counter = 1;
        foreach($expiringFormMs['month'] as $formM)
        {
            formatedFormM($formM, $counter, $renewBaseUrl);
            $counter++;
        }
        echo "\r\n";
    }
    if(count($expiringFormMs['threeWeeks']))
    {
        echo "Expiring in three weeks time\r\n";
        $counter = 1;
        foreach($expiringFormMs['threeWeeks'] as $formM)
        {
            formatedFormM($formM, $counter, $renewBaseUrl);
            $counter++;
        }
        echo "\r\n";
    }
    if(count($expiringFormMs['twoWeeks']))
    {
        echo "Expiring in two weeks time\r\n";
        $counter = 1;
        foreach($expiringFormMs['twoWeeks'] as $formM)
        {
            formatedFormM($formM, $counter, $renewBaseUrl);
            $counter++;
        }
        echo "\r\n";
    }
    
    if(count($expiringFormMs['oneWeek']))
    {
        echo "Expiring within a week\r\n";
        $counter = 1;
        foreach($expiringFormMs['oneWeek'] as $formM)
        {
            formatedFormM($formM, $counter, $renewBaseUrl);
            $counter++;
        }
        echo "\r\n";
    }
    
?>


Regards.
Trade Workflow Team