<div class="trades form">
<?php echo $this->Form->create('Trade'); ?>
	<fieldset>
		<legend><?php echo __('Dashboard Edit Trade'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('date_added');
		echo $this->Form->input('expiry_date');
		echo $this->Form->input('customer_id');
		echo $this->Form->input('form_m_id');
		echo $this->Form->input('deleted');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Trade.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Trade.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Trades'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Form Ms'), array('controller' => 'form_ms', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Form M'), array('controller' => 'form_ms', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Documents'), array('controller' => 'documents', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Document'), array('controller' => 'documents', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shippings'), array('controller' => 'shippings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shipping'), array('controller' => 'shippings', 'action' => 'add')); ?> </li>
	</ul>
</div>
