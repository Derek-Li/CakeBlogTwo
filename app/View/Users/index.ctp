<div class="users index">
	<h2>Users</h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<!-- <th>Id</th> -->
			<th>Name</th>
			<th>Username</th>
			<th>Email</th>
			<th>Rank</th>
			<th class="actions">Actions</th>
	</tr>
	<?php
	$i = 0;
	foreach ($users as $user):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<!-- <td><?php echo $user['User']['id']; ?>&nbsp;</td> -->
		<td><?php echo $this->Html->link($user['User']['name'], array('controller' => 'users', 'action' => 'view', $user['User']['id'])); ?>&nbsp;</td>
		<td><?php echo $user['User']['username']; ?>&nbsp;</td>
		<td><?php echo $user['User']['email']; ?>&nbsp;</td>
		<td><?php echo $user['User']['role']; ?>&nbsp;</td>
		<td class="actions">
			<!--<?php if ($current_user['id'] == $user['User']['id'] || $current_user['role'] == 'admin'): ?>
				<?php echo $this->Html->link('View', array('action' => 'view', $user['User']['id'])); ?>
			<?php endif; ?>-->

			<?php if ($current_user['id'] == $user['User']['id'] || $current_user['role'] == 'admin'): ?>
			    <?php echo $this->Html->link('Edit', array('action' => 'edit', $user['User']['id'])); ?>
			    <?php echo $this->Form->postLink('Delete', array('action' => 'delete', $user['User']['id']), array('confirm'=>'Are you sure you want to delete that user?')); ?>
		    <?php endif; ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
<div class="actions">
	<h3>Actions</h3>
	<ul>
		<li><?php echo $this->Html->link('New User', array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link('List Posts', array('controller' => 'posts', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link('List Comments', array('controller' => 'comments', 'action' => 'index')); ?></li>
	</ul>
</div>
