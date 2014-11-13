<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Manage Shipments
        <?php echo $this->Html->link("Lodge Shipment", array("action"=>"add"), array("class" => "btn btn-success btn-sm"));?>
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
        <h2 class="headline text-info"> You don't have any shipment yet. <?php echo $this->Html->link("Lodge Shipment", array("action"=>"add"), array("class" => "btn btn-success btn-lg"));?>
    <?php
    }
    else
    {
    ?>
    <div class='table-responsive'>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>S/N</th>
                <!-- <th>Trade Name</th> -->
                <th>Form M Name</th>
                <th>Date of Shipment</th>
                <th>Arrival Date</th>
                <th>Days Left</th>
                <th>Description</th>
                <th>Shipping Line</th>
                <th>Vessel Name</th>
                <th>Quantity</th>
                <th>Amount(N)</th>
                <!-- <th>Date Added</th> -->
                <th>Actions</th>
            <tr>
        </thead>
        <tbody>
            <?php
                $i = 0;
                foreach($formMs as $formM)
                {
                    $hasExpired = false;
                    $arrivalDate = strtotime($formM['Trade']['expected_arrival_time']);
                    $daysLeft = round(($arrivalDate - time())/(3600*24));
                    $i++;
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
                    echo "<td>".$i."</td>";
                    echo "<td>".$formM['FormM']['name']."</td>";
                    echo "<td>".date('j M Y', strtotime($formM['Trade']['date_of_shipment']))."</td>";
                    echo "<td>".date('j M Y', strtotime($formM['Trade']['expected_arrival_time']))."</td>";
                    if ($daysLeft > 0) {
                        echo "<td>$daysLeft days</td>";
                    } else {
                        echo "<td>Goods arrived</td>";
                    }
                    echo "<td>".$formM['Trade']['goods_description']."</td>";
                    echo "<td>".$formM['Trade']['shipping_line']."</td>";
                    echo "<td>".$formM['Trade']['vessel_name']."</td>";
                    echo "<td>".$formM['Trade']['quantity']." ".$formM['Unit']['name']."</td>";
                    // echo "<td>".$formM['Unit']['name']."</td>";
                    echo "<td>".number_format((float)$formM['Trade']['amount'], 2, '.', '')."</td>";
                    //echo "<td>".$formM['Trade']['created']."</td>";

                    /*if($hasExpired)
                    {
                        echo " - Has Expired";
                    }
                    echo "</td>";
                    echo "<td>";
                    $shipCount = count($formM["Shipping"]);
                    if($shipCount == 0 && !$hasExpired)
                    {
                        echo $this->Html->link("Add Shipping Details", array("controller" => "shippings",
                              "action" => "init", $formM["Trade"]["id"]), array("class"=>"btn btn-xs btn-success btn-block"));
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
                    echo "</td>";*/
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
            ?>                    
        </tbody>
    </table>
    </div>
            <?php
                       echo $this->element("paging");
    }
            ?>
</section><!-- /.content