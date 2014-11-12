<section class="content-header">
    <h1>
        Shippings
    </h1>
    <ol class="breadcrumb">
        <li><?php echo $this->Html->link("Shipment Tracking", array("action"=>"view"));?></li>
        <li class="active"><?php echo $navTitle; ?></li>
    </ol>
</section>
<?php // var_dump($shippings);?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Trade Name</th>
                        <th>Form M Name</th>
                        <th>Shipping Line</th>
                        <th>Loading Port</th>
                        <th>Discharge Port</th>
                        <th>Shipping Date</th>
                        <th>Expected Date of Arrival</th>
                        <th>Shipping Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($shippings as $shipping)
                    {
                        $shippingDateGotten = false;
                        if(strtotime($shipping['Shipping']['shipping_date']) > 0)
                        {
                            $shippingDateGotten = true;                            
                        }
                        
                        $status = "In Progress";
                        if(!$shippingDateGotten)
                        {
                            $status = "Pending";
                        }
                        if(strtotime($shipping['Shipping']['expected_arrival_date']) < time() && $shippingDateGotten)
                        {
                            $status = "Arrived";
                        }
                        
                        echo "<tr>";
                        echo "<td>".$shipping['Trade']['name']."</td>";
                        echo "<td>".$shipping['FormM']['name']."</td>";
                        echo "<td>".$shipping['ShippingLine']['name']."</td>";
                        echo "<td>".$shipping['LoadingPort']['name']."</td>";
                        echo "<td>".$shipping['DischargePort']['name']."</td>";
                        echo "<td>";
                        if($shippingDateGotten)
                            echo date('j m Y', strtotime($shipping['Shipping']['shipping_date']));
                        else
                            echo "Awaiting...";
                        echo "</td>";
                        echo "<td>";
                        if($shippingDateGotten)
                            echo date('j m Y', strtotime($shipping['Shipping']['expected_arrival_date']));
                        else
                            echo "Awaiting...";
                        echo "</td>";
                        echo "<td>".$status."</td>";
                        echo "<td>";
                        echo $this->Html->link("View Details", array("controller" => "shippings",
                          "action" => "view", $shipping["Shipping"]["id"]), array("class"=>"btn btn-xs btn-primary btn-block"));
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>