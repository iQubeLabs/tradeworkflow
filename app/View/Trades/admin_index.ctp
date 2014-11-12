<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Manage Trades
        <?php echo $this->Html->link("Create Trade", array("action"=>"add"), array("class" => "btn btn-success btn-sm"));?>
    </h1>
    <ol class="breadcrumb">
        <li class="active">Trades</li>
    </ol>
</section>
<?php // var_dump($formMs); ?>
<!-- Main content -->
<section class="content">
    <?php
    echo $this->element("flash_error");
    if($formMsCount == 0)
    {
    ?>
        <h2 class="headline text-info"> You don't have any trades yet. <?php echo $this->Html->link("Create Trade", array("action"=>"add"), array("class" => "btn btn-success btn-lg"));?>
    <?php
    }
    else
    {
    ?>
    <div class='table-responsive'>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Trade Id</th>
                <th>Traders Id</th>
                <th>Form M Name</th>
                <th>Date Added</th>
                <th>Expiry Date</th>
                <th>Shipping Status</th>
                <th>Actions</th>
            <tr>
        </thead>
        <tbody>
            <?php
                foreach($formMs as $formM)
                {
                    $hasExpired = false;
                    $expiryDate = strtotime($formM['Trade']['expiry_date']);
                    $daysLeft = ($expiryDate - time())/(3600*24);
                    
                    if($daysLeft < 0)
                    {
                        //has expired
                        $hasExpired = true;
                        $rowClass = "row-expired";
                    }
                    if($daysLeft < 4)
                    {
                        //three days to expiry
                        $rowClass = "row-danger";
                    }
                    else if($daysLeft < 8)
                    {
                        //one week to expiry
                        $rowClass = "row-warning";
                    }
                    else
                    {
                        //still have more than a week
                        $rowClass = "";
                    }
                    
                    
                    echo "<tr class=''>";
                    echo "<td>".$formM['Trade']['id']."</td>";
                    echo "<td>".$this->Html->link($formM['Trade']['customer_id'], array("controller"=>"customers", "action"=>"view", $formM['Trade']['customer_id']))."</td>";
                    echo "<td>".$this->Html->link($formM['FormM']['name'], array("controller"=>"formMs", "action"=>"view", $formM['FormM']['id']))."</td>";
                    echo "<td>".date('j M Y', strtotime($formM['Trade']['date_added']))."</td>";
                    echo "<td>".date('j M Y', $expiryDate)." (".$this->MyDate->dayAgo($expiryDate).")";
                    if($hasExpired)
                    {
                        echo " - Has Expired";
                    }
                    echo "</td>";
                    echo "<td>";
                    $shipCount = count($formM["Shipping"]);
                    if($shipCount == 0 && !$hasExpired)
                    {
                        echo "Not Initialized";
                    }
                    else if($shipCount != 0 && !$hasExpired)
                    {
                        if(strtotime($formM["Shipping"][0]["shipping_date"]) < 0)
                        {
                            echo "Pending";
                        }
                        else if(strtotime($formM["Shipping"][0]["expected_arrival_date"]) < time() &&
                                !(strtotime($formM["Shipping"][0]["expected_arrival_date"]) < 0))
                        {
                            echo "Arrived";
                        }
                        else
                        {
                            echo "In progress";
                        }
                    }
                    else
                    {
                        //has expired with shipping uninitialized
                        echo "Did not include shipping";
                    }
                    echo "</td>";
                    echo "<td>";
                    echo $this->Html->link("View Workflow", array("controller" => "trades",
                          "action" => "view", $formM["Trade"]["id"]), array("class"=>"btn btn-xs btn-primary btn-block"));
                    echo $this->Html->link("Edit", array("controller" => "trades",
                          "action" => "edit", $formM["Trade"]["id"]), array("class"=>"btn btn-xs btn-success btn-block disabled"));
//                    echo $this->Html->link("Delete", array("controller" => "formMs",
//                          "action" => "delete", $formM["FormM"]["id"]), array("class"=>"btn btn-xs btn-danger btn-block"), "Are you sure you want delete it?");
                    echo "</td>";
                    echo "</tr>";
                }
    }
            ?>                    
        </tbody>
    </table>
    </div>
</section><!-- /.content -->