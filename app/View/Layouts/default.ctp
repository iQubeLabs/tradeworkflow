<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo  "Trade Workflow"?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('bootstrap.min');
                echo $this->Html->css('datepicker');
                echo $this->Html->css('app');
	?>
</head>
<body>
    <div class="header">
        <div id="" class="container">
            <div class="logo">
                <?php echo $this->Html->link("Trade Workflow", "/", array());?>
            </div>
        </div>
    </div>
    <div class="sidebar nav-collapse sidebar-nav">
        <?php echo $this->Html->image("mid-icon.jpg", array("alt" => "icon", "class"=>"icon")); ?>
        <ul class="nav nav-tabs nav-stacked">
            <li class="active"><a>Form M Tracking</a></li>
            <li><a>Shipment Tracking</a></li>
            <li><a>Document Tracking</a></li>
            <li><a>PAAR Tracking</a></li>
            <li><a>Clearing Tracking</a></li>
            <li><a>Demurrage Tracking</a></li>
        </ul>
    </div>
    <div class="container content">
                <?php echo $this->fetch('content'); ?>
    </div>
    <div class="footer">                    
            <?php
                echo $this->Html->script("jquery-1.11.0");
                echo $this->Html->script("bootstrap.min");
                echo $this->Html->script("main");
            ?>
    </div>
    <?php echo $this->element('sql_dump') ?>
</body>
</html>
