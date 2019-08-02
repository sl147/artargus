<?php include 'views/layouts/headerAdmin.php';?>

<h1 class="text-center">Перегляд клієнтів</h1>
<ul class="nav nav-tabs">
	<li id="myTab" class="active"><a href="#tab1" data-toggle="tab"><h4>клієнти</h4></a></li>
	<li><a href="#tab2" data-toggle="tab"><h4>адміністратори</h4></a></li>
	<li><a href="#tab3" data-toggle="tab"><h4>менеджери</h4></a></li>
</ul>
<div class="tab-content">
	<div class="tab-pane fade in active" id="tab1">
		<?php include 'views/layouts/tabClientHead.php';?>
		<?php foreach ($ClientList as $item) :?>
		<tr>
			<td class="text-center"><?= $item['id']?></td>
			<td class="text-center"><?= $item['login']?></td>
			<td class="text-center"><?= $item['name']?></td>
			<td class="text-center"><?= $item['phone']?></td>
			<td class="text-center"><?= $item['email']?></td>
			<td class="text-center"><?= $item['adres']?></td>
			<td class="text-center"><?= $item['delivery']?></td>
			<?
				$managersList = $allManagers;
				array_unshift($managersList, []);
				$managersList[0]['id']   = $item['manager'];
				$managersList[0]['name'] = $item['managerName'];
			?>
			<td class="text-center anppCl" data-cl="<?= $item['id']?>">
				<select class='selectMan' name = 'idCl' id = 'idCl' title='виберіть менеджера'>
					<?
					for ($j = 0; $j < count($managersList); $j++) {
						echo "<option value = '".$managersList[$j]['id']."'>".$managersList[$j]['name']." ".$managersList[$j]['surname']."</option>";
					}
					?>	
				</select>			  			
			</td>
			<?
				$roles = $allroles;
				array_unshift($roles, []);
				$roles[0]['name'] = $item['adminName'];
			?>
			<td class="text-center anppRoleCl" data-rlcl="<?= $item['id']?>">
				<select class='selectMan' name = 'idRoleCl' id = 'idRoleCl' title='виберіть роль'>
					<?
					foreach ($roles as $role) {
						echo"<option value = '".$role['id']."'>".$role['name']."</option>";
					}
					?>	
				</select>			  			
			</td>
			<td>
				<a href='/listClient/edit/<?= $item["id"];?>' title='редагувати клієнта' class='btn btn-default btn-xs'>
					<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
				</a>
			</td>
		</tr>
	<?php endforeach; ?>
	<?php include 'views/layouts/tabClientFoot.php';?>
</div>

<div class="tab-pane fade" id="tab2">
	<?php include 'views/layouts/tabClientHead.php';?>
	<?php foreach ($ClientAdmList as $item) :?>
	<tr>
		<td class="text-center"><?= $item['id']?></td>
		<td class="text-center"><?= $item['login']?></td>
		<td class="text-center"><?= $item['name']?></td>
		<td class="text-center"><?= $item['phone']?></td>
		<td class="text-center"><?= $item['email']?></td>
		<td class="text-center"><?= $item['adres']?></td>
		<td class="text-center"><?= $item['delivery']?></td>
		<td></td>
		<?
			$roles = $allroles;
			array_unshift($roles, []);
			$roles[0]['name'] = $item['adminName'];
		?>
		<td class="text-center anppRoleAdm" data-rladm="<?= $item['id']?>">
			<select class='selectMan' name = 'idRole' id = 'idRoleAdm' title='виберіть роль'>
				<?
					foreach ($roles as $role) {
						echo"<option value = '".$role['id']."'>".$role['name']."</option>";
					}
				?>	
			</select>			  			
		</td>
		<td>
			<a href='/listClient/changedataClient/<?= $item["id"];?>' title='редагувати клієнта' class='btn btn-default btn-xs'>
				<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
			</a>
		</td>
	</tr>
<?php endforeach; ?>
<?php include 'views/layouts/tabClientFoot.php';?>
</div>

<div class="tab-pane fade" id="tab3">
	<?php include 'views/layouts/tabClientHead.php';?>
	<?php foreach ($ClientManList as $item) :?>
	<tr>
		<td class="text-center"><?= $item['id']?></td>
		<td class="text-center"><?= $item['login']?></td>
		<td class="text-center"><?= $item['name']?></td>
		<td class="text-center"><?= $item['phone']?></td>
		<td class="text-center"><?= $item['email']?></td>
		<td class="text-center"><?= $item['adres']?></td>
		<td class="text-center"><?= $item['delivery']?></td>
		<td></td>
		<?
			$roles = $allroles;
			array_unshift($roles, []);
			$roles[0]['name'] = $item['adminName'];
		?>
		<td class="text-center anppRoleMan" data-rlman="<?= $item['id']?>">
			<input type="hidden" name="idr" id="idr" value="<?= $item['id']?>">
			<select class='selectMan' name = 'idRole' id = 'idRoleMan' title='виберіть роль'>
				<?
					foreach ($roles as $role) {
						echo"<option value = '".$role['id']."'>".$role['name']."</option>";
					}
				?>	
			</select>			  			
		</td>
		<td>
			<a href='/listClient/changedataClient/<?= $item["id"];?>' title='редагувати клієнта' class='btn btn-default btn-xs'>
				<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
			</a>
		</td>
	</tr>
<?php endforeach; ?>
<?php include 'views/layouts/tabClientFoot.php';?>
</div>
</div>

<script>
$(document).ready(function() {

	//clients
	$('.anppCl').hover(function(){
		let id= $(this).data("cl");
		let idCl  = $(this).find('select#idCl');
		idCl.change(function(){
			let idMan = idCl.val();
			$.post('/listClient/changeMan/'+id+'/'+idMan,function(data){
				location.reload();
			})	
		});
	});

	$('.anppRoleCl').hover(function(){
		let id= $(this).data("rlcl");
		let idRole  = $(this).find('select#idRoleCl');
		idRole.change(function(){
			$.post('/listClient/changeRole',{ id: id, idRole: idRole.val()},function(data){
				location.reload();
			})		
		});
	});
	//end clients

	//administrators
	$('.anppRoleAdm').hover(function(){
		let id= $(this).data("rladm");
		let idRole  = $(this).find('select#idRoleAdm');
		idRole.change(function(){
			$.post('/listClient/changeRole',{ id: id, idRole: idRole.val()},function(data){
				location.reload();
			})		
		});
	});
	//end administrators

	//menegers
	$('.anppRoleMan').hover(function(){
		let id= $(this).data("rlman");
		let idRole  = $(this).find('select#idRoleMan');
		idRole.change(function(){
			$.post('/listClient/changeRole',{ id: id, idRole: idRole.val()},function(data){
				location.reload();
			})		
		});
	});
	//end menegers
});
</script>
<?php include 'views/layouts/footerAdmin.php';?>