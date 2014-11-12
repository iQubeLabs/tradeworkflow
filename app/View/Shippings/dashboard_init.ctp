<section class="content-header">
    <h1>
        Initialize Shipping
    </h1>
    <ol class="breadcrumb">
        <li><?php echo $this->Html->link("Shipment Tracking", array("action"=>"index"));?></li>
        <li class="active">Initialize Shipping</li>
    </ol>
</section>
<?php // var_dump($trade);?>
<section class="content">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <?php
                $flash = $this->Session->flash();
                if($flash)
                {
                ?>
                <div class='box box-danger'>
                    <div class='box-body'>
                        <?php echo $flash;?>
                    </div>
                </div>                
                <?php
                }
                if($error == false)
                {
            ?>
                    <div>
                        <div class="box box-solid">
                            <div class="box-header">
                                <i class="fa fa-archive"></i>
                                <h3 class="box-title">Description of Trade</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <dl class="dl-horizontal">
                                    <dt>Trade Name:</dt>
                                    <dd><?php echo $trade['Trade']['name'];?></dd>
                                    <dt>Form M Name:</dt>
                                    <dd><?php echo $trade['FormM']['name'];?></dd>
                                    <dt>Date Registered:</dt>
                                    <dd><?php echo date('j M Y', strtotime($trade['FormM']['registration_date']));?></dd>
                                    <dt>Date Expiring:</dt>
                                    <dd><?php echo date('j M Y', strtotime($trade['FormM']['expiration_date']));?></dd>
                                    <dt>Mode of Payment:</dt>
                                    <dd><?php echo FormM::$ENUM_MODE_OF_PAYMENT[intval($trade['FormM']['mode_of_payment'])];?></dd>
                                </dl>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>
            <?php 
                }
            ?>
            <p>
                <div>
                    Fill the details below to start the shipping process for the above trade.
                </div>
            </p>
            <p></p>
            <form method="post">
                <div class="form-group">
                    <input type="hidden" name="data[Shipping][trade_id]" value="<?php echo $tradeId;?>"/>
                    <input type="hidden" name="data[Shipping][loading_port_id]" value="<?php echo $trade['FormM']['loading_port_id'];?>"/>
                    <input type="hidden" name="data[Shipping][discharge_port_id]" value="<?php echo $trade['FormM']['discharge_port_id'];?>"/>
                    <fieldset>
                        <legend>Provide Shipping Details</legend>
                        <label>Shipping Line Name</label>
                        <input type="text" class="form-control" name="data[ShippingLine][name]" placeholder="Name of Shipping Line" required/>
                        <input type="tel" class="form-control" name="data[ShippingLine][contact_phone]" placeholder="Phone of Shipping Line" required/>
                        <input type="email" class="form-control" name="data[ShippingLine][contact_email]" placeholder="Email Address of Shipping Line" required/>
                        <input type="text" class="form-control" name="data[ShippingLine][website_address]" placeholder="Shipping Lines website (Optional)"/>
<!--                        <select class="input-group col-md-12" id='countrySelect' name="data[Shipping][shipping_line_id]">
                            <?php
                            foreach ($shippingLines as $shippingLine)
                            {
                                echo "<option value='".$shippingLine['ShippingLine']['id']."'>".$shippingLine['ShippingLine']['name']."</option>";
                            }
                            ?>
                        </select>-->
                        <br/>
                        <div class=''>
                            <input type="text" name="data[Shipping][bill_of_laden_number]" class="form-control" placeholder="Bill of Laden Number" required/>
                        </div>
                        <br/>
                        <hr/>
                        <div>
                            <?php 
                                if(!$flash)
                                {
                            ?>                            
                                    <button type="submit" class="btn btn-primary btn-block">Start Shipping Process</button>
                            <?php
                                }
                            ?>
                        </div>
                    </fieldset>
                </div>
            </form>
        </div>
    </div>
</div>