<h2>Editing Task</h2>
<br>

<?php echo render('admin/task/_form'); ?>
<p>
	<?php echo Html::anchor('admin/task/view/'.$task->id, 'View'); ?> |
	<?php echo Html::anchor('admin/task', 'Back'); ?></p>
