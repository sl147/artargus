<?php include 'views/layouts/headerAdmin.php';?>
  <form method="post">
   введіть назву фотоальбому<input autofocus type="text" name="name_FA" size="78"><br>
   автор фотоальбому<input type="text" name="author_FA" size="78"><br>
   опишіть свій фотоальбом<textarea name = "msgs_FA" rows ='7' cols = '78'></textarea><br>
   <button type="submit" name="submit">Створити</button>
  </form>
<?php include 'views/layouts/footerAdmin.php';?>