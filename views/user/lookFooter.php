<div class="container-fluid">
	<div class="row">
		<div class="print-excell">
<div class="col-md-2">
	<a href='/print/<?=$order['id_ord']?>' target='_blank'>
		<img align='right' alt='$order["name"]' title='версія для друку' src='/image/print.jpg'>
	</a>
</div>			
			<div class="col-md-2">
				<a href='<?= $_SERVER["HTTP_REFERER"]?>' title='Повернутись' class='btn btn-default'>Повернутись</a>
			</div>
			<div class="col-md-2">
				<a href='/outExcell/<?=$order['id_ord']?>' class='btn btn-default' title='Вигрузити в Excell' >Excell</a>					
			</div>			
		</div>
	</div>
</div>
</div>