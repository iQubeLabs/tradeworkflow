<?php // var_dump($formMs); ?>
<section class="content-header">
    <h1>
        Create a new Trade
    </h1>
    <ol class="breadcrumb">
        <li><?php echo $this->Html->link("Trades", array("action"=>"index"));?></li>
        <li class="active">Create Trade</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
    <form action="#" method="post">
        <div class="modal-body">
            <div class="row">
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
                ?>
            <!-- 
                <div class="row">
                    <div class="col-md-8">
                        <div>
                            <label>Name for Trade:</label>
                            <input name="data[Trade][name]" type="text" class="form-control" placeholder="If empty will default to '<?php echo Trade::getDefaultName();?>'"/>
                        </div>
                        <br/>
                        <div>
                            <label>Expiry Date:</label>
                            <div class="input-group date" id="expiryDate">                   
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                                <input name="data[Trade][expiry_date]" data-format="yyyy-MM-dd" type="text" class="form-control" required/>
                            </div>
                        </div>
                    </div>
                </div>
                <br/>  -->

                <div class="row">
                    <div class="col-md-8">
                        <label>Form M</label><!--  <a href="#" onclick="openCreateForm();">+ Lodge Form M</a> -->
                        <select class="input-group col-md-12" id='formMSelect' name="data[Trade][form_m_id]" required>
                            <option value="" disabled>Choose a Form M for Shipment</option>
                            <?php
                            foreach ($formMs as $formM)
                            {
                                echo "<option value='".$formM['FormM']['id']."'>".$formM['FormM']['name']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="form-group col-md-8">
                        <label>Date of Shipment</label>
                        <div class="input-group date" id="dateOfShipment">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                            <input name="data[Trade][date_of_shipment]" data-format="yyyy-MM-dd" type="text" class="form-control" required />
                        </div>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="form-group col-md-8">
                        <label>Expected Time of Arrival</label>
                        <div class="input-group date" id="timeOfDelivery">                   
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                            <input name="data[Trade][expected_arrival_time]" data-format="yyyy-MM-dd" type="text" class="form-control" required/>
                        </div>
                    </div>                    
                </div>
                <br/>
                <div class="row">
                    <div class="form-group col-md-8">
                        <label>Goods Description</label>
                        <div class="">
                            <textarea name="data[Trade][goods_description]" placeholder="Goods description. Max 100" style="resize: vertical" rows="4" maxlength="100" class="form-control" required></textarea>
                        </div>
                    </div>                    
                </div>
                <br/>
                <div class="row">
                    <div class="form-group col-md-8">
                        <label>Goods Specification</label>
                        <div class="">
                            <textarea name="data[Trade][goods_specification]" placeholder="Goods description. Max 100" style="resize: vertical" rows="4" maxlength="100" class="form-control" required></textarea>
                        </div>
                    </div>                    
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-8">
                        <div>
                            <label>Shipping Line</label>
                            <input name="data[Trade][shipping_line]" type="text" class="form-control" />
                        </div>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-8">
                        <div>
                            <label>Vessel Name</label>
                            <input name="data[Trade][vessel_name]" type="text" class="form-control" />
                        </div>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-4">
                        <div>
                            <label>Quantity</label>
                            <input name="data[Trade][quantity]" type="text" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div>
                            <label>Unit</label>
                            <select name="data[Trade][unit_id]" class="form-control" required>
                                <option value="">Select unit</option>
                                <?php foreach ($units as $unit): ?>
                                    <option value="<?php echo $unit['Unit']['id'] ?>">
                                        <?php echo $unit['Unit']['name']. ' - ' .$unit['Unit']['unit']; ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-8">
                        <div>
                            <label>Amount</label>
                            <input name="data[Trade][amount]" value="" type="text" class="form-control" />
                        </div>
                    </div>
                </div>
                <br/>
        </div>
        <div class="row">
            <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Create Shipping</button>
        </div>
    </form>
        </div>
    </div>
</section>

<script>
    //open the createForm popup
    function openCreateForm()
    {
        window.open(siteUrl+"popup/formMs/add", "createFormM", "width=500, height=1000");
    }
    
    //handle result of creating FormM    
    function HandlePopupResult(result)
    {
        var FormM = result.FormM;
        var option = '<option value="'+ FormM.id+'" selected>' + FormM.name + '</option>';
        $("#formMSelect").append(option);
    }
</script>