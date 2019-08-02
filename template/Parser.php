<?php
/**
 * 
 */
class Parser
{
	
	private $url;
	private $ch;

	function __construct($print = false)
	{
		$this->ch = curl_init();
		if (!$print) {
			curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, TRUE);
		}
	}

	public function set($name, $value) {
		curl_setopt($this->ch, $name,  $value);
		return $this;
	}
	public function exec($url) {
		curl_setopt($this->ch, CURLOPT_URL,  $url);
		return curl_exec($this->ch);
	}

	public function __destruct() {
		curl_close($this->ch);
	}

	public function getInfo() {
		return curl_getinfo ( $this->ch, CURLINFO_FILETIME);
	}

}
?>