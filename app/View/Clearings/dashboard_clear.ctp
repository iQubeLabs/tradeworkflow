<section class="content-header">
    <h1>
        Clearing Tracking - Confirm Cleared Goods
    </h1>
    <ol class="breadcrumb">
        <li><?php echo $this->Html->link("Clearing Tracking", array("action"=>"index"));?></li>
        <li>Confirm Cleared</li>
    </ol>
</section>
<?php // var_dump($shipping);?>
<section class="content">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <?php echo $this->element("flash_error"); ?>
            
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Confirm that this Shipping is cleared</h3>
                </div>
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt>Form M Name</dt>
                        <dd><?php echo $shipping["FormM"]["name"]; ?></dd>
                        <dt>Shipping Line</dt>
                        <dd><?php echo $shipping["ShippingLine"]["name"]; ?></dd>
                        <dt>Discharge Port</dt>
                        <dd><?php echo $shipping["DischargePort"]["name"]; ?></dd>
                        <dt>Arrival Date</dt>
                        <dd><?php echo $shipping["Shipping"]["expected_arrival_date"]; ?></dd>
                    </dl>
                </div>
                <div class="box-footer">
                    <?php
                    if($shipping["Shipping"]["is_cleared"] == 0)
                    {
                        echo $this->Html->link("Confirm goods are cleared", array("action" => "clear", "?" => array("confirm" => md5($shipping["Shipping"]["id"])), $shipping["Shipping"]["id"]), array("class" => "btn btn-primary"), "Are you sure?");
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>