<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $formM['FormM']['name'] ;?>
        <?php echo $this->Html->link("Lodge Shipment", array("controller"=>"trades" , "action"=>"add"), array("class" => "btn btn-success btn-sm"));?>
    </h1>
    <ol class="breadcrumb">
        <li><?php echo $this->Html->link("FormM Tracking", array("action"=>"index"));?></li>
        <li class="active">View</li>
    </ol>
</section>
<?php 
//var_dump($formM); 
//var_dump($countries);
?>
<section class="content">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Form M Info</h3>
                </div>
                <div class="box-body">
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
                </div>
            </div>
            
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Sellers Info</h3>
                </div>
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt>Sellers Name:</dt>
                        <dd><?php echo $formM['Seller']['name']; ?></dd>
                        <dt>Sellers Email:</dt>
                        <dd><?php echo $formM['Seller']['contact_email']; ?></dd>
                        <dt>Sellers Number:</dt>
                        <dd><?php echo $formM['Seller']['contact_phone_number']; ?></dd>
                        <dt>Sellers Country:</dt>
                        <dd>
                            <?php 
                                $country = $this->MyUI->getCountry($formM['Seller']['country_id'], $countries);
                                echo $country['Country']['name']; 
                            ?>
                        </dd>
                    </dl>
                </div>
            </div>
            
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Goods Details</h3>
                </div>
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt>Goods Description:</dt>
                        <dd><?php echo $formM['Good']['description']; ?></dd>
                        <dt>Goods Specifications:</dt>
                        <dd><?php echo $formM['Good']['specification']; ?></dd>
                        <dt>HS Code:</dt>
                        <dd><?php echo $this->MyUI->returnEmptyIfEmpty($formM['FormM']['hs_code']); ?></dd>
                        <dt>FOB Value:</dt>
                        <dd><?php echo $this->MyUI->returnEmptyIfEmpty(number_format((float)$formM['FormM']['fob_value'], 2, '.', '')); ?></dd>
                        <dt>Freight Value:</dt>
                        <dd><?php echo $this->MyUI->returnEmptyIfEmpty(number_format((float)$formM['FormM']['freight_value'], 2, '.', '')); ?></dd>
                        <dt>Total CFR</dt>
                        <dd><?php echo $this->MyUI->returnEmptyIfEmpty(number_format((float)$formM['FormM']['total_cfr'], 2, '.', '')); ?></dd>
                        <dt>Insured Value</dt>
                        <dd><?php echo $this->MyUI->returnEmptyIfEmpty(number_format((float)$formM['FormM']['insurance_value'], 2, '.', '')); ?></dd>
                        <dt>Amount Left</dt>
                        <dd><?php echo number_format((float)$amountLeft, 2, '.', ''); ?></dd>
                        <!-- <dt>Insurance Value</dt>
                        <dd><?php 
                                // $total_cfr = 1.10 * $formM['FormM']['total_cfr'];
                                // echo number_format((float)$total_cfr, 2, '.', ''); ?></dd> -->
                    </dl>
                </div>
            </div>
            
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Ports Info</h3>
                </div>
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt>Loading Port Country:</dt>                        
                        <dd><?php 
                                $country = $this->MyUI->getCountry($formM['LoadingPort']['country_id'], $countries); 
                                echo $country['Country']['name']
                            ?>
                        </dd>
                        <dt>Loading Port Name:</dt>
                        <dd><?php echo $formM['LoadingPort']['name']; ?></dd>
                        <br/>
                        <dt>Discharge Port Country:</dt>
                        <dd><?php 
                                $country = $this->MyUI->getCountry($formM['DischargePort']['country_id'], $countries); 
                                echo $country['Country']['name']
                            ?>
                        </dd>
                        <dt>Discharge Port Name:</dt>
                        <dd><?php echo $formM['DischargePort']['name']; ?></dd>                        
                    </dl>
                </div>
            </div>
        </div>
    </div>
    <?php 
        
    ?>
</section>