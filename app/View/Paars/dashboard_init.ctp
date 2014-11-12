<section class="content-header">
    <h1>
        Initialize Paar Tracking
    </h1>
    <ol class="breadcrumb">
        <li><?php echo $this->Html->link("Paar Tracking", array("action"=>"index"));?></li>
        <li class="active">Initialize</li>
    </ol>
</section>
<?php // var_dump($document);?>
<section class="content">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
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
                <div>
                    <div class="box box-solid">
                        <div class="box-header">
                            <i class="fa fa-crosshairs"></i>
                            <h3 class="box-title">Initialize tracking</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                <?php
                    if($paarExists == false)
                    {           
                ?>
                        Are you sure you want to start Paar Tracking for this Trade?
                        <p>
                        <form class="center-block" method="post">
                            <button type="submit" class="btn btn-success">Start Paar Tracking</button>
                            <?php echo $this->Html->link("Not yet", array("controller" => "paars", "action" => "index"), 
                                        array("class" => "btn btn-danger pull-right"));?>
                        </form>
                        </p>
                <?php 
                    }
                    else
                    {
                        echo "<h3>Paar Tracking for this trade has already been initialized.</h3>";
                        echo "<br/>";
                        echo $this->Html->link("View details", array("controller" => "paars", "action" => "view", $paarId), 
                                        array("class" => "btn btn-primary"));
                    }
            ?>
                        </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </div>
</section>