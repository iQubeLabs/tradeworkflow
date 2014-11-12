<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Trade Workflow | Dashboard</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        
        <?php
            echo $this->Html->meta('icon');
            
            echo $this->Html->css("bootstrap.min");
            echo $this->Html->css("font-awesome.min");
            echo $this->Html->css("ionicons.min");
            echo $this->Html->css("iCheck/all");
            echo $this->Html->css("AdminLTE");
            echo $this->Html->css("bootstrap-datetimepicker.min");
            echo $this->Html->css("app2");
        ?>
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        
        <script>
            //site url to be used by other parts of the site
            var siteUrl = "<?php echo Router::url("/", true)."/";?>";
        </script>
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="#" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                Trade Workflow
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">                        
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-warning"></i>
                                <span class="label label-warning"><?php echo $this->get("Notification.count");?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have <?php echo $this->get("Notification.count");?> notifications</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <?php
                                        $notifications = $this->get("Notification");
                                        foreach($notifications as $notification)
                                        {
                                            echo "<li>";
                                            echo "<a href='".  Notification::appendParam($notification['Notification']['link'], $notification['Notification']['id'], $notification['Notification']['customer_id'])."'>";
                                            echo "<i class='fa fa-users warning'></i>";
                                            echo $notification['Notification']['info'];
                                            echo "</a>";
                                            echo "</li>";
                                        }
                                        ?>
                                    </ul>    
                                <li class="footer"><a href="<?php echo Router::url(array("controller"=>"notifications", "action"=>"clearAll", md5($this->get("Notification.count"))));?>">Clear all</a></li>
                            </ul>
                        </li>                        
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>Profile<i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <?php echo $this->Html->image("avatar3.png", array("class" => "img-circle", "alt"=>"User Image"));?>
                                    <p>
                                      Logged in as Admin
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Settings</a>
                                    </div>
                                    <div class="pull-right">
                                        <?php echo $this->Html->link("Sign out", array("controller"=>"admin", "action" => "signout", "admin"=> true), array("class" => "btn btn-default btn-flat"));?>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">                
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>                            
                        </div>
                    </form>
                    
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="<?php echo $this->get("Nav.Customer"); ?>">                            
                            <a href="<?php echo Router::url(array("controller"=>"customers", "action"=>"index"));?>">
                                <i class="fa fa-users"></i> <span>Manage Traders</span>
                            </a>
                        </li>
                        <li class="<?php echo $this->get("Nav.Trade"); ?>">                            
                            <a href="<?php echo Router::url(array("controller"=>"trades", "action"=>"index"));?>">
                                <i class="fa fa-compress"></i> <span>Manage Trades</span>
                            </a>
                        </li>
<!--                        <li class="<?php echo $this->get("Nav.FormM"); ?>">                            
                            <a href="<?php echo Router::url(array("controller"=>"formMs", "action"=>"index"));?>">
                                <i class="fa fa-th"></i> <span>Form M Tracking</span>
                            </a>
                        </li>-->
                        <li class="treeview <?php echo $this->get("Nav.Shipping"); ?>">
                            <a href="#">
                                <i class="fa fa-bar-chart-o"></i>
                                <span>Shipment Tracking</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
<!--                                <li class="<?php echo $this->get("Nav.Shipping.all");?>">
                                    <a href='<?php echo Router::url(array("controller" => "shippings", "action" => "index", "all"));?>'>
                                        <i class="fa fa-angle-double-right"></i> 
                                        All
                                    </a>
                                </li>-->
                                <li class="<?php echo $this->get("Nav.Shipping.progress");?>">
                                    <a href='<?php echo Router::url(array("controller" => "shippings", "action" => "index", "progress"));?>'>
                                        <i class="fa fa-angle-double-right"></i> 
                                        In Progress
                                    </a>
                                </li>
                                <li class="<?php echo $this->get("Nav.Shipping.pending");?>">
                                    <a href='<?php echo Router::url(array("controller" => "shippings", "action" => "index", "pending"));?>'>
                                        <i class="fa fa-angle-double-right"></i> 
                                        Pending
                                    </a>
                                </li>
                                <li class="<?php echo $this->get("Nav.Shipping.done");?>">
                                    <a href='<?php echo Router::url(array("controller" => "shippings", "action" => "index", "done"));?>'>
                                        <i class="fa fa-angle-double-right"></i> 
                                        Finished</a>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview <?php echo $this->get("Nav.Document"); ?>">
                            <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>Document Tracking</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
<!--                                <li class="<?php echo $this->get("Nav.Document.all");?>">
                                    <a href='<?php echo Router::url(array("controller" => "documents", "action" => "index", "all"));?>'>
                                        <i class="fa fa-angle-double-right"></i> 
                                        All
                                    </a>
                                </li>-->
                                <li class="<?php echo $this->get("Nav.Document.progress");?>">
                                    <a href='<?php echo Router::url(array("controller" => "documents", "action" => "index", "progress"));?>'>
                                        <i class="fa fa-angle-double-right"></i> 
                                        In Progress
                                    </a>
                                </li>
                                <li class="<?php echo $this->get("Nav.Document.done");?>">
                                    <a href='<?php echo Router::url(array("controller" => "documents", "action" => "index", "done"));?>'>
                                        <i class="fa fa-angle-double-right"></i> 
                                        Finished</a>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview <?php echo $this->get("Nav.Paar"); ?>">
                            <a href="#">
                                <i class="fa fa-edit"></i> 
                                <span>PAAR Tracking</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
<!--                                <li class="<?php echo $this->get("Nav.Paar.all");?>">
                                    <a href='<?php echo Router::url(array("controller" => "paars", "action" => "index", "all"));?>'>
                                        <i class="fa fa-angle-double-right"></i> 
                                        All
                                    </a>
                                </li>-->
                                <li class="<?php echo $this->get("Nav.Paar.progress");?>">
                                    <a href='<?php echo Router::url(array("controller" => "paars", "action" => "index", "progress"));?>'>
                                        <i class="fa fa-angle-double-right"></i> 
                                        In Progress
                                    </a>
                                </li>
                                <li class="<?php echo $this->get("Nav.Paar.done");?>">
                                    <a href='<?php echo Router::url(array("controller" => "paars", "action" => "index", "done"));?>'>
                                        <i class="fa fa-angle-double-right"></i> 
                                        Finished</a>
                                </li>
                                <li class="<?php echo $this->get("Nav.Paar.cancelled");?>">
                                    <a href='<?php echo Router::url(array("controller" => "paars", "action" => "index", "cancelled"));?>'>
                                        <i class="fa fa-angle-double-right"></i> 
                                        Cancelled</a>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview <?php echo $this->get("Nav.Clearing"); ?>">
                            <a href='#'>
                                <i class="fa fa-table"></i> <span>Clearing Tracking</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo $this->get("Nav.Clearing.progress");?>">
                                    <a href='<?php echo Router::url(array("controller" => "clearings", "action" => "index", "progress"));?>'>
                                        <i class="fa fa-angle-double-right"></i> 
                                        Pending
                                    </a>
                                </li>
                                <li class="<?php echo $this->get("Nav.Clearing.done");?>">
                                    <a href='<?php echo Router::url(array("controller" => "clearings", "action" => "index", "done"));?>'>
                                        <i class="fa fa-angle-double-right"></i> 
                                        Cleared
                                    </a>
                                </li>
                            </ul>
                        </li>
<!--                        <li class="<?php echo $this->get("Nav.Demurrage"); ?>">
                            <a href='<?php echo Router::url(array("controller" => "demurrages", "action" => "index"));?>'>
                                <i class="fa fa-calendar"></i> <span>Demurrage Tracking</span>
                            </a>
                        </li>-->
                        <br/>
                        <h4>Resource Management</h4>
                        <li class="<?php echo $this->get("Nav.Sms"); ?>">
                            <a href="#">
                                <i class="fa fa-envelope"></i> <span>Sms Management</span>
                            </a>
                        </li>
                        <li class="<?php echo $this->get("Nav.Email"); ?>">
                            <a href="#">
                                <i class="fa fa-chain"></i> <span>Email Management</span>
                            </a>
                        </li>
                        <li class="<?php echo $this->get("Nav.Accounting"); ?>">
                            <a href="#">
                                <i class="fa fa-magnet"></i> <span>Accounting</span>
                            </a>
                        </li>
                        <li class="<?php echo $this->get("Nav.Port"); ?>">
                            <a href="#">
                                <i class="fa fa-magnet"></i> <span>Manage Ports</span>
                            </a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <?php echo $this->fetch('content'); ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <div class='footer pull-right'>
            Trade Workflow - Powered by iQube Labs
        </div>
        <!-- jQuery 2.0.2 -->
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