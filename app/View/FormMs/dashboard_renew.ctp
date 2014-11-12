<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Renew Form M - '<?php echo $formM['FormM']['name']; ?>'
    </h1>
    <ol class="breadcrumb">
        <li class="">FormM Tracking</li>
        <li class="active">Renew</li>
    </ol>
</section>
<?php // var_dump($formM); ?>
<!-- Main content -->
<section class="content">
    <?php
        echo $this->element("flash_error");
        
    ?>
    <div>
        <div class="col-md-8 col-md-offset-2">
            <form action="" method="post">
                <input type="hidden" name="data[FormM][id]" value="<?php echo $formM['FormM']['id']; ?>" />
                <label>Current Expiry Date:</label>
                <input class="form-control" type="text" value="<?php echo $formM['FormM']['expiration_date']; ?>" disabled/>
                <br/>
                <label>Enter new Expiry Date:</label>
                <div class="input-group date" id="expiryDate">                   
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    <input name="data[FormM][expiration_date]" data-format="yyyy-MM-dd" type="text" class="form-control" required/>
                </div>
                <br/>
                <input type="submit" class="btn btn-success" value="Submit Renewal"/>
                <!--OR <?php echo $this->Html->link("Edit whole Form M", array("action" => "edit", $formM['FormM']['id']),
                        array("class" => "btn btn-primary")); ?> -->
            </form>            
        </div>
    </div>
</section>
<!-- .content -->