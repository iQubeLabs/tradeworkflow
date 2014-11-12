<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
       Trade Id: <?php echo $formM['Trade']['id'];?>
    </h1>
    <ol class="breadcrumb">
        <li><?php echo $this->Html->link("Trades", array("action"=>"index"));?></li>
        <li><?php echo $formM['Trade']['id'];?></li>
        <li class="active">Workflow</li>
    </ol>
</section>

<section class="content">
    <?php
//        var_dump($formM);
        $hasExpired = false;
        $expiryDate = strtotime($formM['FormM']['expiration_date']);
        $daysLeft = ($expiryDate - time())/(3600*24);

        if($daysLeft < 0)
        {
            //has expired
            $hasExpired = true;
        }
        
        $shippingDateGotten = false;
        if(strtotime($formM['Shipping']['shipping_date']) > 0)
        {
            $shippingDateGotten = true;                            
        }
        
        $can = array(
            0 => false, //initShipping
            1 => false, //initDocument
            2 => false, //initPaar
            3 => false //initClearing
        );
    ?>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <!--Timeline begins-->
            <div>
                <ul class="timeline">
                    <li class="time-label">
                        <span class="bg-blue">
                            Form M
                        </span>
                    </li>
                    <li>
                        <i class="fa fa-info bg-blue"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> <?php echo date("Y-m-d", strtotime($formM['FormM']['created']));?></span>

                            <h3 class="timeline-header"><a href="#">Created This Form</a></h3>

                            <div class="timeline-body">
                                <dl class="dl-horizontal">
                                    <dt>Form M Name:</dt>
                                    <dd><?php echo $formM['FormM']['name'];?></dd>
                                    <dt>Date Registered:</dt>
                                    <dd><?php echo date('j M Y', strtotime($formM['FormM']['registration_date']));?></dd>
                                    <dt>Date Expiring:</dt>
                                    <dd><?php echo date('j M Y', strtotime($formM['FormM']['expiration_date']));?></dd>
                                    <dt>Mode of Payment:</dt>
                                    <dd><?php echo FormM::$ENUM_MODE_OF_PAYMENT[intval($formM['FormM']['mode_of_payment'])];?></dd>
                                </dl>
                                <?php echo $this->Html->link("View more", array("controller"=>"formMs", "action"=>"view", $formM['FormM']['id']), array("class"=>"btn btn-success"))?>
                            </div>
                            <?php $can[0] = true;?>
                        </div>
                    </li>
                    <?php if($hasExpired)
                    {
                    ?>
                    <li>
                        <i class="fa fa-exclamation bg-red"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> <?php echo date("Y-m-d", $expiryDate);?></span>

                            <h3 class="timeline-header"><a href="#">Form M expired</a></h3>

                            <div class="timeline-body">
                                This form expired
                            </div>
                        </div>
                    </li>
                    <?php
                    }
                    ?>
                    <!--Shipment starts-->
                    <li class="time-label">
                        <span class="bg-blue">
                            Shipment Tracking
                        </span>
                    </li>
                    <?php
                    if($formM['Shipping']['id'] == null) //shipment has not been initialized
                    {
                    ?>
                        <li>
                            <i class="fa fa-stop bg-green"></i>
                            <div class="timeline-item">
                                <span class="timeline-header"><a href="#">Not initialized</a></span>
                                <?php 
                                    if($can[0])
                                    {
//                                        echo $this->Html->link("Initialize Shipping", array("controller"=>"shippings", "action"=>"init", $formM['Trade']['id']), array("class" => "btn btn-xs btn-success"));
                                    }
                                ?>
                            </div>
                        </li>
                    <?php
                    }
                    else //shipment was initialized
                    {
                    ?>
                        <li>
                            <i class="fa fa-info bg-blue"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> <?php echo date("Y-m-d", strtotime($formM['Shipping']['created']));?></span>
                                <h3 class="timeline-header"><a href="#">Initialized Shipment Tracking</a></h3>

                                <div class="timeline-body">
                                    <dl class="dl-horizontal">
                                        <dt>Shipping Line:</dt>
                                        <dd><?php echo $formM['ShippingLine']['name'];?></dd>
                                        <dt>Loading Port:</dt>
                                        <dd><?php echo $formM['LoadingPort']['name'];?></dd>
                                        <dt>Discharge Port:</dt>
                                        <dd><?php echo $formM['DischargePort']['name'];?></dd>
                                    </dl>
                                </div>
                            </div>
                        </li>                       
                        <?php 
                        if($shippingDateGotten)
                        {
                        ?>
                        <li>
                            <i class="fa fa-info bg-blue"></i>
                            <div class="timeline-item">
                                <h3 class="timeline-header"><a href="#">Shipping Date Gotten</a></h3>
                                <div class="timeline-body">
                                    <dl class="dl-horizontal">
                                        <dt>Shipping Date:</dt>
                                        <dd><?php echo date('j m Y', strtotime($formM['Shipping']['shipping_date']));?></dd>
                                        <dt>Date of Arrival:</dt>
                                        <dd><?php echo date('j m Y', strtotime($formM['Shipping']['expected_arrival_date']));?></dd>
                                    </dl>
                                </div>
                            </div>
                        </li>
                        <?php
                            $can[1] = true;
                        }
                        ?>
                    <?php
                    }
                    ?>
                    <!--Shipment ends-->
                    <!--Document starts-->
                    <li class="time-label">
                        <span class="bg-blue">
                            Document Tracking
                        </span>
                    </li>
                    <?php
                    if($formM['Document']['id'] == null) //Document has not been initialized
                    {
                    ?>
                        <li>
                            <i class="fa fa-stop bg-green"></i>
                            <div class="timeline-item">
                                <!--<span class='time'><button>Initialize</button></span>-->
                                <span class="timeline-header"><a href="#">Not initialized</a></span>
                                <?php 
                                    if($can[1])
                                    {
//                                        echo $this->Html->link("Initialize Document Tracking", array("controller"=>"documents", "action"=>"init", $formM['Shipping']['id']), array("class" => "btn btn-xs btn-success"));
                                    }
                                ?>
                            </div>
                        </li>
                    <?php
                    }
                    else //Document was initialized
                    {
                    ?>
                        <li>
                            <i class="fa fa-info bg-blue"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> <?php echo date("Y-m-d", strtotime($formM['Document']['created']));?></span>
                                <h3 class="timeline-header"><a href="#">Initialized Document Tracking</a></h3>

                                <div class="timeline-body">
                                    <dl class="dl-horizontal">
                                        <dt>Courier name:</dt>
                                        <dd><?php echo $formM['Courier']['name'];?></dd>
                                        <dt>Couriers Phone:</dt>
                                        <dd><?php echo $formM['Courier']['contact_phone'];?></dd>
                                    </dl>
                                </div>
                            </div>
                        </li>                        
                    <?php
                    }
                    
                    if($formM['Document']['status'] == Document::STATUS_KNOWN)
                    {
                    ?>
                    <li>
                        <i class="fa fa-info bg-blue"></i>
                        <div class="timeline-item">
                            <!--<span class="time"><i class="fa fa-clock-o"></i> <?php echo date("Y-m-d", strtotime($formM['Document']['created']));?></span>-->
                            <h3 class="timeline-header"><a href="#">Courier status Confirmed</a></h3>

                            <div class="timeline-body">
                                <dl class="dl-horizontal">
                                    Courier status updated
                                    <dt>Courier status:</dt>
                                    <dd><?php echo Document::$ENUM_STATUS[$formM['Courier']['status']];?></dd>
                                </dl>
                            </div>
                        </div>
                    </li>
                    <?php
                    $can[2] = true;
                    }
                    ?>
                    <!--Document ends-->
                    <!--Paar begins-->
                    <li class="time-label">
                        <span class="bg-blue">
                            Paar Tracking
                        </span>
                    </li>
                    <?php
                    if($formM['Paar']['id'] == null) //Paar has not been initialized
                    {                    
                    ?>
                        <li>
                            <i class="fa fa-stop bg-green"></i>
                            <div class="timeline-item">
                                <span class="timeline-header"><a href="#">Not initialized</a></span>
                                <?php 
                                    if($can[2])
                                    {
//                                        echo $this->Html->link("Start Paar", array("controller"=>"paars", "action"=>"init", $formM['Document']['id']), array("class" => "btn btn-xs btn-success"));
                                    }
                                ?>
                            </div>
                        </li>
                    <?php
                    }
                    else //Paar was initialized
                    {
                    ?>
                        <li>
                            <i class="fa fa-info bg-blue"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> <?php echo date("Y-m-d", strtotime($formM['Paar']['created']));?></span>
                                <h3 class="timeline-header"><a href="#">Initialized Paar Tracking</a></h3>

                                <div class="timeline-body">
                                    Paar was initialized and is Pending.
                                </div>
                            </div>
                        </li>
                        <?php 
                        if($formM['Paar']['action'] != Paar::ACTION_PENDING)
                        {
                        ?>
                        <li>
                            <i class="fa fa-info bg-blue"></i>
                            <div class="timeline-item">
                                <h3 class="timeline-header"><a href="#">Paar Status updated</a></h3>
                                <div class="timeline-body">
                                    <dl class="dl-horizontal">
                                        <dt>Status:</dt>
                                        <dd><?php echo Paar::$ENUM_ACTION[$formM['Paar']['action']];?></dd>
                                        <dt>Description:</dt>
                                        <dd><?php echo Paar::$ENUM_DESC[$formM['Paar']['action']];?></dd>
                                    </dl>
                                </div>
                            </div>
                        </li>
                        <?php
                        }
                        ?>
                    <?php
                    }
                    ?>
                    <!--Paar ends-->
                    <!--Clearing begins-->
                    <li class="time-label">
                        <span class="bg-blue">
                            Clearing
                        </span>
                    </li>
                    <?php
                    if($formM['Shipping']['is_cleared'])
                    {
                    ?>
                        <li>
                        <i class="fa fa-envelope bg-blue"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> <?php echo date("Y-m-d", strtotime($formM['Shipping']['date_cleared']));?></span>
                                <span class="timeline-header"><a href="#">Good Cleared</a></span>
                            </div>
                        </li>
                    <?php
                    }
                    else
                    {
                    ?>
                        <li>
                        <i class="fa fa-envelope bg-blue"></i>
                            <div class="timeline-item">
                                <span class="timeline-header"><a href="#">Not cleared yet</a></span>
                            </div>
                        </li>
                    <?php
                    }
                    ?>
                    <!--Clearing ends-->
                    <li>
                        <i class="fa fa-clock-o" title='End of Workflow'></i>
                    </li>
                </ul>
            </div>
            
            <!--Timeline ends-->
        </div>
    </div>
</section>