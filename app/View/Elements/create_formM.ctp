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
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <fieldset>
                    <legend>Form M Details</legend>
                    <div class=''>
                        <input type="text" name="data[FormM][name]" class="form-control" placeholder="Form M Name - If empty will default to '<?php echo FormM::getDefaultName();?>'"/>
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label>Registration Date:</label>
                <div class="input-group date" id="registrationDate">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    <input name="data[FormM][registration_date]" data-format="yyyy-MM-dd" type="text" class="form-control" required/>      
                </div>
            </div>
            <div class="form-group col-md-6">
                <label>Expiration Date:</label>
                <div class="input-group date" id="expiryDate">                   
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    <input name="data[FormM][expiration_date]" data-format="yyyy-MM-dd" type="text" class="form-control" required/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <fieldset>
                <legend>Seller Details</legend>
                <div class=''>
                    <input type="text" name="data[Seller][name]" class="form-control" placeholder="Sellers Name" required/>
                </div>
                <br/>
                <div class=''>
                    <input type="email" name="data[Seller][contact_email]" class="form-control" placeholder="Sellers Email" required/>
                </div>
                <br/>
                <div class=''>
                    <input type="tel" name="data[Seller][contact_phone_number]" class="form-control" placeholder="Sellers Phone Number" required/>
                </div>
                <br/>
                <div class=''>
                    <input type="text" name="data[Seller][address]" class="form-control" placeholder="Sellers Address" required/>
                </div>
                <br/>
<!--                <div class="">                                
                    <textarea name="data[Seller][description]" class="form-control" style='resize: vertical;' rows="3" placeholder="Description about the Seller. Max 100." maxlength="100" required></textarea>
            </div>-->
            </fieldset>
        </div>
        <div>
            <label>Country of Origin</label>
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
                    <label>Country of Supply</label>
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
                    <select class="input-group col-md-12" id='dischargePortCountrySelect' disabled name="data[DischargePort][country_id]" required>
                        <?php
                        foreach ($countries as $country)
                        {   
                            if ($country['Country']['name'] == 'Nigeria') {
                                echo "<option selected='selected' value='".$country['Country']['id']."'>".$country['Country']['name']."</option>";
                            } else {
                                echo "<option value='".$country['Country']['id']."'>".$country['Country']['name']."</option>";
                            }
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
                <legend>Goods Details</legend>
                <!-- <div class=''>
                    <input type="text" name="data[Good][name]" class="form-control" placeholder="Good's Name" maxlength="50" required/>
                </div>
                <br/>
                <div class=''>
                    <input type="text" name="data[Good][display_name]" class="form-control" placeholder="Good's Display Name" maxlength="50" required/>
                </div>
                <br/> -->
                <div class="">
                    <textarea name="data[Good][description]" class="form-control" style='resize: vertical;' rows="4" placeholder="Goods description. Max 100" maxlength="100" required></textarea>
                </div>
                <br/>
                <div class="">
                    <textarea name="data[Good][specification]" class="form-control" style='resize: vertical;' rows="4" placeholder="Goods specification. Max 100" maxlength="100" required></textarea>
                </div>
                <!-- <br/>
                <div>
                    <input type="text" name="data[Good][item_colour]" class="form-control" placeholder="Colour of Goods (Optional)"/>
                </div> -->
            </fieldset>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-pencil"></i>
                    </div>
                    <input maxlength ="10" name="data[FormM][hs_code]" type="text" class="form-control" placeholder="HS Code">
                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-pencil"></i>
                    </div>
                    <input id="fob_value" name="data[FormM][fob_value]" type="text" class="form-control" placeholder="FOB Value">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-pencil"></i>
                    </div>
                    <input id="freight_value" name="data[FormM][freight_value]" type="text" class="form-control" placeholder="Freight Value">
                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-pencil"></i>
                    </div>
                    <input id="total_cfr" name="data[FormM][total_cfr]" type="text" class="form-control" placeholder="Total CFR = Freight + FOB" disabled>
                    <input id="totalcfr" name="data[FormM][total_cfr]" type="hidden">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-pencil"></i>
                    </div>
                    <input id="insured_value" name="data[FormM][insurance_value]" type="text" class="form-control" placeholder="Insured Value = 110% of Total CFR" disabled>

                    <input id="insuredvalue" name="data[FormM][insurance_value]" type="hidden">
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
        <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Submit</button>
    </div>
</form>