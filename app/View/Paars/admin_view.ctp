<section class="content-header">
    <h1>
        Paar Tracking
    </h1>
    <ol class="breadcrumb">
        <li><?php echo $this->Html->link("Paar Tracking", array("action"=>"index"));?></li>
        <li>View</li>
    </ol>
</section>
<?php // var_dump($document);?>
<section class="content">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <?php
            $this->element("flash_error");
            ?>
            
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Tracking Details</h3>
                </div>
                <div class="box-body">
                    <b>Form M Name:</b> <?php echo $paar['FormM']['name']; ?>
                    <br/>
                    <b>Date Initialized:</b> <?php echo $paar['Paar']['created']; ?>
                    <br/>
                    <br/>
                    <b>Current Status:</b> <?php echo Paar::$ENUM_ACTION[$paar['Paar']['action']]; ?>
                    <hr/>                    
                    <?php
                    if($paar['Paar']['action'] == Paar::ACTION_PENDING)
                    {
                        echo "<h3>Update Tracking Status</h3>";
                        echo $this->Html->link("Mark as Completed", array("action" => "edit", $paar['Paar']['id'], "?" => array("action" => Paar::ACTION_COMPLETED)), array("class" => "btn btn-success btn-lg"));
                        echo " ";
                        echo $this->Html->link("Mark as Cancelled", array("action" => "edit", $paar['Paar']['id'], "?" => array("action" => Paar::ACTION_CANCELLED)), array("class" => "btn btn-danger btn-lg"), "Are you sure you want to cancel?");
                    }
                    ?>
                </div>
            </div>
            <p/>
        </div>
    </div>
</section>