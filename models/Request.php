<?php
/**
* 
*/
class Request
{

	public static function getRequests() {
		$sql = "SELECT * FROM contact_Cl LEFT JOIN photoalbum AS type ON contact_Cl.idFA=type.id_FA ORDER BY contact_Cl.id DESC";
		$result = Db::select($sql);
		while ($row = $result->fetch()) {
			$list[] = $row;
		}
		return (isset($list)) ? $list : false;
	}
}
?>