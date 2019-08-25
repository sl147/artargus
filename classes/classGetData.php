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

/** Отримуєм всі дані з таблиці $this->table
 *
 *  @return масив даних
 */
	public function getDataFromTable() {
		return $this->getRow( $this->getDB("SELECT * FROM ".$this->table) );
	}

/** Отримуєм всі дані з таблиці $this->table для запитів з Vue
 *
 *  @return масив даних
 */
	public function getDataFromTableVue() {
		return $this->getRow( $this->getDBVue("SELECT * FROM ".$this->table) );
	}

/** Отримуєм всі дані з таблиці $this->table відсортованих по $nameOrder по $desk
 *
 *  @return масив даних
 */
	public function getDataFromTableOrder($nameOrder, $desk = 'DESC') {
		return $this->getRow( $this->getDB("SELECT * FROM ".$this->table." ORDER BY ".$nameOrder." ".$desk) );
	}

/** Отримуєм дані з таблиці $this->table відсортованих по $nameOrder по $desk, LIMIT $SHOW_BY_DEFAULT
 *
 *  @return масив даних
 */
	public function getOrderPageVue($SHOW_BY_DEFAULT,$page,$nameOrder, $desk = 'DESC') {
		$offset = ($page - 1) * $SHOW_BY_DEFAULT;
		return $this->getRow( $this->getDBVue("SELECT * FROM ".$this->table." WHERE job = 1 ORDER BY ".$nameOrder." ".$desk." LIMIT ".$SHOW_BY_DEFAULT." OFFSET ".$offset) );
	}

/** Отримуєм дані з таблиці $this->table відсортованих по $nameOrder по $desk, LIMIT $SHOW_BY_DEFAULT
 *
 *  @return масив даних
 */
	public function getDataFromTableOrderPageVue($SHOW_BY_DEFAULT,$page,$nameOrder, $desk = 'DESC') {
		$offset = ($page - 1) * $SHOW_BY_DEFAULT;
		return $this->getRow( $this->getDBVue("SELECT * FROM ".$this->table." ORDER BY ".$nameOrder." ".$desk." LIMIT ".$SHOW_BY_DEFAULT." OFFSET ".$offset) );
	}

/** Отримуєм всі дані з таблиці $this->table для запитів з Vue відсортованих по $nameOrder по $desk
 *
 *  @return масив даних
 */
	public function getDataFromTableOrderVue($nameOrder, $desk = 'DESC') {
		return $this->getRow( $this->getDBVue("SELECT * FROM ".$this->table." ORDER BY ".$nameOrder." ".$desk) );
	}

/** Отримуєм один запис з таблиці $this->table по id
 *
 *  @return масив даних
 */
	public function getDataFromTableByIdVue($id) {
		return (intval($id)) ? $this->getDBVue("SELECT * FROM ".$this->table." WHERE id=".$id)->fetch() : false;
	}

/** Отримуєм один запис з таблиці $this->table по id
 *
 *  @return масив даних
 */
	public function getDataFromTableById($id) {
		return (intval($id)) ? $this->getDB("SELECT * FROM ".$this->table." WHERE id=".$id)->fetch() : false;
	}

/** Отримуєм записи з таблиці $this->table по елементу $elName
 *
 *  @return масив даних
 */
	public function getDataFromTableByIdMany ($elValue,$elName) {
		return $this->getDB("SELECT * FROM ".$this->table." WHERE ".$elName."= '$elValue'")->fetch();	
	}

/** Отримуєм записи з таблиці $this->table по елементу $elName з Vue
 *
 *  @return масив даних
 */
	public function getDataFromTableByIdManyRowVue ($elValue,$elName) {
		return $this->getRow($this->getDBVue("SELECT * FROM ".$this->table." WHERE ".$elName."= '$elValue'"));	
	}

	public function getDataFromTableByName ($elValue,$elName) {
		return $this->getRow($this->getDB("SELECT * FROM ".$this->table." WHERE ".$elName."= '$elValue'"));	
	}

	public function getDataFromTableByNameH ($elValue,$elName) {
		return $this->getDB("SELECT * FROM ".$this->table." WHERE ".$elName."= '$elValue'");
	}

	public function deleteDataFromTable($id,$nameid='id') {
		return (intval($id)) ? $this->getDB("DELETE FROM ".$this->table." WHERE ".$nameid."=".$id) : false;
	}

	public function deleteDataFromTableVue($id,$nameid) {
		return (intval($id)) ? $this->getDBVue("DELETE FROM ".$this->table." WHERE ".$nameid."=".$id) : false;
	}

	public function select2el() {
		return $this->getRow( $this->getDBVue("SELECT id,name FROM ".$this->table." ORDER BY name") );
	}

	private function changeData($action,$name) {
		$result = $this->dbVue() -> prepare($action);
		$result -> bindParam(':name', $name, PDO::PARAM_STR);
		return $result -> execute();
	}

	public function edit2el($name,$id,$idName='id',$nameName='name') {
		return $this->changeData( "UPDATE ".$this->table." SET ".$nameName."=:name WHERE ".$idName."='".$id."'", $name);
	}

	public function add2el($name) {
		return $this->changeData( "INSERT INTO ".$this->table." (name) VALUES(:name)", $name);
	}

	public function activated($id,$act) {
		return (intval($id)) ? $this->getDB("UPDATE ".$this->table." SET active=$act WHERE id=$id") : false;		
	}
}
?>