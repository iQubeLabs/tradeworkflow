<div class="form-box" id="login-box">
    <div class="header">Sign In</div>
        <?php
            echo $this->Form->create("Customer");
        ?>
        <div class="body bg-gray">
            <span><?php echo $this->Session->flash()?></span>
                <div class="form-group">
                    <?php echo $this->Form->input("email", array("class"=> "form-control", "placeholder" => "Email / Phone number", "type"=>"text", "format" => array("input")));?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input("password", array("class"=> "form-control", "placeholder" => "Password", "format" => array("input")));?>
                </div>
                <div class="form-group">
                    <input type="checkbox" name="remember_me"/> Remember me
                </div>
        </div>
            <div class="footer">
            <?php    
                echo $this->Form->end(array("class"=> "btn btn-primary btn-block", "label"=>"Sign me in"));
                echo "<br/>";
            ?>
                <p><a href="#">I forgot my password</a></p>

            <?php echo $this->Html->link("New user? Create account", array("controller"=>"signup", "action"=>"index"),
                    array("class"=>"text-center"));?>
        </div>
</div>