Hello,

You are yet to confirm the status of the following Paar tracking process:

<?php
    $counter = 1;
    foreach($paars as $paar)
    {
        echo $counter.") \r\n";
        $counter++;
?>
        Trade Name: <?php echo $paar['Trade']['name'];?>
        Link to confirm: <?php echo $viewLink."/".$paar['Paar']['id'];?>
        
<?php
    }

?>

Regards,
Trade Workflow Team