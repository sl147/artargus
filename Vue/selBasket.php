<?
require_once "../dblinc.php";
global $link;
$data = [];
$i=0;
if (isset($_COOKIE["basket"])) {
	$basket = unserialize($_COOKIE["basket"]);
	$orderid = $basket['orderid'];
	$goods = array_keys($basket);
	array_shift ($goods);
	if (count($goods)) 
	{
		$ids = implode(",",$goods);
		$sql = "SELECT * FROM ecatalog WHERE id IN ($ids)";
		if ($result = mysqli_query($link,$sql))
			{	
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
			$nameGr = "FT".$row['fullKod']."/";
			$id = $row['id'];
			$i++;
			$new_item = array(
				'fotoS'   => $nameGr.$row['fotoS'],
				'foto'   => $nameGr.$row['foto'],
				'id'   => $id,
				'i'   => $i,
				'kod_t'   => $row["kod_t"],
				'name'   => $row["name"],
				'article'   => $row["article"],
				'price'   => $row["price"],
				'q'   => 0+$basket[$id],
				'kodCol'   => $row["kodCol"],
				'fotoF'   => $row[$fotoF],
			);
			array_push($data, $new_item);
		}
	}
}
}
echo json_encode($data);
?>