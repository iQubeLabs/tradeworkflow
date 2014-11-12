<section class="content-header">
    <h1>
        Details of Goods
    </h1>
    <ol class="breadcrumb">
        <li><?php echo $this->Html->link("Clearing Tracking", array("action"=>"index"));?></li>
    </ol>
</section>
<?php // var_dump($shipping);?>
<section class="content">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <?php echo $this->element("flash_error"); ?>
            
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Details of Shipping</h3>
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
                        <dt>Is cleared</dt>
                        <dd>
                        <?php 
                        if($shipping["Shipping"]["is_cleared"])
                        {
                            echo "Is cleared";
                        }
                        else
                        {
                            echo "Not cleared";
                        }
                        ?></dd>
                    </dl>
                </div>
            </div>
            
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Update Shipping details here</h3>
                </div>
                <div class="box-body">
                    <?php
                    echo $this->Form->create("Shipping");
                    echo $this->Form->input("id");
                    echo $this->Form->input("demurrage_cost_per_day", array("class"=>"form-control", "placeholder"=>"In NGN", "required"));
                    echo "<br/>";
                    echo $this->Form->input("demurrage_last_day", array("class"=>"form-control", "type"=>"text", "data-format"=>"yyyy-MM-dd", "id"=>"shippingDate", "required"));
                    ?>
                </div>
                <div class="box-footer">
                    <?php
                    if($shipping["Shipping"]["is_cleared"] == 0)
                    {
                        echo $this->Form->submit("Update details", array("class"=>"btn btn-success"));
                    }
                    echo $this->Form->end();
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>