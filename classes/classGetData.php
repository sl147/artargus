<?php
/**
 * 
 */
class classGetData
{
	
	function __construct($table) {
		$this->table = $table;
	}

	private  function dbVue() {
		$params = include ('../config/db_params.php');
		$dsn    = "mysql:host={$params['host']};dbname={$params['dbname']}";		
		$db     = new PDO($dsn,$params['user'],$params['password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
		return $db;
	}

	private function getDB ($sql) {
		return Db::getConnection() -> query($sql);
	}

	private function getDBVue ($sql) {
		return $this->dbVue() -> query($sql);
	}

	private function getRow ($result) {
		while ($row = $result->fetch()) {			
			$list[] = $row;
		}
		return (isset($list)) ? $list : [];
	}

	public function getDataFromTable() {
		return $this->getRow( $this->getDB("SELECT * FROM ".$this->table) );
	}

	public function getDataFromTableVue() {
		return $this->getRow( $this->getDBVue("SELECT * FROM ".$this->table) );
	}

	public function getDataFromTableOrder($nameOrder, $desk = 'DESC') {
		return $this->getRow( $this->getDB("SELECT * FROM ".$this->table." ORDER BY ".$nameOrder." ".$desk) );
	}

	public function getDataFromTableOrderVue($nameOrder, $desk = 'DESC') {
		return $this->getRow( $this->getDBVue("SELECT * FROM ".$this->table." ORDER BY ".$nameOrder." ".$desk) );
	}

	public function deleteDataFromTable($id,$nameid='id') {
		return (intval($id)) ? $this->getDB("DELETE FROM ".$this->table." WHERE ".$nameid."=".$id) : false;
	}

	public function deleteDataFromTableVue($id,$nameid) {
		return (intval($id)) ? $this->getDBVue("DELETE FROM ".$this->table." WHERE ".$nameid."=".$id) : false;
	}

	public function getDataFromTableById($id) {
		return (intval($id)) ? $this->getDB("SELECT * FROM ".$this->table." WHERE id=".$id)->fetch() : false;
	}

	public function getDataFromTableByIdMany ($elValue,$elName) {
		return $this->getDB("SELECT * FROM ".$this->table." WHERE ".$elName."= '$elValue'")->fetch();	
	}

	public function getDataFromTableByIdManyRowVue ($elValue,$elName) {
		return $this->getRow($this->getDBVue("SELECT * FROM ".$this->table." WHERE ".$elName."= '$elValue'"));	
	}

	public function getDataFromTableByName ($elValue,$elName) {
		return $this->getRow($this->getDB("SELECT * FROM ".$this->table." WHERE ".$elName."= '$elValue'"));	
	}

	public function select2el() {
		return $this->getRow( $this->getDBVue("SELECT id,name FROM ".$this->table." ORDER BY name") );
	}

	private function changeData($action,$name) {
		$result = $this->dbVue() -> prepare($action);
		$result -> bindParam(':name', $name, PDO::PARAM_STR);
		return $result -> execute();
	}

	public function edit2el($name,$id) {
		return $this->changeData( "UPDATE ".$this->table." SET name=:name WHERE id='".$id."'", $name);
	}

	public function add2el($name) {
		return $this->changeData( "INSERT INTO ".$this->table." (name) VALUES(:name)", $name);
	}

	public function activated($id,$act) {
		return (intval($id)) ? $this->getDB("UPDATE ".$this->table." SET active=$act WHERE id=$id") : false;		
	}
}
?>