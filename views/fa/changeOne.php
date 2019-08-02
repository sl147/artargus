<?php include 'views/layouts/headerAdmin.php';?>
<h2>Назва фотоальбому:</h2><br>
<form  method = "POST">
	<textarea name="name_FA" id = "name_FA" rows ='2' cols = '50'><?= $FAOne['name_FA']?></textarea><br><br>
	<h2>Опис фотоальбому:</h2><br>
	<textarea name = "descr" id = "descr" rows ='2' cols = '50'><?= $FAOne['msgs_FA']?></textarea><br><br>
	<input type="hidden" name="idFA" value="<?= $FAOne['id_FA']?>">
	Автор: <input type="text" name="author" value="<?= $FAOne['log_FA']?>"><br><br>
	<button name="submit" type="submit" class="btn btn-info">змінити</button>
</form>
<script type='text/javascript'>
	CKEDITOR.replace('name_FA');
	CKEDITOR.replace('descr');
</script>
<script>
window.idFA=<?= $json ?>;
</script>
<div id="selPhoto">
    <table class="table table-bordered table-responsive  table-hover">
    	<thead>
    		<tr class='success'>
    			<th class="text-center">Фото</th>
    			<th class="text-center">опис</th>
    			<th></th>
                <th></th>
    		</tr>
    	</thead>
    	<tbody v-for="photo in photos">
                <tr>
                    <td>
                        <a class="fancybox" rel="group" v-bind:href="photo.foto"> 
                            <img v-bind:title="photo.subscribe" class="fotolob" v-bind:src="photo.fotos" />
                        </a>
                    </td>
                    <td>
                        <input type = "text" size="100" v-model="photo.subscribe" />
                    </td>
                    <td>
                        <button @click="change(photo)" type="button" title="змінити" class="btn btn-default btn-lg" >
                            <span class="glyphicon glyphicon-random" aria-hidden="true"></span>
                        </button>
                    </td>
                    <td>
                        <button @click="delItem(photo)" type='button' title='видалити запис' class='btn btn-default btn-lg'>
                            <span class='glyphicon glyphicon-trash' aria-hidden='true'></span>
                        </button>
                    </td>	
                </tr>		
    	</tbody>
    </table>
    <a class='btn btn-info' href="/faPhoto/<?= $FAOne['id_FA']?>">Додати новий</a>
</div>
<script src="../js/vue/selPhoto.js"></script>