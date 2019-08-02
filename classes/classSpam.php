<?php
/**
 * Spam control
 * @return true if it is spam or false if not spam
 */
class ClassSpam
{

	private function getSpam() {
		$getsp = new classGetData('spamTab');
		return $getsp->getDataFromTable();
	}

	public function spamCheck($txt) {
		if (strlen($txt) == 0) return true;
		$spam = $this->getSpam();
		foreach ($spam as $val) {
			if (strpos($txt, $val['name']) != false) return true;
			if (isset(explode($val['name'],$txt )[1])) return true;
		}
        return false;
	}
}
?>