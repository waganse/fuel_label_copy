<h2>Viewing #<?php echo $task->id; ?></h2>

<p>
	<strong>Name:</strong>
	<?php echo $task->name; ?></p>

<?php echo Html::anchor('admin/task/edit/'.$task->id, 'Edit'); ?> |
<?php echo Html::anchor('admin/task', 'Back'); ?>