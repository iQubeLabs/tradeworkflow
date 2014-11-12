<section class="content-header">
    <h1>
        Clearing Tracking - <?php echo $title;?>
    </h1>
    <ol class="breadcrumb">
        <li><?php echo $this->Html->link("Clearing Tracking", array("action"=>"index"));?></li>
        <li><?php echo $title;?></li>
    </ol>
</section>
<?php // var_dump($clearings);?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php echo $this->element("flash_error"); ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Shipping Id</th>
                        <th>Shipping Line</th>
                        <th>Form M Name</th>                        
                        <th>Days to Arrival</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($clearings as $clearing)
                    {
                        echo "<tr>";
                        echo "<td>".$clearing['Shipping']['id']."</td>";
                        echo "<td>".$clearing['ShippingLine']['name']."</td>";
                        echo "<td>".$clearing['FormM']['name']."</td>";
                        echo "<td>".$this->MyDate->dayAgo(strtotime($clearing['Shipping']['expected_arrival_date']))."</td>";
                        echo "<td>";
                        if($clearing['Shipping']['is_cleared'] == "0")
                        {
                            echo "Not confirmed to be cleared";
                        }
                        else
                        {
                            echo "Confirmed to be cleared";
                        }
                        echo "</td>";
                        echo "<td>";
                        
                        if($clearing["Shipping"]["is_cleared"] == "0")
                        {
                            echo $this->Html->link("Mark Cleared", array("controller" => "clearings",
                              "action" => "clear", $clearing["Shipping"]["id"]), array("class"=>"btn btn-xs btn-success btn-block", 
                                  "id" => "clearBtn".$clearing["Shipping"]["id"]));
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>