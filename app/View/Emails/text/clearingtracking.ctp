Hello,

This is to inform you that Clearing Tracking is active on your following trades.

<?php
    $counter = 1;
    foreach($clears as $clear)
    {
        echo $counter.") ";
        $counter++;
                
?>
        Trade Name: <?php echo $clear['Trade']['name'];?>
        
<?php
    }
    
    echo 'Confirm them cleared now by visiting the link below: \r\n';
    echo $viewLink;
?>

Regards.
Trade Workflow Team