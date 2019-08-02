<?php include 'views/layouts/headerAdmin.php';?>

<div class="col-lg-11 col-md-11 col-sm-12 col-xs-12">
	<h2 class="text-center">перегляд коментарів</h2>
	<table class="table table-responsive table-bordered table-striped table-hover">
		<thead>
			<tr class='success'>
				<th class="text-center">id</th>
				<th class="text-center">клієнт</th>
				<th class="text-center">текст</th>
				<th class="text-center">email</th>
				<th class="text-center">нік</th>
				<th class="text-center">ІР</th>
				<th class="text-center">актив/неактив</th>
				<th></th>
				<th></th>
			</tr>					
		</thead>
		<tbody>
			<?php foreach ($comments as $comment) :?>
				<tr>
					<td class="text-center">
						<?=$comment['id']?>
					</td>
					<td class="text-center">
						<?=$comment['log_FA']?>
					</td>
					<td class="text-left" style='width: 400px;'>
						<?=$comment['txt_com']?>
					</td>
					<td class="text-center">
						<?=$comment['email_com']?>
					</td>
					<td class="text-center">
						<?=$comment['nik_com']?>
					</td>
					<td class="text-center">
						<?=$comment['ip_com']?>
					</td>
					<?php if ($comment['active']) :?>
						<td class="text-center">активне</td>
						<td class="text-center">
							<form method = 'POST'>
								<input type='hidden' name='id' value='<?=$comment['id']?>'>
								<input type="hidden" name="active" value="0">
								<input type="hidden" name="type_submit" value="0">
								<button name='submit' class="btn btn-info">відмінити</button>
							</form>
						</td>
						<?php else :?>
							<td class="text-center">не активне</td>
							<td class="text-center">
								<form method = 'POST'>
									<input type='hidden' name='id' value='<?=$comment['id']?>'>
									<input type="hidden" name="active" value="1">
									<input type="hidden" name="type_submit" value="0">
									<button name='submit' class="btn btn-info">активувати</button>
								</form>
							</td>
						<?php endif; ?>
						<td class="text-center">
							<form method = 'POST'>
								<input type='hidden' name='id' value='<?=$comment['id']?>'>
								<input type="hidden" name="type_submit" value="1">
								<button name='submit' class="btn btn-info">видалити</button>
							</form>
						</td>
					</tr>
				<?php endforeach; ?>					
			</tbody>				
		</table>
		<?php
		if ($total > Job::SHOW_BY_DEFAULT) :?>
			<div class="text-center"><? echo $pagination->get(); ?></div>
		<?php endif; ?>	
	</div>
<?php include 'views/layouts/footerAdmin.php';?>