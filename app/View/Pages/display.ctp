<br/>
<div class='row'>
        <iframe class='col-md-6 col-md-offset-3' height="345" src="http://www.youtube.com/embed/GAhnQYx_6CU"></iframe>
</div>
<br/>
<div class='row'>
    <div class='col-md-2 col-md-offset-5'>
     <?php 
     echo $this->Html->link("Login", array("controller"=>"login", "action"=>"index"), array("class"=>"btn btn-primary btn-block"));
     ?>
        <hr/>
        <h4 class='h4'>New User?</h4>
    <?php
     echo $this->Html->link("Sign up", array("controller"=>"signup", "action"=>"index"), array("class"=>"btn btn-success btn-block"));
     ?>   
    </div>
</div>

