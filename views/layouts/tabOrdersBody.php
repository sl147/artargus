	<tr>
	<td class="text-center"><?= $item['id_ord']?></td>
	<td class="text-center"><?= $item['date_ord']?></td>
	<td class="text-center"><?= $item['orderid']?></td>
	<td class="text-center"><?= $item['name']." ".$item['surname']?></td>
	<td class="text-center"><?= $item['qq']?></td>
	<td class="text-center"><?= $item['suma']?></td>
	<td class="text-center"><?= $item['phone']?></td>
	<td class="text-center"><?= $item['email']?></td>
	<td class="text-center"><?= $item['status']?></td>
		<?
		$jobs[0]['id']   = $item['jobsId'];
		$jobs[0]['name'] = $item['status'];
		?>
		<td class="text-center anppRoleAdm" data-rladm="<?= $item['id_ord']?>">
			<select class='selectMan' name = 'idRole' id = 'idRole' title='виберіть роль'>
				<?
				for ($j = 0; $j < count($jobs); $j++) {
					echo "<option value = '".$jobs[$j]['id']."'>".$jobs[$j]['name']."</option>";
				}
				?>	
			</select>			  			
		</td>
		<td>	
	<td>
		<a href='/look/<?= $item['id_ord']?>'' title='Переглянути замовлення' class='btn btn-default btn-xs''>
  			<span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span>
		</a>
	</td>
	</tr>
