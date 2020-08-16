<div class="menus form">
<?php echo $this->Form->create('Menu'); ?>
	<fieldset>
		<legend><?php echo __('Add Menu'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('introtext');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Menus'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Menuitems'), array('controller' => 'menuitems', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menuitems'), array('controller' => 'menuitems', 'action' => 'add')); ?> </li>
	</ul>
</div>