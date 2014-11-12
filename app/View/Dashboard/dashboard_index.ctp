<section class="content-header">
    <h1>
        Workflow Summary
    </h1>
    <ol class="breadcrumb">
        <li><?php echo $this->Html->link("Home", array("action"=>"index"));?></li>
    </ol>
</section>
<?php ?>
<section class="content">
    <div class="row">
        
        <section class="col-lg-6 connectedSortable">            
            
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Trades Summary</h3>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Trade Id</th>
                                <th>Date of Shipment</th>
                                <th>Arrival Date</th>
                                <th>Form M Name</th>
                                <th>Amount</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($trades as $trade):
                                    $arrivalDate = strtotime($trade['Trade']['expected_arrival_time']);
                                    //$daysLeft = "";
                                    $daysLeft = round(($arrivalDate - time())/(60*60*24));
                            ?>

                                <tr>
                                    <td><?php echo $trade['Trade']['id'] ?></td>
                                    <td><?php echo $trade['Trade']['date_of_shipment'] ?></td>
                                    <td><?php echo $trade['Trade']['expected_arrival_time']." (".$daysLeft." days left)"; ?></td>
                                    <td><?php echo $trade['FormM']['name'] ?></td>
                                    <td><?php echo $trade['Trade']['amount'] ?></td>
                                </tr>
                            <?php endforeach?>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    <?php
                    echo $this->Html->link("View all", array("controller" => "trades", "action" => "index"), array("class" => ""));
                    ?>
                </div>
            </div>
            
            <?php if(count($shippings)){ ?>
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Shippings in progress</h3>
                </div>
                <div class="box-body no-padding">
                    <table class='table table-striped'>
                        <thead>
                            <tr>
                                <th>Trade Id</th>
                                <th>Shipping Line</th>
                                <th>Loading Port</th>
                                <th>Discharge Port</th>
                                <th>Shipping Date</th>
                                <th>Expected Date of Arrival</th>
                            </tr>
                        </thead>
                        <tbody>                            
                            <?php 
                                foreach($shippings as $shipping)
                                {
                                    echo "<tr>";
                                    echo "<td>".$shipping['Trade']['id']."</td>";
                                    echo "<td>".$shipping['ShippingLine']['name']."</td>";
                                    echo "<td>".$shipping['LoadingPort']['name']."</td>";
                                    echo "<td>".$shipping['DischargePort']['name']."</td>";
                                    echo "<td>".date('j m Y', strtotime($shipping['Shipping']['shipping_date']))."</td>";
                                    echo "<td>".date('j m Y', strtotime($shipping['Shipping']['expected_arrival_date']))."</td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    <?php
                    echo $this->Html->link("View all", array("controller" => "shippings", "action" => "index"), array("class" => ""));
                    ?>
                </div>
            </div>
            <?php }?>
        </section>
        
        <section class="col-lg-6 connectedSortable">
            
            <?php if(count($shippings)){ ?>
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Goods requiring clearing</h3>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Trade Id</th>
                                <th>Shipping Line</th>
                                <th>Form M Name</th>                        
                                <th>Days to Arrival</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($clearings as $clearing)
                            {
                                echo "<tr>";
                                echo "<td>".$clearing['Trade']['id']."</td>";
                                echo "<td>".$clearing['ShippingLine']['name']."</td>";
                                echo "<td>".$clearing['FormM']['name']."</td>";
                                echo "<td>".$this->MyDate->dayAgo(strtotime($clearing['Shipping']['expected_arrival_date']))."</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    <?php
                    echo $this->Html->link("View all", array("controller" => "clearings", "action" => "index"), array("class" => ""));
                    ?>
                </div>
            </div>
            <?php }?>
            
            <?php if(count($Notification)){ ?>
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Notifications</h3>
                </div>
                <div class="box-body">
                    <ul class="todo-list">
                        <?php 
                        foreach($Notification as $notification)
                        {
                        ?>                        
                        <li>
                            <!-- todo text -->
                            <span class="text"><?php echo $notification['Notification']['info']; ?></span>
                            <small class="label label-info"><i class="fa fa-clock-o"></i> <?php echo $this->MyDate->dayAgo(strtotime($notification['Notification']['created']));?></small>
                            <!-- General tools such as View or Delete-->
                            <div class="tools">
                                <a href="<?php echo Notification::appendParam($notification['Notification']['link'], $notification['Notification']['id'], $notification['Notification']['customer_id']); ?>" class="btn btn-primary btn-xs">
                                    View
                                </a>
                            </div>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class="box-footer">
                    <?php
                    ?>
                </div>
            </div>
            <?php } ?>
            
        </section>
    </div>
</section>