<section class="content-header">
    <h1>
        Document Tracking
    </h1>
    <ol class="breadcrumb">
        <li><?php echo $this->Html->link("Document Tracking", array("action"=>"index"));?></li>
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
                    <h3 class="box-title">Document Details</h3>
                </div>
                <div class="box-body">
                    <b>Courier Name:</b> <?php echo $document['Courier']['name']; ?>
                    <br/>
                    <b>Tracking Number:</b> <?php echo $document['Document']['tracking_number']; ?>
                    <br/>
                    <b>Courier Email:</b> <?php echo $document['Courier']['contact_email']; ?>
                    <br/>
                    <br/>
                    <b>Current Status:</b> <?php echo Document::$ENUM_STATUS[$document['Document']['status']]; ?>
                    <hr/>
                    <?php
                    if(($document['Document']['status'] == Document::ARRIVED) && ($document['Paar']['action'] === Paar::ACTION_PENDING || $document['Paar']['action'] === Paar::ACTION_UNINITIALIZED || $document['Paar']['action'] == null))
                    {
                    ?>
                        <em><h4>You can begin PAAR Tracking by <?php echo $this->Html->link("clicking here", array("controller" => "paars", "action" => "init", $document['Document']['id']));?></h4></em>
                    <?php
                    }
                    else if($document['Document']['status'] == Document::STATUS_UNKNOWN)
                    {
                        
                    }
                    ?>
                </div>
            </div>
            <p/>
        </div>
    </div>
</section>