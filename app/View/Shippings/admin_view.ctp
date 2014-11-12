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
    if(strtotime($shipping['Shipping']['shipping_date']) > 0)
    {
        $shippingDate = $shipping['Shipping']['shipping_date'];  
    }
    else
    {
        $shippingDate = "Update this field when date has been confirmed.";
    }
    
    if(strtotime($shipping['Shipping']['expected_arrival_date']) > 0)
    {
        $expectedArrivalDate = $shipping['Shipping']['expected_arrival_date'];  
    }
    else
    {
        $expectedArrivalDate = "Update this field when date has been confirmed.";
    }
?>
<section class="content">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
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
                        Shipping for <?php echo $this->Html->link("Trade #".$shipping['Trade']['id'], array("controller"=>"trades", "action"=>"view", $shipping['Trade']['id']));?>
                    </h4>
                    <dl class="dl-horizontal">
                        <dt>Trader's Id:</dt>
                        <dd><?php echo $this->Html->link($shipping['Trade']['customer_id'], array("controller"=>"customers", "action"=>"view", $shipping['Trade']['customer_id']));?></dd>
                        <dt>Trade Name:</dt>
                        <dd><?php echo $shipping['Trade']['name'];?></dd>
                        <dt>Form M Name:</dt>
                        <dd><?php echo $this->Html->link($shipping['FormM']['name'], array("controller"=>"formMs", "action"=>"view", $shipping['FormM']['id']));?></dd>
                        <dt>Loading Port:</dt>
                        <dd><?php echo $shipping['LoadingPort']['name'];?></dd>
                        <dt>Discharge Port:</dt>
                        <dd><?php echo $shipping['DischargePort']['name'];?></dd>
                        <dt>Shipping Line:</dt>
                        <dd><?php echo $shipping['ShippingLine']['name'];?></dd>
                        <dt>Shipping Line's Phone:</dt>
                        <dd><?php echo $shipping['ShippingLine']['contact_phone'];?></dd>
                        <dt>Shipping Line's Emails:</dt>
                        <dd><?php echo $shipping['ShippingLine']['contact_email'];?></dd>
                        <dt>Shipping Line's Website</dt>
                        <dd><?php echo $shipping['ShippingLine']['website_address'];?></dd>
                        <dt>Bill of Laden Number</dt>
                        <dd><?php echo $shipping['Shipping']['bill_of_laden_number'];?></dd>
                    </dl>
                </div>
            </div>
                
            <div class='box box-primary'>
                <div class="box-header">
                    
                </div>
                <div class='box-body'>
                    <h4>
                        Contact the above stated Shipping Line to get the details below
                    </h4>
                    <form method="post">
                        <div>
                            <div class="form-group">
                                <label for="data[Shipping][shipping_date]">Shipping Date:</label>
                               <input type="text" class="form-control" id="shippingDate" data-format="yyyy-MM-dd" name="data[Shipping][shipping_date]" placeholder="<?php echo $shippingDate;?>"/>
                           </div>
                           <p/>
                           <div class="form-group">
                               <label for="data[Shipping][expected_arrival_date]">Expected Date of Arrival:</label>
                            <input type="text" class="form-control" id="arrivalDate" data-format="yyyy-MM-dd" name="data[Shipping][expected_arrival_date]" placeholder="<?php echo $expectedArrivalDate; ?>"/>
                           </div>
                        </div>
                        <p/>
                        <div>
                            <button type="submit" class="btn btn-primary">Update Shipping status</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>