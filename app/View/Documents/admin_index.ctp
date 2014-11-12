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
                        <th>Trade Name</th>
                        <th>Courier Name</th>
                        <th>Courier Number</th>
                        <th>Courier Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($documents as $document)
                    {
                        echo "<tr>";
                        echo "<td>".$document['Trade']['name']."</td>";
                        echo "<td>".$document['Courier']['name']."</td>";
                        echo "<td>".$document['Courier']['contact_phone']."</td>";
                        echo "<td>".$document['Courier']['contact_email']."</td>";
                        echo "<td>";
                        echo $this->Html->link("View Details", array("action" => "view", $document['Document']['id']), array("class" => "btn btn-primary btn-xs btn-block"));
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>