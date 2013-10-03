<div class="posts index">
	<h2><?php echo __('Posts'); ?></h2>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<!-- <th><?php echo $this->Paginator->sort('user_id'); ?></th> -->
			<th><?php echo $this->Paginator->sort('username'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('body'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($posts as $post): ?>
		<tr>
			<td><?php echo h($post['Post']['id']); ?>&nbsp;</td>
			<!-- <td><?php echo h($post['Post']['user_id']); ?>&nbsp;</td> -->
			<!-- <td><?php echo h($post['User']['username']); ?>&nbsp;</td> -->
			<td><?php echo $this->Html->link($post['User']['username'], array('controller' => 'users', 'action' => 'view', $post['User']['id'])); ?>&nbsp;</td>
			<td><?php echo $this->Html->link($post['Post']['title'], array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])); ?>&nbsp;</td>
			<td><?php echo h($post['Post']['body']); ?>&nbsp;</td>
			<td><?php echo h($post['Post']['created']); ?>&nbsp;</td>
			<td><?php echo h($post['Post']['modified']); ?>&nbsp;</td>
			<td class="actions">
				<!-- <?php echo $this->Html->link(__('View'), array('action' => 'view', $post['Post']['id'])); ?> -->
				<?php if($current_user['id'] == $post['User']['id'] || $current_user['role'] == 'admin'): ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $post['Post']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $post['Post']['id']), null, __('Are you sure you want to delete # %s?', $post['Post']['id'])); ?>
				<?php endif; ?>
				<?php if($current_user['role'] == 'regular' || $current_user['role'] == 'admin'): ?>
					<?php echo $this->Html->link(__('Comment'), array('controller' => 'comments', 'action' => 'add', $post['Post']['id'])); ?>				
				<?php endif; ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Post'), array('action' => 'add', $post['User']['username'])); ?></li>
		<li><?php echo $this->Html->link(__('List Comments'), array('controller' => 'comments', 'action' => 'index')); ?></li>
	</ul>
</div>
