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
                <br/>
                <div class="row">
                    <div class="col-md-8">
                        <label>Form M</label> <a href="#" onclick="openCreateForm();">+ Create Form M</a>
                        <select class="input-group col-md-12" id='formMSelect' name="data[Trade][form_m_id]" required>
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
        </div>
        <div class="row">
            <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Create Trade</button>
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