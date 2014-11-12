<html>
    <head>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <?php
            echo $this->Html->css("bootstrap.min");
            echo $this->Html->css("font-awesome.min");
            echo $this->Html->css("ionicons.min");
            echo $this->Html->css("iCheck/all");
            echo $this->Html->css("AdminLTE");
            echo $this->Html->css("bootstrap-datetimepicker.min");
            echo $this->Html->css("app2");
        ?>
        <script>
            //site url to be used by other parts of the site
            var siteUrl = "<?php echo Router::url("/", true)."/";?>";
        </script>
    </head>
    <body>
        <?php echo $this->fetch('content');?>
        
         <?php
            echo $this->Html->script("jquery");
            echo $this->Html->script("bootstrap.min");
            echo $this->Html->script("AdminLTE/app");
            echo $this->Html->script("clamp.min");
            echo $this->Html->script("bootstrap-datetimepicker.min");
            echo $this->Html->script("main");
        ?>
    </body>
</html>