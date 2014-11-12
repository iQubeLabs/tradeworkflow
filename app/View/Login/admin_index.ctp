<div class="form-box" id="login-box">
    <div class="header">Sign In</div>
        <?php
            echo $this->Form->create("Admin");
        ?>
        <div class="body bg-gray">
            <span><?php echo $this->Session->flash()?></span>
                <div class="form-group">
                    <?php echo $this->Form->input("username", array("class"=> "form-control", "placeholder" => "Email / Phone number", "type"=>"text", "format" => array("input")));?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input("password", array("class"=> "form-control", "placeholder" => "Password", "format" => array("input")));?>
                </div>
        </div>
        <div class="footer">
        <?php    
            echo $this->Form->end(array("class"=> "btn btn-primary btn-block", "label"=>"Sign me in"));
            echo "<br/>";
        ?>
        </div>
</div>