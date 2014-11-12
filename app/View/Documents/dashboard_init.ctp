<section class="content-header">
    <h1>
        Initialize Document Tracking
    </h1>
    <ol class="breadcrumb">
        <li><?php echo $this->Html->link("Document Tracking", array("action"=>"index"));?></li>
        <li class="active">Initialize Document</li>
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
                                <h3 class="box-title">Description of Shipment</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <dl class="dl-horizontal">
                                    <dt>Trader's Id:</dt>
                                    <dd><?php echo $this->Html->link($trade['Trade']['customer_id'], array("controller"=>"customers", "action"=>"view", $trade['Trade']['customer_id']));?></dd>
                                    <dt>Shipping Line:</dt>
                                    <dd><?php echo $trade['Trade']['shipping_line'];?></dd>
                                    <dt>Vessel Name:</dt>
                                    <dd><?php echo $trade['Trade']['vessel_name'];?></dd>
                                    <dt>Date of Shipment:</dt>
                                    <dd><?php echo date('j M Y', strtotime($trade['Trade']['date_of_shipment']));?></dd>
                                    <dt>Arrival Date:</dt>
                                    <dd><?php echo date('j M Y', strtotime($trade['Trade']['expected_arrival_time']));?></dd>
                                    <!-- <dt>Quantity:</dt>
                                    <dd><?php echo $trade['Trade']['expected_arrival_date'];?></dd> -->
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
                    <input type="hidden" name="data[Document][trade_id]" value="<?php echo $tradeId;?>"/>
                    <!-- <input type="hidden" name="data[Document][shipping_id]" value="<?php //echo $shipping['Shipping']['id'];?>"/> -->
                    <fieldset>
                        <legend>Provide Courier's Details</legend>
                        <div>
                            <label>Courier Name</label>
                            <input type="text" name="data[Courier][name]" class="form-control" placeholder="Courier's Name" required/>
                        </div>
                        <br/>
                        <div>
                            <label>Document Tracking Number</label>
                            <input type="tel" name="data[Document][tracking_number]" class="form-control" placeholder="Document Tracking Number" required/>
                        </div>
                        <br/>
                        <div>
                            <label>Courier Email Address</label>
                            <input type="email" name="data[Courier][contact_email]" class="form-control" placeholder="Courier's Contact Email (Optional)" />
                        </div>
                        <br/>
                        <div>
                            <label>Courier Website</label>
                            <input type="text" name="data[Courier][website_address]" class="form-control" placeholder="Courier's Website (Optional)" />
                        </div>
                        <hr/>
                        <div>
                            <?php 
                                if(!$flash)
                                {
                            ?>                            
                                    <button type="submit" class="btn btn-primary btn-block">Start Document Tracking</button>
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