<section class="content-header">
    <h1>
        Document Tracking
    </h1>
    <ol class="breadcrumb">
        <li><?php echo $this->Html->link("Document Tracking", array("action"=>"index"));?></li>
    </ol>
</section>
<?php // var_dump($documents);?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Trade ID</th>
                        <th>Courier Name</th>
                        <th>Tracking Number</th>
                        <th>Courier Email</th>
                        <th>Courier Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($documents as $document)
                    {
                        echo "<tr>";
                        echo "<td>".$document['Trade']['id']."</td>";
                        echo "<td>".$document['Courier']['name']."</td>";
                        echo "<td>".$document['Document']['tracking_number']."</td>";
                        echo "<td>".$document['Courier']['contact_email']."</td>";
                        echo "<td>".Document::$ENUM_STATUS[$document['Document']['status']]."</td>";
                        echo "<td>";
                        if($document['Document']['status'] == Document::ARRIVED && ($document['Paar']['action'] === Paar::ACTION_PENDING || $document['Paar']['action'] === Paar::ACTION_UNINITIALIZED))
                        {
                            echo $this->Html->link("Start PAAR Tracking", array("controller" => "paars",
                          "action" => "init", $document["Document"]["id"]), array("class"=>"btn btn-xs btn-primary btn-block"));
                        }
                        echo $this->Html->link("View Details", array("controller" => "documents",
                          "action" => "view", $document["Document"]["id"]), array("class"=>"btn btn-xs btn-success btn-block"));
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>