<h2>Listing Tasks</h2>
<br>
<?php if ($tasks): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($tasks as $item): ?>		<tr>

			<td><?php echo $item->name; ?></td>
			<td>
				<?php echo Html::anchor('admin/task/view/'.$item->id, 'View'); ?> |
				<?php echo Html::anchor('admin/task/edit/'.$item->id, 'Edit'); ?> |
				<?php echo Html::anchor('admin/task/delete/'.$item->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Tasks.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('admin/task/create', 'Add new Task', array('class' => 'btn btn-success')); ?>

</p>
