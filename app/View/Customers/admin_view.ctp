<br/>
<div class="actions pull-right">
		<?php echo $this->Html->link(__('Edit Customer'), array('action' => 'edit', $customer['Customer']['id']), array("class"=>"btn btn-primary")); ?>
		<?php echo $this->Form->postLink(__('Delete Customer'), array('action' => 'delete', $customer['Customer']['id']), array("class"=>"btn btn-danger"), __('Are you sure you want to delete # %s?', $customer['Customer']['id'])); ?>
</div>

<div class="row">
    <div class="customers view col-md-6 col-md-offset-3">
    <h2><?php echo __('Trader'); ?> #<?php echo h($customer['Customer']['id']); ?></h2>
        <div class="box box-primary">
            <div class="box-body">
                <dl class="dl-horizontal">
                    <dt><?php echo __('Id'); ?></dt>
                    <dd>
                            <?php echo h($customer['Customer']['id']); ?>
                            &nbsp;
                    </dd>
                    <dt><?php echo __('Phone'); ?></dt>
                    <dd>
                            <?php echo h($customer['Customer']['phone']); ?>
                            &nbsp;
                    </dd>
                    <dt><?php echo __('Status'); ?></dt>
                    <dd>
                            <?php echo Customer::$ENUM_STATUS[$customer['Customer']['status']]; ?>
                            &nbsp;
                    </dd>
                    <dt><?php echo __('Email'); ?></dt>
                    <dd>
                            <?php echo h($customer['Customer']['email']); ?>
                            &nbsp;
                    </dd>
                    <dt><?php echo __('Joined'); ?></dt>
                    <dd>
                            <?php echo date("j M Y", strtotime(h($customer['Customer']['created']))); ?>
                            &nbsp;
                    </dd>
                </dl>
            </div>
        </div>
    </div>
</div>

<div class="related row">
    <div class="col-md-8 col-md-offset-2">
	<h3><?php echo __('Related Trades'); ?></h3>
	<?php if (!empty($customer['Trade'])): ?>
	<table class="table table-striped table-bordered">
	<tr>
		<th><?php echo __('Trade Id'); ?></th>
		<th><?php echo __('Date Added'); ?></th>
		<th><?php echo __('Expiry Date'); ?></th>
		<th><?php echo __('Form M Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($customer['Trade'] as $trade):?>
		<tr>
			<td><?php echo $trade['id']; ?></td>
                        <td><?php echo $this->MyDate->dateTimeToDate($trade['date_added']); ?></td>
			<td><?php echo $this->MyDate->dateTimeToDate($trade['expiry_date']); ?></td>                       
                        <td><?php echo $this->Html->link($trade['form_m_id'], array("controller"=>"formMs", "action"=>"view", $trade['form_m_id'])); ?></td> 
			<td class="actions">    
				<?php echo $this->Html->link(__('View'), array('controller' => 'trades', 'action' => 'view', $trade['id'])); ?>
				<?php // echo $this->Html->link(__('Edit'), array('controller' => 'trades', 'action' => 'edit', $trade['id'])); ?>
				<?php // echo $this->Form->postLink(__('Delete'), array('controller' => 'trades', 'action' => 'delete', $trade['id']), null, __('Are you sure you want to delete # %s?', $trade['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
    </div>
</div>
