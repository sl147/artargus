<?php include 'views/layouts/header.php';?>

<div class='nameGroup text-center'>Мистецька галерея робіт наших відвідувачів</div><br>
<div class="table-responsive" style="overflow: x; ">
	<table class="table table-bordered table-striped table-hover">
		<thead>
			<tr class='success'>
				<th class="text-center">Фото</th>
				<th class="text-center hidden-xs">Найменування</th>
				<th class="text-center">Автор</th>
				<th class="text-center hidden-xs">опис</th>
				<th class="text-center"></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($jobsList as $item) :?>
				<tr>

					<td>
						<?php if ($item['foto'] != null) :?>
							<a href="/jobList/<?= $item["id"]?>">
								<img class='fotolob' alt='' data-original="<?= $item["fns"]?>">
							</a>
						<?php endif; ?>	
					</td>
					<td class="hidden-xs">
						<a href="/jobList/<?= $item["id"]?>"><?= $item['name']?>
						</a>
					</td>
					<td>
						<a href="/jobList/<?= $item["id"]?>"><?= $item['log']?>
						</a>
					</td>
					<td class="hidden-xs">
						<?= $item['msgs']?>
					</td>
					<td>
						<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" data-content="<?= $item['logId']?>">
							написати<br>автору
						</button>
					</td>		

				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

<?php if ($total > Job::SHOW_BY_DEFAULT) :?>
	<div class="text-center"><? echo $pagination->get(); ?></div>
<?php endif; ?>

<?php include 'views/layouts/footer.php';?>

<script src="/js/jquery.lazyload.min.js"></script>
<script type="text/javascript">
  $(function() {
    $("img.fotolob").lazyload({
      effect: "fadeIn"
    });
  });
</script>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title text-center" id="myModalLabel">Написати автору</h4>
				<h4 class="text-center" id="content"></h4>
			</div>
			<div class="modal-body">
				<form id="authdeliv" method="POST">
					
					<label>Ім'я</label>
					<input type="text" id="pan" name="pan"><br><br>
					<label><h5>номер телефону</h5></label>
					<input type="tel" id="tel" name="tel"><br><br>
					<label>або</label><br><br>
					<label>e-mail</label>
					<input type="text" id="email" name="email" ><br><br>
					<input type="hidden" id="idFAIn" name="idFAIn">
					<textarea rows="3" cols="75" id="tema" name="tema" placeholder="напишіть тут про що хочете поговорити"></textarea>
					<div style="margin-bottom: 10px;" class="text-center">
						<button name="submit" type="submit" class="btn btn-primary">відправити</button>
					</div>
				</form>
			</div>
<!--       <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрити</button>
        <button type="button" class="btn btn-primary">Зберегти</button>
    </div> -->
</div>
</div>
</div>
<script>

	$(document).ready(function() {


// при открытии модального окна
$('#myModal').on('show.bs.modal', function (event) {
  // получить кнопку, которая его открыло
  var button = $(event.relatedTarget) 
  // извлечь информацию из атрибута data-content
  var content = button.data('content')
  var plus = content.indexOf("+") 
  var author = content.substring(0,plus)
  var idFA = content.substring(plus+1)
  //var idFA = button.data('idFA') 
  console.log("content="+content+"   indexOf="+ content.indexOf("+")+"   author="+author+"   idFA="+ idFA);
  // вывести эту информацию в элемент, имеющий id="content"
  $('input#idFAIn').val(idFA)
  $(this).find('#content').text(author);
  //$(this).find('#FA').text(idFA);
});
});	
</script>