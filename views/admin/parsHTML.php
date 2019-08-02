<?php
 include 'views/admin/phpQuery-onefile.php';
 require_once ('template/Parser.php');
 ?>
<div class="row-fluid">

	<div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
	<div class="col-lg-10 col-md-9 col-sm-12 col-xs-12">		
						<h3 align="center">Порівняння цін сайтів </h3>
						<div class='table-responsive'>
							<table class="table table-bordered table-striped table-hover">
								<tr class='success'>
									<th class="text-center">Виробник</th>
									<th class="text-center">товар</th>
									<th class="text-center">ціна</th>
									<th></th>
									<th></th>
								</tr>
								<div>
<?

//$fp = fopen("file.txt", "w");								

//curl_setopt($ch, CURLOPT_URL, $url);

//curl_setopt($ch, CURLOPT_HEADER, true);

//curl_setopt($ch, CURLOPT_FILE, $fp);
//$text=curl_setopt($ch, CURLOPT_NOBODY, TRUE);
//echo($text);
//print_r($text);

//var_dump($res);
function getContent($url) {
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$res = curl_exec($ch);

	curl_close($ch);
	return $res;
}
function parser($url, $start, $end) {
	if ($start <= $end) {
		$contentOfSite = getContent($url);
		$doc = phpQuery::newDocument($contentOfSite);
		foreach ($doc->find("#products-table") as $val) {
			$val = pq($val);
			//echo $val."<hr>";
			$name = $val->find(".product-info .product-name")->text();
			$price = $val->find(".product-info .product-price-currency")->text();
			$art = $val->find(".product-photo .product-code")->text();
			echo $name."   price=$price  article: $art<hr>";			
		}
		$next = "https://rosa.ua".$doc->find(".catalog-pager .current-page")->next()->attr("href");
		echo "start=$start next: $next<br>";
		if (!empty($next)) {
			$start++;
			parser($next, $start, $end);
		}
	}
}

$url = "https://rosa.ua/catalog";
$start = 0;
$end = 2;
parser($url,$start,$end);
?>


							</div>
						</table>
					</div>
				</div>
			</div>
<?php include 'views/layouts/footerAdmin.php';?>

<?
include 'phpQuery.php'; // Подключаем phpQuery
// Теперь проверяем, не задан ли адрес новости в параметре $_GET['page']
if(!isset($_GET['page'])){
    $url = "https://coinspot.io/charts/"; // Если параметр не задан, задаем URL страницы с заголовками новостей
    $curl = curl_init($url); // Инициализируем curl по указанному адресу
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // Записать http ответ в переменную, а не выводить в буфер
    curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0); // Этот параметр нужен для работы HTTPS
    curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, 0); // Этот параметр нужен для работы HTTPS
    $page = curl_exec($curl); // Получаем в переменную $page HTML код страницы
    $document = phpQuery::newDocument($page); // Загружаем полученную страницу в phpQuery
    $elements = $document->find('.blog-title a'); // Находим все ссылки с классом ".blog-title a" 
    foreach ($elements as $el) {
        $elem_pq = pq($el); // pq - аналог $ в jQuery
        $url = $elem_pq->attr('href'); // Получаем значение атрибута 'href' ссылок
        $text = trim($elem_pq->text()); // Получаем текст ссылок
        echo('<a href="index.php?page='.$url.'">'.$text.'</a><br>'); // Формируем свои ссылки и выводим на наш сайт
    };
} else {
    $url = $_GET['page']; // Получаем URL новости по которой кликнули из параметра $_GET['page']
    $result = strpos($url, 'https://coinspot.io/'); // Эта проверка нужна чтобы кулхацкеры не подставляли в GET свои сайты
    if ($result === 0) {
        $curl = curl_init($url); // Инициализируем curl по указанному адресу
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // Записать http ответ в переменную, а не выводить в буфер
        curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0); // Этот параметр нужен для работы HTTPS
        curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, 0); // Этот параметр нужен для работы HTTPS
        $page = curl_exec($curl); // Получаем в переменную $page HTML код страницы
        $document = phpQuery::newDocument($page); // Загружаем полученную страницу в phpQuery
        $elements = $document->find('.blog-content'); // Находим div с классом ".blog-content" 
        $elem_pq = pq($elements[0]); // pq - аналог $ в jQuery
        $text = trim($elem_pq->html()); // Получаем HTML код выбранного ранее div-a
        echo('<a href="index.php">Вернуться к списку новостей</a><br><hr><br>'); // Добавляем возврат к содержанию
        echo($text); // Выводим текст новости       
    };
};
?>