<?
require_once 'phpexcel/PHPExcel.php'; // Подключаем библиотеку PHPExcel
$phpexcel = new PHPExcel(); // Создаём объект PHPExcel

	$orderid   = $order['orderid'];		
	$nameFile  = "order_".$orderid.".xls";
	$ind=1;
	$page = $phpexcel->setActiveSheetIndex(0); // Делаем активной первую страницу и получаем её
	$page->setCellValue("A$ind", 'Найменування'); 
	$page->setCellValue("B$ind", "id товару");
	$page->setCellValue("C$ind", "код товару");
	$page->setCellValue("D$ind", 'К-ть');
	$page->setCellValue("E$ind", 'ціна');
	$page->setCellValue("F$ind", 'сума');
	$page->setCellValue("G$ind", "id ордера"); 
	$page->setCellValue("H$ind", 'артикул'); 
	$page->setTitle("1"); // Заголовок
	$objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel5');
	$ind=$ind+1;
foreach ($orderTab as $item) {
	$id_ord = $item['orderid'];
	$id_tov = $item['id_tov'];
	$kod_t  = $item['kod_t'];
	$q      = $item['q'];
	$price  = $item['price'];
	$sumq   = $item['suma'];
	$name   = $item['name'];
	$article= $item['article'];

	/* Каждый раз делаем активной 1-ю страницу и получаем её, потом записываем в неё данные */

//	$page = $phpexcel->setActiveSheetIndex(0); // Делаем активной первую страницу и получаем её
	$page->setCellValue("A$ind", $name); 
	$page->setCellValue("B$ind", $id_tov);
	$page->setCellValue("C$ind", $kod_t);
	$page->setCellValue("D$ind", $q);
	$page->setCellValue("E$ind", $price);
	$page->setCellValue("F$ind", $sumq);
	$page->setCellValue("G$ind", $id_ord); 
	$page->setCellValue("H$ind", $article); 

	/* Начинаем готовиться к записи информации в xlsx-файл */
	$objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel5');
	/* Записываем в файл */
	$objWriter->save($nameFile);
	$ind=$ind+1;
}
	$page->setCellValue("D$ind", $orderSum['qq']);
	$page->setCellValue("F$ind", $orderSum['suma']);

	/* Начинаем готовиться к записи информации в xlsx-файл */
	$objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel5');
	/* Записываем в файл */
	$objWriter->save($nameFile);
	
  header("Content-Length: ".filesize($nameFile));
  header("Content-Disposition: attachment; filename=".$nameFile); 
  header("Content-Type: application/x-force-download; name=\"".$nameFile."\"");
  readfile($nameFile);
  
  unlink($nameFile);
?>