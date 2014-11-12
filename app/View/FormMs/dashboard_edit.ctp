<section class="content-header">
    <h1>
        <?php echo $formM['FormM']['name']; ?>
    </h1>
    <ol class="breadcrumb">
        <li><?php echo $this->Html->link("FormM Tracking", array("action"=>"index"));?></li>
        <li class="active">Edit</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
    <form action="#" method="post">
        <div class="modal-body">
            <?php // var_dump($formM);
                $this->element("flash_error");
            ?>
            <div class="form-group">
                <fieldset>
                    <legend>Seller Details</legend>
                    <div class=''>
                        <label>Sellers Name</label>
                        <input type="text" name="data[Seller][name]" class="form-control" placeholder="Sellers Name" value="<?php echo $formM['Seller']['name'];?>" required/>
                    </div>
                    <br/>
                    <div class=''>
                        <label>Sellers Email</label>
                        <input type="email" name="data[Seller][contact_email]" class="form-control" placeholder="Sellers Email" value="<?php echo $formM['Seller']['contact_email'];?>" required/>
                    </div>
                    <br/>
                    <div class=''>
                        <label>Sellers Phone Number</label>
                        <input type="tel" name="data[Seller][contact_phone_number]" class="form-control" placeholder="Sellers Phone Number" value="<?php echo $formM['Seller']['contact_phone_number'];?>" required/>
                    </div>
                    <br/>
                    <div class=""> 
                        <label>Description of Seller - Max 100</label>
                        <textarea name="data[Seller][description]" class="form-control" style='resize: vertical;' rows="3" placeholder="Description about the Seller. Max 100." maxlength="100" required><?php echo $formM['Seller']['description']; ?></textarea>
                </div>
                </fieldset>
            </div>
            <div>
                <label>Country of Seller</label>
                <select class="input-group col-md-12" id='countrySelect' name="data[Seller][country_id]">
                    <?php
                    foreach ($countries as $country)
                    {
                        echo "<option value='".$country['Country']['id']."'>".$country['Country']['name']."</option>";
                    }
                    ?>
                </select>
            </div>
            <p/>
            <div class='row'>
                <div class='col-md-6'>
                    <fieldset>
                        <legend>Loading Port</legend>
                        <label>Country</label>
                        <select class="input-group col-md-12" id='loadingPortCountrySelect' name="data[LoadingPort][country_id]">
                            <?php
                            foreach ($countries as $country)
                            {
                                echo "<option value='".$country['Country']['id']."'>".$country['Country']['name']."</option>";
                            }
                            ?>
                        </select>
                        <br/>
                        <label>Port Name</label>
                        <select class="form-control" id='loadingPortSelect' name="data[FormM][loading_port_id]" required>
                            <option value="">Select a country for loading Port</option>
                        </select>
                    </fieldset>
                </div>
                <div class='col-md-6'>
                    <fieldset>
                        <legend>Discharge Port</legend>
                        <label>Country</label>
                        <select class="input-group col-md-12" id='dischargePortCountrySelect' name="data[DischargePort][country_id]" required>
                            <?php
                            foreach ($countries as $country)
                            {
                                echo "<option value='".$country['Country']['id']."'>".$country['Country']['name']."</option>";
                            }
                            ?>
                        </select>
                        <br/>
                        <label>Port Name</label>
                        <select class="form-control" id='dischargePortSelect' name="data[FormM][discharge_port_id]" required>
                            <option value="">Select a country for discharge Port</option>
                        </select>
                    </fieldset>
                </div>
            </div>
            <p/>
            <br/>
            <div class="form-group">
                <fieldset>
                    <legend>Description of Goods</legend>
                    <div class=''>
                        <input type="text" name="data[Good][name]" class="form-control" placeholder="Good's Name" maxlength="50" required/>
                    </div>
                    <br/>
                    <div class=''>
                        <input type="text" name="data[Good][display_name]" class="form-control" placeholder="Good's Display Name" maxlength="50" required/>
                    </div>
                    <br/>
                    <div class="">
                        <textarea name="data[Good][description]" class="form-control" style='resize: vertical;' rows="4" placeholder="Details about the Goods. Max 100" maxlength="100" required></textarea>
                    </div>
                    <br/>
                    <div>
                        <input type="text" name="data[Good][item_colour]" class="form-control" placeholder="Colour of Goods" required/>
                    </div>
                </fieldset>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-pencil"></i>
                        </div>
                        <input name="data[FormM][hs_code]" type="text" class="form-control" placeholder="HS Code">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-pencil"></i>
                        </div>
                        <input name="data[FormM][fob_value]" type="text" class="form-control" placeholder="FOB Value">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-pencil"></i>
                        </div>
                        <input name="data[FormM][freight_value]" type="text" class="form-control" placeholder="Freight Value">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-pencil"></i>
                        </div>
                        <input name="data[FormM][insurance_value]" type="text" class="form-control" placeholder="Insurance Value">
                    </div>
                </div>
            </div>
            <div>
                <fieldset>
                    <legend>Mode of Payment</legend>
                    <select class="input-group col-md-12" name="data[FormM][mode_of_payment]">
                        <?php
                        foreach(FormM::$ENUM_MODE_OF_PAYMENT as $key => $value)
                        {
                            echo "<option value='$key'>$value</option>";
                        }
                        ?>
                    </select>
                </fieldset>
            </div>
        </div>
        <div class="modal-footer clearfix">
            <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> Save changes</button>
        </div>
    </form>
        </div>
    </div>
</section>