<table>

	<?php foreach ($tasks as $task):?>
		<tr>
			<td>
				<?=$task->getName();?>
			</td>
			<td>
				<a href="../showClient/<?=$task->getClientId()?>" target="_blank"><?=$task->getClient()->getName();?></a>
			</td>
			<td>
				<a href="../showTech/<?=$task->getTechId()?>" target="_blank"><?=$task->getTech()->getName();?>
			</td>
			<td>
				<?=$task->getStatusText(); ?>
			</td>
		</tr>
	<?php endforeach;?>
</table>