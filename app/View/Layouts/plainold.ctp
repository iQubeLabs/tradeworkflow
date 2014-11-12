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
    <p/>
        <div class="container">
                    <?php echo $this->fetch('content'); ?>
        </div>
        <div class="footer">                    
                <?php
                    echo $this->Html->script("jquery-1.11.0");
                    echo $this->Html->script("bootstrap.min");
                    echo $this->Html->script("main");
                ?>
            </div>
</body>
</html>
