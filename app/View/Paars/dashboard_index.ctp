<section class="content-header">
    <h1>
        PAAR Tracking
    </h1>
    <ol class="breadcrumb">
        <li><?php echo $this->Html->link("PAAR Tracking", array("action"=>"view"));?></li>
        <li class="active"><?php echo $navTitle; ?></li>
    </ol>
</section>
<?php // var_dump($paars);?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Form M Name</th>
                        <th>Date Initialized</th>
                        <th>Paar Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($paars as $paar)
                    {                        
                        echo "<tr>";
                        echo "<td>".$paar['FormM']['name']."</td>";
                        echo "<td>".$paar['Paar']['created']."</td>";
                        echo "<td>".Paar::$ENUM_ACTION[$paar['Paar']['action']]."</td>";
                        echo "<td>";
                        echo $this->Html->link("View Details", array("controller" => "paars",
                          "action" => "view", $paar["Paar"]["id"]), array("class"=>"btn btn-xs btn-success btn-block"));
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>