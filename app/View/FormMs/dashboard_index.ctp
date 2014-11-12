<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Form M Tracking
        <?php echo $this->Html->link("Lodge Form M", array("action"=>"add"), array("class" => "btn btn-success btn-sm"));?>
    </h1>
    <ol class="breadcrumb">
        <li class="active">FormM Tracking</li>
    </ol>
</section>
<?php // var_dump($formMs); ?>
<!-- Main content -->
<section class="content">
    <?php
    $flash = $this->Session->flash();
    if($flash)
    {
    ?>
    <div class='box box-primary'>
        <div class='box-body'>
            <?php echo $flash;?>
        </div>

    </div>                
    <?php    
    }    
    if($formMsCount == 0)
    {
    ?>
        <h2 class="headline text-info"> You don't have any Form M yet. <?php echo $this->Html->link("Lodge Form M", array("action"=>"add"), array("class" => "btn btn-success btn-lg"));?>
    <?php
    }
    else
    {
    ?>
    <div class='table-responsive'>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Form M Name</th>
                <th>Seller's Name</th>
                <th>Total CFR (N)</th>
                <th>Insured Value (N)</th>
                <th>Registration Date</th>
                <th>Expiry Date</th>
                <th>Actions</th>
            <tr>
        </thead>
        <tbody>
            <?php
                foreach($formMs as $formM)
                {
                    $hasExpired = false;
                    $expiryDate = strtotime($formM['FormM']['expiration_date']);
                    $daysLeft = ($expiryDate - time())/(3600*24);
                    
                    if($daysLeft < 0)
                    {
                        //has expired
                        $hasExpired = true;
                        $rowClass = "row-expired";
                    }
                    else if($daysLeft < 4)
                    {
                        //three days to expiry
                        $rowClass = "row-danger";
                    }
                    else if($daysLeft < 30)
                    {
                        //one week to expiry
                        $rowClass = "row-warning";
                    }
                    else
                    {
                        //still have more than a week
                        $rowClass = "";
                    }
                    
                    
                    echo "<tr class='".$rowClass."'>";
                    echo "<td>".$formM['FormM']['name']."</td>";
                    echo "<td>".$formM['Seller']['name']."</td>";
                    echo "<td>".number_format((float)$formM['FormM']['total_cfr'], 2, '.', '')."</td>";
                    echo "<td>".number_format((float)$formM['FormM']['insurance_value'], 2, '.', '')."</td>";
                    echo "<td>".date('j M Y', strtotime($formM['FormM']['registration_date']))."</td>";
                    echo "<td>".date('j M Y', $expiryDate)." (".$this->MyDate->dayAgo($expiryDate).")";
                    if($hasExpired)
                    {
                        echo " - Has Expired";
                        echo " - ".$this->Html->link("Renew", array("controller" => "formMs",
                              "action" => "renew", $formM["FormM"]["id"]), array("class"=>"btn btn-xs btn-success"));
                    }
                    /*else if($rowClass != "")
                    {
                        echo " - ".$this->Html->link("Renew", array("controller" => "formMs",
                              "action" => "renew", $formM["FormM"]["id"]), array("class"=>"btn btn-xs btn-success"));
                    }*/
                    echo "</td>";
                    echo "<td>";
                    echo $this->Html->link("Details", array("controller" => "formMs",
                          "action" => "view", $formM["FormM"]["id"]), array("class"=>"btn btn-xs btn-primary btn-block"));
                    echo $this->Html->link("Edit", array("controller" => "formMs",
                          "action" => "edit", $formM["FormM"]["id"]), array("class"=>"btn btn-xs btn-success btn-block disabled"));
//                    echo $this->Html->link("Delete", array("controller" => "formMs",
//                          "action" => "delete", $formM["FormM"]["id"]), array("class"=>"btn btn-xs btn-danger btn-block"), "Are you sure you want delete it?");
            ?>
            <?php
                    echo "</td>";
                    echo "</tr>";
                }
    }
            ?>                    
        </tbody>
    </table>
    </div>
</section><!-- /.content -->