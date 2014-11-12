<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Trade Workflow</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <?php
            echo $this->Html->css("bootstrap.min");
            echo $this->Html->css("font-awesome.min");
            echo $this->Html->css("AdminLTE");
        ?>
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">
    <center><h1 class=''><a href='<?php echo Router::url(array("controller" => "", "action" => "index"));?>'>Trade Workflow</a></h1></center>
        <?php echo $this->fetch('content'); ?>
        
        <!-- jQuery 2.0.2 -->
        <?php
        echo $this->Html->script("jquery");
        echo $this->Html->script("bootstrap.min");
        ?>
    </body>
</html>