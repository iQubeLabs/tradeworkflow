<div class="row">
    <div class="customers form col-md-6 col-md-offset-3">
    <?php echo $this->Form->create('Customer'); ?>
            <h3><?php echo __('Admin Add Trader'); ?></h3>
            <?php
                echo $this->Form->input('phone', array("class"=>"form-control"));
                echo $this->Form->input('password', array("class"=>"form-control"));
                echo $this->Form->input('email', array("class"=>"form-control"));
                echo "<br/>";
                echo $this->Form->submit(__('Create Trader'), array("class"=>"btn btn-success"));
                echo $this->Form->end();
            ?>
    </div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Traders'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Trades'), array('controller' => 'trades', 'action' => 'index')); ?> </li>
	</ul>
</div>
