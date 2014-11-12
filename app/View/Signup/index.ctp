<div class="form-box" id="login-box">
    <div class="header">Register</div>
        <?php
            echo $this->Form->create("Customer");
        ?>
        <div class="body bg-gray">
            <span><?php echo $this->Session->flash()?></span>
                <div class="form-group">
                    <?php echo $this->Form->input("email", array("class"=> "form-control", "placeholder" => "Email", "format" => array("input")));?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input("phone", array("class"=> "form-control", "placeholder" => "Phone number", "format" => array("input")));?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input("password", array("class"=> "form-control", "placeholder" => "Password", "format" => array("input")));?>
                </div>
        </div>
            <div class="footer">
            <?php    
                echo $this->Form->end(array("class"=> "btn btn-primary btn-block", "label"=>"Sign me up"));
                echo "<br/>";
                echo $this->Html->link("I already have an account", array("controller"=>"login", "action"=>"index"),
                    array("class"=>"text-center"));
            ?>
        </div>
</div>