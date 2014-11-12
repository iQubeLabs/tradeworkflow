<div class="row">
    <div class="customers form col-md-6 col-md-offset-3">
    <?php echo $this->Form->create('Customer', array("class"=>"form")); ?>
                    <h3><?php echo __('Admin Edit Customer'); ?></h3>
            <?php
                echo $this->Form->input('id');
                echo $this->Form->input('phone', array("class"=>"form-control"));
                echo $this->Form->input('password', array("class"=>"form-control", "value"=>"", "placeholder"=>"Enter new password"));
                echo $this->Form->input('email', array("class"=>"form-control"));
                echo "Status";
                echo $this->Form->select('status', array(Customer::$ENUM_STATUS), array("class"=>"form-control"));
                echo "<br/>";
                echo $this->Form->submit(__('Update Traders info'), array("class"=>"btn btn-success"));
                echo $this->Form->end();
            ?>
    </div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Customer.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Customer.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Traders'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Trades'), array('controller' => 'trades', 'action' => 'index')); ?> </li>
	</ul>
</div>
