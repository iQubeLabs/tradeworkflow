<section class="content-header">
    <h1>
        Shippings
    </h1>
    <ol class="breadcrumb">
        <li><?php echo $this->Html->link("Shipment Tracking", array("action"=>"index"));?></li>
        <li class="active">View</li>
    </ol>
</section>
<?php
// var_dump($shipping);    
    $canStartDocumentTracking = false;
    if(strtotime($shipping['Shipping']['shipping_date']) > 0)
    {
        $shippingDate = date("Y-m-d", strtotime($shipping['Shipping']['shipping_date']));
        
        $canStartDocumentTracking = Shipping::canStartDocumentTracking($shipping['Shipping']['shipping_date']);
    }
    else
    {
        $shippingDate = "Date not confirmed yet.";
    }
    
    if(strtotime($shipping['Shipping']['expected_arrival_date']) > 0)
    {
        $expectedArrivalDate = date("Y-m-d", strtotime($shipping['Shipping']['expected_arrival_date']));  
    }
    else
    {
        $expectedArrivalDate = "Date not confirmed yet.";
    }
?>
<section class="content">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <?php
            $flash = $this->Session->flash();
            if($flash)
            {
            ?>
                <div class='box box-success'>
                    <div class='box-body'>
                        <?php echo $flash;?>
                    </div>

                </div>                
                <p/>
            <?php
            }
            ?>            
            <div class='box box-primary'>
                <div class="box-header">
                    
                </div>
                <div class='box-body'>
                    <h4>
                        <b>Trade Name:</b> <?php echo $shipping['Trade']['name'];?>
                    </h4>
                        <div>
                            <div class="">
                                <label for="data[Shipping][shipping_date]">Shipping Date:</label> <?php echo $shippingDate;?>
                           </div>
                           <div class="">
                               <label>Expected Date of Arrival:</label> <?php echo $expectedArrivalDate; ?>
                           </div>
                            <div class="">
                               <label>Shipping Line:</label> <?php echo $shipping['ShippingLine']['name']; ?>
                           </div>
                            <div class="">
                               <label>Loading Port:</label> <?php echo $shipping['LoadingPort']['name']; ?>
                           </div>
                            <div class="">
                               <label>Discharge Port:</label> <?php echo $shipping['DischargePort']['name']; ?>
                           </div>
                        </div>
                        <hr/>
                        <?php
                        if($canStartDocumentTracking && $shipping['Document']['id'] == null)
                        {
                        ?>                            
                            <div>
                                <em><h4>Your shipment is already on the way.<br/><?php echo $this->Html->link("Start Document tracking", array("controller" => "documents", "action" => "init", $shipping['Shipping']['id']), array("class"=>"btn btn-primary"));?></h4></em>
                            </div>
                        <?php 
                        }
                        else if($shipping['Document']['id'] == null)
                        {
                            echo <<<EOQ
                                <div>
                                    <em>You will be notified when Document tracking can be initiated.</em>
                                </div>
EOQ;
                        }
                        else
                        {
                            echo <<<EOQ
                                <div>
                                    <em></em>
                                </div>
EOQ;
                        }
                        ?>
                </div>
            </div>
        </div>
    </div>
</section>